<?php include_once("../includes/user_header.php");  

$first_name = $last_name = $phone = $dob = $address = $state = "";

$first_name = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["first_name"]))?test_input($_POST["first_name"]):$first_name;
$last_name = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["last_name"]))?test_input($_POST["last_name"]):$last_name;
$phone = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["phone"]))?test_input($_POST["phone"]):$phone;
$dob = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["dob"]))?test_input($_POST["dob"]):$dob;
$address = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["address"]))?test_input($_POST["address"]):$address;
$state = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["state"]))?test_input($_POST["state"]):$state;

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($first_name) && !empty($last_name) && !empty($phone) && !empty($dob) && test_date($dob) && !empty($address) && !empty($state)){

$data_array = array(
"first_name" => $first_name,
"last_name" => $last_name,
"phone" => $phone,
"dob" => $dob,
"address" => $address,
"state" => $state
);
$act = $db->update($data_array, "register", "email = '{$user_email}'");

if($act){
$_SESSION["success"] = "<div class='success'>Account successfully updated.</div>";
redirect("index.php");
}else{
$_SESSION["notSuccess"] = "<div class='not_success'>Error occured.</div>";
}

}
if($_SERVER['REQUEST_METHOD'] == "POST" && (empty($first_name) or empty($last_name) or empty($phone) or empty($dob) or empty($address) or empty($state))){
message("Not successful! All fields are required");
}else if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($dob) && !test_date($dob)){
message("Not successful! Invalid date format");
}

$row = "";
$result = $db->select("register", "Where email = '" . $_SESSION["email"] . "'", "*", "");
if(mysql_num_rows($result) == 1){
$row = mysql_fetch_array($result);
?>

<link href="../css/jquery-ui.css" rel="stylesheet">
<script src="../js/jquery-ui.js"></script>

<div class="section pt-70 pb-80">
			
				<div class="container">
				
			
						<div class="GridLex-gap-30">
						
							<div class="GridLex-grid-noGutter-equalHeight">

							    <div class="col-lg-3 col-md-3 xol-sm-6"></div>
										
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								
									<div class="user-action-item clearfix">
									
										<div class="icon">
											<i class="fa fa-edit"></i>
										</div>
										
										<div class="content">
										
											<h3 class="text-uppercase mb-20">EDIT PROFILE </h3>

											<form action="" method="post">
												
												<label for="first_name">Firstname</label>
													<div class="form-group">
													 <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="<?php echo (isset($_POST["first_name"]))?$_POST["first_name"]:$row["first_name"]; ?>" required>
													</div>

													<label for="last_name">Lastname</label>
													<div class="form-group">
													<input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="<?php echo (isset($_POST["last_name"]))?$_POST["last_name"]:$row["last_name"]; ?>" required>
													</div>

													<label for="dob">DOB</label>
													<div class="form-group">
													<input type="text" name="dob" id="dob" onfocus="javascript: $(this).blur();" class="form-control" placeholder="Date of Birth" value="<?php echo (isset($_POST["dob"]))?$_POST["dob"]:$row["dob"]; ?>" required>
													</div>

													<label for="phone">Phone</label>
													<div class="form-group">
													<input type="text" name="phone" id="phone" class="form-control num" placeholder="Phone Number" value="<?php echo (isset($_POST["phone"]))?$_POST["phone"]:$row["phone"]; ?>" required>
													</div>

													<label for="address">Address</label>
													<div class="form-group">
													  <textarea class="form-control" placeholder="Address" name="address" id="address" rows="1" required><?php echo (isset($_POST["address"]))?$_POST["address"]:$row["address"]; ?></textarea>
													</div>

													<label for="state">State</label>
                                                    <div class="form-group">
												<select name="state" id="state" class="form-control" title="Select a state"  required>
<?php 
$result2 = $db->select("location", "", "DISTINCT state", "ORDER BY state ASC");
if(mysql_num_rows($result2) > 0){
while($row2 = mysql_fetch_array($result2)){
$state = $row2["state"];
echo "<option value='{$state}'";
echo ((isset($_POST["state"]) && $_POST["state"] == $state) or $row["state"] == $state)?" selected":"";
echo ">{$state}</option>";
}
}
?>
</select>
													</div>

													<div class="form-group" style="margin-top: 10px">
													   <input type="submit" class="form-control btn btn-primary" name="update" value="UPdate Profile">
													</div>

											</form>

											
										</div>
									
									</div>
									
								</div>

								<div class="col-lg-3 col-md-3 xol-sm-6"></div>

							</div>
							
						</div>
						
				
				</div>
				
			</div>

<script>
<!--
$(function() {

$( "#dob" ).datepicker({
dateFormat: "yy-mm-dd",
changeMonth: true,
changeYear: true,
yearRange: "1901:2100"
});

$(".num").keyup(function(){this.value = this.value.replace(/[^0-9.]/gi, "");}).change(function(){this.value = this.value.replace(/[^0-9.]/gi, "");});

});

//-->
</script>

<?php
}
 include_once("../includes/user_footer.php"); ?>