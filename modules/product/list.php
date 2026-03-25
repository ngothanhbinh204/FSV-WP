<?php
$cid         = get_the_ID();
$title       = get_field( 'prd_s1_title', $cid );
$desc        = get_field( 'prd_s1_desc', $cid );
$catalogue   = get_field( 'prd_s1_catalogue', $cid );

$products_query = new WP_Query( array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
) );

?>
<section class="section-product-1">
    <div class="box-content">
        <?php if ( $title || $desc ) : ?>
        <div class="wrap-heading wrap-center" data-gsap-options="{&quot;type&quot;:&quot;split-chars&quot;,&quot;stagger&quot;:0.025}">
            <?php if ( $title ) : ?><h2 class="title"><?php echo esc_html( $title ); ?></h2><?php endif; ?>
            <?php if ( $desc ) : ?>
            <div class="sub-title">
                <?php echo wp_kses_post( $desc ); ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if ( $products_query->have_posts() ) : ?>
        <div class="box-list-product" data-aos="fade-up" data-aos-duration="500">
            <?php while ( $products_query->have_posts() ) : $products_query->the_post(); ?>
            <a href="<?php the_permalink(); ?>">
                <div class="items-product zoom-img-parent">
                    <div class="box-image img-zoom">
                        <div class="img-ratio ratio:pt-[381_340]">
                            <?php echo get_image_post( get_the_ID() ); ?>
                        </div>
                    </div>
                    <div class="box-title">
                        <h3 class="title"><?php the_title(); ?></h3>
                    </div>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php endif; ?>

        <?php if ( $catalogue ) : 
            $cat_url   = $catalogue['url'] ?: '#';
            $cat_title = $catalogue['title'] ?: __( 'Download Catalogue', 'canhcamtheme' );
        ?>
        <div class="box-btn">
            <a class="btn btn-primary" href="<?php echo esc_url( $cat_url ); ?>" download target="_blank">
                <span><?php _e("Download Catalogue", "canhcamtheme" ) ?></span>
                <i class="fa-sharp fa-regular fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>
