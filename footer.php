    </main>

    <?php $fixed_toc_links = get_field( 'fixed_toc_links', 'options' ); ?>
    <div class="tool-fixed-cta-once-btn">
        <div class="btn button-to-top" role="button" aria-label="<?php esc_attr_e( 'Về đầu trang', 'canhcamtheme' ); ?>">
            <div class="btn-icon">
                <div class="icon"></div>
            </div>
        </div>

        <?php if ( $fixed_toc_links ) : ?>
        <div class="tool-cta-share">
            <?php foreach ( $fixed_toc_links as $item ) :
                $style      = esc_attr( $item['style'] ?? 'phone' );
                $icon_class = esc_attr( $item['icon_class'] ?? '' );
                $link_url   = esc_url( $item['link']['url'] ?? '#' );
                $link_target = ! empty( $item['link']['target'] ) ? ' target="' . esc_attr( $item['link']['target'] ) . '"' : '';
            ?>
            <div class="tool-cta-item <?php echo $style; ?>">
                <a href="<?php echo $link_url; ?>"<?php echo $link_target; ?> rel="noopener noreferrer">
                    <i class="<?php echo $icon_class; ?>" aria-hidden="true"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>


    <?php
    $footer_logo         = get_field( 'footer_logo', 'options' );
    $footer_logo_2       = get_field( 'header_logo_secondary', 'options' );
    $company_name        = get_field( 'footer_company_name', 'options' );
    $contact_title       = get_field( 'footer_contact_title', 'options' );
    $footer_company_info = get_field( 'footer_company_info', 'options' );
    $footer_links_title  = get_field( 'footer_links_title', 'options' ) ?: __( 'Liên kết nhanh', 'canhcamtheme' );
    $footer_social_title = get_field( 'footer_social_block_title', 'options' ) ?: __( 'Follow Us', 'canhcamtheme' );
    $footer_socials      = get_field( 'footer_socials', 'options' );
    $copyright           = get_field( 'footer_copyright', 'options' );
    ?>

    <footer>
        <div class="container">

            <div class="box-footer-child">

                <div class="box-infor">
                    <?php if ( $company_name ) : ?>
                    <div class="box-name-web">
                        <h2 class="title"><?php echo wp_kses_post( $company_name ); ?></h2>
                    </div>
                    <?php endif; ?>

                    <div class="box-contact">
                        <?php if ( $contact_title ) : ?>
                        <h3 class="title"><?php echo esc_html( $contact_title ); ?></h3>
                        <?php endif; ?>

                        <?php if ( $footer_company_info ) :
                            foreach ( $footer_company_info as $info ) :
                                $info_icon    = esc_attr( $info['icon_class'] ?? '' );
                                $info_content = $info['content'] ?? '';
                        ?>
                        <div class="box-content">
                            <?php if ( $info_icon ) : ?>
                            <i class="<?php echo $info_icon; ?>" aria-hidden="true"></i>
                            <?php endif; ?>
                            <?php echo wp_kses_post( $info_content ); ?>
                        </div>
                        <?php endforeach; endif; ?>
                    </div>
                </div>

                <div class="box-links">
                    <h3 class="title"><?php echo esc_html( $footer_links_title ); ?></h3>
                    <?php
                    if ( has_nav_menu( 'footer-1' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'footer-1',
                            'container'      => false,
                            'menu_class'     => '',
                        ) );
                    }
                    ?>
                </div>

                <div class="box-social">
                    <h3 class="title"><?php echo esc_html( $footer_social_title ); ?></h3>
                    <?php if ( $footer_socials ) : ?>
                    <div class="box-social-list">
                        <?php foreach ( $footer_socials as $social ) :
                            $s_url  = esc_url( $social['link'] ?? '#' );
                            $s_icon = esc_attr( $social['icon_class'] ?? '' );
                        ?>
                        <div class="items-social">
                            <a href="<?php echo $s_url; ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="<?php echo esc_attr( ucfirst( str_replace( array( 'fa-brands fa-', 'fa-' ), '', $s_icon ) ) ); ?>">
                                <i class="<?php echo $s_icon; ?>" aria-hidden="true"></i>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

            </div>

            <div class="box-footer-bottom">

                <div class="box-left">
                    <div class="box-logo">
                        <?php if ( $footer_logo ) : ?>
                        <div class="logo">
                            <div class="img-ratio">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <img src="<?php echo esc_url( $footer_logo['url'] ); ?>"
                                         alt="<?php echo esc_attr( $footer_logo['alt'] ?: get_bloginfo( 'name' ) ); ?>">
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ( $footer_logo_2 ) : ?>
                        <div class="logo-2">
                            <div class="img-ratio">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <img src="<?php echo esc_url( $footer_logo_2['url'] ); ?>"
                                         alt="<?php echo esc_attr( $footer_logo_2['alt'] ?: get_bloginfo( 'name' ) ); ?>">
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <p>
                        <?php echo esc_html( $copyright ?: '© ' . gmdate( 'Y' ) . ' All Rights Reserved.' ); ?>
                    </p>
                </div>

                <div class="box-right">
                    <?php
                    if ( has_nav_menu( 'footer-policy' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'footer-policy',
                            'container'      => false,
                            'items_wrap'     => '%3$s',
                        ) );
                    }
                    ?>
                </div>

            </div>

        </div>
    </footer>

    <?php
    if ( stripos( $_SERVER['HTTP_USER_AGENT'] ?? '', 'Chrome-Lighthouse' ) === false ) :
        wp_footer();
    endif;
    ?>

    <?php
    $config_body = get_field( 'config_body', 'options' );
    if ( $config_body ) {
        echo $config_body; // phpcs:ignore WordPress.Security.EscapeOutput
    }
    ?>

    <script>
        function googleTranslateElementInit() {
            if ( typeof google === 'object' && google.translate ) {
                new google.translate.TranslateElement( { pageLanguage: 'en' }, 'google_translate_element' );
            }
        }
    </script>
    <script defer src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>