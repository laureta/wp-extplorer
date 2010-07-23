<?php
/*
Plugin Name: wp-eXtplorer
Plugin URI: http://kulendra.net/Wordpress-Extensions/wp-extplorer.html
Description: wp-eXtplorer is a port of the popular eXtplorer extension by Soeren into Wordpress. wp-eXtplorer allows admin users to easily manage the files and folders on their webserver.
Version: 1.0-beta
Author: Kulendra 'KJ' Janaka
Author URI: http://kulendra.net/
License: GPL2
*/

add_action( 'admin_menu', wp_eXtplorer_register_menu);
if(!defined('DS')){
	define('DS',DIRECTORY_SEPARATOR);
}

function wp_eXtplorer_register_menu() {
	$path = get_option('home').DS.'wp-content'.DS.'plugins'.DS.'wp-eXtplorer'.DS;
	add_menu_page('wp-Extplorer', 'wp-Extplorer', 'edit_files', 'wp-eXtplorer','wp_eXtplorer_admin',$path.'wp-eXtplorer.ico'); 
}

function wp_eXtplorer_admin() {
	include ('helpers/iframe.php');
}
?>
