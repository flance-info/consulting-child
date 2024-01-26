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
		$consulting_config = consulting_config();
		wp_register_style( 'consulting-layout', get_template_directory_uri() . '/assets/css/layouts/' . $consulting_config['layout'] . '/main.css', null, CONSULTING_THEME_VERSION, 'all' );
	}

}

/* Consulting Child Theme */

if ( ! function_exists( 'consulting_get_top_bar_info' ) ) {
    function consulting_get_top_bar_info() {
        $top_bar_info = array();
        for ( $i = 1; $i <= 10; $i ++ ) {
            $top_bar_info_office = get_theme_mod( 'top_bar_info_' . $i . '_office' );
            if ( ! empty( $top_bar_info_office ) ) {
                $top_bar_info[ $i ]['office'] = $top_bar_info_office;
            }
            $top_bar_info_address = get_theme_mod( 'top_bar_info_' . $i . '_address' );
            if ( ! empty( $top_bar_info_address ) && ! empty( $top_bar_info_office ) ) {
                $top_bar_info[ $i ]['address'] = $top_bar_info_address;
            }
            $top_bar_info_address_icon = get_theme_mod( 'top_bar_info_' . $i . '_address_icon', 'stm-marker' );
            if ( ! empty( $top_bar_info_address ) && ! empty( $top_bar_info_address_icon ) && ! empty( $top_bar_info_office ) ) {
                $top_bar_info[ $i ]['address_icon'] = $top_bar_info_address_icon;
            }
            $top_bar_info_hours = get_theme_mod( 'top_bar_info_' . $i . '_hours' );
            if ( ! empty( $top_bar_info_hours ) && ! empty( $top_bar_info_office ) ) {
                $top_bar_info[ $i ]['hours'] = $top_bar_info_hours;
            }
            $top_bar_info_hours_icon = get_theme_mod( 'top_bar_info_' . $i . '_hours_icon', 'fa fa-clock-o' );
            if ( ! empty( $top_bar_info_hours ) && ! empty( $top_bar_info_hours_icon ) && ! empty( $top_bar_info_office ) ) {
                $top_bar_info[ $i ]['hours_icon'] = $top_bar_info_hours_icon;
            }
            $top_bar_info_phone = get_theme_mod( 'top_bar_info_' . $i . '_phone' );
            if ( ! empty( $top_bar_info_phone ) && ! empty( $top_bar_info_office ) ) {
                $top_bar_info[ $i ]['phone'] = $top_bar_info_phone;
            }
            $top_bar_info_phone_icon = get_theme_mod( 'top_bar_info_' . $i . '_phone_icon', 'fa fa-phone' );
            if ( ! empty( $top_bar_info_phone ) && ! empty( $top_bar_info_phone_icon ) && ! empty( $top_bar_info_office ) ) {
                $top_bar_info[ $i ]['phone_icon'] = $top_bar_info_phone_icon;
            }
        }

        return $top_bar_info;
    }
}


