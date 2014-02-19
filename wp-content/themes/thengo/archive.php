<?php
/**
 * @package WordPress
 * @subpackage Templuto
 */

get_header();
?>
<?php get_sidebar(); ?>
	<div id="content">

		<?php if (have_posts()) : ?>

<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		  <?php /* If this is a category archive */ if (is_category()) { ?>
			<h2 class="pagetitle"><?php  single_cat_title(); ?></h2>
		  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			<h2 class="pagetitle"><?php single_tag_title(); ?></h2>
		  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h2 class="pagetitle"><?php _e('Daily Archives:', THEME_SLUG); ?> | <?php the_time('F jS, Y'); ?></h2>
		  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h2 class="pagetitle"><?php _e('Monthly Archives:', THEME_SLUG); ?> | <?php the_time('F, Y'); ?></h2>
		  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h2 class="pagetitle"<?php _e('Yearly Archives:', THEME_SLUG); ?> | <?php the_time('Y'); ?></h2>
		  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h2 class="pagetitle"><?php _e('Posted By:', THEME_SLUG); ?> | <?php get_the_author_meta('display_name'); ?></h2>
		  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h2 class="pagetitle"><?php _e('Blog Archives', THEME_SLUG ) ?></h2>
		  <?php } ?>



		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
				<span class="datetime" datetime="<?php echo get_the_time('M j, Y') ?>" ><?php echo get_the_time('j M ') ?> </br><?php echo get_the_time(' Y') ?></span>
                   			   	<h2 class="post_title" ><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
          				
             
                        	<?php 
						if ( tpo_option('tpo_blog_cat_thumbnail') == true ) :
							$width = tpo_option('tpo_blog_cat_thumbnail_width');
							$height = tpo_option('tpo_blog_cat_thumbnail_height');	
								if (!$width) $width = THUMB_WIDTH;
					            if (!$height) $height = THUMB_HEIGHT;
							$postimage = get_post_meta($post->ID, '_post_image', true);
								if ($postimage) : 
									$postimg = tpo_image_resize( $height, $width, $postimage); ?>
										 <div class="feature_image">
											<a class="load_blog_img" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
												<img src="<?php echo $postimg; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
											</a>
										</div>
								<?php 
								endif; 
						endif; ?>

								<div class="entry_meta">
	
			<?php if ( TPO_BLOG_SHOW_AUTHOR == true ) : ?>
						<span class="author" ><?php _e('Posted By',THEME_SLUG);?><?php echo get_the_author() ?></span> 
			<span class="seperator" > \ </span>
		<?php endif;   ?>
			<?php if ( TPO_BLOG_SHOW_CATEGORIES == true ) : ?>
						<?php if (count( get_the_category())) :   ?>
								<span  class="category"  >
								<?php echo get_the_category_list( ', ' ) ; ?>
								</span>
			<span class="seperator" > \ </span>
			<?php endif;   ?>
		<?php endif;   ?>
			<?php if ( TPO_BLOG_SHOW_COMMENTCOUNT == true ) : ?>		
						<span  class="metacomment" ><?php comments_popup_link(__('No Comments', THEME_SLUG), __('1 Comment', THEME_SLUG), __('% Comments', THEME_SLUG)); ?></span>	<?php endif;   ?>
				</div>
					
						
						
					
						
				 <div class="entry" >	
						<?php 
							if ( tpo_option('tpo_blog_excerpt_disable') == true ) : 
								the_content('');
							else:
								the_excerpt();
							endif;
						?>
						</div>

					  <div class="readmore"><a href="<?php the_permalink() ?>" ><?php echo TPO_BLOG_READMORE_TEXT; ?></a></div>

						<?php if ( TPO_BLOG_SHOW_TAGS ) : ?>	               
				<?php $post_tags = wp_get_post_tags($post->ID);
				if(!empty($post_tags)) { ?>
					<div class="tag" ><?php the_tags( __('Tags', THEME_SLUG) . ': ', ', ', '<br />'); ?></div>
				<?php }  ?>
			<?php endif; ?>	
                	
        		
			</div>  <!-- Post End -->

		<?php endwhile; ?>


		<div class="navigation">
			<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
				<div class="alignleft"><?php next_posts_link(__('« Older Entries', THEME_SLUG )) ?></div>
				<div class="alignright"><?php previous_posts_link(__('Newer Entries »', THEME_SLUG )) ?></div>
			<?php } ?>
			</div>
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
		get_search_form();

	endif;
?>

	</div>

 
<?php get_sidebar(); ?>
<div class="clearboth"></div>
<?php  get_footer(); ?>
