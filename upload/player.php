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
$vdo = get_all_video_files($vdetails,false,true);

$vdo = get_video_files($vdetails,false,true,false,false,true);


$return = array();

$return['urlVideos']= $vdo;
$return['urlDefaulThumb']= get_thumb($vdetails);
$return['urlThumbs']= get_thumb($vdetails, 'default', true);
$return['details']=$vdetails;




echo '<html>';
echo '<head>';
echo '<style>
video {
  width: 100%    !important;
  height: auto   !important;
}
</style>';
echo '</head>';
echo '<body>';
echo '<video width="100%" controls src="'.$vdo[0].'" autoplay="true" poster="'.get_thumb($vdetails).'">'.$vdetails['title'].'</video>';
echo '</body>';
echo '</html>';

//echo BASEURL."/files/thumbs/{$vdetails['file_directory']}/{$vdetails['file_name']}-{$vdetails['default_thumb']}.jpg";
//echo "<pre>";
//echo json_encode($return);
//echo "</pre>";
