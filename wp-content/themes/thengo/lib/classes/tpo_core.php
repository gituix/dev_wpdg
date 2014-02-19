<?php
/**
 * class templuto_main
 *
 * @package templuto
 * @version 1.1
 */
if ( !function_exists('wp_nonce_field') ) {
        function tpo_nonce_field($action = -1) { return; }
        $wppa_nonce = -1;
} else {
		function tpo_nonce_field($action = -1,$name = 'tpo-update-check') { return wp_nonce_field($action,$name); }
		define('TPO_NONCE' , 'tpo-update-check');
}
   $googlefonts = array (
	"Allan" => "Allan:bold",
	"Anonymous Pro" => "Anonymous Pro",
	"Anonymous Pro (plus italic, bold, and bold italic)" => "Anonymous Pro:regular,italic,bold,bolditalic",
	"Allerta Stencil" => "Allerta Stencil",
	"Allerta" => "Allerta",
	"Arimo" => "Arimo",
	"Arimo (plus italic, bold, and bold italic)" => "Arimo:regular,italic,bold,bolditalic",
	"Arvo" => "Arvo",
	"Arvo (plus italic, bold, and bold italic)" => "Arvo:regular,italic,bold,bolditalic",
	"Bentham" => "Bentham",
	"Buda:light" => "Buda",
	"Cabin" => "Cabin",
	"Calligraffitti" => "Calligraffitti",
	"Cardo" => "Cardo",
	"Cantarell" => "Cantarell",
	"Cantarell (plus italic, bold, and bold italic)" => "Cantarell:regular,italic,bold,bolditalic",
	"Cardo" => "Cardo",
	"Cherry Cream Soda" => "Cherry Cream Soda",
	"Chewy" => "Chewy",
	"Coda" => "Coda",
	"Coming Soon" => "Coming Soon",
	"Copse" => "Copse",
	"Corben" => "Corben:bold",
	"Cousine" => "Cousine",
	"Cousine:regular,italic,bold,bolditalic" => "Cousine (plus italic, bold, and bold italic)",
	"Covered By Your Grace" => ">Covered By Your Grace",
	"Crafty Girls" => "Crafty Girls",
	"Crimson Text" => "Crimson Text",
	"Crushed" => "Crushed",
	"Cuprum" => "Cuprum",
	"Droid Sans" => "Droid Sans",
	"Droid Sans (plus bold)" => "Droid Sans:regular,bold",
	"Droid Sans Mono" => "Droid Sans Mono",
	"Droid Serif" => "Droid Serif",
	"Droid Serif (plus italic, bold, and bold italic)" => "Droid Serif:regular,italic,bold,bolditalic",
	"Fontdiner Swanky<" => "Fontdiner Swanky<",
	"Geo" => "Geo",
	"Gruppo" => "Gruppo",
	"Homemade Apple" => "Homemade Apple",
	"Inconsolata" => "Inconsolata",
	"IM Fell DW Pica"  => "IM Fell DW Pica",
	"IM Fell DW Pica:regular,italic"  => "IM Fell DW Pica (plus italic)",
	"IM Fell DW Pica SC"  => "IM Fell DW Pica SC",
	"IM Fell Double Pica"  => "IM Fell Double Pica",
	"IM Fell Double Pica:regular,italic"  => "IM Fell Double Pica (plus italic)",
	"IM Fell Double Pica SC"  => "IM Fell Double Pica SC",
	"IM Fell English"  => "IM Fell English",
	"IM Fell English:regular,italic"  => "IM Fell English (plus italic)",
	"IM Fell English SC"  => "IM Fell English SC",
	"IM Fell French Canon"  => "IM Fell French Canon",
	"IM Fell French Canon:regular,italic"  => "IM Fell French Canon (plus italic)",
	"IM Fell French Canon SC"  => "IM Fell French Canon SC",
	"IM Fell Great Primer"  => "IM Fell Great Primer",
	"IM Fell Great Primer:regular,italic"  => "IM Fell Great Primer (plus italic)",
	"IM Fell Great Primer SC"  => "IM Fell Great Primer SC",
	"Irish Growler"  => "Irish Growler",
	"Josefin Sans:100"  => "Josefin Sans 100",
	"Josefin Sans:100,100italic"  => "Josefin Sans 100 (plus italic)",
	"Josefin Sans:light"  => "Josefin Sans Light 300",
	"Josefin Sans:light,lightitalic"  => "Josefin Sans Light 300 (plus italic)",
	"Josefin Sans"  => "Josefin Sans Regular 400",
	"Josefin Sans:regular,regularitalic"  => "Josefin Sans Regular 400 (plus italic)",
	"Josefin Sans:600"  => "Josefin Sans 600",
	"Josefin Sans:600,600italic"  => "Josefin Sans 600 (plus italic)",
	"Josefin Sans:bold"  => "Josefin Sans Bold 700",
	"Josefin Sans:bold,bolditalic"  => "Josefin Sans Bold 700 (plus italic)",
	"Josefin Slab:100"  => "Josefin Slab 100",
	"Josefin Slab:100,100italic"  => "Josefin Slab 100 (plus italic)",
	"Josefin Slab:light"  => "Josefin Slab Light 300",
	"Josefin Slab:light,lightitalic"  => "Josefin Slab Light 300 (plus italic)",
	"Josefin Slab"  => "Josefin Slab Regular 400",
	"Josefin Slab:regular,regularitalic"  => "Josefin Slab Regular 400 (plus italic)",
	"Josefin Slab:600"  => "Josefin Slab 600",
	"Josefin Slab:600,600italic"  => "Josefin Slab 600 (plus italic)",
	"Josefin Slab:bold"  => "Josefin Slab Bold 700",
	"Josefin Slab:bold,bolditalic"  => "Josefin Slab Bold 700 (plus italic)",
	"Just Another Hand"  => "Just Another Hand",
	"Just Me Again Down Here"  => "Just Me Again Down Here",
	"Kenia"  => "Kenia",
	"Kranky"  => "Kranky",
	"Kristi"  => "Kristi",
	"Lato:100"  => "Lato 100",
	"Lato:100,100italic"  => "Lato 100 (plus italic)",
	"Lato:light"  => "Lato Light 300",
	"Lato:light,lightitalic"  => "Lato Light 300 (plus italic)",
	"Lato:regular"  => "Lato Regular 400",
	"Lato:regular,regularitalic"  => "Lato Regular 400 (plus italic)",
	"Lato:bold"  => "Lato Bold 700",
	"Lato:bold,bolditalic"  => "Lato Bold 700 (plus italic)",
	"Lato:900"  => "Lato 900",
	"Lato:900,900italic"  => "Lato 900 (plus italic)",
	"Lekton"  => " Lekton ",
	"Lekton:regular,italic,bold"  => "Lekton (plus italic and bold)",
	"Lobster"  => "Lobster",
	"Luckiest Guy"  => "Luckiest Guy",
	"Maiden Orange"  => "Maiden Orange",
	"Merriweather"  => "Merriweather",
	"Molengo"  => "Molengo",
	"Mountains of Christmas"  => "Mountains of Christmas",
	"Nobile"  => "Nobile",
	"Nobile:regular,italic,bold,bolditalic"  => "Nobile (plus italic, bold, and bold italic)",
	"Neucha"  => "Neucha",
	"Neuton"  => "Neuton",
	"OFL Sorts Mill Goudy TT"  => "OFL Sorts Mill Goudy TT",
	"OFL Sorts Mill Goudy TT:regular,italic"  => "OFL Sorts Mill Goudy TT (plus italic)",
	"Old Standard TT"  => "Old Standard TT",
	"Old Standard TT:regular,italic,bold"  => "Old Standard TT (plus italic and bold)",
	"Orbitron"  => "Orbitron Regular (400)",
	"Orbitron:500"  => "Orbitron 500",
	"Orbitron:bold"  => "Orbitron Regular (700)",
	"Orbitron:900"  => "Orbitron 900",
	"Reenie Beanie"  => "Reenie Beanie",
	"Permanent Marker"  => "Permanent Marker",
	"Philosopher"  => "Philosopher",
	"PT Sans"  => "PT Sans",
	"PT Sans:regular,italic,bold,bolditalic"  => "PT Sans (plus itlic, bold, and bold italic)",
	"PT Sans Caption"  => "PT Sans Caption",
	"PT Sans Caption:regular,bold"  => "PT Sans Caption (plus bold)",
	"PT Sans Narrow"  => "PT Sans Narrow",
	"PT Sans Narrow:regular,bold"  => "PT Sans Narrow (plus bold)",
	"Puritan"  => "Puritan",
	"Puritan:regular,italic,bold,bolditalic"  => "Puritan (plus italic, bold, and bold italic)",
	"Raleway:100"  => "Raleway",
	"Rock Salt"  => "Rock Salt",
	"Schoolbell"  => "Schoolbell",
	"Slackey"  => "Slackey",
	"Sniglet:800"  => "Sniglet",
	"Sunshiney"  => "Sunshiney",
	"Syncopate"  => "Syncopate",
	"Tangerine"  => "Tangerine",
	"Tinos"  => "Tinos",
	"Tinos:regular,italic,bold,bolditalic"  => "Tinos (plus italic, bold, and bold italic)",
	"Ubuntu"  => "Ubuntu",
	"Ubuntu:regular,italic,bold,bolditalic"  => "Ubuntu (plus italic, bold, and bold italic)",
	"Unkempt"  => "Unkempt",
	"UnifrakturCook:bold"  => "UnifrakturCook",
	"UnifrakturMaguntia"  => "UnifrakturMaguntia",
	"Vibur"  => "Vibur",
	"Vollkorn"  => "Vollkorn",
	"Vollkorn:regular,italic,bold,bolditalic"  => "Vollkorn (plus italic, bold, and bold italic)",
	"Walter Turncoat"  => "Walter Turncoat",
	"Yanone Kaffeesatz"  => "Yanone Kaffeesatz",
	"Yanone Kaffeesatz:300"  => "Yanone Kaffeesatz:300",
	"Yanone Kaffeesatz:400"  => "Yanone Kaffeesatz:400",
	"Yanone Kaffeesatz:700"  => "Yanone Kaffeesatz:700");

class Templuto {
	function hook($tag, $arg = '')
    {
        do_action('themater_' . $tag, $arg);
    }
    
    function add_hook($tag, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        add_action( 'themater_' . $tag, $function_to_add, $priority, $accepted_args );
    }
}

$hook = new Templuto();

class templuto_main {
	 public $cycleeffects = array("blindX", "blindY", "blindZ","cover", "curtainX", "curtainY","fadeZoom", "growX", "growY", "none", "scrollUp", "scrollDown","scrollLeft", "scrollRight", "scrollHorz","scrollVert", "shuffle", "slideX","slideY", "toss", "turnUp","turnDown", "turnLeft", "turnRight","uncover", "wipe", "zoom");
	
	function tpo_get_navs(){
		$nav_menus = wp_get_nav_menus();
		$tpo_navmenu['None'] = 'None';
		foreach ($nav_menus as $navv) {
			$tpo_navmenu[$navv -> name] = $navv -> name;
		}
		return $tpo_navmenu;
	}
	function tpo_get_categories(){
		$categories = get_categories('hide_empty=0&orderby=name');
		$wp_cats = array();
		foreach ($categories as $category_list ) {
			   $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
		}
		array_unshift($wp_cats, "Choose a category");
		echo $wp_cats;
	}
	function tpo_list_pages( $args = '') {

	$defaults = array(
		'depth' => 0, 'show_date' => '',
		'date_format' => get_option('date_format'),
		'child_of' => 0, 'exclude' => '',
		'title_li' => __('Pages'), 'echo' => 1,
		'authors' => '', 'sort_column' => 'menu_order, post_title',
		'link_before' => '', 'link_after' => '', 'walker' => '','type' => '',
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	$output = '';
	$current_page = 0;
	// sanitize, mostly to keep spaces out
	$r['exclude'] = preg_replace('/[^0-9,]/', '', $r['exclude']);

	// Allow plugins to filter an array of excluded pages (but don't put a nullstring into the array)
	$exclude_array = ( $r['exclude'] ) ? explode(',', $r['exclude']) : array();
	$r['exclude'] = implode( ',', apply_filters('wp_list_pages_excludes', $exclude_array) );

	// Query pages.
	$r['hierarchical'] = 0;
	$pages = get_pages($r);
	if ( !empty($pages) ) {
		if ( $r['title_li'] )
			$output .= '<li class="pagenav">' . $r['title_li'] . '<ul>';
			global $wp_query;
			if ( is_page() || is_attachment() || $wp_query->is_posts_page )
				$current_page = $wp_query->get_queried_object_id();
				$output .= walk_page_tree($pages, $r['depth'], $current_page, $r);
		if ( $r['title_li'] )
			$output .= '</ul></li>';
	}

	$output = apply_filters('wp_list_pages', $output, $r);

	if ( $r['echo'] )
		echo $output;
	else
		return $output;
	}
	
	
	function sitenav() {
		$pages = get_pages();
		$optionstring = '';
		foreach ($pages as $pagg) {
			$option = '<li>';
			$option .= '<a href="' . get_page_link($pagg->ID) . '">';
			$option .= $pagg -> post_title;
			$option .= '</a></li><li>:</li>';
			$optionstring = $optionstring . $option;
		}
		return $optionstring;
	}
	function tpo_admin_select_pages($id,$selpages='') {
		$pages = get_pages();
		if (is_array($selpages)) {
			$selpages = '';
		}
		if ($selpages != '') {
			$arr_pages =  explode(",",$selpages);
		}
		$optionstring = '<select id="' . $id . '" class="multiselect" multiple="multiple" name="' . $id . '[]">';
		foreach ($pages as $pagg) {
			if (is_array($arr_pages)) {
				if (in_array($pagg->ID, $arr_pages)) {
					$optionstring .= '<option value="'. $pagg->ID .'" selected="selected">'. $pagg -> post_title .'</option>';
				} else {
					$optionstring .=  '<option value="'. $pagg->ID .'">'. $pagg -> post_title .'</option>';	
				}
			} else {
				$optionstring .=  '<option value="'. $pagg->ID .'">'. $pagg -> post_title .'</option>';	
			}
		}
			$optionstring .= '</select>';
			return $optionstring;
	}

	function tpo_admin_select_categories($id,$selcatgories='') {
		$catgories = get_categories();
		if (is_array($selcatgories)) {
			$selcatgories = '';
		}
		if ($selcatgories != '') {
			$arr_catgories =  explode(",",$selcatgories);
		}
		$arr_catgories =  explode(",",$selcatgories);
		$optionstring = '<select id="' . $id . '" class="multiselect" multiple="multiple" name="' . $id . '[]">';
		foreach ($catgories as $pagg) {
			if (is_array($arr_catgories)) {
				if (in_array($pagg->cat_ID, $arr_catgories)) {
					$optionstring .= '<option value="'. $pagg->cat_ID .'" selected="selected">'. $pagg -> cat_name .'</option>';
				} else {
					$optionstring .=  '<option value="'. $pagg->cat_ID .'">'. $pagg -> cat_name .'</option>';	
				}
			}
		}
			$optionstring .= '</select>';
			return $optionstring;
	}
	
	function tpo_admin_options_creation($options) {
		global $themename, $shortname;
		$i=0;
		if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
		if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
		$output = '';
		$output .= '<div id="tpo_admin_wrap" class="wrap rm_wrap">';
		$output .= '<div id="tpo-popup-save" class="tpoadminajaxsave"><div class="tposaveimg">Saved Successfully</div></div>';
		$output .= '<div id="tpo-popup-reset" class="tpoadminajaxsave"><div class="tposaveimg">Options Reset</div></div>';
		$output .= '<h2>' . $themename .' Settings</h2>';
		$output .= '<div class="tpo_admin_op">';
		$output .= '<form id="tpoform" method="post">';
			foreach ($options as $value) {
				switch ( $value['type'] ) {
				case "open":
					break;
				case "close":
					$output .= '</div></div><br />';
					break;
 				case "title":
					$output .= '<p>' . TPO_MESSAGE . '</p>';
					break;
 				case 'text':
        			$output .= '<div class="tpo_admin_input">' ;
					$output .= '<label for="' . $value['id'] . '">' .$value['name'] .'</label>';
					$output .= '<input name="' . $value['id'] . '" id="' . $value['id'] . '" ' . (($value['class'] != "") ? "class=".$value['class']."" : "" ) . ' type="' . $value['type'] . '" value="' .
					 ( (get_option( $value['id'] ) != '') ?  stripslashes(get_option( $value['id'])) :  $value['std'] ) . '" />';
					 $output .= '&nbsp;' .$value['suffix'] ;
					$output .= '<small>' . $value['desc'] . '</small><div class="clearfix"></div>';
					$output .= '</div>';
					break;
 				case 'textslider':
        			$output .= '<div class="tpo_admin_input">' ;
					$output .= '<label for="' . $value['id'] . '">' .$value['name'] .'</label>';
					$output .= '<div class="slider_con" ><div id="slider_' . $value['id'] . '" class="sliderscroll" ></div><input name="' . $value['id'] . '" id="' . $value['id'] . '" class="inputscroll" type="text" value="' .
					 ( (get_option( $value['id'] ) != '') ?  stripslashes(get_option( $value['id'])) :  $value['std'] ) . '" />';
					 $output .= '&nbsp;' .$value['suffix'] .'</div>' ;
					$output .= '<small>' . $value['desc'] . '</small><div class="clearfix"></div>';
					$output .= '</div>';
						break;
				case 'textarea':
					$output .= '<div class="tpo_admin_input">';
					$output .= '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
					$output .= '<textarea name="' . $value['id'] . '" ' . (($value['class'] != "") ? "class=".$value['class'] : "" ) . '" type="' . $value['type'] . '" cols="" rows="">';
					$output .=  ( (get_option( $value['id'] ) != "") ? stripslashes(get_option( $value['id']) ) :  $value['std'] );  
					$output .= '</textarea>';
				 	$output .= '<small>' . $value['desc'] .'</small><div class="clearfix"></div>';
				 	$output .= '</div>';
					break;
				case 'select':
					$output .= '<div class="tpo_admin_input">';
					$output .= '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
					$output .= '<select name="' . $value['id'] . '" id="' . $value['id'] . '">';
					foreach ($value['options'] as $k => $option ) { 
						$output .= '<option  ' . ((get_option( $value['id'] ) == $option) ? 'selected="selected"' : '') . '>'. $option .'</option>';
					 } 
					$output .= '</select>';
				 	$output .= '<small>' . $value['desc'] .'</small><div class="clearfix"></div>';
				 	$output .= '</div>';
					break;
				case 'wselect':
					$output .= '<div class="tpo_admin_input">';
					$output .= '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
					$output .= '<select name="' . $value['id'] . '" id="' . $value['id'] . '">';
					foreach ($value['options'] as $k => $option ) { 
					
						$output .= '<option  value="'.$k.'" ' . ((get_option( $value['id'] ) == $k) ? 'selected="selected"' : '') . '>'. $option .'</option>';
					 } 
					$output .= '</select>';
				 	$output .= '<small>' . $value['desc'] .'</small><div class="clearfix"></div>';
				 	$output .= '</div>';
					break;
				case 'googlefonts':
					$output .= '<div class="tpo_admin_input">';
					$output .= '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
					$output .= '<select name="' . $value['id'] . '" id="' . $value['id'] . '">';
					$output .=  listgooglefonts(get_option($value['id']));
					$output .= '</select>';
				 	$output .= '<small>' . $value['desc'] .'</small><div class="clearfix"></div>';
				 	$output .= '</div>';
					break;
 				case "checkbox":
					$output .= '<div class="tpo_admin_input">';
					$output .= '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
					if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";}
					$output .= '<input type="checkbox" name="' . $value['id'] . '" id="' . $value['id'] . '" value="true"' . $checked .'/>';
					 $output .= '&nbsp;' .$value['suffix'] ;
				 	$output .= '<small>' . $value['desc'] .'</small><div class="clearfix"></div>';
				 	$output .= '</div>';
					break; 
				case "multipages":
					$output .= '<div class="tpo_admin_input">';
					$output .= '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
					$output .= '<div style="float:left;">';
					$output .= $this->tpo_admin_select_pages($value['id'],get_option($value['id']));
					$output .= '</div>';
				 	$output .= '<small>' . $value['desc'] .'</small><div class="clearfix"></div>';
				 	$output .= '</div>';
					break; 
				case "multicategories":
					$output .= '<div class="tpo_admin_input">';
					$output .= '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
					$output .= '<div style="float:left;">';
					$output .= $this->tpo_admin_select_categories($value['id'],get_option($value['id']));
					$output .= '</div>';
				 	$output .= '<small>' . $value['desc'] .'</small><div class="clearfix"></div>';
				 	$output .= '</div>';
					break; 
				case "section":
					$i++;
					$output .= '<div class="tpo_panels">';
					$output .= '<div class="tpo_admin_panel_title"><h3><img src="' . get_bloginfo("template_directory") . '/lib/images/trans.png" class="active" alt=""">' . $value['name'] . '</h3><span class="tpoadminsubmit"><input class="tpo_admin_button button button-primary button-large"  name="save' . $i . '" type="submit" value="Save" /></span><div class="clearfix"></div></div>';
					$output .= '<div class="tpo_adminpanelcont">';
					 break;
				case 'editor':
					$output .= '<div class="tpo_admin_input">';
					$output .= '<label style="dispaly:block;width:100%" for="' . $value['id'] . '">' . $value['name'] . '</label><br />';
					$output .= '<small style="dispaly:block;width:100%" >' . $value['desc'] .'</small><br />';
					$output .= wpeditor($value);
				 	$output .= '<div class="clearfix"></div>';
				 	$output .= '</div>';
					break;
 				case 'image':
					$output .= '<div class="tpo_admin_input rm_image">';
					$output .= '<label for="' . $value['id'] . '">' . $value['name'] . '</label>';
					$output .= '<div>';
					$output .= '<input name="' . $value['id'] . '" id="' . $value['id'] . '_upload" type="text" value="' . ( ( get_option( $value['id'] ) != "") ? stripslashes(get_option( $value['id'])) : $value['std'] ) .'" />';
					$output .= '</div>';
					$output .= '<div><span  id="' . $value['id'] . '" class="tpo_image_upload" >Upload Image</span>';
					if ( get_option( $value['id'] ) != "") { 
						$output .= '<span  id="remove_' . $value['id'] . '" class="tpo_image_remove" >Remove</span>';
					 }
					$output .= '</div>';
					if ( get_option( $value['id'] ) != "") { 
					$output .= '<img class="hide" id="image_' . $value['id'] . '"  src="' . stripslashes(get_option( $value['id'])) . '" alt="" style="">';
					} 
					$output .= '<small>' . $value['desc'] . '</small><div class="clearfix"></div>';
					$output .= '</div>';
					 break;
				case 'colorpicker':
        			$output .= '<div class="tpo_admin_input">' ;
					$output .= '<label style="padding-top:7px;" for="' . $value['id'] . '">' .$value['name'] .'</label>';
					$output .= '<input name="' . $value['id'] . '" id="' . $value['id'] . '" ' . (($value['class'] != "") ? "class=".$value['class']."" : "" ) . ' type="text" value="' .
					 ( (get_option( $value['id'] ) != '') ?  stripslashes(get_option( $value['id'])) :  $value['std'] ) . '" />';

					$output .= '<div id="cp_' . $value['id'] . '" class="cpicker"><div style="background-color: ' .
					 ( (get_option( $value['id'] ) != '') ?  stripslashes(get_option( $value['id'])) :  $value['std'] ) . ';"></div></div>';
					$output .= '<small>' . $value['desc'] . '</small><div class="clearfix"></div>';
					$output .= '</div>';
					break;
				case 'footerlayout':
	        		$output .= '<div class="tpo_admin_input">' ;
					$output .= '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="' .
					 ( (get_option( $value['id'] ) != '') ?  stripslashes(get_option( $value['id'])) :  $value['std'] ) . '" />';
					$output .= $this->$value['func']($value['id']);
					$output .= '</div>';
 					break;
				case 'patternlayout':
	        		$output .= '<div class="tpo_admin_input">' ;
					$output .= '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="' .
					 ( (get_option( $value['id'] ) != '') ?  stripslashes(get_option( $value['id'])) :  $value['std'] ) . '" />';
					$output .= $this->$value['func']($value['id']);
					$output .= '</div>';
 					break;		
				case 'custom':
	        		$output .= '<div class="tpo_admin_custom">' ;
					$output .= $this->$value['func']();
					$output .= '</div>';
 					break;
			}
		}
        $output .= '<div style="float:left;width:290px;">';
		$output .= '<input type="hidden" name="action" value="save" />';
		$output .= '</form>';
		$output .= '<form method="post">';
		$output .= '<p class="tpoadminsubmit">';
		//$output .= '<input class="tpo_admin_button" name="reset" type="submit" value="Reset" />';
	//	$output .= '<input type="hidden" name="action" value="reset" />';
		$output .= '</p>';
		$output .= '</form>';
 		$output .= '</div></div>';
		return $output;
	}
	function show_footer_layout($valueid){
		$selectedvalue = get_option($valueid) ;
		$output .= '<label>Footer layout</label>';
		$output .= '<div id="footerlayoutcontentHolder"><div class="demo">';
			$output .= '<ol id="adselectable" class="ui-selectable">';
				$output .= '<li class="ui-state-default ui-selectee '.(($selectedvalue == 1 ) ? 'ui-selected' : '').'">
				<img src="'.TEMPLUTO_IMAGES.'/footer-option-1-column.jpg" width="85" height="45" /><span>one column</span></li>';
				$output .= '<li class="ui-state-default ui-selectee '.(($selectedvalue == 2 ) ? 'ui-selected' : '').'"><img src="'.TEMPLUTO_IMAGES.'/footer-option-2-column.jpg" width="85" height="45" /><span>two column</span></li>';
				$output .= '<li class="ui-state-default ui-selectee '.(($selectedvalue == 3 ) ? 'ui-selected' : '').'"><img src="'.TEMPLUTO_IMAGES.'/footer-option-3-column.jpg" width="85" height="45" /><span>three column</span></li>';
				$output .= '<li class="ui-state-default ui-selectee '.(($selectedvalue == 4 ) ? 'ui-selected' : '').'"><img src="'.TEMPLUTO_IMAGES.'/footer-option-4-column.jpg" width="85" height="45" /><span>four column</span></li>';
				$output .= '<li class="ui-state-default ui-selectee '.(($selectedvalue == 5 ) ? 'ui-selected' : '').'"><img src="'.TEMPLUTO_IMAGES.'/footer-option-5-column.jpg" width="85" height="45" /><span>five column</span></li>';
				$output .= '<li class="ui-state-default ui-selectee '.(($selectedvalue == 6 ) ? 'ui-selected' : '').'"><img src="'.TEMPLUTO_IMAGES.'/footer-option-6-column.jpg" width="85" height="45" /><span>six column</span></li>';
				$output .= '<li class="ui-state-default ui-selectee '.(($selectedvalue == 7 ) ? 'ui-selected' : '').'"><img src="'.TEMPLUTO_IMAGES.'/footer-option-left-big-3.jpg" width="85" height="45" /><span>three column(left)</span></li>';
				$output .= '<li class="ui-state-default ui-selectee '.(($selectedvalue == 8 ) ? 'ui-selected' : '').'"><img src="'.TEMPLUTO_IMAGES.'/footer-option-left-big-4.jpg" width="85" height="45" /><span>four column(left)</span></li>';
				$output .= '<li class="ui-state-default ui-selectee '.(($selectedvalue == 9 ) ? 'ui-selected' : '').'"><img src="'.TEMPLUTO_IMAGES.'/footer-option-left-so-so-4.jpg" width="85" height="45" /><span>four column(left1)</span></li>';
				$output .= '<li class="ui-state-default ui-selectee '.(($selectedvalue == 10 ) ? 'ui-selected' : '').'"><img src="'.TEMPLUTO_IMAGES.'/footer-option-left-so-so-5.jpg" width="85" height="45" /><span>five column(left)</span></li>';
				$output .= '<li class="ui-state-default ui-selectee '.(($selectedvalue == 11) ? 'ui-selected' : '').'"><img src="'.TEMPLUTO_IMAGES.'/footer-option-right-big-3.jpg" width="85" height="45" /><span>three column(right)</span></li>';
				$output .= '<li class="ui-state-default ui-selectee '.(($selectedvalue == 12 ) ? 'ui-selected' : '').'"><img src="'.TEMPLUTO_IMAGES.'/footer-option-right-big-4.jpg" width="85" height="45" /><span>four column(right)</span></li>';
				$output .= '<li class="ui-state-default ui-selectee"><img src="'.TEMPLUTO_IMAGES.'/footer-option-right-so-so-4.jpg" width="85" height="45" /><span>four column(right1)</span></li>';
				$output .= '<li class="ui-state-default ui-selectee '.(($selectedvalue == 13 ) ? 'ui-selected' : '').'"><img src="'.TEMPLUTO_IMAGES.'/footer-option-right-so-so-5.jpg" width="85" height="45" /><span>five column(right)</span></li>';
			$output .= '</ol>';
			$output .= '</div></div>';
		return $output;
	}

	function show_pattern_layout($valueid){
		$selectedvalue = get_option($valueid) ;
		$output .= '<label>Pattern Selection</label>';
		$output .= '<div id="footerlayoutcontentHolder"><div class="demo">';
			$output .= '<ol id="adselectable" class="ui-selectable">';
			for($i=1; $i <25 ; $i++){
				$output .= '<li class="ui-state-default ui-selectee '.(($selectedvalue == $i ) ? 'ui-selected' : '').'">
				<img src="'.TEMPLUTO_IMAGES.'/pattern'.$i.'.jpg" width="85" height="45" /></li>';
			}
			$output .= '</ol>';
			$output .= '</div></div>';
		return $output;
	}


	function show_cufon_fonts() {
		$output .= '<div  style="display:block;" class="tpolist">';
		$output .= $this->show_fonts_list();
		$output .= '</div>';
		return $output ;
	}

	function show_fonts_list(){
			global $wpdb,$shortname;
			$temp_path=get_bloginfo('template_url');
			$fontselected = get_option($shortname."_cufonfonts");
			$slides = get_option($shortname.'_slide_options');
			$output .= '<h2>The following fonts were detected</h2><table class="widefat">';
			$output .= '<thead><tr>';
				$output .= '<th style="width: 5%;">Enable</th>';
				$output .= '<th style="width: 15%;">fontFamily</th>';
				$output .= '<th style="width: 15%;">File</th>';
				$output .= '<th style="width: 65%;">Preview</th>';
			 $output .= '</tr></thead>';
			 $cufon_fontpath = TEMPLATEPATH . '/fonts';
				 $count = 0; 
 				 $output .= '<tbody>';
				  foreach (glob($cufon_fontpath . "/*") as $path_to_files) {  
					 $output .= '<tr>';
					 $count++;
					 $file_name = basename($path_to_files);
					 $file_content = file_get_contents($path_to_files); 
					 $delimeterLeft = 'font-family":"';
					 $delimeterRight = '"';
					 $font_name = $this->font_name($file_content, $delimeterLeft, $delimeterRight, $debug = false);
					 $output .= '<th style="width: 5%;">';
					 if ($fontselected) {
						 if (in_array($file_name, $fontselected)) {
							 $output .= '<input name="enable_font-'.$count.'" type="checkbox" value="'.$file_name.'" checked="checked"  />';
						 }else{
							 $output .= '<input name="enable_font-'.$count.'" type="checkbox" value="'.$file_name.'" />';
						 }
					 } else {
							 $output .= '<input name="enable_font-'.$count.'" type="checkbox" value="'.$file_name.'" />'; 
					 }
					 $output .= '</th>';  
					 $output .= '<th style="width: 15%;">'.$font_name.'</th>';
					 $output .= '<th style="width: 15%;">'.$file_name.'</th>';
					 $output .= '<th style="width: 70%;"><span style="display: block; font-size: 30px;" id="font-'.$count.'">';
					 $output .= 'This is a preview of the <span style="color:  #379BFF;">'.$font_name.'</span> font. Some numbers: 0123456789 &amp; so on..</th>';
					 $output .= '</tr>'; 
					} 
				$output .= '</tbody>';
				$output .= '<tfoot>
				 <tr>
					<th style="width: 5%;">Enable</th> 
					<th style="width: 15%;">fontFamily</th>
					<th style="width: 15%;">File</th>
					<th style="width: 65%;">Preview</th>
				 </tr>
				</tfoot>
				</table>';
				return $output;
				}
			 function font_name($inputStr, $delimeterLeft, $delimeterRight, $debug = false)
			 {
				 $posLeft = strpos($inputStr, $delimeterLeft);
				 if ($posLeft === false)
				 {
					 if ($debug)
					 {
						 echo "Error: Invalid File";
					 }
					 return false;
				 }
				 $posLeft += strlen($delimeterLeft);
				 $posRight = strpos($inputStr, $delimeterRight, $posLeft);
				 if ($posRight === false)
				 {
					 if ($debug)
					 {
						 echo "Error: Invalid File";
					 }
					 return false;
				 }
				 return substr($inputStr, $posLeft, $posRight - $posLeft);
			 }

			function cufonfont_name(){
				global $shortname;
				if (get_option($shortname."_font_cufons") != 'true' || get_option($shortname."_font_cufonsmenu") != 'true'){
					$fontselected = get_option($shortname."_cufonfonts");
					$file_name = $fontselected[0];
					if($file_name) {
						$cufon_fontpath = TEMPLATEPATH . '/fonts';
						$path_to_file = $cufon_fontpath . "/" . $file_name;
						$file_content = file_get_contents($path_to_file); 
						$delimeterLeft = 'font-family":"';
						$delimeterRight = '"';
						$fontname = $this->font_name($file_content, $delimeterLeft, $delimeterRight, $debug = false);
						return $fontname;
					}
				}
			}


	function show_sidebar_options() {
		$output .= $this->tpo_form_sidebar($_GET['sidebar_id']);
		$output .= '<div class="tpolist">';
		$output .= $this->show_sidebar_list();
		$output .= '</div>';

		return $output ;
	}

	function tpo_form_sidebar(){
		global $wpdb,$shortname;
		$output .= '<p>
			<label for="tpoimageurl">Sidebar Name:</label>
			<input type="text" name="'.$shortname.'_sidebarname" id="'.$shortname.'_sidebarname" size="100" value="'.$sidebar[$shortname.'_sidebarname'].'" /><small>' . __("Enter the name of the new sidebar.", THEME_SLUG ) . '</small>
		<input type="hidden" name="'.$shortname.'_savesidebar" id="'.$shortname.'_savesidebar"  value="" /><p>';
		if ($sidebar_id != '' && $_REQUEST['slide']== 'edit') {
				$output .= '<input type="submit" name="'.$shortname.'_sidebar_submit" id="'.$shortname.'_sidebar_submit" value="Edit Slide!" />';
			} else {
				$output .= '<input type="submit" name="'.$shortname.'_sidebar_submit" id="'.$shortname.'_sidebar_submit" value="Add Slide!" />';
			}
			$output .= '</p>';
		return $output;
	}
	function show_sidebar_list(){
		global $wpdb,$shortname;
		$temp_path=get_bloginfo('template_url');
		$sidebars = get_option($shortname.'_sidebarname');
		if (!empty($sidebars)) {
			$output .= '
			<table style="margin:0px 0px 0px 180px;" >
			<thead><tr><th scope="row">&nbsp;</th><th scope="row" style="text-align:center;width=350px">' . __("Below are the created sidebars", THEME_SLUG ) . '</th><th scope="row">&nbsp;</th></tr></thead><tbody>';
		$tp_serial_id = 1;
		foreach ($sidebars as $sidebar) {
		  $output .=  '<tr><td>&nbsp;</td>';
		  $output .=  '	<td  style="padding:5px;" >'.$sidebar.'</td><td><a href="admin.php?page=templuto_sidebar&amp;sidebar=del&amp;name=' . $sidebar . '" class="delete"><img style="padding:0;margin:0;" src="' . $temp_path . '/lib/images/delete.gif" width="16" height="16" /></a></td>';			
								if ($alt == '') { $alt = ' class="alternate" '; } else { $alt = '';}
								$tp_serial_id++;
				}
			} else { 
				$output .= "No sidebar yet."; 
			}
		$output .= '</tbody></table>';
		return $output;
	}
	function show_slide_options() {
		$output .= '<div class="tpolist">';
		$output .= $this->show_slide_list();
		$output .= '</div>';
		$output .= $this->tpo_form_sliders($_GET['slider_id']);
		return $output ;
	}
	function tpo_form_sidebars_options(){
		global $shortname;
		$slider_options = 	array($shortname."_sidebarname" => "");
		return $slider_options;
	}

	function show_slide_list(){
			global $wpdb,$shortname;
			$temp_path=get_bloginfo('template_url');
			//echo $shortname.'_slide_options';
			$slides = get_option($shortname.'_slide_options');
			//print_r($slides);
			//$slides = $wpdb->get_results("SELECT * FROM wp_templuto_slides", 'ARRAY_A');
			
			if (!empty($slides)) {
			
				$output .= '
				<table class="widefat">
				<thead><tr><th scope="row" >&nbsp;</th><th scope="row"  style="text-align:center;width=350px">Image URL</th><th scope="row"  style="text-align:center;" width="300" >Link</th><th scope="row"  style="text-align:left;">Effect</th><th scope="row"  style="text-align:left;"></th></tr></thead><tbody><tr><td  colspan="10"><ul id="slide-show">';
   			$tp_serial_id = 1;
			foreach ($slides as $slide) {
				//var_dump($slide);
				  $output .=  '<li id="listItem_'.$tp_serial_id.'"><table width="100%" border="2" ><tr>
										<td width="3%" ><img src="' . $temp_path . '/lib/images/arrow.png" alt="move" width="16" height="16" class="handle" /></td>
										<td  width="3%" >' . $slide[$shortname.'_slide_slider_id'] . '</td>
										<td width="30%" ><input type="text" name="tpo_slide_imagepath" value="' . $slide[$shortname.'_slide_imageurl'] . '" class="tpo_slide_imagepath" ></td>
											<td width="30%" ><input type="text" name="tpo_slide_imagepath" value="' . $slide[$shortname.'_slide_imagelink'] . '" class="tpo_slide_imagelink" ></td>
										<td  width="20%">
											<select name="'.$shortname.'_slide_effect" id="'.$shortname.'_slide_effect" >
												' . getoptionhtml($this->cycleeffects,$slide[$shortname.'_slide_effect'])  . '
											</select>	
										</td>
										<td   width="8%"  ><a href="admin.php&#63;page=templuto_slideshowpage&amp;slide=edit&amp;slider_id=' . $slide[$shortname.'_slide_slider_id'] . '" class="edit"><img src="' . $temp_path . '/lib/images/edit.gif"  width="16" height="16" /></a></td>
										<td   width="5%"  ><a href="admin.php?page=templuto_slideshowpage&amp;slide=del&amp;slider_id=' . $slide[$shortname.'_slide_slider_id'] . '" class="delete"><img src="' . $temp_path . '/lib/images/delete.gif" width="16" height="16" /></a></td>
										</tr></table></li>
				';			
										if ($alt == '') { $alt = ' class="alternate" '; } else { $alt = '';}
										$tp_serial_id++;
									}
									
								$output .= '</ul></td></tr></tbody></table>';
							
							} else { 
								$output .= "No Slides yet."; 
							}
							return $output;
				}
				function tpo_form_sliders_options(){
					global $shortname;
					$slider_options = 	array($shortname."_slide_imageurl" => "",
						$shortname."_slide_imagelink" => "",
						$shortname."_slide_effect" => "",
						$shortname."_slide_title" => "",
					 	$shortname."_slide_description" => "",
						$shortname."_slide_order" => "",
						$shortname."_slide_slider_id" => "",
						$shortname."_savetype" => "");
					return $slider_options;
				}
				function tpo_form_sliders($slider_id){
	
					global $shortname;
						$output .= '<br /><h2>Add Slide</h2>';
						
					//	$output .= '<form id="tpoform" action="' . get_option('siteurl') . '/wp-admin/admin.php?page=templuto_slideshowpage&amp;tab=edit" method="post">';
				//$output .= '<form>';
						//wppa_nonce_field('$wppa_nonce', WPPA_NONCE);

							global $wpdb;
				//			$slides = $wpdb->get_results("SELECT * FROM wp_templuto_slides where tpo_slide_slider_id=$slider_id", ARRAY_A);
							if ($_REQUEST['slide']== 'edit') {
								$slides = get_option($shortname.'_slide_options');
							}
							if (!empty($slides)) {
								$slide =  $slides[$slider_id-1];
							}
							
							$imgurl = $slide['imageurl'];
						$output .= '<p>
								<label for="tpoimageurl">Image URL: </label>
								<input type="text" name="'.$shortname.'_slide_imageurl" id="'.$shortname.'_slide_imageurl" size="100" value="'.$slide[$shortname.'_slide_imageurl'].'" />
							</p>
						
							<p>
								<label for="tpoimagelink">Image Link: </label>
								<input type="text" name="'.$shortname.'_slide_imagelink" id="'.$shortname.'_slide_imagelink" size="100" value="'.$slide[$shortname.'_slide_imagelink'].'" />
							</p>
							<p>
								<label for="tpoeffect">Effect: </label>
								<select name="'.$shortname.'_slide_effect" id="'.$shortname.'_slide_effect" >
									' . getoptionhtml($this->cycleeffects,$slide[$shortname.'_slide_effect'])  . '
								</select>
							</p>
							<p>
								<label for="tpotitle">Title: </label>
								<input type="text" name="'.$shortname.'_slide_title" id="'.$shortname.'_slide_title" size="100" value="'.$slide[$shortname.'_slide_title'].'"  />
							</p>
							<p>
								<label for="tpodescription">Description: </label>
								<textarea rows="5" cols="60" name="'.$shortname.'_slide_description" id="'.$shortname.'_slide_description">'.$slide[$shortname.'_slide_description'].'</textarea>
							</p>
							<p>
								<label for="tporder">Order: </label>
								<input type="text" name="'.$shortname.'_slide_order" id="'.$shortname.'_slide_order" size="2" value="'.$slide[$shortname.'_slide_order'].'"   />
							</p>
								<input type="hidden" name="'.$shortname.'_slide_slider_id" id="'.$shortname.'_slide_slider_id"  value="' . $slide[$shortname.'_slide_slider_id'] . '" />
								<input type="hidden" name="'.$shortname.'_savetype" id="'.$shortname.'_savetype"  value="' . (($slider_id != '') ? 'modify' : 'add') . '" /><p>
								<input type="hidden" name="'.$shortname.'_saveslide" id="'.$shortname.'_saveslide"  value="" /><p>';
							if ($slider_id != '' && $_REQUEST['slide']== 'edit') {
								$output .= '<input type="submit" name="'.$shortname.'_slide_submit" id="'.$shortname.'_slide_submit" value="Edit Slide!" />';
							} else {
								$output .= '<input type="submit" name="'.$shortname.'_slide_submit" id="'.$shortname.'_slide_submit" value="Add Slide!" />';
							}
							$output .= '</p>';
							
						//</form>';
						return $output;
				}

	function tpo_admin_slide_delete(){
			global $themename, $shortname;
			if (($_REQUEST['page'] == 'templuto_slideshowpage') && $_REQUEST['slide'] == 'del')  {
				$slideid = $_REQUEST['slider_id'] ;
				if ($slideid!='' && $slideid > 0 ) {
					$slideid--;
					$slides = get_option($shortname."_slide_options");
					foreach ($slides as $i => $slide) {
						if ($i==$slideid) {
							unset($slides[$i]);
						}
					}
					$slides = array_values($slides);
					foreach ($slides as $i => $slide) {
						$slides[$i][$shortname."_slide_slider_id"] = $i +1;
					}
						update_option( $shortname."_slide_options",$slides  );
						wp_redirect(get_option('siteurl') . '/wp-admin/admin.php?page=templuto_slideshowpage');
				}
			}	
	}
	function tpo_admin_options_update($options) {
		global $themename, $shortname;
				if ( 'save' == $_REQUEST['action'] ) {
					foreach ($options as $value) {
						if( isset( $_REQUEST[ $value['id'] ] ) ) {
							update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
						 
						} else { 
							delete_option( $value['id'] ); 
						} 
					}
						header("Location: admin.php?page=".$_REQUEST['page']."&saved=true");
						die;
				} 
				else if( 'reset' == $_REQUEST['action'] ) {
					foreach ($options as $value) {
						delete_option( $value['id'] );
					}
					header("Location: admin.php?page=".$_REQUEST['page']."&reset=true");
					die;
				}
		
	}
}


class templuto_meta_boxes{
	var $options; 			
	//constructor
	function templuto_meta_boxes($options)
	{	
		$this->options = $options;
		$mbox = options;
		$priority = 1;
		add_action('admin_menu', array(&$this, 'initMetaBoxes'), $priority);
		add_action('save_post', array(&$this, 'save_postmeta'));
	}
	function initMetaBoxes(){
		$mbox = $this->options;
		add_meta_box( 	
			$mbox['id'], 
			$mbox['title'],
			array(&$this,'create_meta_boxes'),
			$mbox['page'], $mbox['context'], 
			$mbox['priority']
		);  
	}
    function create_meta_boxes() {
		global  $post;
		$meta_box = $this->options;
		echo '<div id="tpo_admin_wrap" >';
		echo '<div class="tpo_admin_op">';
		echo '<input type="hidden" name="tpo_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		foreach ($meta_box['fields'] as $field) {
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
			case 'text':
				$output = '';
				$output .= '<div class="tpo_post_admin_input">' ;
				$output .= '<label for="' . $field['id'] . '">' .$field['name'] .'</label>';
				$output .= '<div>' . $field['desc'] . '<br/></div><br/>';
				$output .= '<input name="' . $field['id'] . '" id="' . $field['id'] . '" ' . (($field['class'] != "") ? "class=".$field['class']."" : "" ) . ' type="' . $field['type'] . '" value="' .
				 ( $meta ? $meta : $field['std'] ) . '" />';
				 $output .= '&nbsp;' .$field['suffix'] ;
				$output .= '<div class="clearfix"></div>';
				$output .= '</div>';
				echo $output;
				break;
			case 'textarea':
					$output = '';
					$output .= '<div class="tpo_post_admin_input">';
					$output .= '<label for="' . $field['id'] . '">' . $field['name'] . '</label>';
					$output .= '<div>' . $field['desc'] . '<br/></div><br/>';
					$output .= '<textarea name="' . $field['id'] . '" ' . (($field['class'] != "") ? "class=".$field['class'] : "" ) . '" type="' . $value['type'] . '" cols="" rows="">';
					$output .=  ( $meta ? $meta : $field['std'] );  
					$output .= '</textarea>';
				 	$output .= '<div><br /><small>' . $field['desc'] . '</small></div><div class="clearfix"></div>';
				 	$output .= '</div>';
					echo $output;
					break;
			case 'select':
				$output = '';
				$output .= '<div class="tpo_post_admin_input">';
				$output .= '<label for="' . $field['id'] . '">' . $field['name'] . '</label>';
				$output .= '<div>' . $field['desc'] . '<br/></div><br/>';
				$output .= '<select name="' . $field['id'] . '" id="' . $field['id'] . '">';
				foreach ($field['options'] as $option) { 
					$output .= '<option ' . (( $meta == $option) ? 'selected="selected"' : '') . '>'. $option .'</option>';
				 } 
				$output .= '</select>';
				$output .= '</div>';
				echo $output;
				break;
			case 'colorpicker':
				$output = '';
				$output .= '<div class="tpo_post_admin_input">' ;
				$output .= '<label style="padding-top:7px;" for="' . $field['id'] . '">' .$field['name'] .'</label>';
				$output .= '<div>' . $field['desc'] . '<br/></div><br/>';
				$output .= '<input name="' . $field['id'] . '" id="' . $field['id'] . '" ' . (($field['class'] != "") ? "class=".$field['class']."" : "" ) . ' type="text" value="' .
				 ( $meta ? $meta : $field['std'] ) . '" />';
				 $output .= '&nbsp;' .$field['suffix'] ;
				$output .= '<div id="cp_tpo' . $field['id'] . '" class="cpicker"><div style="background-color: ' .
				 ( $meta ?  stripslashes($meta) :  $field['std'] ) . ';"></div></div>';
				$output .= '<div class="clearfix"></div>';
				$output .= '</div>';
				echo $output;
				break;
 			 case "checkbox":
					$output = '';
					$output .= '<div class="tpo_post_admin_input">';
					$output .= '<label for="' . $field['id'] . '">' . $field['name'] . '</label>';
					if( $meta ){ $checked = "checked=\"checked\""; }else{ $checked = "";}
					$output .= '<div>' . $field['desc'] . '<br/></div><br/>';
					$output .= '<input type="checkbox" name="' . $field['id'] . '" id="' . $field['id'] . '" ' . $checked .'/>';
				 	$output .= '<div class="clearfix"></div>';
				 	$output .= '</div>';
					echo $output;
					break; 
			case 'image':
				echo '<div class="tpo_post_admin_input">';
				echo '<label for="' . $field['id'] . '">' . $field['name'] . '</label>';
				echo '<div>' . $field['desc'] . '<br/></div><br/>';
				echo '<div>';
				echo '<input name="' . $field['id'] . '" id="' . $field['id'] . '_upload" type="text" value="' . ( $meta ? $meta : $field['std'] ) .'" />';
				echo '</div>';
				echo '<div><span  id="' . $field['id'] . '" class="tpo_image_upload" >Upload Image</span>';
				if ( $meta != "") { 
					echo '<span  id="remove_' . $field['id'] . '" class="tpo_image_remove" >Remove</span>';
				 }
				echo '</div>';
				if ( $meta != "") { 
					if (get_option('tpo_slide_width')) {
						$sliderwidth = get_option('tpo_slide_width');
						if ($sliderwidth > 400) 	$sliderwidth = 400;
					} else {
						$sliderwidth = 200;
					}
					if (get_option('tpo_slide_height')) {
						$sliderheight = get_option('tpo_slide_height');
						$sliderheight = round(($sliderwidth/get_option('tpo_slide_width'))*$sliderheight);
					} else {
						$sliderheight = 150;
					}
				$sliderimage = tpo_image_resize($height=$sliderheight, $width=$sliderwidth, stripslashes($meta));
				echo '<img class="hide"  id="image_' . $field['id'] . '"  src="' . $sliderimage. '" alt="" style="">';
				} 
				echo '<div class="clearfix"></div>';
				echo '</div>';
				 break;

		}
	}
	echo '</div></div>';
	}

	function save_postmeta($post_id) {
		$meta_box = $this->options;
		if (!wp_verify_nonce($_POST['tpo_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		
		foreach ($meta_box['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}

}

	function wpeditor($value) {
		$rows = isset($value['rows']) ? $value['rows'] : '15';
		$meta = get_option( $value['id'] );
		if (isset($meta)) {
			$value['default'] = stripslashes($meta);
		}
		$output .= '<tr><td>';
		$output .=  '<div id="poststuff"><div id="post-body"><div id="post-body-content"><div class="postarea" id="postdivrich">';
		ob_start();
		the_editor($value['default'],$value['id']);
		$output .= ob_get_contents();
		ob_end_clean();
		$output .=  '<table id="post-status-info" cellspacing="0">';
		$output .=  '<tbody><tr>';
		$output .=  '<td>&nbsp;</td>';
		$output .=  '<td>&nbsp;</td>';
		$output .=  '</tr></tbody>';
		$output .=  '</table>';
		$output .=  '</div></div></div></div>';
		$output .=  '</td></tr>';
		return $output;
	}

	function getoptionhtml($opts,$sel){
		foreach ($opts as $opt) {
			$option .= '<option ' . (($sel == $opt) ? 'selected="selected"' : '') . '>' . $opt . '</option>';
		}
		return $option;
	}
function listgooglefonts($sel_value) { 
	global $googlefonts;
	foreach ($googlefonts as $key => $value) { 
		$output .= '<option value="'.$value.'"' . (($sel_value==$value) ? 'selected="selected"' : '') . '>'. $key .'</option>';
	} 
/*$output .= '
		<option ' . ((get_option( $value['id'] ) == $option) ? 'selected="selected"' : '') . '>'. $option .'</option>
		<option value="Allan:bold">Allan</option>
		<option value="Anonymous Pro">Anonymous Pro</option>
		<option value="Anonymous Pro:regular,italic,bold,bolditalic">Anonymous Pro (plus italic, bold, and bold italic)</option>
		<option value="Allerta Stencil">Allerta Stencil</option>
		<option value="Allerta">Allerta</option>
		<option value="Arimo">Arimo</option>
		<option value="Arimo:regular,italic,bold,bolditalic">Arimo (plus italic, bold, and bold italic)</option>
		<option value="Arvo">Arvo</option>
		<option value="Arvo:regular,italic,bold,bolditalic">Arvo (plus italic, bold, and bold italic)</option>
		<option value="Bentham">Bentham</option>
		<option value="Buda:light">Buda</option>
		<option value="Cabin">Cabin</option>
		<option value="Calligraffitti">Calligraffitti</option>
		<option value="Cardo">Cardo</option>
		<option value="Cantarell">Cantarell</option>
		<option value="Cantarell:regular,italic,bold,bolditalic">Cantarell (plus italic, bold, and bold italic)</option>
		<option value="Cardo">Cardo</option>
		<option value="Cherry Cream Soda">Cherry Cream Soda</option>
		<option value="Chewy">Chewy</option>
		<option value="Coda">Coda</option>
		<option value="Coming Soon">Coming Soon</option>
		<option value="Copse">Copse</option>
		<option value="Corben:bold">Corben</option>
		<option value="Cousine">Cousine</option>
		<option value="Cousine:regular,italic,bold,bolditalic">Cousine (plus italic, bold, and bold italic)</option>
		<option value="Covered By Your Grace">Covered By Your Grace</option>
		<option value="Crafty Girls">Crafty Girls</option>
		<option value="Crimson Text">Crimson Text</option>
		<option value="Crushed">Crushed</option>
		<option value="Cuprum">Cuprum</option>
		<option value="Droid Sans">Droid Sans</option>
		<option value="Droid Sans:regular,bold">Droid Sans (plus bold)</option>
		<option value="Droid Sans Mono">Droid Sans Mono</option>
		<option value="Droid Serif">Droid Serif</option>
		<option value="Droid Serif:regular,italic,bold,bolditalic">Droid Serif (plus italic, bold, and bold italic)</option>
		<option value="Fontdiner Swanky">Fontdiner Swanky</option>
		<option value="Geo">Geo</option>
		<option value="Gruppo">Gruppo</option>
		<option value="Homemade Apple">Homemade Apple</option>
		<option value="Inconsolata">Inconsolata</option>
		<option value="IM Fell DW Pica">IM Fell DW Pica</option>
		<option value="IM Fell DW Pica:regular,italic">IM Fell DW Pica (plus italic)</option>
		<option value="IM Fell DW Pica SC">IM Fell DW Pica SC</option>
		<option value="IM Fell Double Pica">IM Fell Double Pica</option>
		<option value="IM Fell Double Pica:regular,italic">IM Fell Double Pica (plus italic)</option>
		<option value="IM Fell Double Pica SC">IM Fell Double Pica SC</option>
		<option value="IM Fell English">IM Fell English</option>
		<option value="IM Fell English:regular,italic">IM Fell English (plus italic)</option>
		<option value="IM Fell English SC">IM Fell English SC</option>
		<option value="IM Fell French Canon">IM Fell French Canon</option>
		<option value="IM Fell French Canon:regular,italic">IM Fell French Canon (plus italic)</option>
		<option value="IM Fell French Canon SC">IM Fell French Canon SC</option>
		<option value="IM Fell Great Primer">IM Fell Great Primer</option>
		<option value="IM Fell Great Primer:regular,italic">IM Fell Great Primer (plus italic)</option>
		<option value="IM Fell Great Primer SC">IM Fell Great Primer SC</option>
		<option value="Irish Growler">Irish Growler</option>
		<option value="Josefin Sans:100">Josefin Sans 100</option>
		<option value="Josefin Sans:100,100italic">Josefin Sans 100 (plus italic)</option>
		<option value="Josefin Sans:light">Josefin Sans Light 300</option>
		<option value="Josefin Sans:light,lightitalic">Josefin Sans Light 300 (plus italic)</option>
		<option value="Josefin Sans">Josefin Sans Regular 400</option>
		<option value="Josefin Sans:regular,regularitalic">Josefin Sans Regular 400 (plus italic)</option>
		<option value="Josefin Sans:600">Josefin Sans 600</option>
		<option value="Josefin Sans:600,600italic">Josefin Sans 600 (plus italic)</option>
		<option value="Josefin Sans:bold">Josefin Sans Bold 700</option>
		<option value="Josefin Sans:bold,bolditalic">Josefin Sans Bold 700 (plus italic)</option>
		<option value="Josefin Slab:100">Josefin Slab 100</option>
		<option value="Josefin Slab:100,100italic">Josefin Slab 100 (plus italic)</option>
		<option value="Josefin Slab:light">Josefin Slab Light 300</option>
		<option value="Josefin Slab:light,lightitalic">Josefin Slab Light 300 (plus italic)</option>
		<option value="Josefin Slab">Josefin Slab Regular 400</option>
		<option value="Josefin Slab:regular,regularitalic">Josefin Slab Regular 400 (plus italic)</option>
		<option value="Josefin Slab:600">Josefin Slab 600</option>
		<option value="Josefin Slab:600,600italic">Josefin Slab 600 (plus italic)</option>
		<option value="Josefin Slab:bold">Josefin Slab Bold 700</option>
		<option value="Josefin Slab:bold,bolditalic">Josefin Slab Bold 700 (plus italic)</option>
		<option value="Just Another Hand">Just Another Hand</option>
		<option value="Just Me Again Down Here">Just Me Again Down Here</option>
		<option value="Kenia">Kenia</option>
		<option value="Kranky">Kranky</option>
		<option value="Kristi">Kristi</option>
		<option value="Lato:100">Lato 100</option>
		<option value="Lato:100,100italic">Lato 100 (plus italic)</option>
		<option value="Lato:light">Lato Light 300</option>
		<option value="Lato:light,lightitalic">Lato Light 300 (plus italic)</option>
		<option value="Lato:regular">Lato Regular 400</option>
		<option value="Lato:regular,regularitalic">Lato Regular 400 (plus italic)</option>
		<option value="Lato:bold">Lato Bold 700</option>
		<option value="Lato:bold,bolditalic">Lato Bold 700 (plus italic)</option>
		<option value="Lato:900">Lato 900</option>
		<option value="Lato:900,900italic">Lato 900 (plus italic)</option>
		<option value="Lekton"> Lekton </option>
		<option value="Lekton:regular,italic,bold">Lekton (plus italic and bold)</option>
		<option value="Lobster">Lobster</option>
		<option value="Luckiest Guy">Luckiest Guy</option>
		<option value="Maiden Orange">Maiden Orange</option>
		<option value="Merriweather">Merriweather</option>
		<option value="Molengo">Molengo</option>
		<option value="Mountains of Christmas">Mountains of Christmas</option>
		<option value="Nobile">Nobile</option>
		<option value="Nobile:regular,italic,bold,bolditalic">Nobile (plus italic, bold, and bold italic)</option>
		<option value="Neucha">Neucha</option>
		<option value="Neuton">Neuton</option>
		<option value="OFL Sorts Mill Goudy TT">OFL Sorts Mill Goudy TT</option>
		<option value="OFL Sorts Mill Goudy TT:regular,italic">OFL Sorts Mill Goudy TT (plus italic)</option>
		<option value="Old Standard TT">Old Standard TT</option>
		<option value="Old Standard TT:regular,italic,bold">Old Standard TT (plus italic and bold)</option>
		<option value="Orbitron">Orbitron Regular (400)</option>
		<option value="Orbitron:500">Orbitron 500</option>
		<option value="Orbitron:bold">Orbitron Regular (700)</option>
		<option value="Orbitron:900">Orbitron 900</option>
		<option value="Reenie Beanie">Reenie Beanie</option>
		<option value="Permanent Marker">Permanent Marker</option>
		<option value="Philosopher">Philosopher</option>
		<option value="PT Sans">PT Sans</option>
		<option value="PT Sans:regular,italic,bold,bolditalic">PT Sans (plus itlic, bold, and bold italic)</option>
		<option value="PT Sans Caption">PT Sans Caption</option>
		<option value="PT Sans Caption:regular,bold">PT Sans Caption (plus bold)</option>
		<option value="PT Sans Narrow">PT Sans Narrow</option>
		<option value="PT Sans Narrow:regular,bold">PT Sans Narrow (plus bold)</option>
		<option value="Puritan">Puritan</option>
		<option value="Puritan:regular,italic,bold,bolditalic">Puritan (plus italic, bold, and bold italic)</option>
		<option value="Raleway:100">Raleway</option>
		<option value="Rock Salt">Rock Salt</option>
		<option value="Schoolbell">Schoolbell</option>
		<option value="Slackey">Slackey</option>
		<option value="Sniglet:800">Sniglet</option>
		<option value="Sunshiney">Sunshiney</option>
		<option value="Syncopate">Syncopate</option>
		<option value="Tangerine">Tangerine</option>
		<option value="Tinos">Tinos</option>
		<option value="Tinos:regular,italic,bold,bolditalic">Tinos (plus italic, bold, and bold italic)</option>
		<option value="Ubuntu">Ubuntu</option>
		<option value="Ubuntu:regular,italic,bold,bolditalic">Ubuntu (plus italic, bold, and bold italic)</option>
		<option value="Unkempt">Unkempt</option>
		<option value="UnifrakturCook:bold">UnifrakturCook</option>
		<option value="UnifrakturMaguntia">UnifrakturMaguntia</option>
		<option value="Vibur">Vibur</option>
		<option value="Vollkorn">Vollkorn</option>
		<option value="Vollkorn:regular,italic,bold,bolditalic">Vollkorn (plus italic, bold, and bold italic)</option>
		<option value="Walter Turncoat">Walter Turncoat</option>
		<option value="Yanone Kaffeesatz">Yanone Kaffeesatz</option>
		<option value="Yanone Kaffeesatz:300">Yanone Kaffeesatz:300</option>
		<option value="Yanone Kaffeesatz:400">Yanone Kaffeesatz:400</option>
		<option value="Yanone Kaffeesatz:700">Yanone Kaffeesatz:700</option>
'; */
	return $output;
	}

$tpomain = new templuto_main() ;