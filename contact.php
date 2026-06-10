<?php include_once('includes/header.php');  

$name = $subject = $message = $email = "";

$name = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["name"]))?test_input($_POST["name"]):$name;
$email = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["email"]))?test_input($_POST["email"]):$email;
$subject = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["subject"]))?test_input($_POST["subject"]):$subject;
$message = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["message"]))?test_input($_POST["message"]):$message;

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($subject) && !empty($message)){

$to = "admin@quizmoneygame.com";
$subject = $subject;

$message = "
<html>
<head>
<title>{$subject}</title>
</head>
<body>
<p><img src='{$directory}images/logo3.png'><br><br>{$message}</p>
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
$_SESSION["success"] = "<div class='success'>Your mail was successfully sent. Thank you.</div>";
redirect("");
}else{
$_SESSION["notSuccess"] = "<div class='not_success'>Error occured.</div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && (empty($name) or empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL) or empty($subject) or empty($message))){
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

<div class="section pt-70 pb-80">
			
				<div class="container">
				
			
						<div class="GridLex-gap-30">
						
							<div class="GridLex-grid-noGutter-equalHeight">

							    <div class="GridLex-col-2"></div>
										
								<div class="GridLex-col-8_sm-12_xs-12">
								
									<div class="user-action-item clearfix">
									
										<div class="icon">
											<i class="fa fa-edit"></i>
										</div>
										
										<div class="content">
										
											<h3 class="text-uppercase mb-20">PLEASE LEAVE US A MESSAGE </h3>

											<form role="form" action="" method="post">
												
												<label for="name">Your name</label>
													<div class="input-group">
													  <span class="input-group-addon" id="basic-addon3"><i class="fa fa-user"></i></span>
<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="name" id="name" placeholder="Name" required>
													</div>

													<label for="email">Email</label>
													<div class="input-group">
													  <span class="input-group-addon" id="basic-addon3"><i class="fa fa-envelope"></i></span>
<input type="email" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="email" id="email" placeholder="Email" required>
													</div>
                                                    
													<label for="subject">Subject</label>
													<div class="input-group">
													  <span class="input-group-addon" id="basic-addon3"><i class="fa fa-file-text"></i></span>
<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="subject" id="subject" placeholder="Subject" required>
													</div>

													<label for="message">Messsage</label>
													<div class="form-group">
<textarea class="form-control" placeholder="Enter your message" name="message" id="message" rows="10" required></textarea>
													</div>

													<div class="input-group">
													   <span class="input-group-addon" id="basic-addon3"><i class="fa fa-send"></i></span>
													  <input type="submit" class="form-control btn btn-primary" value="Send Message">
													</div>

											</form>

											
										</div>
									
									</div>
									
								</div>

								<div class="GridLex-col-2"></div>

							</div>
							
						</div>
						
				
				</div>
				
			</div>


<?php include_once('includes/footer.php'); ?>