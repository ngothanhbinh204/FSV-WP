<?php get_header(); ?>
<main>
    <?php
    $banner_img = get_field('service_banner_img');
    $banner_sub = get_field('service_banner_sub');
    $banner_title = get_field('service_banner_title');
    if (!$banner_title) {
        $banner_title = get_the_title();
    }
    if (!$banner_img) {
        // Fallback to post thumbnail
        $banner_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    } else {
        $banner_img_url = $banner_img['url'];
    }
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
                                    <h3 class="sub-title heading-5"><?= esc_html($banner_sub); ?></h3>
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

    <!-- MAIN INTRO TEXT -->
    <?php $main_desc = get_field('service_main_desc'); ?>
    <?php if ($main_desc || !empty(trim(strip_tags(get_the_title())))): ?>
        <section class="service-storage-1 pad-t-8">
            <div class="container">
                <h2 class="heading-2 mb-8 text-center"><?php the_title(); ?></h2>
                <div class="desc body-1">
                    <?= wp_kses_post($main_desc); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- SERVICE BLOCKS -->
    <?php if (have_rows('service_blocks')): ?>
        <section class="service-reserve pad-b-8">
            <?php while (have_rows('service_blocks')): the_row(); 
                $b_title = get_sub_field('title');
                $b_content = get_sub_field('content');
                $b_gallery = get_sub_field('gallery');
            ?>
                <div class="content-block">
                    <div class="container">
                        <div class="row">
                            <div class="col w-full lg:w-1/2">
                                <div class="content-wrap">
                                    <?php if ($b_title): ?>
                                        <h2 class="heading-2 text-center mb-8"><?= esc_html($b_title); ?></h2>
                                    <?php endif; ?>
                                    <div class="desc body-1 table-wrapper">
                                        <?= wp_kses_post($b_content); ?>
                                    </div>
                                </div>
                            </div>
                            <?php if ($b_gallery): ?>
                                <div class="col w-full lg:w-1/2">
                                    <div class="single init-swiper my-auto">
                                        <div class="swiper">
                                            <div class="swiper-wrapper">
                                                <?php foreach ($b_gallery as $image): ?>
                                                    <div class="swiper-slide">
                                                        <div class="img zoom-in overflow-hidden">
                                                            <a class="img-ratio ratio:pt-[390_690]">
                                                                <img class="lozad" data-src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>" loading="lazy" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </section>
    <?php endif; ?>

    <!-- DEMAND TAB -->
    <?php 
    $demand_title = get_field('service_demand_title');
    $demand_desc = get_field('service_demand_desc');
    if (have_rows('service_demand_items')): 
    ?>
    <section class="service-demand pad-8">
        <div class="container">
            <?php if ($demand_title): ?>
                <h2 class="heading-2 text-center mb-8"><?= esc_html($demand_title); ?></h2>
            <?php endif; ?>
            <?php if ($demand_desc): ?>
                <div class="desc body-1 col px-0 w-full lg:w-10/12 xl:w-8/12 text-center mx-auto">
                    <?= wp_kses_post($demand_desc); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <?php while (have_rows('service_demand_items')): the_row();
                    $icon = get_sub_field('icon');
                    $title = get_sub_field('title');
                ?>
                    <div class="col w-full sm:w-1/2 md:w-4/12">
                        <div class="item">
                            <?php if ($icon): ?>
                                <div class="icon"><a><img class="lozad" data-src="<?= esc_url($icon['url']); ?>" alt="<?= esc_attr($title); ?>"></a></div>
                            <?php endif; ?>
                            <?php if ($title): ?>
                                <h3 class="heading-1 text-center mt-5"><?= esc_html($title); ?></h3>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- FAQ TAB -->
    <?php if (have_rows('service_faq_groups')): ?>
        <section class="service-faq pad-8 bg-primary-2">
            <h2 class="heading-2 text-white text-center mb-8">FAQ</h2>
            <div class="container">
                <?php while (have_rows('service_faq_groups')): the_row();
                    $group_title = get_sub_field('group_title');
                ?>
                    <div class="row">
                        <div class="col w-full lg:w-10/12 mx-auto">
                            <?php if ($group_title): ?>
                                <h3 class="heading-1 text-white mb-6"><?= esc_html($group_title); ?></h3>
                            <?php endif; ?>
                            
                            <?php if (have_rows('faqs')): ?>
                                <div class="faq-wrap toggle-wrap">
                                    <?php 
                                    $faq_count = 1;
                                    while (have_rows('faqs')): the_row();
                                        $question = get_sub_field('question');
                                        $answer = get_sub_field('answer');
                                    ?>
                                        <div class="toggle-item">
                                            <div class="title">
                                                <span><?= str_pad($faq_count, 2, '0', STR_PAD_LEFT); ?>. <?= esc_html($question); ?></span>
                                                <em class="mdi mdi-chevron-down"></em>
                                            </div>
                                            <div class="article">
                                                <div class="desc body-1">
                                                    <?= wp_kses_post($answer); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php 
                                    $faq_count++;
                                    endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- RELATED SERVICES -->
    <?php
    $related_services = new WP_Query(array(
        'post_type' => 'service',
        'posts_per_page' => 4,
        'post__not_in' => array(get_the_ID()),
        'orderby' => 'rand'
    ));
    if ($related_services->have_posts()):
    ?>
    <section class="service-detail-2 pad-8 bg-primary-1 bg-opacity-5">
        <div class="container">
            <h2 class="heading-2 text-center mb-8"><?= esc_html__('Dịch vụ khác', 'canhcamtheme'); ?></h2>
            <div class="auto-3 init-swiper relative">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php while ($related_services->have_posts()): $related_services->the_post(); ?>
                            <div class="swiper-slide">
                                <div class="item overflow-hidden rounded-4 hover-grid">
                                    <div class="img zoom-in">
                                        <a href="<?php the_permalink(); ?>" class="img-ratio ratio:pt-[440_390]">
                                            <?php if (has_post_thumbnail()): ?>
                                                <?php the_post_thumbnail('full', array('class' => 'lozad')); ?>
                                            <?php else: ?>
                                                <img class="lozad" data-src="https://picsum.photos/1920/1080?nature=1" alt="<?php the_title_attribute(); ?>" loading="lazy" />
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <div class="txt absolute-center pointer-events-none w-full h-full z-50 p-6 lg:p-8">
                                        <h3 class="heading-1 text-white mb-5"><?php the_title(); ?></h3>
                                        <div class="txt-grid">
                                            <div>
                                                <div class="desc body-1 text-white line-clamp-3">
                                                    <?php echo wp_trim_words(get_the_excerpt() ?: strip_tags(get_field('service_main_desc')), 20, '...'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
                <div class="swiper-nav">
                    <div class="prev"></div>
                    <div class="next"></div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- BANNER CONTACT -->
    <section class="banner-contact bg-primary-2 border-t border-white pad-8">
        <div class="container">
            <div class="row">
                <div class="col w-full lg:w-11/12 ml-auto">
                    <div class="block-wrap flex-between max-md:flex-col max-md:gap-8">
                        <h2 class="heading-2 text-white"><?= esc_html__('Liên hệ với chúng tôi', 'canhcamtheme'); ?></h2>
                        <div class="btn-wrap">
                            <a href="<?= esc_url(home_url('/lien-he/')); ?>" class="btn btn-primary white">
                                <span><?= esc_html__('Liên hệ', 'canhcamtheme'); ?></span>
                                <em class="fa-regular fa-long-arrow-right"></em>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
