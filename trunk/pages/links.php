<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if(!$UserData['Admin']){
	$AdminSearch = 'WHERE link_status = 1';
}


$sql = "SELECT * FROM ".$db_prefix."links ".$AdminSearch." ORDER BY link_id ASC";
$result = mysql_query($sql ,$db);
if($myrow = mysql_fetch_array($result)){
	do{
		echo '<div class="LinkSec">
				<div class="LinkTitle">';
				echo '<a href="'.$myrow['link_url'].'" class="LinkUrl" target="_blank">'.$myrow['link_title'].'</a>';
				if($UserData['Admin']){
					echo ' &nbsp; &nbsp; <a href="'.$Gbl['SiteUrl'].'?p=admin-links&action=edit&link_id='.$myrow['link_id'].'">[Edit]</a> &nbsp; &nbsp; <a href="'.$Gbl['SiteUrl'].'?p=admin-links&action=delete&link_id='.$myrow['link_id'].'">[Delete]</a>';
				}
				if(!$myrow['link_status']){
					echo ' &nbsp; &nbsp; <strong style="color:red;">[NOT ACTIVE]</strong> ';
				}
				echo'</div>
				<div class="LinkDescription">'.$myrow['link_description'].'</div>
			  </div>
			';
	}while ($myrow = mysql_fetch_array($result));
}else{
	echo 'No Links Found';
}
echo '<div class="LinkSecAddLink"><a href="'.PageUrl('add-link').'">Add Link</a></div>';
?>