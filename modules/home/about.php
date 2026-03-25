<?php
$cid               = get_option( 'page_on_front' );
$about_name        = get_field( 'home_about_name', $cid );
$about_slide_items = get_field( 'home_about_slide_items', $cid );
$about_desc        = get_field( 'home_about_desc', $cid );
$about_link        = get_field( 'home_about_link', $cid );
$about_image       = get_field( 'home_about_image', $cid );
?>
<section class="section-home-1">
    <div class="box-content">
        <div class="wrap-top">
            <?php if ( $about_name ) : ?>
            <div class="box-name-web">
                <h2 class="title"><span class="js-highlight"><?php echo esc_html( $about_name ); ?></span></h2>
            </div>
            <?php endif; ?>
            <?php if ( $about_slide_items ) : ?>
            <div class="swiper swiper-title">
                <div class="swiper-wrapper">
                    <?php foreach ( $about_slide_items as $slide ) :
                        $bg_url = get_image_attrachment( $slide['background'] ?? null, 'url' );
                    ?>
                    <div class="swiper-slide">
                        <div class="box-content">
                            <h3 class="title"<?php echo $bg_url ? ' data-background="' . esc_url( $bg_url ) . '"' : ''; ?>>
                                <?php echo esc_html( $slide['title'] ?? '' ); ?>
                            </h3>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php if ( $about_desc ) : ?>
        <div class="desc format-content"><?php echo wp_kses_post( $about_desc ); ?></div>
        <?php endif; ?>
        <?php if ( $about_link && ! empty( $about_link['url'] ) ) : ?>
        <div class="box-btn">
            <a class="btn btn-primary" href="<?php echo esc_url( $about_link['url'] ); ?>"<?php echo ! empty( $about_link['target'] ) ? ' target="' . esc_attr( $about_link['target'] ) . '"' : ''; ?>>
                <span><?php echo esc_html( $about_link['title'] ?: __( 'Explore more', 'canhcamtheme' ) ); ?></span>
                <i class="fa-sharp fa-regular fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>
    <?php if ( $about_image ) : ?>
    <div class="box-right">
        <div class="img-ratio ratio:pt-[678_780]">
            <?php echo get_image_attrachment( $about_image ); ?>
        </div>
    </div>
    <?php endif; ?>
</section>
