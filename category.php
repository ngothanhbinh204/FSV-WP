<?php get_header(); ?>
<main>
    <?php
    $cat = get_queried_object();
    $banner_title = single_cat_title('', false);
    $banner_sub = category_description();
    
    // Nếu category có setup acf image banner thì có thể lấy ở đây, tạm thời dùng hình mặc định
    // VD: $banner_img = get_field('banner_img', $cat);
    $banner_img_url = 'https://picsum.photos/1920/1080?nature=1';
    ?>
    <div class="banner-breadcrumb relative">
        <section class="top-banner init-swiper single">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="item relative">
                            <div class="img"><a><img src="<?= esc_url($banner_img_url); ?>" alt="<?= esc_attr($banner_title); ?>"></a></div>
                            <div class="container absolute-x top-0 text-white z-20">
                                <?php if ($banner_sub): ?>
                                    <h3 class="sub-title heading-5"><?= wp_kses_post($banner_sub); ?></h3>
                                <?php endif; ?>
                                <h3 class="title heading-6"><?= esc_html($banner_title); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="global-breadcrumb">
            <div class="container-fluid">
                <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
            </div>
        </div>
    </div>

    <section class="news-list pad-8">
        <div class="container">
            <h2 class="heading-2 mb-9"><?= esc_html($banner_title); ?></h2>
            
            <?php
            // Không cần custom WP_Query, category.php dùng biến toàn cục $wp_query
            global $wp_query;
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            ?>

            <?php if (have_posts()): ?>
                
                <?php 
                // Nếu đang ở trang đầu tiên và có ít nhất 1 bài, lấy bài đầu làm News Big
                if ($paged == 1 && have_posts()): 
                    the_post(); 
                    $categories = get_the_category();
                    $cat_name = !empty($categories) ? $categories[0]->name : esc_html__('Tin tức', 'canhcamtheme');
                ?>
                <div class="news-big overflow-hidden relative group rounded-4 row bg-primary-1">
                    <div class="col w-full lg:w-8/12">
                        <div class="img zoom-in">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('full', array('class' => 'lozad')); ?>
                                <?php else: ?>
                                    <img class="lozad" src="https://picsum.photos/1920/1080?nature=1" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <div class="col w-full lg:w-4/12">
                        <div class="txt p-6 col-hor w-full lg:p-8">
                            <div class="category text-white mb-3 text-sm"><?= esc_html($cat_name); ?></div>
                            <h3 class="headline mb-4 pb-4 relative">
                                <a href="<?php the_permalink(); ?>" class="heading-1 text-white line-clamp-2 group-hover:underline"><?php the_title(); ?></a>
                            </h3>
                            <div class="desc text-white body-1 line-clamp-3">
                                <?= wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                            </div>
                            <time class="text-white mt-3"><?= get_the_date('d.m.Y'); ?></time>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="grid gap-6 pt-8 sm:grid-cols-2 md:gap-8 md:grid-cols-3 md:pt-10">
                    <?php while (have_posts()): the_post(); ?>
                        <div class="news-item overflow-hidden group rounded-3 bg-primary-1">
                            <div class="img zoom-in overflow-hidden relative">
                                <a href="<?php the_permalink(); ?>" class="img-ratio ratio:pt-[505_825]">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('full', array('class' => 'lozad')); ?>
                                    <?php else: ?>
                                        <img class="lozad" src="https://picsum.photos/1920/1080?nature=1" alt="<?php the_title_attribute(); ?>" loading="lazy"/>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="txt p-6">
                                <time class="text-white body-4"><?= get_the_date('d.m.Y'); ?></time>
                                <h3 class="headline pt-4 pb-2">
                                    <a href="<?php the_permalink(); ?>" class="heading-1 group-hover:underline text-white line-clamp-2"><?php the_title(); ?></a>
                                </h3>
                                <div class="desc body-1 text-white line-clamp-3">
                                    <?= wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <div class="pages modulepager mt-10">
                    <?php 
                        canhcam_pagination($wp_query, array(
                            'is_ajax' => false 
                        )); 
                    ?>
                </div>

            <?php else: ?>
                <p class="text-center w-full my-8"><?= esc_html__('Chưa có tin tức nào trong danh mục này.', 'canhcamtheme'); ?></p>
            <?php endif; ?>

        </div>
    </section>
</main>
<?php get_footer(); ?>
