<?
function login_custom() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/sima-login-logo.png);
            background-size: 350px 80px;
        	width:350px;
        	padding-bottom:30px;
            margin-left:-10px;
        }
    </style>
<?php }
function register_my_menus() {
  register_nav_menus(
	array(
		'menu'	=>__('Menu'),
	)
	);
}
//Remove welcome widgets
remove_action('welcome_panel', 'wp_welcome_panel');

//Remove dashboard widgets
function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}

function add_jquery() {
	wp_enqueue_script(
		'custom-script',
		get_stylesheet_directory_uri() . '/js/jquery-2.1.0.min.js',
		array( 'jquery' )
	);
}

function news_pages( $query ) {
  // do not alter the query on wp-admin pages and only alter it if it's the main query
    if(is_category(4)){
      $query->set('posts_per_page', 6);
    }
  }
	 
function cut($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

function arphabet_widgets_init() {

 	register_sidebar(array(
        'name' => 'sidebar',
    	'id' => 'right',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<div class=sidebar>',
        'after_title' => '</div>',
    ));
    
	register_sidebar( array(
		'name' => 'Fisrt Footer Area',
		'id' => 'footer_left',
		'before_widget' => '<div id=widgets_footer>',
		'after_widget' => '</div>',
		'before_title' => '<div style="margin-bottom:15px; text-transform:uppercase">',
		'after_title' => '</div>',
	) );

	register_sidebar( array(
		'name' => 'Second Footer Area',
		'id' => 'footer_center',
		'before_widget' => '<div id=widgets_footer style="border-left: 1px solid #fff">',
		'after_widget' => '</div>',
		'before_title' => '<div style="margin-bottom:15px; text-transform:uppercase">',
		'after_title' => '</div>',
	) );
	
	register_sidebar( array(
		'name' => 'Third Footer Area',
		'id' => 'footer_right',
		'before_widget' => '<div id=widgets_footer style="border-left: 1px solid #fff">',
		'after_widget' => '</div>',
		'before_title' => '<div style="margin-bottom:15px; text-transform:uppercase">',
		'after_title' => '</div>',
	) );
}

function uix_login( $args = array() ) {
	$defaults = array( 'echo' => true,
						'redirect' => home_url().'/?page_id=138', // Default redirect is back to the current page
	 					'form_id' => 'loginform',
						'label_username' => __( 'Username' ),
						'label_password' => __( 'Password' ),
						'label_remember' => __( 'Remember Me' ),
						'label_log_in' => __( 'Log In' ),
						'id_username' => 'user_login',
						'id_password' => 'user_pass',
						'id_remember' => 'rememberme',
						'id_submit' => 'wp-submit',
						'remember' => true,
						'value_username' => '',
						'value_remember' => false, // Set this to true to default the "Remember me" checkbox to checked
					);
	$args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );

	$form = '
		<form name="' . $args['form_id'] . '" id="' . $args['form_id'] . '" action="' . site_url( 'wp-login.php', 'login' ) . '" method="post">
			' . apply_filters( 'login_form_top', '' ) . '
			<div class="login-username">
				<label for="' . esc_attr( $args['id_username'] ) . ' " id=username></label>
				<input type="text" placeholder="Username"  name="log" id="' . esc_attr( $args['id_username'] ) . '" class="input" value="' . esc_attr( $args['value_username'] ) . '" size="20" tabindex="10" />
			</div>
			<div class="login-password">
				<label for="' . esc_attr( $args['id_password'] ) . '"id=psw></label>
				<input type="password" placeholder="Password" name="pwd" id="' . esc_attr( $args['id_password'] ) . '" class="input" value="" size="20" tabindex="20" />
			</div>
			' . apply_filters( 'login_form_middle', '' ) . '
			' . ( $args['remember'] ? '<p class="login-remember"><label><input name="rememberme" type="checkbox" id="' . esc_attr( $args['id_remember'] ) . '" value="forever" tabindex="90"' . ( $args['value_remember'] ? ' checked="checked"' : '' ) . ' /> ' . esc_html( $args['label_remember'] ) . '</label></p>' : '' ) . '
			<div class="login-submit">
				<input type="submit" name="wp-submit" id="' . esc_attr( $args['id_submit'] ) . '" class="button-primary" value="' . esc_attr( $args['label_log_in'] ) . '" tabindex="100" />
				<input type="hidden" name="redirect_to" value="' . esc_attr( $args['redirect'] ) . '" />
			</div>
			' . apply_filters( 'login_form_bottom', '' ) . '
		</form>';

	if ( $args['echo'] )
		echo $form;
	else
		return $form;
}

function _catch_login_error($redir1, $redir2, $wperr_user)
{
    if(!is_wp_error($wperr_user) || !$wperr_user->get_error_code()) return $redir1;
 
    switch($wperr_user->get_error_code())
    {
        case 'incorrect_password' : 
        case 'empty_password':
        case 'invalid_username':
        default:
            wp_redirect(home_url()); // modify this as you wish
    }
    return $redir1;
}

//WIDGETS

// Creating the login widget  
class login_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'login_widget', 
		
		// Widget name will appear in UI
		__('Login Widget', 'login_widget_domain'), 
		
		// Widget description
		array( 'description' => __( 'Login Form', 'login_widget_domain' ), ) 
		);
	}
	
	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo "<div class=sidebar>  $title  </div>";
			
		if ( is_user_logged_in() ) {?>
			<div class=login-username >	
			<?global $current_user; get_currentuserinfo();
			echo('<p><h3>'. $current_user->user_login .'<br>benvenuto in <font color=#004aab>SI</font><font color=#f8d428>MA</font></h3></p> ');
			wp_loginout(home_url())?>
			</div>
			 <?
		}
		else {
			uix_login(array(
		        'redirect' => home_url() )
			); 
		}
		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
	if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'login_widget_domain' );
		}
		// Widget admin form
		?>
		<p>
		<label for="<? echo $this->get_field_id( 'title' ); ?>"><? _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<? echo $this->get_field_id( 'title' ); ?>" name="<? echo $this->get_field_name( 'title' ); ?>" type="text" value="<? echo esc_attr( $title ); ?>" />
		</p>
		<?
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	return $instance;
	}
} // Class login_widget ends here


class social_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'social_widget', 
		
		// Widget name will appear in UI
		__('Social', 'social_widget_domain'), 
		
		// Widget description
		array( 'description' => __( 'Add Social Link', 'login_widget_domain' ), ) 
		);
	}
	
	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'social_title', $instance['title'] );
		$face = apply_filters( 'social_face', $instance['facebook'] );
		$twit = apply_filters( 'social_twit', $instance['twit'] );
		$rss = apply_filters( 'social_rss', $instance['rss'] );
		$ytube = apply_filters( 'social_face', $instance['ytube'] );
		$inl = apply_filters( 'social_ytube', $instance['inl'] );
		$deli = apply_filters( 'social_deli', $instance['deli'] );
		$flk = apply_filters( 'social_flk', $instance['flk'] );
		// before and after widget arguments are defined by themes
		echo "<div id=social>";
		if ( ! empty( $title ) )
		echo "<div class=sidebar>  $title </div>";
			if ( ! empty( $face ) )
				echo "<a href=$face target=_blank><div id=s_face></div></a>";
			if ( ! empty( $twit ) )
				echo "<a href=$twit target=_blank><div id=s_twit></div></a>";
			if ( ! empty( $rss ) )
				echo "<a href=$rss target=_blank><div id=s_rss></div></a>";
			if ( ! empty( $ytube ) )
				echo "<a href=$ytube target=_blank><div id=s_ytube></div></a>";
			if ( ! empty( $inl ) )
				echo "<a href=$inl target=_blank><div id=s_inl></div></a>";
			if ( ! empty( $deli ) )
				echo "<a href=$deli target=_blank><div id=s_deli></div></a>";
			if ( ! empty( $flk ) )
				echo "<a href=$flk target=_blank><div id=s_flk></div></a>";
		//here code
		echo "</div>";
	}
			
	// Widget Backend 
	public function form( $instance ) {
	if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Social', 'social_widget_domain' );
		}
	if ( isset( $instance[ 'facebook' ] ) ) {
			$facebook = $instance[ 'facebook' ];
		}
	if ( isset( $instance[ 'twit' ] ) ) {
			$twit = $instance[ 'twit' ];
		}
	if ( isset( $instance[ 'rss' ] ) ) {
			$rss = $instance[ 'rss' ];
		}
	if ( isset( $instance[ 'ytube' ] ) ) {
			$ytube = $instance[ 'ytube' ];
		}
	if ( isset( $instance[ 'inl' ] ) ) {
			$inl = $instance[ 'inl' ];
		}
	if ( isset( $instance[ 'deli' ] ) ) {
			$deli = $instance[ 'deli' ];
		}
	if ( isset( $instance[ 'flk' ] ) ) {
			$flk = $instance[ 'flk' ];
		}
		
		// Widget admin form
		?>
		<p>
		<label for="<? echo $this->get_field_id( 'title' ); ?>"><? _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<? echo $this->get_field_id( 'title' ); ?>" name="<? echo $this->get_field_name( 'title' ); ?>" type="text" value="<? echo esc_attr( $title ); ?>" />
		</p>
		<p align=center><span><b>Inserisce le URL dei tuoi Social</b></span></p>
		<p>
		<label for="<? echo $this->get_field_id( 'facebook' ); ?>"><? _e( 'Facebook:' ); ?></label> 
			<input class="widefat" id="<? echo $this->get_field_id( 'facebook' ); ?>" name="<? echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<? echo esc_attr( $facebook ); ?>" />
			
		<label for="<? echo $this->get_field_id( 'twit' ); ?>"><? _e( 'Twitter:' ); ?></label> 
			<input class="widefat" id="<? echo $this->get_field_id( 'twit' ); ?>" name="<? echo $this->get_field_name( 'twit' ); ?>" type="text" value="<? echo esc_attr( $twit ); ?>" />
			
		<label for="<? echo $this->get_field_id( 'rss' ); ?>"><? _e( 'RSS:' ); ?></label> 
			<input class="widefat" id="<? echo $this->get_field_id( 'rss' ); ?>" name="<? echo $this->get_field_name( 'rss' ); ?>" type="text" value="<? echo esc_attr( $rss ); ?>" />
			
		<label for="<? echo $this->get_field_id( 'ytube' ); ?>"><? _e( 'YouTube:' ); ?></label> 
			<input class="widefat" id="<? echo $this->get_field_id( 'ytube' ); ?>" name="<? echo $this->get_field_name( 'ytube' ); ?>" type="text" value="<? echo esc_attr( $ytube ); ?>" />
			
		<label for="<? echo $this->get_field_id( 'inl' ); ?>"><? _e( 'LinkedIN:' ); ?></label> 
			<input class="widefat" id="<? echo $this->get_field_id( 'inl' ); ?>" name="<? echo $this->get_field_name( 'inl' ); ?>" type="text" value="<? echo esc_attr( $inl ); ?>" />
			
		<label for="<? echo $this->get_field_id( 'deli' ); ?>"><? _e( 'Delicius:' ); ?></label> 
			<input class="widefat" id="<? echo $this->get_field_id( 'deli' ); ?>" name="<? echo $this->get_field_name( 'deli' ); ?>" type="text" value="<? echo esc_attr( $deli ); ?>" />
			
		<label for="<? echo $this->get_field_id( 'flk' ); ?>"><? _e( 'Flickr:' ); ?></label> 
			<input class="widefat" id="<? echo $this->get_field_id( 'flk' ); ?>" name="<? echo $this->get_field_name( 'flk' ); ?>" type="text" value="<? echo esc_attr( $flk ); ?>" />
		</p>
		<?
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
	$instance['twit'] = ( ! empty( $new_instance['twit'] ) ) ? strip_tags( $new_instance['twit'] ) : '';
	$instance['rss'] = ( ! empty( $new_instance['rss'] ) ) ? strip_tags( $new_instance['rss'] ) : '';
	$instance['ytube'] = ( ! empty( $new_instance['ytube'] ) ) ? strip_tags( $new_instance['ytube'] ) : '';
	$instance['inl'] = ( ! empty( $new_instance['inl'] ) ) ? strip_tags( $new_instance['inl'] ) : '';
	$instance['deli'] = ( ! empty( $new_instance['deli'] ) ) ? strip_tags( $new_instance['deli'] ) : '';
	$instance['flk'] = ( ! empty( $new_instance['flk'] ) ) ? strip_tags( $new_instance['flk'] ) : '';
	return $instance;
	}
}

// Creating the drop-down menu widget  
class Drop_Down_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Aggiungi un menu con elementi Drop-Down') );
		parent::__construct( 'nav_menu_d', __('Drop-Down Menu'), $widget_ops );
	}

	function widget($args, $instance) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'menu_id'=>'dd_nav' ) );

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$d_menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$d_menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
		<?php
			foreach ( $d_menus as $d_menu ) {
				echo '<option value="' . $d_menu->term_id . '"'
					. selected( $nav_menu, $d_menu->term_id, false )
					. '>'. $d_menu->name . '</option>';
			}
		?>
			</select>
		</p>
		<?php
	}
}

// Register and load the widget
function load_widget() {
	register_widget( 'login_widget' );
	register_widget( 'social_widget' );
	register_widget( 'Drop_Down_Widget' );
}