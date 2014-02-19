<?php
global $shortname ;

$meta_box = array(
	'id' => 'testimonials',
	'title' => 'Testimonials details',
	'page'=> 'testimonials',
	'context' => 'normal',
	'priority' => 'high',
	'callback'=>'',
	'fields' => array(
		array('name' => 'Client',
			'desc' => 'Enter client/author name.',
			'id' => $shortname . '_testimonials_client',
			'type' => 'text',
			'std' => 'Read More'
		),
		array( "name" => "Desination",
			"desc" => "Enter person's designation.",
			"id" => $shortname."_testimonial_sdesignation",
			"type" => "text",
			"std" => ""),
		array( "name" => "Company",
			"desc" => "Enter company name.",
			"id" => $shortname."_testimonial_company",
			"type" => "text",
			"std" => ""),
		array('name' => 'Read More',
			'desc' => 'Enter read more caption.',
			'id' => $shortname . '_testimonials_readmore',
			'type' => 'text',
			'std' => 'Read More'
		),
	)
);


$slider_page = new templuto_meta_boxes($meta_box);

add_action('init', 'testimonials_register');

	function testimonials_register() {
		  $labels = array(
		    'name' => _x('Testimonials Items', 'post type general name'),
		    'singular_name' => _x('Testimonials Entry', 'post type singular name'),
		    'add_new' => _x('Add New', 'testimonials'),
		    'add_new_item' => __('Add New Testimonials Entry'),
		    'edit_item' => __('Edit Testimonials Entry'),
		    'new_item' => __('New Testimonials Entry'),
		    'view_item' => __('View Testimonials Entry'),
		    'search_items' => __('Search Testimonials Entries'),
		    'not_found' =>  __('No Testimonials Entries found'),
		    'not_found_in_trash' => __('No Testimonials Entries found in Trash'), 
		    'parent_item_colon' => ''
		  );
	
		$slugRule = get_option('category_base');
		if($slugRule == "") $slugRule = 'category';
		
    	$args = array(
        	'labels' => $labels,
        	'public' => true,
        	'show_ui' => true,
        	'capability_type' => 'post',
        	'hierarchical' => false,
        	'rewrite' => array('slug'=>$slugRule.'/testimonials','with_front'=>true),
        	'query_var' => true,
        	'show_in_nav_menus'=> false,
        	'menu_position' => 5,
        	'supports' => array('title','thumbnail','excerpt','editor','comments')
        );

    	register_post_type( 'testimonials' , $args );
    	
    	
    	register_taxonomy("testimonials_entries", 
					    	array("testimonials"), 
					    	array(	"hierarchical" => true, 
					    			"label" => "Testimonials Categories", 
					    			"singular_label" => "Testimonials Categories", 
					    			"rewrite" => true,
					    			"query_var" => true

					    		));  

	}






?>