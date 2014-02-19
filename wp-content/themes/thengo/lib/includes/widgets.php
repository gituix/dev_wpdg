<?php

		
    function tpo_widget($widget,  $instance = false, $args = array('before_widget' => '<li class="sidebar-widget">','after_widget' => '</li>', 'before_title' => '<h2 class="widget-title">','after_title' => '</h2>')) 
    {
		global $tpowidgetopt;
        $widget_name = $widget;
        $custom_widgets = array('Banners', 'RecentPosts', 'PopularPosts', 'Contact','ContactInfo','Flickr', 'Social', 'Twitter', 'Facebook');
        $wp_widgets = array('Archives', 'Calendar', 'Categories', 'Links', 'Meta', 'Pages', 'Recent_Comments', 'Recent_Posts', 'RSS', 'Search', 'Tag_Cloud', 'Text');
        
        if (in_array($widget, $custom_widgets)) {
            $widget_name = 'tpo_' . strtolower($widget_name) . '_widget';
            if(!$instance) {
                $instance = $tpowidgetopt->options[ strtolower($widget) . '_widget_defaults'];
            } else {
                $instance = array_merge( $tpowidgetopt->options[ strtolower($widget) . '_widget_defaults'] , $instance);
            }
            
        } elseif (in_array($widget, $wp_widgets)) {
            $widget_name = 'WP_Widget_' . $widget_name;
        }
        the_widget($widget_name , $instance, $args);
    }
    
class tpo_widgetOptions{
	
	var $options = array();
	
	function tpo_widgetOptions(){
      
		$this->options['facebook_widget_defaults'] = array(
			'title' => __('Facebook'),
			'fb_url' => 'http://www.facebook.com/platform',
			'width' => '255',
			'height' => '255',
			'color_scheme' => 'light',
			'show_faces' => 'true',
			'data_stream' => 'false',
			'show_header' => 'false',
			'border_color' => '#fff'
		);
		
		$this->options['recentposts_widget_defaults'] = array(
			'title' => __('Recent Posts'),
			'num' => 5,
			'thumb' => 'true',
			'thumb_h' => 55,
			'thumb_w' => 55,
			'cat' => '',
			'date' => 'true',
			'comments' => 'true',
			'excerpt' => 'true'
		);
		
		$this->options['popularposts_widget_defaults'] = array(
			'title' => __('Popular Posts'),
			'num' => 5,
			'thumb' => 'true',
			'thumb_h' => 55,
			'thumb_w' => 55,
			'cat' => '',
			'date' => 'true',
			'comments' => 'true',
			'excerpt' => 'true'
		);
		
    	$this->options['social_widget_defaults'] = array(
			'title' => __('Social Profiles'),
			'facebook' => 'http://www.facebook.com',
			'twitter' => 'http://www.twitter.com',
			'rss' => 'http://www.zebrathemes.com/rss',
			'youtube' => 'http://www.youtube.com',
			'linkedin' => 'http://www.linkedin.com',
			'flickr' => 'http://www.flickr.com',
			'delicious' => 'http://www.delicious.com',
			'technorati' => 'http://www.technorati.com'
        );

    	$this->options['twitter_widget_defaults'] = array(
			'title' => __('Recent Tweets'),
			'id' => 'wpzebrathemes',
			'number' => 5
        );

    	$this->options['flickr_widget_defaults'] = array(
			'title' => __('Flickr'),
			'id' => 'zebrathemes',
			'number' => 5
        );
		
    	$this->options['contact_widget_defaults'] = array(
			'title' => __('Contact Us'),
			'E-mail' => 'mail@email.com',
        );

		
    	$this->options['contactinfo_widget_defaults'] = array(
			'title' => __('Contact Us'),
			'color' => 'color',
			'text' => 'text',
			'phone' => 'phone',
			'cellphone' => 'cellphone',
			'email' => 'email',
			'address' => 'address',
			'city' => 'city',
			'state' => 'state',
			'zip' => 'zip',
			'name' => 'name',
        );

	}
}
$tpowidgetopt = new tpo_widgetOptions();

add_action('widgets_init', create_function('', 'return register_widget("tpo_popularposts_widget");'));

class tpo_popularposts_widget extends WP_Widget {
    function tpo_popularposts_widget() {
		global $themeTitle;
		$options = array('classname' => 'tpo_popularpost_widget', 'description' => __( "Show popular posts on sidebars.") );
		$this->WP_Widget('tpo_popular_posts', __('Zebra Themes - Popular Posts'), $options);
    }

	function widget($args, $instance) {
		global $post;
		$post_old = $post;
		extract( $args );
		$sizes = get_option('tpo_cat_post_thumb_sizes');
			if( !$instance["title"] ) {
				$category_info = get_category($instance["cat"]);
				$instance["title"] = $category_info->name;
			}
			// number of posts to show
			if ( !$number = (int) $instance['num'] ) {
				$number = 3;	// default
			}else if ( $number < 1 ) {
				$number = 1;	// minimum
			}else if ( $number > 15 ) {	
				$number = 15;	// maximum
			}
				
			// length of excerpt
			if ( !$excerpt_length = (int) $instance['excerpt_length'] ) {
				$excerpt_length = 55;	// default
			}else if ( $excerpt_length < 0 ) {
				$excerpt_length = 0;	// minimum
			}else if ( $excerpt_length > 150 ) {
				$excerpt_length = 150;	// maximum
			}
			
			if ( !$thumb_w = (int) $instance['thumb_w'] ) {
				$thumb_w = 55;	// default
			}else if ( $thumb_w <= 16 ) {
				$thumb_w = 16;	// minimum
			}else if ( $thumb_w > 100 ) {
				$thumb_w = 100;	// maximum
			}
			$instance['thumb_w'] = $thumb_w;

			if ( !$thumb_h = (int) $instance['thumb_h'] ) {
				$thumb_h = 55;	// default
			}else if ( $thumb_h <= 16 ) {
				$thumb_h = 16;	// minimum
			}else if ( $thumb_h > 150 ) {
				$thumb_h = 150;	// maximum
			}
			$instance['thumb_h'] = $thumb_h;
		if($instance["cat"] && $instance["cat"] > 0 ) :
			$recent_posts = new WP_Query("showposts=" . $instance["num"] . "&cat=" . $instance["cat"] . "&orderby=comment_count");
		else :
			$recent_posts = new WP_Query("showposts=" . $instance["num"] . "&orderby=comment_count");
		endif;
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Popular Posts',THEME_SLUG) : $instance['title'], $instance, $this->id_base);
		echo $before_widget;
		echo $before_title;
		if( $instance["title_link"] )
			echo '<a href="' . get_category_link($instance["cat"]) . '">' . $title. '</a>';
		else
			echo $instance["title"];
		echo $after_title;
		echo "<ul  class=\"recent_post\" >\n";
	
	while ( $recent_posts->have_posts())
	{
		$recent_posts->the_post();
		$img ='';
	?>
		<li class="wid_recentpost">
		<?php if( $instance["thumb"] ) : ?>
			<?php
			 	  if(get_post_meta($post->ID, "_post_image")) :
					  $img = get_post_meta($post->ID, "_post_image",true);
					  $img = tpo_image_resize($instance['thumb_h'], $instance['thumb_w'],$img );
				?>
             <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo  $img; ?>" alt="<?php the_permalink(); ?>" /></a>
				<?php
				  endif;

			 ?>

 
            <?php endif; ?>
  			<?php if( $instance["thumb"] ) : ?>
                <a style="width:<?php echo (280 - $instance['thumb_w']); ?>px" class="recentpost_title" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
            <?php else : ?>
                <a style="width:300px" class="recentpost_title" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
            <?php endif; ?>
			<?php if ( $instance['date'] ||  $instance['comments']  ) : ?>
				 <div class="recentpost_meta">
                 <?php if ( $instance['date']) : ?>
					<span class="recentpost_date"><?php the_time("F j, Y"); ?></span>
                 <?php endif; ?>
                 <?php if ( $instance['date'] &&  $instance['comments']  ) : ?>
                	<span>&nbsp;·</span>
                 <?php endif; ?>
				 <?php if ( $instance['comments'] ) : ?>
                    <span class="comment-num"><?php comments_number(); ?></span>
                 <?php endif; ?>
   				 </div>
         	<?php endif; ?>
            <?php if( $instance["thumb"] ) : ?>
                        <?php if ( $instance['excerpt'] ) :
                            $myExcerpt = rtrim(substr(get_the_excerpt(),0,$excerpt_length));
                            if ($myExcerpt != '') {
                                $myExcerpt .= '...';
                                echo str_replace('[...]','',$myExcerpt);
                            }
                         endif; ?>
			<?php else : ?>
                        <?php if ( $instance['excerpt'] ) :
                            $myExcerpt = rtrim(substr(get_the_excerpt(),0,$excerpt_length));
                            if ($myExcerpt != '') {
                                $myExcerpt .= '...';
                                echo '<div class="recent_post_text" >' . str_replace('[...]','',$myExcerpt) . '</div>';
                            }
                         endif; ?>
            <?php endif; ?>
        <div class="clearboth" ></div>
		</li>
	<?php
	}
	echo "</ul>\n";
	echo $after_widget;
	$post = $post_old; 
}

function update($new_instance, $old_instance) {
	if ( function_exists('the_post_thumbnail') )
	{
		$sizes = get_option('tpo_cat_post_thumb_sizes');
		if ( !$sizes ) $sizes = array();
		$sizes[$this->id] = array($new_instance['thumb_w'], $new_instance['thumb_h']);
		update_option('tpo_cat_post_thumb_sizes', $sizes);
	}
	
	return $new_instance;
}

function form($instance) {
			// number of posts to show
			if ( !$number = (int) $instance['num'] ) {
				$number = 3;	// default
			}else if ( $number < 1 ) {
				$number = 1;	// minimum
			}else if ( $number > 15 ) {	
				$number = 15;	// maximum
			}
			$instance['num']  =	$number;
			// length of excerpt
			if ( !$excerpt_length = (int) $instance['excerpt_length'] ) {
				$excerpt_length = 55;	// default
			}else if ( $excerpt_length < 0 ) {
				$excerpt_length = 12;	// minimum
			}else if ( $excerpt_length > 100 ) {
				$excerpt_length = 100;	// maximum
			}
			$instance['excerpt_length'] = $excerpt_length;
			
			if ( !$thumb_w = (int) $instance['thumb_w'] ) {
				$thumb_w = 55;	// default
			}else if ( $thumb_w <= 16 ) {
				$thumb_w = 16;	// minimum
			}else if ( $thumb_w > 100 ) {
				$thumb_w = 100;	// maximum
			}
			$instance['thumb_w'] = $thumb_w;

			if ( !$thumb_h = (int) $instance['thumb_h'] ) {
				$thumb_h = 55;	// default
			}else if ( $thumb_h <= 16 ) {
				$thumb_h = 16;	// minimum
			}else if ( $thumb_h > 150 ) {
				$thumb_h = 150;	// maximum
			}
			$instance['thumb_h'] = $thumb_h;
			
?>
		<p>
			<label for="<?php echo $this->get_field_id("title"); ?>">
				<?php echo __('Title',THEME_SLUG); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
			</label>
		</p>
		
		<p>
			<label>
				<?php echo  __('Category',THEME_SLUG); ?>:
				<?php
					wp_dropdown_categories('name='.$this->get_field_name("cat").'&selected='.$instance["cat"].'&show_option_none=Select category&show_count=1&orderby=name');
				?>
            </label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("num"); ?>">
				<?php  echo __('Number of posts to show',THEME_SLUG); ?>:
				<input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo absint($instance["num"]); ?>" size='2' />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id("title_link"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("title_link"); ?>" name="<?php echo $this->get_field_name("title_link"); ?>"<?php checked( (bool) $instance["title_link"], true ); ?> />
				<?php echo __('Make widget title link',THEME_SLUG); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("excerpt"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("excerpt"); ?>" name="<?php echo $this->get_field_name("excerpt"); ?>"<?php checked( (bool) $instance["excerpt"], true ); ?> />
				<?php  echo __('Show post excerpt',THEME_SLUG); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php echo __('Length of post excerpt:',THEME_SLUG); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" type="text" value="<?php echo $instance["excerpt_length"]; ?>"  maxlength="3"  style="width:20%;" />
           </label>
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id("date"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("date"); ?>" name="<?php echo $this->get_field_name("date"); ?>"<?php checked( (bool) $instance["date"], true ); ?> />
				<?php echo __('Show post date',THEME_SLUG); ?>
			</label>
		</p>
		
 		<p>
			<label for="<?php echo $this->get_field_id("comments"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("comments"); ?>" name="<?php echo $this->get_field_name("comments"); ?>"<?php checked( (bool) $instance["comments"], true ); ?> />
				<?php echo __('Show comments count',THEME_SLUG); ?>
			</label>
		</p>
        
		<?php if ( function_exists('the_post_thumbnail') && current_theme_supports("post-thumbnails") ) : ?>
		<p>
			<label for="<?php echo $this->get_field_id("thumb"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("thumb"); ?>" name="<?php echo $this->get_field_name("thumb"); ?>"<?php checked( (bool) $instance["thumb"], true ); ?> />
				<?php echo __('Show post thumbnail',THEME_SLUG); ?>
			</label>
		</p>
		<p>
			<label>
				<?php echo __('Thumbnail dimensions',THEME_SLUG); ?>:<br />
				<label for="<?php echo $this->get_field_id("thumb_w"); ?>">
					W: <input class="widefat" style="width:40%;" type="text" id="<?php echo $this->get_field_id("thumb_w"); ?>" name="<?php echo $this->get_field_name("thumb_w"); ?>" value="<?php echo $instance["thumb_w"]; ?>" />
				</label>
				
				<label for="<?php echo $this->get_field_id("thumb_h"); ?>">
					H: <input class="widefat" style="width:40%;" type="text" id="<?php echo $this->get_field_id("thumb_h"); ?>" name="<?php echo $this->get_field_name("thumb_h"); ?>" value="<?php echo $instance["thumb_h"]; ?>" />
				</label>
			</label>
		</p>
		<?php endif; ?>

<?php

}

}

add_action('widgets_init', create_function('', 'return register_widget("tpo_recentposts_widget");'));

class tpo_recentposts_widget extends WP_Widget {
    function tpo_recentposts_widget() {
		global $themeTitle;
		$options = array('classname' => 'tpo_recentposts_widget', 'description' => __( "Show recent posts on sidebars.") );
		$this->WP_Widget('tpo_recent_posts', __('Zebra Themes - Recent Posts'), $options);
    }

	function widget($args, $instance) {
		global $post;
		$post_old = $post;
		extract( $args );
		$sizes = get_option('tpo_cat_post_thumb_sizes');
			if( !$instance["title"] ) {
				$category_info = get_category($instance["cat"]);
				$instance["title"] = $category_info->name;
			} else {
				$instance["title"] = 'Recent Posts';
			}
			// number of posts to show
			if ( !$number = (int) $instance['num'] ) {
				$number = 3;	// default
			}else if ( $number < 1 ) {
				$number = 1;	// minimum
			}else if ( $number > 15 ) {	
				$number = 15;	// maximum
			}
				
			// length of excerpt
			if ( !$excerpt_length = (int) $instance['excerpt_length'] ) {
				$excerpt_length = 55;	// default
			}else if ( $excerpt_length < 0 ) {
				$excerpt_length = 0;	// minimum
			}else if ( $excerpt_length > 150 ) {
				$excerpt_length = 150;	// maximum
			}
			
			if ( !$thumb_w = (int) $instance['thumb_w'] ) {
				$thumb_w = 55;	// default
			}else if ( $thumb_w <= 16 ) {
				$thumb_w = 16;	// minimum
			}else if ( $thumb_w > 150 ) {
				$thumb_w = 150;	// maximum
			}
			$instance['thumb_w'] = $thumb_w;

			if ( !$thumb_h = (int) $instance['thumb_h'] ) {
				$thumb_h = 55;	// default
			}else if ( $thumb_h <= 16 ) {
				$thumb_h = 16;	// minimum
			}else if ( $thumb_h > 100 ) {
				$thumb_h = 100;	// maximum
			}
			$instance['thumb_h'] = $thumb_h;
		if($instance["cat"] && $instance["cat"] > 0 ) :
			$recent_posts = new WP_Query("showposts=" . $instance["num"] . "&cat=" . $instance["cat"] . "&orderby=date");
		else :
			$recent_posts = new WP_Query("showposts=" . $instance["num"] . "&orderby=date");
		endif;
		echo $before_widget;
		echo $before_title;
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts',THEME_SLUG) : $instance['title'], $instance, $this->id_base);
		if( $instance["title_link"] )
			echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["title"] . '</a>';
		else
			echo $instance["title"];
		echo $after_title;
		echo "<ul  class=\"recent_post\" >\n";
	
	while ( $recent_posts->have_posts())
	{
		$recent_posts->the_post();
		$img ='';
	?>
		<li class="wid_recentpost">
		<?php if( $instance["thumb"] ) : ?>
			<?php
		 	  if(get_post_meta($post->ID, "_post_image")) :
					  $img = get_post_meta($post->ID, "_post_image",true);
					  $img = tpo_image_resize($height=$instance['thumb_h'], $width=$instance['thumb_w'],$img );
				?>
             <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo  $img; ?>" alt="<?php the_permalink(); ?>" /></a>
				<?php
			 endif;
			 ?>
            <?php endif; ?>
  			<?php if( $instance["thumb"] ) : ?>
                <a style="width:<?php echo (280 - $instance['thumb_w']); ?>px" class="recentpost_title" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
            <?php else : ?>
                <a style="width:300px" class="recentpost_title" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
            <?php endif; ?>
			<?php if ( $instance['date'] ||  $instance['comments']  ) : ?>
				 <div class="recentpost_meta">
                 <?php if ( $instance['date']) : ?>
					<span class="recentpost_date"><?php the_time("F j, Y"); ?></span>
                 <?php endif; ?>
                 <?php if ( $instance['date'] &&  $instance['comments']  ) : ?>
                	<span>&nbsp;·</span>
                 <?php endif; ?>
				 <?php if ( $instance['comments'] ) : ?>
                    <span class="comment-num"><?php comments_number(); ?></span>
                 <?php endif; ?>
   				 </div>
         	<?php endif; ?>
            <?php if( $instance["thumb"] ) : ?>
                        <?php if ( $instance['excerpt'] ) :
                            $myExcerpt = rtrim(substr(get_the_excerpt(),0,$excerpt_length));
                            if ($myExcerpt != '') {
                                $myExcerpt .= '...';
                                echo '<div class="recent_post_text" >' . str_replace('[...]','',$myExcerpt) . '</div>';
                            }
                         endif; ?>
			<?php else : ?>
                        <?php if ( $instance['excerpt'] ) :
                            $myExcerpt = rtrim(substr(get_the_excerpt(),0,$excerpt_length));
                            if ($myExcerpt != '') {
                                $myExcerpt .= '...';
                                echo str_replace('[...]','',$myExcerpt);
                            }
                         endif; ?>
            <?php endif; ?>
        <div class="clearboth" ></div>
		</li>
	<?php
	}
	
	echo "</ul>\n";
	
	echo $after_widget;
	
	$post = $post_old; 
}

function update($new_instance, $old_instance) {
	if ( function_exists('the_post_thumbnail') )
	{
		$sizes = get_option('tpo_cat_post_thumb_sizes');
		if ( !$sizes ) $sizes = array();
		$sizes[$this->id] = array($new_instance['thumb_w'], $new_instance['thumb_h']);
		update_option('tpo_cat_post_thumb_sizes', $sizes);
	}
	
	return $new_instance;
}

function form($instance) {
			// number of posts to show
			if ( !$number = (int) $instance['num'] ) {
				$number = 3;	// default
			}else if ( $number < 1 ) {
				$number = 1;	// minimum
			}else if ( $number > 15 ) {	
				$number = 15;	// maximum
			}
			$instance['num']  =	$number;
			// length of excerpt
			if ( !$excerpt_length = (int) $instance['excerpt_length'] ) {
				$excerpt_length = 55;	// default
			}else if ( $excerpt_length < 0 ) {
				$excerpt_length = 12;	// minimum
			}else if ( $excerpt_length > 150 ) {
				$excerpt_length = 150;	// maximum
			}
			$instance['excerpt_length'] = $excerpt_length;
			
			if ( !$thumb_w = (int) $instance['thumb_w'] ) {
				$thumb_w = 55;	// default
			}else if ( $thumb_w <= 16 ) {
				$thumb_w = 16;	// minimum
			}else if ( $thumb_w > 100 ) {
				$thumb_w = 100;	// maximum
			}
			$instance['thumb_w'] = $thumb_w;

			if ( !$thumb_h = (int) $instance['thumb_h'] ) {
				$thumb_h = 55;	// default
			}else if ( $thumb_h <= 16 ) {
				$thumb_h = 16;	// minimum
			}else if ( $thumb_h > 100 ) {
				$thumb_h = 100;	// maximum
			}
			$instance['thumb_h'] = $thumb_h;
			
?>
	<p>
			<label for="<?php echo $this->get_field_id("title"); ?>">
				<?php echo __('Title',THEME_SLUG); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
			</label>
		</p>
		
		<p>
			<label>
				<?php echo  __('Category',THEME_SLUG); ?>:
				<?php
					wp_dropdown_categories('name='.$this->get_field_name("cat").'&selected='.$instance["cat"].'&show_option_none=Select category&show_count=1&orderby=name');
				?>
            </label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("num"); ?>">
				<?php  echo __('Number of posts to show',THEME_SLUG); ?>:
				<input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo absint($instance["num"]); ?>" size='2' />
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("title_link"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("title_link"); ?>" name="<?php echo $this->get_field_name("title_link"); ?>"<?php checked( (bool) $instance["title_link"], true ); ?> />
				<?php echo __('Make widget title link',THEME_SLUG); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("excerpt"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("excerpt"); ?>" name="<?php echo $this->get_field_name("excerpt"); ?>"<?php checked( (bool) $instance["excerpt"], true ); ?> />
				<?php  echo __('Show post excerpt',THEME_SLUG); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php echo __('Length of post excerpt:',THEME_SLUG); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" type="text" value="<?php echo $instance["excerpt_length"]; ?>"  maxlength="3"  style="width:20%;" />
           </label>
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id("date"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("date"); ?>" name="<?php echo $this->get_field_name("date"); ?>"<?php checked( (bool) $instance["date"], true ); ?> />
				<?php echo __('Show post date',THEME_SLUG); ?>
			</label>
		</p>

 		<p>
			<label for="<?php echo $this->get_field_id("comments"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("comments"); ?>" name="<?php echo $this->get_field_name("comments"); ?>"<?php checked( (bool) $instance["comments"], true ); ?> />
				<?php echo __('Show comments count',THEME_SLUG); ?>
			</label>
		</p>
        
		<?php if ( function_exists('the_post_thumbnail') && current_theme_supports("post-thumbnails") ) : ?>
		<p>
			<label for="<?php echo $this->get_field_id("thumb"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("thumb"); ?>" name="<?php echo $this->get_field_name("thumb"); ?>"<?php checked( (bool) $instance["thumb"], true ); ?> />
				<?php echo __('Show post thumbnail',THEME_SLUG); ?>
			</label>
		</p>
		<p>
			<label>
				<?php echo __('Thumbnail dimensions',THEME_SLUG); ?>:<br />
				<label for="<?php echo $this->get_field_id("thumb_w"); ?>">
					W: <input class="widefat" style="width:40%;" type="text" id="<?php echo $this->get_field_id("thumb_w"); ?>" name="<?php echo $this->get_field_name("thumb_w"); ?>" value="<?php echo $instance["thumb_w"]; ?>" />
				</label>
				
				<label for="<?php echo $this->get_field_id("thumb_h"); ?>">
					H: <input class="widefat" style="width:40%;" type="text" id="<?php echo $this->get_field_id("thumb_h"); ?>" name="<?php echo $this->get_field_name("thumb_h"); ?>" value="<?php echo $instance["thumb_h"]; ?>" />
				</label>
			</label>
		</p>
		<?php endif; ?>

<?php
}
}



/*================================= Flickr Widget ===================================*/

add_action('widgets_init', create_function('', 'return register_widget("tpo_flickr_widget");'));

class tpo_flickr_widget extends WP_Widget {
    function tpo_flickr_widget() {
		global $themeTitle;
		$options = array('classname' => 'tpo_flickr_widget', 'description' => __( "Show images from a Flickr.") );
		$controls = array('width' => 400, 'height' => 200);
		$this->WP_Widget('tpo_flickr', __('Zebra Themes - Flickr'), $options, $controls);
    }

    function widget($args, $instance) {	
        extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Photos on flickr') : $instance['title'], $instance, $this->id_base);
		$id = $instance['id'];
		if ( !$number = (int) $instance['number'] ) {
			$number = 3;
		}else if ( $number < 1 ) {
			$number = 1;
		}else if ( $number > 15 ) {
			$number = 15;
		}
		$hr = $instance['hr'] ? '1' : '0';

        ?>

			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $subtitle . $after_title; ?>
				<div class="flickrFeed">
					<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script> 
					<div class="clear"></div>
				</div>
				<?php if ( $hr ) : ?><div class="hr"></div><?php endif; ?>

			<?php echo $after_widget; ?>

        <?php
    }

    function update($new_instance, $old_instance) {				
        $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['id'] = strip_tags($new_instance['id']);
		$instance['number'] = (int) $new_instance['number'];
		return $instance;
    }

    function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$subtitle = isset($instance['subtitle']) ? esc_attr($instance['subtitle']) : '';
		$id = isset($instance['id']) ? esc_attr($instance['id']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] ) {
			$number = 3;
		}
       ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php __('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('id'); ?>">Flickr ID (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):</label>
			<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">Number of photos:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
		</p>
        <?php 
    }

}

/*================================= Banner Widget ===================================*/

add_action('widgets_init', create_function('', 'return register_widget("tpo_banner_widget");'));

class tpo_banner_widget extends WP_Widget {
    function tpo_banner_widget() {
		global $themeTitle;
		$options = array('classname' => 'tpo_banner_widget', 'description' => __( "Banner widgets.") );
		$controls = array('width' => 400, 'height' => 200);
		$this->WP_Widget('tpo_banners', __('Zebra Themes - Banners'), $options, $controls);
    }

    function widget($args, $instance) {	
        extract( $args );
				
		$banners = $instance['banners'];
		
        ?>

			<?php echo $before_widget; ?>
				<div class="banners">
				<?php
					$counter = 1;
					if ( is_array( $banners )) {
						foreach( $banners as $banner ) {
                			if( $banner ) {
								if ( $counter % 2 == 0 ) {
                   				 	echo  '<div class="banner" style="margin-right:0;" >' . stripslashes( $banner ) . '</div>';
								} else {
									echo  '<div class="banner" >' . stripslashes( $banner ) . '</div>';
								}
								 $counter++;
                			}
						}
					}
				?>
					<div class="clearboth"></div>
				</div>
			<?php echo $after_widget; ?>

        <?php
    }

    function update($new_instance, $old_instance) {				
    	$instance = $old_instance;
        $instance['banners'] = $new_instance['banners'];
        return $instance;
    }

    function form($instance) { 
		$bannerid =  str_replace('-','_',$this->get_field_id('add'));
	?>

        <script>
			function add_new_banner<?php echo $bannerid; ?>(con) {
					var id = con.getAttribute("rel");
					var bannerid = 'Banner ' + ( parseInt(id) + 1 ) + ' - Code'; 
					con.setAttribute('rel',  parseInt(id) + 1);
					var con = jQuery('.widget-banner-2-widget');
					var new_banner_id = 10000+Math.floor(Math.random()*100000);
					var fieldid = "<?php echo $this->get_field_id('" + parseInt(id) + "'); ?>";
					var banner = '<div style="padding-top:20px;" class="tpo_banner" ><p style="border-bottom: 1px solid #DFDFDF;"><strong>' + bannerid + '</strong></p><div><div style="margin-right:10px;" ><textarea class="banner_text" style="height: 150px;" id="' + fieldid + '" name="<?php echo $this->get_field_name('banners'); ?>[]"></textarea></div></div></div>';
					jQuery('#<?php echo $this->get_field_id('tpo_banner'); ?>').append(banner);
			}
			function tpo_banner_delete(id) {
					jQuery('#' + id).remove();
			}
		</script>
                 <div id="<?php echo $this->get_field_id('tpo_banner'); ?>">
				<?php
                $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
                $banners = $instance['banners'];
				
				if(is_array($banners)) { ?>
                    <div style="padding-bottom:10px" >
                        <a rel ="<?php echo count($banners) ?>" class="button banner_add_new" onclick="add_new_banner<?php echo $bannerid;  ?>(this)"  >Add New Banner</a>
                    </div>
                <?php
					$counter = 1;
					foreach($banners as $b_id=>$bcode) { ?>
                         <div id="container_<?php echo $this->get_field_id('ban'); ?>_<?php echo $counter ?>" style="padding-top:20px;" class="tpo_banner" >
                               <p style="border-bottom: 1px solid #DFDFDF;"><strong><?php echo __('Banner ' . $counter .' - Code', THEME_SLUG); ?></strong></p>
                               <div>
                                    <div style="margin-right:10px;" >
                                        <textarea class="banner_text" style="height: 150px;" id="<?php echo $this->get_field_id($b_id); ?>" name="<?php echo $this->get_field_name('banners'); ?>[]"><?php echo $bcode; ?></textarea>
                                    </div>
                                    <a class="button button-red" onclick="if (confirm('Do you really want to delete the banner?')) { tpo_banner_delete('container_<?php echo $this->get_field_id('ban'); ?>_<?php echo $counter ?>'); } return false;">Delete</a>
                              </div>
                        </div>
                <?php $counter++ ; 
					}
				} else { ?>
                    <div style="padding-bottom:10px" >
                        <a rel ="0" class="button banner_add_new" onclick="add_new_banner<?php echo str_replace('-','_',$this->get_field_id('add')); ?>(this)"  >Add New Banner</a>
                    </div>
                <?php } ?>
            </div><input id="bancnn" name="bancnn" type="hidden" value="3" />
            <div style="border-bottom: 1px solid #DFDFDF; float:left;margin:8px 0; height:2px;width:100%"></div>
           <?php  
            }

}

/*================================= Social Widget ===================================*/

add_action('widgets_init', create_function('', 'return register_widget("tpo_social_widget");'));

class tpo_social_widget extends WP_Widget {
    function tpo_social_widget() {
		global $themeTitle;
		$options = array('classname' => 'tpo_social_widget', 'description' => __( "Social widgets.") );
		$controls = array('width' => 400, 'height' => 200);
		$this->WP_Widget('tpo_social', __('Zebra Themes - Social Icons'), $options, $controls);
    }

    function widget($args, $instance) {	
        extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Social Profiles') : $instance['title'], $instance, $this->id_base);
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$rss = $instance['rss'];
		$youtube = $instance['youtube'];
		$linkedin = $instance['linkedin'];
		$flickr = $instance['flickr'];
		$delicious = $instance['delicious'];
		$technorati = $instance['technorati'];
		if ( !$thumb_w = (int) $instance['thumb_w'] ) {
			$thumb_w = 30;	// default
		}else if ( $thumb_w <= 16 ) {
			$thumb_w = 16;	// minimum
		}else if ( $thumb_w > 90 ) {
			$thumb_w = 90;	// maximum
		}
		$instance['thumb_w'] = $thumb_w;

		if ( !$thumb_h = (int) $instance['thumb_h'] ) {
			$thumb_h = 30;	// default
		}else if ( $thumb_h <= 16 ) {
			$thumb_h = 16;	// minimum
		}else if ( $thumb_h > 90 ) {
			$thumb_h = 90;	// maximum
		}
		$instance['thumb_h'] = $thumb_h;
        ?>

			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $subtitle . $after_title; ?>
				<div class="socialicons">
				<?php
					if ($facebook != '') {
						if($facebook) echo '<a href="'.$facebook.'"><img src="' . get_bloginfo('template_directory') . '/images/icons/facebook.png" height="'.$thumb_h.'" width="'.$thumb_w.'" alt="" /></a>' ;
						if ($twitter) echo '<a href="'.$twitter.'"><img src="' . get_bloginfo('template_directory') . '/images/icons/twitter.png" height="'.$thumb_h.'" width="'.$thumb_w.'" alt="" /></a>' ;
						if ($rss) echo '<a href="'.$rss.'"><img src="' . get_bloginfo('template_directory') . '/images/icons/rss.png"  height="'.$thumb_h.'" width="'.$thumb_w.'" alt="" /></a>' ;
						if ($youtube) echo '<a href="'.$youtube.'"><img src="' . get_bloginfo('template_directory') . '/images/icons/youtube.png" height="'.$thumb_h.'" width="'.$thumb_w.'" alt="" /></a>' ;
						if ($linkedin) echo '<a href="'.$linkedin.'"><img src="' . get_bloginfo('template_directory') . '/images/icons/linkedin.png" height="'.$thumb_h.'" width="'.$thumb_w.'" alt="" /></a>' ;
						if ($flickr) echo '<a href="'.$flickr.'"><img src="' . get_bloginfo('template_directory') . '/images/icons/flickr.png" height="'.$thumb_h.'" width="'.$thumb_w.'" alt="" /></a>' ;
						if ($delicious) echo '<a href="'.$delicious.'"><img src="' . get_bloginfo('template_directory') . '/images/icons/delicious.png" height="'.$thumb_h.'" width="'.$thumb_w.'" alt="" /></a>' ;
						if ($technorati) echo '<a href="'.$technorati.'"><img src="' . get_bloginfo('template_directory') . '/images/icons/technorati.png" height="'.$thumb_h.'" width="'.$thumb_w.'" alt="" /></a>' ;
					}
				?>
					<div class="clear"></div>
				</div>
			<?php echo $after_widget; ?>

        <?php
    }

    function update($new_instance, $old_instance) {				
        $instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['facebook'] = strip_tags($new_instance['facebook']);
		$instance['twitter'] = strip_tags($new_instance['twitter']);
		$instance['rss'] = strip_tags($new_instance['rss']);
		$instance['youtube'] = strip_tags($new_instance['youtube']);
		$instance['linkedin'] = strip_tags($new_instance['linkedin']);
		$instance['flickr'] = strip_tags($new_instance['flickr']);
		$instance['delicious'] = strip_tags($new_instance['delicious']);
		$instance['technorati'] = strip_tags($new_instance['technorati']);
		$instance['thumb_w'] = strip_tags($new_instance['thumb_w']);
		$instance['thumb_h'] = strip_tags($new_instance['thumb_h']);
		return $instance;
    }

    function form($instance) {
		if ( !$thumb_w = (int) $instance['thumb_w'] ) {
			$thumb_w = 30;	// default
		}else if ( $thumb_w <= 16 ) {
			$thumb_w = 16;	// minimum
		}else if ( $thumb_w > 90 ) {
			$thumb_w = 90;	// maximum
		}
		$instance['thumb_w'] = $thumb_w;

		if ( !$thumb_h = (int) $instance['thumb_h'] ) {
			$thumb_h = 30;	// default
		}else if ( $thumb_h <= 16 ) {
			$thumb_h = 16;	// minimum
		}else if ( $thumb_h > 90 ) {
			$thumb_h = 90;	// maximum
		}
		$instance['thumb_h'] = $thumb_h;
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$facebook = isset($instance['facebook']) ? esc_attr($instance['facebook']) : '';
		$twitter = isset($instance['twitter']) ? esc_attr($instance['twitter']) : '';
		$rss = isset($instance['rss']) ? esc_attr($instance['rss']) : '';
		$youtube = isset($instance['youtube']) ? esc_attr($instance['youtube']) : '';
		$linkedin = isset($instance['linkedin']) ? esc_attr($instance['linkedin']) : '';
		$flickr = isset($instance['flickr']) ? esc_attr($instance['flickr']) : '';
		$delicious = isset($instance['delicious']) ? esc_attr($instance['delicious']) : '';
		$technorati = isset($instance['technorati']) ? esc_attr($instance['technorati']) : '';
       ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php __('Title:', THEME_SLUG); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label>
				<?php echo __('Thumbnail dimensions',THEME_SLUG); ?>:<br />
				<label for="<?php echo $this->get_field_id("thumb_w"); ?>">
					W: <input class="widefat" style="width:40%;" type="text" id="<?php echo $this->get_field_id("thumb_w"); ?>" name="<?php echo $this->get_field_name("thumb_w"); ?>" value="<?php echo $instance["thumb_w"]; ?>" />
				</label>
				
				<label for="<?php echo $this->get_field_id("thumb_h"); ?>">
					H: <input class="widefat" style="width:40%;" type="text" id="<?php echo $this->get_field_id("thumb_h"); ?>" name="<?php echo $this->get_field_name("thumb_h"); ?>" value="<?php echo $instance["thumb_h"]; ?>" />
				</label>
			</label>
		</p>
		<p style="border-bottom: 1px solid #DFDFDF;"><strong><?php echo __('Profiles:', THEME_SLUG); ?></strong></p>
		<p>
			<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php echo __('Facebook', THEME_SLUG); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php echo __('Twitter', THEME_SLUG); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('rss'); ?>"><?php echo __('RSS', THEME_SLUG); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo $rss; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('youtube'); ?>"><?php echo __('Youtube', THEME_SLUG); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo $youtube; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php echo __('Linkedin', THEME_SLUG); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo $linkedin; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('flickr'); ?>"><?php echo __('Flickr', THEME_SLUG); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo $flickr; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('delicious'); ?>">Delicious</label>
			<input class="widefat" id="<?php echo $this->get_field_id('delicious'); ?>" name="<?php echo $this->get_field_name('delicious'); ?>" type="text" value="<?php echo $delicious; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('technorati'); ?>">Technorati</label>
			<input class="widefat" id="<?php echo $this->get_field_id('technorati'); ?>" name="<?php echo $this->get_field_name('technorati'); ?>" type="text" value="<?php echo $technorati; ?>" />
		</p>
        <?php 
    }

}


/*================================= FaceBook Widget========================================*/

add_action('widgets_init', create_function('', 'return register_widget("tpo_facebook_widget");'));

class tpo_facebook_widget extends WP_Widget {

    function tpo_facebook_widget() {
		$options = array('classname' => 'tpo_facebook_widget', 'description' => __( "Facebook Like social widget.") );
		$controls = array('width' => 400, 'height' => 300);
		$this->WP_Widget('tpo_facebook', __('Zebra Themes - Facebook'), $options, $controls);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
    	
    	global $app_id;
        extract( $args );
        
		$title	        =    apply_filters('widget_title', empty($instance['title']) ? __('Facebook') : $instance['title'], $instance, $this->id_base);

		$fb_url 		=	$instance['fb_url'];
		$show_faces 	=	isset($instance['show_faces']) ? $instance['show_faces'] : 'false';
		$data_stream	=	isset($instance['data_stream']) ? $instance['data_stream'] : 'false';
		$show_header	=	isset($instance['show_header']) ? $instance['show_header'] : 'false';
		$width			=	$instance['width'];
		$height			=	$instance['height'];
		$color_scheme	=	$instance['color_scheme'];
		$border_color	=	isset($instance['border_color']) ? $instance['border_color'] : '#fff';
		if ( !$show_faces )  $show_faces = 'false';
		if ( !$data_stream )  $data_stream = 'false';
		if ( !$show_header )  $show_header = 'false';
        ?>
 			<?php echo $before_widget; ?>
				<?php echo $before_title . $title . $subtitle . $after_title; ?>
                    
          <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) {return;}
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-like-box" data-href="<?php echo $fb_url; ?>" data-width="<?php echo $width; ?>" data-height="<?php echo $height; ?>" data-colorscheme="<?php echo $color_scheme; ?>" data-show-faces="<?php echo $show_faces; ?>" data-stream="<?php echo $data_stream; ?>" data-header="<?php echo $show_header; ?>" data-border-color="<?php echo $border_color; ?>"></div>

       <?php echo $after_widget; ?>
     <?php
    }


    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
		
    	$instance	=	$old_instance;
		$instance	=	array('show_faces' => 0,'data_stream' => 0,'show_header' => 0);
		foreach ( $instance as $field => $val ) {
			if ( isset($new_instance[$field]) )
				$instance[$field] = 1;
		}
		$instance['title']			=	strip_tags($new_instance['title']);
		$instance['fb_url'] 		=	strip_tags($new_instance['fb_url']);
		$instance['width'] 			=	strip_tags($new_instance['width']);
		$instance['height'] 		=	strip_tags($new_instance['height']);
		$instance['show_faces']     =	strip_tags($new_instance['show_faces']);
		$instance['data_stream'] 	=	strip_tags($new_instance['data_stream']);
		$instance['show_header'] 	=	strip_tags($new_instance['show_header']);
		$instance['color_scheme']	=	strip_tags($new_instance['color_scheme']);
		$instance['border_color']	=	strip_tags($new_instance['border_color']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {	

    	/**
    	 * Set Default Value for widget form
    	 */
    	
    	$default_value	=	array("fb_url" => "http://www.facebook.com/platform" , "width" => "255", "height" => "255", "show_faces" => 1, "show_header" => 1,"border_color" => "#fff");
    	$instance		=	wp_parse_args((array)$instance,$default_value);
        $title			=	esc_attr($instance['title']);
		$fb_url			=	esc_attr($instance['fb_url']);
		$width			=	esc_attr($instance['width']);
		$height			=	esc_attr($instance['height']);
		$show_faces		=	esc_attr($instance['show_faces']);
		$data_stream	=	esc_attr($instance['data_stream']);
		$show_header	=	esc_attr($instance['show_header']);
		$color_scheme	=	esc_attr($instance['color_scheme']);
		$border_color	=	esc_attr($instance['border_color']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        
        <p>
          	<label for="<?php echo $this->get_field_id('fb_url'); ?>"><?php _e('Facebook Page Url:'); ?></label>
          	<input class="widefat" id="<?php echo $this->get_field_id('fb_url'); ?>" name="<?php echo $this->get_field_name('fb_url'); ?>" type="text" value="<?php echo $fb_url; ?>" />
            <p>Ex : http://www.facebook.com/zebrathemescom</p>
          	<small>
          		<?php _e('Works with only');?>
          		<a href="http://www.facebook.com/help/?faq=174987089221178" target="_blank">
          			<?php _e('Valid Facebook Pages'); ?>
          		</a>
          	</small>
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id("show_faces"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_faces"); ?>" name="<?php echo $this->get_field_name("show_faces"); ?>"<?php checked( (bool) $instance["show_faces"], true ); ?> />
				<?php  _e('Show faces',THEME_SLUG); ?>
			</label>
        </p>
        
        <p>
 			<label for="<?php echo $this->get_field_id("data_stream"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("data_stream"); ?>" name="<?php echo $this->get_field_name("data_stream"); ?>"<?php checked( (bool) $instance["data_stream"], true ); ?> />
				<?php  _e('Show Data Stream',THEME_SLUG); ?>
			</label>
        </p> 
        
        <p>
  			<label for="<?php echo $this->get_field_id("show_header"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_header"); ?>" name="<?php echo $this->get_field_name("show_header"); ?>"<?php checked( (bool) $instance["show_header"], true ); ?> />
				<?php  _e('Show Header',THEME_SLUG); ?>
			</label>
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Set Width:',THEME_SLUG); ?></label>
        	<input size="5" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Set Height:',THEME_SLUG); ?></label>
        	<input size="5" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
        </p>
        
        <p>
        	<label for="<?php echo $this->get_field_id('color_scheme'); ?>"><?php _e('Color Scheme:' ,THEME_SLUG); ?></label>
    		<select name="<?php echo $this->get_field_name('color_scheme'); ?>" id="<?php echo $this->get_field_id('color_scheme'); ?>">
    			<option value="light"<?php selected( $instance['color_scheme'], 'light' ); ?>><?php _e('Light'); ?></option>
    			<option value="dark"<?php selected( $instance['color_scheme'], 'dark' ); ?>><?php _e('Dark'); ?></option>
        	</select>
        </p>

        <p>
        	<label for="<?php echo $this->get_field_id('border_color'); ?>"><?php _e('Border Color:',THEME_SLUG); ?></label>
        	<input size="5" id="<?php echo $this->get_field_id('border_color'); ?>" name="<?php echo $this->get_field_name('border_color'); ?>" type="text" value="<?php echo $border_color; ?>" />
        </p>
        
        <?php
    }
}

/*================================= Contact Form Widget ===================================*/

add_action('widgets_init', create_function('', 'return register_widget("tpo_contact_widget");'));

class tpo_contact_widget extends WP_Widget {
	function tpo_contact_widget() {
		$options = array('classname' => 'tpo_contact_widget', 'description' => __( 'Contact form widget.', THEME_SLUG) );
		$this->WP_Widget('contact', __('Zebra Themes - Contact Form',THEME_SLUG), $options, $controls);
		//if ( is_active_widget(false, false, $this->id_base) ){
	//		add_action('wp_print_scripts', array(&$this, 'add_jvscript') );
	//	}
	}
	
	//function add_jvscript(){
	//	wp_enqueue_script('jquery-tools-validator');
	//}
		function widget( $args, $instance ) {
			extract( $args );
			$title = apply_filters('widget_title', empty($instance['title']) ? __('Contact Us', THEME_SLUG) : $instance['title'], $instance, $this->id_base);
			$email= $instance['email'];
			echo $before_widget;
			if ( $title)
				echo $before_title . $title . $after_title;
			?>
			<form name="contact_form" class="wid_contact_form" action="<?php echo TEMPLUTO_INC ?>/sendmail.php" method="post">
				<p><input type="text" required="required" id="wid_contactname" name="wid_contactname" class="text_input" value="" size="22"  />
				<label><?php echo __('Name*', THEME_SLUG); ?></label></p>
				
				<p><input type="email" required="required" id="wid_contactemail" name="wid_contactemail" class="text_input" value="" size="22"   />
				<label><?php echo __('Email*', THEME_SLUG); ?></label></p>
				
				<p><textarea required="required" name="wid_contactmessage" class="textarea" cols="25" rows="5"></textarea></p>
				
				<p><button type="submit" class="button white"><span>Submit</span></button></p>
				<input type="hidden" value="<?php echo $email;?>" name="wid_adminemail"/>
			</form>
			<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['email'] = strip_tags($new_instance['email']);
			return $instance;
		}

		function form( $instance ) {
			$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
			$email = isset($instance['email']) ? esc_attr($instance['email']) :get_bloginfo('admin_email');
			?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:', THEME_SLUG); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

			<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php echo __('Your Email:', THEME_SLUG); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></p>
	<?php
		}
}

/*================================= Contact Information Widget ===================================*/

add_action('widgets_init', create_function('', 'return register_widget("tpo_contactinfo_widget");'));

class tpo_contactinfo_widget extends WP_Widget {

	function tpo_contactinfo_widget() {
		$widget_ops = array('classname' => 'widget_contact_info', 'description' => __( 'Displays a list of contact info.', THEME_SLUG) );
		$this->WP_Widget('contact_details', __('Zebra Themes - Contact Information',THEME_SLUG), $options, $controls);
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Contact Us', 'templuto') : $instance['title'], $instance, $this->id_base);
		$color = $instance['color'];
		$text = $instance['text'];
		$phone = $instance['phone'];
		$cellphone = $instance['cellphone'];
		$email= $instance['email'];
		$address = $instance['address'];
		$city = $instance['city'];
		$state = $instance['state'];
		$zip = $instance['zip'];
		$name = $instance['name'];
		
		if(!empty($city) && !empty($state)){
			$city = $city.',&nbsp;'.$state;
		}elseif(!empty($state)){
			$city = $state;
		}
		
		
		echo $before_widget;
		if ( $title)
			echo $before_title . $title . $after_title;
		
		?>
			<div class="contact_info_wrap">
			<?php if(!empty($text)):?><p><?php echo $text;?></p><?php endif;?>
			
			<?php if(!empty($phone)):?><p><span class="icon_text icon_telephone <?php echo $color;?>"><?php echo $phone;?></span></p><?php endif;?>
			<?php if(!empty($cellphone)):?><p><span class="icon_text icon_cellphone <?php echo $color;?>"><?php echo $cellphone;?></span></p><?php endif;?>
			<?php if(!empty($email)):?><p><a href="mailto:<?php echo $email;?>" class="icon_text icon_email <?php echo $color;?>"><?php echo $email;?></a></p><?php endif;?>
			<?php if(!empty($address)):?><p><span class="icon_text icon_home <?php echo $color;?>"><?php echo $address;?></span></p><?php endif;?>
			<?php if(!empty($city)||!empty($zip)):?><p class="icon_text .icon_address{
	background-position: 200px 200px;
}">
				<?php if(!empty($city)):?><span><?php echo $city;?></span><?php endif;?>
				<?php if(!empty($zip)):?><span class="contact_zip"><?php echo $zip;?></span><?php endif;?>
			</p><?php endif;?>
			<?php if(!empty($name)):?><p><span class="icon_text icon_id <?php echo $color;?>"><?php echo $name;?></span></p><?php endif;?>
			</div>
		<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['color'] = strip_tags($new_instance['color']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['cellphone'] = strip_tags($new_instance['cellphone']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['city'] = strip_tags($new_instance['city']);
		$instance['state'] = strip_tags($new_instance['state']);
		$instance['zip'] = strip_tags($new_instance['zip']);
		$instance['name'] = strip_tags($new_instance['name']);
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$color = isset($instance['color']) ? esc_attr($instance['color']) : '';
		$text = isset($instance['text']) ? esc_attr($instance['text']) : '';
		$phone = isset($instance['phone']) ? esc_attr($instance['phone']) : '';
		$cellphone = isset($instance['cellphone']) ? esc_attr($instance['cellphone']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) : '';
		$address = isset($instance['address']) ? esc_attr($instance['address']) : '';
		$city = isset($instance['city']) ? esc_attr($instance['city']) : '';
		$state = isset($instance['state']) ? esc_attr($instance['state']) : '';
		$zip = isset($instance['zip']) ? esc_attr($instance['zip']) : '';
		$name = isset($instance['name']) ? esc_attr($instance['name']) : '';
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_SLUG); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Introduce text:', THEME_SLUG); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:', THEME_SLUG); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('cellphone'); ?>"><?php _e('Cell phone:', THEME_SLUG); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('cellphone'); ?>" name="<?php echo $this->get_field_name('cellphone'); ?>" type="text" value="<?php echo $cellphone; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', THEME_SLUG); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', THEME_SLUG); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('city'); ?>"><?php _e('City:', THEME_SLUG); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('city'); ?>" name="<?php echo $this->get_field_name('city'); ?>" type="text" value="<?php echo $city; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('state'); ?>"><?php _e('State:', THEME_SLUG); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('state'); ?>" name="<?php echo $this->get_field_name('state'); ?>" type="text" value="<?php echo $state; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('zip'); ?>"><?php _e('Zip:', THEME_SLUG); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('zip'); ?>" name="<?php echo $this->get_field_name('zip'); ?>" type="text" value="<?php echo $zip; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name:', THEME_SLUG); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo $name; ?>" /></p>
		
<?php
	}

}

/*================================= Sub Navigation Widget ===================================*/


add_action('widgets_init', create_function('', 'return register_widget("tpo_widget_subnav");'));

class tpo_widget_subnav extends WP_Widget {

	function tpo_widget_subnav() {
		$widget_ops = array('classname' => 'wid_subnav', 'description' => __( 'Displays a list of SubPages', THEME_SLUG) );
		$this->WP_Widget('subnav', __('Zebra Themes - Sub Navigation',THEME_SLUG), $options, $controls);
	}

	function widget( $args, $instance ) {
		global $post;
		$children=wp_list_pages( 'echo=0&child_of=' . $post->ID . '&title_li=' );
		if ($children) {
			$parent = $post->ID;
		}else{
			$parent = $post->post_parent;
			if(!$parent){
				$parent = $post->ID;
			}
		}
		$parent_title = get_the_title($parent);
		
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? $parent_title : $instance['title'], $instance, $this->id_base);
		$sortby = empty( $instance['sortby'] ) ? 'menu_order' : $instance['sortby'];
		$output = wp_list_pages( array('title_li' => '', 'echo' => 0, 'child_of' =>$parent, 'sort_column' => $sortby,  'depth' => 1) );

		if ( !empty( $output ) ) {
			echo $before_widget;
			if ( $title)
				echo $before_title . $title . $after_title;
		?>
		<ul>
			<?php echo $output; ?>
		</ul>
		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
			$instance['sortby'] = $new_instance['sortby'];
		} else {
			$instance['sortby'] = 'menu_order';
		}

		$instance['exclude'] = strip_tags( $new_instance['exclude'] );

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'sortby' => 'menu_order', 'title' => '', 'exclude' => '') );
		$title = esc_attr( $instance['title'] );
		$exclude = esc_attr( $instance['exclude'] );
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_SLUG); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e( 'Sort by:', THEME_SLUG); ?></label>
			<select name="<?php echo $this->get_field_name('sortby'); ?>" id="<?php echo $this->get_field_id('sortby'); ?>" class="widefat">
				<option value="menu_order"<?php selected( $instance['sortby'], 'menu_order' ); ?>><?php _e('Page order', THEME_SLUG); ?></option>
				<option value="post_title"<?php selected( $instance['sortby'], 'post_title' ); ?>><?php _e('Page title', THEME_SLUG); ?></option>
				<option value="ID"<?php selected( $instance['sortby'], 'ID' ); ?>><?php _e( 'Page ID', THEME_SLUG ); ?></option>
			</select>
		</p>
<?php
	}

}


/*================================= Googpe Map Widget ===================================*/

add_action('widgets_init', create_function('', 'return register_widget("tpo_widget_gmap");'));

class tpo_widget_gmap extends WP_Widget {
	function tpo_widget_gmap() {
		$options = array('classname' => 'tpo_gap_widget', 'description' => __( 'Google Map Widget.', THEME_SLUG) );
		$this->WP_Widget('gmap-widget', __('Zebra Themes - Google Map',THEME_SLUG), $options, $controls);
	}
	function widget( $args, $instance3 ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance3['title'] );
		$gmap_address = $instance3['gmap_address'];  
		$gmap_width = $instance3['gmap_width']; 
		$gmap_height = $instance3['gmap_height'];
		$gmap_zoom = $instance3['gmap_zoom'];  
		echo $before_widget;
		echo $before_title . $title . $after_title; 
		if ( $video_url )
			printf('<li class="widget_gmap">'); 
			printf('<iframe width="'.$gmap_width.'" height="'.$gmap_height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q='.$gmap_address.'&amp;ie=UTF8&amp;hq=&amp;hnear='.$gmap_address.'&amp;z='.$gmap_zoom.'&amp;output=embed&amp;iwloc=near"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q='.$gmap_address.'&amp;ie=UTF8&amp;hq=&amp;hnear='.$gmap_address.'&amp;z='.$gmap_zoom.'&amp;iwloc=near" style="color:#0000FF;text-align:left">Enlarge</a></small>');  
			printf('</li><br />');  
			echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['gmap_address'] = strip_tags($new_instance['gmap_address']);
		$instance['gmap_width'] = strip_tags( $new_instance['gmap_width'] );
		$instance['gmap_height'] = strip_tags( $new_instance['gmap_height'] );
		$instance['gmap_zoom'] = strip_tags( $new_instance['gmap_zoom'] );
		return $instance;
	}
	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$gmap_address = isset($instance['gmap_address']) ? esc_attr($instance['gmap_address']) : '';
		$gmap_width = isset($instance['gmap_width']) ? esc_attr($instance['gmap_width']) : '';
		$gmap_height = isset($instance['gmap_height']) ? esc_attr($instance['gmap_height']) : '';
		$gmap_zoom = isset($instance['gmap_zoom']) ? esc_attr($instance['gmap_zoom']) : '';
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_SLUG); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('gmap_address'); ?>"><?php _e('Address:', THEME_SLUG); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('gmap_address'); ?>" name="<?php echo $this->get_field_name('gmap_address'); ?>" type="text" value="<?php echo $gmap_address; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id("gmap_width"); ?>"><?php _e('Width:', THEME_SLUG); ?></label>
		<input class="widefat" style="width:40%;" type="text" id="<?php echo $this->get_field_id("gmap_width"); ?>" name="<?php echo $this->get_field_name("gmap_width"); ?>" value="<?php echo $gmap_width; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id("gmap_height"); ?>"><?php _e('Height:', THEME_SLUG); ?></label>
		<input class="widefat" style="width:40%;" type="text" id="<?php echo $this->get_field_id("gmap_height"); ?>" name="<?php echo $this->get_field_name("gmap_height"); ?>" value="<?php echo $gmap_height; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id("gmap_zoom"); ?>"><?php _e('Zoom:', THEME_SLUG); ?></label>
		<input class="widefat" style="width:40%;" type="text" id="<?php echo $this->get_field_id("gmap_zoom"); ?>" name="<?php echo $this->get_field_name("gmap_zoom"); ?>" value="<?php echo $gmap_zoom; ?>" /></p>
		<?php
	}
	}
?>