<?php
/* ************************************************************************** */
/* Controllo se definita la costante del plugin                               */
/* ************************************************************************** */
if (!defined('SZ_PLUGIN_VIDEO') or !SZ_PLUGIN_VIDEO) die();

/* ************************************************************************** */
/* Funzion per la traduzione delle stringhe su finestra pop-up                */
/* ************************************************************************** */
function szvideo_popup_translate() 
{
	return array(
		'URL'       => __('URL','szvideoadmin'),
		'title'     => __('Video','szvideoadmin'),
		'width'     => __('Video width','szvideoadmin'),
		'coverURL'  => __('Cover URL','szvideoadmin'),
		'caption'  	=> __('Caption','szvideoadmin'),
		'height'    => __('Video height','szvideoadmin'),
		'mtop'      => __('Top margin','szvideoadmin'),
		'mright'    => __('Right margin','szvideoadmin'),
		'mbottom'   => __('Bottom margin','szvideoadmin'),
		'mleft'     => __('Left margin','szvideoadmin'),
		'munit'     => __('Units','szvideoadmin'),
		'respons'   => __('Responsive','szvideoadmin'),
		'address'   => __('address of video','szvideoadmin'),
		'size'      => __('Size of the video','szvideoadmin'),
		'margins'   => __('Margins of the video','szvideoadmin'),
		'attribute' => __('Attributes of the video','szvideoadmin'),
		'autoplay'  => __('Autoplay','szvideoadmin'),
		'loop'      => __('Loop','szvideoadmin'),
		'float'     => __('Float','szvideoadmin'),
		'remove'    => __('remove','szvideoadmin'),
		'insert'    => __('insert','szvideoadmin'),
		'default'   => __('default','szvideoadmin'),
		'yes'       => __('yes','szvideoadmin'),
		'no'        => __('no','szvideoadmin'),
		'none'      => __('none','szvideoadmin'),
		'right'     => __('right','szvideoadmin'),
		'left'      => __('left','szvideoadmin'),
		'others'    => __('Other parameters','szvideoadmin'),
		'method'    => __('Method','szvideoadmin'),
		'onlyurl'   => __('Only URL','szvideoadmin'),
		'ratio'     => __('Ratio','szvideoadmin'),
		'userdata'  => __('User Data','szvideoadmin'),
		'schemaorg' => __('Schema.org','szvideoadmin'),
	);
}

/* ************************************************************************** */
/* Creazione della classe per il bottone GENERICO                             */
/* ************************************************************************** */
class SZVideoGeneric
{
	function __construct() {
		add_action('admin_init',array($this,'action_admin_init'));
	}
	function action_admin_init() {
		if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
			add_filter('mce_buttons',array($this,'filter_mce_button'));
			add_filter('mce_external_plugins',array($this,'filter_mce_plugin'));
			add_filter('tiny_mce_version',array(&$this,'refresh_mce_version'));
			add_action('after_wp_tiny_mce',array(&$this,'hidden_popup_HTML'));
		}
	}
	function filter_mce_button($buttons) {
		array_push($buttons,sz_video_mce_get_separator(),'sz_video_generic');
		return $buttons;
	}
	function filter_mce_plugin($plugins) {
		$plugins['szvideogeneric'] = plugin_dir_url(__FILE__).'sz-video-mce-generic.js';
		return $plugins;
	}
	function refresh_mce_version($ver) {
		$ver += 1;
		return $ver;
	}
	function hidden_popup_HTML() {
		$translate = szvideo_popup_translate();
		echo '<div id="sz-video-hidden-generic" style="display:none">';
		echo '<div id="sz-video-hidden-generic-title">';
		echo $translate['title'];
		echo '</div>';
		echo '<div id="sz-video-hidden-generic-parms">';
		echo base64_encode(gzcompress(serialize($translate)));
		echo '</div>';
		echo '</div>'.PHP_EOL;
	}
}

/* ************************************************************************** */
/* Creazione della classe per il bottone Youtube                              */
/* ************************************************************************** */
class SZVideoYoutube
{
	function __construct() {
		add_action('admin_init',array($this,'action_admin_init'));
	}
	function action_admin_init() {
		if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
			add_filter('mce_buttons',array($this,'filter_mce_button'));
			add_filter('mce_external_plugins',array($this,'filter_mce_plugin'));
			add_filter('tiny_mce_version',array(&$this,'refresh_mce_version'));
			add_action('after_wp_tiny_mce',array(&$this,'hidden_popup_HTML'));
		}
	}
	function filter_mce_button($buttons) {
		array_push($buttons,sz_video_mce_get_separator(),'sz_video_youtube');
		return $buttons;
	}
	function filter_mce_plugin($plugins) {
		$plugins['szvideoyoutube'] = plugin_dir_url(__FILE__).'sz-video-mce-youtube.js';
		return $plugins;
	}
	function refresh_mce_version($ver) {
		$ver += 1;
		return $ver;
	}
	function hidden_popup_HTML() {
		$translate = szvideo_popup_translate();
		$translate['title'] = __('Video - Youtube','szvideoadmin');
		echo '<div id="sz-video-hidden-youtube" style="display:none">';
		echo '<div id="sz-video-hidden-youtube-title">';
		echo $translate['title'];
		echo '</div>';
		echo '<div id="sz-video-hidden-youtube-parms">';
		echo base64_encode(gzcompress(serialize($translate)));
		echo '</div>';
		echo '</div>'.PHP_EOL;
	}
}

/* ************************************************************************** */
/* Creazione della classe per il bottone Vimeo                                */
/* ************************************************************************** */
class SZVideoVimeo
{
	function __construct() {
		add_action('admin_init',array($this,'action_admin_init'));
	}
	function action_admin_init() {
		if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
			add_filter('mce_buttons',array($this,'filter_mce_button'));
			add_filter('mce_external_plugins',array($this,'filter_mce_plugin'));
			add_filter('tiny_mce_version',array(&$this,'refresh_mce_version'));
			add_action('after_wp_tiny_mce',array(&$this,'hidden_popup_HTML'));
		}
	}
	function filter_mce_button($buttons) {
		array_push($buttons,sz_video_mce_get_separator(),'sz_video_vimeo');
		return $buttons;
	}
	function filter_mce_plugin($plugins) {
		$plugins['szvideovimeo'] = plugin_dir_url(__FILE__).'sz-video-mce-vimeo.js';
		return $plugins;
	}
	function refresh_mce_version($ver) {
		$ver += 1;
		return $ver;
	}
	function hidden_popup_HTML() {
		$translate = szvideo_popup_translate();
		$translate['title'] = __('Video - Vimeo','szvideoadmin');
		echo '<div id="sz-video-hidden-vimeo" style="display:none">';
		echo '<div id="sz-video-hidden-vimeo-title">';
		echo $translate['title'];
		echo '</div>';
		echo '<div id="sz-video-hidden-vimeo-parms">';
		echo base64_encode(gzcompress(serialize($translate)));
		echo '</div>';
		echo '</div>'.PHP_EOL;
	}
}

/* ************************************************************************** */
/* Creazione della classe per il bottone DailyMotion                          */
/* ************************************************************************** */
class SZVideoDaily
{
	function __construct() {
		add_action('admin_init',array($this,'action_admin_init'));
	}
	function action_admin_init() {
		if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
			add_filter('mce_buttons',array($this,'filter_mce_button'));
			add_filter('mce_external_plugins',array($this,'filter_mce_plugin'));
			add_filter('tiny_mce_version',array(&$this,'refresh_mce_version'));
			add_action('after_wp_tiny_mce',array(&$this,'hidden_popup_HTML'));
		}
	}
	function filter_mce_button($buttons) {
		array_push($buttons,sz_video_mce_get_separator(),'sz_video_daily');
		return $buttons;
	}
	function filter_mce_plugin($plugins) {
		$plugins['szvideodaily'] = plugin_dir_url(__FILE__).'sz-video-mce-daily.js';
		return $plugins;
	}
	function refresh_mce_version($ver) {
		$ver += 1;
		return $ver;
	}
	function hidden_popup_HTML() {
		$translate = szvideo_popup_translate();
		$translate['title'] = __('Video - DailyMotion','szvideoadmin');
		echo '<div id="sz-video-hidden-daily" style="display:none">';
		echo '<div id="sz-video-hidden-daily-title">';
		echo $translate['title'];
		echo '</div>';
		echo '<div id="sz-video-hidden-daily-parms">';
		echo base64_encode(gzcompress(serialize($translate)));
		echo '</div>';
		echo '</div>'.PHP_EOL;
	}
}

/* *********************************************** */
/* Creazione della classe per il bottone Player    */
/* *********************************************** */
class SZVideoPlayer
{
	function __construct() {
		add_action('admin_init',array($this,'action_admin_init'));
	}
	function action_admin_init() {
		if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
			add_filter('mce_buttons',array($this,'filter_mce_button'));
			add_filter('mce_external_plugins',array($this,'filter_mce_plugin'));
			add_filter('tiny_mce_version',array(&$this,'refresh_mce_version'));
			add_action('after_wp_tiny_mce',array(&$this,'hidden_popup_HTML'));
		}
	}
	function filter_mce_button($buttons) {
		array_push($buttons,sz_video_mce_get_separator(),'sz_video_player');
		return $buttons;
	}
	function filter_mce_plugin($plugins) {
		$plugins['szvideoplayer'] = plugin_dir_url(__FILE__).'sz-video-mce-player.js';
		return $plugins;
	}
	function refresh_mce_version($ver) {
		$ver += 1;
		return $ver;
	}
	function hidden_popup_HTML() {
		$translate = szvideo_popup_translate();
		$translate['title'] = __('Video - Player','szvideoadmin');
		echo '<div id="sz-video-hidden-player" style="display:none">';
		echo '<div id="sz-video-hidden-player-title">';
		echo $translate['title'];
		echo '</div>';
		echo '<div id="sz-video-hidden-player-parms">';
		echo base64_encode(gzcompress(serialize($translate)));
		echo '</div>';
		echo '</div>'.PHP_EOL;
	}
}

/* ************************************************************************** */
/* Controllo del separatore una volta prima                                   */
/* ************************************************************************** */
function sz_video_mce_get_separator() 
{
	if (defined('SZ_PLUGIN_VIDEO_MCE_SEP')) return '';
		else define('SZ_PLUGIN_VIDEO_MCE_SEP','|');
	return SZ_PLUGIN_VIDEO_MCE_SEP;
}

/* ************************************************************************** */
/* Aggiunta file CSS per icone da aggiungere                                  */
/* ************************************************************************** */
function sz_video_add_css() 
{
echo '<style type="text/css">
				#content_sz_video_youtube span.mceIcon,
				#content_sz_video_vimeo span.mceIcon,
				#content_sz_video_daily span.mceIcon,
				#content_sz_video_player span.mceIcon,
				#content_sz_video_generic span.mceIcon { 
					background-image:url("'.plugin_dir_url(__FILE__).'sz-video-icon.png"); 
					background-repeat:no-repeat; 
				}

				#content_sz_video_youtube span.mceIcon {
					background-position:0px -20px; 
				}
				#content_sz_video_vimeo span.mceIcon {
					background-position:-60px -20px; 
				}
				#content_sz_video_daily span.mceIcon {
					background-position:-80px -20px; 
				}
				#content_sz_video_player span.mceIcon {
					background-position:-20px -20px; 
				}
				#content_sz_video_generic span.mceIcon {
					background-position:-100px -20px; 
				}

				#content_sz_video_youtube span.mceIcon:hover {
					background-position:0 0px; 
				}
				#content_sz_video_vimeo span.mceIcon:hover {
					background-position:-60px 0px; 
				}
				#content_sz_video_daily span.mceIcon:hover {
					background-position:-80px 0px; 
				}
				#content_sz_video_player span.mceIcon:hover {
					background-position:-20px 0px; 
				}
				#content_sz_video_generic span.mceIcon:hover {
					background-position:-100px 0px; 
				}
		</style>'.PHP_EOL;

	echo '<script type="text/javascript">'.PHP_EOL;
	echo '  var sz_ajaxurl = "'.admin_url('admin-ajax.php').'";'.PHP_EOL;
	echo '</script>'.PHP_EOL;
}
add_action('admin_head','sz_video_add_css');

/* ************************************************************************** */
/* Controllo se devo attivare gli shortcode                                   */
/* ************************************************************************** */
$enable_youtube = false; $editor_youtube = false; 
$enable_vimeo   = false; $editor_vimeo   = false;
$enable_daily   = false; $editor_daily   = false;
$enable_player  = false; $editor_player  = false;
$enable_video   = false; $editor_video   = false;

$op = get_option('sz_video_options_base');

if (isset($op['youtube'])    and $op['youtube']    == "1") $enable_youtube = true; 
if (isset($op['vimeo'])      and $op['vimeo']      == "1") $enable_vimeo   = true;
if (isset($op['daily'])      and $op['daily']      == "1") $enable_daily   = true;
if (isset($op['player'])     and $op['player']     == "1") $enable_player  = true;

if (isset($op['ed_youtube']) and $op['ed_youtube'] == "1") $editor_youtube = true; 
if (isset($op['ed_vimeo'])   and $op['ed_vimeo']   == "1") $editor_vimeo   = true;
if (isset($op['ed_daily'])   and $op['ed_daily']   == "1") $editor_daily   = true;
if (isset($op['ed_player'])  and $op['ed_player']  == "1") $editor_player  = true;
if (isset($op['ed_video'])   and $op['ed_video']   == "1") $editor_video   = true;

/* ************************************************************************** */
/* Controllo se devo attivare gli shortcode                                   */
/* ************************************************************************** */
if ($enable_youtube and $editor_youtube) $SZVideoYoutube = new SZVideoYoutube();
if ($enable_vimeo   and $editor_vimeo)   $SZVideoVimeo   = new SZVideoVimeo();
if ($enable_daily   and $editor_daily)   	$SZVideoDaily   = new SZVideoDaily();
if ($enable_player  and $editor_player)  	$SZVideoPlayer  = new SZVideoPlayer();

/* ************************************************************************** */
/* Se un solo shortcode è attivo aggiungo il pulsante video generico          */
/* ************************************************************************** */
if ($editor_video) { 
	if ($enable_youtube or $enable_vimeo or $enable_daily or $enable_player) {
		$SZVideoGeneric = new SZVideoGeneric();
	}
}