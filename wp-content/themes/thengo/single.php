<?php
/**
 * @package WordPress
 * @subpackage Templuto
 */

get_header();
?>
	<div id="content" class="narrowcolumn" >

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<span class="datetime" datetime="<?php echo get_the_time('M j, Y') ?>" ><?php echo get_the_time('j M ') ?> </br><?php echo get_the_time(' Y') ?></span>
				<h2 class="post_title" ><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

                    
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
						<span  class="metacomment" ><?php comments_popup_link(__('No Comments', THEME_SLUG), __('1 Comment', THEME_SLUG), __('% Comments', THEME_SLUG)); ?></span>		<?php endif;   ?>
				</div>
					<?php 
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
							<?php endif; ?>
								
								<div class="entry" >	
							<?php the_content(); ?>

					<?php if (get_option('tpo_blog_single_tags') == true ) : ?>		               
								<?php $post_tags = wp_get_post_tags($post->ID);
								if(!empty($post_tags)) { ?>
									<div class="tag" ><?php the_tags( __('Tags', THEME_SLUG) . ': ', ', ', '<br />'); ?></div>
								<?php }  ?>
							<?php endif; ?>	
                            </div>
						</div>   <!-- End Post  -->	
						<div id="single_comments">		
						
													
							<?php if ( TPO_BLOG_SHOW_AUTHORBIO == true ) : ?>
								<div class="author_info_main">
									<h3><?php _e('About The Author', THEME_SLUG);?></h3>
									<?php tpo_author_info(); ?>
                               	</div>
							<?php endif; ?>
								
			
			
					<?php comments_template(); ?>
					
	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.',  THEME_SLUG ); ?></p>

<?php endif; ?>
        </div>

		</div> <!-- End content  -->
        
<?php get_sidebar(); ?>
<div class="clearboth"></div>
<?php  get_footer(); ?>
