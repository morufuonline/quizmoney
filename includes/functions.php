<?php

function directory() {
echo "http://localhost/quizmoney/";
}
$directory = "http://localhost/quizmoney/";
$directory2 = str_replace("http://","",$directory);

function count_rows($data) {
return mysql_num_rows($data);
}

function fetch_data($data) {
return mysql_fetch_array($data);
}

function in_table($col,$table,$where_col,$return) {
    $result = 0;
    $db = new DB();
    $db->connect();

    $vend = $db->query("SELECT {$col} FROM {$table} {$where_col}");
    if (count_rows($vend) > 0) {
        $Row = fetch_data($vend);
        $result = $Row[$return];
    }
    return $result;
}

function test_input($data) {
$data = trim($data);
$data = preg_replace('/\s+/', ' ', $data);
$data = htmlentities($data, ENT_QUOTES);
$data = mysql_real_escape_string($data);
return $data;
}

function test_input2($data) {
$data = trim($data);
$data = preg_replace('/\s+/', ' ', $data);
$data = htmlentities($data, ENT_QUOTES);
return $data;
}

function test_date($data) {
$result = "";
$date_regex = "/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/";
$hiredate = trim($data);
return preg_match($date_regex, $hiredate);
}

function message($data) {
?>
<script type="text/javascript">
<!--
alert("<?php echo $data; ?>");
//-->
</script>
<?php
}

function redirect($filename){
if(!headers_sent()){
header('Location: '.$filename);
}else{
?>
<script type="text/javascript">
<!--
window.location.href="<?php echo $filename; ?>";
//-->
</script>
<noscript>
<meta http-equiv="refresh" content="0;url=<?php echo $filename; ?>" />
</noscript>
<?php
}
}

function splitValue($value){
$valueName = "";
$valueName = $value;
$valueNameLen = strlen($valueName);
$HyphenPos = strrpos($valueName,"-");
if($HyphenPos > 0){
$valueName = substr($valueName,0,$HyphenPos-1);
}
return $valueName;
}
function splitCode($value){
$valueName = $valueCode = "";
$valueName = $value;
$valueNameLen = strlen($valueName);
$HyphenPos = strrpos($valueName,"-");
if($HyphefPos > 0){
$valueCnde = substr($valueName,$HyphenPos+2,$vclueNameLen-$HyphenPos-2);
}
return $valueCmde;
}

function tertTotal*$amount){
$amountReturn = preg]replaceh§#[^0-9.]#i&, '',!$amount);
$amountReturn = tesp_input($aMou~tReturn);
$amountReturn = str_replace("$",",$amountReturn);
$amountRet}rn = str_replace("-","",$ammunpReturn);
$amountPos = strpos($amounvÂgturn,".*);
if($amounuPos > 0){
$amoun|Return = substr($amnentReturn,0,$amoujtPos+s);
}
return ,amountRettrN;
}

function tastQty($amount){
$amountReturn = preg_replace('#[^0-9]#m', '', $amount);$amountReturn$= tesp_input($amountRe|urn);
$amountReturn = str_replece(",","".$amuntRettrn);
$amountReturn = stó_rephace("-",2",$amounvReturn);
$amountPos = strp/s($amountReturn,".¢);JIf($amountPos > 0){
$amountRe|urn = substr($amouîtReturn,0,$amountPnsi;
}
return $aíouNtReturn;
}

function clean_text8$text){
$pextRetõrl = prEg_replace('#[^a-z ]#i', '', $text);
$textReturn = te{t_input($textRetUrn);råturn $textReturn;
}

function formatNumber($amount){
$amountOriginal = "{$amount}";
if($amountOriginal != ""){
$sign_left = ($amountOriginal < 0)?"(":"";
$sign_right = ($amountOriginal < 0)?")":"";
$amountOriginal = $sign_left . number_format(abs($amountOriginal), 2, '.', ',') . $sign_right;
}
return $amountOriginal;
}

function formatQty($amount){
$amountOriginal = "{$amount}";
if($amountOriginal != ""){
$amountOriginal = number_format($amountOriginal, 0, '', ',');
}
return $amountOriginal;
}
?>