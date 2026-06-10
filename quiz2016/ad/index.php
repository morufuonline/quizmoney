<?php
session_start();
if(!isset($_SESSION['ad_entry']))
{
	header ("location:../");
	}
//include("proc/sec.php"); 
$_SESSION['background']="#004080";
include 'function.php';

	if(isset($_SESSION['background']))
	{
		$sess_bgcolor = $_SESSION['background'];
		$sess_bgcolor2 = $_SESSION['background'];
		$sess_bgcolor3 = $_SESSION['background'];
	}
	else {
		$sess_bgcolor = '#3c1414';
		$sess_bgcolor2 = '#4a8bc2';
		$sess_bgcolor3 = '#480607';
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
</head>

<body>
	<div id="wrapper">
    	<div id="header" style="background-color:white; border:solid; border-width:thin; border-color:#ACACAC;">
        	<?php Head(); ?>
        </div><!--header-->
        
        <div id="container" style="background-color:#D6D6D6; min-height:700px;">
        	<div id="containerLeft" style="background-color:#434343; min-height:500px;">
             	<?php	ContainerLeft(); ?>
            </div><!--containerLeft-->
            
            <div id="containerRight" style="background-color:white; min-height:100px">
            	<div id="foo4" style="display:block; margin-top:0px; margin-left:0px; height:400px; width:100%;">
                	<h1 style="margin-top:10px; color:#004080; font-weight:bold;"> &nbsp;&nbsp;&nbsp;&nbsp;Admin Panel</h1>
                    <div id="PlaceInfo" style="background-color:#C90; color:white; font-family:Verdana, Geneva, sans-serif; font-size:15px; font-weight:normal; height:30px;">HOME / SELECT OPTIONS </div>
                    
                   
                    <table cellpadding="10" cellspacing="10" style="margin-left:30px;">
                   <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="m_users.php"><img src="images/user.jpg" width="70px" height="70px"/><br /><br /><button style="background-color:#c90; color:white; border:none; border-radius:5px; width:150px; height:40px; cursor:pointer;">MANAGE USERS</button></a></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="toggle_visibility('foo');"><img src="images/game.jpg" width="70px" height="70px" /><br /><br /><button style="background-color:#c90; color:white; border:none; border-radius:5px; width:150px; height:40px; font-weight:bold; cursor:pointer;">ADD QUESTIONS</button></a></td><td>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="toggle_visibility('foo2');"><img src="images/Rules & Regulations1f.png" width="60px" height="60px" /><br /><br /><button style="background-color:#c90; color:white; border:none; border-radius:5px; width:150px; height:40px; font-weight:bold; cursor:pointer;">VIEW QUESTIONS</button></a></td>

<td>                   <!--<a href="m_sch.php"><img src="images/edit.png" width="70px" height="70px"/><br /><br /><button style="background-color:#004080; color:white; border:none; border-radius:5px; width:180px; height:40px; cursor:pointer;">MANAGE UNIVERSITIES</button></a></td><td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_poly.php"><img src="images/add2.jpg" width="70px" height="70px" /><br /><br /><button style="background-color:#004080; color:white; border:none; border-radius:5px; width:180px; height:40px; cursor:pointer;">ADD POLYTECHNICS</button></a></td><td>                   
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="m_poly.php"><img src="images/eidt2.png" width="70px" height="70px"/><br /><br /><button style="background-color:#004080; color:white; border:none; border-radius:5px; width:180px; height:40px; cursor:pointer;">MANAGE POLYTHENICS</button></a></td></tr>
<tr><td><td><td><td></td></td></td></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_course.php"><img src="images/add2.png" width="70px" height="70px" /><br /><br /><button style="background-color:#004080; color:white; border:none; border-radius:5px; width:180px; height:40px; cursor:pointer;">ADD COURSE</button></a></td>
<td>                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="m_course.php"><img src="images/edit3.jpg" width="70px" height="70px"/><br /><br /><button style="background-color:#004080; color:white; border:none; border-radius:5px; width:180px; height:40px; cursor:pointer;">MANAGE COURSES</button></a></td><td>                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="m_users.php"><img src="images/users.jpg" width="70px" height="70px"/><br /><br /><button style="background-color:#004080; color:white; border:none; border-radius:5px; width:180px; height:40px; cursor:pointer;">MANAGE USERS</button></a>--></td></tr>
</tr>
</div>
                    	<!--<div id="PlaceInfo2IN" style="background-color: <?php //echo $sess_bgcolor2; ?>;"><img src="images/gensetins.GIF" width="21" height="16" style="float:left; padding-right:10px;" />MY SETTINGS</div>
                        <div id="clear"></div>
                        <form action="responce.php" method="get">
                            <select name="background" style="color:#999; width:200px;">
                                <option style="display:none;" selected="selected" value="">color</option>
                                <option class="red" value="red">Red</option>
                                <option class="yellow" value="yellow">Yellow</option>
                                <option class="blue" value="#004080">Blue</option>
                                <option class="orange" value="orange">Orange</option>
                                <option class="purple" value="purple">Purple</option>
                                <option class="oxbloodred" value="#3c1414">OxBlood Red</option>
                                <option class="darkblue" value="#002953">Dark Blue</option>
                            </select>
                            <input type="submit" name="submit" value="Change" />
                        </form>
                    </div><!--PlaceInfo2-->
                </div><!--foo4-->
            </div><!--containerRight-->
            <div id="clear"></div>
        </div><!--container-->
    </div><!--wrapper-->
</body>
</html>