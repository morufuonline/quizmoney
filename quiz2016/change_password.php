<?php
require_once("server_header.php");

$password = $conf_password = "";

$password = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["password"]))?test_input($_POST["password"]):$password;
$conf_password = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["conf_password"]))?test_input($_POST["conf_password"]):$conf_password;

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($password) && !empty($conf_password) && $password == $conf_password){

$password = sha1($password);

$data_array = array(
"password" => $password
);
$act = $db->update($data_array, "admin", "user_id = '$user_id'");

if($act){
$_SESSION["success"] = "<div class='success'>Password successfully updated.</div>";
redirect("");
}else{
$_SESSION["notSuccess"] = "<div class='not_success'>Not successful. Error occured.</div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && (empty($password) or empty($conf_password))){
message("All fields must be appropriately field");
}else if($_SERVER['REQUEST_METHOD'] == "POST" && $password != $conf_password){
message("Passwords do not match");
}
?>
           
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">Change your Password</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-left">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="/">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Change your Password</li>
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
if(isset($_SESSION["success"]) && !isset($_POST["password"])){
echo $_SESSION["success"];
unset($_SESSION["success"]);
}
if(isset($_SESSION["notSuccess"])){
echo $_SESSION["notSuccess"];
unset($_SESSION["notSuccess"]);
}
?>   

<h4>Change your Password</h4>
<form action="" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
<input type="password" name="password" placeholder="Enter your new password" required class="form-control"><br>
<input type="password" name="conf_password" placeholder="Re-enter your new password" required class="form-control"><br>
<button class="btn btn-primary">Change</button>
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
            <div class="caption text-uppercase"> <i style="font-size: 17px; margin-top: 2px;" class="fa fa-lock"></i>Change Password</div>

            </div><br>
            <a href="change_password.php" class="btn btn-blue">Reset Your Passsword</a><br><br>
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
    
<?php
require_once("footer.php");
?>