<?php
$cid          = get_the_ID();
$mission_list = get_field( 'about_mission_list', $cid );
if ( ! $mission_list ) return;
?>
<section class="section-about-1">
    <div class="swiper-column-auto auto-3-column">
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach ( $mission_list as $item ) : 
                    $icon = $item['icon'];
                    $title = $item['title'];
                    $desc  = $item['desc'];
                    $icon_url = $icon ? $icon['url'] : get_template_directory_uri() . '/img/Frame.svg';
                ?>
                <div class="swiper-slide">
                    <div class="items">
                        <div class="icon">
                            <div class="img-ratio ratio:pt-[1_1]">
                                <?php echo get_image_attrachment( $icon ); ?>
                            </div>
                        </div>
                        <h3 class="title"><?php echo esc_html( $title ); ?></h3>
                        <div class="desc format-content">
                            <?php echo wpautop( wp_kses_post( $desc ) ); ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
