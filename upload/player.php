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

$command = 'mediainfo -f --Output=JSON '. __DIR__.'/files/videos/'.$vdetails['file_directory'].'/'.basename($vdo['0']);
exec($command,$output);

//echo '<pre>';
//var_dump($output);
//echo '</pre>';

$infoReturn = array();
foreach($output as $line){
	$key=trim(substr($line,0,strpos($line,':')));
	$value=trim(substr($line,strpos($line,':')+1));
//echo "B>".$key."<br/>";
        
	$key = keyRename($key,$infoReturn);
//echo "A>".$key."<br/>";
	$infoReturn[$key]=$value;

}
//echo '<pre>';
//var_dump($infoReturn);
//echo '</pre>';

$ratio = $infoReturn['Display aspect ratio'];
$w = $infoReturn['Width'];
$h = $infoReturn['Height'];

echo '<video data-width="'.$w.'" data-height="'.$h.'"  data-ratio="'.$ratio.'" width="100%" controls src="'.$vdo[0].'" autoplay="true" poster="'.get_thumb($vdetails).'">'.$vdetails['title'].'</video>';
echo '</body>';
echo '</html>';

//echo BASEURL."/files/thumbs/{$vdetails['file_directory']}/{$vdetails['file_name']}-{$vdetails['default_thumb']}.jpg";
//echo "<pre>";
//echo json_encode($return);
//echo "</pre>";


function keyRename($key,$array){
        if (array_key_exists($key, $array)) {
               	//	return $key.'_1';
		return keyRename($key.'-',$array);
        } else {
		return $key;
	}
}


