<?php
/**
 * @package WordPress
 * @subpackage Templuto
 */

get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle"><?php _e('Search Results' , THEME_SLUG ); ?></h2>

		


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
										 <div class="feature_image" >
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
						
  
					</div><!-- Entry End -->
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
				<div class="alignleft"><?php next_posts_link(__('� Older Entries', THEME_SLUG )) ?></div>
				<div class="alignright"><?php previous_posts_link(__('Newer Entries �', THEME_SLUG )) ?></div>
			<?php } ?>
		</div>


	<?php else : ?>

		<h2 class="center"><?php _e('No posts found. Try a different search?',THEME_SLUG)?></h2>
	<div id="search-1">
                    <form method="get" id="searchform">
                        <input type="text" value="Search" class="searchinput" name="s" id="s" onblur="if (this.value == '')  {this.value = 'Search';}" onfocus="if (this.value == 'Search') {this.value = '';}">
                        <input id="searchbutton" type="submit" value="">
                    </form>
                </div>

	<?php endif; ?>

	</div>
    
<?php get_sidebar(); ?>
<div class="clearboth"></div>
<?php  get_footer(); ?>
