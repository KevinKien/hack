<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 20/07/2015
 * Time: 11:24 SA
 */
class AcbHelpers{

    private $id = 'congchinh619';
    private $password = 'vananh2702619163';


    public function login(){
//        session_start();
//        echo session_id();exit;
        $dse_sessionId = 'gVuuJlapnGB3Uqdd1yLw40M';
        $dse_applicationId = -1;
        $dse_pageId = 3;
        $dse_operationName = 'obkLoginOp';
        $dse_errorPage = 'ibk/login.jsp';
        $dse_processorState = 'initial';
        $UserName = $this->id;
        $PassWord = $this->password;
        $dse_locale = 'vi_VN';
        $glbLogedIn = 'WEB';

        $data = 'dse_sessionId='. $dse_sessionId .'&dse_applicationId=-1&dse_pageId=3&dse_operationName=obkLoginOp&dse_errorPage=ibk%2Flogin.jsp&dse_processorState=initial&UserName='. urlencode($UserName) .'&PassWord='. urlencode($PassWord) .'&dse_locale=vi_VN&glbLogedIn=WEB';
        $curl = new cURL();
        $html = $curl->post('https://online.acb.com.vn/acbib/Request', $data);
        return $html;
//        print_r($html);

    }

    public function getUrlData(){
        $curl = new cURL();
        $html = $curl->get('https://online.acb.com.vn');
        preg_match('#<input type="hidden" name="dse_sessionId" value="(.*?)" />#', $html, $dse_sessionId);
        preg_match('#<input type="hidden" name="dse_applicationId" value="(.*?)" />#', $html, $dse_applicationId);
        preg_match('#<input type="hidden" name="dse_pageId" value="(.*?)" />#', $html, $dse_pageId);
        preg_match('#<input type="hidden" name="dse_operationName" value="(.*?)" />#', $html, $dse_operationName);
        preg_match('#<input type="hidden" name="dse_errorPage" value="(.*?)" />#', $html, $dse_errorPage);
        preg_match('#<input type="hidden" name="dse_processorState" value="(.*?)" />#', $html, $dse_processorState);
        preg_match('#<input type="hidden" name="dse_locale" value="(.*?)" />#', $html, $dse_locale);
    }
}