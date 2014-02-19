<?php
/* ************************************************************************** */
/* Controllo se definita la costante del plugin                               */
/* ************************************************************************** */
if (!defined('SZ_PLUGIN_VIDEO') or !SZ_PLUGIN_VIDEO) die();

/* ************************************************************************** */
/* Funzione shortcode per inserimento video GENERICO                          */
/* ************************************************************************** */
function sz_shortcode_video($atts,$content=null) 
{
	/* Estrazione del valore URL dal codice shortcode */
	extract(shortcode_atts(array('url'=>''),$atts));

	/* Se URL non é specificato esco dalla funzione */
	if (strlen(trim($url)) <= 0) return $content;

	$path = ''; 
	$link = html_entity_decode($url); 
	$data = parse_url($link);

	if (isset($data['host']))   $host = $data['host']; 
	if (isset($data['path']))   $path = $data['path']; 
	if (isset($data['scheme'])) $http = $data['scheme']; 

	/* Controllo il tipo di link URL specificato per Youtube se
	 * usato metodo tradizionale o codice URL short 
	 */
	if (isset($http) and isset($host) and ($http=='http' or $http=='https')) 
	{
		if ($host=='youtube.com')         $type = 'youtube';
		if ($host=='www.youtube.com')     $type = 'youtube';
		if ($host=='youtu.be')            $type = 'youtube';
		if ($host=='vimeo.com')           $type = 'vimeo';
		if ($host=='www.vimeo.com')       $type = 'vimeo';
		if ($host=='dailymotion.com')     $type = 'dailymotion';
		if ($host=='www.dailymotion.com') $type = 'dailymotion';
	}

	/* Se URL non é un indirizzo locale o contiene un dominio 
	 * legato a shortcode specializzato richiamo la funzione specifica   
	 */
	if (isset($type) and $type=='youtube') {
		return sz_shortcode_video_youtube($atts,$content); 
	} 
	if (isset($type) and $type=='vimeo') {
		return sz_shortcode_video_vimeo($atts,$content); 
	} 
	if (isset($type) and $type=='dailymotion') {
		return sz_shortcode_video_daily($atts,$content); 
	} 

	/* Esecuzione codice per shortcode con presenza locale */ 
	return sz_shortcode_video_player($atts,$content); 
}

/* ************************************************************************** */
/* Funzione shortcode per inserimento video da YOUTUBE                        */
/* ************************************************************************** */
function sz_shortcode_video_youtube($atts,$content=null)
{
	if (!sz_shortcode_check_enabled('youtube')) {
		return sz_shortcode_check_warning('youtube');
	}

	/* Lettura opzioni legate allo shortcode e chiamata successiva
	 * alla funzione per il calcolo degli attributi necessari
	 */
	$options = sz_shortcode_get_player_config(
		'sz_video_options_youtube','youtube',$atts
	);

	$video = sz_shortcode_get_player_attribute(
		'youtube',$options
	);

	if ($video == false) {
		return sz_shortcode_check_URL(); 
	}
		
	/* Preparazione output per IFRAME contenente il player
	 * video secondo lo standard del codice embed YOUTUBE 
	 */
	$code  = '<iframe style="'.$video['style'].'"';
	$code .= ' src="'.$video['source'].'" ';
	$code .= $video['isize'];
	$code .= '>';
	$code .= '</iframe>';

	/* Preparazione output per HTML contenente il player
	 * video secondo lo standard del codice embed YOUTUBE 
	 */
	$HTML = sz_shortcode_get_player_HTML(
		$options,$code,$video,'embed'
	);

	/* Ritorno il codice completo dello shortcode richiamato 
	 * normalmente codice HTML5 con la definizione di iframe
	 */
	return $HTML;
}

/* ************************************************************************** */
/* Funzione shortcode per inserimento video da VIMEO                          */
/* ************************************************************************** */
function sz_shortcode_video_vimeo($atts,$content=null)
{
	if (!sz_shortcode_check_enabled('vimeo')) {
		return sz_shortcode_check_warning('vimeo');
	}

	/* Lettura opzioni legate allo shortcode e chiamata successiva
	 * alla funzione per il calcolo degli attributi necessari
	 */
	$options = sz_shortcode_get_player_config(
		'sz_video_options_vimeo','vimeo',$atts
	);

	$video = sz_shortcode_get_player_attribute(
		'vimeo',$options
	);

	if ($video == false) {
		return sz_shortcode_check_URL(); 
	}
	
	/* Preparazione output per IFRAME contenente il player
	 * video secondo lo standard del codice embed YOUTUBE 
	 */
	$code  = '<iframe style="'.$video['style'].'"';
	$code .= ' src="'.$video['source'].'" ';
	$code .= $video['isize'];
	$code .= '>';
	$code .= '</iframe>';

	/* Preparazione output per HTML contenente il player
	 * video secondo lo standard del codice embed YOUTUBE 
	 */
	$HTML = sz_shortcode_get_player_HTML(
		$options,$code,$video,'embed'
	);

	/* Ritorno il codice completo dello shortcode richiamato 
	 * normalmente codice HTML5 con la definizione di iframe
	 */
	return $HTML;
}

/* ************************************************************************** */
/* Funzione shortcode per inserimento video da DAILYMOTION                    */
/* ************************************************************************** */
function sz_shortcode_video_daily($atts,$content=null)
{
	if (!sz_shortcode_check_enabled('daily')) {
		return sz_shortcode_check_warning('daily');
	}

	/* Lettura opzioni legate allo shortcode e chiamata successiva
	 * alla funzione per il calcolo degli attributi necessari
	 */
	$options = sz_shortcode_get_player_config(
		'sz_video_options_daily','daily',$atts
	);

	$video = sz_shortcode_get_player_attribute(
		'dailymotion',$options
	);

	if ($video == false) {
		return sz_shortcode_check_URL(); 
	}

	/* Preparazione output per IFRAME contenente il player
	 * video secondo lo standard del codice embed DAILYMOTION 
	 */
	$code  = '<iframe style="'.$video['style'].'"';
	$code .= ' src="'.$video['source'].'" ';
	$code .= $video['isize'];
	$code .= '>';
	$code .= '</iframe>';

	/* Preparazione output per HTML contenente il player
	 * video secondo lo standard del codice embed YOUTUBE 
	 */
	$HTML = sz_shortcode_get_player_HTML(
		$options,$code,$video,'embed'
	);

	/* Ritorno il codice completo dello shortcode richiamato 
	 * normalmente codice HTML5 con la definizione di iframe
	 */
	return $HTML;
}

/* ************************************************************************** */
/* Funzione shortcode per inserimento video da PLAYER                         */
/* ************************************************************************** */
function sz_shortcode_video_player($atts,$content=null)
{
	if (!sz_shortcode_check_enabled('player')) {
		return sz_shortcode_check_warning('player');
	}

	/* Azzeramento stringa di codice HTML e lettura dei
	 * parametri di configurazione legati allo shortcode
	 */
	$options = sz_shortcode_get_player_config(
		'sz_video_options_player','player',$atts
	);

	$onlyU = $options['onlyU'];

	/* Lettura delle opzioni generali di configurazione per elenco
	 * dei video permessi e che devo essere aggiunti a <video>
	 */
	$codec = get_option('sz_video_options_player');

	if (!isset($codec['player_t_webm'])) $codec['player_t_webm'] = '0'; 
	if (!isset($codec['player_t_mp4'] )) $codec['player_t_mp4']  = '0'; 
	if (!isset($codec['player_t_ogv'] )) $codec['player_t_ogv']  = '0'; 

	/* Controllo le opzioni legate a google analytics per attivare
	 * la funzione di traking degli eventi legati al video
	 */
	if (!isset($codec['player_ga']))     $codec['player_ga']     = '0'; 
	if (!isset($codec['player_ga_UID'])) $codec['player_ga-UID'] = ''; 
	
	$video = false; 
	$schem = false; 
	$hosts = false; 
	$paths = false; 
	$query = false; 
	$xtweb = false;
	$xtmp4 = false;
	$xtogg = false;

	$ratio = "0.5625";

	/* Controllo subito se indirizzo URL risulta valido, in caso contrario
	 * emettono la scrittura di elaborazione nonbn possibile e URL errato
	 */

	$argom = array(); 
	$ports = ""; 
	$links = html_entity_decode($options['links']); 
	$datas = parse_url($links);

	if (isset($datas['scheme'])) $schem = $datas['scheme']; 
	if (isset($datas['host']))   $hosts = $datas['host']; 
	if (isset($datas['path']))   $paths = $datas['path']; 

	if (isset($datas['port']))   $ports = ':'.$datas['port']; 
	if (isset($datas['query']))  $query = '?'.$datas['query']; 

	/* Controllo il valore speciale demo per URL, se specificato
	 * devo caricare i video memorizzati nel plugin come Demo
	 */
	if (strtolower($links) == 'demo') 
	{
		$video = true;

		$xtweb = true;
		$xtmp4 = true;
		$xtogg = true;

		$ratio = "0.4170";
		$vtweb = plugin_dir_url(__FILE__).'videos/playful/624x260.webm';
		$vtmp4 = plugin_dir_url(__FILE__).'videos/playful/624x260.mp4';
		$vtogg = plugin_dir_url(__FILE__).'videos/playful/624x260.ogv';

	} else {

		/* Controllo il tipo di link URL specificato per Youtube se
		 * usato metodo tradizionale o codice URL short 
		 */
		if ($schem == 'http' or $schem == 'https') 
		{
			$typef = ""; 
			$media = ""; 

			if ($paths) { 
				$typef = strrchr($paths,'.');  
				if($typef !== false) $media = substr($paths,0,-strlen($typef));  
				$URLst = $schem.'://'.$hosts.$ports.$media;
			}

			if (strtolower($typef)=='.webm') {
				$video = true;
				$xtweb = true;
				$vtweb = $URLst.$typef.$query;
			}

			if (strtolower($typef)=='.mp4') {
				$video = true;
				$xtmp4 = true;
				$vtmp4 = $URLst.$typef.$query;
			}

			if (strtolower($typef)=='.ogv') {
				$video = true;
				$xtogg = true;
				$vtogg = $URLst.$typef.$query;
			}

			/* Se ho trovato almeno un video valido posso crearmi i riferimenti
			 * dei video da aggiungere alla lista in base a quelli permessi
			 */		
			if ($video and strtolower($onlyU) <> 'y') 
			{
				if ($codec['player_t_webm']=='1' and !isset($vtweb))	{
					$xtweb = true;
					$vtweb = $URLst.'.webm'.$query;
				}	
				if ($codec['player_t_mp4']=='1' and !isset($vtmp4))	{
					$xtmp4 = true;
					$vtmp4 = $URLst.'.mp4'.$query;
				}	
				if ($codec['player_t_ogv']=='1' and !isset($vtogv))	{
					$xtogg = true;
					$vtogg = $URLst.'.ogv'.$query;
				}	
			}	
		}
	}
	
	/* Se non sono riuscito ad avere il codice del video
	 * dalla stringa URL spoecificata esco dalla funzione 
	 */
	if ($video == false) {
		return sz_shortcode_check_URL(); 
	}

	$width = $options['width'];
	$heigh = $options['heigh'];
	$respo = $options['respo'];
	$cover = $options['cover'];
	$aspra = $options['ratio'];
	$aplay = $options['aplay'];
	$aloop = $options['aloop'];
	$udata = $options['udata'];

	/* Calcolo immagine per cover image, se specificata per URL 
	 * o prendo quella messa a disposizione dal servizio video.
	 */
	$image = plugin_dir_url(__FILE__).'images/player.jpg';

	if (strlen($cover)>0) {
		if($cover <> 'default') $image = $cover;
	}
	
	if (strtolower($links) == 'demo') {
		$image = plugin_dir_url(__FILE__).'videos/playful/playful.jpg';
	}

	/* Controllo opzioni specifiche per Responsive Design in maniera 
	 * da calcolare anche aspect radio se non specificato su shortcode
	 */
	if (strtolower($respo) <> 'y') {
		if (is_numeric($width) and is_numeric($heigh)) {
			if ($width > 0 and $heigh > 0)
				$ratio = number_format($heigh/$width,4,'.','');
		}
	} 	

	if (is_numeric($aspra) and $aspra <= 1 and $aspra >= 0) {
		$ratio = number_format($aspra,4,'.','');
	}

	/* Preparazione codici di stile da inserire nel
	 * contenitore principale con classe uguale a flowplayer
	 */
	$style  = ' style="';
	$style .= 'background-color:#f1f1f1;';
	$style .= 'background-image:url('.$image.');';
	$style .= "background-repeat:no-repeat;";
	$style .= "background-position:center center;";
	$style .= "background-size:100% 100%;";
	$style .= '"';

	/* Preparazione variabile con i parametri aggiuntivi che devono 
	 * essere inseriti nel tag video HTML5 come autoplay,loop,ect
	 */
	$video_options = ''; 

	if (strtolower($aplay)=='y') $video_options .= ' autoplay="autoplay"'; 
	if (strtolower($aloop)=='y') $video_options .= ' loop="loop"'; 

	/* Preparazione variabile con i parametri aggiuntivi che devono 
	 * essere inseriti nel tag video HTML5 per google analytics
	 */
	$video_ga = ''; 

	if ($codec['player_ga']=='1') {
		$video_ga .= ' data-analytics="'; 
		$video_ga .= trim($codec['player_ga_UID']); 
		$video_ga .= '"'; 
	}  

	/* Preparazione output per codice HTML5 ed inserimento
	 * dei tags video con source in base a quelli da aggiungere
	 */
	$code  = '<div class="flowplayer" data-ratio="'.$ratio.'"'.$style.$video_ga.'>';
	$code .= '<video preload="none"'.$video_options.'>';

	if (isset($xtweb) and $xtweb) $code .= '<source type="video/webm" src="'.$vtweb.'"/>';
	if (isset($xtmp4) and $xtmp4) $code .= '<source type="video/mp4"  src="'.$vtmp4.'"/>';
	if (isset($xtogg) and $xtogg) $code .= '<source type="video/ogg"  src="'.$vtogg.'"/>';
	
	$code .= '</video>';
	$code .= '</div>';

	/* Preparazione output per HTML contenente il player
	 * video secondo lo standard del codice embed HTML5 
	 */
	$HTML = sz_shortcode_get_player_HTML(
		$options,$code,array(),'player'
	);

	/* Ritorno il codice completo dello shortcode richiamato 
	 * normalmente codice HTML5 con la definizione di iframe
	 */
	return $HTML;
}

/* ************************************************************************** */
/* Aggiungo codice per esecuzione degli shortcode                             */
/* ************************************************************************** */
add_shortcode('sz-video','sz_shortcode_video');
add_shortcode('sz-youtube','sz_shortcode_video_youtube');
add_shortcode('sz-vimeo','sz_shortcode_video_vimeo');
add_shortcode('sz-dailymotion','sz_shortcode_video_daily');
add_shortcode('sz-player','sz_shortcode_video_player');

/* ************************************************************************** */
/* Funzione che controlla se SHORTCODE risulta attivo                         */
/* ************************************************************************** */
function sz_shortcode_check_enabled($name)
{
	$option = get_option('sz_video_options_base');

	if (isset($option[$name]) and $option[$name]=="1") return true;
		else return false;
}

/* ************************************************************************** */
/* Funzione che controlla se SHORTCODE risulta attivo                         */
/* ************************************************************************** */
function sz_shortcode_check_warning($name) 
{
	$option  = get_option('sz_video_options_base');
	$codice  = '<div class="sz-warning" style="'.SZ_PLUGIN_VIDEO_CSS_WARNING.'">';
	$codice .= __('Shortcode').' '.ucfirst($name).' '; 
	$codice .= __('is not activated').'</div>';

	if (isset($option['warning']) and $option['warning']=="1") return '';
		else return $codice;
}

/* ************************************************************************** */
/* Funzione che controlla se URL non è valido per lo SHORTCODE                */
/* ************************************************************************** */
function sz_shortcode_check_URL()
{
	$codice  = '<div class="sz-warning" ';
	$codice .= 'style="'.SZ_PLUGIN_VIDEO_CSS_WARNING.'">';
	$codice .= __('Video URL specified is not valid').'</div>'; 

	return $codice;
}

/* ************************************************************************** */
/* Funzione che analizza SHORTCODE ed elabora i parametri specificati         */
/* ************************************************************************** */
function sz_shortcode_get_player_config($optionset,$name,$atts)
{
	/* Lettura array opzioni memorizzati passando il
	 * nome del optionset passato alla funzione
	 */
	$options = get_option($optionset);

	$_width = $name.'_width';
	$_heigh = $name.'_height';
	$_margt = $name.'_margin_top';
	$_margr = $name.'_margin_right';
	$_margb = $name.'_margin_bottom';
	$_margl = $name.'_margin_left';
	$_margu = $name.'_margin_units';
	$_metho = $name.'_method';
	$_respo = $name.'_responsive';

	/* Controllo opzioni base dello shortcode come dimensione video
	 * margini e valori specifici sul file da visualizzare
	 */
	if (!isset($options[$_width]) or is_null($options[$_width])) $options[$_width]='0'; 
	if (!isset($options[$_heigh]) or is_null($options[$_heigh])) $options[$_heigh]='0'; 
	if (!isset($options[$_margt]) or is_null($options[$_margt])) $options[$_margt]='0'; 
	if (!isset($options[$_margr]) or is_null($options[$_margr])) $options[$_margr]=''; 
	if (!isset($options[$_margb]) or is_null($options[$_margb])) $options[$_margb]='0'; 
	if (!isset($options[$_margl]) or is_null($options[$_margl])) $options[$_margl]=''; 
	if (!isset($options[$_margu]) or is_null($options[$_margu])) $options[$_margu]='px'; 
	if (!isset($options[$_metho]) or is_null($options[$_metho])) $options[$_metho]='Y'; 
	if (!isset($options[$_respo]) or is_null($options[$_respo])) $options[$_respo]='Y'; 

	if (trim($options[$_width])=='') $options[$_width]='0'; 
	if (trim($options[$_heigh])=='') $options[$_heigh]='0'; 
	if (trim($options[$_margt])=='') $options[$_margt]='0'; 
	if (trim($options[$_margr])=='') $options[$_margr]=''; 
	if (trim($options[$_margb])=='') $options[$_margb]='0'; 
	if (trim($options[$_margl])=='') $options[$_margl]=''; 

	if (!ctype_digit($options[$_width])) $options[$_width]='0'; 
	if (!ctype_digit($options[$_heigh])) $options[$_heigh]='0'; 
	if (!ctype_digit($options[$_margt])) $options[$_margt]='0'; 
	if (!ctype_digit($options[$_margr])) $options[$_margr]=''; 
	if (!ctype_digit($options[$_margb])) $options[$_margb]='0'; 
	if (!ctype_digit($options[$_margl])) $options[$_margl]=''; 

	if ($options[$_width]=='0') $options[$_width] = SZ_PLUGIN_VIDEO_WIDTH; 
	if ($options[$_heigh]=='0') $options[$_heigh] = SZ_PLUGIN_VIDEO_HEIGHT; 
	if ($options[$_margr]=='' ) $options[$_margr] = 'auto'; 
	if ($options[$_margl]=='' ) $options[$_margl] = 'auto'; 

	$options[$_margu] = strtolower($options[$_margu]);
	$options[$_metho] = strtolower($options[$_metho]);
	$options[$_respo] = strtolower($options[$_respo]);

	if ($options[$_margu]<>'px' and $options[$_margu]<>'em') $options[$_margu] = 'px';
	if ($options[$_metho]<>'y'  and $options[$_metho]<>'n' ) $options[$_metho] = 'y';
	if ($options[$_respo]<>'y'  and $options[$_respo]<>'n' ) $options[$_respo] = 'y';

	/* Controllo opzione per inserimento codice schema.org con le 
	 * opzioni associate che riguardano titolo e descrizione
	 */
	if (sz_shortcode_check_enabled('schemaorg')) $schemaorg = 'y';
		else $schemaorg = 'n';

	/* Preparazione array con tutte le variabili di configurazione
	 * per i parametri del codice embed legato al video
	 */
	$configs = array();
	$configs['links'] = '';
	$configs['cover'] = '';
	$configs['ratio'] = '';
	$configs['udata'] = '';
	$configs['float'] = '';
	$configs['capti'] = '';
	$configs['durat'] = '0';
	$configs['aplay'] = 'N';
	$configs['aloop'] = 'N';
	$configs['onlyU'] = 'N';
	$configs['title'] = get_the_title();
	$configs['descr'] = substr(strip_tags(get_the_content()),0,200);
	$configs['schem'] = trim($schemaorg);
	$configs['width'] = trim($options[$_width]);
	$configs['heigh'] = trim($options[$_heigh]);
	$configs['margt'] = trim($options[$_margt]);
	$configs['margr'] = trim($options[$_margr]);
	$configs['margb'] = trim($options[$_margb]);
	$configs['margl'] = trim($options[$_margl]);
	$configs['margu'] = trim($options[$_margu]);
	$configs['metho'] = trim($options[$_metho]);
	$configs['respo'] = trim($options[$_respo]);

	/* Estrazione dei valori dal codice shortcode e impostazione 
	 * come valori di default nel caso che non vengano direttamente specificati
	 */
	extract(shortcode_atts(array(
		'url'          => $configs['links'],
		'width'        => $configs['width'],
		'height'       => $configs['heigh'],
		'margintop'    => $configs['margt'],
		'marginright'  => $configs['margr'],
		'marginbottom' => $configs['margb'],
		'marginleft'   => $configs['margl'],
		'units'        => $configs['margu'],
		'method'       => $configs['metho'],
		'responsive'   => $configs['respo'],
		'cover'        => $configs['cover'],
		'ratio'        => $configs['ratio'],
		'schemaorg'    => $configs['schem'],
		'title'        => $configs['title'],
		'description'  => $configs['descr'],
		'duration'     => $configs['durat'],
		'autoplay'     => $configs['aplay'],
		'loop'         => $configs['aloop'],
		'userdata'     => $configs['udata'],
		'float'        => $configs['float'],
		'onlyurl'      => $configs['onlyU'],
		'caption'      => $configs['capti'],
	),$atts));

	/* Se vengono specificati dei valori ma in maniera non corretta
	 * forzo il valore con il contenuto corrispondente di default
	 */
	if (!ctype_digit($width))    $width    = $options[$_width];
	if (!ctype_digit($height))   $height   = $options[$_heigh];
	if (!ctype_digit($duration)) $duration = '0';

	$userdata     = trim($userdata);
	$caption      = trim($caption);
	$margintop    = strtolower(trim($margintop));
	$marginright  = strtolower(trim($marginright));
	$marginbottom = strtolower(trim($marginbottom));
	$marginleft   = strtolower(trim($marginleft));
	$units        = strtolower(trim($units));
	$method       = strtolower(trim($method));
	$responsive   = strtolower(trim($responsive));
	$schemaorg    = strtolower(trim($schemaorg));
	$autoplay     = strtolower(trim($autoplay));
	$loop         = strtolower(trim($loop));
	$float        = strtolower(trim($float));
	$onlyurl      = strtolower(trim($onlyurl));

	if ($margintop    <> 'auto' and !ctype_digit($margintop))    $margintop    = $options[$_margt];
	if ($marginright  <> 'auto' and !ctype_digit($marginright))  $marginright  = $options[$_margr];
	if ($marginbottom <> 'auto' and !ctype_digit($marginbottom)) $marginbottom = $options[$_margb];
	if ($marginleft   <> 'auto' and !ctype_digit($marginleft))   $marginleft   = $options[$_margl];

	if ($units      <> 'px' and $units      <> 'em') $units      = $options[$_margu]; 

	if ($method     <> 'y'  and $method     <> 'n' ) $method     = $options[$_metho]; 
	if ($responsive <> 'y'  and $responsive <> 'n' ) $responsive = $options[$_respo]; 
	if ($schemaorg  <> 'y'  and $schemaorg  <> 'n')  $schemaorg  = $configs['schem']; 
	if ($autoplay   <> 'y'  and $autoplay   <> 'n')  $autoplay   = $configs['aplay']; 
	if ($loop       <> 'y'  and $loop       <> 'n')  $loop       = $configs['aloop']; 
	if ($float      <> 'r'  and $float      <> 'l')  $float      = $configs['float']; 
	if ($onlyurl    <> 'y'  and $onlyurl    <> 'n')  $onlyurl    = $configs['onlyU']; 

	/* Esecuzione del trim per levare eventuali spazi prima e dopo
	 * il contenuto corrispondente alla chiave dello shortcode
	 */
	$configs['links'] = trim($url);
	$configs['width'] = trim($width);
	$configs['heigh'] = trim($height);
	$configs['margt'] = trim($margintop);
	$configs['margr'] = trim($marginright);
	$configs['margb'] = trim($marginbottom);
	$configs['margl'] = trim($marginleft);
	$configs['cover'] = trim($cover);
	$configs['units'] = strtoupper(trim($units));
	$configs['metho'] = strtoupper(trim($method));
	$configs['respo'] = strtoupper(trim($responsive));
	$configs['ratio'] = trim($ratio);
	$configs['schem'] = trim($schemaorg);
	$configs['title'] = trim($title);
	$configs['descr'] = trim($description);
	$configs['durat'] = trim($duration);
	$configs['aplay'] = strtolower(trim($autoplay));
	$configs['aloop'] = strtolower(trim($loop));
	$configs['udata'] = trim($userdata);
	$configs['float'] = trim($float);
	$configs['onlyU'] = trim($onlyurl);
	$configs['capti'] = trim($caption);

	/* Ritorno alla funzione chiamante array con 
	 * tutte le opzioni legate allo shortcode o di configurazione
	 */
	return $configs;
}

/* ************************************************************************** */
/* Funzione che analizza SHORTCODE ed elabora i parametri specificati         */
/* ************************************************************************** */
function sz_shortcode_get_player_HTML($options,$frame,$video,$modes)
{

	$marg0 = '0';

	$width = $options['width'];
	$heigh = $options['heigh'];

	$margt = $options['margt'];
	$margr = $options['margr'];
	$margb = $options['margb'];
	$margl = $options['margl'];
	$margu = $options['margu'];

	$links = $options['links'];
	$metho = $options['metho'];
	$respo = $options['respo'];
	$schem = $options['schem'];
	$title = $options['title'];
	$descr = $options['descr'];
	$durat = $options['durat'];
	$float = $options['float'];
	$onlyU = $options['onlyU'];
	$capti = $options['capti'];

	/* Calcolo della stringa CSS per i margini da applicare
	 * al contenitore principale del video da visualizzare
	 */
	if ($margt <> 'auto') $margt .= $margu;
	if ($margr <> 'auto') $margr .= $margu;
	if ($margb <> 'auto') $margb .= $margu;
	if ($margl <> 'auto') $margl .= $margu;

	$MAR_1 = trim($margt.' '.$margr.' '.$margb.' '.$margl);
	$MAR_2 = trim($margt.' '.$marg0.' '.$margb.' '.$marg0);

	/* Se trovo un URL Youtube valido eseguo la creazione Iframe
	 * in caso contrario creo la divisione per il messaggio di warning
	 */

	$click = "";
	$margg = "";
	$backg = "display:block;";
	$nones = "display:block;";
	$plays = "display:block;";
	$style = "display:block;";
	$keyID = 'sz-video-'.md5(uniqid(),false);

	/* Operazioni da eseguire solo se sono in modo EMBED IFRAME 
	 * in maniera da gestire specificatamente alcuni parametri
	 */
	if ($modes == 'embed') 
	{
		if (strtolower($metho) == 'n') 
		{
			$nones  = "display:none;";

			$click  = 'onclick="';
			$click .= "thevid=document.getElementById('".$keyID."'); thevid.style.display='block'; ";
			$click .= "document.getElementById('".$keyID."').getElementsByTagName('iframe')[0].src = '".$video['play']."';";
			$click .= '"';

			$backg  = "background-image:url('".$video['cover']."');";
			$backg .= "background-repeat:no-repeat;";
			$backg .= "background-position:center center;";
			$backg .= "background-size:100% 100%;";
			$backg .= "cursor:pointer;";

			$plays  = "background-image:url('".plugin_dir_url(__FILE__)."images/play-button.png');";
			$plays .= "background-repeat:no-repeat;";
			$plays .= "background-position:center center;";
			$plays .= "background-size:20% auto;";
		}

		if (strtolower($respo) == 'y') 
		{
			$style  = $plays;
			$style .= "position:relative;"; 	
			$style .= "padding-bottom:56.25%;"; 	
			$style .= "height:0;"; 	
			$style .= "overflow:hidden;"; 	

			$margg .= 'margin:'.$MAR_2.';';

		} else {

			$style  = $plays;
			$style .= 'width:' .$width.'px;';
			$style .= 'height:'.$heigh.'px;';
			$style .= 'overflow:hidden;';
			$style .= 'margin:'.$MAR_1.';';

			$backg .= 'width:' .$width.'px;';
			$backg .= 'height:'.$heigh.'px;';

			$margg .= 'margin:'.$MAR_1.';';
		}

	} 	

	/* Operazioni da eseguire solo se sono in modo PLAYER HTML5 
	 * in maniera da gestire specificatamente alcuni parametri
	 */
	if ($modes == 'player') 
	{
		if (strtolower($respo) == 'y') 
		{
			$style  = $plays;
			$margg .= 'margin:'.$MAR_2.';';

		} else {

			$style  = $plays;
			$style .= 'width:' .$width.'px;';
			$style .= 'height:'.$heigh.'px;';
			$style .= 'overflow:hidden;';
			$style .= 'margin:'.$MAR_1.';';

			$backg .= 'width:' .$width.'px;';
			$backg .= 'height:'.$heigh.'px;';

			$margg .= 'margin:'.$MAR_1.';';
		}
	} 	

	/* Controllo se devo aggiungere le informazioni per 
	 * l'esecuzione del float sul contenitore principale
	 */

	if ($float == 'r') $backg .= 'float:right;';
	if ($float == 'l') $backg .= 'float:left;';

	/* Controllo se devo aggiungere le informazioni che riguardano 
	 * gli attributi SEO legati allo standard schema.org
	 */
	$sname = '';
	$smeta = '';
	$stime = 'T';

	if (ctype_digit($durat) and  $durat <> '0') {;
		$orario = gmdate("H:i:s",$durat);
		if (substr($orario,0,2)<>'00') $stime .= ltrim(substr($orario,0,2),'0').'H';
		if (substr($orario,3,2)<>'00') $stime .= ltrim(substr($orario,3,2),'0').'M';
		if (substr($orario,6,2)<>'00') $stime .= ltrim(substr($orario,6,2),'0').'S';
	}

	/* Controllo se devo aggiungere le informazioni che riguardano 
	 * gli attributi SEO legati allo standard schema.org
	 */
	if ($schem == 'y') 
	{
		$sname  = ' itemscope itemtype="http://schema.org/VideoObject"';
		$smeta  = '<meta itemprop="name" content="'.$title.'"/>';
		$smeta .= '<meta itemprop="description" content="'.htmlspecialchars($descr,ENT_QUOTES,'UTF-8').'"/>';

		if ($modes == 'embed') { 
			$smeta .= '<meta itemprop="embedURL" content="'.$links.'"/>';
		} else {
			$smeta .= '<meta itemprop="contentURL" content="'.$links.'"/>';
		}

		if (isset($video['cover'])) {
			$smeta .= '<meta itemprop="thumbnailUrl" content="'.$video['cover'].'"/>';
		}

		if ($stime <> 'T') {
			$smeta .= '<meta itemprop="duration" content="'.$stime.'"/>';
		}
	}

	/* Controllo se la dimensione del video deve essere di tipo
	 * responsive size o devo usare le dimensioni specificate
	 */
	$code  = '<div class="sz-video-main" style="'.$margg.'"'.$sname.'>';

	$code .= '<div class="sz-video-play" style="'.$backg.'">';
	$code .= '<div class="sz-video-cont" style="'.$style.'" '.$click.'>';
	$code .= '<div class="sz-video-wrap" style="'.$nones.'" id ="'.$keyID.'">';

	$code .= $smeta;
	$code .= $frame;

	$code .= '</div>';
	$code .= '</div>';
	$code .= '</div>';

	/* Controllo se devo inserire un testo di caption
	 */
	if (strlen(trim($capti))>0) {
		$code .= '<div class="sz-video-capt" style="background-color:#e8e8e8;padding:0.5em 1em;text-align:center;font-weight:bold;margin-top:5px;">';
		$code .= trim($capti);
		$code .= '</div>';
	}		 

	$code .= '</div>';

	/* Ritorno il codice completo dello shortcode richiamato 
	 * normalmente codice HTML5 con la definizione di iframe
	 */
	return $code;
}

/* ************************************************************************** */
/* Funzione che analizza SHORTCODE ed elabora i parametri specificati         */
/* ************************************************************************** */
function sz_shortcode_get_player_attribute($shortcode,$options)
{
	/* Controllo subito se indirizzo URL risulta valido, ritorno indietro
	 * il numero del video ed eventuali parametri specificati.
	 */
	$vidID = false;  // Identificativo video 
	$schem = false;  // Schema protocollo
	$hosts = false;  // Nome per host utilizzato
	$paths = false;  // Path relativo per URL specificato
	$query = false;  // Parte query string per URL
	$style = false;  // Stile da applicare ad iframe
	$sourc = false;  // Indirizzo URL per iframe embed
	$width = false;  // Dimensione video larghezza
	$heigh = false;  // Dimensione video altezza
	$cover = false;  // Indirizzo URL della cover image
	$isize = false;  // Dimensioni per iframe

	$ports = ''; 
	$argom = array(); 
	$links = html_entity_decode($options['links']); 
	$datas = parse_url($links);

	if (isset($datas['scheme'])) $schem = $datas['scheme']; 
	if (isset($datas['host']))   $hosts = $datas['host']; 
	if (isset($datas['path']))   $paths = $datas['path']; 

	if (isset($datas['port']))   $ports = ':'.$datas['port']; 
	if (isset($datas['query']))  $query = '?'.$datas['query']; 

	/* Controllo il tipo di link URL specificato per Youtube se
	 * usato metodo tradizionale o codice URL short 
	 */
	if ($schem == 'http' or $schem == 'https') 
	{
		/* Controlli se devo modificare HTTP o HTTPS per protocollo
		 * indicato su URL specificato nello shortcode 
		 */
		if (sz_shortcode_check_enabled('protocol')) {
			if (is_ssl()) $schem = 'https'; else $schem = 'http';
		}

		$qdata = '';
		$width = trim($options['width']);
		$heigh = trim($options['heigh']);
		$coveU = trim($options['cover']);
		$aloop = trim($options['aloop']);
		$udata = trim($options['udata']);

		/* Preparazione della stringa userdata da aggiungere
		 * alla fine dell'indirizzo URL video calcolato 
		 */
		if (strlen($udata) > 0) {
			if (substr($udata,0,1) == '&') $qdata = $udata;
				else $qdata = '&amp;'.$udata;
		}

		/* Controlli specifici per YOUTUBE sia sui nomi di dominio
		 * che sul metodo di calcolare l'identificativo del video 
		 */
		if ($shortcode == 'youtube') 
		{

			if ($hosts == 'www.youtube.com') {
				parse_str(parse_url($links,PHP_URL_QUERY),$argom);
				if (isset($argom['v'])) $vidID = trim($argom['v']);  
			}

			if ($hosts == 'youtu.be') {
				if (strlen($paths)>=11) $vidID = substr($paths,1,11); 
			}

			if (strtolower($aloop == 'y')) $loops = '&amp;loop=1&amp;playlist='.$vidID;
				else $loops = '&amp;loop=0';

			if ($vidID) {
				$frame = $schem.'://www.youtube.com'.$ports.'/embed/';
				$image = $schem.'://img.youtube.com/vi/';
				$autoN = 'wmode=opaque&amp;controls=1&amp;iv_load_policy=3&amp;autoplay=0'.$loops.$qdata;
				$autoY = 'wmode=opaque&amp;controls=1&amp;iv_load_policy=3&amp;autoplay=1'.$loops.$qdata;
				$coveD = plugin_dir_url(__FILE__).'images/youtube.jpg';
//				$coveS = $image.$vidID.'/mqdefault.jpg';
				$coveS = $image.$vidID.'/maxresdefault.jpg';
			}			

		}		

		/* Controlli specifici per VIMEO sia sui nomi di dominio
		 * che sul metodo di calcolare l'identificativo del video 
		 */
		if ($shortcode == 'vimeo') 
		{

			if ($hosts == 'vimeo.com' or $hosts == 'www.vimeo.com') {
				if (strlen($paths)>=8) $vidID = substr($paths,1,8); 
			}

			if (strtolower($aloop == 'y')) $loops = '&amp;loop=1';
				else $loops = '&amp;loop=0';

			if ($vidID) 
			{
				$coveS = '';			
				$frame = $schem.'://player.vimeo.com'.$ports.'/video/';
				$autoN = 'portrait=0&amp;badge=0&amp;autoplay=0'.$loops.$qdata;
				$autoY = 'portrait=0&amp;badge=0&amp;autoplay=1'.$loops.$qdata;
				$coveD = plugin_dir_url(__FILE__).'images/vimeo.jpg';

				if (strtolower($options['metho']) == 'n' and trim($options['cover']) == '') {
					$hash = unserialize(@file_get_contents("http://vimeo.com/api/v2/video/".$vidID.".php"));
					if (isset($hash[0]["thumbnail_large"])) $coveS = $hash[0]["thumbnail_large"];
				}
			}		

		}		

		/* Controlli specifici per DAILYMOTION sia sui nomi di dominio
		 * che sul metodo di calcolare l'identificativo del video 
		 */
		if ($shortcode == 'dailymotion') 
		{

			if ($hosts == 'dailymotion.com' or $hosts == 'www.dailymotion.com') {
				if (strlen($paths)>=12) $vidID = substr($paths,7,6); 
			}

			if (strtolower($aloop == 'y')) $loops = '&amp;loop=1';
				else $loops = '&amp;loop=0';

			if ($vidID) 
			{
				$frame = $schem.'://www.dailymotion.com'.$ports.'/embed/video/';
				$image = $schem.'://www.dailymotion.com/thumbnail/video/';
				$autoN = 'autoplay=0'.$loops.$qdata;
				$autoY = 'autoplay=1'.$loops.$qdata;
				$coveD = plugin_dir_url(__FILE__).'images/dailymotion.jpg';
				$coveS = $image.$vidID;
			}

		}		
		
		/* Eseguo ulteriori calcoli solo se ho trovato video ID 
		 * altrimenti risulterebbe inutile e ritorno array a false
		 */
		if ($vidID) 
		{
			/* Calcolo immagine per cover image, se specificata per URL 
			 * o prendo quella messa a disposizione dal servizio video.
			 */
			$cover = $coveS;

			if (strlen($options['cover'])>0) {
				if($coveU <> 'default') $cover = $coveU; 
					else $cover = $coveD;
			}

			/* Se carico subito il codice embed non devo effettuare 
			 * l'operazione di autoplay altrimenti aggiungo autoplay  
			 */
			if (strtolower($options['metho']) == 'y') $embed = 'Y';
				else $embed = 'N';

			if ($query) 
			{
				$sourc = $frame.$vidID.$query.'&amp;'.$autoN;
				$playc = $frame.$vidID.$query.'&amp;'.$autoY;

			} else {
				$sourc = $frame.$vidID.'?'.$autoN;
				$playc = $frame.$vidID.'?'.$autoY;
			}

			/* Se ho specificato il valore di autoplay allora anche il link
			 * sorgente lo faccio diventare con autoplay=1 
			 */
			if (strtolower($options['aplay']) == 'y') {
				$sourc = $playc;
			}

			/* Calcolo lo stylesheet da applicare al codice IFRAME
			 * specifico da inserire come codice embed nel contenitore video 
			 */
			if (strtolower($options['respo']) == 'y') 
			{
				$isize  = '';

				$style  = 'position:absolute;';
				$style .= 'top:0;';
				$style .= 'left:0;';
				$style .= 'width:100%;';
				$style .= 'height:100%;';

			} else {

				$isize  = 'width="' .$width.'" ';
				$isize .= 'height="'.$heigh.'" ';

				$style  = 'width:' .$width.'px;';
				$style .= 'height:'.$heigh.'px;';
			}
			 	
			/* Creazione array con elementi comuni a tutte le elaborazioni
			 * che serviranno alla creazione del codice HTML specifico 
			 */
			$video = array();

			$video['id']     = $vidID;
			$video['query']  = $query;
			$video['width']  = $width;
			$video['height'] = $heigh;
			$video['style']  = $style;
			$video['source'] = $sourc;
			$video['play']   = $playc;
			$video['cover']  = $cover;
			$video['isize']  = $isize;
			$video['embed']  = $embed;
		}
	}
	
	/* Se ho trovato un video ID ritorno array con informazioni
	 * altrimenti ritorno il valore di false
	 */
	if ($vidID) return $video;
		else return false;
}