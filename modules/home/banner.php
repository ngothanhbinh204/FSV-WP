<?php
$cid                 = get_the_ID();
$banners             = get_field( 'home_banners', $cid );
$banner_title        = get_field( 'home_banner_title', $cid );
$banner_subtitle     = get_field( 'home_banner_subtitle', $cid );
$banner_bottom_items = get_field( 'home_banner_bottom_items', $cid );
?>
<section class="page-banner-main section-banner-video" data-gsap-layout>
    <div class="swiper banner-media-swiper">
        <div class="swiper-wrapper">
            <?php if ( $banners ) : foreach ( $banners as $slide ) :
                $type = $slide['type'] ?? 'image';
            ?>
            <div class="swiper-slide">
                <div class="box-image" data-parallax data-parallax-speed="14">
                    <div class="img-banner img-ratio xl:ratio:pt-[896_1920] md:ratio:pt-[1_1] ratio:pt-[15_10]">
                        <?php if ( $type === 'video' && ! empty( $slide['video']['url'] ) ) : ?>
                        <video class="w-full object-cover" src="<?php echo esc_url( $slide['video']['url'] ); ?>" muted playsinline preload="metadata"></video>
                        <?php elseif ( ! empty( $slide['image_desktop']['url'] ) ) : ?>
                        <img class="lozad"
                             data-src="<?php echo get_image_attrachment( $slide['image_desktop'], 'url' ); ?>"
                             <?php if ( ! empty( $slide['image_mobile'] ) ) : ?>data-src-mobile="<?php echo get_image_attrachment( $slide['image_mobile'], 'url' ); ?>"<?php endif; ?>
                             alt="<?php echo esc_attr( $slide['image_desktop']['alt'] ?? '' ); ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>

        <div class="box-content-center" data-gsap-options="{&quot;type&quot;:&quot;split-words&quot;,&quot;stagger&quot;:0.04}">
            <?php if ( $banner_title ) : ?>
            <h2 class="title"><?php echo esc_html( $banner_title ); ?></h2>
            <?php endif; ?>
            <?php if ( $banner_subtitle ) : ?>
            <div class="sub-title"><p><?php echo esc_html( $banner_subtitle ); ?></p></div>
            <?php endif; ?>
            <div class="swiper-home-btn">
                <button class="btn-prev" aria-label="<?php esc_attr_e( 'Previous', 'canhcamtheme' ); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="26" viewBox="0 0 14 26" fill="none"><g><path d="M0.707092 12.3535L0.353539 12.7071L-1.43051e-05 12.3535L0.353539 12L0.707092 12.3535ZM13.0606 24L13.4142 24.3535L12.7071 25.0606L12.3535 24.7071L12.7071 24.3535L13.0606 24ZM12.7071 0.353516L13.0606 0.707069L1.06065 12.7071L0.707092 12.3535L0.353539 12L12.3535 -3.77595e-05L12.7071 0.353516ZM0.707092 12.3535L1.06065 12L13.0606 24L12.7071 24.3535L12.3535 24.7071L0.353539 12.7071L0.707092 12.3535Z" fill="white"/></g></svg>
                </button>
                <div class="block-swiper-pagination">
                    <div class="swiper-pagination"></div>
                    <div class="btn-toggle-play">
                        <span class="icon-pause"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="4" width="4" height="16"></rect><rect x="14" y="4" width="4" height="16"></rect></svg></span>
                        <span class="icon-play"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg></span>
                    </div>
                </div>
                <button class="btn-next" aria-label="<?php esc_attr_e( 'Next', 'canhcamtheme' ); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="26" viewBox="0 0 14 26" fill="none"><g><path d="M12.7071 12.3535L13.0606 12.7071L13.4142 12.3535L13.0606 12L12.7071 12.3535ZM0.353539 24L-1.44839e-05 24.3535L0.707092 25.0606L1.06065 24.7071L0.707092 24.3535L0.353539 24ZM0.707092 0.353516L0.353539 0.707069L12.3535 12.7071L12.7071 12.3535L13.0606 12L1.06065 -3.77595e-05L0.707092 0.353516ZM12.7071 12.3535L12.3535 12L0.353539 24L0.707092 24.3535L1.06065 24.7071L13.0606 12.7071L12.7071 12.3535Z" fill="white"/></g></svg>
                </button>
            </div>
        </div>
    </div>

    <?php if ( $banner_bottom_items ) : ?>
    <div class="box-content-bottom">
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach ( $banner_bottom_items as $item ) :
                    $item_link   = $item['link'] ?? [];
                    $item_url    = esc_url( $item_link['url'] ?? '#' );
                    $item_target = ! empty( $item_link['target'] ) ? ' target="' . esc_attr( $item_link['target'] ) . '"' : '';
                ?>
                <div class="swiper-slide">
                    <a class="items-content" href="<?php echo $item_url; ?>"<?php echo $item_target; ?> data-gsap-options="{&quot;type&quot;:&quot;fade-up&quot;,&quot;delay&quot;:0.22}">
                        <?php if ( ! empty( $item['icon']['url'] ) ) : ?>
                        <div class="icon">
                            <div class="img-ratio ratio:pt-[1_1]">
                                <?php echo get_image_attrachment( $item['icon'] ); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="box-caption" data-gsap-options="{&quot;type&quot;:&quot;split-words&quot;,&quot;stagger&quot;:0.04}">
                            <?php if ( ! empty( $item['title'] ) ) : ?>
                            <h3 class="title"><?php echo esc_html( $item['title'] ); ?></h3>
                            <?php endif; ?>
                            <?php if ( ! empty( $item['desc'] ) ) : ?>
                            <div class="sub-title"><p><?php echo esc_html( $item['desc'] ); ?></p></div>
                            <?php endif; ?>
                        </div>
                        <div class="icon-links">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none"><path d="M18.979 39.6066L38.778 19.8076" stroke="white" stroke-width="4"/><path d="M20.8076 19.3934H39.1924V37.7782" stroke="white" stroke-width="4"/></svg>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>
