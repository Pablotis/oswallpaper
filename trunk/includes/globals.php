<?php
/**
*
* @package oswallpaper
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* 
*/




  if(!is_file("includes/config.php")){
    echo 'Error 15: Crital File Missing: Missing database connection file in includes/dbconn.php'; exit;
  }



# Avoid Password Flooding
if(isset($_SESSION['attempts']) && $_SESSION['attempts'] > 10 ){
	if($_POST){
		echo 'Too Many Attempts, Please Try Later'; exit;
	}
	
}
# SET CONFIGS
$sql = "SELECT config_name, config_value FROM ".$db_prefix."config";
$r = mysql_query($sql ,$db);
if ($row = mysql_fetch_array($r)){
		do  {
			$Gbl[$row['config_name']] = $row['config_value'];
		} while ($row = mysql_fetch_array($r));
}
# CHECK IF THIS SCRIPT WAS INSTALLED BY AUTO OSWALLPAPER.COM HOSTING
if($ManualInstall){
   $Gbl["SiteUrl"] = $Gbl["ManualSiteUrl"];
   $Gbl["WallpaperDir"] = $Gbl["ManualWallpaperDir"];
   $Gbl["ModRewrite"] = $Gbl["ManualModRewrite"];
   $Gbl["SiteUrlWalls"] = $Gbl["ManualSiteUrlWalls"];
   $Gbl["ScriptDIr"] = $Gbl["ManualScriptDIr"];
   $Gbl["IsWriteable"] = $Gbl["ManualIsWriteable"];
   $Gbl['WallpaperDir'] = $Gbl["ManualScriptDIr"];
}

if(!strstr($Gbl['SiteUrl'],$_SERVER['HTTP_HOST'])){
		echo 'Error 23 - Your Site is not Configured Correctly. Please Check the  <u>includes/config.php</u> file for correct configuration';
	exit;
}



if(!$Gbl['IsWriteable']){

	# CHECK SO MAKE SURE YOU HAVE GIVEN THE CORRECT PERMMISSIONS TO WALLPAPER DIRECTORIES
		
		$sql = "SELECT sizeid FROM ".$db_prefix."size ORDER BY sizeid ASC";
		$result = mysql_query($sql ,$db);
		if ($myrow = mysql_fetch_array($result)) {
		   do {
				if(!is_writable($Gbl['WallpaperDir'].$myrow['sizeid'].'/')){
					echo 'error 38 - globals<br />Directory: <strong>'.$Gbl['WallpaperDir'].$myrow['sizeid'].'/'. '</strong> is NOT writeable<br />Please Change Permissions to 777'; exit;	
				}	   
			} while ($myrow = mysql_fetch_array($result));
		}else{
			echo 'error 42 - globals';
		}
	
	if(!is_writable($Gbl['WallpaperDir'].'icons/')){
		echo 'error 38 - globals<br />Directory: <strong>'.$Gbl['WallpaperDir'].'icons/'. '</strong> is NOT writeable<br />Please Change Permissions to 777'; exit;		
	}
	if(!is_writable($Gbl['WallpaperDir'].'thumbs/')){
		echo 'error 38 - globals<br />Directory: <strong>'.$Gbl['WallpaperDir'].'thumbs/'. '</strong> is NOT writeable<br />Please Change Permissions to 777'; exit;		
	} 
	$sql = "UPDATE  ".$db_prefix."config SET
	config_value = 1
	WHERE config_name = 'IsWriteable'
	";
	if(!mysql_query($sql ,$db)){
		echo 'error 57 - globals'; exit;
	}
}

# USER VARILABLES
//print_r($_SESSION); exit;
		if(!empty($_SESSION['username'])){
			$sql = "SELECT * FROM ".$db_prefix."users WHERE user_email = '".mysql_real_escape_string($_SESSION['username'])."' AND user_password = '".md5($_SESSION['password'])."'";
			$dbResult = mysql_query($sql, $db);
			if($UserData = mysql_fetch_array($dbResult, MYSQL_ASSOC)){
				if($UserData['user_level'] == 10){
					$UserData['Admin'] = 1;
				}
				$LoginCheck = true;
			}else{
				$UserData['user_level']  = 1;
				$LoginCheck = false;

				
			}
		}else{
			$UserData['user_level']  = 1;
			$LoginCheck = false;

		}

if(isset($_GET['p']))
{
	$p = $_GET['p'];
}
else
{
	$p = $Gbl['DefaultPage'];
	// @todo fixme!
	$_GET['p'] = $Gbl['DefaultPage'];
}

switch($p){
	case 'wallpapers':
		if($_GET['i']){
			$sql = "SELECT * FROM ".$db_prefix."category WHERE category_url = '".mysql_real_escape_string($_GET['i'])."'";
			$dbResult = mysql_query($sql, $db);
			if($Pg = mysql_fetch_array($dbResult, MYSQL_ASSOC)){
				$Pg['page_title'] = $Pg['category_name'].' Wallpapers';
			}else{
				echo 'Error 11: No Category Found: '.$_GET['i']; exit;
			}
			
		}else{
			$Pg['page_title'] = 'Wallpaper Categories';	
		}
	$Pg['page_type'] = 2;
	if($_GET['pg']){
		$Pg['page_title'] = $Pg['page_title'].' Page '.$_GET['pg'];
	}
	if($Pg['category_description']){
		$Pg['page_description'] =  $Pg['category_description'];
	}else{
		$Pg['page_description'] =  $Pg['page_title'];
	}
	
	if($Pg['category_keywords']){
		$Pg['page_keywords'] =  $Pg['category_keywords'];
	}else{
		$Pg['page_keywords'] =  str_replace(' ',', ',$Pg['page_title']);
	}	
	break;
	
	case 'wallpaper':
		
		if($_GET['i']){
			$sql = "SELECT * FROM ".$db_prefix."wallpaper WHERE wallpaper_url = '".mysql_real_escape_string($_GET['i'])."' AND active = 1";
			$dbResult = mysql_query($sql, $db);
			if($Pg = mysql_fetch_array($dbResult, MYSQL_ASSOC)){
				$Pg['page_title'] = $Pg['wallpaper_name'].' Wallpaper';
			}else{
				echo 'Error 11: No wallpaper Found'; exit;
			}
		}else{
			echo 'Error 32: No Wallpaper Found'; exit;	
		}
		$Pg['page_type'] = 2;
		
		if($Pg['wallpaper_description']){
			$Pg['page_description'] =  $Pg['wallpaper_description'];
		}else{
			$Pg['page_description'] =  $Pg['page_title'];
		}
		if($Pg['wallpaper_keywords']){
			$Pg['page_keywords'] =  $Pg['wallpaper_keywords'];
		}else{
			$Pg['page_keywords'] =  str_replace(' ',', ',$Pg['page_title']);
		}	break;
	
	default:
		
		if($p){
			$sql = "SELECT * FROM ".$db_prefix."pages WHERE page_url = '".mysql_real_escape_string($p)."'";
			$dbResult = mysql_query($sql, $db);
			if(!$Pg = mysql_fetch_array($dbResult, MYSQL_ASSOC)){
				echo 'Error 43: No page Found'; exit;
			}
		}else{
			echo 'Error 46: No page Found'; exit;	
		}	
		if($Pg['page_level'] > $UserData['user_level']){
			echo 'Error 50: Not Authorized to view this page'; exit;
		}
	break;
}