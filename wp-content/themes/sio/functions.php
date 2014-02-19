<?php
//include_once 'core/theme_function.php';
$root = get_theme_root();
function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

register_sidebar(array(
        'name' => 'sidebar',
    	'id' => 'center',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));