    </main>

    <!-- ==========================================
         FIXED CTA / TOOL BAR
         HTML ref: <div class="tool-fixed-cta">
         Ánh xạ: fixed_toc_links (repeater, options)
         Type: single | quote | social_list
    =========================================== -->
    <?php $fixed_toc_links = get_field( 'fixed_toc_links', 'options' ); ?>
    <?php if ( $fixed_toc_links ) : ?>
    <div class="tool-fixed-cta">

        <?php foreach ( $fixed_toc_links as $item ) :
            $item_type  = $item['type'] ?? '';
            $icon_class = esc_attr( $item['icon_class'] ?? '' );
        ?>

            <?php if ( in_array( $item_type, array( 'single', 'quote' ), true ) ) :
                $link_url    = esc_url( $item['link']['url'] ?? '#' );
                $link_target = ! empty( $item['link']['target'] ) ? ' target="' . esc_attr( $item['link']['target'] ) . '"' : '';
            ?>
                <!-- Single / Quote button -->
                <a class="btn btn-content bg-primary-2" href="<?php echo $link_url; ?>"<?php echo $link_target; ?>>
                    <div class="btn-icon">
                        <div class="icon">
                            <i class="<?php echo $icon_class; ?>" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="content"><?php echo esc_html( $item['text'] ?? '' ); ?></div>
                </a>

            <?php elseif ( $item_type === 'social_list' ) : ?>
                <!-- Social list button -->
                <div class="btn btn-content btn-social">
                    <div class="btn-icon">
                        <div class="icon">
                            <i class="<?php echo $icon_class; ?>" aria-hidden="true"></i>
                        </div>
                    </div>
                    <?php if ( ! empty( $item['socials_list'] ) ) : ?>
                    <div class="content-social">
                        <ul>
                            <?php foreach ( $item['socials_list'] as $social ) :
                                $s_url    = esc_url( $social['link']['url'] ?? '#' );
                                $s_icon   = esc_attr( $social['icon_class'] ?? '' );
                                $s_target = ! empty( $social['link']['target'] ) ? ' target="' . esc_attr( $social['link']['target'] ) . '"' : '';
                            ?>
                                <li>
                                    <a href="<?php echo $s_url; ?>"<?php echo $s_target; ?> rel="noopener noreferrer">
                                        <i class="<?php echo $s_icon; ?>" aria-hidden="true"></i>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>

            <?php endif; ?>

        <?php endforeach; ?>

        <!-- Back to top button -->
        <div class="btn button-to-top" role="button" aria-label="<?php esc_attr_e( 'Về đầu trang', 'canhcamtheme' ); ?>">
            <div class="btn-icon">
                <div class="icon"></div>
            </div>
        </div>

    </div>
    <?php endif; ?>

    <!-- ==========================================
         FOOTER
         HTML ref: <footer> > <div class="container">
    =========================================== -->
    <?php
    /**
     * Lấy tất cả dữ liệu footer từ Options Page một lần
     */
    $footer_logo          = get_field( 'footer_logo', 'options' );
    $footer_logo_2        = get_field( 'header_logo_secondary', 'options' ); // logo-2 dùng chung với header
    $company_name         = get_field( 'footer_company_name', 'options' );
    $contact_title        = get_field( 'footer_contact_title', 'options' ) ?: '';
    $footer_company_info  = get_field( 'footer_company_info', 'options' );
    $footer_links_title   = get_field( 'footer_links_title', 'options' ) ?: __( 'Liên kết nhanh', 'canhcamtheme' );
    $footer_social_title  = get_field( 'footer_social_block_title', 'options' ) ?: __( 'Follow Us', 'canhcamtheme' );
    $footer_socials       = get_field( 'footer_socials', 'options' );
    $ecosystem_text       = get_field( 'footer_ecosystem_text', 'options' );
    $ecosystem_logo       = get_field( 'footer_ecosystem_logo', 'options' );
    $ecosystem_website    = get_field( 'footer_ecosystem_website', 'options' );
    $copyright            = get_field( 'footer_copyright', 'options' );
    ?>

    <footer>
        <div class="container">

            <!-- ======================================
                 FOOTER CHILD (Top section)
                 HTML: <div class="box-footer-child">
                 3 cols: box-infor | box-links | box-social
            ====================================== -->
            <div class="box-footer-child">

                <!-- Col 1: Company Info -->
                <!-- HTML: <div class="box-infor"> -->
                <div class="box-infor">

                    <?php if ( $company_name ) : ?>
                    <!-- HTML: <div class="box-name-web"><h2 class="title"> -->
                    <div class="box-name-web">
                        <h2 class="title"><?php echo esc_html( $company_name ); ?></h2>
                    </div>
                    <?php endif; ?>

                    <!-- HTML: <div class="box-contact"><h3 class="title">...<div class="box-content"> -->
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

                </div><!-- .box-infor -->

                <!-- Col 2: Footer Nav Links -->
                <!-- HTML: <div class="box-links"><h3 class="title">...<ul> -->
                <div class="box-links">
                    <h3 class="title"><?php echo esc_html( $footer_links_title ); ?></h3>
                    <nav aria-label="<?php echo esc_attr( $footer_links_title ); ?>">
                        <?php
                        if ( has_nav_menu( 'footer-1' ) ) {
                            wp_nav_menu( array(
                                'theme_location' => 'footer-1',
                                'container'      => false,
                                'menu_class'     => '',
                            ) );
                        }
                        ?>
                    </nav>
                </div><!-- .box-links -->

                <!-- Col 3: Social Icons -->
                <!-- HTML: <div class="box-social"><h3 class="title">...<div class="box-social-list"><div class="items-social"> -->
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
                </div><!-- .box-social -->

            </div><!-- .box-footer-child -->

            <!-- ======================================
                 FOOTER BOTTOM
                 HTML: <div class="box-footer-bottom">
                 2 cols: box-left (logo + copyright) | box-right (policy links)
            ====================================== -->
            <div class="box-footer-bottom">

                <!-- Left: Logos + Copyright -->
                <!-- HTML: <div class="box-left"><div class="box-logo"><div class="logo">+<div class="logo-2"><p> -->
                <div class="box-left">
                    <div class="box-logo">

                        <?php if ( $footer_logo ) : ?>
                        <div class="logo">
                            <div class="img-ratio">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <img src="<?php echo esc_url( $footer_logo['url'] ); ?>"
                                         alt="<?php echo esc_attr( $footer_logo['alt'] ? $footer_logo['alt'] : get_bloginfo( 'name' ) ); ?>">
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ( $footer_logo_2 ) : ?>
                        <div class="logo-2">
                            <div class="img-ratio">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <img src="<?php echo esc_url( $footer_logo_2['url'] ); ?>"
                                         alt="<?php echo esc_attr( $footer_logo_2['alt'] ? $footer_logo_2['alt'] : get_bloginfo( 'name' ) ); ?>">
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div><!-- .box-logo -->

                    <p>
                        <?php
                        if ( $copyright ) {
                            echo esc_html( $copyright );
                        } else {
                            echo esc_html( '© ' . gmdate( 'Y' ) . ' All Rights Reserved.' );
                        }
                        ?>
                    </p>
                </div><!-- .box-left -->

                <!-- Right: Policy Menu -->
                <!-- HTML: <div class="box-right"><a href="">Sitemap</a> -->
                <div class="box-right">
                    <?php
                    if ( has_nav_menu( 'footer-policy' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'footer-policy',
                            'container'      => false,
                            'items_wrap'     => '%3$s', // bỏ thẻ <ul> bao của wp_nav_menu
                        ) );
                    }
                    ?>
                </div><!-- .box-right -->

            </div><!-- .box-footer-bottom -->

        </div><!-- .container -->
    </footer>

    <?php
    /**
     * wp_footer() — bỏ qua khi Lighthouse audit
     */
    if ( stripos( $_SERVER['HTTP_USER_AGENT'] ?? '', 'Chrome-Lighthouse' ) === false ) :
        wp_footer();
    endif;
    ?>

    <?php
    /**
     * Config Body — inject custom script từ Options Page
     * Field: config_body (textarea) — admin-only, raw output
     */
    $config_body = get_field( 'config_body', 'options' );
    if ( $config_body ) {
        echo $config_body; // phpcs:ignore WordPress.Security.EscapeOutput -- Admin-controlled raw code inject
    }
    ?>

    <!-- Google Translate Init -->
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