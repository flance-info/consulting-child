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

	if ( ! is_admin() ) {
		//wp_deregister_style( 'consulting-layout' );
		//wp_dequeue_style('consulting-layout');

		$consulting_config = consulting_config();

		wp_register_style( 'consulting-layout_child', get_stylesheet_directory_uri() . '/assets/css/layouts/' . $consulting_config['layout'] . '/main.css', null, CONSULTING_THEME_VERSION, 'all' );
		wp_enqueue_style( 'consulting-layout_child' );

		wp_enqueue_script(
				'consulting-custom-child',
				get_stylesheet_directory_uri() . '/assets/js/custom.js',
				array( 'jquery', 'consulting-custom' ),
				time(),
				array(
					'strategy'  => 'defer',
					'in_footer' => true,
				)
			);

	}

}

/* Consulting Child Theme */

require_once 'inc/depreciated_funtions.php';