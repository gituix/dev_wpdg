<?php get_header(); ?>
<body>
	<div id="site_content">
	<div id=flag></div>
	<div class=clear></div>
	<div id=col-sx>
		<a href="<?php echo home_url(); ?>"><div id=logo></div></a>
		<? include_once 'col-left.php';?>
		<div id="center">
			<?php while ( have_posts() ) : the_post(); ?>

				<span class="title_sing"><? the_title()?></span>
				<? the_content()?>
<?if( function_exists( do_sociable() ) ){ do_sociable(); } ?>
			<?php endwhile; // end of the loop. ?>
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