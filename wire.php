<?php include_once('includes/header.php');   

$amount_paid = $bank_name = $payment_location = $payment_date = $depositor_name = $transaction_ref = $email = "";

$amount_paid = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["amount_paid"]))?testTotal($_POST["amount_paid"]):$amount_paid;
$bank_name = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["bank_name"]))?test_input($_POST["bank_name"]):$bank_name;
$payment_location = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["payment_location"]))?test_input($_POST["payment_location"]):$payment_location;
$payment_date = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["payment_date"]))?test_input($_POST["payment_date"]):$payment_date;
$depositor_name = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["depositor_name"]))?test_input($_POST["depositor_name"]):$depositor_name;
$transaction_ref = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["transaction_ref"]))?test_input($_POST["transaction_ref"]):$transaction_ref;
$email = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["email"]))?test_input($_POST["email"]):$email;


if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($amount_paid) && !empty($bank_name) && !empty($payment_location) && !empty($payment_date) && test_date($payment_date) && !empty($depositor_name) && !empty($transaction_ref) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){

$name = in_table("first_name", "register", "WHERE email = '$email'", "first_name") . " " . in_table("last_name", "register", "WHERE email = '$email'", "last_name");

$to = "admin@quizmoneygame.com";
$subject = "Payment Notification ({$transaction_ref})";

$message = "
<html>
<head>
<title>Payment Notification ({$transaction_ref})</title>
</head>
<body>
<p><img src='{$directory}images/logo3.png'><br><br><b>Email:</b> {$email}<br><br><b>Amount Paid:</b> &#8358;" . formatNumber($amount_paid) . "<br><br><b>Bank Name:</b> {$bank_name}<br><br><b>Payment Location:</b> {$payment_location}<br><br><b>Payment Date:</b> " . date_format(date_create($payment_date),"l, F jS, Y") . "<br><br><b>Depositor&#039;s Name:</b> {$depositor_name}<br><br><b>Transaction Ref.:</b> {$transaction_ref}</p>
</body>
</html>
";
$message = wordwrap($message,70);

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= "From: $name <{$email}>" . "\r\n" . "Cc: mailmiyes@gmail.com";

$act = mail($to,$subject,$message,$headers);

if($act){
$_SESSION["success"] = "<div class='success'>Your mail was successfully sent. We will get back to you soon. Thank you.</div>";
redirect("wire.php");
}else{
$_SESSION["notSuccess"] = "<div class='not_success'>Error occured.</div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && (empty($amount_paid)  or empty($bank_name) or empty($payment_location) or empty($payment_date) or !test_date($payment_date) or empty($depositor_name) or empty($transaction_ref) or empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL))){
$_SESSION["notSuccess"] = "<div class='not_success'>Not sent. All fields must be appropriately sent.</div>";
}

if(isset($_SESSION["success"]) && !isset($_POST["email"])){
echo $_SESSION["success"];
unset($_SESSION["success"]);
}
if(isset($_SESSION["notSuccess"])){
echo $_SESSION["notSuccess"];
unset($_SESSION["notSuccess"]);
}


?>

<style>
<!--
.content form label{
text-align:left;
margin-top:10px;
}
-->
</style>

<div class="section pt-70 pb-80">
			
				<div class="container">
				
			
						<div class="GridLex-gap-30">
						
							<div class="GridLex-grid-noGutter-equalHeight">

							   <div class="GridLex-col-6_sm-12_xs-12">

							   <div class="user-action-item clearfix">
									
										<div class="icon">
											<i class="fa fa-question-sign"></i>
										</div>
										
										<div class="content">
							   	
							   	<h3 class="text-uppercase mb-20"> How to fill this form?</h3>

							   	<p class="text-left"><span id="wire">Amount Paid:</span><br>
Enter the amount you deposited or transferred to our bank account.<br><br>

<span id="wire">Bank Name:</span> <br>
Select which of our bank accounts you paid to.<br><br>

<span id="wire">Location: </span><br>
For ATM transfers, enter the location of the ATM machine. <br>
For bank deposits, enter the name of the branch or the location. <br>
For Online or Mobile banking transfers, enter "Online transfer", or "Mobile transfer".<br><br>

<span id="wire">Date of Payment:</span> <br>
Enter / Select the date on which you made the payment. <br><br>
<span id="wire">Depositor Name: </span><br>
For ATM transfers, enter "ATM Transfer". <br>
For Online / Mobile banking transfers, enter the name of the Account Owner<br><br>

<span id="wire">Transaction ref / Teller number:</span></p></div></div>
							   </div>
										
								<div class="GridLex-col-6_sm-12_xs-12">
								
									<div class="user-action-item clearfix">
									
										<div class="icon">
											<i class="fa fa-shopping-cart"></i>
										</div>
										
										<div class="content">
										
											<p class="mb-20">Send Payment Details If you have made a payment either through direct bank deposit or transfer, please use this form to submit the details of your payment.</p>

											<form role="form" action="" method="post">
												
												<label for="amount_paid">Amount paid</label>
													<div class="input-group">
													  <span class="input-group-addon" id="basic-addon3">Amount (&#8358;)</span>
<input type="text" class="form-control" id="amount_paid" aria-describedby="basic-addon3" name="amount_paid" placeholder="E.g. 5,000" required value="">
													</div>

													<label for="bank_name">Bank name</label>
													<div class="input-group">
													  <span class="input-group-addon" id="basic-addon3">Bank</span>
<input type="text" class="form-control" id="bank_name" aria-describedby="basic-addon3" name="bank_name" placeholder="E.g. GTBank" required value="">
													</div>

													<label for="payment_location">Location/Branch</label>
													<div class="input-group">
													  <span class="input-group-addon" id="basic-addon3">Location</span>
<input type="text" class="form-control" id="payment_location" aria-describedby="basic-addon3" name="payment_location" placeholder="E.g. Bode Thomas branch" required value="">
													</div>

													<label for="payment_date">Date of payment <i>(Format: YYYY-MM-DD)</i></label>
													<div class="input-group">
													  <span class="input-group-addon" id="basic-addon3">Date </span>
<input type="text" class="form-control" id="payment_date" onfocus="javascript:$(this).blur();" aria-describedby="basic-addon3" name="payment_date" placeholder="The date you made payment" required value="">
													</div>

													<label for="depositor_name">Depositor&#039;s name</label>
													<div class="input-group">
													  <span class="input-group-addon" id="basic-addon3">Depositor</span>
<input type="text" class="form-control" id="depositor_name" aria-describedby="basic-addon3" name="depositor_name" placeholder="Depositor&#039;s name on the teller" required value="">
													</div>
                                                    
													<label for="email">Email (the one you use in signing up on this platform)</label>
													<div class="input-group">
													  <span class="input-group-addon" id="basic-addon3">Email</span>
<input type="email" class="form-control" id="email" aria-describedby="basic-addon3" name="email" placeholder="Your email" required value="">
													</div>

													<label for="transaction_ref">Transaction reference</label>
													<div class="input-group">
													  <span class="input-group-addon" id="basic-addon3">Transaction</span>
<input type="text" class="form-control" id="transaction_ref" aria-describedby="basic-addon3" name="transaction_ref" placeholder="E.g. the deposit slip number" required value="">
													</div>

												
													<div class="input-group pull-center" style="top:10px;">
													  <input type="submit" class="form-control btn btn-primary" name="contact_us" value="Submit">
													</div>

											</form>

											
										</div>
									
									</div>
									
								</div>

							</div>
							
						</div>
						
				
				</div>
				
			</div>


<?php include_once('includes/footer.php'); ?>