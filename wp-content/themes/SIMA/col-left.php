<div id="left">
		<div id="menu">
		<? if ( has_nav_menu( 'extra-menu' ) ) {
			 	wp_nav_menu( array( 'theme_location' => 'header-menu',
			 						'container_class' => 'menu' ) ); 
			 }
			 ?>
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