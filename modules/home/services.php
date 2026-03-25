<?php
$cid       = get_the_ID();
$srv_title = get_field( 'home_srv_title', $cid );
$srv_desc  = get_field( 'home_srv_desc', $cid );
$srv_link  = get_field( 'home_srv_link', $cid );

$srv_items = get_posts( array(
    'post_type'      => 'service',
    'post_status'    => 'publish',
) );

?>
<section class="section-home-3">
    <div class="field-op">
        <?php if ( $srv_title || $srv_desc ) : ?>
        <div class="wrap-heading wrap-center" data-gsap-options="{&quot;type&quot;:&quot;split-chars&quot;,&quot;stagger&quot;:0.025}">
            <?php if ( $srv_title ) : ?><h2 class="title"><?php echo esc_html( $srv_title ); ?></h2><?php endif; ?>
            <?php if ( $srv_desc ) : ?><div class="sub-title"><p><?php echo wp_kses_post( $srv_desc ); ?></p></div><?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if ( $srv_items ) : ?>
        <div class="swiper swiper-field-op" data-aos="fade-up" data-aos-duration="500">
            <ul class="swiper-wrapper field-op-list">
                <?php foreach ( $srv_items as $srv ) :
                    $srv_id         = is_object( $srv ) ? $srv->ID : ( $srv['ID'] ?? 0 );
                    $srv_title_post = get_the_title( $srv_id );
                    $srv_excerpt    = get_the_excerpt( $srv_id );
                    $srv_url        = get_permalink( $srv_id );
                    $srv_link_label = __( 'Explore more', 'canhcamtheme' );
                ?>
                <li class="swiper-slide field-op-item relative lg:flex-1 rem:!h-[680px] overflow-hidden">
                    <div class="thumb img-full w-full h-full">
                        <?php echo get_image_post( $srv_id ); ?>
                    </div>
                    <div class="info">
                        <div class="box-content">
                            <h3 class="title"><?php echo esc_html( $srv_title_post ); ?></h3>
                            <?php if ( $srv_excerpt ) : ?>
                            <div class="desc format-content"><p><?php echo esc_html( $srv_excerpt ); ?></p></div>
                            <?php endif; ?>
                        </div>
                        <div class="box-btn">
                            <a class="btn btn-outline" href="<?php echo esc_url( $srv_url ); ?>">
                                <span><?php echo esc_html( $srv_link_label ); ?></span>
                                <i class="fa-sharp fa-regular fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <?php if ( $srv_link && ! empty( $srv_link['url'] ) ) : ?>
        <a class="btn btn-primary" href="<?php echo esc_url( $srv_link['url'] ); ?>"<?php echo ! empty( $srv_link['target'] ) ? ' target="' . esc_attr( $srv_link['target'] ) . '"' : ''; ?>>
            <span><?php echo esc_html( $srv_link['title'] ?: __( 'Explore more', 'canhcamtheme' ) ); ?></span>
            <i class="fa-sharp fa-regular fa-arrow-right" aria-hidden="true"></i>
        </a>
        <?php endif; ?>
    </div>
</section>
