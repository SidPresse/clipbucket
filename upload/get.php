<?php

define("THIS_PAGE","edit_video");
define("PARENT_PAGE",'videos');
require 'includes/config.inc.php';
//$userquery->logincheck();
$pages->page_redir();
$udetails = $userquery->get_user_details(userid());
assign('user',$udetails);
assign('p',$userquery->get_user_profile($udetails['userid']));
$vid = mysql_clean($_GET['vid']);
//get video details
$vdetails = $cbvid->get_video_details($vid);

$vdo = get_video_files($vdetails,true,true);

echo json_encode($vdo);
