<?php
/* ************************************************************************** */
/* Controllo se definita la costante del plugin                               */
/* ************************************************************************** */
if (!defined('SZ_PLUGIN_VIDEO') or !SZ_PLUGIN_VIDEO) die();

/* ************************************************************************** */ 
/* SZ_Widget_SZ_Video - Inserimento video sulla sidebar come widget           */ 
/* ************************************************************************** */ 
class SZ_Widget_SZ_Video extends WP_Widget 
{
	/* Costruttore principale della classe widget, definizione 
	 * delle opzioni legate al widget e al controllo dello stesso
	 */
	function SZ_Widget_SZ_Video() {
		$widget_ops  = array(
			'classname'   => 'widget-sz-video', 
			'description' => __('Widget for SZ-Video plugin','szvideoadmin')
		);
		$this->WP_Widget('SZ-Video',__('SZ-Video','szvideoadmin'),$widget_ops);
	}

	/* Funzione per la visualizzazione del widget con lettura parametri
	 * di configurazione e preparazione codice HTML da usare nella sidebar
	 */
	function widget($args,$instance) 
	{
		extract($args);

		// Costruzione del titolo del widget

		if (empty($instance['title'])) $title = '';
			else $title = trim($instance['title']);

		$title = apply_filters('widget_title',$title,$instance,$this->id_base);

		if (!isset($before_title)) $before_title = '';
		if (!isset($after_title))  $after_title = '';

		if ($title and $title <> '') {
			$title = $before_title.$title.$after_title;
		}

		// Costruzione dei parametri specificati per video

		if (empty($instance['url'])) $url = '';
			else $url = trim($instance['url']);

		if (empty($instance['cover'])) $cover = '';
			else $cover = trim($instance['cover']);

		if (empty($instance['method'])) $method = 'Y';
			else $method = trim($instance['method']);

		if (empty($instance['userdata'])) $userdata = '';
			else $userdata = trim($instance['userdata']);

		// Definizione shortcode da eseguire come widget e
   	// inserimento del video nella sidebar indicata nella sezione admin

		$codiceSHC  = '[sz-video ';
		$codiceSHC .= 'url="'.$url.'" ';
		$codiceSHC .= 'cover="'.$cover.'" ';
		$codiceSHC .= 'method="'.$method.'" ';
		$codiceSHC .= 'userdata="'.$userdata.'" ';
		$codiceSHC .= 'responsive="Y" ';
		$codiceSHC .=	 'margintop="0" ';
		$codiceSHC .=	 'marginright="0" ';
		$codiceSHC .=	 'marginbottom="0" ';
		$codiceSHC .=	 'marginleft="0" ';
		$codiceSHC .= '/]';

		$shortcode  = do_shortcode($codiceSHC);

		// Output del codice HTML legato al widget con indentatura e  
		// operazioni speciali legate ai parametri di configurazione		 

		$output  = '';
		$output .= $before_widget;
		$output .= $title;
		$output .= $shortcode;
		$output .= $after_widget;

		echo $output;
	}

	/* Funzione per modifica parametri collegati al widget con 
	 * memorizzazione dei valori direttamente nel database wordpress
	 */
	function update($new_instance,$old_instance) 
	{
		$instance = $old_instance;
		$instance['title']    = strip_tags($new_instance['title']);
		$instance['url']      = trim($new_instance['url']);
		$instance['cover']    = trim($new_instance['cover']);
		$instance['method']   = trim($new_instance['method']);
		$instance['userdata'] = trim($new_instance['userdata']);
		return $instance;
	}

	/* Funzione per la visualizzazione del form presente sulle 
	 * sidebar nel pannello di amministrazione di wordpress
	 */
	function form($instance) 
	{
		$array    = array(
			'title'    => '',
			'url'      => '',
			'cover'    => '',
			'method'   => '',
			'userdata' => '',
		);

		$instance = wp_parse_args((array) $instance,$array);
		$title    = strip_tags($instance['title']);
		$url      = trim($instance['url']);
		$cover    = trim($instance['cover']);
		$method   = trim($instance['method']);
		$userdata = trim($instance['userdata']);

		echo '<p><label for="'.$this->get_field_id('title').'">'.__('Title:','szvideoadmin').'</label>';
		echo '<input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.esc_attr($title).'"/></p>';
		echo '<p><label for="'.$this->get_field_id('url').'">'.__('URL:','szvideoadmin').'</label>';
		echo '<input class="widefat" id="'.$this->get_field_id('url').'" name="'.$this->get_field_name('url').'" type="text" value="'.esc_attr($url).'"/></p>';	
		echo '<p><label for="'.$this->get_field_id('cover').'">'.__('Cover:','szvideoadmin').'</label>';
		echo '<input class="widefat" id="'.$this->get_field_id('cover').'" name="'.$this->get_field_name('cover').'" type="text" value="'.esc_attr($cover).'"/></p>';	
		echo '<p><label for="'.$this->get_field_id('method').'">'.__('Method:','szvideoadmin').'</label>';
		echo '<select class="widefat" id="'.$this->get_field_id('method').'" name="'.$this->get_field_name('method').'">';
		echo '<option value="N" '; selected("N",$method); echo '>'.__('Embed code delayed','szvideoadmin').'</option>';
		echo '<option value="Y" '; selected("Y",$method); echo '>'.__('Embed code immed','szvideoadmin').'</option>';
		echo '</select></p>';
		echo '<p><label for="'.$this->get_field_id('userdata').'">'.__('User Data:','szvideoadmin').'</label>';
		echo '<input class="widefat" id="'.$this->get_field_id('userdata').'" name="'.$this->get_field_name('userdata').'" type="text" value="'.esc_attr($userdata).'"/></p>';	
	}

}

/* Registrazione di tutti i widget precedentemente definiti 
 * per la registrazione su wordpress e utilizzo nelle sidebar */
add_action('widgets_init', create_function('', 'return register_widget("SZ_Widget_SZ_Video");'));
