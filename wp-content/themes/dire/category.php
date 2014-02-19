<?php get_header(); ?>
<body>
	<div id="site_content">
	<div id=flag></div>
	<div class=clear></div>
	<div id=col-sx>
		<a href="<?php echo home_url(); ?>"><div id=logo></div></a>
		<? include_once 'col-left.php';?>
		<div id="center">
			<!-- <p>Category: <?php single_cat_title(); ?></p> -->
			
			<?php 
			// The Query
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();?>
						<a href="<? the_permalink()?>">
						<div class=title><? the_title() ?></div>
						<div  class=excerpt><? the_excerpt()?></div>
						</a>
						<?if( function_exists( do_sociable() ) ){ do_sociable(); } ?>
					<?} // end while
				} // end if
			?>
			<div style="text-align:center;">
				<?php //posts_nav_link('', 'indietro', 'avanti'); ?>
				<?php
					$big = 999999999; // need an unlikely integer
					echo paginate_links(  array(
						'base'         => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'       => '?page=%#%',
						'total'        => $wp_query->max_num_pages,
						'current'      => max( 1, get_query_var('paged') )
						)
					);
				?>
			</div>
		</div>
	</div>
	<? include_once 'col-right.php';?>
	<div class=clear></div>
	<div id=flag></div>
	<div id=footer>
		<?php get_footer(); ?>
	</div>
	</div>
</body>