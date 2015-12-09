<?php
/*
Plugin Name: Knapsack
Description: This plugin makes some minor adjustments to WordPress for a better experience.
Plugin URI: https://github.com/pixelpudu/knapsack
Version: 0.0.1
Author: Martin Greenwood
Author URI: https://profiles.wordpress.org/pixelpudu/
Text Domain: knapsack
Domain Path: /languages
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright 2015  Pixel Pudu  (email : office@pixelpudu.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2,
as published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

The license for this software can likely be found here:
http://www.gnu.org/licenses/gpl-2.0.html
If not, write to the Free Software Foundation Inc.
51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/


// PREVENT DIRECT ACCESS -- WE ALL HATE SCRIPT KIDDIES
if( ! defined( 'ABSPATH' ) ) exit;

// DEFINE LOCAL PLUGIN PATHS
define( 'WPBASIS_LOCATION', dirname( __FILE__ ) );
define( 'WPBASIS_LOCATION_URL', plugins_url( '', __FILE__ ) );

// REMOVE EMOJI ICONS
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// REMOVE RSD
remove_action( 'wp_head', 'rsd_link' );

// REMOVE WLW
remove_action( 'wp_head', 'wlwmanifest_link' );

// REMOVE WP GEN
remove_action( 'wp_head', 'wp_generator' );

// REMOVE FEED LINKS
remove_action(  'wp_head', 'feed_links' );

// REMOVE COMMENT CSS FROM HEAD
// PRE 2.8
function remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}
add_filter( 'wp_head', 'remove_wp_widget_recent_comments_style', 1 );


function remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action( 'widgets_init', 'remove_recent_comments_style' );