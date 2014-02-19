<?php


global $tpomain;


$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 
array( "name" => __("Navigation Settings", THEME_SLUG ),
	"type" => "section"),
array( "type" => "open"),
 
array( "name" => __("Pages on top navigation/menus", THEME_SLUG ),
	"desc" => __("Select the pages you want to include on top navigation. Click (+) to add and (-) to remove or can drag and drop. Click on left arrow icon or drag to arrange order of pages", THEME_SLUG ),
	"id" => $shortname."_nav_pages",
	"type" => "multipages",
	"std" => ""),

array( "name" => __("Pages on footer navigation/menus", THEME_SLUG ),
	"desc" => __("Select the pages you want to include on footer navigation. Click (+) to add and (-) to remove or can drag and drop. Click on left arrow icon or drag to arrange order of pages", THEME_SLUG ),
	"id" => $shortname."_footer_pages",
	"type" => "multipages",
	"std" => ""),
	
array( "name" => __("Enable Wordpress Custom Menu", THEME_SLUG ),
	"desc" => __("Check it, if you want to use Wordpress inbuilt custom navigation/menus. click here to configure <a href=\"./nav-menus.php\">Custom Nav</a>", THEME_SLUG ),
	"id" => $shortname."_custom_menu",
	"type" => "checkbox",
	"std" => ""),

array( "name" => __("Top Wordpress Custom Menu", THEME_SLUG ),
	"desc" => __("If you want to use Wordpress Custom Menu, select one and if you have not created yet, click here <a href=\"./nav-menus.php\">Custom Nav</a>.", THEME_SLUG ),
	"id" => $shortname."_top_custom_nav",
	"type" => "select",
	"options" => $tpomain->tpo_get_navs(),
	"std" => "Choose a menu"),
	
array( "name" => __("Footer Wordpress Custom Menu", THEME_SLUG ),
	"desc" => __("If you want to use Wordpress Custom Menu, select one and if you have not created yet, click here <a href=\"./nav-menus.php\">Custom Nav</a>.", THEME_SLUG ),
	"id" => $shortname."_footer_custom_nav",
	"type" => "select",
	"options" => $tpomain->tpo_get_navs(),
	"std" => "Choose a menu"),

array( "type" => "close")
);

?>