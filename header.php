<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <?php wp_head(); ?>

    <?php
    /**
     * Config Head — inject custom code từ Options Page (ACF)
     * Field: config_head (textarea) → esc_html() KHÔNG dùng ở đây vì là raw code
     * Dùng wp_kses_post() hoặc để nguyên vì đây là vùng admin-only
     */
    $config_head = get_field( 'config_head', 'options' );
    if ( $config_head ) {
        echo $config_head; // phpcs:ignore WordPress.Security.EscapeOutput -- Admin-controlled raw code inject
    }
    ?>
</head>

<body <?php body_class( get_field( 'add_class_body', get_the_ID() ) ); ?>>

    <!-- ==========================================
         HEADER
    =========================================== -->
    <header class="fixed z-999 top-0 left-0 right-0 w-full transition">
        <div class="container-fluid flex-between relative z-50">

            <!-- Logo -->
            <div class="nav-brand z-50 pointer-events-auto flex-center">
                <?php
                $header_logo           = get_field( 'header_logo', 'options' );
                $header_logo_secondary = get_field( 'header_logo_secondary', 'options' );
                ?>

                <?php if ( $header_logo ) : ?>
                    <a class="pointer-events-auto" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img
                            src="<?php echo esc_url( $header_logo['url'] ); ?>"
                            alt="<?php echo esc_attr( $header_logo['alt'] ? $header_logo['alt'] : get_bloginfo( 'name' ) ); ?>"
                            width="<?php echo esc_attr( $header_logo['width'] ); ?>"
                            height="<?php echo esc_attr( $header_logo['height'] ); ?>">
                    </a>
                <?php elseif ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a class="pointer-events-auto" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img src="<?php echo esc_url( THEME_URI . '/img/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                    </a>
                <?php endif; ?>

                <?php if ( $header_logo_secondary ) : ?>
                    <a class="pointer-events-auto" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img
                            src="<?php echo esc_url( $header_logo_secondary['url'] ); ?>"
                            alt="<?php echo esc_attr( $header_logo_secondary['alt'] ? $header_logo_secondary['alt'] : get_bloginfo( 'name' ) ); ?>"
                            width="<?php echo esc_attr( $header_logo_secondary['width'] ); ?>"
                            height="<?php echo esc_attr( $header_logo_secondary['height'] ); ?>">
                    </a>
                <?php endif; ?>
            </div>

            <!-- Header Right (Nav + Utilities) -->
            <div class="header-right flex-end">

                <!-- Primary Navigation -->
                <nav class="nav-primary-menu" aria-label="<?php esc_attr_e( 'Primary Menu', 'canhcamtheme' ); ?>">
                    <?php
                    if ( has_nav_menu( 'primary-menu' ) ) {
                        require_once THEME_INC . '/function_menu_walker.php';
                        wp_nav_menu( array(
                            'theme_location' => 'primary-menu',
                            'menu_class'     => 'nav',
                            'menu_id'        => 'menu-site-menu',
                            'container'      => false,
                            'walker'         => new CanhCam_Header_Walker(),
                        ) );
                    }
                    ?>
                </nav>

                <!-- Search Toggle -->
                <div class="search-wrap relative z-50 ml-5">
                    <button class="search-toggle" aria-label="<?php esc_attr_e( 'Toggle Search', 'canhcamtheme' ); ?>"></button>
                </div>

                <!-- Language Switcher (WPML) -->
                <div class="language-wrap mx-5">
                    <?php
                    if ( function_exists( 'wpml_ls_statics_shortcode_actions' ) ) {
                        echo do_shortcode( '[wpml_language_selector_widget]' );
                    }
                    ?>
                </div>

                <!-- Google Translate -->
                <div class="google-language">
                    <div id="google_translate_element"></div>
                </div>

                <!-- Header CTAs: Hotline + Quote -->
                <div class="header-btn-group">
                    <?php $hotline = get_field( 'header_hotline', 'options' ); ?>
                    <?php if ( $hotline && ! empty( $hotline['url'] ) ) : ?>
                        <a href="<?php echo esc_url( $hotline['url'] ); ?>"
                           class="btn btn-tertiary hotline"
                           <?php echo ! empty( $hotline['target'] ) ? 'target="' . esc_attr( $hotline['target'] ) . '"' : ''; ?>>
                            <em class="fa-regular fa-phone" aria-hidden="true"></em>
                            <span><?php echo esc_html( $hotline['title'] ); ?></span>
                        </a>
                    <?php endif; ?>

                    <a class="btn btn-tertiary btn-quote"
                       data-fancybox="quote-modal"
                       href="#quote-modal"
                       aria-haspopup="dialog">
                        <em class="fa-regular fa-pen" aria-hidden="true"></em>
                        <span><?php esc_html_e( 'Báo giá', 'canhcamtheme' ); ?></span>
                    </a>
                </div>

                <!-- Hamburger (mobile) -->
                <div class="site-menu-toggle mt-1" tabindex="-1" aria-label="<?php esc_attr_e( 'Toggle Site Menu', 'canhcamtheme' ); ?>" role="button">
                    <div class="hamburger hamburger--elastic">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </div>

            </div><!-- .header-right -->
        </div>
    </header>

    <!-- ==========================================
         MODAL BÁO GIÁ
    =========================================== -->
    <div class="popup-modal quote-modal hidden" id="quote-modal" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Nhận báo giá nhanh', 'canhcamtheme' ); ?>">
        <div class="modal-wrap">
            <h2 class="heading-1 text-left text-primary-1 mb-4">
                <?php esc_html_e( 'Nhận báo giá nhanh & chính xác', 'canhcamtheme' ); ?>
            </h2>
            <div class="wrap-form">
                <?php
                $quote_form_shortcode = get_field( 'header_quote_form_shortcode', 'options' );
                if ( $quote_form_shortcode ) {
                    echo do_shortcode( wp_kses_post( $quote_form_shortcode ) );
                }
                ?>
            </div>
        </div>
    </div>

    <!-- ==========================================
         SEARCH BOX
    =========================================== -->
    <div class="searchbox" role="search">
        <div class="search-overlay">
            <div class="container">
                <form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <label for="header-search-input" class="screen-reader-text">
                        <?php esc_html_e( 'Tìm kiếm', 'canhcamtheme' ); ?>
                    </label>
                    <input
                        id="header-search-input"
                        type="search"
                        placeholder="<?php esc_attr_e( 'Tìm kiếm...', 'canhcamtheme' ); ?>"
                        name="s"
                        value="<?php echo esc_attr( get_search_query() ); ?>">
                    <button type="submit" tabindex="-1" aria-label="<?php esc_attr_e( 'Search Button', 'canhcamtheme' ); ?>">
                        <em class="fa-regular fa-magnifying-glass" aria-hidden="true"></em>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- ==========================================
         MOBILE NAV
    =========================================== -->
    <div class="mobile-nav-wrap" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'canhcamtheme' ); ?>">
        <div class="mobile-top-nav">
            <button class="close-menu" aria-label="<?php esc_attr_e( 'Đóng menu', 'canhcamtheme' ); ?>">
                <em class="fa-light fa-xmark" aria-hidden="true"></em>
                <span><?php esc_html_e( 'Close Menu', 'canhcamtheme' ); ?></span>
            </button>
        </div>
        <nav class="mobile-menu-nav relative z-50" aria-label="<?php esc_attr_e( 'Mobile Menu', 'canhcamtheme' ); ?>">
            <?php
            if ( has_nav_menu( 'mobile-menu' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'mobile-menu',
                    'menu_class'     => 'nav',
                    'menu_id'        => 'menu-site-menu-mobile',
                    'container'      => false,
                ) );
            }
            ?>
        </nav>
    </div>

    <main>