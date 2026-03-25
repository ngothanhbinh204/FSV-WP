<?php get_header(); ?>
<main>
    <div class="global-breadcrumb">
        <div class="container-fluid">
            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        </div>
    </div>
    
    <section class="search-results pad-8 bg-white min-h-[50vh]">
        <div class="container">
            <h1 class="heading-2 text-center mb-10">
                <?= esc_html__('Kết quả tìm kiếm cho: ', 'canhcamtheme'); ?>"<?= esc_html(get_search_query()); ?>"
            </h1>

            <?php
            $search_term = get_search_query();

            // Lấy tất cả bài viết POST (Tin tức) khớp từ khóa
            $news_args = array(
                's' => $search_term,
                'post_type' => 'post',
                'posts_per_page' => -1,
                'post_status' => 'publish'
            );
            $news_query = new WP_Query($news_args);

            // Lấy tất cả bài viết SERVICE (Dịch vụ) khớp từ khóa
            $service_args = array(
                's' => $search_term,
                'post_type' => 'service',
                'posts_per_page' => -1,
                'post_status' => 'publish'
            );
            $service_query = new WP_Query($service_args);

            // Lấy tất cả bài viết RECRUITMENT (Tuyển dụng) khớp từ khóa
            $recruit_args = array(
                's' => $search_term,
                'post_type' => 'recruitment',
                'posts_per_page' => -1,
                'post_status' => 'publish'
            );
            $recruit_query = new WP_Query($recruit_args);
            
            $total_results = $news_query->found_posts + $service_query->found_posts + $recruit_query->found_posts;
            
            if ($total_results > 0): 
            ?>
                <!-- Khối Tin Tức -->
                <?php if ($news_query->have_posts()): ?>
                <div class="search-group-wrap mb-12 pb-10 border-b border-primary-1 border-opacity-20 last:border-0">
                    <h2 class="heading-3 mb-6 relative pl-4 border-l-4 border-primary-1"><?= esc_html__('Tin tức', 'canhcamtheme'); ?> (<?= $news_query->found_posts; ?>)</h2>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <?php while ($news_query->have_posts()): $news_query->the_post(); ?>
                            <div class="news-item overflow-hidden group rounded-3 bg-primary-1 flex flex-col h-full">
                                <div class="img zoom-in overflow-hidden relative">
                                    <a href="<?php the_permalink(); ?>" class="img-ratio ratio:pt-[505_825]">
                                        <?php if (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('full', array('class' => 'lozad')); ?>
                                        <?php else: ?>
                                            <img class="lozad" src="https://picsum.photos/1920/1080?nature=1" alt="<?php the_title_attribute(); ?>" loading="lazy"/>
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="txt p-6 flex-1 flex flex-col">
                                    <time class="text-white body-4" datetime="<?= get_the_date('c'); ?>"><?= get_the_date('d.m.Y'); ?></time>
                                    <h3 class="headline pt-4 pb-2">
                                        <a href="<?php the_permalink(); ?>" class="heading-1 group-hover:underline text-white line-clamp-2"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="desc body-1 text-white line-clamp-3">
                                        <?= wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Khối Dịch Vụ -->
                <?php if ($service_query->have_posts()): ?>
                <div class="search-group-wrap mb-12 pb-10 border-b border-primary-1 border-opacity-20 last:border-0">
                    <h2 class="heading-3 mb-6 relative pl-4 border-l-4 border-primary-1"><?= esc_html__('Dịch vụ', 'canhcamtheme'); ?> (<?= $service_query->found_posts; ?>)</h2>
                    <div class="row flex flex-wrap">
                        <?php while ($service_query->have_posts()): $service_query->the_post(); ?>
                            <?php get_template_part('template-parts/service-item'); ?>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Khối Tuyển Dụng -->
                <?php if ($recruit_query->have_posts()): ?>
                <div class="search-group-wrap mb-10 pb-10 last:border-0">
                    <h2 class="heading-3 mb-6 relative pl-4 border-l-4 border-primary-1"><?= esc_html__('Tuyển dụng', 'canhcamtheme'); ?> (<?= $recruit_query->found_posts; ?>)</h2>
                    <div class="table-res" style="overflow-x:auto;">
                        <table class="w-full text-left">
                            <thead>
                                <tr>
                                    <th class="p-4 bg-primary-1 text-white whitespace-nowrap"><?= esc_html__('STT', 'canhcamtheme'); ?></th>
                                    <th class="p-4 bg-primary-1 text-white whitespace-nowrap"><?= esc_html__('Vị trí tuyển dụng', 'canhcamtheme'); ?></th>
                                    <th class="p-4 bg-primary-1 text-white whitespace-nowrap"><?= esc_html__('Hạn nộp hồ sơ', 'canhcamtheme'); ?></th>
                                    <th class="p-4 bg-primary-1 text-white whitespace-nowrap"><?= esc_html__('Địa điểm', 'canhcamtheme'); ?></th>
                                    <th class="p-4 bg-primary-1 text-white whitespace-nowrap"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $count = 1;
                                while ($recruit_query->have_posts()): $recruit_query->the_post(); 
                                    set_query_var('current_ajax_count', $count);
                                    get_template_part('template-parts/recruitment-item');
                                    $count++;
                                endwhile; wp_reset_postdata(); 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>

            <?php else: ?>
                <div class="text-center py-10 w-full max-w-xl mx-auto">
                    <em class="fa-regular fa-search text-5xl text-grey-300 mb-6"></em>
                    <p class="mb-8 text-xl"><?= esc_html__('Không tìm thấy kết quả nào phù hợp với từ khóa của bạn.', 'canhcamtheme'); ?></p>
                    <a href="<?= esc_url(home_url('/')); ?>" class="btn btn-primary inline-flex">
                        <span><?= esc_html__('Trở lại trang chủ', 'canhcamtheme'); ?></span>
                        <em class="fa-regular fa-arrow-right"></em>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>