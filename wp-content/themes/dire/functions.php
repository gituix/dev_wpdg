<?php
$root = get_theme_root();
add_theme_support( 'post-thumbnails' );
add_image_size('slide',450,180,'true');
add_image_size('banner',190);
function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
        	width:323px;
            background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/images/site-login-logo.png);
			background-size: 323px;
        }
    </style>
<?php }
function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'sanita.dire.it';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

if ( function_exists('register_sidebar') ){
	 register_sidebar(array(
        'name' => 'center-sidebar',
    	'id' => 'center',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => 'left-sidebar',
    	'id' => 'left',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => 'right-sidebar',
    	'id' => 'right',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
}

// The Query
$slide = new WP_Query( 'cat=1' );

$last_news = new WP_Query( array('cat'=>1,'posts_per_page' => 5));

$forum = new WP_Query( 'cat=7' );

$banner_left = new WP_Query( 'cat=5' );

$banner_right = new WP_Query( 'cat=6' );


function news_pages( $query ) {
  // do not alter the query on wp-admin pages and only alter it if it's the main query
    if(is_category(4)){
      $query->set('posts_per_page', 7);
    }
  }
add_action( 'pre_get_posts', 'news_pages' );
    
function cut($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

add_action( 'admin_menu', 'register_my_custom_menu_page' );

function register_my_custom_menu_page(){
    add_menu_page( 'custom menu title', 'custom menu', 'manage_options', 'custompage', 'my_custom_menu_page','', 6 ); 
}

function my_custom_menu_page(){
    echo "Admin Page Test";	
}
