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

if(isset($_REQUEST["count_time"])){
$_SESSION["count_time"] = $_REQUEST["count_time"];
}

if(isset($_SESSION["questions_avail"]) && !empty($_SESSION["questions_avail"]) && isset($_REQUEST["this_value"]) && isset($_REQUEST["q_num"])){

$this_value = $q_num = "";

$email = $_SESSION["email"];
$this_value = test_input($_REQUEST["this_value"]);
$q_num = testQty($_REQUEST["q_num"]);

$result = in_table("answer", "question", "WHERE id = '{$q_num}'", "answer");
$description = in_table("description", "question", "WHERE id = '{$q_num}'", "description");

if($result == $this_value){
$_SESSION["correct"] += 1;
$_SESSION["count"] += 1;
$_SESSION["count_time"] = 60;
?>
<span style="color:#090; font-size:30px;" class="result_blink">Correct Answer!</span>
<?php
$db->query("UPDATE register SET earned = earned + 10 WHERE email = '{$email}'");
}else{
$_SESSION["wrong"] += 1;
$_SESSION["count"] += 1;
$_SESSION["count_time"] = 60;
?>
<span style="color:#f00; font-size:30px;" class="result_blink">Wrong Answer!</span>
<?php 
}

$questions_attempted = in_table("questions_attempted", "register", "WHERE email = '$email'", "questions_attempted");
$questions_attempted = (!empty($questions_attempted))?"{$questions_attempted}{$q_num},":"{$q_num},";
$db->query("UPDATE register SET questions_attempted = '{$questions_attempted}' WHERE email = '{$email}'");
$q_num = explode(",","{$q_num},");
$questions_avail = $_SESSION["questions_avail"];
$questions_avail = array_diff($questions_avail,$q_num);
shuffle($questions_avail);
$_SESSION["questions_avail"] = $questions_avail;
?>
<div class="answer_description"><?php echo $description; ?></div>
<script>
<!--
function toggle_note(){
if($(".result_blink").css("visibility") == "visible"){
$(".result_blink").css({"visibility":"hidden"});
}else{
$(".result_blink").css({"visibility":"visible"});
}
}
setInterval("toggle_note()", 600);
//-->
</script>
<?php
}
?>