<?php get_header(); ?>
<body>
	<div id="site_content">
	<div id=flag></div>
	<div class=clear></div>
	<div id=col-sx>
		<a href="http://uix/wordpress/"><div id=logo></div></a>
		<? include_once 'col-left.php';?>
		<div id="center">
			<?php while ( have_posts() ) : the_post(); 
				get_template_part( 'content', 'page' );
			endwhile; // end of the loop. ?>
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