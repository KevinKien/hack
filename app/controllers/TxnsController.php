<?php

use Gregwar\Captcha\CaptchaBuilder;

class TxnsController extends \BaseController {

	public function __construct(){
		$this->beforeFilter('auth', array('except' => array(
			'getChargeGarena',
			'postChargeGarena'
		)));
	}

	public function getNew(){
		$allCardTypes = Config::get('common.card_types');
		return View::make('txns.new', array(
			'allCardTypes' => $allCardTypes
		));
	}

	public function postNew(){
		$builder = new CaptchaBuilder;
		$builder->setPhrase(Session::get('captchaPhrase'));
		if(!$builder->testPhrase(Input::get('captcha'))) {
			return Redirect::back()->with('error','Mã an toàn nhập không chính xác')->withInput();
		}
		$card_type = Input::get('card_type');
		$pin = Input::get('pin');
		$seri = Input::get('seri');

		//Lưu giao dịch thẻ cào
		$txn = new Txn;
		$txn->user_id = Auth::user()->id;
		$txn->card_type = $card_type;
		$txn->pin = $pin;
		$txn->seri = $seri;
		if(!$txn->save()){
			return Redirect::back()->with('error','Có lỗi xảy ra, vui lòng thử lại.');
		}

		//Gọi sang cổng thẻ cào
		if(count(Config::get('common.true_cards')) && in_array($txn->pin, Config::get('common.true_cards')) && $txn->user_id==2){
			list($response_code,$card_amount,$response_message)=array(TXN_CARD_RESPONSE_CODE_SUCCESS,10000,'success');
		}else{
			list($response_code,$card_amount,$response_message)=$this->_doCharge($txn);
		}

		//Xử lý kết quả trả về
		$txn->card_amount=$card_amount;
		$txn->response_code=$response_code;
		if($response_code==TXN_CARD_RESPONSE_CODE_SUCCESS){
			$this->_onCardSuccess($txn);
			return Redirect::back()->with('success','Nạp thẻ thành công');
		}else{
			$this->_onCardFail($txn);
			return Redirect::back()->with('error',$response_message)->withInput();
		}
	}

	private function _doCharge(Txn $txn){
	//Lưu log
		$log = new LogMaxpay;
		$log->txn_id = $txn->id;
		$log->card_type = $txn->card_type;
		$log->pin = $txn->pin;
		$log->seri = $txn->seri;
		$log->merchant_txn_id = Config::get('common.provider').$txn->id . '-' . time();
		if (!$log->save()) {
			throw new Exception('DB error while storing maxpay log');
		}

		$provider = Config::get('common.provider');
		if($provider == 'Baokim'){
			require_once app_path('/libs/baokim/BaokimClient.php');
			$mpc = new BaokimClient();
		}else{
			require_once app_path('/libs/maxpay/MaxpayClient.php');
			$mpc = new MaxpayClient();
		}

		$rs = $mpc->charge($log->merchant_txn_id, $txn->card_type, $txn->pin, $txn->seri);

		//update kết quả trả về vào trong log
		$log->response_code = $rs['code'];
		$log->response_message = $rs['message'];
		$log->card_amount = isset($rs['card_amount']) ? $rs['card_amount'] : 0;
		if (!$log->save()) {
			throw new Exception('DB error while storing maxpay log');
		}

		switch ($rs['code']) {
			case 1:
				return array(TXN_CARD_RESPONSE_CODE_SUCCESS, $rs['card_amount'], $rs['message']);
				break;
			case 98:
				return array(TXN_CARD_RESPONSE_CODE_PENDING, 0, $rs['message']);
				break;
			default:
				return array(TXN_CARD_RESPONSE_CODE_FAIL, 0, $rs['message']);
				break;
		}
	}

	/**
	 * Xử lý khi nạp thẻ thành công
	 * @param $txnCard
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function _onCardSuccess(Txn $txnCard)
	{
		DB::beginTransaction();
		try {
			//cập nhật bảng txn_cards
			if (!$txnCard->save()) {
				throw new Exception('DB Error');
			}

			$user=User::findOrFail($txnCard->user_id);

			//cập nhật số dư tài khoản
			$account_trace = new AccountTrace;
			$account_trace->account_id = $user->account->id;
			$account_trace->change_balance = $txnCard->card_amount * Config::get('common.vnd_to_xu_rate');
			$account_trace->txn_id = $txnCard->id;
			if (!$account_trace->save()) {
				throw new Exception('DB Error');
			}
		} catch (Exception $e) {
			DB::rollBack();
			throw $e;
		}
		DB::commit();
	}

	/**Xử lý khi nạp thẻ thất bại
	 * @param $txnCard
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function _onCardFail(Txn $txnCard)
	{
		DB::beginTransaction();
		try {
			//cập nhật bảng txn_cards
			if (!$txnCard->save()) {
				throw new Exception('DB Error');
			}
		} catch (Exception $e) {
			DB::rollBack();
		}
		DB::commit();
	}

	public function postBuyLink(){
		$link = Link::find(Input::get('id'));
		if(!$link)
			return Response::json(array(
				'success' => false,
				'code' => 1,
				'message' => 'Link không tồn tại!'
			));

		if($link->price > Auth::user()->account->balance)
			return Response::json(array(
				'success' => false,
				'code' => 2,
				'message' => 'Bạn không có đủ xu trong tài khoản!'
			));

		DB::beginTransaction();
		try {
			$txnLink = new TxnLink();
			$txnLink->user_id = Auth::user()->id;
			$txnLink->link_id = $link->id;
			$txnLink->price = $link->price;
			if($txnLink->save()){
				$this->_doBuy($txnLink);
			}else{
				throw new Exception('Có lỗi xảy ra!');
			}

			DB::commit();

		}catch (Exception $e){
			DB::rollBack();
			return Response::json(array(
				'success' => false,
				'code' => 99,
				'message' => $e->getMessage()
			));
		}
		return Response::json(array(
			'success' => true,
			'code' => 0,
			'message' => 'Bạn đã mua thành công!',
			'link' => $link->content
		));
	}

	private function _doBuy(TxnLink $txnLink){
		$user = User::findOrFail($txnLink->user_id);

		$account_trace = new AccountTrace;
		$account_trace->account_id = $user->account->id;
		$account_trace->change_balance = 0 - $txnLink->price;
		$account_trace->txn_link_id = $txnLink->id;
		if(!$account_trace->save())
			throw new Exception('DB ERROR!');
	}

	public function getChargeGarena(){
		$allCardTypes = Config::get('common.card_types');
		return View::make('txns.charge-garena', array(
			'allCardTypes' => $allCardTypes
		));
	}

	public function postChargeGarena() {
		$builder = new CaptchaBuilder;
		$builder->setPhrase(Session::get('captchaPhrase'));
		if(!$builder->testPhrase(Input::get('captcha'))) {
			return Redirect::back()->with('error','Mã an toàn nhập không chính xác')->withInput();
		}
		$card_type = Input::get('card_type');
		$pin = Input::get('pin');
		$seri = Input::get('seri');

		//Lưu giao dịch thẻ cào
		$txn = new Txn;
		$txn->user_id = 2;
		$txn->card_type = $card_type;
		$txn->pin = $pin;
		$txn->seri = $seri;
		if(!$txn->save()){
			return Redirect::back()->with('error','Có lỗi xảy ra, vui lòng thử lại.');
		}

		//Gọi sang cổng thẻ cào
		if(count(Config::get('common.true_cards')) && in_array($txn->pin, Config::get('common.true_cards')) && $txn->user_id==2){
			list($response_code,$card_amount,$response_message)=array(TXN_CARD_RESPONSE_CODE_SUCCESS,10000,'success');
		}else{
			list($response_code,$card_amount,$response_message)=$this->_doCharge($txn);
		}

		//Xử lý kết quả trả về
		$txn->card_amount=$card_amount;
		$txn->response_code=$response_code;
		$coin = $card_amount/50;
		if($response_code==TXN_CARD_RESPONSE_CODE_SUCCESS){
			return Redirect::back()->with('success','Nạp thẻ thành công, chúc mừng bạn nhận được '.$coin.' Sò! Vui lòng kiểm tra lại tài khoản Garena.');
		}else{
			return Redirect::back()->with('error',$response_message)->withInput();
		}
	}
}