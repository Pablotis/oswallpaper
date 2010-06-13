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
<script language="javascript" type="text/javascript">
<!--//
function uploadimage2(wallpaper_url,sizeid,size){
	var addthumb=0;
	var windwid=390; 
	var windhei=300;	

	/* var prnttext = 'wallpaper_url '+wallpaper_url+' size '+size+' sizeid: '+sizeid+' Width:'+winwid+', Height '+winhei+''; */
	var prnttext ='<link href="<?php echo $Gbl['SiteUrl']; ?>theme/<?php echo $Gbl['Theme']; ?>/<?php echo $Gbl['Theme']; ?>.css" rel="stylesheet" type="text/css" />';
	prnttext += size+' Wallpaper Dowload Complete. To Install this wallpaper right click on your browser and select set as Desktop Background"'
	prnttext += '<div class="Loading"><img src="<?php echo $Gbl['SiteUrlWalls']; ?>'+sizeid+'/'+wallpaper_url+'.jpg" alt="image" width="320" height="240"></div>';


	var newwin = window.open("","DownloadWallpaper",'menubar=no,scrollbars=yes,width='+windwid+',height='+windhei+',left='+((windwid-windhei)/2)+',top=100,directories=no,location=no,resizable=yes,status=no,toolbar=no');
	newwin.document.open();
	newwin.document.write(prnttext);
	newwin.document.close();
	newwin.focus();
}
//-->
</script>

<div class="CategoryBox"><!-- START CategoryBox -->
<?php 
echo'
                      <div class="WallpaperThumbSec">
                        <div class="WallpaperThumbImage"><img src="'.WallpaperImage('thumbs',$Pg['wallpaper_url']).'" alt="'.$Pg['wallpaper_name'].' wallpaper" height="'.$Gbl['ThumbHeight'].'" width="'.$Gbl['ThumbWidth'].'" border="0" /></div>
                      	<div class="WallpaperThumbName">'.$Pg['wallpaper_name'].' wallpaper</div>
					  </div>  
';
						


?>
<div class="WallpaperAd2"><?php echo Adsense(3); ?></div>                

					<div class="WallpaperSize">Choose Screen Size: 
<?php echo (WallpaperSizes($Pg['wallpaper_url'])); ?>                                               
                    </div>
<?php 

if($publickey){
	if($_POST['Submit']){
		
		
		if(strlen($_POST['comments']) < 10){
			$error = '*Comments Are Too Short.';
		}
		if(!CheckEmail($_POST['email'])){
			$error = '*Invalid Email';
		}
		if(strlen($_POST['name']) < 1){
			$error = '*Name Is Invalid';
		}
		
		
		if($error){
			$_SESSION['attempts'] ++;
			CommentsForm($error,''); 
		}else{
				
			require_once('recaptcha/recaptchalib.php');
			# the response from reCAPTCHA
			$resp = null;
			# was there a reCAPTCHA response?
			if ($_POST["recaptcha_response_field"]) {
				$resp = recaptcha_check_answer (
													$privatekey,
													$_SERVER["REMOTE_ADDR"],
													$_POST["recaptcha_challenge_field"],
													$_POST["recaptcha_response_field"]
												);
				if ($resp->is_valid) {
					$sql = "INSERT INTO ".$db_prefix."comments SET
					wallpaper_id = '".$Pg['wallpaper_id']."',
					ip = '".EncodeIp($_SERVER["REMOTE_ADDR"])."',
					time = '".time()."',
					name = '".SafeInsert($_POST['name'])."',
					email = '".SafeInsert($_POST['email'])."',
					comments = '".SafeInsert($_POST['comments'])."'
					";
					if(mysql_query($sql ,$db)){
						$_SESSION['attempts'] = 1;
						echo refer(WebuneFullUrl(),$Gbl['ErrorTime'],'Thank You, Adding Your Comments');
					}else{
						$_SESSION['attempts'] ++;
						echo 'Error 120: There was an error submitting your comments.';
					}
				} else {
					# set the error code so that we can display it				
					$_SESSION['attempts'] ++;
					CommentsForm($resp->error,'');
				}
			}else{
				$_SESSION['attempts'] ++;
				CommentsForm($resp->error,'');
			}
		}
		
	}else{
		CommentsForm($error,''); 
	}
}



?> 
<div class="WallpaperReplies">
<?php
$sql = "SELECT * FROM ".$db_prefix."comments WHERE wallpaper_id =".$Pg['wallpaper_id']." AND status = 1";
$result = mysql_query($sql ,$db);
if($myrow = mysql_fetch_array($result)){
	do{
	
		echo '<div class="CommentsName">'.$myrow['name'].' </div><div class="CommentsTime"> '.ConvertDate($myrow['time']).'</div>
			<div class="CommentsDetails">'.$myrow['comments'].' </div>
			';
	}while ($myrow = mysql_fetch_array($result));
}else{
	echo 'No Comments';
}
?>
</div>                     
<div class="WallpaperShare">
<div class="WallpaperCommentsTitle">Share</div>
<div class="WallpaperShareEmbed">Link:</div><div class="WallpaperShareEmbedField">
  <input name="username2" type="text" value="<?php echo htmlspecialchars(WallpaperUrl($myrow['wallpaper_url'])); ?>" size="40" readonly="readonly"/>
</div>
<div class="WallpaperSharePhpbb">Embed:</div><div class="WallpaperSharePhpbbField"><input name="username" type="text" value="<?php echo htmlspecialchars('<img src="'.WallpaperImage('thumbs',$Pg['wallpaper_url']).'" alt="'.$Pg['wallpaper_name'].' wallpaper" height="239" width="310" border="0" /><br /><a href="'.WallpaperUrl($myrow['wallpaper_url']).'">Download '.$Pg['wallpaper_name'].' Wallpaper</a>'); ?>" size="40" readonly="readonly"/></div>
</div> 


</div> <!-- END CategoryBox -->
                      
