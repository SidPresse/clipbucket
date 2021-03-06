<?php

/**
 * License : CBLA
 * Author : Arslan
 */

/**
 * iFrame based embed player ClipBucket
 * reason to use iFrame instead of embed code
 * is to control player with full support of javascript
 */
 
 
 define("THIS_PAGE","watch_video");

include("../includes/config.inc.php"); 
 
$vid = $_GET['vid'];
//gettin video details
$vdetails = get_video_details($vid);

$width = @$_GET['width'];
$height = @$_GET['height'];
$autoplay = @$_GET['autoplay'];
$loop = @$_GET['loop']; 

if(!$width)
    $width = '320';
    
if(!$height)
    $height = '240';

if(!$autoplay)
    $autoplay = 'no';

if(!$loop)
    $loop = 'no';


if(!$vdetails)
    exit("no video id ".$vid)));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$vdetails['title']?></title>
<?php
Template(STYLES_DIR.'/global/head.html',false);
Template(STYLES_DIR.'/global/html5_player_header.html',false);
?>
<!-- begin lep adding 
- subtitle in left top corner hide
- logo CB hide
-->
<style>
div.caption span.user, div#path{
        display:none;
}
div.btnFS.enterbtnFs.hbtn {
        display:none;
}
</style>
<!-- end lep adding -->
</head>

<body style="margin:0px; padding:0px">
<?php
flashPlayer(array('vdetails'=>$vdetails,'width'=>$width,'height'=>$height,'autoplay'=>$autoplay,'loop'=>$loop));
?>
</body>
</html>

