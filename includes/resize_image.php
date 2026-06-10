<?php
// Function for resizing jpg, gif, or png image files
function ak_img_resize($target, $newcopy, $ext, $width, $height) {
$w = $width;
$h = $height;
list($w_orig, $h_orig) = getimagesize($target);
$scale_ratio = $w_orig / $h_orig;
if (($width / $height) > $scale_ratio) {
$w = $height * $scale_ratio;
} else {
$h = $width / $scale_ratio;
}
	
$img = "";
$ext = strtolower($ext);
if ($ext == "gif" || $ext == "GIF"){ 
$img = imagecreatefromgif($target);
} else if($ext =="png" || $ext =="PNG"){ 
$img = imagecreatefrompng($target);
} else { 
$img = imagecreatefromjpeg($target);
}
$tci = imagecreatetruecolor($w, $h);
// imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
imagejpeg($tci, $newcopy, 80);
}
?>