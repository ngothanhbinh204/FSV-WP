<?php
$cid      = get_the_ID();
$title    = get_field( 'about_team_title', $cid );
$subtitle = get_field( 'about_team_subtitle', $cid );
$gallery  = get_field( 'about_team_gallery', $cid );
?>
<section class="section-about-2">
    <div class="container">
        <div class="wrap-top">
            <?php if ( $title ) : ?><h2 class="title"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
            <?php if ( $subtitle ) : ?>
            <div class="sub-title">
                <?php echo wp_kses_post( $subtitle ); ?>
            </div>
            <?php endif; ?>
        </div>
        <?php if ( $gallery ) : ?>
        <div class="swiper-column-auto relative swiper-loop " data-id-swiper="section-about-2">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach ( $gallery as $img ) : ?>
                    <div class="swiper-slide">
                        <div class="box-image" data-parallax data-parallax-speed="14">
                            <a class="img-ratio ratio:pt-[740_1400]" href="<?php echo esc_url( $img['url'] ); ?>" data-fancybox>
                                <?php echo get_image_attrachment( $img ); ?>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="box-swiper">
                <div class="btn-swiper btn-prev btn-swiper-white" data-id-swiper="section-about-2">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
                <div class="btn-swiper btn-next btn-swiper-white" data-id-swiper="section-about-2">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
