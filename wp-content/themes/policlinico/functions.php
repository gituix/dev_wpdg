<?php
$root = get_theme_root();
add_theme_support( 'post-thumbnails' );
add_image_size('slide',450,180,'true');
add_image_size('banner',190);
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

$last_news = new WP_Query( array('cat'=>4,'posts_per_page' => 5));

$forum = new WP_Query( 'cat=4' );

$banner_left = new WP_Query( 'cat=6' );

$banner_right = new WP_Query( 'cat=5' );


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
