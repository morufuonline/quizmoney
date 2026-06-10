<?php
session_start();
if(!isset($_SESSION['ad_entry']))
{
		header ("location:../");
}
	if($_POST['submit'])
{
include '../config.php';

$ques=mysqli_escape_string($con, stripslashes($_POST['ques']));
$ans=mysqli_escape_string($con, stripslashes($_POST['ans']));
$hint=mysqli_escape_string($con, stripslashes($_POST['hint']));
$cat=mysqli_escape_string($con, stripslashes($_POST['cat']));
$opt1=mysqli_escape_string($con, stripslashes($_POST['opt1']));
$opt2=mysqli_escape_string($con, stripslashes($_POST['opt2']));
$opt3=mysqli_escape_string($con,stripslashes($_POST['opt3']));
$opt4=mysqli_escape_string($con, stripslashes($_POST['opt4']));
//$add=mysqli_escape_string($con, stripslashes($_POST['address']));

//$sql1=$con->query("SELECT MAX(num) AS maxid FROM question");
//$row=mysqli_fetch_assoc($sql1);
//$q_id=$row['maxid']+1;
$id=$_POST['id'];

$sql=$con->query("UPDATE question SET  question='$ques', answer='$ans', option1='$opt1', option2='$opt2', option3='$opt3', option4='$opt4', hint='$hint' WHERE id='$id'")or die("Mysql error:".mysql_error($con));
if($sql)
{
	$up_error="Question Updated Successfully";
	}
}
//include("proc/sec.php"); 

//include("proc/sec.php"); 
$_SESSION['background']="#004080";
include 'function.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin</title>
<link rel="stylesheet" href="css/styles.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/toggle.js"></script>
<style type="text/css">
</style>
</script>
<script type="text/javascript">
$(document).ready(function() {
	function readURL(input)
{
	 var fname = $('#imageInput')[0].files[0].name; // get file name
	 $("#show").empty();
	 // $("#show").append(fname);

	
if(input.files && input.files[0])
{
	var reader = new FileReader()
	
	reader.onload = function(e)
	{
		$('#blah').attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}
$("#imageInput").change(function(){
	readURL(this);
	})
</script>


</head>

<body>
	<div id="wrapper">
    	<div id="header" style="background-color:white; border:solid; border-width:thin; border-color:#ACACAC;">
        	<?php Head(); ?>
        </div><!--header-->
        
        <div id="container" style="dbackground-color:#C3C3C3; min-height:900px;;">
        	<div id="containerLeft" style="background-color:#434343; height:400px; padding-left:0.1em;">
             	<?php	ContainerLeft(); ?>
            </div><!--containerLeft-->
            
         
         <?php
		 include '../config.php';
		 $id=$_GET['id'];
		 $query1=$con->query("SELECT * FROM question WHERE id='$id'") or die("Error: ".mysqli_error($con));
		 
		 if($query1) 
		 {
			 $rows=mysqli_fetch_array($query1);
			 
			 $ques=$rows['question'];
			  $answer=$rows['answer'];
			   $opt1=$rows['option1'];
			    $opt2=$rows['option2'];
				$opt3=$rows['option3'];
			    $opt4=$rows['option4'];
				$hint=$rows['hint'];
			   
			 }
			 
            ?>
            <div id="containerRight" style="background-color:white; min-height:200px; padding-left:5em; margin-left:0px; width:900px">
            	<div id="foo4" style="display:block; margin-top:0px; margin-left:0px; margin-bottom:50px; width:80%;">
                	<!--<h1 style="margin-top:10px; color:#004080; font-weight:100;"> &nbsp;&nbsp;WINAPRIZE Admin Panel<hr /></h1>-->
                    <div id="PlaceInfo" style="background-color:#C90; margin-bottom:10px; width:80%; color:white">Home / EDIT QUESTION </div>
                  <form name="add_question" action="#" method="post">
                  <input type="hidden" name="id" value="<?php echo $id; ?>" />
                  <table cellpadding="5" cellspacing="5" bordercolor="#EBEBEB" width="800px" style="margin-bottom:60px; margin-left:-50px; font-size:15px; font-weight:bold">
              <tr><td><td><?php echo $up_error; ?></td></td></tr>
              <tr><td></td></tr>
              <!--<tr><td width="30%">School Photo<td><!--<img id="blah" src="#" alt=""  height="200" width="200"/>&nbsp;&nbsp;
<br />--><!--<input name="ImageFile" size="60" id="imageInput" type="file" accept="image/*" /></td></td></tr>-->
            <!--  <tr><td width="30%">Name<td><input type="text" name="name" required="required" style="width:500px; height:25px;" /></td></td></tr>
              <tr><td width="30%">Address<td><input type="text" name="address" required="required" style="width:500px; height:25px;" /></td></td></tr>-->
            <tr><td width="30%">Category<td> <select name="cat" style="width:500px; height:25px;">
<option><?php echo $_GET['cat']; ?></option>
</select>
</td></td></tr>
            <!--  <tr><td width="30%">School type<td> <select name="type" style="height:30px; width:500px; font-weight:bold;">
              <!-- <option>School Type</option>
              <option>Polytechnic</option>-->
            <!--  <option>University</option>
            </select>
       </td></td></tr>
              <tr><td width="30%">Category<td><select name="cat" style="height:30px; width:500px; font-weight:bold;">
               <option>Select Catagory</option>
              <option>State</option>
              <option>Federal</option>
              <option>Private Muslim</option>
              <option>Private Christain</option>
              <option>Private Others</option>
            </select>
       </td></td></tr>-->
        <!--<tr><td width="30%">Jamb Cut-off mark<td><input name="jamb" type="text" style="width:500px; height:25px;" /></td></td></tr>
         <tr><td width="30%">Post -utme cut off<td><input name="post" type="text" style="width:500px; height:25px;" /></td></td></tr>-->
         <!-- <tr><td width="30%">Courses Offered<td><textarea name="courses" style="width:500px; height:180px;" /></textarea></td></td></tr>-->
          <tr><td width="30%">Question<td><textarea name="ques" required="required" style="width:500px; height:120px;" /> <?php echo $ques; ?></textarea></td></td></tr>
          <tr><td width="30%">Option1<td><input type="text" name="opt1" required="required" style="width:490px; height:25px;" value="<?php echo $opt1; ?>" /></td></td></tr>
          <tr><td width="30%">Option2<td><input type="text" name="opt2" required="required" value="<?php echo $opt2; ?>" style="width:490px; height:25px;" /></td></td></tr>
          <tr><td width="30%">Option3<td><input type="text" name="opt3" required="required" value="<?php echo $opt3; ?>" style="width:490px; height:25px;" /></td></td></tr>
          <tr><td width="30%">Option4<td><input type="text" name="opt4" required="required"value="<?php echo $opt4; ?>" style="width:490px; height:25px;" /></td></td></tr>
           <tr><td width="30%">Hint<td><input type="text" name="hint" required="required" value="<?php echo $hint; ?>" style="width:490px; height:25px;" /></td></td></tr>
           <tr><td width="30%">Answer<td><input type="text" name="ans" required="required"value="<?php echo $answer; ?>" style="width:490px; height:25px;" /></td></td></tr>
           
           
          

                <!--  <tr><td width="30%">Address<td><input type="text" style="width:500px; height:25px;" /></td></td></tr>
         <tr><td width="30%">Contact details<td><input type="text" style="width:500px; height:25px;" /></td></td></tr>-->  
              <tr><td></td><td><input type="submit" value="Submit" name="submit" style="cursor:pointer; background-color:#C90; color:white; font-size:bold; font-size:15px; width:120px; height:25px; border-radius:5px; border:none" /></td></tr>

              </table>

                </div><!--foo4-->
            </div><!--containerRight-->
            <div id="clear"></div>
        </div><!--container-->
    </div><!--wrapper-->
</body>
</html>