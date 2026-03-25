<?php
/*
Template Name: News Listing
*/
get_header(); ?>
    <section class="section-new-list">
        <div class="container">
            <div class="section-py">
                <h1 class="heading-1 text-primary-1 mb-base"><?php the_title(); ?></h1>
                
                <?php
                $categories = get_categories( array(
                    'hide_empty' => true,
                ) );
                if ( ! empty( $categories ) ) :
                ?>
                <div class="scroll-menu">
                    <ul>
                        <li class="active">
                            <a href="<?php the_permalink(); ?>"><?php _e( 'All', 'canhcamtheme' ); ?></a>
                        </li>
                        <?php foreach ( $categories as $cat ) : ?>
                        <li>
                            <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $news_query = new WP_Query( array(
                    'post_type'      => 'post',
                    'posts_per_page' => get_option( 'posts_per_page' ),
                    'paged'          => $paged,
                    'post_status'    => 'publish',
                ) );

                if ( $news_query->have_posts() ) :
                ?>
                <div class="block-grid mt-base">
                    <?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
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
                    <?php endwhile; ?>
                </div>

                <div class="btn-pagination mt-base flex-center">
                    <?php canhcam_pagination( $news_query ); ?>
                </div>

                <?php wp_reset_postdata(); else : ?>
                <div class="mt-base text-center">
                    <p><?php _e( 'No posts found.', 'canhcamtheme' ); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php get_footer(); ?>
