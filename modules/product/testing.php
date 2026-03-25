<?php
$cid      = get_the_ID();
$title    = get_field( 'prd_s2_title', $cid );
$subtitle = get_field( 'prd_s2_subtitle', $cid );
$list     = get_field( 'prd_s2_list', $cid );
$gallery  = get_field( 'prd_s2_gallery', $cid );

if ( ! $title && ! $subtitle && ! $list && ! $gallery ) return;
?>
<section class="section-product-2">
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
                <div class="format-content list-testing">
                    <ul>
                        <?php foreach ( $list as $item ) : ?>
                        <li><?php echo esc_html( $item['text'] ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if ( $gallery ) : ?>
        <div class="box-list-media" data-aos="fade-up" data-aos-duration="500" data-aos-delay="300">
            <?php foreach ( $gallery as $img ) : ?>
            <a class="items-media zoom-img" href="<?php echo esc_url( $img['url'] ); ?>" data-fancybox="product-testing">
                <div class="box-image">
                    <div class="img-ratio">
                        <?php echo get_image_attrachment( $img ); ?>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
