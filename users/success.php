<?php include_once("../includes/user_header.php"); 
?>

<style>
<!--
.content_header{
text-align:center;
margin-bottom:20px;
margin-top:10px;
font-size:30px;
color:rgb(3, 3, 64);
background:#eee;
padding:20px;
}
.content_header *{
font-size:30px;
color:#f33;
}
.content_header span i{
color:rgb(3, 3, 64);
}
.notice{
padding:20px;
color:#000;
background:#eee;
margin-top:20px;
margin-bottom:20px;
}
.notice div{
font-size:20px;
padding-bottom:10px;
}
.print_btn{
float:right;
}
-->
</style>

<div class="container">

<?php
$merchant_id = '2855-0040387';

if(isset($_POST['transaction_id'])){
	//get the full transaction details as an xml from voguepay
	$xml = file_get_contents('https://voguepay.com/?v_transaction_id='.$_POST['transaction_id']);
	//parse our new xml
	$xml_elements = new SimpleXMLElement($xml);
	//create new array to store our transaction detail
	$transaction = array();
	//loop through the $xml_elements and populate our $transaction array
	foreach($xml_elements as $key => $value) 
	{
		$transaction[$key]=$value;
	}

$total = $transaction["total"];
$merchant_ref = $transaction["merchant_ref"];	
$cur = $transaction["cur"];
$vouguepay_transaction_id = $transaction["transaction_id"];
$status = $transaction["status"];
$method = $transaction["method"];
$referrer = $transaction["referrer"];

if(!isset($_SESSION["login"]) or !isset($_SESSION["merchant_ref"]) or !isset($_SESSION["amount"]) or $_SESSION["merchant_ref"] != $merchant_ref or $_SESSION["amount"] != $total or $merchant_id != $transaction["merchant_id"]){ $_SESSION["notSuccess"] = "<div class='not_success'>You are not authorised to view this page.</div>"; redirect($directory); }else{

$confirmed = in_table("confirmed", "transactions", "WHERE merchant_ref = '{$merchant_ref}'", "confirmed");

/////////////////////////////////////////////////////////////////////////////
if($status == "Approved" && (!isset($_SESSION["confirmed"]) or $_SESSION["confirmed"] != 1) && $confirmed == 0){

$act = $db->query("UPDATE register SET balance = balance + $total WHERE email = '$user_email'");
if($act){
$to = "{$user_email}";
$subject = "Successful Payment - {$merchant_ref}";
$message = "
<html>
<head>
<title>Successful Payment - {$merchant_ref}</title>
</head>
<body>
<p><img src='{$directory}images/logo3.png'><br><br>Dear {$username},<br><br>Thank you for using Quiz Money Game platform.<br><br>Your payment of &#8358;" . formatNumber($total) . " was successful and confirmed with the reference number: <b>{$merchant_ref}</b> .<br><br>Your new balance is &#8358;" . formatNumber($total + $balance) . "<br><br>To start playing funded game, kindly login to your profile on the platform.<br><br><br><br>Regards,<br><br>Quiz Money Game Team,<br><br><a href='{$directory}'>quizmoneygame.com</a>.</p>
</body>
</html>
";
$message = wordwrap($message,70);

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: Quiz Money Game <noreply@quizmoneygame.com>" . "\r\n";
$headers .= "Cc: admin@quizmoneygame.com" . "\r\n";

mail($to,$subject,$message,$headers);

////////////////////////////////////////////////////////////////////////////
$_SESSION["confirmed"] = 1;
}
}else if((!isset($_SESSION["confirmed"]) or $_SESSION["confirmed"] != 1)  && $confirmed == 0){

/////////////////////////////////////////////////////////////////////////////
$to = "{$user_email}";
$subject = "Payment Not Successful - {$txnref}";
$message = "
<html>
<head>
<title>Payment Not Successful - {$merchant_ref}</title>
</head>
<body>
<p><img src='{$directory}images/logo3.png'><br><br>Dear {$username},<br><br>Thank you for using Quiz Money Game platform.<br><br>Your attempt to pay &#8358;" . formatNumber($total) . " with reference number <b>{$merchant_ref}</b> was NOT successful.<br><br>Please, contact the administrator through the content on the Contact Us page on the website.<br><br>To start playing funded game, kindly login to your profile on the platform.<br><br><br><br>Regards,<br><br>Quiz Money Game Team,<br><br><a href='{$directory}'>quizmoneygame.com</a>.</p>
</body>
</html>
";
$message = wordwrap($message,70);

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: Quiz Money Game <noreply@quizmoneygame.com>" . "\r\n";
$headers .= "Cc: admin@quizmoneygame.com" . "\r\n";

mail($to,$subject,$message,$headers);
$_SESSION["confirmed"] = 1;
////////////////////////////////////////////////////////////////////////////
}

//////////////////////////Update Transaction///////////////////////////////////////////////////
if(!isset($_SESSION["submit"]) or $_SESSION["submit"] != $vouguepay_transaction_id && $confirmed == 0){
$data_array = array(
"cur" => $cur,
"vouguepay_transaction_id" => $vouguepay_transaction_id,
"status" => $status,
"method" => $method,
"referrer" => $referrer,
"confirmed" => 1
);
$act = $db->update($data_array, "transactions", "merchant_ref = '{$merchant_ref}'");
if($act){
$_SESSION["submit"] = $vouguepay_transaction_id;
}
}
//////////////////////////////////////////////////////////////////////////////////////////////////
?>

<div class="col-sm-12 content_header">
<i class="fa fa-quote-left" aria-hidden="true"></i> Payment <span>Response <i class="fa fa-quote-right" aria-hidden="true"></i></span>
</div>

<table class="table table-striped table-hover"><tbody><tr>
<td style="width:200px;"><b>User ID</b></td>
<td><?php echo $user_id; ?></td>
</tr><tr>
<td><b>Full Name</b></td>
<td><?php echo $username; ?></td>
</tr><tr>
<td><b>Email Address</b></td>
<td><?php echo $user_email; ?></td>
</tr><tr>
<td><b>Transaction Ref.</b></td>
<td><?php echo $merchant_ref; ?></td>
</tr><tr>
<td><b>Amount</b></td>
<td><span>&#8358;<?php echo formatNumber($total); ?></span></td>
</tr>
<tr>
<td><b>New E-Wallet Balance</b></td>
<td><span style="color:#f33; font-size:18px;">&#8358;<?php echo formatNumber(in_table("balance", "register", "WHERE email = '$user_email'", "balance")); ?></span></td>
</tr><tr>
<td><b>Vougue Pay Ref.</b></td>
<td><?php echo $vouguepay_transaction_id; ?></td>
</tr><tr>
<td><b>Description</b></td>
<td><span style="color:<?php echo ($status == "Approved")?"#00d":"#966"; ?>; font-size:18px;"><?php echo $status; ?></span></td>
</tr><tr>
<td colspan="2">
<button class="btn btn-default print_btn" onclick="javascript:window.print();"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
<a href="index.php"><button class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back to profile page</button></a>
</td></tr></tbody></tbody></table>

<div class="notice">
<div>NOTICE</div>
Please, if your payment status is not Approved and your account has been successfully debited by the bank, kindly contact the administrator for reflecting the amount on your e-wallet balance.
</div>	

<?php	
}

}
?>

</div>
