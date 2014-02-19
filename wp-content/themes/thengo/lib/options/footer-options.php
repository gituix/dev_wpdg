<?php
global $tpomain;
$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 array( "name" => __("Footer Options", THEME_SLUG ),
	"type" => "section"),
array( "type" => "open"),
 
array( "name" => __("Disable widgetize Footer","templuto_admin"),
	"desc" => __("Check it, if you want to disable widgets on footer.","templuto_admin"),
	"id" => $shortname."_footer_widget",
	"type" => "checkbox",
	"std" => ""),
	
array( "name" => __("Footer Text", THEME_SLUG ),
	"desc" => __("You can paste some contents here to show on footer section.", THEME_SLUG ),
	"id" => $shortname."_footertext",
	"type" => "textarea",
	"std" => ""),	

array( "type" => "close")


);


?>