     <?php get_header(); ?>
<body>
	<div id="site_content">
	<div id=flag></div>
	<div class=clear></div>
	<div id=col-sx>
		<a href="<?php echo home_url(); ?>"><div id=logo></div></a>
		<? include_once 'col-left.php';?>
		<div id="center">
			<div id=slide><?php dynamic_sidebar( 'center' ); ?></div>
			<? 
				if ( $last_news->have_posts() ) {?>
					<div id=last-news-spacer>
						<span>Le ultime notizie</span><img  src="<?php echo home_url(); ?>/wp-content/themes/dire/images/letter_punti.gif" style="vertical-align: -2px;">
					</div>	
					<ul class=last-news>
						<? 
						while ( $last_news->have_posts() ) {
							$last_news->the_post();?>
							<li>
								<a href="<?the_permalink()?>">
									<div class=title><? the_title() ?></div>
									<div  class=excerpt><? the_excerpt()?></div>
									<?if( function_exists( do_sociable() ) ){ do_sociable(); } ?>
									
								</a>
							</li>
						<? }?>
					</ul>
				<? }?>
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