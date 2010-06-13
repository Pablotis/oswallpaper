<?php 
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
ini_set('display_errors', 1);
include_once('oswallpaper-header.php'); 

if($Pg['page_type'] == 2){
	include_once('pages/'.$_GET['p'].'.php');
}else{
	if($Pg['page_content']){
		echo $Pg['page_content'];
	}else{
		echo 'Critical Error 10: No Content Found';
	}
}


include_once('oswallpaper-footer.php'); 

?>