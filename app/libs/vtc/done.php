<?php   
    WriteResultToFile();
	function WriteResultToFile()
    {
        $fh = fopen("data". DIRECTORY_SEPARATOR  ."data.txt", 'w');
		$secret_key= "kRIjJuB2fnyXcMH8GLWs/I2bb9Djwlp7bfswhfqFfq6HwsYtSH7ZQ4F2UVgdOPiaTNwfjYs05jccPYBmDbtzHTJ8mYN96B4owDCw5UUSpnxQ61rd1Fe4YO6ezw0WREl2a95u990V4PfEcJawsW2iCDG060kYqLw6kbRbRk1nc6s=";
		$status = $_GET["status"];
		$websiteid = $_GET["website_id"];
		$orderid = $_GET["order_code"];
		$amount = $_GET["amount"];
		$sign = $_GET["sign"];
		$data = $status . "-" . $websiteid . "-" . $orderid . "-" . $amount;
		$plaintext = $status . "-" . $websiteid . "-" . $orderid . "-" . $amount . "-" . $secret_key;
		$mysign = strtoupper(hash('sha256', $plaintext));
		if($mysign != $sign)
            {
                fwrite($fh, "Fail to validate data");
            }
		else
		{
			if($status == 1)
            {
                fwrite($fh, "Payment is Successful !\n");
            }
            else if($status == 2)
            {
                fwrite($fh, "Payment is Successful (pay with pending)!\n");
            }
            else if($status == 0)
            {
                fwrite($fh, "Payment is Pending!\n");
            }
			else if($status == -1)
            {
                fwrite($fh, "Payment is Failed!\n");
            }
			else if($status == -5)
            {
                fwrite($fh, "OrderID is not valid");
            }
			else if($status == -6)
            {
                fwrite($fh, "Account's balance is insufficient");
            }
			else
            {
                fwrite($fh, "Payment is Not Success!\n");
            }
		}

		fwrite($fh,sprintf("Data = %s\t#\t sign=%s\t",$data,$sign));
		fclose($fh);
		ShowResult();
    }
	
    function ShowResult(){
        $handle = fopen("data". DIRECTORY_SEPARATOR  ."data.txt", "r");
        $contents = fread($handle, filesize("data". DIRECTORY_SEPARATOR ."data.txt") + 1);
        fclose($handle);
        echo $contents;
    }


?>