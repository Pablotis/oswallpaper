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
				if($_REQUEST['Submit']){
					$sql = "INSERT INTO ".$db_prefix."config(
					config_name,
					config_value,
					config_desc
						) values( 
					'".SafeInsert($_REQUEST['config_name'])."',
					'".SafeInsert($_REQUEST['config_value'])."',
					'".SafeInsert($_REQUEST['config_desc'])."'
						)";
					if(mysql_query($sql ,$db)) {
						echo 'SUCCESSFULLY ADDED, <a href="'.$_SERVER['REQUEST_URI'].'&do='.$_REQUEST['do'].'">CONTINUE</a>';
					}else{
						echo mysql_error();
					}
				}else {
					echo LinkForm($_POST,'Admin Add link');
				}
			break;
			case 'edit':
			if($_REQUEST['Link']){

				
				
				$sql = "UPDATE ".$db_prefix."links SET
				link_title  = '".SafeInsert($_REQUEST['link_title'])."',
				link_url  = '".SafeInsert($_REQUEST['link_url'])."',
				link_description  = '".SafeInsert($_REQUEST['link_description'])."',
				link_username  = '".SafeInsert($_REQUEST['link_username'])."',
				link_useremail  = '".SafeInsert($_REQUEST['link_useremail'])."',
				link_status = '".SafeInsert($_REQUEST['link_status'])."'
				WHERE link_id = '".SafeInsert($_REQUEST['link_id'])."'
				
				";
				if(mysql_query($sql ,$db)) {
					echo refer(PageUrl('links'),$Gbl['ErrorTime'],'Link Update Success');
				}else{
					echo "Wallpaperama ERRRO 38 ".mysql_error();
				}

			} else {
				
				$sql = "SELECT * FROM ".$db_prefix."links WHERE link_id = '".$_GET['link_id']."'";
				$result = mysql_query($sql ,$db);
				$myrow = mysql_fetch_array($result);			
				LinkForm($myrow, 'Admin - Edit Link','Edit');
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
			
			echo refer(PageUrl('links'),$Gbl['ErrorTime'],'Loading Links Page');
			break;			
			
		}
?>