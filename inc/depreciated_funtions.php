<?php

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

if ( ! function_exists( 'consulting_get_header_style' ) ) {
    function consulting_get_header_style() {
        $header_style = get_theme_mod( 'header_style', 'header_style_1' );
        if ( isset( $_REQUEST['header_demo'] ) && $_REQUEST['header_demo'] == 'header_style_1' ) {
            $header_style = 'header_style_1';
        } elseif ( isset( $_REQUEST['header_demo'] ) && $_REQUEST['header_demo'] == 'header_style_2' ) {
            $header_style = 'header_style_2';
        } elseif ( isset( $_REQUEST['header_demo'] ) && $_REQUEST['header_demo'] == 'header_style_3' ) {
            $header_style = 'header_style_3';
        } elseif ( isset( $_REQUEST['header_demo'] ) && $_REQUEST['header_demo'] == 'header_style_4' ) {
            $header_style = 'header_style_4';
        } elseif ( isset( $_REQUEST['header_demo'] ) && $_REQUEST['header_demo'] == 'header_style_5' ) {
            $header_style = 'header_style_5';
        } elseif ( isset( $_REQUEST['header_demo'] ) && $_REQUEST['header_demo'] == 'header_style_6' ) {
            $header_style = 'header_style_6';
        } elseif ( isset( $_REQUEST['header_demo'] ) && $_REQUEST['header_demo'] == 'header_style_7' ) {
            $header_style = 'header_style_7';
        } elseif ( isset( $_REQUEST['header_demo'] ) && $_REQUEST['header_demo'] == 'header_style_8' ) {
            $header_style = 'header_style_8';
        }

        return $header_style;
    }
}

if (!function_exists('consulting_body_class')) {
    function consulting_body_class($classes)
    {
        global $post;
        global $wp_customize;

        if (isset($wp_customize)) {
            $classes[] = 'customizer_page';
        }

        $consulting_config = consulting_config();
        if ($consulting_config['layout']) {
            $classes[] = 'site_' . $consulting_config['layout'];
        }

        if ($consulting_config['layout'] == 'layout_13' || $consulting_config['layout'] == 'layout_barcelona') {
            $classes[] = 'stm_top_bar_' . get_theme_mod('top_bar_style', 'style_1');
        }

        if( stm_check_layout( 'layout_melbourne' ) and get_theme_mod( 'enable_black_and_white_images', true ) ) {
            $classes[] = 'black_and_white_images';
        }

        $wpml_switcher_mobile = get_theme_mod('wpml_switcher_mobile', false);

        if($wpml_switcher_mobile) {
            $classes[] = 'show-mobile-switcher';
        }

        $classes[] = get_theme_mod('color_skin');
        $classes[] = consulting_get_header_style();
        if (get_theme_mod('sticky_menu')) {
            $classes[] = 'sticky_menu';
        }

        if (stm_check_layout('layout_17')) {
            $user_agent = getenv("HTTP_USER_AGENT");

            if (strpos($user_agent, "Win") !== FALSE)
                $classes[] = "stm_windows";
            elseif (strpos($user_agent, "Mac") !== FALSE)
                $classes[] = "stm_mac";
        }

        if (get_theme_mod('site_boxed')) {
            $classes[] = 'boxed_layout';
            if (get_theme_mod('bg_image')) {
                $classes[] = get_theme_mod('bg_image');
            }
            if (get_theme_mod('custom_bg_image')) {
                $classes[] = 'custom_bg_image';
            }

            if (!is_404()) {
                $content_bg_transparent = get_post_meta($post->ID, 'content_bg_transparent', true);
                if ($content_bg_transparent) {
                    $classes[] = 'content_bg_transparent';
                }
            }
        }

        if (!is_404() and !empty($post)) {
            if (!empty($post->ID) && get_post_meta($post->ID, 'enable_header_transparent', true)) {
                $classes[] = 'header_transparent';
            }

            $header_inverse = get_post_meta($post->ID, 'header_inverse', true);
            if ($header_inverse) {
                $classes[] = 'header_inverse';
            }

            $title_box_bg_image = get_post_meta($post->ID, 'title_box_bg_image', true);
            if (!empty($title_box_bg_image)) {
                $classes[] = 'title_box_image_added';
            }
        }

        $mobile_grid = get_theme_mod('mobile_grid');

        if ($mobile_grid == 'landscape') {
            $classes[] = 'mobile_grid_landscape';
        }

        if (defined('STM_HB_VER')) {
            $header_full_width = stm_hb_get_option('header_full_width', false, $hb = 'stm_hb_settings');
            if ($header_full_width == 'header_full_width') {
                $classes[] = $header_full_width;
            }
        }

        $sidebar_type = get_theme_mod('blog_sidebar_type', 'wp');

        if($sidebar_type !== 'wp'){
            $classes[] = 'vc_sidebar_page';
        }

        if (defined('STM_ZOOM_FILE')) {
            $classes[] = 'eroom-enabled';
        }

        return $classes;
    }
}
if ( ! function_exists( 'consulting_get_structure' ) ) {
    function consulting_get_structure( $sidebar_id, $sidebar_type, $sidebar_position, $layout = false ) {

        $output                   = array();
        $output['content_before'] = $output['content_after'] = $output['sidebar_before'] = $output['sidebar_after'] = '';
        $output['class']          = 'posts_list';

        if ( $layout == 'grid' ) {
            $output['class'] = 'posts_grid';
        }
        if ( ! empty( $_GET['layout'] ) && $_GET['layout'] == 'grid' ) {
            $output['class'] = 'posts_grid';
        }

        if ( $sidebar_type == 'vc' ) {
            if ( $sidebar_id ) {
                $sidebar = get_post( $sidebar_id );
            }
        } else {
            if ( $sidebar_id ) {
                $sidebar = true;
            }
        }

        if ( isset( $sidebar ) ) {
            $output['class'] .= ' with_sidebar';
        }

        if ( $sidebar_position == 'right' && isset( $sidebar ) ) {
            $output['content_before'] .= '<div class="row">';
            $output['content_before'] .= '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">';
            $output['content_before'] .= '<div class="col_in __padd-right">';

            $output['content_after'] .= '</div>';
            $output['content_after'] .= '</div>'; // col
            $output['sidebar_before'] .= '<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">';
            // .sidebar-area
            $output['sidebar_after'] .= '</div>'; // col
            $output['sidebar_after'] .= '</div>'; // row
        }

        if ( $sidebar_position == 'left' && isset( $sidebar ) ) {
            $output['content_before'] .= '<div class="row">';
            $output['content_before'] .= '<div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12">';
            $output['content_before'] .= '<div class="col_in __padd-left">';

            $output['content_after'] .= '</div>';
            $output['content_after'] .= '</div>'; // col
            $output['sidebar_before'] .= '<div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 hidden-sm hidden-xs">';
            // .sidebar-area
            $output['sidebar_after'] .= '</div>'; // col
            $output['sidebar_after'] .= '</div>'; // row
        }

        return $output;
    }
}

if ( ! function_exists( 'consulting_blog_layout' ) ) {
    function consulting_blog_layout() {
        $blog_layout = get_theme_mod( 'blog_layout', 'list' );
        if ( isset( $_REQUEST['layout'] ) && $_REQUEST['layout'] == 'grid' ) {
            $blog_layout = 'grid';
        }

        return $blog_layout;
    }
}