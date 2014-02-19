<?php
/**
 * Plugin Name: Banneruix	
 * Plugin URI: 
 * Description: Make custom banner image.
 * Version: The Plugin's Version Number, e.g.: 0.1
 * Author: Stefano Felici
 * Author URI: 
 * License: A "Slug" license name e.g. GPL2
 */
/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
 if (!class_exists('Banneruix'))
 {
 	class Banneruix
 	{
 		public function __construct()
 		{
 			add_action('admin_init', array(&$this, 'admin_init'));
 			add_action('admin_menu', array(&$this, 'add_menu'));
 		}
 		/** * Activate the plugin */
 		public static function activate()
 		{
 			
 		}
 		/** * Deactivate the plugin */
 		public static function deactivate()
 		{
 			
 		}
 		
 	}
 }
 
 if(class_exists('Banneruix')) 
 {
	 register_activation_hook(__FILE__, array('Banneruix', 'activate'));
	 
	 register_deactivation_hook(__FILE__, array('Banneruix', 'deactivate'));
	 
	 $wp_plugin_template = new Banneruix();
 }