<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
## LOCAL FUNCTIONS:
		function form_addconfig($config_name, $config_value, $config_desc){
				?>
				<form method="post" action="<?php echo $_SERVER['PHP_URI']; ?>">
				config_name<br />
<input name="config_name" type="text" value="<?php echo $config_name; ?>" size="50">
				<br />
				<br />
				config_value (max 255 chars)<br />
<input name="config_value" type="text" value="<?php echo htmlentities($config_value); ?>" size="100" maxlength="255">
				 <br />
				 <br />
				config_desc (max 255 chars)<br />
<input name="config_desc" type="text" value="<?php echo $config_desc; ?>" size="100" maxlength="255">
				<br />
				<br />
				<input type="submit" name="Submit" value="Submit">
			
				</form>
				<?php 
}

		echo '<a href="?p='.$_GET['p'].'">Configs</a><br /><br />';
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
					form_addconfig('', '', '');
				}
			break;
			case 'edit':
			if($_REQUEST['Submit']){

				
				
				$sql = "UPDATE ".$db_prefix."config SET
				config_name = '".SafeInsert($_REQUEST['config_name'])."', 
				config_value = '".SafeInsert($_REQUEST['config_value'])."',
				config_desc = '".SafeInsert($_REQUEST['config_desc'])."'
				WHERE config_id='".$_REQUEST['config_id']."'
				";
				if(mysql_query($sql ,$db)) {
					echo '<a href="'.$_SERVER['REQUEST_URI'].'&do='.$_REQUEST['do'].'">SUCCESSFULLY EDITED CONTINUE</a>';
				}else{
					echo "ERRRO 38 ".mysql_error();
				}

			} else {
				
				$sql = "SELECT * FROM ".$db_prefix."config where config_id='".$_REQUEST['config_id']."'";
				$result = mysql_query($sql ,$db);
				$myrow = mysql_fetch_array($result);			
				form_addconfig($myrow['config_name'], $myrow['config_value'], $myrow['config_desc']);
			}
			break;
			
			default:
			
			$sql = "SELECT * FROM ".$db_prefix."config";
			$result = mysql_query($sql ,$db);
		
			echo '<table border="0" cellpadding="5" cellspacing="0"  >';
			while ($myrow = mysql_fetch_array($result)) {
				if($Style == "Alt1") {$Style = "Alt2";} else {$Style = "Alt1";}
				echo '<tr class="'.$Style.'"><td>'.$myrow['config_name'].'</td>
				<td><a href="'.$_SERVER['REQUEST_URI'].'&action=edit&config_id='.$myrow['config_id'].'">EDIT</a></td>
				<td><input type="text" value="'.$myrow['config_value'].'" size="50" readonly><br />
				'.$myrow['config_desc'].'
				</td>
				
				</tr>';
				//$board_config[$row['config_name']] = $row['config_value'];
				
			}
			echo '</table>';
			break;			
			
		}
?>