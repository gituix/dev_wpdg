<div id="content">
	<?$keyword = get_search_query();?> 
	<? 
	if ( have_posts() ) {
	echo '<p><h2>Risultati per la ricerca di: '. $keyword.'</h2></p>';
		while ( have_posts() ) {
			the_post();?>
			<a href="<? the_permalink()?>">
				<div class=post_title><?the_title();?></div>
				<div  class=post_excerpt><? the_excerpt();?></div>
			</a>
			<hr>
		<?} // end while
	} // end if
	else {echo '<p>Nessun risultato pe la ricerca di: '. $keyword.'</p>';};
	echo "<div style=text-align:center;>";
				$big = 999999999; // need an unlikely integer
				echo paginate_links(  array(
					'base'         => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'       => '?page=%#%',
					'total'        => $wp_query->max_num_pages,
					'current'      => max( 1, get_query_var('paged') )
					)
				);
	echo"</div>";
	?>
	
</div>