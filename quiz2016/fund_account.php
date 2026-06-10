<?php
require_once("server_header.php");

$where = $add = $email = $e_wallet = $sub = $reward = "";
$email = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["email"]))?test_input($_POST["email"]):$email;
$add = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["add"]))?testQty($_POST["add"]):$add;
$e_wallet = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["e_wallet"]))?test_input($_POST["e_wallet"]):$e_wallet;
$sub = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["sub"]))?testQty($_POST["sub"]):$sub;
$reward = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["reward"]))?testQty($_POST["reward"]):$reward;
$where = (!empty($email))?"WHERE email LIKE '%{$email}%'":$where;
$search_result = $db->select("register", "$where", "*", "ORDER BY id ASC");

/////////////////////////////////////////////////////////////////////////////////////////////////

$count = count_rows($search_result);

$pn = (isset($_REQUEST["pn"]))?preg_replace("#[^0-9]#i", "", $_REQUEST["pn"]):1;

$total = $count;
$per_view = 50;

$lastPage = ceil($total / $per_view);

if ($pn < 1) {
$pn = 1;
} else if ($pn > $lastPage) {
$pn = $lastPage;
}

$centerPages = "";
$sub4 = $pn - 4;
$sub3 = $pn - 3;
$sub1 = $pn - 1;
$sub2 = $pn - 2;
$add1 = $pn + 1;
$add2 = $pn + 2;
$add3 = $pn + 3;
$add4 = $pn + 4;

$centerPages .= ($pn>1 && $lastPage>1)?"<a href=\"fund_account.php?pn={$sub1}\">Previous</a>":"";
$centerPages .= ($sub4>0 && $add1>$lastPage && $lastPage>1)?"<a href=\"fund_account.php?pn={$sub4}\">{$sub4}</a>":"";
$centerPages .= ($sub3>0 && $add2>$lastPage && $lastPage>1)?"<a href=\"fund_account.php?pn={$sub3}\">{$sub3}</a>":"";
$centerPages .= ($sub2>0 && $lastPage>1)?"<a href=\"fund_account.php?pn={$sub2}\">{$sub2}</a>":"";
$centerPages .= ($sub1>0 && $lastPage>1)?"<a href=\"fund_account.php?pn={$sub1}\">{$sub1}</a>":"";
$centerPages .= ($lastPage>1)?"<a href=\"fund_account.php?pn={$pn}\" class=\"current\">{$pn}</a>":"";
$centerPages .= ($add1<=$lastPage && $lastPage>1)?"<a href=\"fund_account.php?pn={$add1}\">{$add1}</a>":"";
$centerPages .= ($add2<=$lastPage && $lastPage>1)?"<a href=\"fund_account.php?pn={$add2}\">{$add2}</a>":"";
$centerPages .= ($sub2<1 && $add3<=$lastPage && $lastPage>1)?"<a href=\"fund_account.php?pn={$add3}\">{$add3}</a>":"";
$centerPages .= ($sub1<1 && $add4<=$lastPage && $lastPage>1)?"<a href=\"fund_account.php?pn={$add4}\">{$add4}</a>":"";
$centerPages .= ($pn<$lastPage && $lastPage>1)?"<a href=\"fund_account.php?pn={$add1}\">Next</a>":"";

/////////////////////////////////////////////////////////////////////////////////////////////////

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($add) && !empty($e_wallet)){

$act = $db->query("UPDATE register SET balance = balance + $e_wallet, account_type = '1' WHERE id = '{$add}'");

if($act){
$_SESSION["success"] = "<div class='success'>E-Wallet successfully funded.</div>";
redirect("fund_account.php?pn={$pn}");
}else{
$_SESSION["notSuccess"] = "<div class='not_success'>Error occured.</div>";
}

}


if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($sub) && !empty($reward)){

$act = $db->query("UPDATE register SET earned = earned - $reward WHERE id = '{$sub}'");

if($act){
$_SESSION["success"] = "<div class='success'>Earned amount successfully withdrawn.</div>";
redirect("fund_account.php?pn={$pn}");
}else{
$_SESSION["notSuccess"] = "<div class='not_success'>Error occured.</div>";
}

}
?>

<style>
<!--
.table a{
display:block;
background:#966;
color:#fff;
padding:5px;
text-align:center;
border:1px solid #966;
}
.table a:hover{
background:#fff;
color:#966;
}
form{
background:#eee; 
padding:10px;
}
-->
</style>           
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">Fund an Account</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-left">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="/">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Fund an Account</li>
                    </ol>
                    <div class="btn btn-blue pull-right"><a onClick="javascript:return confirm('Are you sure you want to log out?')" href="index.php?logout=1"><i class="fa fa-sign-out"></i> Logout</a></div>
                    <div class="clearfix"></div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        
                        <div class="row mbl">
                            <div class="col-lg-10">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                            
 <?php
if(isset($_SESSION["success"]) && !isset($_POST["add"]) && !isset($_POST["sub"])){
echo $_SESSION["success"];
unset($_SESSION["success"]);
}
if(isset($_SESSION["notSuccess"])){
echo $_SESSION["notSuccess"];
unset($_SESSION["notSuccess"]);
}
?>   
<?php if(isset($_REQUEST["add"])){ 

$add = "";
$add = testQty($_REQUEST["add"]);
$u_id = in_table("user_id", "register", "WHERE id = '$add'", "user_id");
$first_name = in_table("first_name", "register", "WHERE id = '$add'", "first_name");
$last_name = in_table("last_name", "register", "WHERE id = '$add'", "last_name");
$full_name = $first_name . " " . $last_name;
$email = in_table("email", "register", "WHERE id = '$add'", "email");
$balance = in_table("balance", "register", "WHERE id = '$add'", "balance");
?>
<h4>Fund E-Wallet</h4>
<form action="" method="post" runat="server" autocomplete="off">
<input type="hidden" name="add" value="<?php echo $add; ?>">
<table class="table table-striped">
<tbody>
<tr><td style="width:150px;"><b>User ID</b></td><td><?php echo $u_id; ?></td></tr>
<tr><td><b>Full Name</b></td><td><?php echo $full_name; ?></td></tr>
<tr><td><b>Email</b></td><td><?php echo $email; ?></td></tr>
<tr><td><b>Current Balance</b></td><td>&#8358;<?php echo formatNumber($balance); ?></td></tr>
</tbody>
</table>
<input type="text" name="e_wallet" placeholder="Enter amount to add" required class="form-control"><br>
<button class="btn btn-success">Add to E-Wallet</button>
</form>

<?php }else if(isset($_REQUEST["sub"])){ 

$sub = "";
$sub = testQty($_REQUEST["sub"]);
$u_id = in_table("user_id", "register", "WHERE id = '$sub'", "user_id");
$first_name = in_table("first_name", "register", "WHERE id = '$sub'", "first_name");
$last_name = in_table("last_name", "register", "WHERE id = '$sub'", "last_name");
$full_name = $first_name . " " . $last_name;
$email = in_table("email", "register", "WHERE id = '$sub'", "email");
$earned = in_table("earned", "register", "WHERE id = '$sub'", "earned");
?>
<h4>Withdraw from Earned Reward</h4>
<form action="" method="post" runat="server" autocomplete="off">
<input type="hidden" name="sub" value="<?php echo $sub; ?>">
<table class="table table-striped">
<tbody>
<tr><td style="width:150px;"><b>User ID</b></td><td><?php echo $u_id; ?></td></tr>
<tr><td><b>Full Name</b></td><td><?php echo $full_name; ?></td></tr>
<tr><td><b>Email</b></td><td><?php echo $email; ?></td></tr>
<tr><td><b>Total Earned</b></td><td>&#8358;<?php echo formatNumber($earned); ?></td></tr>
</tbody>
</table>
<input type="number" name="reward" placeholder="Enter amount to withdraw" required class="form-control"><br>
<button class="btn btn-primary">Withdraw</button>
</form>

<?php }else{ 
$c = 0;
if($count > 0){
?>

<h4>Search for a User via Email</h4>
<form action="" method="post" runat="server" autocomplete="off">
<input type="text" name="email" placeholder="Enter user&#039;s email" value="" class="form-control"><br>
<button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
</form>

<table class="table table-striped">
<thead><tr><th style="width:30px; text-align:center;">S/N</th>
<th>User ID</th>
<th>Full Name</th>
<th>Email</th>
<th>Earned Amount (&#8358;)</th>
<th>E-Wallet Balance (&#8358;)</th></tr></thead><tbody>
<?php
while($row = fetch_data($search_result)){
$c++;
if($c>$sub1*$per_view && $c<=$pn*$per_view){
$id = $row["id"];
$user_id = $row["user_id"];
$full_name = $row["first_name"] . " " . $row["last_name"];
$email = $row["email"];
$earned = $row["earned"];
$balance = $row["balance"];
?>
<tr><td style="text-align:center;"><?php echo $c; ?></td>
<td><?php echo $user_id; ?></td>
<td><?php echo $full_name; ?></td>
<td><?php echo $email; ?></td>
<td><a href="fund_account.php?sub=<?php echo $id; ?>&pn=<?php echo $pn; ?>" title="Withdraw Earned Amount"><?php echo formatNumber($earned); ?></a></td>
<td><a href="fund_account.php?add=<?php echo $id; ?>&pn=<?php echo $pn; ?>" title="Add to balance"><?php echo formatNumber($balance); ?></a></td></tr>
<?php
}
}
echo "</tbody></table>";
echo ($lastPage>1)?"<div class=\"page_nos\">" . $centerPages . "</div>":"";
}else{
echo "<div class='not_success'>No users found.</div>";
}

} ?>

                                            </div>
                                            <div class="col-md-4">
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                             </div>  </div> 
    <div class="col-lg-2">
        <div class="portlet box prolet-primary">
            <div class="portlet-header">
                <div class="caption text-uppercase"> <i style="font-size: 17px; margin-top: 2px;" class="fa fa-comments"></i>Fund Account</div>
                    

            </div><br>
            <a href="fund_account.php" class="btn btn-blue">View Accounts</a><br><br>
        </div>
    </div>
    </div>
    
            </div>
        </div>
    </div>
    </div>
    </div>
    <!--END CONTENT-->
    </div>
<?php
require_once("footer.php");
?>