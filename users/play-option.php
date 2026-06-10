<?php include_once("../includes/user_header.php");   

if(isset($_SESSION["questions_avail"]) && !empty($_SESSION["questions_avail"])){
redirect("fund-game.php");
}

if(isset($_REQUEST["play"]) && !isset($_SESSION["questions_avail"])){
$set_questions = $questions_attempted = $questions_avail = "";
$result = $db->select("question", "", "*", "");
if(count_rows($result)){
while($row = fetch_data($result)){
$id = $row["id"];
$set_questions .= "{$id},";
}
}
$set_questions = (!empty($set_questions))?substr($set_questions,0,-1):$set_questions;
$set_questions = (!empty($set_questions))?explode(",",$set_questions):$set_questions;
$questions_attempted = in_table("questions_attempted", "register", "WHERE email = '$user_email'", "questions_attempted");
$questions_attempted = (!empty($questions_attempted))?substr($questions_attempted,0,-1):$questions_attempted;
$questions_attempted = (!empty($questions_attempted))?explode(",",$questions_attempted):$questions_attempted;
$questions_avail = (!empty($set_questions) && !empty($questions_attempted))?array_diff($set_questions,$questions_attempted):$questions_avail;
$questions_avail = (!empty($set_questions) && empty($questions_attempted))?$set_questions:$questions_avail;

if(!empty($questions_avail) && $balance >= 100){
$db->query("UPDATE register SET balance = balance - 100 WHERE email = '{$user_email}'");
shuffle($questions_avail);
$_SESSION["questions_avail"] = $questions_avail;
unset($_SESSION["count"]);
unset($_SESSION["correct"]);
unset($_SESSION["wrong"]);
redirect("fund-game.php");
}else if($balance < 100){
message("You have less than N100 in your e-wallet");
redirect("play-option.php");
}else{
message("No questions available for now");
redirect("play-option.php");
}
}

//Free game
if(isset($_REQUEST["demo"])){
$set_questions = $questions_avail = "";
$result = $db->select("demo_questions", "", "*", "");
if(count_rows($result)){
while($row = fetch_data($result)){
$id = $row["id"];
$set_questions .= "{$id},";
}
}
$set_questions = (!empty($set_questions))?substr($set_questions,0,-1):$set_questions;
$questions_avail = (!empty($set_questions))?explode(",",$set_questions):$set_questions;

if(!empty($questions_avail)){
shuffle($questions_avail);
$_SESSION["demo_questions_avail"] = $questions_avail;
unset($_SESSION["demo_count"]);
unset($_SESSION["demo_correct"]);
unset($_SESSION["demo_wrong"]);
redirect("demo-game.php");
}else{
message("No questions available for now");
redirect("play-option.php");
}
}
?>

<script>
<!--
window.history.forward();
//-->
</script>

<div class="section pt-70 pb-80">

				<h3 class="text-uppercase mb-20 text-center">Select your game mode and start earning cash.</h3>
			
				<div class="container">
				
					<div class="user-action-wrapper">
			
						<div class="GridLex-gap-30">
						
							<div class="GridLex-grid-noGutter-equalHeight">
										
								<div class="GridLex-col-6_sm-6_xs-12">
								
									<div class="user-action-item clearfix">
									
										<div class="icon">
											<i class=" "><img src="../images/naira.png" style="padding-left: 132px;" /></i>
										</div>
										
										<div class="content">
										
											<h4 class="text-uppercase mb-20">Play with funded account mode.</h4>
											<p class="mb-25" style="text-align:left;">Questions in this mode are random from different categories. Once a player funds his account, he uses &#8358;100 to play. Immediately he starts playing, &#8358;100 is deducted from his e-wallet balance (i.e. his account balance on this portal). Once he fails 3 questions in this mode or quits the game, he looses his &#8358;100 and will have to continue playing with another &#8358;100 from his e-wallet balance. However, each question he gets gives him &#8358;10 which will be added immediately to his reward. Here he can win big.</p>

<?php if($balance >= 100){ ?><a onclick="javascript:return confirm('Are you sure you want to play with funded account?');" href="play-option.php?play=1" class="btn btn-primary">PLAY GAME</a><?php }else{ ?><a href="fund.php" class="btn btn-primary">FUND YOUR ACCOUNT TO CONTINUE</a><?php } ?>
											
										</div>
									
									</div>
									
								</div>
										
								<div class="GridLex-col-6_sm-6_xs-12">
								
									<div class="user-action-item clearfix">
									
										<div class="icon">
											<i class="fa fa-thumbs-o-up"></i>
										</div>
										
										<div class="content">
										
											<h4 class="text-uppercase mb-20">Play demo game mode</h4>
											<p class="mb-25" style="text-align:left;">In order to demonstrate how the game works, a demo page has been created. This guides you on how to play the game.</p>
											
											<a href="play-option.php?demo=1" class="btn btn-primary">DEMO GAME</a>
											
										</div>
									
									</div>
									
								</div>
								
							</div>
							
						</div>
						
					</div>
				
				</div>
				
			</div>


<?php include_once("../includes/user_footer.php"); ?>