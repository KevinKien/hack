<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>
Sample Merchant SA PHP
<link href="https://365.vtc.vn/trading/Content/css/365.css" rel="stylesheet">
<link href="https://365.vtc.vn/trading/Content/css/style.css" rel="stylesheet">
</title
</head>
<body>
    <form name="form1" method="post" action="checkout.php" id="form1">
	<iframe src="https://365.vtc.vn/trading/107/2f7bf36bc0c652ccf730ea7975fd80a7" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
    <table>
     <tr><td>OrderID</td><td>
         <input name="txtOrderID" type="text" value="<?php echo date("YmdHis")?>" id="txtOrderID" /></td></tr>
    <tr>
    <td>Customer First Name</td><td>
        <input name="txtCustomerFirstName" type="text" value="" id="txtCustomerFirstName" /></td></tr>
		<td>Customer Last Name</td><td>
        <input name="txtCustomerLastName" type="text" value="" id="txtCustomerLastName" /></td></tr>
		<td>Bill to address line 1</td><td>
        <input name="txtBillAddress1" type="text" value="" id="txtBillAddress1" /></td></tr>
		<td>Bill to address line 2</td><td>
        <input name="txtBillAddress2" type="text" value="" id="txtBillAddress2" /></td></tr>
		<td>City</td><td>
        <input name="txtCity" type="text" value="" id="txtCity" /></td></tr>
		<td>Country</td><td>
        <input name="txtCountry" type="text" value="" id="txtCountry" /></td></tr>
		<td>Customer Email</td><td>
        <input name="txtCustomerEmail" type="text" value="" id="txtCustomerEmail" /></td></tr>
		<td>Customer Mobile</td><td>
        <input name="txtCustomerMobile" type="text" value="" id="txtCustomerMobile" /></td></tr>
		<td>Param Exten</td><td>
        <input name="txtParamExt" type="text" value="" id="txtParamExt" /></td></tr>
		<td>URL return</td><td>
        <input name="txtUrlReturn" type="text" value="" id="txtUrlReturn" /></td></tr>
		<td>Secret Key</td><td>
        <input name="txtSecret" type="text" value="kRIjJuB2fnyXcMH8GLWs/I2bb9Djwlp7bfswhfqFfq6HwsYtSH7ZQ4F2UVgdOPiaTNwfjYs05jccPYBmDbtzHTJ8mYN96B4owDCw5UUSpnxQ61rd1Fe4YO6ezw0WREl2a95u990V4PfEcJawsW2iCDG060kYqLw6kbRbRk1nc6s=" id="txtSecret" /></td></tr>
    <tr><td>Price: </td><td>
        <input name="txtTotalAmount" type="text" value="10000" id="txtTotalAmount" /></td></tr>
    
     <tr><td class="style1">Unit: </td><td class="style1">
        <input name="txtCurency" type="text" value="1" id="txtCurency" />

        
         &nbsp;<i>1:VND 2:USD</i></td></tr>
		
        <tr><td>Website ID</td><td><input name="txtWebsiteID" type="text" value="384" id="txtWebsiteID" /></td></tr>
    <tr><td></td><td>
        <tr><td>Recieve Account</td><td><input name="txtReceiveAccount" type="text" value="0986021866" id="txtReceiveAccount" /></td></tr>		
<tr><td>Description</td><td>
             <input name="txtDescription" type="text" value="MUA_DIEN_THOAI" id="txtDescription" /></td></tr>					 			
    <tr><td></td><td>	
        <input type="submit" name="Button1" value="Pay with Paygate" id="Button1" style="width:188px;" />
        </td></tr>
    </table>
    </div>
    </form>
</body>
</html>