<?
/*
 Plugin Name: Blazer Six Widget Image
 Plugin URI: 
 Description: Make customized link images banner
 Version: 0.1
 Author: Stefano Felici
 Author URI:
 License: GPL2
*/
* Copyright 2012 Francis Yaconiello (email : francis@yaconiello.com) This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License, version 2, as published by the Free Software Foundation. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA */

class WP_Widget {
    function __construct( $id_base = false, $name, $widget_options = array(), $control_options = array() ) {
    }
}

class Blazer_Six_Widget_Image extends WP_Widget {
	/**
	 * Setup widget options.
	 *
	 * Allows child classes to override the defaults.
	 *
	 * @see WP_Widget::construct()
	 */
	function __construct( $id_base = false, $name = false, $widget_options = array(), $control_options = array() ) {
		$id_base = ( $id_base ) ? $id_base : 'blazersix-widget-image';
		$name = ( $name ) ? $name : __( 'Image', 'blazersix-widget-image-i18n' );
		
		$widget_options = wp_parse_args( $widget_options, array(
			'classname'   => 'widget_image',
			'description' => __( 'An image from the media library', 'blazersix-widget-image-i18n' )
		) );
		
		$control_options = wp_parse_args( $control_options, array( 'width' => 300 ) );
		
		parent::__construct( $id_base, $name, $widget_options, $control_options );
	}
	
	/**
	 * Default widget front end display method.
	 */
	function widget( $args, $instance ) {
		// Return cached widget if it exists.
		// Filter and sanitize instance data
		$content = $this->render( $args, $instance );
		// Cache the generated content.
	}
	
	/**
	 * Generate the widget output.
	 */
	function render( $args, $instance ) {
		// Generate content.
		return $content;
	}
}
class Slide_Widget extends Blazer_Six_Widget_Image {
	/**
	 * Setup widget options.
	 */
	function __construct() {
		$widget_options = wp_parse_args( $widget_options, array(
			'classname'   => 'widget_slide',
			'description' => 'Add a slide to the homepage slider'
		) );
		
		parent::__construct( 'slide', 'Slide', $widget_options );
	}
	
	/**
	 * Generate the widget output.
	 */
	function render( $args, $instance ) {
		// Generate content.
		return $content;
	}
}