<?php
/**
 * ThÆ° viá»‡n tÃ­ch há»£p tháº» cÃ o maxpay.vn
 * Version 1.0
 */

class MaxpayClient {
	const CHARGE_SERVICE_URL="https://maxpay.vn/apis/card/charge?";
	const RECHECK_SERVICE_URL="https://maxpay.vn/apis/card/recheck?";
	const MERCHANT_ID="1000170"; //TODO: Thay báº±ng Merchant ID maxpay.vn cung cáº¥p cho báº¡n
	const SECRET_KEY="nEIkc6XLxLcBfei1"; //TODO: Thay báº±ng Secret Key ID maxpay.vn cung cáº¥p cho báº¡n

	/**
	 * HÃ m thá»±c hiá»‡n gá»�i sang maxpay.vn Ä‘á»ƒ gáº¡ch tháº»
	 * @param $merchant_txn_id mÃ£ giao dá»‹ch duy nháº¥t cá»§a merchant
	 * @param $cardType loáº¡i tháº»
	 * @param $pin mÃ£ tháº» (pin)
	 * @param $serial sá»‘ seri
	 * @return mixed
	 */
	public function charge($merchant_txn_id, $cardType, $pin, $serial){
		$args = array('merchant_id'=>self::MERCHANT_ID, 'pin'=>$pin,
			'seri'=>$serial, 'card_type'=>$cardType,'merchant_txn_id'=>$merchant_txn_id);

		//Create checksum security code
		$args['checksum'] = $this->_createChecksum($args);
		
		//Build request url
		$requestUrl = self::CHARGE_SERVICE_URL.http_build_query($args);

		//Call maxpay.vn's web service
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $requestUrl);
		curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__)."/ca.crt");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		$output = curl_exec($ch);
		
		//If curl error?
		if($output===false){
			$response = array(
				'code'=>99,
				'message'=>'Your curl error: '.curl_error($ch)
			);
			curl_close($ch);
			return $response;
		}

		curl_close($ch);

		$response = json_decode($output,true);
		//If json format error?
		if($response===false){
			return array(
				'code'=>99,
				'message'=>$output
			);
		}

		return $response;
	}

	/**
	 * HÃ m thá»±c hiá»‡n gá»�i sang maxpay.vn Ä‘á»ƒ kiá»ƒm tra tÃ¬nh tráº¡ng cá»§a má»™t giao dá»‹ch tháº»
	 * @param $merchant_txn_id mÃ£ giao dá»‹ch duy nháº¥t cá»§a merchant
	 * @return mixed
	 */
	public function recheck($merchant_txn_id){
		$args = array('merchant_id'=>self::MERCHANT_ID, 'merchant_txn_id'=>$merchant_txn_id);

		//Create checksum security code
		$args['checksum'] = $this->_createChecksum($args);
		
		//Build request url
		$requestUrl = self::RECHECK_SERVICE_URL.http_build_query($args);

		//Call maxpay.vn's web service
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $requestUrl);
		curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__)."/ca.crt");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		$output = curl_exec($ch);
		
		//If curl error?
		if($output===false){
			$response = array(
				'code'=>99,
				'message'=>'Your curl error: '.curl_error($ch)
			);
			curl_close($ch);
			return $response;
		}

		curl_close($ch);

		$response = json_decode($output,true);
		//If json format error?
		if($response===false){
			return array(
				'code'=>99,
				'message'=>$output
			);
		}

		return $response;
	}

	/**
	 * HÃ m thá»±c hiá»‡n táº¡o mÃ£ báº£o máº­t checksum
	 * @param $args
	 * @return string
	 */
	private function _createChecksum($args){
		ksort($args);
		return hash_hmac('SHA1',implode('|',$args),self::SECRET_KEY);
	}
}