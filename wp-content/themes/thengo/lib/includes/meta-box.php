<?php
function sidebars_array(){
	global $shortname ;
	$sidebars = get_settings($shortname.'_sidebarname');
	if(!empty($sidebars)){
		$sidebarfound = 'false';
		$options = array();
		$options['Primary Widget Area'] ='Primary Widget Area';
		$options['Contact Us Widget Area'] ='Contact Us Widget Area';
		foreach ($sidebars as $i => $sidebar) {
			$options[$sidebar] = $sidebar;
		}
		return $options;
	}else{
		return array();
	}
}
$meta_box = array(
	'id' => 'postmeta',
	'title' => sprintf(__('%s Options',THEME_SLUG),THEMENAME),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'callback'=>'',
	'fields' => array(
		array( "name" => __("Feature Image", THEME_SLUG ),
			"desc" => __("Upload feature image, to display in blog/category/archive pages", THEME_SLUG ),
			"id" =>"_post_image",
			"type" => "image",
			"std" => ""),
		array(
			"name" =>  __("Feature image link", THEME_SLUG ),
			"desc" => __("Enter URL the image gets linked to(Optional)", THEME_SLUG ),
			"id" => "_page_imagelink",
			"type" => "text",
			"std" => ""
		)
	)
);

$meta_page = new templuto_meta_boxes($meta_box);

$meta_box_page = array(
	'id' => 'postmeta',
	'title' => sprintf(__('%s Options',THEME_SLUG),THEMENAME),
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'high',
	'callback'=>'',
	'fields' => array(
		array( "name" => "Feature Image",
			"desc" => "Upload feature image, to display in blog/category/archive pages",
			"id" =>"_post_image",
			"type" => "image",
			"std" => ""),
		array(
			"name" => "Feature image link",
			"desc" => "Enter URL the image gets linked to(Optional)",
			"id" => "_page_imagelink",
			"type" => "text",
			"std" => ""
		)
	)
);

$meta_page = new templuto_meta_boxes($meta_box_page);



?>