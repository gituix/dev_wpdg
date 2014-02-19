      </div>  
</div>
 
      </div>   
		<?php   if(TPO_DISABLE_FOOTER_WIDGETS!='true') { ?>
            	<?php include (TEMPLATEPATH . '/sidebar-footer.php'); ?>
		<?php  } ?>
		
		<div id="footer_wrapper">
        <div id="footer">
                <div id="footer_text">
                    <?php
                         if ( tpo_option('tpo_footertext') ) {
                            ?> &copy; <?php echo date('Y'); ?>  <?php echo get_bloginfo('name'); ?>. All right reserved. Designed by <a href="http://www.zebrathemes.com">NGO WordPress Themes</a><?php 
                         } else {
                            ?> &copy; <?php echo date('Y'); ?>  <?php echo get_bloginfo('name'); ?>. All right reserved. <div class="zebrathemes" >Designed by  <a href="http://www.zebrathemes.com">NGO WordPress Themes</a></div> <?php 
 /* If you want to use this theme, you must keep footer link( NO JUNK CODE ). We appreciate if you buy link free version to access our support forum and help us developing new themes for you people. http://zebrathemes.com/buy/?wordpress-theme=TheNgo */ ?><?php
                         }
                    ?>
            </div>
        </div>
		</div>
       
</div>
	<?php  wp_footer(); ?>
</body>
</html>
