<?php
$cid      = get_the_ID();
$title    = get_field( 'prd_s3_title', $cid );
$subtitle = get_field( 'prd_s3_subtitle', $cid );
$list     = get_field( 'prd_s3_list', $cid );
$gallery  = get_field( 'prd_s3_gallery', $cid );

if ( ! $title && ! $subtitle && ! $list && ! $gallery ) return;
?>
<section class="section-product-3">
    <div class="box-content">
        <div class="wrap-top">
            <?php if ( $title ) : ?>
            <div class="box-left" data-aos="fade-right" data-aos-duration="500">
                <h2 class="title"><?php echo esc_html( $title ); ?></h2>
            </div>
            <?php endif; ?>
            <div class="box-right" data-aos="fade-left" data-aos-duration="500">
                <?php if ( $subtitle ) : ?>
                <div class="sub-title">
                    <p><?php echo esc_html( $subtitle ); ?></p>
                </div>
                <?php endif; ?>
                <?php if ( $list ) : ?>
                <div class="format-content list-compliance">
                    <ul>
                        <?php foreach ( $list as $item ) : ?>
                        <li><?php echo wp_kses_post( $item['text'] ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if ( $gallery ) : ?>
        <div class="box-list-compliance" data-aos="fade-up" data-aos-duration="500" data-aos-delay="300">
            <div class="swiper swiper-compliance">
                <div class="swiper-wrapper">
                    <?php foreach ( $gallery as $img ) : ?>
                    <div class="swiper-slide">
                        <a href="<?php echo esc_url( $img['url'] ); ?>" data-fancybox="product-compliance">
                            <div class="box-image zoom-img">
                                <div class="img-ratio ratio:pt-[453_680]">
                                    <?php echo get_image_attrachment( $img ); ?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="box-swiper">
                <div class="btn-swiper btn-prev btn-swiper-white"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></div>
                <div class="btn-swiper btn-next btn-swiper-white"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
