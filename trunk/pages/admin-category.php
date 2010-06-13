<?php
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
echo '<div style="padding:5px;">';
echo '<pre>';
//print_r($_POST);
echo '</pre>';
$button_name = $_GET['action'];
################################################# LOCAL FUNCTIONS ###################################################
################################################# LOCAL FUNCTIONS ###################################################
function form($error,$values,$button_name)
{
	global $db, $db_prefix;
	if($error){
		echo '<div style="color:red;margin-bottom:10px;">'.$error.'</a></div>';
	}?>
	<form id="Form" name="Form"  method="post" action="">
	  <p><strong>Category Name:</strong><br />
	    <input name="category_name" type="text" id="category_name" value="<?php echo htmlspecialchars($values['category_name']); ?>" size="30" maxlength="50" />
	  </p>      
<?php 
	if($button_name == 'edit'){ ?>
	  <p><strong>Category Url:</strong><br />
<input name="category_url" type="text" id="category_url" value="<?php echo $values['category_url']; ?>" size="30" maxlength="50" />
	    <br />
	    <strong><em>WARNING</em></strong>: <br />
	    * 
	    do not use spaces or special characters. Only use the dash character. <br />
	    * Good Example: cute-animals <br />
	    * If you change the category url, your Search Engine Ranking will be affected
	    <br />
	    <br />
	  </p>		
<?php
	}
?>
     
     
     
      <p><strong>Category Description:</strong><br />
        <textarea name="category_description" cols="45" rows="3" id="category_description"><?php echo htmlspecialchars($values['category_description']); ?></textarea>
	  </p>
	  <p><strong>Category Description:</strong> (separate words with commas)<br />
	    <input name="category_keywords" type="text" id="category_keywords" value="<?php echo htmlspecialchars($values['category_keywords']); ?>" size="50" maxlength="100" />
	  </p>
	  <p>
	    <input type="submit" name="<?php echo $button_name; ?>" value="<?php echo $button_name; ?>">
      </p>
</form>
	<?php 
}
################################################# LOCAL FUNCTIONS ###################################################
################################################# LOCAL FUNCTIONS ###################################################
switch($_GET['action']){
###################################### ADD #############################
	case 'add':
		if($_REQUEST[$button_name]){
			// the $button_name (Submit) was hit instead of the preview button
			if(!$_POST['category_name'] || !$_POST['category_description'] || !$_POST['category_keywords'] ){
				$error = 'All fields are required';
			}
			$sql = "SELECT category_id FROM ".$db_prefix."category WHERE category_url='".CleanUrl($_POST['category_name'])."'";
			$result = mysql_query($sql ,$db);
			if ($myrow = mysql_fetch_array($result)){
				$error = 'Duplicate Category: '.CleanUrl($_POST['category_name']).' <a href="'.$Gbl['SiteUrl'].'?p=admin-category&action=edit&catid='.$myrow['category_id'].'">[Edit Now]</a>';
			}
			if($error){
				echo form($error,$_POST,$button_name);
			}else{
				$sql = "INSERT INTO ".$db_prefix."category SET
				category_name = '".SafeInsert(strtolower($_POST['category_name']))."',
				category_url = '".CleanUrl($_POST['category_name'])."',
				category_description = '".SafeInsert(strtolower($_POST['category_description']))."',
				category_keywords = '".SafeInsert(strtolower($_POST['category_keywords']))."'
				
				";
			if(mysql_query($sql, $db)){
				echo refer($Gbl['SiteUrl'].'?p='.$_GET['p'],$Gbl['ErrorTime'],'New Wallpaper Category '.$_POST['category_name'].' Has Been Created');
			}else{
				echo $_SERVER['PHP_SELF'].'<br />SQL ERROR LINE: '.__LINE__.'<br /><span style="color:red">'.mysql_error().'</span><br />'.$sql; exit;

			}		
			
			}
		}else{
			// these are the form variables, these are just some examples.
			echo form($error,$values,$button_name);
		}	
	break; // add
###################################### EDIT #############################
	case 'edit':	
		if($_REQUEST[$button_name]){
			// the $button_name (Submit) was hit instead of the preview button
				$sql = "UPDATE ".$db_prefix."category SET
				category_name = '".SafeInsert(strtolower($_POST['category_name']))."',
				category_url = '".CleanUrl($_POST['category_url'])."',
				category_description = '".SafeInsert(strtolower($_POST['category_description']))."',
				category_keywords = '".SafeInsert(strtolower($_POST['category_keywords']))."'
				WHERE category_id = ".$_GET['catid']."
				";
			if(mysql_query($sql, $db)){
				echo refer($Gbl['SiteUrl'].'?p='.$_GET['p'],$Gbl['ErrorTime'],'Wallpaper Category '.$_POST['category_name'].' Has Been Edited Succesfully');
			}else{
				echo $_SERVER['PHP_SELF'].'<br />SQL ERROR LINE: '.__LINE__.'<br /><span style="color:red">'.mysql_error().'</span><br />'.$sql; exit;
			}		
		}else{
			// these are the form variables, these are just some examples.
			$sql = "SELECT * FROM ".$db_prefix."category WHERE category_id=".$_GET['catid'];
			$result = mysql_query($sql ,$db);
			if ($myrow = mysql_fetch_array($result)){
				echo form($error,$myrow,$button_name);
			}else{
				echo $_SERVER['PHP_SELF'].'<br />SQL ERROR LINE: '.__LINE__.'<br /><span style="color:red">'.mysql_error().'</span><br />'.$sql; exit;
			}
		}	
	break; // edit'
###################################### DELETE #############################
	case 'delete':	
		if($_REQUEST[$button_name]){
			$sql = "SELECT category_id FROM ".$db_prefix."wallpaper WHERE category_id=".$_GET['catid']." LIMIT 0,1";
			$result = mysql_query($sql ,$db);
			if ($myrow = mysql_fetch_array($result)){
				echo 'You cannot delete this category. it cotains wallpapers<br />
				Do you want to edit this category: <a href="'.$Gbl['SiteUrl'].'?p=admin-category&action=edit&catid='.$myrow['category_id'].'">Yes</a>';
			}else{
				$sql = "DELETE FROM ".$db_prefix."category WHERE category_id=".$_GET['catid'];
				if(mysql_query($sql ,$db)){
					echo refer($Gbl['SiteUrl'].'?p='.$_GET['p'],$Gbl['ErrorTime'],'Wallpaper Category Has Been Deleted');
				}else{
					echo $_SERVER['PHP_SELF'].'<br />SQL ERROR LINE: '.__LINE__.'<br /><span style="color:red">'.mysql_error().'</span><br />'.$sql; exit;
				}
			}
			
		}else{
			echo '
				<form method="post">
				Are You Sure You Want To Delete Post '.$_GET['post_id'].'? <a href="'.$Gbl['SiteUrl'].'?p=admin-category">[Cancel]</a> <br />
				<input type="submit" name="'.$button_name.'" value="'.$button_name.'"> 
				</form>
			
			';
		}		
	break; // delete	
###################################### DEFAULT #############################
	default:
echo 'this is a list of all the current categories<br />NOTE: This page is not complete yet. i need more time. :)<br /><br />';

echo 'Wallpaper Categories - Click on the category to see the wallpapers associated with the category<br /><br /><br />
<a href="'.$Gbl['SiteUrl'].'?p=admin-category&action=add">Add Category</a><br /><br />';				
				$sql = "SELECT * FROM ".$db_prefix."category ORDER BY category_name ASC ";
				$result = mysql_query($sql ,$db);
				if ($myrow = mysql_fetch_array($result))  {
					echo '<table border="0" cellpadding="5" cellspacing="5">';
					do{
						echo '<tr><td><strong>'.$myrow['category_name'].'</strong> - </td><td> <a href="'.$Gbl['SiteUrl'].'?p=admin-wallpaper&catid='.$myrow['category_id'].'&category_name='.$myrow['category_name'].'">View All Wallpapers</a> </td><td> <a href="'.$Gbl['SiteUrl'].'?p=admin-category&action=edit&catid='.$myrow['category_id'].'">[Edit]</a> </td><td> <a href="'.$Gbl['SiteUrl'].'?p=admin-category&action=delete&catid='.$myrow['category_id'].'">[Delete]</a></td></tr>';
					}while($myrow = mysql_fetch_array($result));
					echo '</table>';
				}else{
					if(mysql_error()){
					echo $_SERVER['PHP_SELF'].'<br />SQL ERROR LINE: '.__LINE__.'<br /><span style="color:red">'.mysql_error().'</span><br />'.$sql; exit;
					}
				}
break; // default
}

echo '</div>';	
				
?>