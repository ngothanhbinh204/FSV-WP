<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
    <?php
    $config_head = get_field( 'config_head', 'options' );
    if ( $config_head ) {
        echo $config_head; // phpcs:ignore WordPress.Security.EscapeOutput
    }
    ?>
</head>

<body <?php body_class( get_field( 'add_class_body', get_the_ID() ) ); ?>>

    <header>
        <?php
        $header_logo           = get_field( 'header_logo', 'options' );
        $header_logo_secondary = get_field( 'header_logo_secondary', 'options' );
        $hotline               = get_field( 'header_hotline', 'options' );
        ?>

        <div class="header-main">

            <div class="box-logo">
                <?php if ( $header_logo ) : ?>
                <div class="logo">
                    <div class="img-ratio">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?php echo esc_url( $header_logo['url'] ); ?>"
                                 alt="<?php echo esc_attr( $header_logo['alt'] ?: get_bloginfo( 'name' ) ); ?>"
                                 width="<?php echo esc_attr( $header_logo['width'] ); ?>"
                                 height="<?php echo esc_attr( $header_logo['height'] ); ?>">
                        </a>
                    </div>
                </div>
                <?php elseif ( has_custom_logo() ) : ?>
                <div class="logo"><?php the_custom_logo(); ?></div>
                <?php else : ?>
                <div class="logo">
                    <div class="img-ratio">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?php echo esc_url( THEME_URI . '/img/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $header_logo_secondary ) : ?>
                <div class="logo-2">
                    <div class="img-ratio">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?php echo esc_url( $header_logo_secondary['url'] ); ?>"
                                 alt="<?php echo esc_attr( $header_logo_secondary['alt'] ?: get_bloginfo( 'name' ) ); ?>"
                                 width="<?php echo esc_attr( $header_logo_secondary['width'] ); ?>"
                                 height="<?php echo esc_attr( $header_logo_secondary['height'] ); ?>">
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="box-nav-links">
                <div class="nav-top">
                    <?php if ( $hotline && ! empty( $hotline['url'] ) ) : ?>
                    <div class="box-hotline">
                        <div class="box-icon-title">
                            <i class="fa-solid fa-phone" aria-hidden="true"></i>
                            <span class="title"><?php esc_html_e( 'Hotline', 'canhcamtheme' ); ?></span>
                        </div>
                        <a href="<?php echo esc_url( $hotline['url'] ); ?>"<?php echo ! empty( $hotline['target'] ) ? ' target="' . esc_attr( $hotline['target'] ) . '"' : ''; ?>>
                            <?php echo esc_html( $hotline['title'] ); ?>
                        </a>
                    </div>
                    <?php endif; ?>

                    <div class="lang">
                        <?php
                        if ( function_exists( 'wpml_ls_statics_shortcode_actions' ) ) {
                            echo do_shortcode( '[wpml_language_selector_widget]' );
                        }
                        ?>
                    </div>

                    <div class="search header-search">
                        <i class="fa-regular fa-magnifying-glass" aria-hidden="true"></i>
                    </div>
                </div>

                <div class="nav-bottom">
                    <?php
                    if ( has_nav_menu( 'primary-menu' ) ) {
                        require_once THEME_INC . '/function_menu_walker.php';
                        wp_nav_menu( array(
                            'theme_location' => 'primary-menu',
                            'menu_class'     => 'nav-links',
                            'menu_id'        => 'menu-site-menu',
                            'container'      => false,
                            'walker'         => new CanhCam_Header_Walker(),
                        ) );
                    }
                    ?>

                    <div class="header-hamburger" role="button" tabindex="0" aria-label="<?php esc_attr_e( 'Toggle Menu', 'canhcamtheme' ); ?>">
                        <div class="wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div id="pulseMe">
                            <div class="bar left"></div>
                            <div class="bar top"></div>
                            <div class="bar right"></div>
                            <div class="bar bottom"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="header-mobile-wrapper">
            <div class="header-mobile">
                <div class="list-menu-header">
                    <div class="header-search-form-mobile">
                        <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
                            <label for="mobile-search-input" class="screen-reader-text"><?php esc_html_e( 'Tìm kiếm', 'canhcamtheme' ); ?></label>
                            <input id="mobile-search-input"
                                   class="focus:outline-primary-1/20"
                                   type="search"
                                   name="s"
                                   placeholder="<?php esc_attr_e( 'Search', 'canhcamtheme' ); ?>"
                                   value="<?php echo esc_attr( get_search_query() ); ?>">
                            <button type="submit" aria-label="<?php esc_attr_e( 'Search', 'canhcamtheme' ); ?>"></button>
                        </form>
                    </div>

                    <div class="header-menu-mobile">
                        <?php
                        if ( has_nav_menu( 'mobile-menu' ) ) {
                            wp_nav_menu( array(
                                'theme_location' => 'mobile-menu',
                                'menu_class'     => '',
                                'menu_id'        => 'menu-site-menu-mobile',
                                'container'      => false,
                            ) );
                        }
                        ?>

                        <div class="social">
                            <?php if ( $hotline && ! empty( $hotline['url'] ) ) : ?>
                            <div class="box-hotline">
                                <div class="box-icon-title">
                                    <i class="fa-solid fa-phone" aria-hidden="true"></i>
                                    <span class="title"><?php esc_html_e( 'Hotline', 'canhcamtheme' ); ?></span>
                                </div>
                                <a href="<?php echo esc_url( $hotline['url'] ); ?>">
                                    <?php echo esc_html( $hotline['title'] ); ?>
                                </a>
                            </div>
                            <?php endif; ?>

                            <div class="lang">
                                <?php
                                if ( function_exists( 'wpml_ls_statics_shortcode_actions' ) ) {
                                    echo do_shortcode( '[wpml_language_selector_widget]' );
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overlay"></div>
        </div>

    </header>

    <div class="header-search-form">
        <div class="close"><i class="fa-light fa-xmark" aria-hidden="true"></i></div>
        <div class="container">
            <div class="wrap-form-search-product">
                <div class="productsearchbox">
                    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
                        <label for="desktop-search-input" class="screen-reader-text"><?php esc_html_e( 'Tìm kiếm sản phẩm', 'canhcamtheme' ); ?></label>
                        <input id="desktop-search-input"
                               type="search"
                               name="s"
                               placeholder="<?php esc_attr_e( 'Tìm kiếm...', 'canhcamtheme' ); ?>"
                               value="<?php echo esc_attr( get_search_query() ); ?>">
                        <button type="submit" class="btn-search"><?php esc_html_e( 'Tìm', 'canhcamtheme' ); ?></button>
                    </form>
                </div>
                <div class="message-search"><?php esc_html_e( 'Nhấn', 'canhcamtheme' ); ?><span> Esc</span><?php esc_html_e( ' để đóng', 'canhcamtheme' ); ?></div>
            </div>
        </div>
    </div>

    <div class="popup-modal quote-modal hidden"
         id="quote-modal"
         role="dialog"
         aria-modal="true"
         aria-labelledby="quote-modal-title">
        <div class="modal-wrap">
            <h2 id="quote-modal-title" class="heading-1 text-left text-primary-1 mb-4">
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

    <main>