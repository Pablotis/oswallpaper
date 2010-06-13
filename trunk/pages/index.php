<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
?>

<div class="IndexNewestSec">
<div class="IndexNewest">Newest Wallpapers</div>
<?php 
							$sql = "SELECT * FROM ".$db_prefix."wallpaper WHERE active = 1 ORDER BY wallpaper_id  DESC LIMIT 0,6";
							$dbResult = mysql_query($sql, $db);
							while($myrow = mysql_fetch_array($dbResult, MYSQL_ASSOC)){
echo'
                      <div class="WallpaperIconSec">
                        <div class="WallpaperIcon"><a href="'.WallpaperUrl($myrow['wallpaper_url']).'"><img src="'.WallpaperImage('icons',$myrow['wallpaper_url']).'" alt="'.$myrow['wallpaper_name'].' wallpaper" width="160" height="120" border="0" /></a></div>
                        <div class="WallpaperIconName"><a href="'.WallpaperUrl($myrow['wallpaper_url']).'" class="WallpaperIconLink">'.$myrow['wallpaper_name'].' wallpaper</a></div>
                      </div>
';							}

?>
</div>

<div class="IndexPopularSec">
<div class="IndexPopular">Most Popular Wallpapers</div>
<?php 
							$sql = "SELECT * FROM ".$db_prefix."wallpaper WHERE active = 1 ORDER BY wallpaper_downloads DESC LIMIT 0,6";
							$dbResult = mysql_query($sql, $db);
							while($myrow = mysql_fetch_array($dbResult, MYSQL_ASSOC)){
echo'
                      <div class="WallpaperIconSec">
                        <div class="WallpaperIcon"><a href="'.WallpaperUrl($myrow['wallpaper_url']).'"><img src="'.WallpaperImage('icons',$myrow['wallpaper_url']).'" alt="'.$myrow['wallpaper_name'].' wallpaper" width="160" height="120" border="0" /></a></div>
                        <div class="WallpaperIconName"><a href="'.WallpaperUrl($myrow['wallpaper_url']).'" class="WallpaperIconLink">'.$myrow['wallpaper_name'].' wallpaper</a></div>
                      </div>
';							}

?>
</div>
<div class="IndexCommentsSec">
<div class="IndexCommentsLatest">Lates Comments</div>

<?php 
							$sql = "SELECT name,comments FROM ".$db_prefix."comments WHERE status = 1 ORDER BY id DESC LIMIT 0,10";
							$dbResult = mysql_query($sql, $db);
							while($myrow = mysql_fetch_array($dbResult, MYSQL_ASSOC)){
								echo '<div class="IndexCommentsName">By: '.$myrow['name'].'</div>';
								echo '<div class="IndexCommentsTime"> On '.ConvertDate($myrow['time']).'</div>';
								echo '<div class="IndexCommentsText">'.$myrow['comments'].'</div>';
							}

?>
</div>
