<?php

 
global $tpomain;
$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 
array( "name" => __("General", THEME_SLUG ),
	"type" => "section"),
array( "type" => "open"),

array( "name" => __("Logo URL", THEME_SLUG ),
	"desc" => __("Enter the link to your logo image", THEME_SLUG ),
	"id" => $shortname."_logo",
	"type" => "image",
	"std" => ""),
	
array( "name" => __("Use text as logo", THEME_SLUG ),
	"desc" => __("Check it, if you want show text instead of logo.", THEME_SLUG ),
	"id" => $shortname."_enablelogotext",
	"type" => "checkbox",
	"std" => ""),
	
array( "name" => __("Logo Text", THEME_SLUG ),
	"desc" => __("Text to use as logo.", THEME_SLUG ),
	"id" => $shortname."_logotext",
	"type" => "text",
	"std" => ""),	
	
array( "name" => __("Tagline", THEME_SLUG ),
	"desc" => __("Tagline of website", THEME_SLUG ),
	"id" => $shortname."_tagline",
	"type" => "text",
	"std" => ""),	

array( "name" => __("Disable auto resize of images", THEME_SLUG ),
	"desc" => __("Disble auto resize of images(use of timthumb), check it", THEME_SLUG ),
	"id" => $shortname."_timthumb",
	"type" => "checkbox",
	"std" => ""),	
		
array( "name" => __("Phone", THEME_SLUG ),
	"desc" => __("Enter your phone no, if you want to display", THEME_SLUG ),
	"id" => $shortname."_phone",
	"type" => "text",
	"std" => ""),	
	
array( "name" => __("Show Breadcrumbs", THEME_SLUG ),
	"desc" => __("Check it, if you want to show Breadcrumbs on pages/posts.", THEME_SLUG ),
	"id" => $shortname."_breadcrumbs",
	"type" => "checkbox",
	"std" => ""),
	
array( "name" => __("Google Analytics Code", THEME_SLUG ),
	"desc" => __("You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.", THEME_SLUG ),
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""),	
	
array( "name" => __("Custom Favicon", THEME_SLUG ),
	"desc" => __("A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image", THEME_SLUG ),
	"id" => $shortname."_favicon",
	"type" => "image",
	"std" => get_template_directory_uri() ."/favicon.ico"),	
	
array( "name" => __("Feedburner URL", THEME_SLUG ),
	"desc" => __("Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website", THEME_SLUG ),
	"id" => $shortname."_feedburner",
	"type" => "text",
	"std" => get_bloginfo('rss2_url')),
 
array( "type" => "close"),

array( "name" => __("Social Profile", THEME_SLUG ),
	"type" => "section"),
array( "type" => "open"),

array( "name" => __("Show Social Icons", THEME_SLUG ),
	"desc" => __("If the theme support, it shows social icons on top. Not all theme support it. It depend on design.", THEME_SLUG ),
	"id" => $shortname."_socialicons_ontop",
	"type" => "checkbox",
	"std" => ""),
	
array( "name" => __("Facebook", THEME_SLUG ),
	"desc" => __("Enter Tacebook url", THEME_SLUG ),
	"id" => $shortname."_facebook_url",
	"type" => "text",
	"std" => ""),	
	
array( "name" => __("Twitter", THEME_SLUG ),
	"desc" => __("Enter Twitter url", THEME_SLUG ),
	"id" => $shortname."_twitter_url",
	"type" => "text",
	"std" => ""),
	
array( "name" => __("Linkedin", THEME_SLUG ),
	"desc" => __("Enter Linkedin url", THEME_SLUG ),
	"id" => $shortname."_linkedin_url",
	"type" => "text",
	"std" => ""),

array( "name" => __("Google Plus", THEME_SLUG ),
	"desc" => __("Enter Google Plus url", THEME_SLUG ),
	"id" => $shortname."_googleplus_url",
	"type" => "text",
	"std" => ""),


array( "name" => __("Youtube", THEME_SLUG ),
	"desc" => __("Enter Youtube url", THEME_SLUG ),
	"id" => $shortname."_youtube_url",
	"type" => "text",
	"std" => ""),
	
array( "name" => __("RSS", THEME_SLUG ),
	"desc" => __("Your rss feed url", THEME_SLUG ),
	"id" => $shortname."_rss_url",
	"type" => "text",
	"std" => ""),

array( "type" => "close")

);


?>