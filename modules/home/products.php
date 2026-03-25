<?php
$cid            = get_the_ID();
$products_title = get_field( 'home_products_title', $cid );
$products_desc  = get_field( 'home_products_desc', $cid );
$products_bg    = get_field( 'home_products_bg', $cid );
$products_items = get_posts( array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
) );
?>
<section class="section-home-4"<?php echo $products_bg ? ' data-background="' . esc_url( get_image_attrachment( $products_bg, 'url' ) ) . '"' : ''; ?>>
    <div class="container">
        <?php if ( $products_title || $products_desc ) : ?>
        <div class="wrap-heading wrap-center" data-gsap-options="{&quot;type&quot;:&quot;split-chars&quot;,&quot;stagger&quot;:0.025}">
            <?php if ( $products_title ) : ?><h2 class="title"><?php echo esc_html( $products_title ); ?></h2><?php endif; ?>
            <?php if ( $products_desc ) : ?><div class="sub-title"><p><?php echo wp_kses_post( $products_desc ); ?></p></div><?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="swiper-column-auto auto-4-column swiper-loop mt-base relative" data-id-swiper="product-categories">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php if ( $products_items ) : foreach ( $products_items as $prod ) :
                        $prod_id    = is_object( $prod ) ? $prod->ID : ( $prod['ID'] ?? 0 );
                        $prod_title = get_the_title( $prod_id );
                        $prod_thumb = get_the_post_thumbnail_url( $prod_id, 'large' ) ?: get_template_directory_uri() . '/img/product.jpg';
                        $prod_url   = get_permalink( $prod_id );
                    ?>
                    <div class="swiper-slide">
                        <a href="<?php echo esc_url( $prod_url ); ?>">
                            <div class="items-product zoom-img-parent">
                                    <div class="box-image img-zoom">
                                        <div class="img-ratio ratio:pt-[381_340]">
                                            <?php echo get_image_post( $prod_id ); ?>
                                        </div>
                                    </div>
                                <div class="box-title">
                                    <h3 class="title"><?php echo esc_html( $prod_title ); ?></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <div class="box-swiper">
                <div class="btn-swiper btn-prev btn-swiper-white" data-id-swiper="product-categories"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></div>
                <div class="btn-swiper btn-next btn-swiper-white" data-id-swiper="product-categories"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></div>
            </div>
        </div>
    </div>
</section>
