<?php
$cid               = get_option( 'page_on_front' );
$whyus_title = get_field( 'home_whyus_title', $cid );
$whyus_bg    = get_field( 'home_whyus_bg', $cid );
$whyus_grid  = get_field( 'home_whyus_grid', $cid );
?>
<section class="section-home-2"<?php echo $whyus_bg ? ' data-background="' . esc_url( get_image_attrachment( $whyus_bg, 'url' ) ) . '"' : ''; ?>>
    <div class="container-fluid">
        <?php if ( $whyus_title ) : ?>
        <div class="wrap-heading" data-gsap-options="{&quot;type&quot;:&quot;split-chars&quot;,&quot;stagger&quot;:0.025}">
            <h2 class="title"><?php echo esc_html( $whyus_title ); ?></h2>
        </div>
        <?php endif; ?>
        <?php if ( $whyus_grid ) : ?>
        <div class="box-grid">
            <?php foreach ( $whyus_grid as $g ) :
                $g_type  = $g['type'] ?? 'text_only';
                $g_img   = $g['image'] ?? [];
                $g_title = $g['title'] ?? '';
                $g_desc  = $g['desc'] ?? '';
            ?>
                <?php if ( $g_type === 'image_only' && ! empty( $g_img['url'] ) ) : ?>
                <a href="<?php echo esc_url( $g_img['url'] ); ?>" data-fancybox>
                    <div class="items zoom-img-parent">
                        <div class="box-image" data-parallax data-parallax-speed="14">
                            <div class="img-ratio ratio:pt-[1_1] img-zoom">
                                <?php echo get_image_attrachment( $g_img ); ?>
                            </div>
                        </div>
                    </div>
                </a>
                <?php elseif ( $g_type === 'focus' ) : ?>
                <div class="items zoom-img-parent item-forcus">
                    <?php if ( ! empty( $g_img['url'] ) ) : ?>
                    <div class="box-image" data-parallax data-parallax-speed="14">
                        <div class="img-ratio ratio:pt-[1_1] img-zoom">
                            <?php echo get_image_attrachment( $g_img ); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="box-caption">
                        <?php if ( $g_title ) : ?><div class="title"><?php echo esc_html( $g_title ); ?></div><?php endif; ?>
                        <?php if ( $g_desc ) : ?><div class="desc"><p><?php echo esc_html( $g_desc ); ?></p></div><?php endif; ?>
                    </div>
                </div>
                <?php else : ?>
                <div class="items">
                    <div class="box-caption">
                        <?php if ( $g_title ) : ?><div class="title"><?php echo esc_html( $g_title ); ?></div><?php endif; ?>
                        <?php if ( $g_desc ) : ?><div class="desc"><p><?php echo esc_html( $g_desc ); ?></p></div><?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
