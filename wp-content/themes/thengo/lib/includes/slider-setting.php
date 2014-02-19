<?php
global $shortname ;

$cycleeffects = array("blindX", "blindY", "blindZ","cover", "curtainX", "curtainY","fadeZoom", "growX", "growY", "none", "scrollUp", "scrollDown","scrollLeft", "scrollRight", "scrollHorz","scrollVert", "shuffle", "slideX","slideY", "toss", "turnUp","turnDown", "turnLeft", "turnRight","uncover", "wipe", "zoom");

$nivoeffects = array("sliceDown", "sliceDownLeft", "sliceUp","sliceUpLeft", "sliceUpDown", "sliceUpDownLeft","fold", "fade", "random");

$meta_box = array(
	'id' => 'my-meta-box',
	'title' => 'Slide details',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => "Slider Image",
			"desc" => "Upload slider image. Default width is 990px and height is 410px",
			"id" => $shortname."_slider_image",
			"type" => "image",
			"std" => ""),
		array(
			'name' => 'Slider URL',
			'desc' => 'Enter URL the slide gets linked to(Optional)',
			'id' => $shortname . '_slider_url',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => 'Description',
			'desc' => 'Enter description for the slide.',
			'id' => $shortname . '_slider_description',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => 'Effect',
			'desc' => 'Slide transition effect. If you are using Cycle slider.',
			'id' => $shortname . '_slider_effect',
			'type' => 'select',
			'options' => $cycleeffects
		),
		array(
			'name' => 'Read More',
			'desc' => 'Enter read more caption.',
			'id' => $shortname . '_slider_readmore',
			'type' => 'text',
			'std' => 'Read More'
		),
	)
);


add_action('init', 'slideshow_register');

	function slideshow_register() {
		  $labels = array(
		    'name' => _x('Slider Entries', 'post type general name'),
		    'singular_name' => _x('Slider Entry', 'post type singular name'),
		    'add_new' => _x('Add New', 'slideshow'),
		    'add_new_item' => __('Add New Slider Entry'),
		    'edit_item' => __('Edit Slider Entry'),
		    'new_item' => __('New Slider Entry'),
		    'view_item' => __('View Slider Entry'),
		    'search_items' => __('Search Slider Entries'),
		    'not_found' =>  __('No Slider Entries found'),
		    'not_found_in_trash' => __('No Slider Entries found in Trash'), 
		    'parent_item_colon' => ''
		  );

	
    	$args = array(
        	'labels' => $labels,
        	'public' => true,
        	'show_ui' => true,
        	'capability_type' => 'post',
        	'hierarchical' => false,
        	'rewrite' => true,
        	'show_in_nav_menus'=> false,
        	'menu_position' => 5,
        	'supports' => array('title','thumbnail')
        );

    	register_post_type( 'slideshow' , $args );
	}


add_action('admin_menu', 'add_slider_box');

function add_slider_box() {
	global $meta_box;
	add_meta_box($meta_box['id'], $meta_box['title'], 'slider_metaboxes', "slideshow", $meta_box['context'], $meta_box['priority']);
}
function slider_metaboxes() {
	global $meta_box, $post;
		echo '<div id="tpo_admin_wrap" >';
		echo '<div class="tpo_admin_op">';
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	

	foreach ($meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
			case 'text':
				$output = '';
				$output .= '<div class="tpo_post_admin_input">' ;
				$output .= '<label for="' . $field['id'] . '">' .$field['name'] .'</label>';
				$output .= '<div>' . $field['desc'] . '<br/></div><br/>';
				$output .= '<input name="' . $field['id'] . '" id="' . $field['id'] . '" ' . (($field['class'] != "") ? "class=".$field['class']."" : "" ) . ' type="' . $field['type'] . '" value="' .
				 ( $meta ? $meta : $field['std'] ) . '" />';
				 $output .= '&nbsp;' .$field['suffix'] ;
				$output .= '<div class="clearfix"></div>';
				$output .= '</div>';
				echo $output;
				break;

			case 'textarea':
					$output = '';
					$output .= '<div class="tpo_post_admin_input">';
					$output .= '<label for="' . $field['id'] . '">' . $field['name'] . '</label>';
					$output .= '<div>' . $field['desc'] . '<br/></div><br/>';
					$output .= '<textarea name="' . $field['id'] . '" ' . (($field['class'] != "") ? "class=".$field['class'] : "" ) . '" type="' . $value['type'] . '" cols="" rows="">';
					$output .=  ( $meta ? $meta : $field['std'] );  
					$output .= '</textarea>';
				 	$output .= '<div><br /><small>' . $field['desc'] . '</small></div><div class="clearfix"></div>';
				 	$output .= '</div>';
					echo $output;
					break;
			case 'select':
				$output = '';
				$output .= '<div class="tpo_post_admin_input">';
				$output .= '<label for="' . $field['id'] . '">' . $field['name'] . '</label>';
				$output .= '<div>' . $field['desc'] . '<br/></div><br/>';
				$output .= '<select name="' . $field['id'] . '" id="' . $field['id'] . '">';
				foreach ($field['options'] as $option) { 
					$output .= '<option ' . (( $meta == $option) ? 'selected="selected"' : '') . '>'. $option .'</option>';
				 } 
				$output .= '</select>';
				$output .= '</div>';
				echo $output;
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
			case 'image':
				echo '<div class="tpo_post_admin_input">';
				echo '<label for="' . $field['id'] . '">' . $field['name'] . '</label>';
				echo '<div>' . $field['desc'] . '<br/></div><br/>';
				echo '<div>';
				echo '<input name="' . $field['id'] . '" id="' . $field['id'] . '_upload" type="text" value="' . ( $meta ? $meta : $field['std'] ) .'" />';
				echo '</div>';
				echo '<div><span  id="' . $field['id'] . '" class="tpo_image_upload" >Upload Image</span>';
				if ( $meta != "") { 
					echo '<span  id="remove_' . $field['id'] . '" class="tpo_image_remove" >Remove</span>';
				 }
				echo '</div>';
				if ( $meta != "") { 
					if (get_settings('tpo_slide_width')) {
						$sliderwidth = get_settings('tpo_slide_width');
						if ($sliderwidth > 400) 	$sliderwidth = 400;
					} else {
						$sliderwidth = 200;
					}
					if (get_settings('tpo_slide_height')) {
						$sliderheight = get_settings('tpo_slide_height');
						$sliderheight = round(($sliderwidth/get_settings('tpo_slide_width'))*$sliderheight);
					} else {
						$sliderheight = 150;
					}
				$sliderimage = tpo_image_resize($height=$sliderheight, $width=$sliderwidth, stripslashes($meta));
				echo '<img class="hide"  id="image_' . $field['id'] . '"  src="' . $sliderimage. '" alt="" style="">';
				} 
				echo '<div class="clearfix"></div>';
				echo '</div>';
				 break;

		}
	}
	echo '</div></div>';
	
}

add_action('save_post', 'post_save_data');
function post_save_data($post_id) {
	global $meta_box;
	if (!wp_verify_nonce($_POST['tpo_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	foreach ($meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

?>