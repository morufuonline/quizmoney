<?php
session_start();
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
                    <div id="PlaceInfo" style="background-color:#C90; margin-bottom:10px; width:80%; color:white">Home / Manage Users </div>  <table cellpadding="5" cellspacing="5" border="1" bordercolor="#EBEBEB" width="900px" style="margin-bottom:60px; text-align:center; margin-left:-50px; font-size:15px; font-weight:bold">
              <th>S/N</th>
              <th>Fullname</th>
              <th>Email</th>
              <th>Phone No</th>
              <th>D.O.B</th>
              <th>Address</th>
              <th>State</th>
               <th>Balance</th>
                <th>Block</th>
               <?php
	  
	  include '../config.php';
	  $i=0;
	  $sql="SELECT * FROM users ORDER BY fname ASC";
	  $result=$con->query($sql);
	  if($result)
	  {	
	  while($row=mysqli_fetch_array($result))
{	 
		  $i++;
		  $id=$row['id'];
		  $fname=$row['fname'];
		  $lname=$row['lname'];
		  $email=$row['email'];
		 $day=$row['day'];
		  $month=$row['month'];
		  $year=$row['year'];
		  $phone=$row['phone'];
	 $state=$row['state'];
		  $add=$row['address'];
		   $bal=$row['bal'];
	
	?>
     <tr><td><?php echo $i."."; ?><td><?php echo $fname." ".$lname; ?><td><?php echo $email; ?><td><?php echo $phone; ?><td><?php echo $day."-".$month."-".$year; ?><td><?php echo $add; ?><td><?php echo $state; ?></td><td>N<?php echo $bal; ?></td><td><a href="edit_q.php?id=<?php echo $id; ?>&cat=<?php echo $cat; ?>"><button style="background-color:#c90; color:white; border-radius:5px;ppadding:1em; border:none; width:50px;">Block</button></a></td></td></td></td></td></td></td></tr>
    <?php
	  }
	  }
		?>
       
               
                </div><!--foo4-->
            </div><!--containerRight-->
            <div id="clear"></div>
        </div><!--container-->
    </div><!--wrapper-->
</body>
</html>