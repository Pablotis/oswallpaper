<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
echo '<div style="padding:5px">This is the Admin Page<br />NOTE: This page is not complete yet. i need more time. :)<br /><br /></div>';

echo '<div style="padding:10px;">Wallpaper Categories - Click on the category link to visit the wallpaper pages<br /><br />';				
				$sql = "SELECT * FROM ".$db_prefix."category ORDER BY category_name ASC ";
				$result = mysql_query($sql ,$db);
				if ($myrow = mysql_fetch_array($result))  {
					do{
						echo '<a href="'.CatUrl($myrow['category_url'],'').'">'.$myrow['category_name'].'</a> - [Edit] - [Delete] <br />';
					}while($myrow = mysql_fetch_array($result));
				}else{
					if(mysql_error()){
					echo 'Critical Error 11 in admin.php'; exit;
					}
				}
echo '</div>';				
?>