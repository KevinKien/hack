<?php 
WriteResultToFile();
	function WriteResultToFile()
    {
        $fh = fopen("data". DIRECTORY_SEPARATOR  ."data2.txt", 'w');
		$secret_key= "kRIjJuB2fnyXcMH8GLWs/I2bb9Djwlp7bfswhfqFfq6HwsYtSH7ZQ4F2UVgdOPiaTNwfjYs05jccPYBmDbtzHTJ8mYN96B4owDCw5UUSpnxQ61rd1Fe4YO6ezw0WREl2a95u990V4PfEcJawsW2iCDG060kYqLw6kbRbRk1nc6s=";
		$data = $_POST["data"];
		$sign = $_POST"sign"];
		$plaintext = $data . "|" . $secret_key;
		$mysign = strtoupper(hash('sha256', $plaintext));
		if($mysign != $sign)
            {
                fwrite($fh, "Fail to validate data");
            }
		else
		{
			$string = splt('|',$data);
			$status = $string[1];
			$amount = $string[2];
			if($status == 1)
            {
                fwrite($fh, "Payment is Successful !\n");
				fwrite($fh, "Amount = $amount !\n");
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
        $handle = fopen("data". DIRECTORY_SEPARATOR  ."data2.txt", "r");
        $contents = fread($handle, filesize("data". DIRECTORY_SEPARATOR ."data2.txt") + 1);
        fclose($handle);
        echo $contents;
    }
?>