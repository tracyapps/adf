<?php
// add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
// function enqueue_parent_styles() {
//    wp_enqueue_style( 'buddyxpro-style', get_template_directory_uri().'/style.css' );
// }


/*
 * for some reason, buddy X pro tries to load a stylesheet that doesn't exist. so this is to fix that.
 */
add_action('wp_enqueue_scripts','dequeue_css_not_found', 10);
function dequeue_css_not_found() {
	wp_dequeue_style('styles');
	wp_deregister_style('styles');
}


add_action( 'wp_enqueue_scripts', 'adf_enqueue_child_theme_styles' );
function adf_enqueue_child_theme_styles() {
	$parenthandle = 'buddyxpro';
	wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'buddyxpro-child', get_stylesheet_directory_uri() . '/_assets/css/adf-styles.css',
    array(),
    '' 
  );
}





// custom post types & taxonomies
require_once(get_stylesheet_directory().'/_assets/functions/custom-post-types.php');

// a settings file for any actions/functions to change default WP behavior.
require_once(get_stylesheet_directory().'/_assets/functions/adf-settings.php');

// helper functions. to help.
require_once(get_stylesheet_directory().'/_assets/functions/adf-helper-functions.php');

// customization and functions, formidable forms related.
require_once(get_stylesheet_directory().'/_assets/functions/formidable-mods.php');

// automation custom functions.
require_once(get_stylesheet_directory().'/_assets/functions/automations.php');
