     <?php get_header(); ?>
<body>
	<div id="site_content">
	<div id=flag></div>
	<div class=clear></div>
	<div id=col-sx>
		<a href="http://uix/wordpress/"><div id=logo></div></a>
		<div id="left">
			<div id="menu">
	            <?php wp_nav_menu(array('container_class' => 'menu')); ?> 
	        </div>
				<?
				get_sidebar('left');
				?>
				<div id=banner_left>
				<? 	while ( $banner_left->have_posts() ) {
						$banner_left->the_post();?>
						 <a href="http://<? echo get_the_title(); ?>"target="blank">
	                    	<?php the_post_thumbnail('banner'); ?>
	                    </a>
	                    <hr>
	                    <br>
				<? }?>
			</div>
		</div>
		<div id="center">
			<?$keyword = get_search_query();?> 
			<? 
			if ( have_posts() ) {
			echo '<p><h3>Risultati per la ricerca di: <font style="color:red">'. $keyword.'</font></h3></p>';
					while ( have_posts() ) {
						the_post();?>
						<a href="<? the_permalink()?>">
						<?the_title();?>
						</a>
						<? the_excerpt();?>
						<hr>
					<?} // end while
				} // end if
			else {echo '<p><h3>Nessun risultato pe la ricerca di: <font style="color:red">'. $keyword.'</font></h3></p>';}
			?>
		</div>
	</div>
	<div id=col-dx>
	<div style="margin:25px 0px 10px 0px">
		<img alt="news letter sanita" src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/newslettersanita.jpeg">
	</div>
		<div id="right">
			<? 
			get_sidebar('right');
			?>
			<? 	while ( $banner_right->have_posts() ) {
					$banner_right->the_post();?>
					 <a href="http://<? echo get_the_title(); ?>"target="blank">
                    	<?php the_post_thumbnail('banner'); ?>
                    </a>
                    <hr>
                    <br>
			<? }?>
		</div>
	</div>
		<div class=clear></div>
	<div id=flag></div>
	<div id=footer>
		<?php get_footer(); ?>
	</div>
	</div>
</body>