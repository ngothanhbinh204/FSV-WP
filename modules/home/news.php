<?php
$cid      = get_the_ID();
$news_title    = get_field( 'home_news_title', $cid );
$news_desc     = get_field( 'home_news_desc', $cid );
$post_type     = get_field( 'home_news_post_type', $cid ) ?: 'post';
$taxonomy      = get_field( 'home_news_taxonomy', $cid ) ?: 'category';
$limit         = get_field( 'home_news_limit', $cid ) ?: 6;
$news_link     = get_field( 'home_news_link', $cid );

$terms = get_terms( array(
    'taxonomy'   => $taxonomy,
    'hide_empty' => true,
) );
?>
<section class="section-home-5">
    <div class="wrap" data-toggle="tabslet" data-active="1" data-animation="true">
        <?php if ( $news_title || $news_desc ) : ?>
        <div class="wrap-heading wrap-center" data-gsap-options="{&quot;type&quot;:&quot;split-chars&quot;,&quot;stagger&quot;:0.025}">
            <?php if ( $news_title ) : ?><h2 class="title"><?php echo esc_html( $news_title ); ?></h2><?php endif; ?>
            <?php if ( $news_desc ) : ?><div class="sub-title"><p><?php echo esc_html( $news_desc ); ?></p></div><?php endif; ?>
        </div>
        <?php endif; ?>

        <ul class="tabslet-tab">
            <li><a href="#home-news-tab-all"><?php esc_html_e( 'All', 'canhcamtheme' ); ?></a></li>
            <?php if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) : foreach ( $terms as $term ) : ?>
            <li><a href="#home-news-tab-<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
            <?php endforeach; endif; ?>
        </ul>

        <?php 
        // Tab All
        $all_query = new WP_Query( array(
            'post_type'      => $post_type,
            'posts_per_page' => $limit,
            'post_status'    => 'publish',
        ) );
        ?>
        <div class="tabslet-content" id="home-news-tab-all">
            <div class="swiper-column-auto auto-3-column">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php if ( $all_query->have_posts() ) : while ( $all_query->have_posts() ) : $all_query->the_post(); 
                            $thumb     = get_the_post_thumbnail_url( null, 'large' ) ?: get_template_directory_uri() . '/img/banner.jpg';
                            $post_cats = get_the_terms( get_the_ID(), $taxonomy );
                            $cat_label = ( ! is_wp_error( $post_cats ) && ! empty( $post_cats ) ) ? esc_html( $post_cats[0]->name ) : '';
                        ?>
                        <div class="swiper-slide">
                            <a href="<?php the_permalink(); ?>">
                                <div class="items-news zoom-img-parent">
                                    <div class="box-image img-zoom">
                                        <div class="img-ratio ratio:pt-[293_440]">
                                            <?php echo get_image_post( get_the_ID() ); ?>
                                        </div>
                                    </div>
                                    <div class="box-content">
                                        <div class="box-date-cate">
                                            <?php if ( $cat_label ) : ?><span class="cate"><?php echo $cat_label; ?></span><?php endif; ?>
                                            <span class="date"><?php echo get_the_date( 'd.m.Y' ); ?></span>
                                        </div>
                                        <div class="box-title">
                                            <span class="title"><?php the_title(); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endwhile; wp_reset_postdata(); endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php 
        // Category Tabs
        if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) : foreach ( $terms as $term ) : 
            $term_query = new WP_Query( array(
                'post_type'      => $post_type,
                'posts_per_page' => $limit,
                'post_status'    => 'publish',
                'tax_query'      => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field'    => 'slug',
                        'terms'    => $term->slug,
                    ),
                ),
            ) );
        ?>
        <div class="tabslet-content" id="home-news-tab-<?php echo esc_attr( $term->slug ); ?>">
            <div class="swiper-column-auto auto-3-column">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php if ( $term_query->have_posts() ) : while ( $term_query->have_posts() ) : $term_query->the_post(); 
                            $thumb     = get_the_post_thumbnail_url( null, 'large' ) ?: get_template_directory_uri() . '/img/banner.jpg';
                        ?>
                        <div class="swiper-slide">
                            <a href="<?php the_permalink(); ?>">
                                <div class="items-news zoom-img-parent">
                                    <div class="box-image img-zoom">
                                        <div class="img-ratio ratio:pt-[293_440]">
                                            <?php echo get_image_post( get_the_ID() ); ?>
                                        </div>
                                    </div>
                                    <div class="box-content">
                                        <div class="box-date-cate">
                                            <span class="cate"><?php echo esc_html( $term->name ); ?></span>
                                            <span class="date"><?php echo get_the_date( 'd.m.Y' ); ?></span>
                                        </div>
                                        <div class="box-title">
                                            <span class="title"><?php the_title(); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endwhile; wp_reset_postdata(); endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; endif; ?>

        <?php if ( $news_link && ! empty( $news_link['url'] ) ) : ?>
        <div class="box-btn wrap-center">
            <a class="btn btn-primary" href="<?php echo esc_url( $news_link['url'] ); ?>"<?php echo ! empty( $news_link['target'] ) ? ' target="' . esc_attr( $news_link['target'] ) . '"' : ''; ?>>
                <span><?php echo esc_html( $news_link['title'] ?: __( 'View more', 'canhcamtheme' ) ); ?></span>
                <i class="fa-sharp fa-regular fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>
