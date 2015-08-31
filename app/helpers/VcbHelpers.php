<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 17/07/2015
 * Time: 9:31 SA
 */

class VcbHelpers{

    private $id = '6376471A27';
    private $password = 'L5s3w1ea5p3I4QOjOLLJ';
    private $html_url = 'https://www.vietcombank.com.vn/IBanking/Default.aspx?';
    private $cc;

    public function __construct(){
       $this->setCC();
    }

    public function login(){
        $curl = new cURL();
        $cc = $this->cc;
        $captcha = Input::get('vcb_captcha');
        $html = $curl->get($this->html_url.'cc='.$cc);
        echo $this->html_url.'cc='.$cc;
//        print_r($html);
        exit;
        preg_smatch('#<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)"#',$html,$__VIEWSTATE);
        preg_match('#<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)"#',$html,$__EVENTVALIDATION);
        Log::debug($__VIEWSTATE);
        Log::debug($__EVENTVALIDATION);
        $__VIEWSTATE = isset($__VIEWSTATE[1]) ? $__VIEWSTATE[1] : '';
        $__EVENTVALIDATION = isset($__EVENTVALIDATION[1]) ? $__EVENTVALIDATION[1] : '';



        $data = '__EVENTTARGET=&__EVENTARGUMENT=&__VIEWSTATE=' . urlencode($__VIEWSTATE) . '&__VIEWSTATEENCRYPTED=&__EVENTVALIDATION=' . urlencode($__EVENTVALIDATION) . '&ctl00%24Content%24Login%24TenTC=' . urlencode($this->id) . '&ctl00%24Content%24Login%24MatKH=' . urlencode($this->password) . '&ctl00%24Content%24Login%24ImgStr=' . strtoupper($captcha) . '&ctl00%24Content%24Login%24LoginBtn=%C4%90%C4%83ng+nh%E1%BA%ADp';
        $curl->post('https://www.vietcombank.com.vn/IBanking/Default.aspx?cc=' . $cc,$data);
    }

    private function setCC(){
        if(!Session::has('vcb_cc')){
            $curl = new cURL();
            $html =  $curl->get('https://www.vietcombank.com.vn/IBanking/Accounts/TransactionDetail.aspx');

            if(preg_match('#href="%2fIBanking%2fError.aspx%3fid%3d1%26cc%3d(.*?)"#', $html, $cc))
            {
                Session::put('vcb_cc', $cc[1]);
            }
        }

        $this->cc = Session::get('vcb_cc');
    }

    public function getCC(){
        return $this->cc;
    }

    public function getCaptcha(){
        $curl = new cURL();
        $img = $curl->get('https://www.vietcombank.com.vn/IBanking/Captcha/JpegImage.ashx?code=goaamamiaiyw');
        $filename = '/media/uploads/captcha/' . time().'.jpg';
        file_put_contents(public_path().$filename, $img);
        return $filename;
    }

}