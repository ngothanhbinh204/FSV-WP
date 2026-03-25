<?php
$cid        = get_the_ID();
$banner_bg  = get_field( 'about_banner_img', $cid );
$thumb      = $banner_bg ? $banner_bg['url'] : 'https://picsum.photos/1920/1080?random';
?>
<section class="section-banner-basic">
    <div class="box-image" data-parallax data-parallax-speed="14">
        <div class="img-banner img-ratio xl:ratio:pt-[580_1920] md:ratio:pt-[1_1] ratio:pt-[15_10] ">
            <?php echo get_image_attrachment( $banner_bg ); ?>
        </div>
    </div>
    <section class="global-breadcrumb">
        <div class="section-px">
            <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
                <p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Trang chủ', 'canhcamtheme' ); ?></a>
                    <span class="separator"> |</span>
                    <span class="last"><?php the_title(); ?></span>
                </p>
            </nav>
        </div>
    </section>
</section>
