<?php
require_once("server_header.php");

$user_type = $subject = $message = "";
$user_type = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["user_type"]))?test_input($_POST["user_type"]):$user_type;
$subject = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["subject"]))?test_input($_POST["subject"]):$subject;
$message = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["message"]))?$_POST["message"]:$message;

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($user_type) && !empty($subject) && !empty($message)){

$result = $email = "";

$result = ($user_type == "newsletter" or $user_type == "all")?$db->select("newsletter", "", "DISTINCT email", ""):"";
if($user_type == "newsletter" or $user_type == "all"){
if(count_rows($result) > 0){
while($row = fetch_data($result)){
$email .= $row["email"] . ", ";
}
}
}

$result = ($user_type == "users" or $user_type == "all")?$db->select("register", "", "DISTINCT email", ""):"";
if($user_type == "users" or $user_type == "all"){
if(count_rows($result) > 0){
while($row = fetch_data($result)){
$email .= $row["email"] . ", ";
}
}
}

$email = substr($email,0,-2);
$email_array = explode(", ",$email);
$email_array = array_unique($email_array);
$email = "";
foreach($email_array as $val){
$email .= $val . ", ";
}
$email = substr($email,0,-2);

$to = "admin@quizmoneygame.com";
$message = "
<html>
<head>
<title>$subject</title>
</head>
<body>
<p><img src='{$directory}images/logo3.png'><br><br>Dear Customer,<br><br>{$message}</p><br><br><p>Regards,<br><br>Quiz Money Game Team,<br><br><a href='{$directory}'>quizmoneygame.com</a>.</p>
</body>
</html>
";
// Wraps $message value into new lines when it reaches 70 characters
$message = wordwrap($message,70);

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= "From: Quiz Money Game <noreply@quizmoneygame.com>" . "\r\n";
$headers .= "BCC: {$email}" . "\r\n";

$act = mail($to,$subject,$message,$headers);

if($act){
$_SESSION["success"] = "<div class='success'>Mail successfully sent.</div>";
redirect("");
}else{
$_SESSION["notSuccess"] = "<div class='notSuccess'>Error. Unable to send mail.</div>";
}

}
?>

           
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">Newsletter</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-left">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="/">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Newsletter</li>
                    </ol>
                    <div class="btn btn-blue pull-right"><a onClick="javascript:return confirm('Are you sure you want to log out?')" href="index.php?logout=1"><i class="fa fa-sign-out"></i> Logout</a></div>
                    <div class="clearfix"></div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        
                        <div class="row mbl">
                            <div class="col-lg-10">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-8">

 <?php
if(isset($_SESSION["success"]) && !isset($_POST["subject"])){
echo $_SESSION["success"];
unset($_SESSION["success"]);
}
if(isset($_SESSION["notSuccess"])){
echo $_SESSION["notSuccess"];
unset($_SESSION["notSuccess"]);
}
?>   

<h4>Send General Mail</h4>
<!-- Displays form for sending newsletter to recipients -->
<form action="" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
<ul style="list-style:none;">
<li style="padding-bottom:10px;">
<select name="user_type" id="user_type" class="form-control" required>
<option value=""> - - Select a recipient category - - </option>
<option value="all"<?php echo (isset($_POST["user_type"]) && $_POST["user_type"] == "all")?" selected":""; ?>>All Users</option>
<option value="newsletter"<?php echo (isset($_POST["user_type"]) && $_POST["user_type"] == "newsletter")?" selected":""; ?>>Only Newletter Subscribers</option>
<option value="users"<?php echo (isset($_POST["user_type"]) && $_POST["user_type"] == "users")?" selected":""; ?>>Only Registered Users</option>
</select>
</li>
<li style="padding-bottom:10px;">
<input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" value="<?php if(isset($_POST["subject"])){echo $_POST["subject"];} ?>" required title="Subject">
</li>
<li>
<textarea class="ckeditor"  id="message" name="message" required placeholder="Type your message" rows="3" cols="40" style="overflow: auto" ><?php if(isset($_POST["message"])){echo $_POST["message"];} ?></textarea>
</li>
<li style="text-align:right;">
<button class="btn" style="margin-top:10px;" name="send"><i class="fa fa-send"></i> Send</button>
</li>
</ul>
</form>

                                            </div>
                                            <div class="col-md-4">
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                             </div>  </div> 
    <div class="col-lg-2">
        <div class="portlet box prolet-primary">
            <div class="portlet-header">
            <div class="caption text-uppercase"> <i style="font-size: 17px; margin-top: 2px;" class="fa fa-envelope"></i>Newsletter</div>

            </div><br>
            <a href="newsletter.php" class="btn btn-blue">Newsletter</a><br><br>
        </div>
    </div>
    </div>
    
            </div>
        </div>
    </div>
    </div>
    </div>
    <!--END CONTENT-->
    </div>
<script src="text_plugin/ckeditor.js"></script>
    
<?php
require_once("footer.php");
?>