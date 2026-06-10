<?php
require_once("server_header.php");

if(!isset($_REQUEST["add_cat"])){
redirect("index.php");
}

$add_cat = $cat = $cid = $question = $option1 = $option2 = $option3 = $option4 = $answer = $description = "";

$add_cat = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["add_cat"]))?test_input($_POST["add_cat"]):$add_cat;
$add_cat = ($_SERVER['REQUEST_METHOD'] == "GET" && !empty($_REQUEST["add_cat"]))?test_input($_REQUEST["add_cat"]):$add_cat;

$cat = in_table("*", "categories", "WHERE id = '$add_cat'", "category");
$search_result = $db->select("question", "WHERE cat = '{$cat}'", "*", "ORDER BY id DESC");

$cat = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["cat"]))?test_input($_POST["cat"]):$cat;
$cid = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["cid"]))?test_input($_POST["cid"]):$cid;
$question = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["question"]))?test_input($_POST["question"]):$question;
$option1 = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["option1"]))?test_input($_POST["option1"]):$option1;
$option2 = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["option2"]))?test_input($_POST["option2"]):$option2;
$option3 = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["option3"]))?test_input($_POST["option3"]):$option3;
$option4 = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["option4"]))?test_input($_POST["option4"]):$option4;
$answer = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["answer"]))?test_input($_POST["answer"]):$answer;
$description = ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["description"]))?test_input($_POST["description"]):$description;

/////////////////////////////////////////////////////////////////////////////////////////////////

$count = count_rows($search_result);

$pn = (isset($_REQUEST["pn"]))?preg_replace("#[^0-9]#i", "", $_REQUEST["pn"]):1;

$total = $count;
$per_view = 30;

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

$centerPages .= ($pn>1 && $lastPage>1)?"<a href=\"questions.php?pn={$sub1}&add_cat={$add_cat}\">Previous</a>":"";
$centerPages .= ($sub4>0 && $add1>$lastPage && $lastPage>1)?"<a href=\"questions.php?pn={$sub4}&add_cat={$add_cat}\">{$sub4}</a>":"";
$centerPages .= ($sub3>0 && $add2>$lastPage && $lastPage>1)?"<a href=\"questions.php?pn={$sub3}&add_cat={$add_cat}\">{$sub3}</a>":"";
$centerPages .= ($sub2>0 && $lastPage>1)?"<a href=\"questions.php?pn={$sub2}&add_cat={$add_cat}\">{$sub2}</a>":"";
$centerPages .= ($sub1>0 && $lastPage>1)?"<a href=\"questions.php?pn={$sub1}&add_cat={$add_cat}\">{$sub1}</a>":"";
$centerPages .= ($lastPage>1)?"<a href=\"questions.php?pn={$pn}&add_cat={$add_cat}\" class=\"current\">{$pn}</a>":"";
$centerPages .= ($add1<=$lastPage && $lastPage>1)?"<a href=\"questions.php?pn={$add1}&add_cat={$add_cat}\">{$add1}</a>":"";
$centerPages .= ($add2<=$lastPage && $lastPage>1)?"<a href=\"questions.php?pn={$add2}&add_cat={$add_cat}\">{$add2}</a>":"";
$centerPages .= ($sub2<1 && $add3<=$lastPage && $lastPage>1)?"<a href=\"questions.php?pn={$add3}&add_cat={$add_cat}\">{$add3}</a>":"";
$centerPages .= ($sub1<1 && $add4<=$lastPage && $lastPage>1)?"<a href=\"questions.php?pn={$add4}&add_cat={$add_cat}\">{$add4}</a>":"";
$centerPages .= ($pn<$lastPage && $lastPage>1)?"<a href=\"questions.php?pn={$add1}&add_cat={$add_cat}\">Next</a>":"";

/////////////////////////////////////////////////////////////////////////////////////////////////

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["add_question"]) && !empty($add_cat) && !empty($cat) && !empty($question) && !empty($option1) && !empty($option2) && !empty($option3) && !empty($option4) && !empty($answer) && !empty($description)){

$result = $db->select("question", "Where question = '{$question}' And cat = '{$cat}'", "*", "");

if(count_rows($result) < 1){

$data_array = array(
"cat" => "'$cat'",
"question" => "'$question'",
"option1" => "'$option1'",
"option2" => "'$option2'",
"option3" => "'$option3'",
"option4" => "'$option4'",
"answer" => "'$answer'",
"description" => "'$description'"
);
$act = $db->insert($data_array, "question");

if($act){
$_SESSION["success"] = "<div class='success'>Question successfully added.</div>";
redirect("questions.php?add_cat={$add_cat}&add=1&pn={$pn}");
}else{
$_SESSION["notSuccess"] = "<div class='not_success'>Error occured.</div>";
}

}else{
$_SESSION["notSuccess"] = "<div class='not_success'>Not successful. This question already exists in the database.</div>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["update_question"]) && !empty($cid) && !empty($add_cat) && !empty($cat) && !empty($question) && !empty($option1) && !empty($option2) && !empty($option3) && !empty($option4) && !empty($answer) && !empty($description)){

$data_array = array(
"cat" => $cat,
"question" => $question,
"option1" => $option1,
"option2" => $option2,
"option3" => $option3,
"option4" => $option4,
"answer" => $answer,
"description" => $description
);
$act = $db->update($data_array, "question", "id = '$cid'");

if($act){
$_SESSION["success"] = "<div class='success'>Question no. $cid was successfully updated.</div>";
redirect("questions.php?add_cat={$add_cat}&pn={$pn}");
}else{
$_SESSION["notSuccess"] = "<div class='not_success'>Error occured.</div>";
}

}


if(isset($_REQUEST["delete"]) && !empty($_REQUEST["delete"]) && !empty($_REQUEST["add_cat"])){

$delete = $add_cat = "";
$delete = testQty($_REQUEST["delete"]);
$add_cat = testQty($_REQUEST["add_cat"]);

$act = $db->delete("question", " id='{$delete}'");

if($act){
$_SESSION["success"] = "<div class='success'>Question no. {$delete} successfully deleted.</div>";
redirect("questions.php?add_cat={$add_cat}&pn={$pn}");
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
                        <div class="page-title">Questions</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-left">
        <li><i class="fa fa-home"></i>&nbsp;<a href="/">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Questions</li>
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
if(isset($_SESSION["success"]) && !isset($_POST["option1"]) && !isset($_REQUEST["delete"])){
echo $_SESSION["success"];
unset($_SESSION["success"]);
}
if(isset($_SESSION["notSuccess"])){
echo $_SESSION["notSuccess"];
unset($_SESSION["notSuccess"]);
}
?>               

<?php if(isset($_REQUEST["add"])){ ?>

<!-- questions start--> <div class="question-tab">
<h4>Enter Question for <?php echo in_table("*", "categories", "WHERE id = '" . testQty($_REQUEST["add_cat"]) . "'", "category"); ?> Category</h4>
<form action="" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
<input type="hidden" name="cat" value="<?php echo in_table("*", "categories", "WHERE id = '" . testQty($_REQUEST["add_cat"]) . "'", "category"); ?>" required>
<input type="hidden" name="add_cat" class="form-control" value="<?php echo testQty($_REQUEST["add_cat"]); ?>" required>
<textarea name="question" id="" cols="70" rows="10" placeholder="Enter Question" required></textarea><br><br>
<input type="text" name="option1" value="" placeholder="Option 1" class="form-control" required><br>
<input type="text" name="option2" value="" placeholder="Option 2" class="form-control" required><br>
<input type="text" name="option3" value="" placeholder="Option 3" class="form-control" required><br>
<input type="text" name="option4" value="" placeholder="Option 4" class="form-control" required><br>
<input type="text" name="answer" value="" placeholder="Answer" class="form-control" required><br>
<input type="text" name="description" value="" placeholder="Description" class="form-control" required><br>
<button class="btn btn-primary" name="add_question">Add Question</button>
</form>
</div>

<?php }elseif(isset($_REQUEST["edit"])){ 
$edit = "";
$edit = testQty($_REQUEST["edit"]);
$result = $db->select("question", "WHERE id = '{$edit}'", "*", "");
if(count_rows($result) == 1){
$row = fetch_data($result);
$question = $row["question"];
$option1 = $row["option1"];
$option2 = $row["option2"];
$option3 = $row["option3"];
$option4 = $row["option4"];
$answer = $row["answer"];
$description = $row["description"];
?>

<!-- questions start--> <div class="question-tab">
<h4>Enter Question for <?php echo in_table("*", "categories", "WHERE id = '" . testQty($_REQUEST["add_cat"]) . "'", "category"); ?> Category</h4>
<form action="" method="post" runat="server" autocomplete="off" enctype="multipart/form-data">
<input type="hidden" name="cat" value="<?php echo in_table("*", "categories", "WHERE id = '" . testQty($_REQUEST["add_cat"]) . "'", "category"); ?>" required>
<input type="hidden" name="add_cat" value="<?php echo testQty($_REQUEST["add_cat"]); ?>" required>
<input type="hidden" name="cid" value="<?php echo $edit; ?>" required>
<textarea name="question" id="" cols="70" rows="10" placeholder="Enter Question" required><?php echo $question; ?></textarea><br><br>
<input type="text" name="option1" value="<?php echo $option1; ?>" placeholder="Option 1" class="form-control" required><br>
<input type="text" name="option2" value="<?php echo $option2; ?>" placeholder="Option 2" class="form-control" required><br>
<input type="text" name="option3" value="<?php echo $option3; ?>" placeholder="Option 3" class="form-control" required><br>
<input type="text" name="option4" value="<?php echo $option4; ?>" placeholder="Option 4" class="form-control" required><br>
<input type="text" name="answer" value="<?php echo $answer; ?>" placeholder="Answer" class="form-control" required><br>
<input type="text" name="description" value="<?php echo $description; ?>" placeholder="Description" class="form-control" required><br>
<button class="btn btn-primary" name="update_question">Update Question</button>
</form>
</div>

<?php } }else{ ?>

<h4>Manage Questions on <?php echo in_table("*", "categories", "WHERE id = '" . test_input($_REQUEST["add_cat"]) . "'", "category"); ?> Category</h4>

<?php 
if(count_rows($search_result) > 0){
?><table class="table table-striped table-hover"><thead><tr><th>Qs ID</th><th>Question</th><th>Option 1</th><th>Option 2</th><th>Option 3</th><th>Option 4</th><th>Answer</th><th>Description</th><th style="width:50px; text-align:center;"><i class="fa fa-pencil-square-o" aria-hidden="true" title="Edit Question"></i></th><th style="width:50px; text-align:center;"><i class="fa fa-times" aria-hidden="true" title="Delete Question"></i></th></tr></thead><tbody>
<?php
$c = 0;
while($row = fetch_data($search_result)){
$c++;
if($c>$sub1*$per_view && $c<=$pn*$per_view){
$id = $row["id"];
$question = $row["question"];
$option1 = $row["option1"];
$option2 = $row["option2"];
$option3 = $row["option3"];
$option4 = $row["option4"];
$answer = $row["answer"];
$description = $row["description"];
?>
<tr><td><?php echo $id; ?></td><td><?php echo $question; ?></td><td><?php echo $option1; ?></td><td><?php echo $option2; ?></td><td><?php echo $option3; ?></td><td><?php echo $option4; ?></td><td><?php echo $answer; ?></td><td><?php echo $description; ?></td><th style="text-align:center;"><a href="questions.php?edit=<?php echo $id; ?>&add_cat=<?php echo $_REQUEST["add_cat"]; ?>" title="Edit Question <?php echo $id; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></th><th style="text-align:center;"><a onClick="javascript:return confirm('Are you sure you want to delete question <?php echo $id; ?>?');" href="questions.php?delete=<?php echo $id; ?>&add_cat=<?php echo $_REQUEST["add_cat"]; ?>" title="Delete Question <?php echo $id; ?>"><i class="fa fa-times" aria-hidden="true"></i></a></th>
</tr>
<?php
}
}
echo "</tbody></table>";
echo ($lastPage>1)?"<div class=\"page_nos\">" . $centerPages . "</div>":"";
}else{
echo "<div class='not_success'>No questions found for {$cat} category</div>";
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
                <div class="caption text-uppercase"> <i style="font-size: 17px; margin-top: 2px;" class="fa fa-comments"></i>Manage Questions</div>
                    

            </div><br>
         <a href="questions.php?add_cat=<?php echo (isset($_REQUEST["add_cat"]))?$_REQUEST["add_cat"]:"" ?>" class="btn btn-blue">Manage Questions</a><br><br>
        <a href="questions.php?add_cat=<?php echo (isset($_REQUEST["add_cat"]))?$_REQUEST["add_cat"]:"" ?>&add=1" class="btn btn-blue">Add Question</a><br><br>

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