<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
function PageUrl($PageUrl){
	global $Gbl;
		if($Gbl['ModRewrite']){
			return $Gbl['SiteUrl'].$PageUrl.'/';
		}else{
			return $Gbl['SiteUrl'].'?p='.$PageUrl;
		}
}
function CatUrl($category_url,$Pg){
	global $Gbl;
	if($Gbl['ModRewrite']){
		if($Pg){
			return $Gbl['SiteUrl'].'wallpapers/'.$category_url.'/'.$Pg.'/';
		}else{
			return $Gbl['SiteUrl'].'wallpapers/'.$category_url.'/';
		}
	}else{
		if($Pg){
			return $Gbl['SiteUrl'].'?i='.$category_url.'&p=wallpapers&pg='.$Pg;
		}else{
			return  $Gbl['SiteUrl'].'?i='.$category_url.'&p=wallpapers';
		}
	}
}

function WallpaperUrl($wallpaper_url){
	global $Gbl;
	if($Gbl['ModRewrite']){
		return $Gbl['SiteUrl'].'wallpaper/'.$wallpaper_url.'/';
	}else{	
		return $Gbl['SiteUrl'].'?i='.$wallpaper_url.'&p=wallpaper';
	}
}

function WallpaperImage($sizeid,$wallpaper_url){
	global $Gbl;
	if($Gbl['ModRewrite']){
		return $Gbl['SiteUrlWalls'].$sizeid.'/'.$wallpaper_url.'.jpg';
	}else{
		return $Gbl['SiteUrlWalls'].$sizeid.'/'.$wallpaper_url.'.jpg';
	}
	
}


function WallpaperSizes($wallpaper_url) {
   global $db,$db_prefix;
    $sql = "SELECT l.sizeid,l.width,l.height FROM ".$db_prefix."size_match s, ".$db_prefix."size l WHERE s.sizeid = l.sizeid and s.wallpaper_url = '$wallpaper_url' ORDER BY l.sizeid ASC";
    $result = mysql_query($sql ,$db);
    if ($myrow = mysql_fetch_array($result)) {
	   do {
	      $sizeid = $myrow["sizeid"];
	      $size = $myrow["width"].'x'.$myrow["height"];
	   $sizehtml .='<input type="button" name="smallimup" class="WallpaperSizeButton" value="'.$size.'" onclick="uploadimage2(\''.$wallpaper_url.'\',\''.$sizeid.'\',\''.$size.'\')" />';
	   } while ($myrow = mysql_fetch_array($result));
    }else{
		echo 'no sizes found';
	}
    return $sizehtml;
}
function CheckEmail($email)
{
  // checks proper E-mail syntax
  if(preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
    return true;
  }else{
	  return false;
  }
}
function ConvertDate($time){
	return gmdate('m d, Y g:i a', $time + (3600 * -8));
}
function EncodeIp($ip){
	$ip_sep = explode('.', $ip);
	return sprintf('%02x%02x%02x%02x', $ip_sep[0], $ip_sep[1], $ip_sep[2], $ip_sep[3]);
}
function SafeInsert($text){
	return mysql_real_escape_string(htmlspecialchars($text));
}
function LoginForm($error){
	global $Gbl;
?>
<div class="LoginForm">
<div class="LoginError"><?php echo $error; ?></div>
<form id="form1" name="form1" method="post" action="">
  <div class="LoginUsername">Email:</div><div class="LoginUsername"><input type="text" name="username" id="username" /></div>
  <div class="LoginUsername">Password:</div><div class="LoginUsername"><input type="password" name="password" id="password" /></div>
  <div class="LoginSubmit"><input type="Submit" name="Login" value="Login" /></div>
</form>
    <div class="LoginFormMsg">
        <div class="LoginFormForgot"><a href="<?php  echo PageUrl('forgot-password'); ?>">Forgot Password</a></div>
        <div class="LoginFormRegister"><a href="<?php  echo PageUrl('register'); ?>">Register</a></div>
    </div>
</div>
<?php 	
}


function LoginCheck($username,$password)
{
	global $db,$db_prefix,$lang,$site_url;
	//echo $username.'<br />';
	//echo $password;
	$password = mysql_real_escape_string(md5($password));
	$username = mysql_real_escape_string(strtolower($username));
	$LoginError = false;
	//$sql = "SELECT username,user_password FROM ".$db_prefix."user where username = '".$username."' AND user_password = '".$password."'";
	// change this also in globals.php
	$sql = "SELECT user_status FROM ".$db_prefix."users WHERE user_email = '".$username."' AND user_password = '".$password."'";
	$result = mysql_query($sql ,$db);
	if ($myrow = mysql_fetch_array($result))  {
		if(!$myrow['user_status']){
			$LoginError =  'Your Acoount is not active. Instructions to activate your account were sent to your email';
			return $LoginError;
		}
		return false; // User and Password is Valid
	}else{
		$LoginError =  'Login Incorrect, Try Again<br /><br /><a href="'.PageUrl('forgot-password').'">Get password</a><br />';
		return $LoginError;
	}
	return 'Functions Error 115: Please Notify Admin of Error';
}
function refer($ref_url,$Milliseconds,$message){
	global $Gbl;
	if(!$ref_url){
		$ref_url = $Gbl['SiteUrl'];
	}
	if(!$Milliseconds){
		echo $message.'<br /><br /><a href="'.$ref_url.'" style="color:#FFFF00">Clck here to continue</a>';
	}else{
	$seconds = $Milliseconds / 1; ?>
 	<script language="JavaScript">
		var countDownInterval=<?php echo $seconds; ?>;
		var countDownTime=countDownInterval+1;
		function countDown(){
			countDownTime--;
			if (countDownTime <=0 ){
				countDownTime=countDownInterval;
				clearTimeout(counter)
				window.location="<?php echo $ref_url; ?>";
				return
			}
			if (document.all) //if IE 4+
				document.all.countDownText.innerText = countDownTime+" ";
			else if (document.getElementById) //else if NS6+
				document.getElementById("countDownText").innerHTML=countDownTime+" "
			else if (document.layers){ //CHANGE TEXT BELOW TO YOUR OWN
				document.c_reload.document.c_reload2.document.write('<?php echo $message.' '.$lang['Wait']; ?> <b id="countDownText">'+countDownTime+' </b> seconds')
				document.c_reload.document.c_reload2.document.close()
			}
			counter=setTimeout("countDown()", <?php echo $Milliseconds; ?>);
		}

		function startit(){
			if (document.all||document.getElementById) //CHANGE TEXT BELOW TO YOUR OWN
				document.write('<?php echo $message; ?> <br /><br /><br /><br /><div align="center"><img src="<?php echo $Gbl['SiteUrl']; ?>/images/07p-6606-loading-circle-.gif" alt="loading"></div><br /><br /><br /><br />Loading.. Pleae Wait <span id="countDownText">'+countDownTime+' </span><br /><br /><br /><br /><br /><br /><br />')
				countDown()
		}

		if (document.all||document.getElementById)
			startit()
		else
			window.onload=startit
			setTimeout("location.href='<?php echo $ref_url; ?>'" , t)
	</script>
   <?php } ?>
	<noscript> <?php 
		echo $message; ?>
		<a href="<?php echo $ref_url; ?>" style="color:#FFFF00">Clck here to continue</a>
	</noscript>	 <?php 
}
// add slashes if magic quotes disabled
 // remove slashes added by magic quotes if enabled
function StripData($data) {
	return ini_get('magic_quotes_gpc') ? stripslashes($data) : $data;
}
function WebuneFullUrl(){
	$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
	$protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s;
	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
     return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
}
function CheckPassword($password){
	if(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 21 ){
		return false;
	}else{
		return 'Password Policy:<br />
				*Minimum Chars is 6<br />
				*Max Chars is 21';
	}
}
function CommentsForm($error,$recaptcha){
	global $publickey,$privatekey;
	require_once('recaptcha/recaptchalib.php');
	?>
                   
<div class="WallpaperComments">
<form action="" method="post"> 
    <div class="WallpaperCommentsTitle">
    <?php 
		echo  $error;

    ?>
    </div>
    <div class="WallpaperCommentsName">Name:</div><div class="WallpaperCommentsNameField"><input name="name" type="text" size="25" maxlength="25" value="<?php echo $_POST['name']; ?>"/></div>
    <div class="WallpaperCommentsEmail">Email:</div><div class="WallpaperCommentsEmailField"><input name="email" type="text" size="25" maxlength="35"  value="<?php echo $_POST['email']; ?>"/></div>
    <div class="WallpaperCommentsComments">Comments:</div><div class="WallpaperCommentsCommentsField"><textarea name="comments" cols="37" rows="5"><?php echo htmlspecialchars($_POST['comments']); ?></textarea></div>
    <div class="reCAPTCHA">
 <?php



echo recaptcha_get_html($publickey, $error);

?>   
    </div>
    
    <div class="WallpaperCommentsSubmit"><input name="Submit" type="submit" value="Submit" /></div>
                   
 </form>
 </div>  
 <?php 	
}
function CleanUrl($text)
{
$text=strtolower($text);
$code_entities_match = array( '&quot;' ,'!' ,'@' ,'#' ,'$' ,'%' ,'^' ,'&' ,'*' ,'(' ,')' ,'+' ,'{' ,'}' ,'|' ,':' ,'"' ,'<' ,'>' ,'?' ,'[' ,']' ,'\\' ,';' ,"'" ,',' ,'.' ,'_' ,'/' ,'*' ,'+' ,'~' ,'`' ,'=' ,' ' ,'---' ,'--','--');
$code_entities_replace = array('' ,'-' ,'-' ,'' ,'' ,'' ,'-' ,'-' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'-' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'-' ,'' ,'-' ,'-' ,'' ,'' ,'' ,'' ,'' ,'-' ,'-' ,'-','-');
$text = str_replace($code_entities_match, $code_entities_replace, $text);
return $text; 
}
function CreateWallpaper($SourceFile,$DestinationFile,$Width,$Height){
	$Image = exec("convert -geometry " . $Width .  "x" . $Height . " " . $SourceFile . " " . $DestinationFile);
	if($Image){
		echo 'TRUE: '.$Image.'<br>';
		return true;
	}else{
		echo 'FALSE: '.$Image.'<br>';
		return false;
	}
	
}
function Adsense($adsense_id){
	global $db,$db_prefix;
	$sql = "SELECT code FROM ".$db_prefix."adsense WHERE adsense_id =".$adsense_id;
	$dbResult = mysql_query($sql, $db);
	if($myrow = mysql_fetch_array($dbResult)){
		return $myrow['code'];
	}else{
		return 'Error 245 - function. No Adsense Id Found';
	}
}
function ProfileForm($ProfileFormArray,$error,$Button){ ?>
<div class="AddLinkError"><?php echo $error; ?></div>
<form id="form1" name="form1" method="post" action="">

      	<div class="AddLinkTitleForm">New Password</div><div class="AddLinkTitleField">
        <input name="user_password" type="password" id="user_password"  value="" size="35" maxlength="250"/>
		</div>
              	<div class="AddLinkTitleForm">Re-Enter New Password</div><div class="AddLinkTitleField">
        <input name="user_password" type="password" id="user_password"  value="" size="35" maxlength="250"/>
		</div>
        
        <div class="AddLinkSubmitButton"><input type="Submit" name="Link" value="<? echo $Button; ?> Password" /></div>
  </form>
<?
}

function LinkForm($LinkFormArray,$error,$Button){
	global $UserData,$publickey,$privatekey;
	?>
    <script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>
<div class="AddLinkForm">
    <div class="AddLinkError"><?php echo $error; ?></div>
<form id="form1" name="form1" method="post" action="">
<? if($UserData['Admin']){ 
	if($LinkFormArray['link_status']){
		$checked = 'checked';
	}
?>
Status: &nbsp; - 
<input type="checkbox" name="link_status" id="link_status" <? echo $checked; ?> value="1"/>
Active<br /><br />

<? } ?>

    <div class="AddLinkUsernameForm">Your Name:</div><div class="AddLinkUsernameField"><input name="link_username" type="text" id="link_username" value="<?php echo $LinkFormArray['link_username']; ?>" size="25" maxlength="25"/></div>
      <div class="AddLinkEmailForm">Your Email:</div><div class="AddLinkEmailField"><input name="link_useremail" type="text" id="link_useremail"  value="<?php echo $LinkFormArray['link_useremail']; ?>" size="30" maxlength="55"/></div>
      
      	<div class="AddLinkTitleForm">Site Title</div><div class="AddLinkTitleField">
        <input name="link_title" type="text" id="link_title"  value="<?php echo $LinkFormArray['link_title']; ?>" size="35" maxlength="250"/>
		</div>
      	<div class="AddLinkUrlForm">Site Url (http://www.example.com)</div><div class="AddLinkUrlField">
        <input name="link_url" type="text" id="link_url"  value="<?php echo $LinkFormArray['link_url']; ?>" size="35" maxlength="250"/>
		</div>
        
      <div class="AddLinkDescriptionForm">Site Description (Max Chars: 250</div>
    <div class="AddLinkDescriptionField">
      <textarea name="link_description" id="link_description" cols="25" rows="3" onKeyDown="limitText(this.form.link_description,this.form.countdown,250);" onKeyUp="limitText(this.form.description,this.id.countdown,250);"><?php echo htmlspecialchars($LinkFormArray['link_description']); ?></textarea>
      <br />You have <input readonly type="text" name="countdown" size="3" value="250"> characters left.

</div>
<? 
if(!$UserData['Admin']){ 
	echo '<div>';
	require_once('recaptcha/recaptchalib.php');
	echo recaptcha_get_html($publickey, $error);
	echo '</div>';
}
 ?>
      <div class="AddLinkAgreeCheck"><input type="checkbox"  name="agree" value="agree" /></div><div class="AddLinkAgree">Agree - You Added Our Link On Your Site</div>
      <div class="AddLinkSubmitButton"><input type="Submit" name="Link" value="<? echo $Button; ?>" /></div>
  </form>
<div class="AddLinkFormMsg">* All Fields Are Required. Attempts: <?php echo $_SESSION['attempts']; ?></div>
<div class="AddLinkFormMsgEmail">NOTE: Please Add Our Link on your website before you submit this form. Thank You.</div>
</div>
<?php 
}
function createThumbs( $WallpaperamaSourceFile,$WallpaperamaDestinationFile,$WallpaperamaWidth,$WallpaperamaHeight,$OriginalWidth,$OriginalHeight )
{
	$tn = imagecreatetruecolor($WallpaperamaWidth, $WallpaperamaHeight) ;
	$image = imagecreatefromjpeg($WallpaperamaSourceFile) ;
	imagecopyresized($tn, $image, 0, 0, 0, 0, $WallpaperamaWidth, $WallpaperamaHeight, $OriginalWidth, $OriginalHeight) ;
	imagejpeg($tn, $WallpaperamaDestinationFile, 100) ; 
}
?>