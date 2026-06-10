<?php include_once("../includes/user_header.php");  

$amount = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["amount"]))?test_input($_POST["amount"]):$amount;

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($amount)){

$time = time();
$time = $time . rand();
$merchant_ref = "Q{$time}G";
$date_time = date("Y-m-d H:i:s");
$_SESSION["merchant_ref"] = $merchant_ref;
$_SESSION["amount"] = $amount;
$memo = "Payment on Quiz Game";

$data_array = array(
"user_id" => "'$user_id'",
"name" => "'$username'",
"email" => "'$user_email'",
"merchant_ref" => "'$merchant_ref'",
"amount" => "'$amount'",
"memo" => "'$memo'",
"date_time" => "'$date_time'"
);
$db->insert($data_array, "transactions");
?>

<form method="POST" name="payform" class="pay" action="https://voguepay.com/pay/">
<input type="hidden" name="v_merchant_id" value="2855-0040387" />
<input type="hidden" name="merchant_ref" value="<?php echo $merchant_ref; ?>" />
<input type="hidden" name="memo" value="<?php echo $memo; ?>" />
<input type="hidden" name="email" value="<?php echo $user_email; ?>" />
<input type="hidden" name="notify_url" value="https://quizmoneygame.com/users/success.php" />
<input type="hidden" name="success_url" value="https://quizmoneygame.com/users/success.php" />
<input type="hidden" name="fail_url" value="https://quizmoneygame.com/users/success.php" />
<input type="hidden" name="total" value="<?php echo $amount; ?>" />
</form>
<script>
<!--
var form = document.payform;
form.submit();
//-->
</script>
<?php
}
?>
<div class="container" style="padding-top:2em;">
										
								<div class="col-lg-6 col-sm-6 col-xs-12">
								<div style="text-align:center;">
									
									<a  href="../wire.php" style="font-weight:bold; padding:10px; font-size:18px; color:#fff"><button id="link">CLICK HERE IF YOU PAY OR MADE A TRANSFER TO OUR BANK ACCOUNT</button></a></div>
										<div class="content">
										
											<h5 class="text-center">For bank deposits, Mobile, Online, and ATM transfers.</h5>
											
											<div id="account">
											<img src="../images/gtbank.jpg" style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Name:</span> Golden Walls Agencies Limited<br>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Number::</span> 0221561394</div>

											<div id="account">
											<img src="../images/zenith.jpg" style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Name:</span> Golden Walls Agencies Limited<br>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Number::</span> 1014648008</div>

											<div id="account">
											<img src="../images/access.jpg" style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Name:</span> Golden Walls Agencies Limited<br>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Number::</span>0057075187</div>

											<div id="account">
											<img src="../images/heritage.jpg" style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Name:</span> Golden Walls Agencies Limited<br>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Number::</span>5100226009</div>

											<div id="account">
											<img src="../images/uba.jpg" style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Name:</span> Golden Walls Agencies Limited<br>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Number::</span> </div>

											<div id="account">
											<img src="../images/fcmb.jpg" style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Name:</span> Golden Walls Agencies Limited<br>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Number::</span> 36889640104</div>

											<div id="account">
											<img src="../images/firstbank.jpg" style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Name:</span> Golden Walls Agencies Limited<br>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Number::</span> 2030885969</div>

											<div id="account">
											<img src="../images/diamond.jpg" style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Name:</span> Golden Walls Agencies Limited<br>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-weight:bold;">Account Number::</span> 0078728249</div>




											</div></div>
										
								<div class="col-lg-6 col-sm-6 col-xs-12">
								<div style="text-align:center;">
										<a  href="#" style="font-weight:bold; padding:10px; font-size:18px; color:#fff"><button id="link">FIND YOUR E-WALLET WITH DEBIT/CREDIT CARD</button></a>
										
										<div class="content">
										
											<h5 class="text-center">For online payment with your debit / credit card...</h5>
											<div style="text-align:left;">
											<p >For online payment with your debit / credit card...</p>
											<p> Ensure your account is BVN linked Ensure you have up to the amount you want to pay in your account</p>
											<p>Make sure you have a hardware token or your registered phone number (the one that receives alerts) with you</p>
											<p>Use only the on-screen keypad to enter your correct PIN number</p>
											<p>Your CCV / CVV2 code is usually the last 3 numbers typed at the BACK of your CARD.</p>
											</div>
									<p style="padding-top:20px;"><img src="../images/card.gif"></p>

<form method="POST" class="integration" action="" style="width:100%">
<select name="amount" class="total" style="width:100%;" required>
<option value="">**Select an amount to pay**</option>
<option value="50">50</option>
<option value="500">500</option>
<option value="1000">1000</option>
<option value="2000">2000</option>
<option value="5000">5000</option>
</select>
<br><br>
<button class="btn btn-danger">Click here to fund your e-wallet with debit/credit card</button>
</form>

										</div>	</div>
							</div>
							
						</div>
<style type="text/css">
	@media only screen and (min-width:800px) and (max-width:1200px){
  
  #pay{
  	font-size:px;
  }

	}
</style>

<script>
$(document).ready(function(){

$("form.integration").submit(function(){
var this_value = $.trim($("select.total").val());
if(this_value == ""){
alert("You must select an amount");
return false;
}else{
return true
}
});

});
//-->
</script>

<?php include_once("../includes/user_footer.php"); ?>