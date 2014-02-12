<div id=features_wrapper>
	<? 
	if ( $features->have_posts() ) {?>
			<? while ( $features->have_posts() ) {
				$features->the_post();?>
				<div class=features_post>
					<? if ( has_post_thumbnail() ) {?>
						<div class=features_thumb>
							<?the_post_thumbnail('features');?>
							<div class=clear></div>
						</div>
					<?} ?>
					<a href="<?the_permalink()?>">
						<div class=features_title><? the_title() ?><br></div>
						<?//if( function_exists( do_sociable() ) ){ do_sociable(); } ?>
					</a>
						Pubblicato il <?echo get_the_date('d F Y');?>
				</div>
			<?}?>
		<?}?>
</div>