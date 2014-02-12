<div id="category">			
	<?php 
	// The Query
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();?>
				<li class=post_content>
					<? if ( has_post_thumbnail() ) {?>
						<div class=thumb>
							<?the_post_thumbnail('post');?>
							<div class=clear></div>
						</div>
					<?} ?>
					<a href="<?the_permalink()?>">
						<div class=post_title><? the_title() ?><br><span class=post_date>Pubblicato il <?echo get_the_date('d F Y');?></span></div>
						<div  class=post_excerpt>
							<?php
							  $excerpt = get_the_excerpt();
							  echo cut($excerpt,30);
							?>
						</div>
					</a>
				</li>
			<?} // end while
		} // end if
	?>
	<div class="pagelink" style="text-align:center;">
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