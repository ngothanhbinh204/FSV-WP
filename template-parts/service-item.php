<?php 
$slug = get_post_field('post_name', get_post());
$title = get_the_title();
$excerpt = wp_trim_words(get_the_excerpt() ?: strip_tags(get_field('service_main_desc')), 25, '...');

if (has_post_thumbnail()) {
    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $thumbnail_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
} else {
    $thumbnail_url = 'https://picsum.photos/1920/1080?nature=1'; 
    $thumbnail_alt = $title;
}
?>

<div class="col w-full lg:w-1/2 mb-8">
    <div class="item group">
        <div class="img zoom-in overflow-hidden">
            <a href="<?= esc_url(get_permalink()); ?>" class="img-ratio ratio:pt-[490_740]">
                <img class="lozad" data-src="<?= esc_url($thumbnail_url); ?>" alt="<?= esc_attr($thumbnail_alt); ?>" loading="lazy" />
            </a>
        </div>
        <div class="txt p-6 bg-primary-4 bg-opacity-15">
            <h3 class="mb-2">
                <a href="<?= esc_url(get_permalink()); ?>" class="heading-1 group-hover:text-primary-1 line-clamp-2"><?= esc_html($title); ?></a>
            </h3>
            <div class="desc body-1 line-clamp-3"><?= esc_html($excerpt); ?></div>
            <div class="btn-wrap mt-6">
                <a href="<?= esc_url(get_permalink()); ?>" class="btn btn-primary default">
                    <span><?= esc_html__('Xem thêm', 'canhcamtheme'); ?></span>
                    <em class="fa-regular fa-long-arrow-right"></em>
                </a>
            </div>
        </div>
    </div>
</div>
