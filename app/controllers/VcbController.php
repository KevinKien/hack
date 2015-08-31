<?php


class VcbController extends BaseController {

    public function getIndex()
    {
        $curl = new cURL();
        $vcb = new VcbHelpers();
        $html = $curl->get('https://www.vietcombank.com.vn/IBanking/Accounts/TransactionDetail.aspx?cc='.$vcb->getCC());
        //Kiểm tra đăng nhâp
        if(!preg_match('#Chi tiết giao dịch</a></li></ol>#', $html)) {
            $captcha = $vcb->getCaptcha();
            return View::make('vcb.index')->with('captcha', $captcha);
        }
        echo '<a href="/vcb/logout">Thoát</a>';
        echo $html;
    }

    public function postLogin(){
        $vcb = new VcbHelpers();
        $vcb->login();
//        return Redirect::to('/vcb/index');
    }

    public function getLogout(){
        $curl = new cURL();
        $vcb = new VcbHelpers();
        $curl->get('https://www.vietcombank.com.vn/IBanking/Support/Logout.aspx?&cc='.$vcb->getCC());
        return Redirect::to('/vcb/index');
    }

}