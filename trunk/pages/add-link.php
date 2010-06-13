<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
function AddLinkForm($error){
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
      <div class="AddLinkUsernameForm">Your Name:</div><div class="AddLinkUsernameField"><input name="username" type="text" id="username" value="<?php echo $_POST['username']; ?>" size="25" maxlength="25"/></div>
      <div class="AddLinkEmailForm">Your Email:</div><div class="AddLinkEmailField"><input name="email" type="text" id="email"  value="<?php echo $_POST['email']; ?>" size="30" maxlength="55"/></div>
      
      	<div class="AddLinkTitleForm">Site Title</div><div class="AddLinkTitleField">
        <input name="title" type="text" id="title"  value="<?php echo $_POST['title']; ?>" size="35" maxlength="250"/>
		</div>
      	<div class="AddLinkUrlForm">Site Url (http://www.example.com)</div><div class="AddLinkUrlField">
        <input name="url" type="text" id="url"  value="<?php echo $_POST['url']; ?>" size="35" maxlength="250"/>
		</div>
        
      <div class="AddLinkDescriptionForm">Site Description (Max Chars: 250</div>
    <div class="AddLinkDescriptionField">
      <textarea name="description" id="description" cols="25" rows="3" onKeyDown="limitText(this.form.description,this.form.countdown,250);" onKeyUp="limitText(this.form.description,this.id.countdown,250);"><?php echo htmlspecialchars($_POST['description']); ?></textarea>
      <br />You have <input readonly type="text" name="countdown" size="3" value="250"> characters left.

</div>
      <div class="AddLinkAgreeCheck"><input type="checkbox"  name="agree" value="agree" /></div><div class="AddLinkAgree">Agree - You Added Our Link On Your Site</div>
      <div class="AddLinkSubmitButton"><input type="Submit" name="AddLink" value="AddLink" /></div>
    </form>
<div class="AddLinkFormMsg">* All Fields Are Required. Attempts: <?php echo $_SESSION['attempts']; ?></div>
<div class="AddLinkFormMsgEmail">NOTE: Please Add Our Link on your website before you submit this form. Thank You.</div>
</div>
<?php 
}

if(isset($_POST['AddLink'])){
	if(!$_POST['username'] || !$_POST['email'] || !$_POST['title'] || !$_POST['url'] || !$_POST['description']){
		$error = 'All Fields Are Required';	
	}
	if(!CheckEmail($_POST['email'])){
		$error = 'A Valid Email Is Required';	
	}
	if(!strstr($_POST['url'],'http://')){
		$error = 'Invalid Url: Good Example: http://www.example.com';	
	}
	if(strstr($_POST['url'],'<') || strstr($_POST['title'],'<') || strstr($_POST['description'],'<')){
		$error = 'No Code Allowed';	
	}
	
	if($error){
		$_SESSION['attempts'] ++;
		echo AddLinkForm($error);
	}else{
			$sql = "INSERT INTO ".$db_prefix."links SET
			link_title = '".SafeInsert($_POST['title'])."',
			link_url = '".mysql_real_escape_string(strtolower($_POST['url']))."',
			link_description = '".SafeInsert($_POST['description'])."',
			link_username = '".SafeInsert($_POST['name'])."',
			link_useremail = '".SafeInsert($_POST['email'])."'
			";
			if(mysql_query($sql, $db)){
				$_SESSION['attempts'] = 1;
				echo refer($Gbl['SiteUrl'],$Gbl['ErrorTime'],'Thank You. Your Link Has Been Added');
			}else{
				echo 'Critical Error 67: Could not add your link. Please contact website administrator.'; exit;
			}
	}
	
	
}else{
	echo AddLinkForm('Please Complete Form To Add Link');
}

?>