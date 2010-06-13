<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
function RegisterForm($error){
?>
<div class="RegisterForm">
    <div class="RegisterError"><?php echo $error; ?></div>
    <form id="form1" name="form1" method="post" action="">
      <div class="RegisterUsernameForm">Name:</div><div class="RegisterUsernameField"><input type="text" name="username" id="username" value="<?php echo $_POST['username']; ?>"/></div>
      <div class="RegisterEmailForm">Email:</div><div class="RegisterEmailField"><input type="text" name="email" id="email"  value="<?php echo $_POST['email']; ?>"/></div>
      <div class="RegisterPasswordForm">Password:</div><div class="RegisterPasswordField"><input type="password" name="password" id="password"  value="<?php echo $_POST['password']; ?>"/></div>
      <div class="RegisterPasswordReenterForm">Re-Enter Password:</div><div class="RegisterPasswordReenterField"><input type="password" name="repassword" id="repassword"  value="<?php echo $_POST['repassword']; ?>"/></div>
      <div class="RegisterSubmitButton"><input type="Submit" name="Register" value="Register" /></div>
    </form>
<div class="RegisterFormMsg">* All Fields Are Required.</div>
<div class="RegisterFormMsgEmail">NOTE: A valid E-mail is Required. You will be sent an activation code to confirm your email.</div>
</div>
<?php 	
}
if(isset($_POST['Register'])){


	if(!CheckEmail($_POST['email'])){
		$error = '*Invalid Email';
	}
	if(strlen($_POST['username']) < 1){
		$error = '*Name Is Invalid';
	}
	if(empty($_POST['password']) || empty($_POST['repassword'])){
		$error = 'Both Passwords are required';
	}else{
		if($_POST['password'] == $_POST['repassword']){
			if($error = CheckPassword($_POST['password'])){
				
			}				
		}else{
			$error = 'Passwords Do Not Match';
		}
	}
	

	if($error){
		$_SESSION['attempts'] ++;
		RegisterForm($error);
	}else{
		$sql = "SELECT user_email FROM ".$db_prefix."users WHERE user_email = '".mysql_real_escape_string($_POST['email'])."'";
		$result = mysql_query($sql ,$db);
		if ($myrow = mysql_fetch_array($result))  {
			$_SESSION['attempts'] ++;
			RegisterForm($myrow['user_email'].'<br />already registered.<br /><a href="?p=forgot-password">Fortgot Password?</a>');
		}else{
			$sql = "INSERT INTO ".$db_prefix."users SET
			user_date = '".time()."',
			user_ip = '".EncodeIp($_SERVER['REMOTE_ADDR'])."',
			user_name  = '".SafeInsert($_POST['username'])."',
			user_password = '".md5($_POST['password'])."',
			user_email = '".mysql_real_escape_string($_POST['email'])."',
			user_status = 1
			
			";
			if(mysql_query($sql, $db)){
				$_SESSION['attempts'] = 1;
				echo refer($Gbl['SiteUrl'].'?p=login',$Gbl['ErrorTime'],'Thank You. Your Account Has Been Created.');
			}else{
				echo 'Critical Error 67: Could not add your link. Please contact website administrator.'; exit;
			}		}
		
	}
}else{
	RegisterForm($error);	
}
				
				

?>