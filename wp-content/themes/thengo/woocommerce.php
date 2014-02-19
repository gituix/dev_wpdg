<?php
/**
 * @package WordPress
 * @subpackage Templuto
 */

get_header(); ?>

	<div id="content" class="narrowcolumn" >

        <div class="woocommerce">
           		<?php if(function_exists('woocommerce_content')) { woocommerce_content(); } ?>
       </div>
    
	</div>  <!-- Content End -->
<?php get_sidebar('shop'); ?>
<div class="clearboth"></div>
<?php  get_footer(); ?>