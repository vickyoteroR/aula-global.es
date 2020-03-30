<?php
/**
 * Plugin Name: Easy Cookie Law
 * Description: Minimal code to help your website respect the cookie law
 * Plugin URI: https://asanchez.dev
 * Version: 3.0
 * Author: antsanchez
 * Author URI: https://asanchez.dev
 * Text Domain: easy-cookie-law
 * Domain Path: /languages
 * License: GPL2 v2.0

    Copyright 2019  Antonio Sanchez (email : antonio@asanchez.dev)

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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Include Class
include_once( plugin_dir_path( __FILE__ ) . 'functions/functions.php');
include_once( plugin_dir_path( __FILE__ ) . 'class/easy-cookie-law.php');

// Load Plugin Textdomain
function ecl_load_textdomain()
{
    load_plugin_textdomain( 'easy-cookie-law', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'ecl_load_textdomain' );


// Register Styles and Scripts
add_action( 'admin_init', 'ecl_styles_and_scripts' );
function ecl_styles_and_scripts() 
{
    wp_register_style( 'easy-cookie-law', plugins_url('/easy-cookie-law/css/ecl-style.css') );
    wp_register_script( 'easy-cookie-law', plugins_url('/easy-cookie-law/js/ecl-script.js') );
}

// Enqueue Styles
function ecl_enqueue_styles_and_scripts() 
{
    wp_enqueue_style('easy-cookie-law');
    wp_enqueue_script('easy-cookie-law', '', array(), false, true);
}

// Register Admin Page
function ecl_menu() 
{
    $page = add_options_page( 'Easy Cookie Law', 'Easy Cookie Law', 'manage_options', 'ecl_menu', 'ecl_options');
    add_action( 'admin_print_styles-' . $page, 'ecl_enqueue_styles_and_scripts' );
}
add_action('admin_menu', 'ecl_menu');

// Add Settings link
function ecl_add_settings_link($links) 
{
	$ownlinks = ['<a href="' . admin_url( 'options-general.php?page=ecl_menu' ) . '">' . __('Settings') . '</a>'];
	return array_merge($links, $ownlinks);
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'ecl_add_settings_link');

// Load Class
$ecl_plugin = new EasyCookieLaw();

/**
 * Display form, collect and save data
 */
function ecl_options() 
{    
    if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'easy-cookie-law' ) );
	}
    
    global $ecl_plugin;
    $ecl_plugin->saveOptions();
    $ecl_plugin->printForm();
}

/**
 * Cookie Notice custom function 
 */
function ecl_print_all()
{
    global $ecl_plugin;
    if( !$ecl_plugin->useWPHeadHook() )
    {
        $ecl_plugin->printNotice();
    }
}

/**
 * Cookie Notice for visitor
 */
function ecl_print_header()
{
    global $ecl_plugin;
    if( $ecl_plugin->useWPHeadHook() )
    {
        $ecl_plugin->printNotice();
    }
}
add_action('wp_head', 'ecl_print_header', 1);

/**
 * Function to print scripts after opening Body
 * This function must be manually included on the theme
 */
function ecl_print_body()
{
    global $ecl_plugin;
    echo $ecl_plugin->returnBodyScripts();
}

function ecl_is_cookie_accepted()
{
    global $ecl_plugin;
    return $ecl_plugin->is_cookie_accepted();
}

function ecl_print_div()
{
    global $ecl_plugin;
    $ecl_plugin->printFooterNotice();
}
add_action('wp_footer', 'ecl_print_div', 1);

?>
