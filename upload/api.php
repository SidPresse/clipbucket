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

$command = 'mediainfo -f --Output=JSON '. __DIR__.'/files/videos/'.$vdetails['file_directory'].'/'.basename($vdo['0']);
exec($command,$output);
$infoReturn = array();
foreach($output as $line){
        $key=trim(substr($line,0,strpos($line,':')));
        $value=trim(substr($line,strpos($line,':')+1));
        $key = keyRename($key,$infoReturn);
        $infoReturn[$key]=$value;
}

$return['mediainfo']=$infoReturn;

echo json_encode($return);

function keyRename($key,$array){
        if (array_key_exists($key, $array)) {
                //      return $key.'_1';
                return keyRename($key.'-',$array);
        } else {
                return $key;
        }
}
