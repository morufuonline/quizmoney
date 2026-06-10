<?php include_once("../includes/user_header.php"); ?>
<?php
$row = "";
$result = $db->select("register", "Where email = '{$user_email}'", "*", "");
if(count_rows($result) == 1){
$row = fetch_data($result);
$file_array = glob("../images/users_upload/{$user_id}pic*.jpg");
$file_name = ($file_array)?$file_array[0]:"";
?>
<style type="text/css">
</style>
<div class="container">
<?php 
//Starts Picture Upload
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_FILES["ufile"]["tmp_name"])){

$fileName = $_FILES["ufile"]["name"]; 
$fileTmpLoc = $_FILES["ufile"]["tmp_name"];
$fileType = $_FILES["ufile"]["type"];
$fileSize = $_FILES["ufile"]["size"];
$fileErrorMsg = $_FILES["ufile"]["error"];
$kaboom = explode(".", $fileName);
$fileExt = end($kaboom);

if (!$fileTmpLoc) {
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
} elseif($fileSize > 5242880) { // if file size is larger than 5 Megabytes
    echo "ERROR: Your file was larger than 5 Megabytes in size.";
    unlink($fileTmpLoc);
    exit();
} elseif (!preg_match("/.(gif|GIF|jpg|JPG|png|PNG|pjpeg|PJPEG)$/i", $fileName) ) {
     echo "ERROR: Your image was not .gif, .jpg, or .png.";
     unlink($fileTmpLoc);
     exit();
} elseif ($fileErrorMsg == 1) {
    echo "ERROR: An error occured while processing the file. Try again.";
    exit();
}

foreach (glob("../images/users_upload/{$user_id}pic*.jpg") as $filename) {
unlink($filename);
}

$file_name = "{$user_id}pic" . rand() . ".jpg";
$moveResult = move_uploaded_file($fileTmpLoc, "../images/users_upload/" . $file_name);
if ($moveResult != true) {
    echo "ERROR: File not uploaded. Try again.";
    unlink($fileTmpLoc);
    exit();
}

include_once("../includes/resize_image.php");

$target_file = "../images/users_upload/" . $file_name;
$resized_file = $target_file;
ak_img_resize($target_file, $resized_file, $fileExt, 200, 200);

$_SESSION["success"] = "<div class='success'>Picture successfully updated.</div>";
redirect("index.php");
}
//Ends Picture Upload

//////////Forgot Password////////////////////////////
$password = "";

$password = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["password"]))?test_input($_POST["password"]):$password;

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($password)){

$password = sha1($password);

$fid = $db->query("UPDATE register SET password = '$password' WHERE email = '{$user_email}'");

if($fid){
$_SESSION["success"] = "<div class='success'>Password successfully changed.</div>";
redirect("index.php");
}else{
$_SESSION["notSuccess"] = "<div class='not_success'>Error occured. Password could not be reset.</div>";
}

}

 ?> 
					<div class="GridLex-gap-30" style="margin: 20px 0px;">
<?php
if(isset($_SESSION["success"]) && !isset($_FILES["ufile"]) && !isset($_POST["password"])){
echo $_SESSION["success"];
unset($_SESSION["success"]);
}
if(isset($_SESSION["notSuccess"])){
echo $_SESSION["notSuccess"];
unset($_SESSION["notSuccess"]);
}
?>
					
						<div class="GridLex-grid-noGutter-equalHeight" style="margin-top: 3em;">
									
							<div class="col-md-4 col-sm-4 col-xs-12">
							
								<div class="process-item clearfix">
								<p class="text-center">
<img src="<?php echo ($file_name != "")?$file_name:"../images/avatar.png"; ?>" class="passport">	
  <form  action="" method="post" id="profile_img" enctype="multipart/form-data" style="margin-top:10px;">
  <div class="form-group input-group">
  <span class="input-group-addon"><label for="ufile" class="btn btn-danger">Change Picture</label></span>
  <input type="file" name="ufile" id="ufile" style="opacity:0.0; filter:alpha(opacity=0); width:1px; height:1px;" />
  </div>
  </form>
				
								</p>
	
<p class="text-center"> 
<form  action="" method="post" style="margin-top:10px;">   
<table class="table table-striped table-hover">
<tbody>
<tr>
<td>
<div class="form-group">
<input type="password" name="password" id="password" class="form-control" value="" required />
</div>
<input type="submit" id="sub_pass" value="Reset Password" class="btn btn-danger">
</td>
</tr>
</tbody>
</table>  
</form>  
</p>    								
								</div>
							
							</div>
							
							<div class="col-md-4 col-sm-4 col-xs-12">
							
								<div class="process-item clearfix">
									<div id="content">
										<h5 class="text-center text-main">Game Statistics</h5>

										<span class="col-sm-6 col-xs-12 well" style="color:#fff; text-align:center;">Correct Answer(s): <br><b><?php echo(isset($_SESSION["correct"]))?$_SESSION["correct"]:0; ?></b></span>
										<span class="col-sm-6 col-xs-12 well" style="color:#fff; text-align:center;">Wrong Answer(s): <br><b><?php echo(isset($_SESSION["wrong"]))?$_SESSION["wrong"]:0; ?></b></span>
										<h6 class="text-center">Earnings</h6>
										<p class="text-center">Account Balance: <b>&#8358;<?php echo formatNumber($balance); ?></b></p>
										<p class="text-center">Amount Earned: <b>&#8358;<?php echo formatNumber($earned); ?></b></p>
										<p class="text-center"><a href="play-option.php"><button class="btn btn-danger" style="margin:10px 0px;">Play Game</button></a>
										<a href="fund.php"><button class="btn btn-danger">Fund account</button></a></p>
									</div>
									
								</div>
								
							</div>
							
							<div class="col-sm-4 col-md-4 col-xs-12">
							
										<div id="content">
										<h5 class="text-center" style="text-align: center; color: #314c82">Profile Details</h5>
<table class="table table-striped">
<tbody>
<tr>
<td style="width:120px;"><b>User ID</b></td>
<td><?php echo $row[1]; ?></td>
</tr>
<tr>
<td><b>Full Name</b></td>
<td><?php echo $row[2] . " " . $row[3]; ?></td>
</tr>
<tr>
<td><b>Date of Birth</b></td>
<td><?php echo date_format(date_create($row[5]),"l, jS F, Y"); ?></td>
</tr>
<tr>
<td><b>Phone Number</b></td>
<td><?php echo $row[4]; ?></td>
</tr>
<tr>
<td><b>Email Address</b></td>
<td><?php echo $row[7]; ?></td>
</tr>
<tr>
<td><b>Address</b></td>
<td><?php echo $row[6]; ?></td>
</tr>
<tr>
<td colspan="2" style="text-align:center;"><a class="btn btn-success" href="edit.php">Edit profile</a></td>
</tr>
</tbody>
</table>

										</div>
										
									</div>

									
							</div>
							
						</div>
						
					</div>
				
				</div>
                
<script>
<!--
$(document).ready(function(){

$("form#profile_img input#ufile").change(function(){
$("form#profile_img").submit();
});

});
//-->
</script>

<?php
} include_once("../includes/user_footer.php"); ?>