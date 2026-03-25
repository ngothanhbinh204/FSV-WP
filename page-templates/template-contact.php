<?php
/* Template Name: Liên hệ (Contact) */
get_header(); 
?>
<main>
    <?php
    $banner_img = get_field('banner_img');
    $banner_sub = get_field('banner_sub_title');
    $banner_title = get_field('banner_title');

    if (!$banner_title) {
        $banner_title = get_the_title();
    }
    if (!$banner_img) {
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

    <!-- MAIN CONTACT -->
    <section class="contact-us pad-8">
        <div class="container">
            <div class="row">
                <!-- FORM -->
                <div class="col w-full lg:w-8/12">
                    <div class="txt">
                        <h2 class="heading-2 mb-8"><?= esc_html(get_field('contact_title')); ?></h2>
                        <?php if ($contact_desc = get_field('contact_desc')): ?>
                            <div class="frm-msg body-1 mb-6"><?= wp_kses_post($contact_desc); ?></div>
                        <?php endif; ?>
                        
                        <div class="wrap-form">
                            <?php 
                            $form_shortcode = get_field('contact_form_shortcode'); 
                            if ($form_shortcode) {
                                echo do_shortcode($form_shortcode);
                            } else {
                                echo '<p>' . esc_html__('Vui lòng thêm shortcode Form trong trang cấu hình.', 'canhcamtheme') . '</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                
                <!-- ADDRESS & INFO -->
                <div class="col w-full lg:w-4/12 mt-8 lg:mt-0">
                    <div class="bg-wrap bg-grey-50 p-6 rounded-3 lg:p-10 bg-primary-1">
                        <h2 class="heading-1 uppercase text-white text-center mb-5"><?= esc_html(get_field('company_name')); ?></h2>
                        <?php if (have_rows('contact_address_list')): ?>
                        <address>
                            <ul>
                                <?php while (have_rows('contact_address_list')): the_row(); 
                                    $icon_class = get_sub_field('icon');
                                    $content = get_sub_field('content');
                                ?>
                                <li>
                                    <em class="<?= esc_attr($icon_class); ?>"></em>
                                    <div class="content-wrap d-inline-block text-white" style="flex:1">
                                        <?= wp_kses_post($content); ?>
                                    </div>
                                </li>
                                <?php endwhile; ?>
                            </ul>
                        </address>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MAP -->
    <?php if ($map_iframe = get_field('google_map_iframe')): ?>
    <section class="contact-map pad-b-8">
        <div class="container">
            <div class="map-wrap">
                <!-- Dùng kses để cho phép iframe render an toàn -->
                <?= wp_kses($map_iframe, array(
                    'iframe' => array(
                        'src' => true,
                        'width' => true,
                        'height' => true,
                        'frameborder' => true,
                        'style' => true,
                        'allowfullscreen' => true,
                        'loading' => true,
                        'referrerpolicy' => true
                    )
                )); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

</main>
<?php get_footer(); ?>
