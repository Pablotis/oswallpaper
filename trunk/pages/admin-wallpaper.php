<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
echo '<div>';				
				if($_GET['catid']){
					echo '<div class="AdminWallpaperCatNames">'.$_GET['category_name'].' Wallpapers</div>';
				$sql = "SELECT * FROM ".$db_prefix."wallpaper WHERE  category_id = ".mysql_real_escape_string($_GET['catid'])." ORDER BY wallpaper_name ASC ";
				}else{
				$sql = "SELECT *,c.category_name,c.category_id FROM ".$db_prefix."wallpaper w, ".$db_prefix."category c WHERE  w.category_id = c.category_id  ORDER BY c.category_name ASC ";
				}
				
				$result = mysql_query($sql ,$db);
				if ($myrow = mysql_fetch_array($result))  {
					echo'<div class="AdminWallpaperCategoryName">Category</div>
					<div class="AdminWallpaperName">Wallpaper Name</div>';
					do{
						echo'
						<div class="AdminWallpaperCategoryName"><a href="'.$Gbl['SiteUrl'].'?p=admin-wallpaper&catid='.$myrow['category_id'].'&category_name='.$myrow['category_name'].'">'.$myrow['category_name'].'</a></div>
						<div class="AdminWallpaperName"><a href="'.WallpaperUrl($myrow['wallpaper_url']).'">'.$myrow['wallpaper_name'].'</a></div>';
					}while($myrow = mysql_fetch_array($result));
				}else{
					if(mysql_error()){
					echo 'Critical Error 11 in admin.php'; exit;
					}
				}
echo '</div>';				
?>