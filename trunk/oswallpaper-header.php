<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
session_start();
include_once('includes/config.php');
include_once('includes/functions.php');
include_once('includes/globals.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucwords ($Pg['page_title'].' - '.$Gbl['SiteName']); ?></title>
<meta name="description" content="<?php echo $Pg['page_description']; ?>" />
<meta name="keywords" content="<?php echo $Pg['page_keywords']; ?>" />
<link href="<?php echo $Gbl['SiteUrl']; ?>theme/<?php echo $Gbl['Theme']; ?>/<?php echo $Gbl['Theme']; ?>.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="mbox">
		<span class="ct"><span class="cl"></span></span>
		<div class="mboxi">
            <!-- START HEADER -->
            <div class="SiteLogo"><a href="<?php echo $Gbl['SiteUrl']; ?>"><img src="<?php echo $Gbl['SiteUrl']; ?>images/logo-blank.gif" width="138" height="50" border="0" alt="logo"/></a></div>
            <div class="SiteTitleTop"><?php echo ucwords ($Pg['page_title']); ?></div>
            	<div class="MenuTopLinkSec"> <?php
					if($LoginCheck){ ?>
						<div class="MenuTopLinkHello">Hello </div><div class="MenuTopLinkUserName"><?php echo $UserData['user_name']; ?></div>
                        <div class="MenuTopLinkUpload"><a href="<?php echo $Gbl['SiteUrl']; ?>?p=upload" class="MenuTopLinkUploadLink">Upload Wallpaper</a></div>
                        <div class="MenuTopLinkLogout"><a href="<?php echo $Gbl['SiteUrl']; ?>?p=logout&r=<?php if($UserData['Admin']){ $LogoutUrl = $Gbl['SiteUrl']; }else{$LogoutUrl = WebuneFullUrl();} echo urlencode ($LogoutUrl); ?>" class="MenuTopLinkUserNameLink">Logout</a></div>
					<?php 
                    }else{
					?>
                		<div class="MenuTopLinkLogin"><a href="<?php echo PageUrl('login'); ?>" class="MenuTopLinkLoginLink">Login</a></div>
            			<div class="MenuTopLinkRegister"><a href="<?php echo PageUrl('register'); ?>" class="MenuTopLinkRegisterLink">Register</a></div><?php 
					}
					?>
            </div>
            <div class="AdHeader">
            <?php 
			if($UserData['Admin']){
				echo 'Admin Pages: ';
				$sql = "SELECT * FROM ".$db_prefix."pages WHERE page_level > 2 ORDER BY page_name ASC ";
				$result = mysql_query($sql ,$db);
				if ($myrow = mysql_fetch_array($result))  {
					do{
						echo '<a href="'.$Gbl['SiteUrl'].'?p='.$myrow['page_url'].'">'.$myrow['page_name'].'</a> | ';
					}while($myrow = mysql_fetch_array($result));
				}else{
					if(mysql_error()){
					echo 'Critical Error 43 in oswallpaper-header.php'; exit;
					}
				}
				
				
				
			}else{ 
				echo Adsense(1);
			?>
            <?php 
            }
			?>
            </div>
            <!-- END HEADER -->

            <!-- START LEFT MENU -->
                <div class="LeftBox">
                    <span class="ct"><span class="cl"></span></span>
                    <div class="LeftBoxi">
                    	<div class="CatHeader">Categories</div>
                        <?php 
							$sql = "SELECT * FROM ".$db_prefix."category ORDER BY category_name ASC";
							$dbResult = mysql_query($sql, $db);
							while($myrow = mysql_fetch_array($dbResult, MYSQL_ASSOC)){
								echo '<div class="CatName"><a href="'.CatUrl($myrow['category_url'],'').'" class="CatNameLink" title="'.$myrow['category_name'].' Wallpapers">'.$myrow['category_name'].'</a></div>';
							}
						?>
                    
                     <div class="LeftBoxFriends">
                     	<div class="FriendsHeader">Friends</div>
                        
                        <?php 
							$sql = "SELECT * FROM ".$db_prefix."links WHERE link_status = 1 ORDER BY link_id ASC LIMIT 0,20";
							$dbResult = mysql_query($sql, $db);
							while($myrow = mysql_fetch_array($dbResult, MYSQL_ASSOC)){
								echo '<div class="FriendsUrl"><a href="'.$myrow['link_url'].'" class="FriendsLink" title="'.$myrow['link_title'].'" target="_blank">'.$myrow['link_title'].'</a></div>';
							}
						?>
                        <div class="FriendsMore"><a href="<?php echo PageUrl('links'); ?>" class="FriendsMoreLink">More Links</a></div>
                        <div class="FriendsAdd"><a href="<?php echo PageUrl('add-link'); ?>" class="FriendsAddLink">Add Link</a></div>
                     </div>                   
                    
                     </div>
                    <span class="cb"><span class="cl"></span></span>
                </div>       
            <!-- END LEFT MENU -->

            <!-- START CONTENT BOX -->
                <div class="ContentBox">
                    <span class="ct"><span class="cl"></span></span>
                    <div class="ContentBoxi">