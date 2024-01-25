<?php
error_reporting(0);
ini_set('display_errors', 0);
add_action( 'wp_enqueue_scripts', 'consulting_child_enqueue_parent_styles');

function consulting_child_enqueue_parent_styles() {
	
	wp_enqueue_style( 'consulting-style', get_template_directory_uri() . '/style.css', array( 'bootstrap' ), CONSULTING_THEME_VERSION, 'all' );

	$css_version = filemtime(get_stylesheet_directory() . '/style.css');
    $skin = get_theme_mod('site_skin', 'skin_default');
    if ($skin == 'skin_default') {
        wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'consulting-layout' ), $css_version, 'all' );
    } else {
        wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'consulting-layout', 'stm-skin-custom-generated' ), $css_version, 'all' );
    }

}

/* Consulting Child Theme */


