<?php get_header(); ?>
    <?php while ( have_posts() ) : the_post(); 
        $post_id    = get_the_ID();
        $categories = get_the_category();
        $cat_name   = !empty( $categories ) ? $categories[0]->name : __( 'News', 'canhcamtheme' );
    ?>
    <section class="section-new-detail">
        <div class="container">
            <div class="section-py">
                <div class="main-content-new">
                    <h1 class="heading-2 text-primary-1 mb-base"><?php the_title(); ?></h1>
                    <div class="sub-title">
                        <div class="sub-title-left">
                            <span><?php echo esc_html( $cat_name ); ?></span>
                            <div class="date">
                                <i class="fa-light fa-calendar-day" aria-hidden="true"></i>
                                <span><?php echo get_the_date( 'd.m.Y' ); ?></span>
                            </div>
                        </div>
                        <div class="sub-title-right"></div>
                    </div>
                    <div class="content-new mt-base">
                        <div class="prose">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php 
    $related_args = array(
        'post_type'      => 'post',
        'posts_per_page' => 6,
        'post__not_in'   => array( $post_id ),
        'orderby'        => 'rand'
    );
    if ( !empty( $categories ) ) {
        $related_args['cat'] = $categories[0]->term_id;
    }
    $related_query = new WP_Query( $related_args );

    if ( $related_query->have_posts() ) :
    ?>
    <section class="section-service-detail-5">
        <div class="block-bg">
            <div class="container">
                <h6 class="heading-1 text-center mb-base"><?php _e( 'Other news', 'canhcamtheme' ); ?></h6>
                <div class="swiper-column-auto auto-3-column swiper-loop" data-swiper-id="service-detail">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                            <div class="swiper-slide">
                                <div class="card-news group">
                                    <a class="img-ratio ratio:pt-[292_440] zoom-img" href="<?php the_permalink(); ?>">
                                        <?php echo get_image_post( get_the_ID() ); ?>
                                    </a>
                                    <div class="card-content">
                                        <div class="card-date">
                                            <i class="fa-light fa-calendar-day" aria-hidden="true"></i>
                                            <span><?php echo get_the_date( 'd.m.Y' ); ?></span>
                                        </div>
                                        <div class="card-title">
                                            <a class="heading-5 text-primary-2 font-bold line-clamp-2 group-hover:text-primary-1" href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <div class="box-swiper">
                        <div class="btn-swiper btn-prev btn-swiper-white" data-swiper-id="service-detail">
                            <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                        </div>
                        <div class="btn-swiper btn-next btn-swiper-white" data-swiper-id="service-detail">
                            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php endwhile; ?>
<?php get_footer(); ?>
