<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if(isset($_POST['Login'])){
	if(!$_POST['username'] || !$_POST['password']) {
		$_SESSION['attempts'] ++;
		LoginForm('*All Fields Are Required');
	}else{
		if(!empty($_SESSION['username']) && !empty($_SESSION['password'])){
			$_SESSION['attempts'] ++;
			echo refer($Gbl['SiteUrl'],$Gbl['ErrorTime'],'You are already logged in. 2');
		}else{
			if($LoginError = LoginCheck($_POST['username'],$_POST['password'])){
				$_SESSION['attempts'] ++;
				LoginForm($LoginError);
			}else{
				$_SESSION['username'] = StripData($_POST['username']);
				$_SESSION['password'] = StripData($_POST['password']);
				session_write_close();
				if(!$_POST['ref_url']){
					$_POST['ref_url'] = $Gbl['SiteUrl'];
				}
				$_SESSION['attempts'] = 1;
				echo refer($Gbl['SiteUrl'],$Gbl['ErrorTime'],'Welcome, Loading Profile');				
			}
		}
	}
}else{
	if(!empty($_SESSION['username']) && !empty($_SESSION['password'])) {
		$_SESSION['attempts'] ++;
		echo refer($Gbl['SiteUrl'],$Gbl['ErrorTime'],'You are already logged in. 1');
	}else{
		LoginForm('Please Login');
	}
}
?>
