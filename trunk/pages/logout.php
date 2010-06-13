<?php 
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
session_destroy();
unset($_SESSION['username']);
unset($_SESSION['password']);
echo refer($_GET['r'],$Gbl['ErrorTime'],'Logging You Out');
?>