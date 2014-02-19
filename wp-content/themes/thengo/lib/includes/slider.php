<?php
global $shortname ;

$cycleeffects = array("blindX", "blindY", "blindZ","cover", "curtainX", "curtainY","fade", "fadeZoom", "growX", "growY", "none", "scrollUp", "scrollDown","scrollLeft", "scrollRight", "scrollHorz","scrollVert", "shuffle", "slideX","slideY", "toss", "turnUp","turnDown", "turnLeft", "turnRight","uncover", "wipe", "zoom");

$nivoeffects = array("sliceDown", "sliceDownLeft", "sliceUp","sliceUpLeft", "sliceUpDown", "sliceUpDownLeft","fold", "fade", "random");
$meta_box = array(
	'id' => 'slideshow',
	'title' => 'Slide details',
	'page'=> 'slideshow',
	'context' => 'normal',
	'priority' => 'high',
	'callback'=>'',
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
			'name' => 'Disable Title and Description',
			'desc' => 'Check it, if you want to hide slider\'s title and description.',
			'id' => $shortname . '_hide_slider_title',
			'type' => 'checkbox',
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
	)
);


$slider_page = new templuto_meta_boxes($meta_box);

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


//add_action('admin_menu', 'add_slider_box');

//function add_slider_box() {
//	global $meta_box;
//	add_meta_box($meta_box['id'], $meta_box['title'], 'slider_metaboxes', "slideshow", $meta_box['context'], $meta_box['priority']);
//}



?>