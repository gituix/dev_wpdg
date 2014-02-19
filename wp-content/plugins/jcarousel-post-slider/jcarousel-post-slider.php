<?php
/*
Plugin Name: Jcarousel Post Slider
Plugin URI: http://blog.saokim.com.vn/jcarousel-post-slider
Description: Show post from checked categories as slider using jquery jcarousel
Author: Nguyen Duc Manh
Version: 1.0
Author URI: http://www.saokim.com.vn
*/

class Slider_Post extends WP_Widget {
	function Slider_Post() {
		parent::WP_Widget(false, $name='Jcarousel Posts Slider',array( 'description' =>'Show posts as slider using jquery jcarousel'));
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$sizes = get_option('thumb_size_dimensions');
		
		//++++ Create cache and CHMOD to 777
		$this->skMakeDir(plugins_url()."/cache");

		echo $before_widget;
			echo $before_title . $instance["title"]. $after_title;
			//Noi dung widget
			$catArr	=	$instance["selected_cats"];
			$strCat	=	"";
			if(!empty($catArr))
			{
				foreach($catArr as $value){
					$strCat	.=	$value.",";		
				}
				$strCat	=	substr($strCat,0,strlen($strCat)-1);
			}
			
			$valid_sort_orders = array('date', 'title', 'comment_count', 'random');
			 if ( in_array($instance['sort_by'], $valid_sort_orders) ) {
				$sort_by = $instance['sort_by'];
				$sort_order = (bool) $instance['asc_sort_order'] ? 'ASC' : 'DESC';
			  } else {
				$sort_by = 'date';
				$sort_order = 'DESC';
			 }
			
			$cat_posts = new WP_Query(
				"showposts=" . $instance["num"] . 
				"&cat=" . $strCat .
				"&orderby=" . $sort_by .
				"&order=" . $sort_order
			  );
			  
			?>
            <script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#mycarousel-<?php echo $id; ?>').jcarousel({
					vertical: <?php echo $instance['vertical']; ?>,
					start: <?php echo $instance['start']; ?>,
					offset: <?php echo $instance['offset']; ?>,
					scroll: <?php echo $instance['scroll']; ?>,
					animation: '<?php echo $instance['animation']; ?>',
					easing: '<?php echo $instance['easing']; ?>',
					auto: <?php echo $instance['auto']; ?>,
					wrap : 'circular'
				});
			});
            </script>
            <?php  
			wp_enqueue_style(
				'jcarousel.css',
				plugins_url("/js/skins/".$instance['skin']."/skin.css",__FILE__)
			);
			// Post list
			echo '<ul id="mycarousel-'.$id.'" class="jcarousel jcarousel-skin-'.$instance["skin"].'">';
			
			while ( $cat_posts->have_posts() )
			{
				$cat_posts->the_post();
			?>
				<li>
					<?php if(has_post_thumbnail()): ?>
	                    <div class="slider-item-image">
		                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		                    	<?php the_post_thumbnail('slide'); ?>
		                    </a>
	                    </div>
                    <?php endif; ?>
                    
                    <?php if($instance['show_post_title']):?>
					 <div class="slider-item-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						 <?php if($instance['show_comment_num']):?>
                            <span class="comment-num"><?php comments_number( '(No Comments)', '(1 Comment)', '(% Comments)' ); ?></span>
                        <?php endif;?>
                        
                        <?php if($instance['show_post_date']):?>
                            <span class="post-date">Date posted: <?php the_date(); ?></span>
                        <?php endif;?>
                     </div>
					<?php endif;
					$excerpt = get_the_excerpt();?>
						<div class=excerpt><?= cut($excerpt,60)?></div><br>
						<?if( function_exists( do_sociable() ) ){ do_sociable(); } ?>
				</li>
			<?php
			}
			wp_reset_query();
			echo "</ul>";
			
		echo $after_widget;
	}
	
	function form($instance) {
		// outputs the options form on admin
		$selected_cats	=	$instance["selected_cats"];	
		?>
		<p>
			<label for="<?php echo $this->get_field_id("title"); ?>">
				<?php _e( 'Title' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
			</label>
		</p>
        <p>
			<label for="<?php echo $this->get_field_id("num"); ?>">
				<?php _e('Number of posts to show'); ?>:
				<input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo absint($instance["num"]?$instance["num"]:10); ?>" size='3' />
			</label>
   		 </p>

        <p>
           <label for="<?php echo $this->get_field_id("sort_by"); ?>">
            <?php _e('Sort by'); ?>:
            <select id="<?php echo $this->get_field_id("sort_by"); ?>" name="<?php echo $this->get_field_name("sort_by"); ?>">
              <option value="date"<?php selected( $instance["sort_by"], "date" ); ?>>Date</option>
              <option value="title"<?php selected( $instance["sort_by"], "title" ); ?>>Title</option>
              <option value="comment_count"<?php selected( $instance["sort_by"], "comment_count" ); ?>>Number of comments</option>
              <option value="random"<?php selected( $instance["sort_by"], "random" ); ?>>Random</option>
            </select>
            </label>
        </p>
		
        <p>
            <label for="<?php echo $this->get_field_id("asc_sort_order"); ?>">
          <input type="checkbox" class="checkbox" 
          id="<?php echo $this->get_field_id("asc_sort_order"); ?>" 
          name="<?php echo $this->get_field_name("asc_sort_order"); ?>"
          <?php checked( (bool) $instance["asc_sort_order"], true ); ?> />
                <?php _e( 'Reverse sort order (ascending)' ); ?>
            </label>
         </p>
         
         
         <?php if ( function_exists('the_post_thumbnail') && current_theme_supports("post-thumbnails") ) : ?>
        <p>
				<?php _e('Thumbnail dimensions'); ?>:<br />
				<label for="<?php echo $this->get_field_id("thumb_w"); ?>">
					W: <input class="widefat" style="width:40%;" type="text" id="<?php echo $this->get_field_id("thumb_w"); ?>" name="<?php echo $this->get_field_name("thumb_w"); ?>" value="<?php echo $instance["thumb_w"]?$instance["thumb_w"]:"75"; ?>" /></label>
				
				
				<label for="<?php echo $this->get_field_id("thumb_h"); ?>">
					H: <input class="widefat" style="width:40%;" type="text" id="<?php echo $this->get_field_id("thumb_h"); ?>" name="<?php echo $this->get_field_name("thumb_h"); ?>" value="<?php echo $instance["thumb_h"]?$instance["thumb_h"]:"75"; ?>" /></label>
				
		</p>
		<?php endif; ?>
        
        <p>
			<label for="<?php echo $this->get_field_id("show_post_title"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_post_title"); ?>" name="<?php echo $this->get_field_name("show_post_title"); ?>"<?php checked( (bool) $instance["show_post_title"], true ); ?> />
				<?php _e( 'Show post title' ); ?>
			</label>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id("show_comment_num"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_comment_num"); ?>" name="<?php echo $this->get_field_name("show_comment_num"); ?>"<?php checked( (bool) $instance["show_comment_num"], true ); ?> />
				<?php _e( 'Show number of comment' ); ?>
			</label>
		</p>
        <p>
			<label for="<?php echo $this->get_field_id("show_post_date"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_post_date"); ?>" name="<?php echo $this->get_field_name("show_post_date"); ?>"<?php checked( (bool) $instance["show_post_date"], true ); ?> />
				<?php _e( 'Show post date' ); ?>
			</label>
		</p>
        
        <p><strong>Silder options:</strong> <hr size="1" />
			<label for="<?php echo $this->get_field_id("skin"); ?>">
				<?php _e( 'Skin' ); ?>:
                <select class="widefat" id="<?php echo $this->get_field_id("skin"); ?>" name="<?php echo $this->get_field_name("skin"); ?>">
                    <?php
						$plug_url	=	plugin_dir_path(__FILE__);
						$directories = glob($plug_url.'js/skins/*' , GLOB_ONLYDIR);
						foreach ($directories as $folder) {
							if(file_exists($plug_url.'js/skins/'.basename($folder).'/skin.css')){
								$skin = $instance['skin'];
								$selected = "";
								if(basename($folder) === $skin){
									$selected	=	'selected = "selected"';		
								}
								echo'<option value="'.basename($folder).'" '.$selected.' >'.basename($folder).'</option>';
							}
						}
					 ?>
                </select>
			</label>
		</p>
        <p>
			<label><?php _e( 'Vertical' ); ?>:
            	<select class="widefat" id="<?php echo $this->get_field_id("vertical"); ?>" name="<?php echo $this->get_field_name("vertical"); ?>">
                	<option value="0"<?php selected( $instance["vertical"], "0" ); ?>>False</option>
                    <option value="1"<?php selected( $instance["vertical"], "1" ); ?>>True</option>
                </select>
            </label>
		</p>
        <p>
        	<label>
				<?php _e( 'Start (<a title="The index of the item to start with.">?</a>)' ); ?>:
				<input size="3" maxlength="3" id="<?php echo $this->get_field_id("start"); ?>" name="<?php echo $this->get_field_name("start"); ?>" type="text" value="<?php echo esc_attr($instance["start"]?$instance["start"]:1); ?>" />
			</label>
        </p>
        <p>
        	<label>
				<?php _e( 'Animation (<a title="The speed of the scroll animation as string in jQuery terms (slow or fast or turn off)">?</a>)' ); ?>:
				<select class="widefat" id="<?php echo $this->get_field_id("animation"); ?>" name="<?php echo $this->get_field_name("animation"); ?>">
                	<option value="normal"<?php selected( $instance["animation"], "normal" ); ?>>Normal</option>
                    <option value="fast"<?php selected( $instance["animation"], "fast" ); ?>>Fast</option>
                    <option value="slow"<?php selected( $instance["animation"], "slow" ); ?>>Slow</option>
                    <option value="0"<?php selected( $instance["animation"], "0" ); ?>>Turn off</option>
                </select>
			</label>
        </p>
        
        <p>
        	<label>
				<?php _e( 'Easing (<a title="The name of the easing effect that you want to use (See jQuery Documentation).">?</a>)' ); ?>:
				<select class="widefat" id="<?php echo $this->get_field_id("easing"); ?>" name="<?php echo $this->get_field_name("easing"); ?>">
                	<option value="swing"<?php selected( $instance["easing"], "swing" ); ?>>Swing</option>
                    <option value="linear"<?php selected( $instance["easing"], "linear" ); ?>>Linear</option>
                </select>
			</label>
        </p>
        <p>
        	<label>
				<?php _e( 'Auto (<a title="Specifies how many seconds to periodically autoscroll the content. If set to 0 (default) then autoscrolling is turned off.">?</a>)' ); ?>:
				<input size="3" maxlength="3" id="<?php echo $this->get_field_id("auto"); ?>" name="<?php echo $this->get_field_name("auto"); ?>" type="text" value="<?php echo esc_attr($instance["auto"]?$instance["auto"]:0); ?>" />
			</label>
        </p>
          <p>
        	<label>
				<?php _e( 'Scroll (<a title="The number of items to scroll by.">?</a>)' ); ?>:
				<input size="3" maxlength="3" id="<?php echo $this->get_field_id("scroll"); ?>" name="<?php echo $this->get_field_name("scroll"); ?>" type="text" value="<?php echo esc_attr($instance["scroll"]?$instance["scroll"]:3); ?>" />
			</label>
        </p>
        
        <p>
        	<label>
				<?php _e( 'Offset (<a title="The index of the first available item at initialisation.">?</a>)' ); ?>:
				<input size="3" maxlength="3" id="<?php echo $this->get_field_id("offset"); ?>" name="<?php echo $this->get_field_name("offset"); ?>" type="text" value="<?php echo esc_attr($instance["offset"]?$instance["offset"]:1); ?>" />
			</label>
        </p>
        
        <?php
				echo '			<b>Select categories</b><hr size="1" />'; 
				echo '			<ul id="categorychecklist" class="list:category categorychecklist form-no-clear" style="list-style-type: none; margin-left: 5px; padding-left: 0px; margin-bottom: 20px;">';

				CSNV_wp_category_checklist(0, 0, $selected_cats, false);  
				echo '			</ul>'; 
	}

	function update($new_instance, $old_instance) { 
		$instance = $old_instance;
		$instance['post_category']	=	serialize($_POST['post_category']);
		$new_instance['selected_cats']	=	($instance['post_category'] != '') ? unserialize($instance['post_category']) : false;
		if ( function_exists('the_post_thumbnail') )
		{
			$sizes = get_option('thumb_size_dimensions'); 
			if ( !$sizes ) $sizes = array();
			$sizes[$this->id] = array($new_instance['thumb_w'], $new_instance['thumb_h']);
			update_option('thumb_size_dimensions', $sizes);
		}
        return $new_instance;
	}		
	
	function skMakeDir( $target ) {
		$target = str_replace( '//', '/', $target );
		if ( file_exists( $target ) )
			return @is_dir( $target );
	
		if ( @mkdir( $target ) ) {
			$stat = @stat( dirname( $target ) );
			$dir_perms = $stat['mode'] & 0007777; 
			@chmod( $target, $dir_perms );
			return true;
		} elseif ( is_dir( dirname( $target ) ) ) {
				return false;
		}
	
		if ( ( $target != '/' ) && ( $this->skMakeDir( dirname( $target ) ) ) )
			return $this->skMakeDir( $target );
	
		return false;
	}	
}


class CSNV_Walker_Category_Checklist extends Walker
{
	var $tree_type = 'category';
	var $db_fields = array('parent'=>'parent', 'id'=>'term_id'); //TODO: decouple this
	var $number;

	function start_lvl (&$output, $depth, $args)
	{
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='children'>\n";
	}

	function end_lvl (&$output, $depth, $args)
	{
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	function start_el (&$output, $category, $depth, $args)
	{
		extract($args);
		
		$class = in_array($category->term_id, $popular_cats) ? ' class="popular-category"' : '';
		$output .= "\n<li id='category-$category->term_id-$this->number'$class>" . '<label class="selectit"><input value="' . $category->term_id . '" type="checkbox" name="post_category[]" id="post_category_' . $category->term_id . '"' . (in_array($category->term_id, $selected_cats) ? ' checked="checked"' : "") . '/> ' . wp_specialchars(apply_filters('the_category', $category->name)) . '</label>';
	}

	function end_el (&$output, $category, $depth, $args)
	{
		$output .= "</li>\n";
	}
}

/**
 * Creates the categories checklist
 *
 * @param int $post_id
 * @param int $descendants_and_self
 * @param array $selected_cats
 * @param array $popular_cats
 * @param int $number
 */
function CSNV_wp_category_checklist ($post_id = 0, $descendants_and_self = 0, $selected_cats = false, $popular_cats = false)
{
	$walker = new CSNV_Walker_Category_Checklist();
	
	$descendants_and_self = (int) $descendants_and_self;
	
	$args = array();
	if (is_array($selected_cats))
		$args['selected_cats'] = $selected_cats;
	elseif ($post_id)
		$args['selected_cats'] = wp_get_post_categories($post_id);
	else
		$args['selected_cats'] = array();
	
	if (is_array($popular_cats))
		$args['popular_cats'] = $popular_cats;
	else
		$args['popular_cats'] = get_terms('category', array('fields'=>'ids', 'orderby'=>'count', 'order'=>'DESC', 'number'=>10, 'hierarchical'=>false));
	
	if ($descendants_and_self) {
		$categories = get_categories("child_of=$descendants_and_self&hierarchical=0&hide_empty=0");
		$self = get_category($descendants_and_self);
		array_unshift($categories, $self);
	} else {
		$categories = get_categories('get=all');
	}
	
	// Post process $categories rather than adding an exclude to the get_terms() query to keep the query the same across all posts (for any query cache)
	$checked_categories = array();
	for ($i = 0; isset($categories[$i]); $i ++) {
		if (in_array($categories[$i]->term_id, $args['selected_cats'])) {
			$checked_categories[] = $categories[$i];
			unset($categories[$i]);
		}
	}
	
	// Put checked cats on top
	echo call_user_func_array(array(&$walker, 'walk'), array($checked_categories, 0, $args));
	// Then the rest of them
	echo call_user_func_array(array(&$walker, 'walk'), array($categories, 0, $args));
}


function load_slider_post_script(){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script(
			'jquery.jcarousel.js',
			plugins_url('/js/jquery.jcarousel.js', __FILE__),
			'',
			'',
			false
		);
	}
	
add_action('init', 'load_slider_post_script');
add_action( 'widgets_init', create_function('', 'return register_widget("Slider_Post");') );