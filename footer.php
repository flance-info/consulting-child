<?php if( !is_404() ): ?>
    </div> <!--.container-->
    </div> <!--#main-->
    </div> <!--.content_wrapper-->
    <?php
    $consulting_layout = get_option( 'consulting_layout', 'layout_1' );
    $logo_tmp = '';
    if( !empty( $consulting_layout ) && $consulting_layout != 'layout_1' && $consulting_layout != 'layout_12' ) {
        $logo_tmp = $consulting_layout . '_';
    }
    $footer_style = get_theme_mod( 'footer_style', 'style_1' );

    if( $footer_style === 'style_3' ):
        get_template_part( 'partials/footer/style_3' );
    else:
        $socials = consulting_get_socials( 'footer_socials' );
        $page_ID = consulting_page_id();
        $copyright_class = '';
        $copyright_border_top = get_post_meta( $page_ID, 'separator_footer_copyright_border_t', true );

        if( $copyright_border_top ) {
            $copyright_class .= ' border-top-hide';
        }

        $copyright = get_theme_mod( 'footer_copyright', wp_kses( __( "Copyright &copy; 2012-2020 <a href='https://consulting.stylemixthemes.com/landing/'>Consulting Theme</a> by <a href='https://stylemixthemes.com/' target='_blank'>Stylemix Themes</a>. All rights reserved", 'consulting' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ) );
        $footer_class = '';
        $footer_class = ' ' . $footer_style;

        if( empty( $copyright ) || empty( $socials ) && $footer_style != 'style_1' ) {
            $footer_class .= ' no-copyright';
        }

        if( stm_check_layout( 'layout_14' ) and get_theme_mod( 'enable_page_switcher', true ) and is_front_page() ) {
            get_template_part( 'partials/page-scroll' );
        }
        ?>
        <?php if( !get_theme_mod( 'footer_show_hide', false ) ): ?>

        <footer id="footer" class="footer<?php echo esc_attr( $footer_class ); ?>">
            <?php if( stm_check_layout( 'layout_14' ) and get_theme_mod( 'footer_enable_menu_top', true ) ): ?>
                <div class="container">
                    <div class="top_nav">
                        <div class="stm_l14_footer_menu top_nav_wrapper">
                            <?php
                            wp_nav_menu( array(
                                    'theme_location' => 'consulting-primary_menu',
                                    'container' => false,
                                    'depth' => 1,
                                    'menu_class' => 'main_menu_nav'
                                )
                            );
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if( is_active_sidebar( 'consulting-footer-1' ) or is_active_sidebar( 'consulting-footer-2' ) or is_active_sidebar( 'consulting-footer-3' ) or is_active_sidebar( 'consulting-footer-4' ) ): ?>
                <?php if( get_theme_mod( 'footer_sidebar_count', 4 ) != 'disable' ): ?>
                    <div class="widgets_row">
                        <div class="container">
                            <div class="footer_widgets">
                                <div class="row">
                                    <?php
                                    $footer_sidebar_count = intval( get_theme_mod( 'footer_sidebar_count', 4 ) );
                                    $col = 12 / $footer_sidebar_count;
                                    for( $count = 1; $count <= $footer_sidebar_count; $count++ ): ?>
                                        <div class="col-lg-<?php echo esc_attr( $col ); ?> col-md-<?php echo esc_attr( $col ); ?> col-sm-6 col-xs-12">
                                            <?php if( $count == 1 ): ?>
                                                <?php if( !get_theme_mod( 'footer_logo_show_hide', false ) ): ?>
                                                    <?php if( $footer_logo = get_theme_mod( 'footer_logo', '' ) ): ?>
                                                        <div class="footer_logo">
                                                            <a href="<?php echo esc_url( home_url( '/' ) ) ?>">
                                                                <img src="<?php echo esc_url( $footer_logo ); ?>"
                                                                     alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if( $footer_text = get_theme_mod( 'footer_text', '' ) ): ?>
                                                    <div class="footer_text">
                                                        <p><?php printf( _x( '%s', 'Footer Text', 'consulting' ), $footer_text ); ?></p>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if( !get_theme_mod( 'footer_show_hide_socials', false ) ) : ?>
                                                    <?php if( $socials && $footer_style == 'style_2' ): ?>
                                                        <div class="socials">
                                                            <ul>
                                                                <?php foreach( $socials as $key => $val ): ?>
                                                                    <li>
                                                                        <a href="<?php echo esc_url( $val ); ?>"
                                                                           target="_blank"
                                                                           class="social-<?php echo esc_attr( $key ); ?>">
                                                                            <i class="fa fa-<?php echo esc_attr( $key ); ?>"></i>
                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php dynamic_sidebar( 'consulting-footer-' . $count ); ?>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if( !empty( $copyright ) || !empty( $socials ) && $footer_style == 'style_1' ) : ?>
                <div class="copyright_row<?php echo esc_attr( $copyright_class ); ?><?php echo ( get_theme_mod( 'footer_sidebar_count', 4 ) == 'disable' ) ? ' widgets_disabled' : ''; ?>">
                    <div class="container">
                        <div class="copyright_row_wr">
                            <?php if( !get_theme_mod( 'footer_show_hide_socials', false ) ): ?>
                                <?php if( !empty( $socials ) && $footer_style == 'style_1' ): ?>
                                    <div class="socials">
                                        <ul>
                                            <?php foreach( $socials as $key => $val ): ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $val ); ?>" target="_blank"
                                                       class="social-<?php echo esc_attr( $key ); ?>">
                                                        <i class="fa fa-<?php echo esc_attr( $key ); ?>"></i>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if( !empty( $copyright ) ): ?>
                                <div class="copyright">
                                    <?php if( !get_theme_mod( 'footer_current_year', false ) ): ?>
                                        <?php printf( _x( '%s', 'Copyright', 'consulting' ), $copyright ); ?>
                                    <?php else: ?>
                                        <?php printf( _x( '© %s %s', '© year copyright', 'consulting' ), date( 'Y' ), $copyright ); ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                    </div>
							<div id="footerpara" style="padding-bottom:20px">
								FOR EDUCATIONAL AND INFORMATION PURPOSES ONLY; NOT INVESTMENT ADVICE. NetPicks Services are offered for educational and informational purposes only and should NOT be construed as a securities-related offer or solicitation or be relied upon as personalized investment advice. We are not financial advisors and cannot give personalized advice. There is a risk of loss in all trading, and you may lose some or all of your original investment. Results presented are not typical. RISK DISCLOSURE:  Futures and forex trading contains substantial risk and is not for every investor. An investor could potentially lose all or more than the initial investment. Risk capital is money that can be lost without jeopardizing ones’ financial security or lifestyle. Only risk capital should be used for trading and only those with sufficient risk capital should consider trading. Past performance is not necessarily indicative of future results. HYPOTHETICAL PERFORMANCE DISCLOSURE: Hypothetical performance results have many inherent limitations, some of which are described below. No representation is being made that any account will or is likely to achieve profits or losses similar to those shown; in fact, there are frequently sharp differences between hypothetical performance results and the actual results subsequently achieved by any particular trading program. One of the limitations of hypothetical performance results is that they are generally prepared with the benefit of hindsight. In addition, hypothetical trading does not involve financial risk, and no hypothetical trading record can completely account for the impact of financial risk of actual trading. for example, the ability to withstand losses or to adhere to a particular trading program in spite of trading losses are material points which can also adversely affect actual trading results. There are numerous other factors related to the markets in general or to the implementation of any specific trading program which cannot be fully accounted for in the preparation of hypothetical performance results and all which can adversely affect trading results. TESTIMONIALS: Testimonials appearing on this website may not be representative of other clients or customers and is not a guarantee of future performance or success. LIVE TRADING ROOM: All presentations are for educational purposes only and the opinions expressed are those of the presenter only. All trades presented should be considered hypothetical and should not be expected to be replicated in a live trading account. VIRTUAL CURRENCY:  View CFTC https://www.netpicks.com/cftc advisories as they contain more information on the risks associated with trading virtual currencies.Please review the <a href="https://www.netpicks.com/terms-of-use-conditions-of-sale/">Full Risk Disclaimer</a> and <a  href="https://www.netpicks.com/privacy-policy/">Privacy Policy</a><br />
<a a style="color:#777" href="https://www.netpicks.com/sitemap_index.xml">sitemap</a>
</div>
							
                        </div>						
						
                </div>
            <?php endif; ?>
        </footer>
    <?php endif; ?>
    <?php endif; ?>



    </div> <!--#wrapper-->
<?php endif; ?>
<?php do_action( 'frontend_customizer' ); ?>

<?php wp_footer(); ?>
<?php get_template_part( 'partials/custom_footer' ); ?>
</body>
</html>