<?php
  /**
  *
  * @package wallpaperscript_beta
  * @copyright (c) 2009 wallpaperscript.org
  * In Collaboration with: www.webune.com & www.wallpaperama.com
  * @license http://opensource.org/licenses/gpl-license.php GNU Public License
  *
  */
######################## OSWALLPAPER CONFIGURATION SETTINGS ##########################

# DB CONNECTION
$dbhost = ''; // your mysql hostname name or ip address - NOTE: Usually its 'localhost'
$dbuser = ''; // the login user of the database
$dbpasswd = ''; // the password of the login user
$dbname = ''; // the database name

// your website absolute url: example: http://www.wallpaperama.com/  - WARNING: be sure the path ends with a / at the end
$Gbl["ManualSiteUrl"] = '';

// your absolute script directory lacation; example: /home/oswallpaper/demo/ - WARNING: be sure the path ends with a / at the end
$Gbl["ManualWallpaperDir"] = ''; 

// enable mod rewrite urls. 0=disabled, 1=enabled for SEO Friendly URLS
$Gbl["ManualModRewrite"] = 0;


// Get a key from http://recaptcha.net/api/getkey 
// to enable secured wallpaper comments
// LEAVE BLANK TO DISABLE COMMENTS ON WALLPAPERS  
$publickey = "";
$privatekey = "";
# END - STOP HERE #####################################################
 
############## DO NOT EDIT BELOW THIS LINE ################
$ManualInstall = 1;
$Gbl["ManualSiteUrlWalls"]= $Gbl["ManualSiteUrl"].'wallpapers/' ; // dont change this unless you know you want the wallpapers to be installed in a different directory  than the default
$Gbl["ManualScriptDIr"] = $Gbl["ManualWallpaperDir"].'wallpapers/' ; // dont change this unless you know you want the wallpapers to be installed in a different directory than the default
$Gbl["ManualIsWriteable"] = false; // WARNING: Make sure your give writing permission 777 to the wallpapers/ directory, once you have changed permissions, change this value to 1;
$db_prefix = 'wallpaper_';
// CHECK DB CONNECTION
if(!$db = mysql_connect($dbhost, $dbuser, $dbpasswd)){
	echo '<strong style="color:red;">Error 1: Cannot Connect to Database.</strong><br />Check Database username and password Settings in : includes/config.php'; exit;
}
// CHECK DATABSE
if(!mysql_select_db($dbname,$db)){
	echo '<strong style="color:red;">Error 1: Cannot Connect to Database Table.</strong><br />Check Database Connection Settings in : includes/config.php'; exit;
}
?>
