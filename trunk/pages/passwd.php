<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
function ResetForm($error){
	
	?>
<div class="ResetForm">
<div class="ResetError"><?php echo $error; ?></div>
<form id="form1" name="form1" method="post" action="">
	   <div class="RegisterPasswordForm">Password:</div><div class="RegisterPasswordField"><input type="password" name="password" id="password"  value="<?php echo $_POST['password']; ?>"/></div>
      <div class="RegisterPasswordReenterForm">Re-Enter Password:</div><div class="RegisterPasswordReenterField"><input type="password" name="repassword" id="repassword"  value="<?php echo $_POST['repassword']; ?>"/></div>
  <div class="ResetSubmit"><input type="Submit" name="Reset" value="Reset Password" /></div>
</form>
</div>
<?php 	
}

if($_GET['i']){
	# THE FORM WAS SUBMITTED
	if(isset($_POST['Reset'])){
		# CHECK PASSWORD POLICY
		$error = CheckPassword($_POST['password']);
		if($error){
			# ERRORS FOUND - DISPLAY FORM AGAIN
			$_SESSION['attempts'] ++;
			ResetForm($error);
		}else{
			# NO ERRORS FOUND IN FORM, QUERY DATABSE FOR SESSION KEY
			$sql = "SELECT reset_password FROM ".$db_prefix."users WHERE reset_password = '".mysql_real_escape_string($_GET['i'])."'";
			$result = mysql_query($sql ,$db);
			if ($myrow = mysql_fetch_array($result))  {
				# SESSION KEY FOUND, UPDATE USER'S PASSWORD AND REMOVE SESSION KEY
				$sql = "UPDATE ".$db_prefix."users SET
				user_password = '".mysql_real_escape_string(md5($_POST['password']))."',
				reset_password = ''
				WHERE reset_password = '".mysql_real_escape_string($myrow['reset_password'])."'";
				if(mysql_query($sql ,$db)){
					# SUCCESS - USER'S PASSWORD WAS UPDATED, RESET SESSION
					$_SESSION['attempts'] = 1;
					# SEND USER TO LOGIN PAGE
					echo refer('?p=login',$Gbl['ErrorTime'],'Your Password Has Been Reset');
				}else{
					# THERE WAS A PROBLEM UPDATING THE DATABASE. UNCOMMENT THE FOLLOWING LINE TO DEBUG:
					echo 'Critical error 25 found, please report to admin'; exit;
				}
			}else{
				# SESSION ID WAS NOT FOUND IN THE DATBASE, SEND USER TO FORGOT PASSWORD PAGE
				$_SESSION['attempts'] ++;
				echo refer('?p=forgot-password',$Gbl['ErrorTime'],'Session Expired'); exit;
			}				
		}
	}else{
		# FORM HAS NOT BEEN SUBMITTED YET
		ResetForm('Reset Your Password');
	}
}else{
	# NO SESSION ID FOUND, PROBABLY DIRECT ACCESS, NOT ALLOWED
	echo refer($Gbl['SiteUrl'],$Gbl['ErrorTime'],'Loading Page');	
}
		 
		 

?>