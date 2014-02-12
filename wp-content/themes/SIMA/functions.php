<?php
include_once 'core/theme_function.php';
$root = get_theme_root();
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );
add_image_size('features',430,250,'true');
add_image_size('post',300,160,'true');

add_action( 'login_enqueue_scripts', 'login_custom' );

add_action('wp_dashboard_setup', 'remove_dashboard_widgets', 20 );

add_action( 'init', 'register_my_menus' );

add_action( 'widgets_init', 'arphabet_widgets_init' );

$features = new WP_Query( 'cat=2' );

$last_news = new WP_Query( array('cat'=>4,'posts_per_page' => 6));

add_action( 'widgets_init', 'load_widget' );

add_action( 'wp_enqueue_scripts', 'add_jquery' );

add_action( 'pre_get_posts', 'news_pages' );

add_filter('login_redirect', '_catch_login_error', 10, 3);
