<div id=content>
	<? while ( have_posts() ) : the_post(); ?>
		<h3><? the_title()?></h3>
		<? the_content()?>
	<?php endwhile; // end of the loop. ?>
</div>