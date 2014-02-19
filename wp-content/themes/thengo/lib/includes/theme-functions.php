<?php
$themename = THEMENAME;

global $shortname ;
// Option pages of theme
$optionpages = array (
	'templuto' => array( 'page' => 'general-options',	'name' => __('General') ),
	'templuto_blogpage' => array( 'page' => 'blogpage-options',	'name' => __('Blog')),
	'templuto_slideshow' => array( 'page' => 'slideshow-options',	'name' => __('Slideshow')),
	'templuto_nav' => array( 'page' => 'navigation-options',	'name' => __('Navigation')),
	'templuto_footer' => array( 'page' => 'footer-options',	'name' => __('Footer'))
);
	
require_once(TEMPLUTO_INC . '/wp-pagenavi.php');
require_once(TEMPLUTO_INC . '/widgets.php');
require_once(TEMPLUTO_INC . '/shortcodes.php');
require_once(TEMPLUTO_LIB . '/plugins/breadcrumbs-plus/breadcrumbs-plus.php');

function tpo_enqueue_scripts() {
	if(!is_admin()){
		 if (!wp_script_is('jquery'))  wp_enqueue_script('jquery') ;
		wp_enqueue_script( 'easing_js', TEMPLUTO_SCRIPTS .'/slidemenu.js', array('jquery'), '1');
		wp_enqueue_script( 'easing_js', TEMPLUTO_SCRIPTS .'/jquery.easing.1.3.js', array('jquery'), '1.3');
		if ( TPO_SLIDER_TYPE == 'Cycle' || TPO_SLIDER_TYPE == '' ) wp_enqueue_script( 'cycle_js', TEMPLUTO_SCRIPTS .'/jquery.cycle.all.min.js', array('jquery'));
		if ( TPO_SLIDER_TYPE == 'Nivo' ) wp_enqueue_script( 'nivo_js', TEMPLUTO_SCRIPTS .'/jquery.nivo.slider.pack.js', array('jquery'));
		wp_enqueue_script( 'colorbox_js', TEMPLUTO_SCRIPTS .'/jquery.colorbox-min.js', array('jquery'));
 		wp_enqueue_script( 'mobilemenu', TEMPLUTO_SCRIPTS . '/jquery.mobilemenu.js', array('jquery') );
 		wp_enqueue_script('tpocustom_js', TEMPLUTO_SCRIPTS .'/tpocustom.js', array('jquery'));
		wp_enqueue_script('custom_js',   get_bloginfo('template_directory')  .'/js/custom.js', array('jquery'));
	}
}

function tpo_cufonfontname(){
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
			global $tpomain;
			$fontname = $tpomain->font_name($file_content, $delimeterLeft, $delimeterRight, $debug = false);
			echo '<script type="text/javascript" >';
			if (get_option($shortname."_font_cufons") != 'true' ) {
				echo 'Cufon.replace("h1,h2,h3,h4,h5,h6", { fontFamily: "'.$fontname.'", hover: true });';
			}
			if (get_option($shortname."_font_cufonsmenu") != 'true' ) {
				echo 'Cufon.replace("#menu-top-menu", { fontFamily: "'.$fontname.'", hover: true });';
			}
			echo '</script>';
		}
	}
}
function js_code(){ ?>
	<script>
		var arrowimages={down:['downarrowclass', '<?php  bloginfo('template_directory')  ?>/images/down.png', 23], right:['rightarrowclass', '<?php  bloginfo('template_directory')  ?>/images/right.png']}
		jqueryslidemenu.buildmenu("slidemenu", arrowimages)
	</script>
  <?php
//	tpo_preloading();
	// tpo_cufonfontname();

}
function tpo_preloading() { ?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			jQuery(".image_frame").preloader();
			jQuery(".slider").preloader();
			jQuery(".blog_image").preloader();
		});
	</script>
<?php } 
function tpo_enqueue_style(){
		if(!is_admin()){
		wp_enqueue_style('cycle_css',  TEMPLUTO_URI . '/cycle.css', false, '1.0', 'all');
		wp_enqueue_style('colorbox', TEMPLUTO_CSS . '/colorbox.css', false, '1.0', 'all');
		$file_dir=TEMPLUTO_URI;
		if(TPO_USEGOOGLEFONTS == 'true'){
			wp_enqueue_style('googlefonts', 'http://fonts.googleapis.com/css?family='.TPO_GOOGLEFONT,false, '1.0', 'all');
		}

		//require_once(TEMPLATEPATH  . '/style-2.css.php');
		}
}
function tpo_admin_css_style(){
	wp_enqueue_style("functions", TEMPLUTO_URI . "/lib/css/functions.css", false, "1.0", "all");
	wp_enqueue_style("multiselect", TEMPLUTO_URI . "/lib/css/admin.multiselect.css", false, "1.0", "all");
	wp_enqueue_style("slidemenu", TEMPLUTO_URI . "/lib/css/slidemenu.css", false, "1.0", "all");
	wp_enqueue_style("colorpicker", TEMPLUTO_URI . "/lib/css/colorpicker.css", false, "1.0", "all");
	wp_enqueue_style("colorbox", TEMPLUTO_URI . "/lib/css/colorbox.css", false, "1.0", "all");
	wp_enqueue_style("iphone-checkboxes", TEMPLUTO_URI . "/lib/css/iphone-style-checkboxes.css", false, "1.0", "all");
}
			
function tpotheme_add_admin() {
	global $themename, $shortname,$optionpages;
	add_menu_page($themename, $themename, 8,'templuto', 'tpo_theme_option_pages');
	foreach($optionpages as $page => $optionpage){
		add_submenu_page('templuto', $optionpage['name']  , $optionpage['name']  , 8, $page, 'tpo_theme_option_pages');
	}
}

function tpo_adminscripts() {
		wp_enqueue_script("jquery", TEMPLUTO_URI . "/lib/scripts/jquery-1.4.3.js", false, "1.4.3");
		wp_enqueue_script("colorpicker_js", TEMPLUTO_URI . "/lib/scripts/colorpicker.js", false, "1.0");
		wp_enqueue_script('eye_js', TEMPLUTO_SCRIPTS .'/eye.js', array('jquery'));
		wp_enqueue_script("ajaxupload", TEMPLUTO_URI . "/lib/scripts/ajaxupload.3.5.js", false, "1.0");
		wp_enqueue_script("iphone-style-checkbox", TEMPLUTO_URI . "/lib/scripts/iphone-style-checkboxes.js", false, "1.0");
		if (tpo_isTemplutoURL() == true){ 
			wp_enqueue_script("jquery-ui", TEMPLUTO_URI . "/lib/scripts/jquery-ui-1.8.custom.min.js", false, "1.0");		
			wp_enqueue_script("jquery-ui-multiselect", TEMPLUTO_URI . "/lib/scripts/ui.multiselect.js", false, "1.0"); 
		}
		if ($_REQUEST['page'] == 'templuto_font') {
			wp_enqueue_script("cufonyui", TEMPLUTO_URI . "/lib/scripts/cufon-yui.js", false, "1.0");
			tpo_load_cufonfontsjs();
		}
		tpo_admin_css_style();
}

function tpo_load_cufonfontsjs(){
		 $cufon_fontpath = TEMPLUTO_PATH . '/fonts';
		 $count = 0; 
		 foreach (glob($cufon_fontpath . "/*") as $path_to_files) {
			 $count++;
			 $file_name = basename($path_to_files);
			 wp_enqueue_script("cufon_fonts-".$count, TEMPLUTO_PATH .'/fonts/'.$file_name , false, "1.0");
		 }
}
function tpo_adminscript(){ 
if (tpo_isTemplutoURL() == true){  ?>
	   	<script type="text/javascript">
				 jQuery(document).ready(function(){
				  jQuery(".multiselect").multiselect({dividerLocation: 0.5,itemCaption: 'Selected'});
				   jQuery(".tpo_admin_op :checkbox").iphoneStyle();
				 });
	    </script>
   <?php
}
}			
function tpo_front_js_code(){ 
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			jQuery(".image_frame").preloader();
			jQuery(".slider").preloader();
			jQuery(".blog_image").preloader();
		});
	</script>
  <?php
	global $shortname;
	if (get_option($shortname."_font_cufons") != 'true' || get_option($shortname."_font_cufonsmenu") != 'true'){
		$fontselected = get_option($shortname."_cufonfonts");
		$file_name = $fontselected[0];
		if($file_name) {
			$cufon_fontpath = TEMPLUTO_PATH . '/fonts';
			$path_to_file = $cufon_fontpath . "/" . $file_name;
			$file_content = file_get_contents($path_to_file); 
			$delimeterLeft = 'font-family":"';
			$delimeterRight = '"';
			global $tpomain;
			$fontname = $tpomain->font_name($file_content, $delimeterLeft, $delimeterRight, $debug = false);
			echo '<script type="text/javascript" >';
			if (get_option($shortname."_font_cufons") != 'true' ) {
				echo 'Cufon.replace("h1,h2,h3,h4,h5,h6", { fontFamily: "'.$fontname.'", hover: true });';
			}
			if (get_option($shortname."_font_cufonsmenu") != 'true' ) {
				echo 'Cufon.replace("#menu-top-menu", { fontFamily: "'.$fontname.'", hover: true });';
			}
			echo '</script>';
		}
	}
}

function enablewpmenus() {
	$nav_menus = wp_get_nav_menus();
	foreach ($nav_menus as $navv) {
		$tponavmenu[$navv -> name] = $navv -> name;
	}
	if ( function_exists( 'register_nav_menus' ) ) {
		if (is_array($tponavmenu)) {
			register_nav_menus($tponavmenu);
		}
	}
}

function tpotheme_add_init() {
		wp_enqueue_script("jquery", TEMPLUTO_URI . "/lib/scripts/jquery-1.4.3.js", false, "1.4.3");
		wp_enqueue_script("colorpicker_js", TEMPLUTO_URI . "/lib/scripts/colorpicker.js", false, "1.0");
		wp_enqueue_script('eye_js', TEMPLUTO_SCRIPTS .'/eye.js', array('jquery'));
		wp_enqueue_script("ajaxupload", TEMPLUTO_URI . "/lib/scripts/ajaxupload.3.5.js", false, "1.0");
		wp_enqueue_script("iphone-style-checkbox", TEMPLUTO_URI . "/lib/scripts/iphone-style-checkboxes.js", false, "1.0");
		if (tpo_isTemplutoURL() == true){ 
			wp_enqueue_script("jquery-ui", TEMPLUTO_URI . "/lib/scripts/jquery-ui-1.8.custom.min.js", false, "1.0");		
			wp_enqueue_script("jquery-ui-multiselect", TEMPLUTO_URI . "/lib/scripts/ui.multiselect.js", false, "1.0"); 
		}
		if ($_REQUEST['page'] == 'templuto_font') {
			wp_enqueue_script("cufonyui", TEMPLUTO_URI . "/lib/scripts/cufon-yui.js", false, "1.0");
			tpotheme_load_fontsjs();
		}
		tpo_admin_css_style();
}
function tpotheme_load_fontsjs(){
		 $cufon_fontpath = TEMPLATEPATH . '/fonts';
		 $count = 0; 
		 foreach (glob($cufon_fontpath . "/*") as $path_to_files) {
			 $count++;
			 $file_name = basename($path_to_files);
			 wp_enqueue_script("cufon_fonts-".$count, TEMPLUTO_URI .'/fonts/'.$file_name , false, "1.0");
		 }
}
function tpotheme_add_menus() {
	enablewpmenus();
}
				
if($_REQUEST['page']=='templuto_homepage'){
	add_filter('admin_head','tpo_tinymce');
}
if (($_REQUEST['page'] == 'templuto_sidebar') && $_REQUEST['sidebar'] == 'del' && $_REQUEST['name'] != '')  {
		tpo_admin_sidebar_delete();
}

function tpo_tinymce() {
	wp_admin_css('thickbox');
	wp_print_scripts('jquery-ui-core');
	wp_print_scripts('jquery-ui-tabs');
	wp_print_scripts('post');
	wp_print_scripts('editor');
	add_thickbox();
	wp_print_scripts('media-upload');
	if (function_exists('wp_tiny_mce')) wp_tiny_mce();
}
add_action('wp_print_styles', 'tpo_enqueue_style');
add_action('wp_print_scripts', 'tpo_enqueue_scripts');

/*
function templuto_page(){
	global $themename, $shortname, $options;
	$i=0;
	if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

	global $tpomain;
	echo $tpomain->tpo_admin_options_creation();
	require_once (TEMPLUTO_ADMIN . '/options_homepage.php');		
}
*/


function tpo_admin_jscode() {
	if(isset($_REQUEST['page'])) {
		if (tpo_isTemplutoURL() == true){ 
			tpo_admin_head_jscode();
		}
	}
}
function tpo_load_head() {
	tpo_impage_upload();
	if(isset($_REQUEST['page'])) {
		if ($_REQUEST['page'] == 'templuto_font'){
				 global $tpomain;
				 echo "<script type='text/javascript'>\n";
				 $cufon_fontpath = TEMPLATEPATH . '/fonts';
				 $count = 0; 
				 foreach (glob($cufon_fontpath . "/*") as $path_to_files) {
					 $count++;
					 $file_name = basename($path_to_files);
					 $file_content = file_get_contents($path_to_files);
					 $delimeterLeft = 'font-family":"';
					 $delimeterRight = '"';
					 $font_name = $tpomain->font_name($file_content, $delimeterLeft, $delimeterRight, $debug = false);
					 echo stripslashes("Cufon('#font-$count', { fontFamily: '$font_name' });\n");
				 }
				 echo "</script>\n";
		}
		if (tpo_isTemplutoURL() == true){ 
			tpo_load_head_scripts();
		}
	}
}
function tpo_impage_upload() { ?>
	<script type="text/javascript" >
		jQuery(document).ready(function(){

			jQuery('.tpo_image_upload').each(function(){
			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');
			new AjaxUpload(clickedID, {
			  action: '<?php echo admin_url("admin-ajax.php"); ?>',
			  name: clickedID, // File upload name
			  data: { // Additional data to send
					action: 'tpo_ajax_callback',
					type: 'tpo_image_upload',
					data: clickedID },
			  autoSubmit: true, // Submit file after selection
			  responseType: false,
			  onChange: function(file, extension){},
			  onSubmit: function(file, extension){
					clickedObject.text('Uploading'); // change button text, when user selects file	
					this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
					interval = window.setInterval(function(){
						var text = clickedObject.text();
						if (text.length < 13){	clickedObject.text(text + '.'); }
						else { clickedObject.text('Uploading'); } 
					}, 200);
			  },
			  onComplete: function(file, response) {
				window.clearInterval(interval);
				clickedObject.text('Upload Image');	
				this.enable(); // enable upload button
				// If there was an error
				if(response.search('Upload Error') > -1){
					var buildReturn = '<span class="upload-error">' + response + '</span>';
					jQuery(".upload-error").remove();
					clickedObject.parent().after(buildReturn);
				}
				else{
					var buildReturn = '<img class="hide" width=200 height=200 id="image_'+clickedID+'" src="'+response+'" alt="" />';
					jQuery('#' + clickedID + '_upload').val(response);
					jQuery(".upload-error").remove();
					jQuery("#image_" + clickedID).remove();	
					clickedObject.parent().after(buildReturn);
					jQuery('img#image_'+clickedID).fadeIn();
					clickedObject.next('span').fadeIn();
				}
			  }
			});
		});
			jQuery('.tpo_image_remove').click(function(){					
				var clickedObject = jQuery(this);
				var clickedID = jQuery(this).attr('id');
				var theID = jQuery(this).attr('title');	
				var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
				var data = {
					action: 'tpo_ajax_callback',
					type: 'tpo_image_remove',
					data: clickedID
				};							
				jQuery.post(ajax_url, data, function(response) {
					var clickID = clickedID.replace("remove_", '');
					var image_to_remove = jQuery('#image_'+clickID);
					var button_to_hide = jQuery('#remove_' + clickID);
					jQuery('#' + clickID + '_upload').val('');
					image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
					button_to_hide.fadeOut();
					//clickedObject.parent().prev('input').val('');
				});		
				return false; 							
			});  
		}); 
</script>
<?php
}
function tpo_load_head_scripts() {
	?>
		<style type="text/css" >
			.colorpicker input[type="text"]{
				border:none;
				background:none;
			}
		</style>
		<script type="text/javascript" >
			jQuery(document).ready(function(){
			<?php if($_REQUEST['page']=='templuto_footer') { ?>
				jQuery( "#adselectable" ).selectable({
					stop: function() {
						jQuery( ".ui-selected", this ).each(function() {
							var index = jQuery( "#adselectable li" ).index( this );
							if (index != -1){
								jQuery("#tpo_footer_layout").val(index + 1);
							}
						});
					}
				});
			<?php } ?>
			<?php if($_REQUEST['page']=='templuto_homepage') { ?>
				jQuery( "#adselectable" ).selectable({
					stop: function() {
						jQuery( ".ui-selected", this ).each(function() {
							var index = jQuery( "#adselectable li" ).index( this );
							if (index != -1){
								jQuery("#tpo_homepage_pattern").val(index + 1);
							}
						});
					}
				});
			<?php } ?>
			<?php if($_REQUEST['page']=='templuto_slideshowpage' && $_REQUEST['slide']=='edit' && $_REQUEST['slider_id'] != ''){ ?>

			<?php } else { ?>
				//jQuery('.tpoadminsubmit').hide();
				//jQuery('.tpo_adminpanelcont').slideUp();
			<?php } ?>
			<?php if($_REQUEST['page']=='TEMPLUTO' && $_REQUEST['sidebar']=='edit' && $_REQUEST['sidebar_id'] != ''){ ?>

			<?php } else { ?>
				//jQuery('.tpoadminsubmit').hide();
				//jQuery('.tpo_adminpanelcont').slideUp();
			<?php } ?>
			jQuery('.tpo_panels h3').click(function(){		
				if(jQuery(this).parent().next('.tpo_panels').css('display')=='none')
					{	jQuery(this).removeClass('inactive');
						jQuery(this).addClass('active');
						jQuery(this).children('img').removeClass('inactive');
						jQuery(this).children('img').addClass('active');
						jQuery('.tpo_admin_button').show();
					}
				else
					{	jQuery(this).removeClass('active');
						jQuery(this).addClass('inactive');		
						jQuery(this).children('img').removeClass('active');			
						jQuery(this).children('img').addClass('inactive');
					}
				jQuery(this).parent().next('.tpo_adminpanelcont').slideToggle('slow');	
				jQuery(this).parent().children('.tpoadminsubmit').slideToggle('slow');
			});
	});

	jQuery(document).ready(function(){
		jQuery('#tpo_sidebar_submit').click(function(){	
				jQuery('#tpo_savesidebar').val('true');
		});
		jQuery('.tpo_admin_button').click(function(){	
				jQuery('#tpo_savesidebar').val('false');
		});
		jQuery('#tpo_slide_submit').click(function(){	
				jQuery('#tpo_saveslide').val('true');
		});
		jQuery('.tpo_admin_button').click(function(){	
				jQuery('#tpo_saveslide').val('false');
		});
		jQuery('#tpoform').submit(function() {
			var post_url = '<?php echo admin_url("admin-ajax.php"); ?>';
			<?php if(isset($_REQUEST['page'])) { ?>
				var page_type = '<?php echo $_REQUEST['page']; ?>';
			<?php } ?>
			var dataString = jQuery("#tpoform").serialize();
				jQuery.ajax({
				type: "POST",
				url: post_url,
				data: dataString+"&type=" + page_type + "&action=tpo_ajax_callback",
				success: function(msg){
					if ( msg.trim() =='saved' || msg.trim() == 'listsaved' ) {
						var success = jQuery('#tpo-popup-save');
						var loading = jQuery('.ajax-loading-img');
						success.css("position","absolute");
						success.css("top", ( jQuery(window).height() - success.height() ) / 2+jQuery(window).scrollTop() + "px");
						success.css("left", ( jQuery(window).width() - success.width() ) / 2+jQuery(window).scrollLeft() + "px");
						loading.fadeOut();  
						success.fadeIn();
						window.setTimeout(function(){
						   success.fadeOut(); 
						   if (msg=='listsaved') {
								var url = '<?php echo home_url();  ?>/wp-admin/admin.php?page=<?php echo $_REQUEST['page'] ?>';
								window.location.href = url; 
						   }
						}, 2000); 

					} else {
						alert("Failed: " + msg);
					}
				}
			});
			return false;
		});

	});
	</script>
	<script type="text/javascript">
		 jQuery(document).ready(function(){
		  jQuery(".multiselect").multiselect({dividerLocation: 0.5,itemCaption: 'Selected'});
		   jQuery(".tpo_admin_op :checkbox").iphoneStyle();
		 });
	</script>
	<?php
}


function tpo_theme_option_pages() {
	global $themename, $shortname, $optionpages;
	require_once(TEMPLUTO_OPTIONS . '/'.$optionpages[$_REQUEST['page']]['page'].'.php'); 
	global $tpomain;
	echo $tpomain->tpo_admin_options_creation($options);
}


add_action('wp_ajax_tpo_ajax_callback', 'tpo_ajax_callback');

function tpo_ajax_callback() {
	global $wpdb,$optionpages; 		
	$save_type = $_POST['type'];
	echo isset($_POST['tpo_slide_submit']);
	if($save_type == 'tpo_image_upload'){
			$clickedID = $_POST['data']; // Acts as the name
			$filename = $_FILES[$clickedID];
			$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
			$override['test_form'] = false;
			$override['action'] = 'wp_handle_upload';    
			$uploaded_file = wp_handle_upload($filename,$override);
			$upload_tracking[] = $clickedID;
			update_option( $clickedID , $uploaded_file['url'] );
			if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
			else { echo $uploaded_file['url']; } // Is the Response
			die();	
		}
	elseif($save_type == 'tpo_image_remove'){
			$id = str_replace('remove_','',$_POST['data']); // Acts as the name
			global $wpdb;
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($query);
	die();	
	}	
	elseif(in_array($save_type, array_keys($optionpages))) {
		global $wpdb,$options,$tpomain;
		global $themename, $shortname;
		require_once(TEMPLUTO_OPTIONS . '/'.$optionpages[$save_type]['page'].'.php'); 
		if ($save_type =='templuto_font') {
			$cufonfont_options = '' ; // get_option($shortname."_cufonfonts");
			foreach($_REQUEST as $i => $rvar){
				if(substr($i,0,strlen('enable_font'))=='enable_font'){
					if ($cufonfont_options) {
						array_push($cufonfont_options,$rvar);
					} else {
						$cufonfont_options = array("0" => $rvar);
					}
				}
			}
			update_option($shortname."_cufonfonts", $cufonfont_options);
		}
		foreach ($options as $value) {
			if ($_POST[$value['id']] != '') {
				if ($value['type'] == 'multipages' || $value['type'] == 'multicategories' ) {
					$data = implode(",",$_POST[$value['id']]);
					update_option( $value['id'],$data);
				}
				elseif ($value['type']=="custom" ){
					if ($_POST['tpo_saveslide']=='true') {
					 	$slider_options = $tpomain->tpo_form_sliders_options();
					 	foreach ($slider_options as $i => $slidervalue) {
								$slider_options[$i] =  $_REQUEST[$i];
						}
						$tsp= $slider_options;
						$sl_op = get_option($value['id']);
						if(is_array($sl_op)){
							if ($slider_options[$shortname."_savetype"] == 'add') {
								$slider_options[$shortname."_slide_slider_id"] =  count($sl_op) + 1;
								array_push($sl_op,$slider_options);
							} elseif ($slider_options[$shortname."_savetype"] == 'modify') {
								$sl_op[$slider_options[$shortname."_slide_slider_id"] -1]  = $slider_options;
							}
							update_option( $value['id'],$sl_op);
							echo  "list";
						} else {
							$slider_options[$shortname."_slide_slider_id"] = "1" ;
							$tsp= array(0 => $slider_options);
							update_option( $value['id'],$tsp);
							echo  "list";
						}
					}
					if ($_POST['tpo_savesidebar']=='true') {
						$sidebar_options = get_option($shortname."_sidebarname");
						if ($sidebar_options) {
							$sidebarfound = 'false';
							foreach ($sidebar_options as $i => $sidebar) {
									if($sidebar ==  $_REQUEST[$shortname."_sidebarname"]){
										$sidebarfound = 'true';
									}
							}
							if($sidebarfound == 'false'){
								  array_push($sidebar_options,$_REQUEST[$shortname."_sidebarname"]);
							}
						} else {
							$sidebar_options = array("0" => $_REQUEST[$shortname."_sidebarname"]);
						}
						update_option($shortname."_sidebarname", $sidebar_options);
						echo  "list";
					}   
				} else {
					$data =  $_REQUEST[ $value['id'] ] ;
					update_option( $value['id'],$data);
				}
			} else {
				if ( $value['type'] != "custom" ){
					delete_option( $value['id'] ); 
				}
			}
		}
		echo  "saved";
		die();	
	}
}


function tpo_showtitle() {
	global $post;
	if ( get_post_meta ( $post->ID, '_post_title', true) != 'Hide' ) {
		return true;
	} else {
		return false;
	}
}

function tpo_getsidebartype($id) {
	$sidebartype = get_post_meta ($id, '_post_sidebar', true);
	echo $sidebartype;
	if ( !$sidebartype  ) $sidebartype = 'Right';
	if ( $sidebartype != 'Hide' ) {
		return strtolower($sidebartype) ;
	} else {
		return 'none';
	}
}

function tpo_showsidebarname() {
	global $post;
	return get_post_meta ( $post->ID, '_post_sidebarname', true);
}

function tpo_showsidebar() {
	global $post;
	$sidebartype = get_post_meta ( $post->ID, '_post_sidebar', true);
	if ( is_page() ) {
		if ( !$sidebartype  ) $sidebartype = 'none';	
	} else {
		if ( !$sidebartype  ) $sidebartype = 'Right';
	}
	if ( $sidebartype != 'Hide' ) {
		return strtolower($sidebartype) ;
	} else {
		return 'none';
	}
}

function tpo_widewidth() {
	$sidebartype = tpo_showsidebar();
	if ( $sidebartype == 'none' ) {
		$widthclass = 'fullcolumn';
	} else if ( $sidebartype == 'left' ) {
		$widthclass = 'widecolumn';
		$float = 'alignright' ;
	} else if ( $sidebartype == 'right' ) {
		$widthclass = 'widecolumn';
		$float = 'alignleft' ;
	}
	return $widthclass . ' ' . $float;
}
function tpo_indexwidewidth() {
	$sidebartype = get_option('tpo_index_sidebar');
	if ( $sidebartype == '' || $sidebartype == 'right' ) {
		$widthclass = 'widecolumn';
		$float = 'alignleft' ;
	} else if ( $sidebartype == 'left' ) {
		$widthclass = 'widecolumn';
		$float = 'alignright' ;
	}
	return $widthclass . ' ' . $float;
}
function tpo_showslider() {
	global $post;
	$show_post_slider =  get_post_meta ( $post->ID, '_post_slider', true);
	if ( !$show_post_slider ) $show_post_slider = 'Hide';
	if ( is_home() ) {
		//if ( !TPO_FEATUREHOMESLIDER ) {
			return true;	
		//}
	} else if ( is_single() ) {
		if ( $show_post_slider != 'Hide' ) {
			return true;
		} else {
			return false;
		}
	} else if ( is_page() ) {
		if ( get_post_meta ( $post->ID, '_post_slider', true) != 'Hide' ) {
			return true;
		} else {
			return false;
		}
	}
}




function tpo_slide_show() {
	if ( tpo_option('tpo_cycle_showinall') || is_home() ) {
		$slideshow = new tpo_display_slideshow();
		$slideshow->setWelcome("You can add Slides.<a href='".get_option('siteurl')."/wp-admin/edit.php?post_type=slideshow' title=''>Click here</a> to add.");
		if ( !TPO_SLIDER_TYPE || TPO_SLIDER_TYPE == 'Cycle' ) {
			$slideshow->showCycleSlider();
		} else if ( TPO_SLIDER_TYPE == 'Nivo' ) {
			$slideshow->showNivoSlider();
		}
	}
}

function show_search() { ?>
	             <div id="search">
                    <form method="get" id="searchform"  action="<?php bloginfo('url'); ?>"  >
                        <input type="text" value="Search" class="searchinput" name="s" id="s"  onblur="if (this.value == '')  {this.value = 'Search';}" onfocus="if (this.value == 'Search') {this.value = '';}">
                         <input name="post_type" type="hidden" value="post" />
                        <input id="searchbutton" type="submit" value="" />
                    </form>
                </div>  
 <?php
}


function tpo_show_nav() {
		if ( TPO_CUSTOM_MENU == 'true') {
			if (TPO_TOP_CUSTOM_NAV != '' && TPO_TOP_CUSTOM_NAV != 'None'  ) {
					wp_nav_menu( array('menu' => TPO_TOP_CUSTOM_NAV,'container_id' => 'slidemenu', 'container_class' => 'menu',  'items_wrap' => '<ul>%3$s</ul>' )); 
			} else {
				$home_current = '';
				if ( is_front_page() ) $home_current = ' current_page_item' ;
				echo '<div id="slidemenu" class="menu"><ul><li class="home' . $home_current . '"><a href="' . get_bloginfo('url') . '">' . __('Home', THEME_SLUG ). '</a></li>';
				wp_list_pages('include='. TPO_NAV_PAGES . '&title_li=&sort_column=menu_order') ;
				echo '</ul></div>';
			}
		} else {
			$home_current = '';
			if ( is_front_page() ) $home_current = ' current_page_item' ;
			echo '<div id="slidemenu" class="menu"><ul><li class="home' . $home_current . '"><a href="' . get_bloginfo('url') . '">' . __('Home', THEME_SLUG ). '</a></li>';
			wp_list_pages('include='. TPO_NAV_PAGES . '&title_li=&sort_column=menu_order') ;
			echo '</ul></div>';
		}	
}

function show_phone( $op = '' ){
	if ( TPO_PHONE || $op ) {
		if ( TPO_PHONE) {
			echo '<div id="social-wrapper-text">Call Us : ' . TPO_PHONE. '</div>';
		} else if (  $op ) {
			echo '<div id="social-wrapper-text">Call Us : ' . $op . '</div>';
		}
	}
}
function show_social_icons( $op = '' ) { 
	if ( TPO_SOCIALICONS_ONTOP  || $op ) {
?>
        <div id="social-icon-wrapper">
        <?php if ( TPO_FACEBOOK_URL != '' ) { ?>
            <div class="social-icon"><a target="_blank"  href="<?php  echo TPO_FACEBOOK_URL ; ?>" ><img src="<?php echo get_bloginfo('template_directory') ?>/images/icons/facebook.png" height="32" width="32" alt="Facebook" /></a></div>
        <?php }
           if ( TPO_TWITTER_URL != '' ) { ?>
        	<div class="social-icon"><a target="_blank" href="<?php  echo TPO_TWITTER_URL ; ?>" ><img src="<?php echo get_bloginfo('template_directory') ?>/images/icons/twitter.png"  height="32" width="32" alt="Twitter"></a></div>
        <?php }
		
           if ( TPO_LINKEDIN_URL != '' ) { ?>            
            <div class="social-icon"><a target="_blank" href="<?php  echo TPO_LINKEDIN_URL ; ?>"><img src="<?php echo get_bloginfo('template_directory') ?>/images/icons/linkedin.png" height="32" width="32" alt="Linkedin"></a></div>
         <?php }
           if ( TPO_GOOGLEPLUS_URL != '' ) { ?>
            <div class="social-icon"><a target="_blank" href="<?php  echo TPO_GOOGLEPLUS_URL ; ?>"><img src="<?php echo get_bloginfo('template_directory') ?>/images/icons/googleplus.png"  height="32" width="32" alt="Google Plus"></a></div>
        <?php }
           if ( TPO_YOUTUBE_URL != '' ) { ?>
            <div class="social-icon"><a target="_blank" href="<?php  echo TPO_YOUTUBE_URL ; ?>"><img src="<?php echo get_bloginfo('template_directory') ?>/images/icons/youtube.png"  height="32" width="32" alt="Youtube"></a></div>
        <?php }
           if ( TPO_RSS_URL != '' ) { ?>
            <div class="social-icon"><a target="_blank" href="<?php  echo TPO_RSS_URL; ?>"><img src="<?php echo get_bloginfo('template_directory') ?>/images/icons/rss.png"  height="32" width="32" alt="RSS Feed"></a></div>
       <?php } ?>
         </div>
<?php
	}
}

function tpo_admin_sidebar_delete(){
		global $themename, $shortname;
		if (($_REQUEST['page'] == 'templuto_sidebar') && $_REQUEST['sidebar'] == 'del' && $_REQUEST['name'] != '')  {
			$sidebarname = $_REQUEST['name'];
			if ($sidebarname!='') {
				$slideid--;
				$sidebars = get_option($shortname."_sidebarname");
				foreach ($sidebars as $i => $sidebar) {
					if ($sidebar==$sidebarname) {
						unset($sidebars[$i]);
					}
				}
				$sidebars = array_values($sidebars);
					update_option( $shortname."_sidebarname",$sidebars);
					wp_redirect(get_option('siteurl') . '/wp-admin/admin.php?page=templuto_sidebar');
			}
		}	
}

function tpo_HexToRGB($color)
{
    if ($color[0] == '#')
        $color = substr($color, 1);

    if (strlen($color) == 6)
        list($r, $g, $b) = array($color[0].$color[1],
                                 $color[2].$color[3],
                                 $color[4].$color[5]);
    elseif (strlen($color) == 3)
        list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
    else
        return false;

    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

    return array($r, $g, $b);
}
 
function tpo_image_resize($height,$width,$img_url) {
	if ( tpo_option('tpo_timthumb') != true ) {
		$image['url'] = $img_url;
		$image_path = explode($_SERVER['SERVER_NAME'], $image['url']);
		$image_path = $_SERVER['DOCUMENT_ROOT'] . $image_path[1];
		$image_info = @getimagesize($image_path);
		// If we cannot get the image locally, try for an external URL
		if (!$image_info)
			$image_info = @getimagesize($image['url']);
	
		$image['width'] = $image_info[0];
		$image['height'] = $image_info[1];
		if($img_url != "" && ($image['width'] > $width || $image['height'] > $height || !isset($image['width']))){
			$img_url = TEMPLUTO_THUMB . "?src=$img_url&amp;w=$width&amp;h=$height&amp;zc=1&amp;q=100";
		}
	}
	return $img_url;
}


add_action('admin_head', 'tpo_load_head');
add_action('admin_init', 'tpotheme_add_init');
add_action('admin_menu', 'tpotheme_add_admin');
add_action('admin_head', 'tpotheme_add_menus');
add_filter('admin_head','tpo_adminscript');
add_action('wp_head', 'js_code');

function templuto_widgets_init() {
	register_sidebar( array(
		'name' => __('Sidebar Right', THEME_SLUG ),
		'id' => 'sidebar_right',
		'description' => __( 'The Sidebar Area', THEME_SLUG ),
		'before_widget' => '<li id="%1$s" class="sidebar-widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => __('Sidebar Left', THEME_SLUG ),
		'id' => 'sidebar_left',
		'description' => __( 'The Sidebar Area', THEME_SLUG ),
		'before_widget' => '<li id="%1$s" class="sidebar-widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', THEME_SLUG ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', THEME_SLUG ),
		'before_widget' => '<li id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="footer-widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', THEME_SLUG ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', THEME_SLUG ),
		'before_widget' => '<li id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="footer-widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', THEME_SLUG ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', THEME_SLUG ),
		'before_widget' => '<li id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="footer-widget-title">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', THEME_SLUG ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', THEME_SLUG ),
		'before_widget' => '<li id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="footer-widget-title">',
		'after_title' => '</h2>',
	) );
	
/*	global $shortname;
	$sidebars = get_option($shortname.'_sidebarname');
	if(!empty($sidebars)){
		foreach ($sidebars as $i => $sidebar) {
			register_sidebar( array(
				'name' => __( $sidebar, THEME_SLUG ),
				'id' => $sidebar,
				'description' => __($sidebar, THEME_SLUG ),
				'before_widget' => '<li id="%1$s" class="sidebar-widget %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h3 class="sidebar-widget-title">',
				'after_title' => '</h3>',
			) );
		}
	}
*/
}
add_action( 'widgets_init', 'templuto_widgets_init' );

function get_comments_popup_link() {
	$num_comments = get_comments_number(); 
	 if ( comments_open() ){
		  if($num_comments == 0){
			  $comments = __('No Comments',THEME_SLUG);
		  }
		  elseif($num_comments > 1){
			  $comments = $num_comments.' ' . __('Comments',THEME_SLUG);
		  }
		  else{
			   $comments =__('1 Comment',THEME_SLUG);
		  }
	 $write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
	 }
	else{$write_comments = '';}
	return $write_comments;
}

function tpo_get_header_type($post_id = NULL) {
	global $post;
	if (!is_home()){
		$header_type=get_post_meta($post->ID, '_page_header_type', true);
	}
	if (is_404() || is_search() || is_archive() ){
		$header_type = 'Title & custom text';
	}
	return $header_type;
}
function tpo_get_title($post_id = NULL) {
	global $post;
	$title = get_the_title($post->ID);
	if (is_404()){
		$title = __('404 - Not Found',THEME_SLUG);
	}
	if (is_search()) {
		$title = __('Search',THEME_SLUG);
	}

	if (is_archive()){
		$title = __('Archives',THEME_SLUG);
	}
	return $title;
}
function tpo_get_title_desc($post_id = NULL) {
	global $post;
	$title_desc = get_post_meta($post->ID, '_page_headertext', true);
	if (is_404()){
		$title_desc = "Looks like the page you're looking for isn't here anymore. Try using the search box or sitemap below.";
	}
	if (is_search()) {
		$title_desc = sprintf('Search Results for: \'%s\'',stripslashes( strip_tags( get_search_query() ) ));
	}
		if (is_archive()){
			if( is_category() ) {
				$title_desc = sprintf(__('Category Archive for: \'%s\'',THEME_SLUG), single_cat_title('',false) );
			} elseif( is_day() ){
				$title_desc = sprintf(__('Daily Archive for: \'%s\'',THEME_SLUG),get_the_time('F jS, Y'));
			} elseif( is_month() ){
				$title_desc = sprintf(__('Monthly Archive for: \'%s\'',THEME_SLUG),get_the_time('F, Y'));
			} elseif( is_year() ){
				$title_desc = sprintf(__('Yearly Archive for: \'%s\'',THEME_SLUG),get_the_time('Y'));
			} elseif( isset($_GET['paged']) && !empty($_GET['paged'])) {
				$title_desc = __('Blog Archives',THEME_SLUG);
			} elseif( is_author() ){
				if(get_query_var('author_name')){
					$author = get_user_by('slug', get_query_var('author_name'));
				} else {
					$author = get_userdata(get_query_var('author'));
				}
				$title_desc = sprintf(__('Author Archive for: \'%s\'',THEME_SLUG),$curauth->nickname);
			}elseif(is_tag()){
				$title_desc = sprintf(__('Tag Archives for: \'%s\'',THEME_SLUG),single_tag_title('',false));
			}elseif(is_tax()){
				$terms = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				$title_desc = sprintf(__('Archives for: \'%s\'',THEME_SLUG),$terms->name);
			}
		}
	return $title_desc;
}
function tpo_get_title_color($post_id = NULL) {
	global $post;
	$title_fontcolor = get_post_meta($post->ID, '_pagetitlefontcolor', true);
	if ($title_fontcolor =='') {
		$fontcolor = TPO_PAGETITLE_FONTCOLOR;
	}else{
		$fontcolor = $title_fontcolor;	
	}
	return $fontcolor;
}
function tpo_get_title_background($post_id = NULL) {
	global $post;
	$title_background = get_post_meta($post->ID, '_pagetitlebackgroundcolor', true);
	if ($title_background =='') {
		$backcolor = TPO_HEADER_BACKGROUNDCOLOR;
	}else{
		$backcolor = $title_background;	
	}
	return $backcolor;
}
function tpo_the_excerpt($charlength) {
   $excerpt = get_the_excerpt();
   $charlength++;
   if(strlen($excerpt)>$charlength) {
       $subex = substr($excerpt,0,$charlength-5);
       $exwords = explode(" ",$subex);
       $excut = -(strlen($exwords[count($exwords)-1]));
       if($excut<0) {
            echo substr($subex,0,$excut);
       } else {
       	    echo $subex;
       }
       echo "...";
   } else {
	   echo $excerpt;
   }
}
function getPatternFromUrl($url){
	$url = $url.'&';
	$pattern = '/v=(.+?)&+/';
	preg_match($pattern, $url, $matches);
	return ($matches[1]);
}
function tpo_youtube_clipid($yurl){
	$pieces = explode("/", $yurl);
	$youclip = getPatternFromUrl(end($pieces));
	if ($youclip==''){
		$youclip = end($pieces);
	}
	return $youclip;
}
function tpo_breadcrumbs($post_id = NULL) {
	breadcrumbs_plus(array(
		'prefix' => '<div id="tpo_breadcrumbs">',
		'suffix' => '</div>',
		'title' => false,
		'home' => __( 'Home', THEME_SLUG ),
		'sep' => '',
		'front_page' => false,
		'bold' => false,
		'blog' => __( 'Blog', THEME_SLUG ),
		'echo' => true
	));
}

function tpo_isTemplutoURL(){
	global $optionpages;
	if(in_array($_REQUEST['page'], array_keys($optionpages))){
	    return true;
	}
}
function tpo_ga_code() {
	if (TPO_GA_CODE) {
		echo '<script type="text/javascript">';
		echo stripcslashes(TPO_GA_CODE);
		echo '</script>';
	}
}
add_action('wp_footer', 'tpo_ga_code');

function tpo_option($option) {
	return get_option($option);
}
function tpo_istheme() {
	if ('admin.php' == basename($_SERVER['PHP_SELF'])) {
		return true;
	} else {
		return false;
	}
}

function is_blog() {
	global $post;
	global $is_blog;
	if($is_blog == true){return true;}
	$blog_pageid = get_option('tpo_blogpage');
		if($blog_pageid == $post->ID){
			$is_blog = true;
			return true;
		}

	return false;
}
function tpo_author_info() { ?>
	<section id="about_the_author"> 
	<strong><?php __('About the author',THEME_SLUG); ?></strong>
	<div class="author_content">
		<div class="author-gravatar"><?php echo get_avatar( get_the_author_email(), '60' ); ?></div>
		<div class="author_info">
			<div class="author_name"><?php the_author_link(); ?></div>
			<p class="author_desc"><?php the_author_description(); ?></p>
		</div>
		<div class="clearboth"></div>
	</div>
	</section>
<?php 
	}

function show_recentposts( $count = 5, $showdate = true, $showcomment = true, $showexcerpt = true, $thumb_height = 55, $thumb_width = 55 ){
	echo do_shortcode('[recent_post count='.$count.' showdate='.$showdate.'  showcomment='.$showcomment.' showexcerpt='.$showexcerpt.' thumb_height='.$thumb_height.' thumb_width='.$thumb_width.' ]'); 
}

function displaymeta(){
	if (TPO_BLOG_SHOW_META) : 
		echo '<div class="entry_date" style="'.$border.';font-size:'.TPO_BLOG_META_FONTSIZE.'px;">';
			echo '<span class="metatext">Posded&nbsp;</span><time datetime="'.get_the_time('F jS, Y').'" class="metavalue">'.get_the_time('F jS, Y').'</time><span class="metatext">&nbsp;by&nbsp;</span><span class="metavalue" >'.get_the_author().'</span>';
		if (count( get_the_category())) :  
			echo '<span class="categories">';
			echo '<span class="metatext">&nbsp;in&nbsp;</span><span class="metavalue">' . get_the_category_list( ', ' ) ;
			echo '</span></span>';
		endif;  

		echo '</div>';
	endif;
}


function theme_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php __('Your comment is awaiting moderation.',THEME_SLUG) ?></em>
         <br />
      <?php endif; ?>
      <div class="singlecomment">
      	<div class="commentmetadata">
      		<div><?php printf(__('<span class="comment_author">%1$s</span><span class="comment_date">%2$s</span>',THEME_SLUG),get_comment_author_link(), get_comment_date()) ?></div>
	  		<?php comment_text() ?>
              <div class="reply">
                 <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
              </div>
          </div>
	  </div>
     </div>
<?php
        }
		
class responsive_walker_nav_menu extends Walker_Nav_Menu {
  

function start_lvl( &$output, $depth ) {
    // depth dependent classes
    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
    $classes = array(
        'sub-menu',
        ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
        ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
        'menu-depth-' . $display_depth
        );
    $class_names = implode( ' ', $classes );
}
  
 function start_el( &$output, $item, $depth, $args ) {
	 print_r($item);
	 echo $item->ID;
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "-", ($depth+1) ) : '' ); // code indent
  
    // depth dependent classes
    $depth_classes = array(
        ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
        ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
        ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
        'menu-item-depth-' . $depth
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
  
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
  	if ( strpos($class_names, 'current-menu-item') !== false || strpos($class_names, 'current_page_item') !== false ) {
    	$output .= '<option id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '" value="' . esc_attr( $item->url        ) .'" selected=true > ' . $indent;
	} else {
    	$output .= '<option id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '" value="' . esc_attr( $item->url        ) .'" > ' . $indent;	
	}
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
  
    $item_output = sprintf( '%1$s<div%2$s>%3$s%4$s%5$s</div>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->post_title, $item->ID ),
        $args->link_after,
        $args->after
    );
  
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}



?>
