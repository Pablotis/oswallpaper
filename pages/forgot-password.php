<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

function ForgotForm($error){
	?>
<div class="ForgotForm">
<div class="ForgotError"><?php echo $error; ?></div>
<form id="form1" name="form1" method="post" action="">
  <div class="ForgotUsername">Email:</div><div class="ForgotUsernameField"><input type="text" name="username" id="username" /></div>
  <div class="ForgotSubmit"><input type="Submit" name="Forgot" value="Send Password" /></div>
</form>
</div>
<?php 	
}

if(isset($_POST['Forgot'])){
	if(!CheckEmail($_POST['username'])){
		$error = 'Valid Email Is Required';
	}
	
	if($error){
		$_SESSION['attempts'] ++;
		ForgotForm($error);
	}else{
		$sql = "SELECT user_email FROM ".$db_prefix."users WHERE user_email = '".mysql_real_escape_string($_POST['username'])."'";
		$result = mysql_query($sql ,$db);
		if ($myrow = mysql_fetch_array($result))  {
				$sql = "UPDATE ".$db_prefix."users SET
				reset_password = '".session_id()."'
				WHERE user_email = '".mysql_real_escape_string($myrow['user_email'])."'";
				if(mysql_query($sql ,$db)){
					# SUCCESS - USER'S PASSWORD WAS UPDATED, RESET SESSION
					$_SESSION['attempts'] = 1;
					# SEND USER TO LOGIN PAGE
					echo refer('?p=login',70,'Your Password Has Been Send to your Email.');
				}else{
					# THERE WAS A PROBLEM UPDATING THE DATABASE. UNCOMMENT THE FOLLOWING LINE TO DEBUG:
					echo 'Critical error 25 found, please report to admin'; exit;
				}
		}else{
			$_SESSION['attempts'] ++;
			ForgotForm('Sorry, Your Account Was Not Found<br /><a href="?p=register">Register Now</a>');
		}		
/*		
		$recipient = "example@example.net"; // THIS WILL BE THE EMAIL WHERE THE FORM WILL BE SENT
		$subject = "Contact Us Form "; // THE EMAIL SUBJECT
		$forminfo =
		" Hello, .\n
		Your web form was submited by someone on your wesbite\n";
		
		mail("$recipient", "$subject", "$forminfo", "From: $email\r\nReply-to:$email");	
		*/
	}
}else{

ForgotForm('Your Password Will Be Sent To Your E-Mail');
}

?>