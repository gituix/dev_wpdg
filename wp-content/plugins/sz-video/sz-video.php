<?php
/*
Plugin Name: SZ - Video
Plugin URI: http://startbyzero.com/webmaster/wordpress-plugin/sz-video/
Description: Plugin per incorporare video <a href="http://www.youtube.com/">Youtube</a>, <a href="http://vimeo.com/">Vimeo</a>, <a href="http://www.dailymotion.com/">DailyMotion</a> o file presenti localmente sul proprio server web, possibilità di eseguire streaming su <a href="http://aws.amazon.com/cloudfront/">Amazon CloudFront</a>. Prima di utilizzare il plugin controllare bene tutte le opzioni di configurazione e impostare ogni shortcode secondo le proprie esigenze. Buona visione a tutti ! Se volete rimanere aggiornati su tutte le novità e i rilasci del plugin SZ-Video per Wordpress seguite la pagina ufficiale <a href="https://plus.google.com/115876177980154798858/">Webmaster di Start by Zero</a> sul social network di Google+ o iscrivetevi alla nostra <a href="https://plus.google.com/communities/109254048492234113886">Community su Wordpress</a> sempre su Google+. 
Author: Massimo Della Rovere
Version: 2.6
Author URI: https://plus.google.com/106567288702045182616
License: GPL2

Copyright 2012 Start by Zero (email: webmaster@startbyzero.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if (!defined('ABSPATH')) die("Accesso diretto al file non permesso");

/* ************************************************************************** */
/* Definizione delle costanti da usare nel plugin                             */
/* ************************************************************************** */
define('SZ_PLUGIN_VIDEO',true);
define('SZ_PLUGIN_VIDEO_WIDTH',600);
define('SZ_PLUGIN_VIDEO_HEIGHT',400);
define('SZ_PLUGIN_VIDEO_CSS_WARNING','text-align:center;color:#333333;background:#f4f4f4;font-family:Courier,monospace;padding:5px;margin:5px 0');
define('SZ_PLUGIN_PATH',plugin_dir_url(__FILE__));
define('SZ_PLUGIN_PATH_IMAGE',SZ_PLUGIN_PATH.'images/');

/* ************************************************************************** */
/* Caricamento della lingua per il plugin SZ-Video                            */
/* ************************************************************************** */
function sz_video_language_init() 
{
	load_plugin_textdomain(
		'szvideoadmin',false,dirname(plugin_basename(__FILE__ )).'/lang');
}
add_action('init','sz_video_language_init');

/* ************************************************************************** */
/* Caricamento script javascript necessari al plugin per funzionare           */
/* ************************************************************************** */
function sz_video_add_script() 
{
	/* Aggiungo style per player e codice jascript solo se non sono
	 * dentro i pannello di amministrazione ma nel frontend
	 */
	if (!is_admin()) 
	{
		/* Caricamento opzione per controllare il tipo di stylesheet che
		 * devo caricare 1=minimo 2=funzionale 3=completo
		 */
		$options = get_option('sz_video_options_player');

		if (isset($options['player_design'])) 
		{
			if ($options['player_design']=='1') $style = 'minimalist.css'; 
			if ($options['player_design']=='2') $style = 'functional.css';
			if ($options['player_design']=='3') $style = 'playful.css';
		}

		if (!isset($style)) $style = 'minimalist.css';

		/* Caricamento del file javascript per il prodotto Flowplayer
		 */
		wp_enqueue_script('flowplayer-js',
			plugins_url('players/flowplayer/flowplayer.min.js',__FILE__),
			array('jquery'),'5.4.3'
		);

		/* Caricamento dello stile in base alle opzioni indicate se non
		 * viene specificato nulla verrà utilizzato quello minimale
		 */
		wp_enqueue_style('flowplayer-css', 
			plugins_url('players/flowplayer/skin/'.$style,__FILE__)
		);		
	}
}
add_action('wp_enqueue_scripts','sz_video_add_script');

/* ************************************************************************** */
/* Funzione creazione delle opzioni in attivazione */
/* ************************************************************************** */
function sz_video_activate_init() 
{
	/* Impostazione valori di default che riguardano i 
	 * parametri base come l'attivazione degli shortcodes 
	 */
	$settings_base = array(
		'youtube'    => '1',
		'vimeo'      => '1',
		'daily'      => '1',
		'player'     => '1',
		'warning'    => '1',
		'protocol'   => '1',
		'schemaorg'  => '1',
		'ed_youtube' => '1',
		'ed_vimeo'   => '1',
		'ed_daily'   => '1',
		'ed_player'  => '1',
		'ed_video'   => '1',
	);

	sz_video_check_options('sz_video_options_base',$settings_base); 

	/* Impostazione valori di default che riguardano i 
	 * parametri dello shortcode video Youtube 
	 */
	$settings_youtube = array(
		'youtube_method'        => 'Y',
		'youtube_responsive'    => 'Y',
		'youtube_width'         => SZ_PLUGIN_VIDEO_WIDTH,
		'youtube_height'        => SZ_PLUGIN_VIDEO_HEIGHT,
		'youtube_margin_top'    => '0',
		'youtube_margin_right'  => '',
		'youtube_margin_bottom' => '1',
		'youtube_margin_left'   => '',
		'youtube_margin_units'  => 'em',
	);

	sz_video_check_options('sz_video_options_youtube',$settings_youtube); 

	/* Impostazione valori di default che riguardano i 
	 * parametri dello shortcode video Vimeo 
	 */
	$settings_vimeo = array(
		'vimeo_method'        => 'Y',
		'vimeo_responsive'    => 'Y',
		'vimeo_width'         => SZ_PLUGIN_VIDEO_WIDTH,
		'vimeo_height'        => SZ_PLUGIN_VIDEO_HEIGHT,
		'vimeo_margin_top'    => '0',
		'vimeo_margin_right'  => '',
		'vimeo_margin_bottom' => '1',
		'vimeo_margin_left'   => '',
		'vimeo_margin_units'  => 'em',
	);

	sz_video_check_options('sz_video_options_vimeo',$settings_vimeo); 

	/* Impostazione valori di default che riguardano i 
	 * parametri dello shortcode video DailyMotion 
	 */
	$settings_daily = array(
		'daily_method'        => 'Y',
		'daily_responsive'    => 'Y',
		'daily_width'         => SZ_PLUGIN_VIDEO_WIDTH,
		'daily_height'        => SZ_PLUGIN_VIDEO_HEIGHT,
		'daily_margin_top'    => '0',
		'daily_margin_right'  => '',
		'daily_margin_bottom' => '1',
		'daily_margin_left'   => '',
		'daily_margin_units'  => 'em',
	);

	sz_video_check_options('sz_video_options_daily',$settings_daily); 

	/* Impostazione valori di default che riguardano i 
	 * parametri dello shortcode video Player 
	 */
	$settings_player = array(
		'player_design'        => '1',
		'player_t_webm'        => '1',
		'player_t_mp4'         => '1',
		'player_t_ogv'         => '1',
		'player_responsive'    => 'Y',
		'player_width'         => SZ_PLUGIN_VIDEO_WIDTH,
		'player_height'        => SZ_PLUGIN_VIDEO_HEIGHT,
		'player_margin_top'    => '0',
		'player_margin_right'  => '',
		'player_margin_bottom' => '1',
		'player_margin_left'   => '',
		'player_margin_units'  => 'em',
		'player_ga'		        => '0',
		'player_ga_UID'        => '',
	);

	sz_video_check_options('sz_video_options_player',$settings_player); 
	
}
register_activation_hook( __FILE__,'sz_video_activate_init');

/* ************************************************************************** */
/* Funzione per i controllo dei parametri in maniera singola e default        */
/* ************************************************************************** */
function sz_video_check_options($name,$value) 
{
	/* Controllo se valori di default per le opzioni 
	 * generali sono contenuti dentro un array valido
	 */
	if (is_array($value)) { 

		/* Controllo se esistono le opzioni richieste, in caso
		 * affermativo passo al controllo di ogni singola opzione 
		 */
		if ($options = get_option($name)) 
		{
			if (!is_array($options)) $options=array(); 

			foreach ($value as $key=>$item) {
				if (!isset($options[$key])) $options[$key]=$item;
			}

			update_option($name,$options);

		/* Se le opzioni non esistono in quanto il plugin potrebbe
		 * essere la prima volta che viene installato -> aggiungo array 
		 */
		} else {
			add_option($name,$value);
		}
	}
}
/* ************************************************************************** */
/* Inclusione delle funzioni per i SHORTCODES                                 */
/* ************************************************************************** */
@require_once(dirname(__FILE__).'/sz-video-shortcode.php');
@require_once(dirname(__FILE__).'/sz-video-widgets.php');

/* ************************************************************************** */
/* Inclusione delle funzioni da usare in admin                                */
/* ************************************************************************** */
if (is_admin()) {
	@include_once(dirname(__FILE__).'/sz-video-admin.php');
	@include_once(dirname(__FILE__).'/mce/sz-video-mce.php');
}
