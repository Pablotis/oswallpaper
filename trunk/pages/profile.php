<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/


		switch($_REQUEST['action']){
			case 'add';
				// goto register.php
			break;
			case 'edit':
			if($_REQUEST['Profile']){

				
				
				$sql = "UPDATE ".$db_prefix."users SET
				user_password  = '".md5(mysql_real_escape_string($_REQUEST['user_password']))."'
				WHERE user_email = '".$_SESSION['username']."'
				
				";
				if(mysql_query($sql ,$db)) {
					$_SESSION['password'] = StripData($_POST['user_password']);
					echo refer(PageUrl('profile'),$Gbl['ErrorTime'],'Profile Changed');
				}else{
					echo "Wallpaperama ERRRO 30 profiles ".mysql_error();
				}

			} else {
				
				$sql = "SELECT * FROM ".$db_prefix."users WHERE user_email = '".$_SESSION['username']."'";
				$result = mysql_query($sql ,$db);
				$myrow = mysql_fetch_array($result);			
				ProfileForm($myrow, 'Edit Profile','Edit');
			}
			break;
			
			case 'delete':
			if($_REQUEST['delete']=='yes'){
				$sql = "DELETE FROM ".$db_prefix."links WHERE link_id = '".$_GET['link_id']."'";
				if($result = mysql_query($sql ,$db)){
					echo refer(PageUrl('links'),$Gbl['ErrorTime'],'Link Deleted Success');
				}else{
					echo 'Wallpaperama Error: 69<br>'.mysql_error(); exit;
				}
			}else{
				echo 'are you sure you want to delete this link?<br><br><a href="'.$Gbl['SiteUrl'].'?p=admin-links&action=delete&link_id='.$_GET['link_id'].'&delete=yes">Yes</a>';
			}
			break;
			
			default:
			
			echo refer(PageUrl('profile'),$Gbl['ErrorTime'],'Loading Links Page');
			break;			
			
		}
?>