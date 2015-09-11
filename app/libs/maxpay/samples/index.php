<?php
/**
 * Hướng dẫn sử dụng thư viện MaxpayClient để gọi webservice gạch thẻ
 */

require_once "../MaxpayClient.php";
$mpc=new MaxpayClient();

$merchant_txn_id="YOUR-UNIQUE-ID-".time();
$card_type="VTE";
$pin="123";
$seri="123";

$rs=$mpc->charge($merchant_txn_id,$card_type,$pin,$seri);

if(isset($rs['code']) && $rs['code']==1){
	//TODO: xử lý thẻ đúng
	echo "The OK\n";
	print_r($rs);
}else{
	//TODO: xử lý thẻ lỗi
	echo "ERROR: ".$rs['message']."\n";
	print_r($rs);
}