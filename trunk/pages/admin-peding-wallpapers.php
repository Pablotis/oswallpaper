<div style="padding:10px">
<?php 
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if(isset($_POST['approve'])){
	$SourceFile = $Gbl['WallpaperDir']. $_POST['sizeid'] . "/" . $_POST['wallpaper_url'] . ".jpg";
	$sql = "SELECT * FROM ".$db_prefix."size  WHERE sizeid <= '".mysql_real_escape_string($_POST['sizeid'])."' ORDER BY sizeid DESC";
    $result = mysql_query($sql ,$db);
	if($myrow = mysql_fetch_array($result)){
		do{
			if($myrow['sizeid'] == $_POST['sizeid']){
				$OriginalWidth = $myrow['width'];
				$OriginalHeight = $myrow['height'];
			}

			$sql2 = "INSERT INTO ".$db_prefix."size_match SET
			wallpaper_id = '".mysql_real_escape_string($_POST['wallpaper_id'])."',
			wallpaper_url = '".mysql_real_escape_string($_POST['wallpaper_url'])."',
			sizeid = '".mysql_real_escape_string($myrow['sizeid'])."'
			";
			if(mysql_query($sql2 ,$db)){
				if($_POST['sizeid'] != $myrow["sizeid"]){
					$DestinationFile = $Gbl['WallpaperDir'].$myrow["sizeid"].'/'.$_POST['wallpaper_url']. ".jpg";
					createThumbs($SourceFile,$DestinationFile,$myrow['width'],$myrow['height'],$OriginalWidth ,$OriginalHeight);
				}
			}else{
				echo 'error 23'; exit;
			}
		}while($myrow = mysql_fetch_array($result));
	
		# ICONS
		$DestinationFile = $Gbl['WallpaperDir'].'icons/'.$_POST['wallpaper_url']. ".jpg";
		createThumbs($SourceFile,$DestinationFile,$Gbl['IconWidth'],$Gbl['IconHeight'],$OriginalWidth,$OriginalHeight);
		$s = system("convert -geometry 320x240 " . $origfile . " images/sample/" . $wallpaperid . ".jpg");
			
		#THUMBS
		$DestinationFile = $Gbl['WallpaperDir'].'thumbs/'.$_POST['wallpaper_url']. ".jpg";
		createThumbs($SourceFile,$DestinationFile,$Gbl['ThumbWidth'],$Gbl['ThumbHeight'],$OriginalWidth,$OriginalHeight);
		$sql3 = "UPDATE  ".$db_prefix."wallpaper SET
		active = 1
		WHERE wallpaper_id = '".$_POST['wallpaper_id']."'
		";
		if(mysql_query($sql3 ,$db)){
			refer($Gbl['SiteUrl'].'?p=wallpaper&i='.$_POST['wallpaper_url'],60,'Wallpaper Installed Successful.');
		}else{
			echo 'error 44, could not approve wallpaper due to database error';
		}		
	}else{
		echo $sql.'error 20';
	}
		
}else{


$sql = "SELECT * FROM ".$db_prefix."wallpaper WHERE active = 0 ORDER BY wallpaper_id  DESC";
							$dbResult = mysql_query($sql, $db);
							if($myrow = mysql_fetch_array($dbResult)){
								
							do{
echo'
Wallpaper Name:'.$myrow['wallpaper_name'].'<br />
category_id: '.$myrow['category_id'].'<br />
User: '.$myrow['user_id'].'<br />
Date Submitted: '.ConvertDate($myrow['date']).'<br />
Size: '.$myrow['sizeid'].'<br />
Image: [<a href="'.WallpaperImage($myrow['sizeid'],$myrow['wallpaper_url']).'" target="_blank">Open New Windows</a>]<br /><br />
<img src="'.WallpaperImage($myrow['sizeid'],$myrow['wallpaper_url']).'" border="1" alt="'.$myrow['wallpaper_name'].' Pending" width="160"><br /><br />
<form method="POST" action="">
	<input type="hidden" name="wallpaper_url" value="'.$myrow['wallpaper_url'].'">
	<input type="hidden" name="wallpaper_id" value="'.$myrow['wallpaper_id'].'">
	<input type="hidden" name="sizeid" value="'.$myrow['sizeid'].'">
	<input type="submit" name="approve" value="Approve">
</form><br />
<hr>';
							}while($myrow = mysql_fetch_array($dbResult));


}else{
	echo 'no pending wallpapers';
}
}
?>
</div>