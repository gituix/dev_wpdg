<? get_header(); ?>
<div id="body">
            <div id="mainBar">
				<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template(); ?>
				<?php endwhile; // end of the loop. ?>
			</div>
			
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>            