<?php
 include 'inc/config.php';
 $id=$_GET['id'];
 $stat=$_GET['stat'];
 if($stat=="Blocked")
 {
	 $stat="Unblocked";
	 }
	 else
	 {
		 $stat="Blocked";
		 }
	 
 
$sql="UPDATE member SET status='$stat' WHERE id='$id'";
$result=$con->query($sql) or die("error: ".mysqli_error());
if($result)
{
	header("location:m_users.php");
	exit;
	}
		
		else
		{
	header("location:m_users.php");
	exit;

			}	 
			
			?>