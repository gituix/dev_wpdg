<?php
global $shortname ;

$meta_box = array(
	'id' => 'portfolio',
	'title' => 'Portfolio details',
	'page'=> 'portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'callback'=>'',
	'fields' => array(
		array( "name" => "Thumbnail Image",
			"desc" => "Upload thumbnail image for portfolio.",
			"id" => $shortname."_portfolio_thumb_image",
			"type" => "image",
			"std" => ""),
		array( "name" => "Full Image",
			"desc" => "Upload full image for portfolio.",
			"id" => $shortname."_portfolio_full_image",
			"type" => "image",
			"std" => ""),
		array( "name" => "Type",
			"desc" => "Portfolio items may contains images, video and documet. When image is clicked, the crossponding image, video or document will open in Lightbox.",
			"id" => $shortname."_portfolio_imagetype",
			"type" => "select",
			"options" => array( "image", "video", "document"),
			"std" => "Image"),
		array( "name" => "Video Link",
			"desc" => "Enter URL of YouTube/Vimeo. Applicable if only you choose type is video..",
			"id" => $shortname."_portfolio_video_link",
			"type" => "text",
			"std" => ""),
		array(
			'name' => 'Read More',
			'desc' => 'Enter read more caption.',
			'id' => $shortname . '_portfolio_readmore',
			'type' => 'text',
			'std' => 'Read More'
		),
	)
);


$slider_page = new templuto_meta_boxes($meta_box);

add_action('init', 'portfolio_register');

	function portfolio_register() {
		  $labels = array(
		    'name' => _x('Portfolio Items', 'post type general name'),
		    'singular_name' => _x('Portfolio Entry', 'post type singular name'),
		    'add_new' => _x('Add New', 'portfolio'),
		    'add_new_item' => __('Add New Portfolio Entry'),
		    'edit_item' => __('Edit Portfolio Entry'),
		    'new_item' => __('New Portfolio Entry'),
		    'view_item' => __('View Portfolio Entry'),
		    'search_items' => __('Search Portfolio Entries'),
		    'not_found' =>  __('No Portfolio Entries found'),
		    'not_found_in_trash' => __('No Portfolio Entries found in Trash'), 
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
        	'rewrite' => array('slug'=>$slugRule.'/portfolio','with_front'=>true),
        	'query_var' => true,
        	'show_in_nav_menus'=> false,
        	'menu_position' => 5,
        	'supports' => array('title','thumbnail','excerpt','editor','comments','custom-fields')
        );

    	register_post_type( 'portfolio' , $args );
    	
    	
    	register_taxonomy("portfolio_entries", 
					    	array("portfolio"), 
					    	array(	"hierarchical" => true, 
									'show_ui' => true,
					    			"label" => "Portfolio Categories", 
					    			"singular_label" => "Portfolio Categories", 
					    			"rewrite" => true,
									'paged'=>true,
									"_builtin" => false,
					    			"query_var" => true
					    		));  
	}

#portfolio_columns, <-  register_post_type then append _columns
add_filter("manage_edit-portfolio_columns", "prod_edit_columns");
add_action("manage_posts_custom_column",  "prod_custom_columns");

function prod_edit_columns($columns){

		$newcolumns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Title",
			"portfolio_entries" => "Categories"
		);
		
		$columns= array_merge($newcolumns, $columns);

		return $columns;
}

function prod_custom_columns($column){
		global $post;
		switch ($column)
		{
			case "description":
				#the_excerpt();
				break;
			case "price":
				#$custom = get_post_custom();
				#echo $custom["price"][0];
				break;
			case "portfolio_entries":
				echo get_the_term_list($post->ID, 'portfolio_entries', '', ', ','');
				break;
		}
}




?>