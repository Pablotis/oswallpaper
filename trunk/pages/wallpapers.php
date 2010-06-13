<?php 
/**
*
* @package wallpaperscript_beta
* @copyright (c) 2009 wallpaperscript.org
* In Collaboration with: www.webune.com & www.wallpaperama.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/


?>
<div class="CategoryBox"><!-- START CategoryBox -->
                        <?php 
					
						if($_GET['pg']){
							if($_GET['pg']==1){
								$start = 0;
							}else{
								$start = ($_GET['pg']-1) * $Gbl['WallpaperPerPage'];
							}
						}else{
							$start = 0;
						}
							
							$sql = "SELECT * FROM ".$db_prefix."wallpaper WHERE category_id = '".$Pg['category_id']."' AND active = 1 ORDER BY wallpaper_id ASC LIMIT ".$start .",".$Gbl['WallpaperPerPage'];
							$dbResult = mysql_query($sql, $db);
							if($myrow = mysql_fetch_array($dbResult, MYSQL_ASSOC)){
								do{
echo'
                      <div class="WallpaperIconSec">
                        <div class="WallpaperIcon"><a href="'.WallpaperUrl($myrow['wallpaper_url']).'"><img src="'.WallpaperImage('icons',$myrow['wallpaper_url']).'" alt="'.$myrow['wallpaper_name'].' wallpaper" width="'.$Gbl['IconWidth'].'" height="'.$Gbl['IconHeight'].'" border="0" /></a></div>
                        <div class="WallpaperIconName"><a href="'.WallpaperUrl($myrow['wallpaper_url']).'" class="WallpaperIconLink">'.$myrow['wallpaper_name'].' wallpaper</a></div>
                      </div>
';
							}while($myrow = mysql_fetch_array($dbResult, MYSQL_ASSOC));
							}else{
								echo 'No '.$_GET['i'].' Wallpapers Found';	
							}
					
						
							
						
						?>

<?php 
	$sql2 = "SELECT COUNT(wallpaper_id) FROM ".$db_prefix."wallpaper WHERE category_id = '".$Pg['category_id']."' AND active = 1";
	$result2 = mysql_query($sql2 ,$db);
	if($row2 = mysql_fetch_row($result2)){
		$num_of_items = $row2[0];
	}else{
		echo 'critical error 31. No Count Found'; exit;
	}
	
?>
<div class="CatPageNumbs">
<?php 
  ############################################ PAGINATION FUNCTION ########################################
  ############################################ PAGINATION FUNCTION ########################################
  function pagination_link($category_url, $page_num){ 
  	return CatUrl($category_url,$page_num);
  }
  function pagination($num_of_items, $items_per_page, $id, $page_num, $max_links){
	  if($num_of_items < $items_per_page ){
		return false; // return no link if no page_num or page_num is 1  
	  }
	  $total_pages = ceil($num_of_items/$items_per_page);
	  echo 'Pages: ';
	  if($page_num) {
	  	if($page_num >1){ 
	  		if($page_num == 1){
				$prev = '<a href="'.CatUrl($id,'').'" class="PaginationPrev">Prev &lt;&lt;</a>'; 
			}else{
				if($page_num > 2){
					$prev = '<a href="'.pagination_link($id, ($page_num -1 )).'" class="PaginationPrev">&lt; Prev</a>';
				}
				
			}
			 
	  		$first = '<a href="'.CatUrl($id,'').'"  class="PaginationFirst">First &lt;&lt;</a>'; 
	  	}
	  }
	  if($page_num < $total_pages){ 
	  		if($page_num == 1 || !$page_num){
				$next = '<a href="'.pagination_link($id, 2).'" class="PaginationNext">Next &gt;</a>';  
			}else{
				$next = '<a href="'.pagination_link($id, ($page_num+1)).'" class="PaginationNext">Next &gt;</a>'; 
			}
		
	  	
		$last = '<a href="'.pagination_link($id, $total_pages).'" class="PaginationLast">Last &gt;&gt;</a>';
	  }
	  echo $first;
	  echo $prev;
	  $loop = 1;
	  if($page_num >= $max_links) {
	  	$page_counter = ceil($page_num - ($max_links-1));
	  } else {
	  	$page_counter = 1;
	  }
	  
	  if($total_pages < $max_links){
	  	$max_links = $total_pages;
	  }
	  do { 
	  	if($page_counter == $page_num) {
	  		echo '<span class="PaginationSelected">'.$page_counter.'</span>'; 
	  	} else {
			if($page_counter == 1){
				echo '<a href="'.CatUrl($id,'').'" class="PaginationPgNum">'.$page_counter.'</a>';
			}else{
				echo '<a href="'.pagination_link($id, ($page_counter)).'" class="PaginationPgNum">'.$page_counter.'</a>';
			}
	  		
	  	} 
	  	$page_counter++; $current_page=($page_counter+1);
	  	$loop++;
	  } while ($max_links >= $loop);
	  echo $next;
	  echo $last;
  }


  pagination($num_of_items, $Gbl['WallpaperPerPage'], $_GET['i'], $_GET['pg'], $Gbl['WallpaperPerPageMaxLinks']);
  ?> 
</div>
                      
                      
                      
 
</div> <!-- END CategoryBox --> 
