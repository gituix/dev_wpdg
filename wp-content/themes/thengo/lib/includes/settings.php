<?php

$shortname = "tpo";

function tpo_options($option,$default = ''){
	$toption = get_settings($option);
	if (!$toption) { $toption = $default;}
	return  $toption;
}

define('THEMENAME','Zebra Themes');

define('TPO_MESSAGE','<div class="trial-message" > <h1>Go PREMIUM!</h1><p>You are using the trial version of the TheNgo theme. Upgrade to Premium version to enable the advance features of the theme like more than 50 shortcodes, more than 2 slider slides, blog options, fullwidth template, Unlimited Sidebar, Contact us template, etc. Also timely theme updates for lifetime and dedicated support will be provided.</p><a href="http://zebrathemes.com/buy/?wordpress-theme=thengo" >http://zebrathemes.com/buy/?wordpress-theme=TheNgo</a></div>');
define('THEME_SLUG','zebra_themes');

define('TPO_CONTENT_WIDTH', '970');
define('TPO_CONTENTCOLUMN_WIDTH', '640');
define('TPO_CONTENTCOLUMN_FULLWIDTH', '980');

define('TPO_BODY_BACKGROUNDCOLOR', tpo_options($shortname . '_bodybackgroundcolor','#fff'));

define('TPO_DISABLETEASER', tpo_options($shortname . '_disableteasure'));
define('TPO_TEASERTEXT', tpo_options($shortname . '_teasuretext'));
define('TPO_TEASERTEXTCOLOR', tpo_options($shortname . '_teasertextcolor'));

define('TPO_HEADER_BACKGROUNDCOLOR', tpo_options($shortname . '_headerbackgroundcolor','#fff'));
define('TPO_HEADER_BACKGROUNDCOLOR', tpo_options($shortname . '_headerbackgroundcolor','#fff'));
define('TPO_PAGETITLE_BACKGROUNDCOLOR', tpo_options($shortname . '_pagetitlebackgroundcolor','#fff'));
define('TPO_PAGETITLE_FONTCOLOR', tpo_options($shortname . '_pagetitlefontcolor','#999'));
define('TPO_PAGECONTENT_BACKGROUNDCOLOR', tpo_options($shortname . '_pagecontentbackgroundcolor','#fff'));
define('TPO_BODYFONTCOLOR', tpo_options($shortname . '_bodyfontcolor','#999'));

define('TPO_SLIDER_TYPE', tpo_options($shortname . '_slide_type','Cycle'));
define('TPO_LOGO', tpo_options($shortname . '_logo'));

define('TPO_BREADCRUMBS', tpo_options($shortname . '_breadcrumbs'));

define('TPO_DEFAULTFONT',tpo_options($shortname . '_body_font'),'Arial, Helvetica, sans-serif');
define('TPO_USEGOOGLEFONTS',tpo_options($shortname . '_font_usegoogle'));
define('TPO_GOOGLEFONT',tpo_options($shortname . '_font_googlefont'),'Allerta');
define('TPO_GOOGLEFONTBODY',tpo_options($shortname . '_font_googlebody'));
define('TPO_GOOGLEFONTHEADERS',tpo_options($shortname . '_font_googleheaders'));
define('TPO_GOOGLEFONTPARAGRAPH',tpo_options($shortname . '_font_googleparagraph'));
define('TPO_GOOGLEFONTLINKS',tpo_options($shortname . '_font_googlelinks'));
define('TPO_GOOGLEFONTNAV',tpo_options($shortname . '_font_googlenav'));

define('TPO_SLIDER_FLASH_WIDTH', tpo_options($shortname . '_slide_flash_width',''));
define('TPO_SLIDER_FLASH_HEIGHT', tpo_options($shortname . '_slide_flash_height',''));

define('TPO_SLIDER_NIVO_WIDTH', tpo_options($shortname . '_slide_nivo_width',''));
define('TPO_SLIDER_NIVO_HEIGHT', tpo_options($shortname . '_slide_nivo_height',''));


define('TPO_SLIDER_FLASH_SEGMENTS', tpo_options($shortname . '_slide_flash_segments','10'));
define('TPO_SLIDER_FLASH_TWEENTIME', tpo_options($shortname . '_slide_flash_tweentime','1'));
define('TPO_SLIDER_FLASH_TWEENDELAY', tpo_options($shortname . '_slide_flash_tweendelay','0.1'));
define('TPO_SLIDER_FLASH_ZDISTANCE', tpo_options($shortname . '_slide_flash_zdistance','0'));
define('TPO_SLIDER_FLASH_EXPAND', tpo_options($shortname . '_slide_flash_expand','20'));
define('TPO_SLIDER_FLASH_SHADOW', tpo_options($shortname . '_slide_flash_shadow','25'));
define('TPO_SLIDER_FLASH_AUTOPLAY', tpo_options($shortname . '_slide_flash_autoplay','2'));
define('TPO_SLIDER_FLASH_COLOR', tpo_options($shortname . '_slide_flash_color','#000'));
define('TPO_SLIDER_FLASH_TWEENTYPE', tpo_options($shortname . '_slide_flash_tweentype','linear'));

define('TPO_SHOW_FEATUREBACKGROUD', tpo_options($shortname . '_featurebackground'));
define('TPO_FEATUREBACKGROUDCOLOR', tpo_options($shortname . '_featurebackgroundcolor','#000'));
define('TPO_SHOW_FEATURE_PATTERN', tpo_options($shortname . '_show_homepage_pattern'));
define('TPO_FEATURE_PATTERN', tpo_options($shortname . '_homepage_pattern'));

define('TPO_TOPNAV_FONTCOLOR', tpo_options($shortname . '_topnav_fontcolor','#999'));
define('TPO_TOPNAV_ACTIVEFONTCOLOR', tpo_options($shortname . '_topnav_activefontcolor','#000'));
define('TPO_TOPNAV_HOVERFONTCOLOR', tpo_options($shortname . '_topnav_hoverfontcolor','#000'));
define('TPO_TOPSUBNAV_FONTCOLOR', tpo_options($shortname . '_topsubnav_fontcolor','#999'));
define('TPO_TOPSUBNAV_HOVERFONTCOLOR', tpo_options($shortname . '_topsubnav_hoverfontcolor','#000'));
define('TPO_TOPSUBNAV_BACKGROUNDCOLOR', tpo_options($shortname . '_topnav_backgroundcolor','#fff'));
define('TPO_TOPSUBNAV_HOVERBACKGROUNDCOLOR', tpo_options($shortname . '_topnav_hoverbackgroundcolor','#fff'));
define('TPO_TOPNAV_FONTSIZE', tpo_options($shortname . '_topnav_fontsize','13'));
define('TPO_TOPSUBNAV_FONTSIZE', tpo_options($shortname . '_topsubnav_fontsize','13'));

define('TPO_BLOG_IMAGE_TYPE', tpo_options($shortname . '_blog_image_type','Full Width'));
define('TPO_BLOG_IMAGE_FULLHEIGHT', tpo_options($shortname . '_blog_image_fullwidth','235'));
define('TPO_BLOG_IMAGE_THUMBWIDTH', tpo_options($shortname . '_blog_cat_thumbnail_width','150'));
define('TPO_BLOG_IMAGE_THUMBHEIGHT', tpo_options($shortname . '_blog_cat_thumbnail_height','150'));


define('TPO_BLOG_SHOW_THUMBNAIL', tpo_options($shortname . '_blog_cat_thumbnail'));



define('TPO_BLOG_TITLE_FONTSIZE', tpo_options($shortname . '_blog_title_fontsize','24'));
define('TPO_BLOG_TITLE_FONTCOLOR', tpo_options($shortname . '_blog_title_fontcolor','#666'));

define('TPO_BLOG_SHOW_AUTHORBIO', tpo_options($shortname . '_blog_single_author','true'));

define('TPO_BLOG_SHOW_TITLEPOSITION', tpo_options($shortname . '_blog_cat_title_pos'));
define('TPO_BLOG_SHOW_META', tpo_options($shortname . '_blog_cat_show_meta'));
define('TPO_BLOG_SHOW_METAPOSITION', tpo_options($shortname . '_blog_cat_meta_pos'));

if ( tpo_options($shortname . '_blog_cat_author') ) {
	define('TPO_BLOG_SHOW_AUTHOR', tpo_options($shortname . '_blog_cat_author'));
} else {
	if ( DEF_SHOW_BLOG_AUTHOR == 'true' ) {
		define('TPO_BLOG_SHOW_AUTHOR', DEF_SHOW_BLOG_AUTHOR );
	} else {
		define('TPO_BLOG_SHOW_AUTHOR', '' );
	}
}

if ( tpo_options($shortname . '_blog_cat_cat') ) {
	define('TPO_BLOG_SHOW_CATEGORIES', tpo_options($shortname . '_blog_cat_cat'));
} else {
	if ( DEF_SHOW_BLOG_CATEGORIES == 'true' ) {
		define('TPO_BLOG_SHOW_CATEGORIES', DEF_SHOW_BLOG_CATEGORIES );
	} else {
		define('TPO_BLOG_SHOW_CATEGORIES', '' );
	}
}

if ( tpo_options($shortname . '_blog_cat_date') ) {
	define('TPO_BLOG_SHOW_DATE', tpo_options($shortname . '_blog_cat_date'));
} else {
	if ( DEF_SHOW_BLOG_DATE == 'true' ) {
		define('TPO_BLOG_SHOW_DATE', DEF_SHOW_BLOG_DATE );
	} else {
		define('TPO_BLOG_SHOW_DATE', '' );
	}
}

if ( tpo_options($shortname . '_blog_cat_commentcount') ) {
	define('TPO_BLOG_SHOW_COMMENTCOUNT', tpo_options($shortname . '_blog_cat_commentcount'));
} else {
	if ( DEF_SHOW_BLOG_COMMENTCOUNT == 'true' ) {
		define('TPO_BLOG_SHOW_COMMENTCOUNT', DEF_SHOW_BLOG_COMMENTCOUNT );
	} else {
		define('TPO_BLOG_SHOW_COMMENTCOUNT', '' );
	}
}


if ( tpo_options($shortname . '_blog_cat_tags') ) {
	define('TPO_BLOG_SHOW_TAGS', tpo_options($shortname . '_blog_cat_tags'));
} else {

	if ( DEF_SHOW_BLOG_TAGS == 'true' ) {
		define('TPO_BLOG_SHOW_TAGS', DEF_SHOW_BLOG_TAGS );
	} else {
		define('TPO_BLOG_SHOW_TAGS', '' );
	}
}


if ( tpo_options($shortname . '_blog_excerpt_disable') ) {
	define('TPO_BLOG_EXCERPT_DISABLE', tpo_options($shortname . '_blog_excerpt_disable'));
} else {
	if ( DEF_BLOG_EXCERPT_DISABLE == 'true' ) {
		define('TPO_BLOG_EXCERPT_DISABLE', DEF_BLOG_EXCERPT_DISABLE );
	} else {
		define('TPO_BLOG_EXCERPT_DISABLE', '' );
	}
}

if ( tpo_options($shortname . '_blog_excerpt_disable') ) {
	define('TPO_BLOG_EXCERPT_DISABLE', tpo_options($shortname . '_blog_excerpt_disable'));
} else {
	if ( DEF_BLOG_EXCERPT_DISABLE == 'true' ) {
		define('TPO_BLOG_EXCERPT_DISABLE', DEF_BLOG_EXCERPT_DISABLE );
	} else {
		define('TPO_BLOG_EXCERPT_DISABLE', '' );
	}
}



define('TPO_BLOG_META_BORDER', tpo_options($shortname . '_blog_cat_meta_border'));
define('TPO_BLOG_META_BORDERCOLOR', tpo_options($shortname . '_blog_cat_meta_bordercolor','#666'));
define('TPO_BLOG_META_FONTSIZE', tpo_options($shortname . '_blog_cat_meta_fontsize','11'));
define('TPO_BLOG_CAT_FONTCOLOR', tpo_options($shortname . '_blog_cat_fontcolor','#666'));
define('TPO_BLOG_COMM_FONTCOLOR', tpo_options($shortname . '_blog_cat_commentcolor','#666'));
define('TPO_BLOG_DATE_FONTCOLOR', tpo_options($shortname . '_blog_cat_datecolor','#666'));
define('TPO_BLOG_CAT_CAPTION', tpo_options($shortname . '_blog_cat_caption','Posted In'));
define('TPO_BLOG_CAT_CAPTION_FONTCOLOR', tpo_options($shortname . '_blog_cat_caption_fontcolor','#666'));
define('TPO_BLOG_PARA_FONTSIZE', tpo_options($shortname . '_blog_para_fontsize','13'));
define('TPO_BLOG_PARA_FONTCOLOR', tpo_options($shortname . '_blog_para_fontcolor','#666'));
define('TPO_BLOG_READMORE_TEXT', tpo_options($shortname . '_blog_readmore_text','Read More'));
define('TPO_BLOG_READMORE_FONTSIZE', tpo_options($shortname . '_blog_readmore_fontsize','11'));
define('TPO_BLOG_READMORE_FONTCOLOR', tpo_options($shortname . '_blog_readmore_fontcolor','#666'));
define('TPO_BLOG_CATEGORIES', tpo_options($shortname . '_blog_cats'));
define('TPO_BLOG_PAGELAYOUT', tpo_options($shortname . '_blogpage_layout'));


define('TPO_PORTFOLIO_SHOWTITLE', tpo_options($shortname . '_portfolio_showtitle'));
define('TPO_PORTFOLIO_SHOWDESCRIPTION', tpo_options($shortname . '_portfolio_showdescription'));
define('TPO_PORTFOLIO_SHOWREADMORE', tpo_options($shortname . '_portfolio_showmore'));
define('TPO_PORTFOLIO_READMORETEXT', tpo_options($shortname . '_portfolio_moretext','Read More'));
define('TPO_PORTFOLIO_1COLUMN_IMAGE_HEIGHT', tpo_options($shortname . '_portfolio_1column_image_height','350'));
define('TPO_PORTFOLIO_2COLUMN_IMAGE_HEIGHT', tpo_options($shortname . '_portfolio_2column_image_height','255'));
define('TPO_PORTFOLIO_3COLUMN_IMAGE_HEIGHT', tpo_options($shortname . '_portfolio_3column_image_height','175'));
define('TPO_PORTFOLIO_4COLUMN_IMAGE_HEIGHT', tpo_options($shortname . '_portfolio_4column_image_height','175'));

define('TPO_PORTFOLIO_1COLUMN_NOITEMS', tpo_options($shortname . '_portfolio_4column_noitems','5'));
define('TPO_PORTFOLIO_2COLUMN_NOITEMS', tpo_options($shortname . '_portfolio_2column_noitems','10'));
define('TPO_PORTFOLIO_3COLUMN_NOITEMS', tpo_options($shortname . '_portfolio_3column_noitems','15'));
define('TPO_PORTFOLIO_4COLUMN_NOITEMS', tpo_options($shortname . '_portfolio_4column_noitems','20'));

define('TPO_PORTFOLIO_TITLE_FONTSIZE', tpo_options($shortname . '_portfolio_title_fontsize','16'));
define('TPO_PORTFOLIO_PARA_FONTSIZE', tpo_options($shortname . '_portfolio_para_fontsize','13'));
define('TPO_PORTFOLIO_READMORE_FONTSIZE', tpo_options($shortname . '_portfolio_readmore_fontsize','13'));

define('TPO_PORTFOLIO_TITLE_FONTCOLOR', tpo_options($shortname . '_portfolio_title_fontcolor','#666'));
define('TPO_PORTFOLIO_PARA_FONTCOLOR', tpo_options($shortname . '_portfolio_para_fontcolor','#666'));
define('TPO_PORTFOLIO_READMORE_FONTCOLOR', tpo_options($shortname . '_portfolio_readmore_fontcolor','#666'));

define('TPO_PORTFOLIO_IMAGE_BORDERCOLOR', tpo_options($shortname . '_portfolio_image_bordercolor','#EBEBEB'));
define('TPO_PORTFOLIO_IMAGE_MARGIN', tpo_options($shortname . '_portfolio_image_margin'));
define('TPO_PORTFOLIO_IMAGE_BORDEROUTERCOLOR', tpo_options($shortname . '_portfolio_image_borderoutercolor','#CCC'));

define('TPO_BLOG_IMAGE_BORDERCOLOR', tpo_options($shortname . '_blog_image_bordercolor','#EBEBEB'));
define('TPO_BLOG_IMAGE_MARGIN', tpo_options($shortname . '_blog_image_margin'));
define('TPO_BLOG_IMAGE_BORDEROUTERCOLOR', tpo_options($shortname . '_blog_image_borderoutercolor','#CCC'));

define('TPO_YOUTUBE_WIDTH', tpo_options($shortname . '_youtube_width','630'));
define('TPO_YOUTUBE_HEIGHT', tpo_options($shortname . '_youtube_height','350'));
define('TPO_VIMEO_WIDTH', tpo_options($shortname . '_vimeo_width','630'));
define('TPO_VIMEO_HEIGHT', tpo_options($shortname . '_vimeo_height','350'));
define('TPO_FLASH_WIDTH', tpo_options($shortname . '_flash_width','630'));
define('TPO_FLASH_HEIGHT', tpo_options($shortname . '_flash_height','350'));
define('TPO_HTML5_WIDTH', tpo_options($shortname . '_html5_width','630'));
define('TPO_HTML5_HEIGHT', tpo_options($shortname . '_html5_height','350'));

define('TPO_BODY_FONTSIZE', tpo_options($shortname . '_bodyfontsize','12'));
define('TPO_H1_FONTSIZE', tpo_options($shortname . '_fontsizeh1','36'));
define('TPO_H2_FONTSIZE', tpo_options($shortname . '_fontsizeh2','30'));
define('TPO_H3_FONTSIZE', tpo_options($shortname . '_fontsizeh3','24'));
define('TPO_H4_FONTSIZE', tpo_options($shortname . '_fontsizeh4','20'));
define('TPO_H5_FONTSIZE', tpo_options($shortname . '_fontsizeh5','16'));
define('TPO_H6_FONTSIZE', tpo_options($shortname . '_fontsizeh6','12'));

define('TPO_H1_FONTCOLOR', tpo_options($shortname . '_fontcolorh1','#999'));
define('TPO_H2_FONTCOLOR', tpo_options($shortname . '_fontcolorh2','#999'));
define('TPO_H3_FONTCOLOR', tpo_options($shortname . '_fontcolorh3','#999'));
define('TPO_H4_FONTCOLOR', tpo_options($shortname . '_fontcolorh4','#999'));
define('TPO_H5_FONTCOLOR', tpo_options($shortname . '_fontcolorh5','#999'));
define('TPO_H6_FONTCOLOR', tpo_options($shortname . '_fontcolorh6','#999'));

define('TPO_CUSTOM_MENU', tpo_options($shortname . '_custom_menu'));
define('TPO_TOP_CUSTOM_NAV', tpo_options($shortname . '_top_custom_nav'));
define('TPO_NAV_PAGES', tpo_options($shortname . '_nav_pages'));

define('TPO_PARAGRAPHCOLOR', tpo_options($shortname . '_paragraphcolor','#999'));
define('TPO_LINKCOLOR', tpo_options($shortname . '_linkcolor','#999'));
define('TPO_SIDEBARICONCOLOR', tpo_options($shortname . '_sidebariconcolor','black'));
define('TPO_SIDEBARFORECOLOR', tpo_options($shortname . '_sidebarforecolor','#999'));
define('TPO_SIDEBARTITLECOLOR', tpo_options($shortname . '_sidebartitlecolor','#999'));
define('TPO_SIDEBARLINKCOLOR', tpo_options($shortname . '_sidebarlinkcolor','#999'));
define('TPO_SIDEBARLINKHOVERCOLOR', tpo_options($shortname . '_sidebarlinkhoverolor','#999'));
define('TPO_SIDEBARLINKMOUSEOVER', tpo_options($shortname . '_sidebarlinkmouseover'));
define('TPO_SIDEBARUNDERLINECOLOR', tpo_options($shortname . '_sidebarunderlinecolor'),'#999');

define('TPO_FOOTERICONCOLOR', tpo_options($shortname . '_footericoncolor','black'));
define('TPO_FOOTERBACKGROUNDCOLOR', tpo_options($shortname . '_footerbackgroundcolor','#f1f1f1'));
define('TPO_FOOTERFORECOLOR', tpo_options($shortname . '_footerforecolor','#fff'));
define('TPO_FOOTERTITLECOLOR', tpo_options($shortname . '_footertitlecolor','#fff'));
define('TPO_FOOTERLINKCOLOR', tpo_options($shortname . '_footerlinkcolor','#999'));
define('TPO_FOOTERLINKHOVEROVER', tpo_options($shortname . '_footerlinkhovercolor','#999'));
define('TPO_FOOTERLINKHOVERCOLOR', tpo_options($shortname . '_footerlinkhovercolor'),'#ad0017');
define('TPO_FOOTERUNDERLINECOLOR', tpo_options($shortname . '_footerunderlinecolor'),'#999');
define('TPO_FOOTERTITLE_FONTSIZE', tpo_options($shortname . '_footerfont_titlesize','20'));
define('TPO_FOOTER_FONTSIZE', tpo_options($shortname . '_footerfont_size','11'));
define('TPO_FOOTER_CUSTOM_MENU', tpo_options($shortname . '_footer_custom_menu'));
define('TPO_FOOTER_CUSTOM_NAV', tpo_options($shortname . '_footer_custom_nav'));
define('TPO_FOOTER_NAV_PAGE', tpo_options($shortname . '_footer_nav_page'));



define('TPO_FOOTERBOTTOM_HEIGHT', tpo_options($shortname . '_footerbottom_height','50'));
define('TPO_FOOTERBOTTOM_FONTSIZE', tpo_options($shortname . '_footerbottom_fontsize','12'));
define('TPO_FOOTERBOTTOM_BACKGROUNDCOLOR', tpo_options($shortname . '_footerbottom_backgroundcolor','#000'));
define('TPO_FOOTERBOTTOM_FORECOLOR', tpo_options($shortname . '_footerbottom_forecolor','#fff'));
define('TPO_FOOTERBOTTOM_LINKCOLOR', tpo_options($shortname . '_footerbottom_linkcolor','#fff'));
define('TPO_FOOTERBOTTOM_LINKHOVERCOLOR', tpo_options($shortname . '_footerbottom_linkhovercolor'),'#ad0017');


define('TPO_FOOTERTEXT', tpo_options($shortname . '_footer_text'));
define('TPO_DISABLE_FOOTER_WIDGETS', tpo_options($shortname . '_footer_widget'));



define('TPO_PAGI_BACKCOLOR', tpo_options($shortname . '_pageination_backcolor','#fff'));
define('TPO_PAGI_BORDERCOLOR', tpo_options($shortname . '_pageination_bordercolor','#999'));
define('TPO_PAGI_FONTCOLOR', tpo_options($shortname . '_pageination_fontcolor','#000'));
define('TPO_PAGI_CURBACKCOLOR', tpo_options($shortname . '_pageination_curbackcolor','#666'));
define('TPO_PAGI_CURFONTCOLOR', tpo_options($shortname . '_pageination_curfontcolor','#fff'));

define('TPO_HOMEPAGELAYOUT', tpo_options($shortname . '_homepage_layout'));
define('TPO_HOMEPAGE_CONTENTS', tpo_options($shortname . '_homepage_contents',''));
define('TPO_GA_CODE', tpo_options($shortname . '_ga_code',''));
define('TPO_FAVICON', tpo_options($shortname . '_favicon',''));

define('TPO_SOCIALICONS_ONTOP', tpo_options($shortname . '_socialicons_ontop'));
define('TPO_FACEBOOK_URL', tpo_options($shortname . '_facebook_url'));
define('TPO_TWITTER_URL', tpo_options($shortname . '_twitter_url'));
define('TPO_LINKEDIN_URL', tpo_options($shortname . '_linkedin_url'));
define('TPO_GOOGLEPLUS_URL', tpo_options($shortname . '_googleplus_url'));
define('TPO_YOUTUBE_URL', tpo_options($shortname . '_youtube_url'));
define('TPO_RSS_URL', tpo_options($shortname . '_rss_url'));

define('TPO_PHONE', tpo_options($shortname . '_phone'));


?>
