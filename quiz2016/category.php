<?php
require_once("server_header.php");

$category = $cid = $edit_category = "";
$search_result = $db->select("categories", "", "*", "ORDER BY id DESC");

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

$centerPages .= ($pn>1 && $lastPage>1)?"<a href=\"category.php?pn={$sub1}\">Previous</a>":"";
$centerPages .= ($sub4>0 && $add1>$lastPage && $lastPage>1)?"<a href=\"category.php?pn={$sub4}\">{$sub4}</a>":"";
$centerPages .= ($sub3>0 && $add2>$lastPage && $lastPage>1)?"<a href=\"category.php?pn={$sub3}\">{$sub3}</a>":"";
$centerPages .= ($sub2>0 && $lastPage>1)?"<a href=\"category.php?pn={$sub2}\">{$sub2}</a>":"";
$centerPages .= ($sub1>0 && $lastPage>1)?"<a href=\"category.php?pn={$sub1}\">{$sub1}</a>":"";
$centerPages .= ($lastPage>1)?"<a href=\"category.php?pn={$pn}\" class=\"current\">{$pn}</a>":"";
$centerPages .= ($add1<=$lastPage && $lastPage>1)?"<a href=\"category.php?pn={$add1}\">{$add1}</a>":"";
$centerPages .= ($add2<=$lastPage && $lastPage>1)?"<a href=\"category.php?pn={$add2}\">{$add2}</a>":"";
$centerPages .= ($sub2<1 && $add3<=$lastPage && $lastPage>1)?"<a href=\"category.php?pn={$add3}\">{$add3}</a>":"";
$centerPages .= ($sub1<1 && $add4<=$lastPage && $lastPage>1)?"<a href=\"category.php?pn={$add4}\">{$add4}</a>":"";
$centerPages .= ($pn<$lastPage && $lastPage>1)?"<a href=\"category.php?pn={$add1}\">Next</a>":"";

/////////////////////////////////////////////////////////////////////////////////////////////////


$category = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["category"]))?test_input($_POST["category"]):$category;
$edit_category = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["edit_category"]))?test_input($_POST["edit_category"]):$edit_category;
$cid = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["cid"]))?test_input($_POST["cid"]):$cid;

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($category)){

$result = $db->select("categories", "Where category = '{$category}'", "*", "");

if(count_rows($result) < 1){

$data_array = array(
"category" => "'$category'",
"date_time" => "'" . date("Y-m-d H:i:s") . "'"
);
$act = $db->insert($data_array, "categories");

if($act){
$_SESSION["success"] = "<div class='success' style='text-align:center;'>Category - $category was successfully added.</div>";
redirect("category.php?add=1&pn={$pn}");
}else{
$_SESSION["notSuccess"] = "<div class='not_success'>Error occured.</div>";
}

}else{
$_SESSION["notSuccess"] = "<div class='not_success'>Category already exists.</div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($edit_category) && !empty($cid)){

$data_array = array(
"category" => $edit_category
);
$act = $db->update($data_array, "categories", "id = '$cid'");

if($act){
$_SESSION["success"] = "<div class='success'>Category successfully updated.</div>";
redirect("category.php?pn={$pn}");
}else{
$_SESSION["notSuccess"] = "<div class='not_success'>Not successful. Error occured.</div>";
}

}


if(isset($_REQUEST["delete"]) && !empty($_REQUEST["delete"])){

$delete = "";
$delete = testQty($_REQUEST["delete"]);

$act = $db->delete("categories", " id='{$delete}'");

if($act){
$_SESSION["success"] = "<div class='success'>Category successfully deleted.</div>";
redirect("category.php");
}else{
$_SESSION["notSuccess"] = "<div class='not_success'>Not successful. Error occured.</div>";
}

}
?>
           
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">Categories</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-left">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="/">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Categories</li>
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
                                            <div class="col-md-8">
                                            
 <?php
if(isset($_SESSION["success"]) && !isset($_POST["category"]) && !isset($_POST["edit_category"]) && !isset($_REQUEST["delete"])){
echo $_SESSION["success"];
unset($_SESSION["success"]);
}
if(isset($_SESSION["notSuccess"])){
echo $_SESSION["notSuccess"];
unset($_SESSION["notSuccess"]);
}
?>   
<?php if(isset($_REQUEST["add"])){ ?>
<h4>Add a Category</h4>
<form action="" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
<input type="hidden" name="pn" value="<?php echo $pn; ?>">
<input type="text" name="category" placeholder="Enter a category" required class="form-control"><br>
<button class="btn btn-primary">Add Category</button>
</form>
<?php }else if(isset($_REQUEST["edit"])){ 
$edit = "";
$edit = testQty($_REQUEST["edit"]);
$category = in_table("category", "categories", "WHERE id = '$edit'", "category");
?>
<h4>Edit Category</h4>
<form action="" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
<input type="hidden" name="cid" value="<?php echo $edit; ?>">
<input type="hidden" name="pn" value="<?php echo $pn; ?>">
<input type="text" name="edit_category" placeholder="Enter a category" value="<?php echo $category; ?>" required class="form-control"><br>
<button class="btn btn-primary">Update Category</button>
</form>
<?php }else{ ?>
<table class="table table-striped">
<?php 
$c = 0;
if(count_rows($search_result) > 0){
?>
<thead><tr><th style="width:60px; text-align:center;">Cat ID</th><th>Category Name</th><th style="width:50px; text-align:center;"><i class="fa fa-pencil-square-o" aria-hidden="true" title="Edit Category"></i></th><th style="width:50px; text-align:center;"><i class="fa fa-times" aria-hidden="true" title="Delete Category"></i></th></tr></thead><tbody>
<?php
while($row = fetch_data($search_result)){
$c++;
if($c>$sub1*$per_view && $c<=$pn*$per_view){
$id = $row["id"];
$category = $row["category"];
?>
<tr><td style="text-align:center;"><?php echo $id; ?></td><td><?php echo $category; ?></td><td style="text-align:center;"><a href="category.php?edit=<?php echo $id; ?>&pn=<?php echo $pn; ?>" title="Edit <?php echo $category; ?> Category"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td><td style="text-align:center;"><a onClick="javascript:return confirm('Are you sure you want to delete <?php echo $category; ?> category?');" href="category.php?delete=<?php echo $id; ?>&pn=<?php echo $pn; ?>" title="Delete <?php echo $category; ?> Category"><i class="fa fa-times" aria-hidden="true"></i></a></td></tr>
<?php
}
}
echo "</tbody></table>";
echo ($lastPage>1)?"<div class=\"page_nos\">" . $centerPages . "</div>":"";
}else{
echo "<div class='not_success'>No categories found</div>";
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
            <div class="caption text-uppercase"> <i style="font-size: 17px; margin-top: 2px;" class="fa fa-comments"></i>Manage Categories</div>

            </div><br>
            <a href="category.php" class="btn btn-blue">Manage Categories</a><br><br>
            <a href="category.php?add=1" class="btn btn-blue">Add Category</a><br><br>

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