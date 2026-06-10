<?php
session_start();
//include("proc/sec.php"); 
$_SESSION['background']="#004080";
include 'function.php';

if($_POST['submit'])
{
include '../config.php';

$user=mysqli_escape_string($con, stripslashes($_POST['user']));
$amt=mysqli_escape_string($con, stripslashes($_POST['amt']));
 
 $query=$con->query("SELECT * FROM users WHERE email='$user'");
 if($query)
 {
 $row=mysqli_fetch_array($query);
 $bal=$row['bal'];
 }
 

$bal=$bal+$amt;
$sql=$con->query("UPDATE users SET bal='$bal' WHERE email='$user'");
$display= "N".$amt ." has been added to ". $user ." Account balance.";
}

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


</head>

<body>
	<div id="wrapper">
    	<div id="header" style="background-color:white; border:solid; border-width:thin; border-color:#ACACAC;">
        	<?php Head(); ?>
        </div><!--header-->
        
        <div id="container" style="dbackground-color:#C3C3C3; min-height:600px;;">
        	<div id="containerLeft" style="background-color:#434343; height:400px; padding-left:0.1em;">
             	<?php	ContainerLeft(); ?>
            </div><!--containerLeft-->
            
           
            
            <div id="containerRight" style="background-color:white; min-height:200px; padding-left:5em; margin-left:0px; width:900px">
            	<div id="foo4" style="display:block; margin-top:0px; margin-left:0px; width:80%;">
                	<!--<h1 style="margin-top:10px; color:#004080; font-weight:100;"> &nbsp;&nbsp;WINAPRIZE Admin Panel<hr /></h1>-->
                 <div id="PlaceInfo" style="background-color:#C90; margin-bottom:10px; width:80%; color:white">Home / Fund Account </div>
                <p style="font-size:13px; font-weight:bold;"> <?php echo $display; ?> </p>
                 <form action="" method="post">
                   <table cellpadding="5" cellspacing="5" border="1" bordercolor="#EBEBEB" width="900px" style="margin-bottom:60px; dtext-align:center; margin-left:-50px; font-size:15px; font-weight:bold">
      
       <tr><td>User email: <td><input type="text" name="user" style="width:90%; height:25px; font-weight:bold; padding-left:0.5em;" placeholder="Username"/></td></tr>
        <tr><td>Amount :<td><input type="number" name="amt" style="width:90%; height:25px; font-weight:bold; padding-left:0.5em;" placeholder="Amount"/></td></tr>
        <tr><td><td><input type="submit" name="submit" value="Submit" style="width:150px; height:30px; cursor:pointer; border:none; color:white; font-weight:bold; background-color:#C90; padding-left:0.5em;" placeholder="Amount"/></td></tr>
        
               </table>
               </form>
                </div><!--foo4-->
            </div><!--containerRight-->
            <div id="clear"></div>
        </div><!--container-->
    </div><!--wrapper-->
</body>
</html>