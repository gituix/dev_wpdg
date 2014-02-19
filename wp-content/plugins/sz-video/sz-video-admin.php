<?php
/* ************************************************************************** */
/* Controllo se definita la costante del plugin                               */
/* ************************************************************************** */
if (!defined('SZ_PLUGIN_VIDEO') or !SZ_PLUGIN_VIDEO) die();

/* ************************************************************************** */
/* Aggiungo funzionalita ajax                               */
/* ************************************************************************** */
function sz_ajax_generic() {
	@require(dirname(__FILE__).'/mce/sz-video-mce-generic.php'); die();
}
function sz_ajax_daily() {
	@require(dirname(__FILE__).'/mce/sz-video-mce-daily.php'); die();
}
function sz_ajax_player() {
	@require(dirname(__FILE__).'/mce/sz-video-mce-player.php'); die();
}
function sz_ajax_youtube() {
	@require(dirname(__FILE__).'/mce/sz-video-mce-youtube.php'); die();
}
function sz_ajax_vimeo() {
	@require(dirname(__FILE__).'/mce/sz-video-mce-vimeo.php'); die();
}

add_action('wp_ajax_sz_generic','sz_ajax_generic');
add_action('wp_ajax_sz_daily'  ,'sz_ajax_daily');
add_action('wp_ajax_sz_player' ,'sz_ajax_player');
add_action('wp_ajax_sz_youtube','sz_ajax_youtube');
add_action('wp_ajax_sz_vimeo'  ,'sz_ajax_vimeo');

/* ************************************************************************** */
/* Creazione e aggiunta menu di amministrazione                               */
/* ************************************************************************** */
function sz_video_admin_menu() 
{
	if (function_exists('add_submenu_page')) {
		add_menu_page('SZ - Video','SZ - Video','manage_options',basename(__FILE__),'sz_video_admin_callback_generale',SZ_PLUGIN_PATH_IMAGE.'video-icon-16.png');
		add_submenu_page(basename(__FILE__),'SZ-Video',__('Configuration','szvideoadmin'),'manage_options',basename(__FILE__),'sz_video_admin_base_callback'); 
		add_submenu_page(basename(__FILE__),'SZ-Video - Youtube','Youtube','manage_options','sz-video-admin-youtube.php','sz_video_admin_youtube_callback'); 
		add_submenu_page(basename(__FILE__),'SZ-Video - Vimeo','Vimeo','manage_options','sz-video-admin-vimeo.php','sz_video_admin_vimeo_callback'); 
		add_submenu_page(basename(__FILE__),'SZ-Video - DailyMotion','DailyMotion','manage_options','sz-video-admin-daily.php','sz_video_admin_daily_callback'); 
		add_submenu_page(basename(__FILE__),'SZ-Video - Player',__('Player HTML5','szvideoadmin'),'manage_options','sz-video-admin-player.php','sz_video_admin_player_callback'); 
	}
}
/* ************************************************************************** */
/* Registrazione delle opzioni legate al Plugin                               */
/* ************************************************************************** */
function sz_video_admin_fields()
{
	register_setting('sz_video_options_base','sz_video_options_base','sz_video_admin_base_validate');
	register_setting('sz_video_options_youtube','sz_video_options_youtube','sz_video_admin_youtube_validate');
	register_setting('sz_video_options_vimeo','sz_video_options_vimeo','sz_video_admin_vimeo_validate');
	register_setting('sz_video_options_daily','sz_video_options_daily','sz_video_admin_daily_validate');
	register_setting('sz_video_options_player','sz_video_options_player','sz_video_admin_player_validate');

	add_settings_section('sz_video_base_section',__('Activation shortcode','szvideoadmin'),'sz_video_admin_base_section',basename(__FILE__));
	add_settings_field('youtube',__('Activation','szvideoadmin').' [SZ-Youtube]','sz_video_admin_base_youtube',basename(__FILE__),'sz_video_base_section');
	add_settings_field('vimeo',__('Activation','szvideoadmin').' [SZ-Vimeo]','sz_video_admin_base_vimeo',basename(__FILE__),'sz_video_base_section');
	add_settings_field('daily',__('Activation','szvideoadmin').' [SZ-DailyMotion]','sz_video_admin_base_daily',basename(__FILE__),'sz_video_base_section');
	add_settings_field('player',__('Activation','szvideoadmin').' [SZ-Player]','sz_video_admin_base_player',basename(__FILE__),'sz_video_base_section');

	add_settings_section('sz_video_base_setup',__('General configuration','szvideoadmin'),'sz_video_admin_base_section',basename(__FILE__));
	add_settings_field('warning',__('Warning deactivation','szvideoadmin'),'sz_video_admin_base_warning',basename(__FILE__),'sz_video_base_setup');
	add_settings_field('protocol',__('HTTP/HTTPS conversion','szvideoadmin'),'sz_video_admin_base_protocol',basename(__FILE__),'sz_video_base_setup');
	add_settings_field('schemaorg',__('Tags Schema.org','szvideoadmin'),'sz_video_admin_base_schemaorg',basename(__FILE__),'sz_video_base_setup');

	add_settings_section('sz_video_base_editor',__('Activation editor icons','szvideoadmin'),'sz_video_admin_base_section',basename(__FILE__));
	add_settings_field('ed_youtube',__('Add icon','szvideoadmin').' [SZ-Youtube]','sz_video_admin_base_ed_youtube',basename(__FILE__),'sz_video_base_editor');
	add_settings_field('ed_vimeo',__('Add icon','szvideoadmin').' [SZ-Vimeo]','sz_video_admin_base_ed_vimeo',basename(__FILE__),'sz_video_base_editor');
	add_settings_field('ed_daily',__('Add icon','szvideoadmin').' [SZ-DailyMotion]','sz_video_admin_base_ed_daily',basename(__FILE__),'sz_video_base_editor');
	add_settings_field('ed_player',__('Add icon','szvideoadmin').' [SZ-Player]','sz_video_admin_base_ed_player',basename(__FILE__),'sz_video_base_editor');
	add_settings_field('ed_video',__('Add icon','szvideoadmin').' [SZ-Video]','sz_video_admin_base_ed_video',basename(__FILE__),'sz_video_base_editor');

	// Definizione sezione per configurazione YOUTUBE
	add_settings_section('sz_video_youtube_method',__('Default method of the embed','szvideoadmin'),'sz_video_admin_youtube_section','sz-video-admin-youtube.php');
	add_settings_field('youtube_method',__('Loading embed','szvideoadmin'),'sz_video_admin_youtube_method','sz-video-admin-youtube.php','sz_video_youtube_method');

	add_settings_section('sz_video_youtube_section',__('Default size of the video','szvideoadmin'),'sz_video_admin_youtube_section','sz-video-admin-youtube.php');
	add_settings_field('youtube_responsive',__('Responsive Design','szvideoadmin'),'sz_video_admin_youtube_responsive','sz-video-admin-youtube.php','sz_video_youtube_section');
	add_settings_field('youtube_width',__('Video width','szvideoadmin'),'sz_video_admin_youtube_width','sz-video-admin-youtube.php','sz_video_youtube_section');
	add_settings_field('youtube_height',__('Video height','szvideoadmin'),'sz_video_admin_youtube_height','sz-video-admin-youtube.php','sz_video_youtube_section');

	add_settings_section('sz_video_youtube_margin',__('Default margins of the video','szvideoadmin'),'sz_video_admin_youtube_section','sz-video-admin-youtube.php');
	add_settings_field('youtube_margin_top',__('Top margin','szvideoadmin'),'sz_video_admin_youtube_margin_top','sz-video-admin-youtube.php','sz_video_youtube_margin');
	add_settings_field('youtube_margin_right',__('Right margin','szvideoadmin'),'sz_video_admin_youtube_margin_right','sz-video-admin-youtube.php','sz_video_youtube_margin');
	add_settings_field('youtube_margin_bottom',__('Bottom margin','szvideoadmin'),'sz_video_admin_youtube_margin_bottom','sz-video-admin-youtube.php','sz_video_youtube_margin');
	add_settings_field('youtube_margin_left',__('Left margin','szvideoadmin'),'sz_video_admin_youtube_margin_left','sz-video-admin-youtube.php','sz_video_youtube_margin');
	add_settings_field('youtube_margin_units',__('Units','szvideoadmin'),'sz_video_admin_youtube_margin_units','sz-video-admin-youtube.php','sz_video_youtube_margin');

	// Definizione sezione per configurazione VIMEO
	add_settings_section('sz_video_vimeo_method',__('Default method of the embed','szvideoadmin'),'sz_video_admin_vimeo_section','sz-video-admin-vimeo.php');
	add_settings_field('vimeo_method',__('Loading embed','szvideoadmin'),'sz_video_admin_vimeo_method','sz-video-admin-vimeo.php','sz_video_vimeo_method');

	add_settings_section('sz_video_vimeo_section',__('Default size of the video','szvideoadmin'),'sz_video_admin_vimeo_section','sz-video-admin-vimeo.php');
	add_settings_field('vimeo_responsive',__('Responsive Design','szvideoadmin'),'sz_video_admin_vimeo_responsive','sz-video-admin-vimeo.php','sz_video_vimeo_section');
	add_settings_field('vimeo_width',__('Video width','szvideoadmin'),'sz_video_admin_vimeo_width','sz-video-admin-vimeo.php','sz_video_vimeo_section');
	add_settings_field('vimeo_height',__('Video height','szvideoadmin'),'sz_video_admin_vimeo_height','sz-video-admin-vimeo.php','sz_video_vimeo_section');

	add_settings_section('sz_video_vimeo_margin',__('Default margins of the video','szvideoadmin'),'sz_video_admin_vimeo_section','sz-video-admin-vimeo.php');
	add_settings_field('vimeo_margin_top',__('Top margin','szvideoadmin'),'sz_video_admin_vimeo_margin_top','sz-video-admin-vimeo.php','sz_video_vimeo_margin');
	add_settings_field('vimeo_margin_right',__('Right margin','szvideoadmin'),'sz_video_admin_vimeo_margin_right','sz-video-admin-vimeo.php','sz_video_vimeo_margin');
	add_settings_field('vimeo_margin_bottom',__('Bottom margin','szvideoadmin'),'sz_video_admin_vimeo_margin_bottom','sz-video-admin-vimeo.php','sz_video_vimeo_margin');
	add_settings_field('vimeo_margin_left',__('Left margin','szvideoadmin'),'sz_video_admin_vimeo_margin_left','sz-video-admin-vimeo.php','sz_video_vimeo_margin');
	add_settings_field('vimeo_margin_units',__('Units','szvideoadmin'),'sz_video_admin_vimeo_margin_units','sz-video-admin-vimeo.php','sz_video_vimeo_margin');

	// Definizione sezione per configurazione DAILYMOTION
	add_settings_section('sz_video_daily_method',__('Default method of the embed','szvideoadmin'),'sz_video_admin_daily_section','sz-video-admin-daily.php');
	add_settings_field('daily_method',__('Loading embed','szvideoadmin'),'sz_video_admin_daily_method','sz-video-admin-daily.php','sz_video_daily_method');

	add_settings_section('sz_video_daily_section',__('Default size of the video','szvideoadmin'),'sz_video_admin_daily_section','sz-video-admin-daily.php');
	add_settings_field('daily_responsive',__('Responsive Design','szvideoadmin'),'sz_video_admin_daily_responsive','sz-video-admin-daily.php','sz_video_daily_section');
	add_settings_field('daily_width',__('Video width','szvideoadmin'),'sz_video_admin_daily_width','sz-video-admin-daily.php','sz_video_daily_section');
	add_settings_field('daily_height',__('Video height','szvideoadmin'),'sz_video_admin_daily_height','sz-video-admin-daily.php','sz_video_daily_section');

	add_settings_section('sz_video_daily_margin',__('Default margins of the video','szvideoadmin'),'sz_video_admin_daily_section','sz-video-admin-daily.php');
	add_settings_field('daily_margin_top',__('Top margin','szvideoadmin'),'sz_video_admin_daily_margin_top','sz-video-admin-daily.php','sz_video_daily_margin');
	add_settings_field('daily_margin_right',__('Right margin','szvideoadmin'),'sz_video_admin_daily_margin_right','sz-video-admin-daily.php','sz_video_daily_margin');
	add_settings_field('daily_margin_bottom',__('Bottom margin','szvideoadmin'),'sz_video_admin_daily_margin_bottom','sz-video-admin-daily.php','sz_video_daily_margin');
	add_settings_field('daily_margin_left',__('Left margin','szvideoadmin'),'sz_video_admin_daily_margin_left','sz-video-admin-daily.php','sz_video_daily_margin');
	add_settings_field('daily_margin_units',__('Units','szvideoadmin'),'sz_video_admin_daily_margin_units','sz-video-admin-daily.php','sz_video_daily_margin');

	// Definizione sezione per configurazione PLAYER
	add_settings_section('sz_video_player_design',__('Default design of the video','szvideoadmin'),'sz_video_admin_player_section','sz-video-admin-player.php');
	add_settings_field('player_design',__('Player type','szvideoadmin'),'sz_video_admin_player_design','sz-video-admin-player.php','sz_video_player_design');

	add_settings_section('sz_video_player_codec',__('Select video to add the tag [video]','szvideoadmin'),'sz_video_admin_player_section','sz-video-admin-player.php');
	add_settings_field('player_t_webm',__('Video WEBM','szvideoadmin'),'sz_video_admin_player_t_webm','sz-video-admin-player.php','sz_video_player_codec');
	add_settings_field('player_t_mp4' ,__('Video MP4' ,'szvideoadmin'),'sz_video_admin_player_t_mp4' ,'sz-video-admin-player.php','sz_video_player_codec');
	add_settings_field('player_t_ogv' ,__('Video OGV' ,'szvideoadmin'),'sz_video_admin_player_t_ogv' ,'sz-video-admin-player.php','sz_video_player_codec');

	add_settings_section('sz_video_player_section',__('Default size of the video','szvideoadmin'),'sz_video_admin_player_section','sz-video-admin-player.php');
	add_settings_field('player_responsive',__('Responsive Design','szvideoadmin'),'sz_video_admin_player_responsive','sz-video-admin-player.php','sz_video_player_section');
	add_settings_field('player_width',__('Video width','szvideoadmin'),'sz_video_admin_player_width','sz-video-admin-player.php','sz_video_player_section');
	add_settings_field('player_height',__('Video height','szvideoadmin'),'sz_video_admin_player_height','sz-video-admin-player.php','sz_video_player_section');

	add_settings_section('sz_video_player_margin',__('Default margins of the video','szvideoadmin'),'sz_video_admin_player_section','sz-video-admin-player.php');
	add_settings_field('player_margin_top',__('Top margin','szvideoadmin'),'sz_video_admin_player_margin_top','sz-video-admin-player.php','sz_video_player_margin');
	add_settings_field('player_margin_right',__('Right margin','szvideoadmin'),'sz_video_admin_player_margin_right','sz-video-admin-player.php','sz_video_player_margin');
	add_settings_field('player_margin_bottom',__('Bottom margin','szvideoadmin'),'sz_video_admin_player_margin_bottom','sz-video-admin-player.php','sz_video_player_margin');
	add_settings_field('player_margin_left',__('Left margin','szvideoadmin'),'sz_video_admin_player_margin_left','sz-video-admin-player.php','sz_video_player_margin');
	add_settings_field('player_margin_units',__('Units','szvideoadmin'),'sz_video_admin_player_margin_units','sz-video-admin-player.php','sz_video_player_margin');

	add_settings_section('sz_video_player_ga',__('Enable google analytics for video','szvideoadmin'),'sz_video_admin_player_section','sz-video-admin-player.php');
	add_settings_field('player_ga',__('Analytics enabled','szvideoadmin'),'sz_video_admin_player_ga','sz-video-admin-player.php','sz_video_player_ga');
	add_settings_field('player_ga_UID',__('Analytics UID','szvideoadmin'),'sz_video_admin_player_ga_UID','sz-video-admin-player.php','sz_video_player_ga');
}
/* ************************************************************************** */
/* Aggiungo le funzioni per l'esecuzione in admin                             */
/* ************************************************************************** */
add_action('admin_menu','sz_video_admin_menu');
add_action('admin_init','sz_video_admin_fields');

/* ************************************************************************** */
/* Funzioni per SEZIONE Configurazione Generale BASE                          */
/* ************************************************************************** */
function sz_video_admin_base_callback() {
	sz_video_common_form(
		__('Configuration','szvideoadmin'),
		'sz_video_options_base',
		basename(__FILE__)
	); 
}
function sz_video_admin_base_youtube() {
	sz_video_common_form_checkbox(
		'sz_video_options_base','youtube'
	);
}
function sz_video_admin_base_vimeo() {
	sz_video_common_form_checkbox(
		'sz_video_options_base','vimeo'
	);
}
function sz_video_admin_base_daily() {
	sz_video_common_form_checkbox(
		'sz_video_options_base','daily'
	);
}
function sz_video_admin_base_player() {
	sz_video_common_form_checkbox(
		'sz_video_options_base','player'
	);
}
function sz_video_admin_base_warning() {
	sz_video_common_form_checkbox(
		'sz_video_options_base','warning'
	);
}
function sz_video_admin_base_protocol() {
	sz_video_common_form_checkbox(
		'sz_video_options_base','protocol'
	);
}
function sz_video_admin_base_schemaorg() {
	sz_video_common_form_checkbox(
		'sz_video_options_base','schemaorg'
	);
}
function sz_video_admin_base_ed_youtube() {
	sz_video_common_form_checkbox(
		'sz_video_options_base','ed_youtube'
	);
}
function sz_video_admin_base_ed_vimeo() {
	sz_video_common_form_checkbox(
		'sz_video_options_base','ed_vimeo'
	);
}
function sz_video_admin_base_ed_daily() {
	sz_video_common_form_checkbox(
		'sz_video_options_base','ed_daily'
	);
}
function sz_video_admin_base_ed_player() {
	sz_video_common_form_checkbox(
		'sz_video_options_base','ed_player'
	);
}
function sz_video_admin_base_ed_video() {
	sz_video_common_form_checkbox(
		'sz_video_options_base','ed_video'
	);
}
function sz_video_admin_base_validate($plugin_options) {
  return $plugin_options;
}
function sz_video_admin_base_section() {}
function sz_video_admin_callback_generale() {}

/* ************************************************************************** */
/* Funzioni per SEZIONE Configurazione Youtube                                */
/* ************************************************************************** */
function sz_video_admin_youtube_callback() {
	sz_video_common_form(
		__('Youtube configuration','szvideoadmin'),
		'sz_video_options_youtube',
		'sz-video-admin-youtube.php'
	); 
}
function sz_video_admin_youtube_method() {
	$items = array(
		'Y' => __('Yes','szvideoadmin'),
		'N' => __('No' ,'szvideoadmin')
	);
	sz_video_common_form_select(
		'sz_video_options_youtube',$items,'youtube_method'
	);
}
function sz_video_admin_youtube_responsive() {
	$items = array(
		'Y' => __('Yes','szvideoadmin'),
		'N' => __('No' ,'szvideoadmin')
	);
	sz_video_common_form_select(
		'sz_video_options_youtube',$items,'youtube_responsive'
	);
}
function sz_video_admin_youtube_width() {
	sz_video_common_form_number_step_1(
		'sz_video_options_youtube','youtube_width',SZ_PLUGIN_VIDEO_WIDTH
	);
}
function sz_video_admin_youtube_height() {
	sz_video_common_form_number_step_1(
		'sz_video_options_youtube','youtube_height',SZ_PLUGIN_VIDEO_HEIGHT
	); 
}
function sz_video_admin_youtube_margin_top() {
	sz_video_common_form_number_step_1(
		'sz_video_options_youtube','youtube_margin_top','0'
	); 
}
function sz_video_admin_youtube_margin_right() {
	sz_video_common_form_number_step_1(
		'sz_video_options_youtube','youtube_margin_right','auto'
	); 
}
function sz_video_admin_youtube_margin_bottom() {
	sz_video_common_form_number_step_1(
		'sz_video_options_youtube','youtube_margin_bottom','0'
	); 
}
function sz_video_admin_youtube_margin_left() {
	sz_video_common_form_number_step_1(
		'sz_video_options_youtube','youtube_margin_left','auto'
	); 
}
function sz_video_admin_youtube_margin_units() {
	$items = array('px'=>'px','em'=>'em');
	sz_video_common_form_select(
		'sz_video_options_youtube',$items,'youtube_margin_units'
	);
}
function sz_video_admin_youtube_validate($plugin_options) {
  return $plugin_options;
}

function sz_video_admin_youtube_section() {}

/* ************************************************************************** */
/* Funzioni per SEZIONE Configurazione VIMEO                                  */
/* ************************************************************************** */
function sz_video_admin_vimeo_callback() 
{
	sz_video_common_form(
		__('Vimeo configuration','szvideoadmin'),
		'sz_video_options_vimeo',
		'sz-video-admin-vimeo.php'
	); 
}
function sz_video_admin_vimeo_method() {
	$items = array(
		'Y' => __('Yes','szvideoadmin'),
		'N' => __('No' ,'szvideoadmin')
	);
	sz_video_common_form_select(
		'sz_video_options_vimeo',$items,'vimeo_method'
	);
}
function sz_video_admin_vimeo_responsive() {
	$items = array(
		'Y' => __('Yes','szvideoadmin'),
		'N' => __('No' ,'szvideoadmin')
	);
	sz_video_common_form_select(
		'sz_video_options_vimeo',$items,'vimeo_responsive'
	);
}
function sz_video_admin_vimeo_width() {
	sz_video_common_form_number_step_1(
		'sz_video_options_vimeo','vimeo_width',SZ_PLUGIN_VIDEO_WIDTH
	); 
}
function sz_video_admin_vimeo_height() {
	sz_video_common_form_number_step_1(
		'sz_video_options_vimeo','vimeo_height',SZ_PLUGIN_VIDEO_HEIGHT
	); 
}
function sz_video_admin_vimeo_margin_top() {
	sz_video_common_form_number_step_1(
		'sz_video_options_vimeo','vimeo_margin_top','0'
	); 
}
function sz_video_admin_vimeo_margin_right() {
	sz_video_common_form_number_step_1(
		'sz_video_options_vimeo','vimeo_margin_right','auto'
	); 
}
function sz_video_admin_vimeo_margin_bottom() {
	sz_video_common_form_number_step_1(
		'sz_video_options_vimeo','vimeo_margin_bottom','0'
	); 
}
function sz_video_admin_vimeo_margin_left() {
	sz_video_common_form_number_step_1(
		'sz_video_options_vimeo','vimeo_margin_left','auto'
	); 
}
function sz_video_admin_vimeo_margin_units() {
	$items = array('px'=>'px','em'=>'em');
	sz_video_common_form_select(
		'sz_video_options_vimeo',$items,'vimeo_margin_units'
	);
}
function sz_video_admin_vimeo_validate($plugin_options) {
  return $plugin_options;
}

function sz_video_admin_vimeo_section() {}

/* ************************************************************************** */
/* Funzioni per SEZIONE Configurazione DAILYMOTION                            */
/* ************************************************************************** */
function sz_video_admin_daily_callback() 
{
	sz_video_common_form(
		__('DailyMotion configuration','szvideoadmin'),
		'sz_video_options_daily',
		'sz-video-admin-daily.php'
	); 
}
function sz_video_admin_daily_method() {
	$items = array(
		'Y' => __('Yes','szvideoadmin'),
		'N' => __('No' ,'szvideoadmin')
	);
	sz_video_common_form_select(
		'sz_video_options_daily',$items,'daily_method'
	);
}
function sz_video_admin_daily_responsive() {
	$items = array(
		'Y' => __('Yes','szvideoadmin'),
		'N' => __('No' ,'szvideoadmin')
	);
	sz_video_common_form_select(
		'sz_video_options_daily',$items,'daily_responsive'
	);
}
function sz_video_admin_daily_width() {
	sz_video_common_form_number_step_1(
		'sz_video_options_daily','daily_width',SZ_PLUGIN_VIDEO_WIDTH
	); 
}
function sz_video_admin_daily_height() {
	sz_video_common_form_number_step_1(
		'sz_video_options_daily','daily_height',SZ_PLUGIN_VIDEO_HEIGHT
	); 
}
function sz_video_admin_daily_margin_top() {
	sz_video_common_form_number_step_1(
		'sz_video_options_daily','daily_margin_top','0'
	); 
}
function sz_video_admin_daily_margin_right() {
	sz_video_common_form_number_step_1(
		'sz_video_options_daily','daily_margin_right','auto'
	); 
}
function sz_video_admin_daily_margin_bottom() {
	sz_video_common_form_number_step_1(
		'sz_video_options_daily','daily_margin_bottom','0'
	); 
}
function sz_video_admin_daily_margin_left() {
	sz_video_common_form_number_step_1(
		'sz_video_options_daily','daily_margin_left','auto'
	); 
}
function sz_video_admin_daily_margin_units() {
	$items = array('px'=>'px','em'=>'em');
	sz_video_common_form_select(
		'sz_video_options_daily',$items,'daily_margin_units'
	);
}
function sz_video_admin_daily_validate($plugin_options) {
  return $plugin_options;
}

function sz_video_admin_daily_section() {}

/* ************************************************************************** */
/* Funzioni per SEZIONE Configurazione PLAYER                                 */
/* ************************************************************************** */
function sz_video_admin_player_callback() 
{
	sz_video_common_form(
		__('Player HTML5 configuration','szvideoadmin'),
		'sz_video_options_player',
		'sz-video-admin-player.php'
	); 
}
function sz_video_admin_player_design() {
	$items = array(
		'1' => __('minimalist','szvideoadmin'),
		'2' => __('functional','szvideoadmin'),
		'3' => __('full','szvideoadmin')
	);
	sz_video_common_form_select(
		'sz_video_options_player',$items,'player_design'
	);
}
function sz_video_admin_player_t_webm() {
	sz_video_common_form_checkbox(
		'sz_video_options_player','player_t_webm'
	);
}
function sz_video_admin_player_t_mp4() {
	sz_video_common_form_checkbox(
		'sz_video_options_player','player_t_mp4'
	);
}
function sz_video_admin_player_t_ogv() {
	sz_video_common_form_checkbox(
		'sz_video_options_player','player_t_ogv'
	);
}
function sz_video_admin_player_responsive() {
	$items = array(
		'Y' => __('Yes','szvideoadmin'),
		'N' => __('No' ,'szvideoadmin')
	);
	sz_video_common_form_select(
		'sz_video_options_player',$items,'player_responsive'
	);
}
function sz_video_admin_player_width() {
	sz_video_common_form_number_step_1(
		'sz_video_options_player','player_width',SZ_PLUGIN_VIDEO_WIDTH
	); 
}
function sz_video_admin_player_height() {
	sz_video_common_form_number_step_1(
		'sz_video_options_player','player_height',SZ_PLUGIN_VIDEO_HEIGHT
	); 
}
function sz_video_admin_player_margin_top() {
	sz_video_common_form_number_step_1(
		'sz_video_options_player','player_margin_top','0'
	); 
}
function sz_video_admin_player_margin_right() {
	sz_video_common_form_number_step_1(
		'sz_video_options_player','player_margin_right','auto'
	); 
}
function sz_video_admin_player_margin_bottom() {
	sz_video_common_form_number_step_1(
		'sz_video_options_player','player_margin_bottom','0'
	); 
}
function sz_video_admin_player_margin_left() {
	sz_video_common_form_number_step_1(
		'sz_video_options_player','player_margin_left','auto'
	); 
}
function sz_video_admin_player_margin_units() {
	$items = array('px'=>'px','em'=>'em');
	sz_video_common_form_select(
		'sz_video_options_player',$items,'player_margin_units'
	);
}
function sz_video_admin_player_ga() {
	sz_video_common_form_checkbox(
		'sz_video_options_player','player_ga'
	);
}
function sz_video_admin_player_ga_UID() {
	sz_video_common_form_text_medium(
		'sz_video_options_player','player_ga_UID','UA-XXXXXX-XX'
	);
}
function sz_video_admin_player_validate($plugin_options) {
  return $plugin_options;
}

function sz_video_admin_player_section() {}

/* ************************************************************************** */
/* Funzioni per disegno parte del form (esecuzione generale)                  */
/* ************************************************************************** */
function sz_video_common_form($title,$setting,$section) 
{
	echo '<div class="wrap">';
	echo '<div id="icon-options-general" class="icon32"><br></div>';
	echo '<h2>'.$title.'</h2>';
	echo '<p>'.__('Overriding the default settings with your own specific preferences','szvideoadmin').'</p>';
	echo '<form method="post" action="options.php" enctype="multipart/form-data">';

	settings_fields($setting);
	do_settings_sections($section);

	echo '<p class="submit"><input name="Submit" type="submit" ';
	echo 'class="button-primary" value="'.__('Save Changes','szvideoadmin').'"/></p>';
	echo '</form>';
	echo '</div>';
}

/* ************************************************************************** */
/* Funzioni per disegno parte del form (campi alfanumerici)                   */
/* ************************************************************************** */
function sz_video_common_form_text_medium($optionset,$name,$placeholder) 
{	
	$options = get_option($optionset);

	if (!isset($options[$name])) $options[$name]=""; 

	echo '<input name="'.$optionset.'['.$name.']" type="text" class="medium-text" ';
	echo 'value="'.$options[$name].'" placeholder="'.$placeholder.'"/>';
}

/* ************************************************************************** */
/* Funzioni per disegno parte del form (campi numerici con step 1)            */
/* ************************************************************************** */
function sz_video_common_form_number_step_1($optionset,$name,$placeholder) 
{
	$options = get_option($optionset);

	if (!isset($options[$name])) $options[$name]=""; 

	echo '<input name="'.$optionset.'['.$name.']" type="number" step="1" class="small-text" ';
	echo 'value="'.$options[$name].'" placeholder="'.$placeholder.'"/>';
}

/* ************************************************************************** */
/* Funzioni per disegno parte del form (campi con la selezione)               */
/* ************************************************************************** */
function sz_video_common_form_select($optionset,$items,$name)
{
	$options = get_option($optionset);

	if (!is_array($items)) $items = array();

	echo '<select name="'.$optionset.'['.$name.']">';

	foreach ($items as $key=>$item) {
		$selected = ($options[$name] == $key) ? 'selected = "selected"' : '';
		echo '<option value="'.$key.'" '.$selected.'>'.$item.'</option>';
	}

	echo '</select>';
}

/* ************************************************************************** */
/* Funzioni per disegno parte del form (campi con checkbox S/N)               */
/* ************************************************************************** */
function sz_video_common_form_checkbox($optionset,$name) 
{
	$options = get_option($optionset);

	if (!isset($options[$name])) { 
		$options[$name] = '0';
	} 

	echo '<input name="'.$optionset.'['.$name.']" type="checkbox" value="1" ';
	echo 'class="code" '.checked(1,$options[$name],false).'/>';
}
