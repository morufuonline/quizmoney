<header>
<div align="center">
 <div style="width:1024px;text-align:left;">
    <a href="index.php">	<!--<h1 style="color:#FFFFFF; font-size:24px">P.O. GINA SERVICES</h1>-->
        <p style="color:#FFFFFF; font-size:16px; margin-left:70px;">Control Panel</p>
    </a>
<?php
if(isset($_SESSION['admin'])){
	echo "<span style=\"float:right;display:block;margin:-20px 10px 10px 10px;width:60%;\" id=\"links\">
	<a href=\"index.php\">Admin Home</a>
	<a href=\"proc/logout.php\">Logout</a>
	
	</span>";	
}
?>
</div>
</div>
</header>