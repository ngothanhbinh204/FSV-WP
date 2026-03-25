<?php get_header(); ?>
<main>
    <div class="global-breadcrumb">
        <div class="container-fluid">
            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        </div>
    </div>
    <section class="news-detail relative z-50 pad-8">
        <div class="container">
            <div class="row">
                <div class="w-full col lg:w-8/12 relative">
                    <?php while (have_posts()): the_post(); 
                        $categories = get_the_category();
                        $cat_name = !empty($categories) ? $categories[0]->name : esc_html__('Tin tức', 'canhcamtheme');
                    ?>
                    <div class="block-wrap bg-white relative px-5">
                        <h2 class="heading-2 mb-8"><?php the_title(); ?></h2>
                        <div class="time-wrap mb-9 w-full relative flex-start pb-5 border-b border-primary-1 border-opacity-20">
                            <div class="type relative z-50 text-base mr-4 text-grey-500"><?= esc_html($cat_name); ?></div>
                            <time class="relative z-50 text-base text-grey-500"><?= get_the_date('d/m/Y'); ?></time>
                        </div>
                        <div class="fullcontent">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    
                    <div class="share flex-start">
                        <span class="body-1 mr-2"><?= esc_html__('Chia sẻ:', 'canhcamtheme'); ?></span>
                        <div class="social flex-end gap-5">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(get_permalink()); ?>" target="_blank" class="flex-center rounded-full bg-primary-1 text-base text-white overflow-hidden w-10 h-10 min-w-[40px] min-h-[40px] transition"><em class="fa-brands fa-facebook-f"></em></a>
                            <!-- Add dynamic sharing links below if required -->
                            <a href="#" class="flex-center rounded-full bg-primary-1 text-base text-white overflow-hidden w-10 h-10 min-w-[40px] min-h-[40px] transition"><em class="fa-brands fa-instagram"></em></a>
                            <a href="#" class="flex-center rounded-full bg-primary-1 text-base text-white overflow-hidden w-10 h-10 min-w-[40px] min-h-[40px] transition"><em class="fa-brands fa-youtube"></em></a>
                            <a href="#" class="flex-center rounded-full bg-primary-1 text-base text-white overflow-hidden w-10 h-10 min-w-[40px] min-h-[40px] transition"><em class="fa-brands fa-linkedin-in"></em></a>
                            <a href="https://zalo.me/share?url=<?= urlencode(get_permalink()); ?>" target="_blank" class="flex-center rounded-full bg-primary-1 text-base text-white overflow-hidden w-10 h-10 min-w-[40px] min-h-[40px] transition"><img src="<?= get_template_directory_uri(); ?>/img/zalo.svg" alt="Zalo Share"></a>
                        </div>
                    </div>
                </div>

                <!-- SIDEBAR: RELATED NEWS -->
                <div class="w-full col lg:w-4/12">
                    <div class="news-other relative z-50">
                        <h2 class="heading-1 mb-6 pb-5 text-primary-1 relative"><?= esc_html__('Tin tức khác', 'canhcamtheme'); ?></h2>
                        <div class="grid grid-cols-1 gap-8">
                            <?php
                            $related_args = array(
                                'post_type' => 'post',
                                'posts_per_page' => 3,
                                'post__not_in' => array(get_the_ID()),
                                'orderby' => 'rand'
                            );
                            if (!empty($categories)) {
                                $related_args['cat'] = $categories[0]->term_id;
                            }
                            $related_query = new WP_Query($related_args);
                            if ($related_query->have_posts()):
                                while ($related_query->have_posts()): $related_query->the_post();
                            ?>
                                    <div class="side-news overflow-hidden group">
                                        <div class="img zoom-in overflow-hidden relative">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php if (has_post_thumbnail()): ?>
                                                    <?php the_post_thumbnail('full', array('class' => 'lozad')); ?>
                                                <?php else: ?>
                                                    <img class="lozad" data-src="https://picsum.photos/1920/1080?nature=1" alt="<?php the_title_attribute(); ?>" loading="lazy"/>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="txt py-3">
                                            <div class="time-wrap relative flex-start">
                                                <?php 
                                                    $cats = get_the_category(); 
                                                    $c_name = !empty($cats) ? $cats[0]->name : __('Tin tức', 'canhcamtheme'); 
                                                ?>
                                                <div class="type"><?= esc_html($c_name); ?></div>
                                                <time><?= get_the_date('d/m/Y'); ?></time>
                                            </div>
                                            <h3 class="headline py-2">
                                                <a href="<?php the_permalink(); ?>" class="group-hover:text-primary-1 heading-3 line-clamp-2"><?php the_title(); ?></a>
                                            </h3>
                                        </div>
                                    </div>
                            <?php 
                                endwhile;
                                wp_reset_postdata();
                            endif; 
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
