<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
function UploadForm($error){
	global $db,$db_prefix,$Gbl;
	?>
<div class="UploadForm">
<div class="UploadError"><?php echo $error; ?></div>
<form action="" method="post" enctype="multipart/form-data">
  <div class="UploadNameForm">Wallpaper Name: </div>
  <div class="UploadNameField"><input type="text" name="wallpaper_name" id="wallpaper_name" value="<?php echo $_POST['wallpaper_name']; ?>"/> </div>
  <div class="UploadCatForm">Choose Category: </div>
  <div class="UploadCatField">
  <select name="category_id">
  <?php 
  $sql = "SELECT category_id,category_name FROM ".$db_prefix."category ORDER BY category_name ASC";
  $result = mysql_query($sql ,$db);
  if ($myrow = mysql_fetch_array($result))  {
	  echo '<option value="">-- Select Category --</option>';
	  do{
		  if($_POST['category_id'] == $myrow['category_id']){
			$Selected = 'selected';  
		  }else{
			  $Selected = '';
		  }
		  echo '<option value="'.$myrow['category_id'].'" '.$Selected.'>'.$myrow['category_name'].'</option>';
	  }while ($myrow = mysql_fetch_array($result));
  }
  ?>
  </select> </div>
    <div class="UploadSizeForm">What size wallpaper are you submitting? </div>
  <div class="UploadSizeField">
  <select name="sizeid">
  <?php 
  $sql = "SELECT sizeid,width,height FROM ".$db_prefix."size ORDER BY sizeid ASC";
  $result = mysql_query($sql ,$db);
  if ($myrow = mysql_fetch_array($result))  {
	  echo '<option value="">-- Select Size --</option>';
	  do{
		  if($_POST['sizeid'] == $myrow['sizeid']){
			$Selected = 'selected';  
		  }else{
			  $Selected = '';
		  }
		  echo '<option value="'.$myrow['sizeid'].'" '.$Selected.'>'.$myrow['width'].'x'.$myrow['height'].'</option>';
	  }while ($myrow = mysql_fetch_array($result));
  }
  ?>
  </select> </div>  
  <div class="UploadFileForm">Choose Wallpaper</div>
  <div class="UploadFileField"><input type="file" name="WallpaperamaFile" /><input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $Gbl['UploadFileMaxSize']; ?>"></div>
  
  <div class="UploadSubmitField"><input type="submit" name="Upload" Value="Upload"/></div>
  
</form>
</div>
<?php 
}

if(isset($_POST['Upload'])){
	if(!$_POST['wallpaper_name'] || !$_POST['category_id'] || !$_POST['sizeid'] || $_FILES['WallpaperamaFile']['name'] == ''){
		$error = 'All Fields Are Required';
	}
	if($_FILES['WallpaperamaFile']['name']){
		if ($_FILES['WallpaperamaFile']['size'] > $Gbl['UploadFileMaxSize']){
			$error = 'Your File Size Is Too Big. Not Allowed';
		}
		if ($_FILES['WallpaperamaFile']['type']!="image/jpeg" && $_FILES['WallpaperamaFile']['type']!="image/pjpeg"){
			$error = 'We are sorry, that file is not allowed. Only .jpeg or .jpg image files are allowed at this time.';
		}
		if ($_FILES['WallpaperamaFile']['error']){
			$error = 'Critical Error Found. Please Report to Admin';exit;
		}
	}
	if($error){
		echo UploadForm($error);
	}else{
        	
			$WallpaperUrl = CleanUrl($_POST['wallpaper_name']);
			if(move_uploaded_file($_FILES['WallpaperamaFile']['tmp_name'], $SourceFile = $Gbl['WallpaperDir']. $_POST['sizeid'].'/'.$WallpaperUrl.'.jpg')){
					$sql = "INSERT INTO ".$db_prefix."wallpaper  SET 
						category_id = '".mysql_real_escape_string($_POST['category_id'])."',
						wallpaper_name = '".mysql_real_escape_string(htmlentities(strtolower($_POST['wallpaper_name'])))."',
						 wallpaper_url = '".$WallpaperUrl."',
						 
						 user_id = '".$UserData['user_id']."',
						 sizeid = '".mysql_real_escape_string($_POST['sizeid'])."',
						 date = '".time()."'
					";
				if(mysql_query($sql ,$db)){
					if($UserData['Admin']){
						refer($Gbl['SiteUrl'].'?p=admin-peding-wallpapers',60,'Wallpaper Upload Successful. Loading Admin Page.');
					}else{
						refer($Gbl['SiteUrl'],60,'Thank You. Your Wallpaper Has Been Added. We will review your wallpaper and approve it.');
					}
					
					
				}else{
					echo mysql_error().'<br>error 97, We could not add your wallpaper at this time.'; exit;
				}
			}else{
				if(!is_writable($SourceFile)){
					echo 'Error 101 Set Write Premissions To: '.$SourceFile; exit;
				}else{
					echo 'error 103, could not save wallpaper.'; exit;
				}
				
				
			}								
	}
}else{
	echo UploadForm($error);
}
?>