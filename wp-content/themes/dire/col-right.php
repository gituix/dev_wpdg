<div id=col-dx>
	<div id="right">
		<div style="margin:20px 0px 10px 0px">
			<img width=290px alt="news letter sanita" src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/newslettersanita.jpeg">
		</div>
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