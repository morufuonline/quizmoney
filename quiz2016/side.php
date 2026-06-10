 <ul id="side-menu" class="nav">
                        <li class="user-panel">
                                <img src="../images/logo3.jpg" style="max-width:100%; height:auto;">
                            <div class="clearfix"></div>
                        </li>
                        <li class="<?php echo (basename($_SERVER["PHP_SELF"]) == "index.php")?"active":""; ?>"><a href="index.php"><i class="fa fa-tachometer fa-fw"><div class="icon-bg bg-orange"></div></i><span class="menu-title">Dashboard</span></a>
                        </li>
                        <li><a href="javascript:void(0);"><i class="fa fa-university fa-fw"><div class="icon-bg bg-orange"></div></i><span class="menu-title">Manage Users</span><span class="fa arrow"></span><span class="label label-violet"></span></a>
                          <ul class="nav nav-second-level collapse">
                                <li class="<?php echo (basename($_SERVER["PHP_SELF"]) == "manage-users.php")?"active":""; ?>"><a href="manage-users.php"><i class="fa fa-rocket"></i><span class="submenu-title">List of  Users</span></a>
                               </li>
                            </ul>
                        </li>
                         <li class="<?php echo (basename($_SERVER["PHP_SELF"]) == "questions_submitted.php")?"active":""; ?>"><a href="questions_submitted.php"><i class="fa fa-question-circle"><div class="icon-bg bg-orange"></div></i><span class="menu-title">Questions Submitted</span></a>
                        </li>  
                        <li><a href="javascript:void(0);"><i class="fa fa-language fa-fw"><div class="icon-bg bg-pink"></div></i><span class="menu-title">Manage Categories</span><span class="fa arrow"></span><span class="label label-yellow"></span></a>
<ul class="nav nav-second-level collapse">
<li class="<?php echo (basename($_SERVER["PHP_SELF"]) == "category.php")?"active":""; ?>"><a href="category.php"><i class="fa fa-rocket"></i> <span class="submenu-title">View Categories</span></a></li>
<li class="<?php echo (basename($_SERVER["PHP_SELF"]) == "category.php")?"active":""; ?>"><a href="category.php?add=1"><i class="fa fa-rocket"></i> <span class="submenu-title">Add Category</span></a></li>
</ul>
</li>
<li><a href="javascript:void(0);"><i class="fa fa-language fa-fw"><div class="icon-bg bg-pink"></div></i><span class="menu-title">Manage Questions</span><span class="fa arrow"></span><span class="label label-yellow"></span></a>
<ul class="nav nav-second-level collapse">
<?php 
$result = $db->select("categories", "", "*", "ORDER BY category ASC");
if(mysql_num_rows($result) > 0){
while($row = mysql_fetch_array($result)){
$id = $row["id"];
$category = $row["category"];
echo "<li><a href='questions.php?add_cat={$id}'><i class='fa fa-rocket'></i> <span class='submenu-title'>{$category}</span></a></li>";
}
}
?>
</ul>
                           
                        </li>
                        <li><a href="javascript:void(0);"><i class="fa fa-book fa-fw"><div class="icon-bg bg-pink"></div></i><span class="menu-title">Manage Funds</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                 <li class="<?php echo (basename($_SERVER["PHP_SELF"]) == "fund_account.php")?"active":""; ?>"><a href="fund_account.php"><i class="fa fa-align-left"></i><span class="submenu-title">Fund An Account</span></a></li>
                            </ul>
                        </li>
                         <li class="<?php echo (basename($_SERVER["PHP_SELF"]) == "newsletter.php")?"active":""; ?>"><a href="newsletter.php"><i class="fa fa-envelope"><div class="icon-bg bg-orange"></div></i><span class="menu-title">Newsletter</span></a>
                        </li> 
                         <li class="<?php echo (basename($_SERVER["PHP_SELF"]) == "change_password.php")?"active":""; ?>"><a href="change_password.php"><i class="fa fa-lock"><div class="icon-bg bg-orange"></div></i><span class="menu-title">Change Password</span></a>
                        </li>                      
                    </ul>