<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

// Add ScrollReveal class to body
add_filter( 'body_class','sr_class' );
function sr_class( $classes ) {
	$scroll_reveal = get_field('scrollreveal', 'option');
    if (!$scroll_reveal) {
	    $classes[] = 'no-sr';
	}
    return $classes;
}

/** Mobile Detect http://mobiledetect.net/ */
require_once('library/Mobile_Detect.php');

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Drum's functions */
require_once('library/drum-functions.php');

/** Add Drum's plugins */
require_once('library/drum-plugins.php');

/** Add TGM Plugin Activation - http://tgmpluginactivation.com/ */
require_once('library/class-tgm-plugin-activation.php');

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

// Specify Local JSON folder. This was added on 7/19/17 because of a bug preventing the JSON from saving.
function my_acf_json_load_point( $paths ) {
    unset($paths[0]);    
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}

register_post_type('products', array(	'menu_icon' => 'dashicons-screenoptions','label' => 'Products','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => true,'rewrite' => array('slug' => ''),'query_var' => true,'exclude_from_search' => false,'supports' => array('title','excerpt','revisions','thumbnail',),'labels' => array (
  'name' => 'Products',
  'singular_name' => 'Product',
  'menu_name' => 'Products',
  'add_new' => 'Add Product',
  'add_new_item' => 'Add New Product',
  'edit' => 'Edit',
  'edit_item' => 'Edit Product',
  'new_item' => 'New Product',
  'view' => 'View Product',
  'view_item' => 'View Product',
  'search_items' => 'Search Products',
  'not_found' => 'No Products Found',
  'not_found_in_trash' => 'No Products Found in Trash',
  'parent' => 'Parent Product',
),) );

register_taxonomy('guide_cats',array (
  0 => 'products',
),array( 'hierarchical' => true, 'label' => 'Categories','show_ui' => true,'query_var' => true,'rewrite' => array('slug' => ''),'singular_label' => 'Category') );

// register_taxonomy('search_cats',array (
//   0 => 'products',
// ),array( 'hierarchical' => true, 'label' => 'Product Search Categories','show_ui' => true,'query_var' => true,'rewrite' => array('slug' => ''),'singular_label' => 'Category') );

register_taxonomy('attributes',array (
  0 => 'products',
),array( 'hierarchical' => true, 'label' => 'Performance Attributes','show_ui' => true,'query_var' => true,'rewrite' => array('slug' => ''),'singular_label' => 'Attribute') );

/* register_post_type('docs', array(	'menu_icon' => 'dashicons-admin-page','label' => 'Technical Documents','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => true,'rewrite' => array('slug' => ''),'query_var' => true,'exclude_from_search' => false,'supports' => array('title','revisions',),'taxonomies' => array('guide_cats','attributes',),'labels' => array (
  'name' => 'Technical Documents',
  'singular_name' => 'Document',
  'menu_name' => 'Technical Documents',
  'add_new' => 'Add Document',
  'add_new_item' => 'Add New Document',
  'edit' => 'Edit',
  'edit_item' => 'Edit Document',
  'new_item' => 'New Document',
  'view' => 'View Document',
  'view_item' => 'View Document',
  'search_items' => 'Search Technical Documents',
  'not_found' => 'No Technical Documents Found',
  'not_found_in_trash' => 'No Technical Documents Found in Trash',
  'parent' => 'Parent Document',
),) );
*/