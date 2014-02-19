<?php

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category"); 
$tween_types = array("fade","linear","easeInSine","easeOutSine", "easeInOutSine", "easeInCubic", "easeOutCubic", "easeInOutCubic", "easeOutInCubic", "easeInQuint", "easeOutQuint", "easeInOutQuint", "easeOutInQuint", "easeInCirc", "easeOutCirc", "easeInOutCirc", "easeOutInCirc", "easeInBack", "easeOutBack", "easeInOutBack", "easeOutInBack", "easeInQuad", "easeOutQuad", "easeInOutQuad", "easeOutInQuad", "easeInQuart", "easeOutQuart", "easeInOutQuart", "easeOutInQuart", "easeInExpo", "easeOutExpo", "easeInOutExpo", "easeOutInExpo", "easeInElastic", "easeOutElastic", "easeInOutElastic", "easeOutInElastic", "easeInBounce", "easeOutBounce", "easeInOutBounce", "easeOutInBounce");

$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 
array( "name" => __("Slide Show Options", THEME_SLUG ),
	"type" => "section"),
array( "type" => "open"),

array( "name" => __("Number of Slides", THEME_SLUG ),
	"desc" => __("Number of slides you want to display, however 4 to 10 is recommended for faster loading of site.", THEME_SLUG ),
	"id" => $shortname."_cycle_slide_count",
	"class" => "input_numeric",
	"maxlength" => "2",
	"type" => "textslider",
	"maximum" => "15",
	"minimum" => "2",
	"std" => "5"),

array( "name" => __("Slider Transition Delay", THEME_SLUG ),
	"desc" => __("Enter Length of time (in seconds) you want each image to be visible or stay there before moving to next. Default is 5 Second.", THEME_SLUG ),
	"id" => $shortname."_cycle_trandelay",
	"class" => "input_numeric",
	"maxlength" => "2",
	"type" => "textslider",
	"maximum" => "20",
	"minimum" => "1",
	"suffix" => "Seconds",
	"std" => "5"),
	
array( "name" => __("Slider Transition Speed", THEME_SLUG ),
	"desc" => __("Enter transitions speed in seconds. Default is 1 Second.", THEME_SLUG ),
	"id" => $shortname."_cycle_transpeed",
	"class" => "input_numeric",
	"maxlength" => "2",
	"type" => "textslider",
	"maximum" => "20",
	"minimum" => "1",
	"suffix" => "Seconds",
	"std" => "1"),
	
	
array( "name" => __("Show slider in all pages", THEME_SLUG ),
	"desc" => __("Check it, if you want to show slider in all pages.", THEME_SLUG ),
	"id" => $shortname."_cycle_showinall",
	"type" => "checkbox",
	"std" => ""),
	
array( "name" => __("Show Next/Previous Buttons", THEME_SLUG ),
	"desc" => __("Check it, if you want to show show Next/Previous Buttons.", THEME_SLUG ),
	"id" => $shortname."_cycle_prev_next",
	"type" => "checkbox",
	"std" => ""),
array( "type" => "close")
);
?>