<?php
// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

ini_set('session.gc_maxlifetime', 86400);
session_start(); 

require_once("../classes/DB_class.php");
require_once("../includes/functions.php");
$db = new DB();
$db->connect();

$user_email = $_SESSION["email"];
$username = $_SESSION["name"];
$user_id = $_SESSION["user_id"];
$balance = in_table("balance", "register", "WHERE email = '$user_email'", "balance");
$balance = (!empty($balance))?$balance:0;
$earned = in_table("earned", "register", "WHERE email = '$user_email'", "earned");
$earned = (!empty($earned))?$earned:0;
$account_type = in_table("account_type", "register", "WHERE email = '$user_email'", "account_type");

if(!isset($_SESSION["login"])){
$_SESSION["msg"] = "<div class='not_success'>You are not logged in.</div>";
redirect("{$directory}");
}

if(isset($_REQUEST["logout"])){
unset($_SESSION["login"]);
unset($_SESSION["name"]);
unset($_SESSION["email"]);
unset($_SESSION["user_id"]);
$db->query("UPDATE register SET logged_in = '0' WHERE email = '{$user_email}'");
$_SESSION["msg"] = "<div class='success'>You are successfully loged out. Kindly log in to continue...</div>";
redirect("{$directory}");
}
?>
<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Title Of Site -->
	<title><?php echo (basename($_SERVER["PHP_SELF"]) == "index.php")?"Dashboard":ucfirst(str_replace("_"," ",basename($_SERVER["PHP_SELF"],".php"))); ?> - Quiz Money Game</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
<script src="https://use.fontawesome.com/ac6f3c60d8.js"></script>
	<!-- CSS Plugins -->
	<link rel="icon" type="image/png" href="../images/icon (1).png">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" media="screen">	
	<link href="../css/animate.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
	<link href="../css/component.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/components.css" />
	
	<!-- CSS Font Icons -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.css">
  <link rel="stylesheet" href="../icons/open-iconic/font/css/open-iconic-bootstrap.css">
  <link rel="stylesheet" href="../icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../pe-icon-7-stroke/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="../icons/ionicons/css/ionicons.css">
	<link rel="stylesheet" href="../icons/rivolicons/style.css">

 <!-- Insert to your webpage before the </head> -->
    <script src="../sliderengine/jquery.js"></script>
    <script src="../sliderengine/amazingslider.js"></script>
    <link rel="stylesheet" type="text/css" href="../sliderengine/amazingslider-1.css">
    <script src="../sliderengine/initslider-1.js"></script>
    <!-- End of head section HTML codes -->
	<!-- CSS Custom -->
	<link href="../css/style.css" rel="stylesheet">
	
	<!-- Add your own style -->
	<link href="../css/your-style.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
<style>
<!--
.success{
background:#099;
color:#fff;
font-size:16px;
text-align:center;
padding:10px;
padding-top:15px;
padding-bottom:15px;
margin:10px;
cursor:default;
}
.success *, .success *:active, .success *:hover{
text-decoration:none;
color:#fff;
font-size:16px;
cursor:pointer;
}
.success a:hover{
text-decoration:underline;
}
.not_success{
background:#b00;
color:#fff;
font-size:16px;
text-align:center;
padding:10px;
padding-top:15px;
padding-bottom:15px;
margin:10px;
}
-->
</style>	

<script type="text/javascript"> //<![CDATA[ 
var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.comodo.com/" : "http://www.trustlogo.com/");
document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]>
</script>
</head>

<body>
<?php if(basename($_SERVER["PHP_SELF"]) != "fund-game.php" && basename($_SERVER["PHP_SELF"]) != "success.php"){ 

unset($_SESSION["merchant_ref"]);
unset($_SESSION["amount"]);
unset($_SESSION["confirmed"]);
unset($_SESSION["submit"]);
?>

	<!-- start Container Wrapper -->
	<div class="wrapper container-wrapper">

		<!-- start Header -->
		<header id="header" style="margin-bottom:50px;">
	  
			<!-- start Navbar (Menu) -->
			<nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">
				
				<div class="container">
						
					<div class="navbar-header">
						<a class="navbar-brand" href="../index.php"><img src="../images/logo3.png"></a>
					</div>
						
					<div id="navbar" class="collapse navbar-collapse navbar-arrow pull-left">
					
						<ul class="nav navbar-nav" id="responsive-menu">
							<li>
								<a href="index.php"><span class="btn" style="border: 2px solid #0a0; color: #fff; padding: 5px; background:#090;"><?php echo $username; ?></span></a>
								
							</li>
							<li>
								<a href="../redeem.php">Claim Reward</a>
								
							</li>

							<li><a href="play-option.php">How to play game</a></li>
							<li class="">
									<a href="fund.php" class="btn">
	<span style="border: 2px solid #940505; color: #fff; padding: 5px; background:#940505; "><i class="fa fa-money"></i> Fund your account</span>
									</a>
									
								</li>


								<li class="user-action">
				<a class="btn" onClick="javascript:return confirm(7Are you sure yoõ want"uo`log out?')+" hruf="index.php?logout=1"><3pan wDyle-"jorder: 2px solid #940505? color: #vff: paddkng: 5px; background:#940505; "<Sign Out</span></a>
								</li>
						
						|/ul>
					
				<'div><!--/.nav-cllapse -->
									</div>
				
				<div id="slicknav-mobileb></div>
A		)
‰		</nav>			<!-- eNd Navbar 8Menu) -­>

		</håader>
		=!-- end Header --><?php } ?>  "    