<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if($_GET['editid']){
		 
if(isset($_POST['edit'])){
	$sql = "UPDATE  ".$db_prefix."adsense SET
		code = '".mysql_real_escape_string($_POST['code'])."'
		WHERE adsense_id = ".$_GET['editid'];
	if($myrow = mysql_query($sql, $db)){
		refer('?p='.$_GET['p'],$Gbl['ErrorTime'],'Adsense Code Updated Successfully.');
	}else{
		echo 'error 14 - Unable to update code for some reason'; exit;
	}
}else{
	$sql = "SELECT * FROM ".$db_prefix."adsense WHERE adsense_id = ".$_GET['editid'];
	$dbResult = mysql_query($sql, $db);
	if(!$myrow = mysql_fetch_array($dbResult)){
		echo 'error 20 - No adsense_id found'; exit;
	}
echo '<h1>'.$myrow['description'].'</h1>';		
?>
<form name="form1" method="post" action="">
  <p>
    <textarea name="code" id="code" cols="60" rows="10"><?php echo htmlspecialchars($myrow['code']); ?></textarea>
  </p>
  <p>
    <input type="submit" name="edit" id="edit" value="Edit">
    <br />
  </p>
</form>
<?php 
}
		 }else{
			 





							$sql = "SELECT * FROM ".$db_prefix."adsense ";
							$dbResult = mysql_query($sql, $db);
							if($myrow = mysql_fetch_array($dbResult)){
								do{
									echo '<h1>'.$myrow['description'].'</h1>';
									echo '[ <a href="'.$_SERVER['REQUEST_URI'].'&editid='.$myrow['adsense_id'].'">EDIT</a> ]<br /><br /><textarea cols="45" rows="5" readonly>'.htmlspecialchars($myrow['code']).'</textarea><hr>';
								}while($myrow = mysql_fetch_array($dbResult));
							}else{
								echo 'error 9 - adsense, no adsense code found';
							}
								
								
		 }

?>
