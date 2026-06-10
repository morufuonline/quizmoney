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
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Quizmoney Admin Login</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="cache-control" content="no-cache">
      <meta http-equiv="expires" content="Thu, 19 Nov 1900 08:52:00 GMT">
      <!--Loading bootstrap css-->
      <link type="text/css" href="../../../fonts.googleapis.com/css_7E915B8D">
      <link type="text/css" rel="stylesheet" href="../../../fonts.googleapis.com/css_35050E5D">
      <link type="text/css" rel="stylesheet" href="vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css">
      <link type="text/css" rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
      <link type="text/css" rel="stylesheet" href="vendors/bootstrap/css/bootstrap.min.css">
      <!--Loading style vendors-->
      <link type="text/css" rel="stylesheet" href="vendors/animate.css/animate.css">
      <link type="text/css" rel="stylesheet" href="vendors/iCheck/skins/all.css">
      <!--Loading style-->
      <link type="text/css" rel="stylesheet" href="css/themes/style1/pink-blue.css" class="default-style">
      <link type="text/css" rel="stylesheet" href="css/themes/style1/pink-blue.css" id="theme-change" class="style-change color-change">
      <link type="text/css" rel="stylesheet" href="css/style-responsive.css">
      <link rel="shortcut icon" href="images/favicon.ico">
      <link rel="favicon" type="shotcut icon" href="../images/hne-edu.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/custom.css">
   <link rel="stylesheet" type="text/css" href="../styles/animate.css">
  <link rel="stylesheet" type="text/css" href="../styles/animate.min.css">
<script data-cfasync="false" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script data-cfasync="false" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script data-cfasync="false" src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
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
   </head>
   <body id="signin-page">
   
<?php

$msg = "";

if(isset($_SESSION["login"])){
redirect("../account.php");
}
if(isset($_SESSION["admin_login"])){
redirect("index.php");
}
//Starts Admin Login
if($_SERVER['REQUEST_METHOD'] == "POST"  && isset($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"])){

$email = $password = "";

$email = test_input($_POST["email"]);
$password = sha1(test_input($_POST["password"]));

$result = $db->select("admin", "Where email = '{$email}' AND password = '{$password}'", "*", "");

if(mysql_num_rows($result) == 1){

$row = mysql_fetch_array($result);
$_SESSION["email"] = $email;
$_SESSION["name"] = $row["username"];
$_SESSION["user_id"] = $row["user_id"];
$_SESSION["admin_login"] = 1;
$date_time = date("Y-m-d H:i:s");

$db->query("UPDATE admin SET logged_in = '1', date_time = '{$date_time}' WHERE email = '{$email}' AND password = '{$password}'");

redirect("index.php");

}else{
$msg = "<div class='not_success'>Incorrect Username/Password</div>";
}

}

echo (isset($msg))?$msg:"";

if(isset($_SESSION["msg"])){
echo $_SESSION["msg"];
session_destroy();
}
?>  
 
      <div class="page-form " style="    margin-top: 200px;">

         <form action="login.php" method="post" class="form" style="margin-top:40px;margin-bottom:40px;">
            <div class="header-content">
               <h1>Admin Log In</h1>
            </div>
            <div class="body-content" style="    padding: 50px 20px;">
              
               <div class="form-group">
                  <div class="input-icon right"><i class="fa fa-user"></i><input type="text" placeholder="Username (Email)" name="email" class="form-control" value="<?php if(isset($_POST["email"])){echo $_POST["email"];} ?>" required></div>
               </div>
               <div class="form-group">
                  <div class="input-icon right"><i class="fa fa-key"></i><input type="password" placeholder="Password" name="password" class="form-control" style="width:100%" required></div>
               </div>
             
               <div class="form-group pull-right"><button type="submit" name="login" class="btn btn-success">Log In
                  &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
               </div>
              
            </div>
         </form>
      </div>

    
      <script src="js/jquery-1.10.2.min.js"></script><script src="js/jquery-migrate-1.2.1.min.js"></script><script src="js/jquery-ui.js"></script><!--loading bootstrap js--><script src="vendors/bootstrap/js/bootstrap.min.js"></script><script src="vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script><script src="js/html5shiv.js"></script><script src="js/respond.min.js"></script><script src="vendors/iCheck/icheck.min.js"></script><script src="vendors/iCheck/custom.min.js"></script><script>//BEGIN CHECKBOX & RADIO
         $('input[type="checkbox"]').iCheck({
             checkboxClass: 'icheckbox_minimal-grey',
             increaseArea: '20%' // optional
         });
         $('input[type="radio"]').iCheck({
             radioClass: 'iradio_minimal-grey',
             increaseArea: '20%' // optional
         });
         //END CHECKBOX & RADIO
      </script><script type="text/javascript">(function (i, s, o, g, r, a, m) {
         i['GoogleAnalyticsObject'] = r;
         i[r] = i[r] || function () {
             (i[r].q = i[r].q || []).push(arguments)
         }, i[r].l = 1 * new Date();
         a = s.createElement(o),
                 m = s.getElementsByTagName(o)[0];
         a.async = 1;
         a.src = g;/index.htm
         m.parentNode.insertBefore(a, m)
         })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
         ga('create', 'UA-145464-12', 'auto');
         ga('send', 'pageview');
      </script>
   </body>
</html>