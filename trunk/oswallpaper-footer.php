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
                    </div>
                    <span class="cb"><span class="cl"></span></span>
                </div> 
            <!-- END CONTENT BOX -->
            <!-- START RIGHT MENU -->
                <div class="RightBox">
                    <span class="ct"><span class="cl"></span></span>
                    <div class="RightBoxi">
                    	<div class="Banner120x600"><?php
						if($UserData['Admin']){
							echo 'No Adsense When Logged In As Admin to preven clicks by mistake';
						}else{
							echo Adsense(2); 
						}
						
						
						?></div>
                        

                  </div>
                    <span class="cb"><span class="cl"></span></span>
                </div>       
            <!-- END RIGHT MENU -->
            <!-- START FOOTER BOX -->
                <div class="FooterBox">
                    <span class="ct"><span class="cl"></span></span>
                    <div class="FooterBoxi">
                    <div class="Footer">
                    
                    Coppyright &copy;<?php echo date('Y').' <a href="'.$Gbl['SiteUrl'].'" title="'.$Gbl['SiteName'].'">'.str_replace('www.','',$_SERVER['HTTP_HOST']).'</a>'; ?>
                    <br />
<!--
	We request you retain the full copyright notice below including the link to www.wallpaperscript.org.
	This not only gives respect to the large amount of time given freely by the developers
	but also helps build interest, traffic and use of OSWallpaper Walllpaper Script. If you (honestly) cannot retain
	the full copyright we ask you at least leave in place the "Powered by OSWallpaperScript" line, with
	"OSWallpaper" linked to http://www.wallpaperscript.org. If you refuse to include even this then support on our
	Wallpaper Script may be affected. Thanks for your support.

	The OSWallpaper Team : 2009
//-->
                    <?php 
					 echo '<br />Powered By <a href="http://www.wallpaperscript.org" title="Open Source Wallpaper Script">OS Wallpaper Script</a><br />Hosting By: <a href="http://www.webune.com" title="Hosting for Wallpaper Script">Webune</a>';
					#############################################
					###### PLEASE DO NOT REMOVE OUR LINK ########
					#############################################
					
					?>
                    </div>



                </div>
                    <span class="cb"><span class="cl"></span></span>
                </div>       
            <!-- END FOOTER BOX -->
            
        </div><!-- END Class mbox -->
        <span class="cb"><span class="cl"></span></span>
	</div><!-- END Class mboxi -->
</body>
</html>