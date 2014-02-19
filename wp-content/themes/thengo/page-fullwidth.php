<?php
/**
 * @package WordPress
 * @subpackage Templuto
/*
Template Name: Full Width
*/


get_header(); ?>

	<div id="content" class="fullcolumn" >

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2 class="post_title" ><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<div class="entry">
				<?php the_content(''); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		</div>
		<?php endwhile; endif; ?>
    
	</div>

<div class="clearboth"></div>
<?php  get_footer(); ?>