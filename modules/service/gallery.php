<?php
$cid     = get_the_ID();
$title   = get_field( 'srv_gallery_title', $cid );
$tabs    = get_field( 'srv_gallery_tabs', $cid );
if ( ! $tabs ) return;
?>
<section class="section-service-2">
    <div class="box-content">
        <div class="wrap" data-toggle="tabslet" data-active="1" data-animation="true">
            <?php if ( $title ) : ?>
            <div class="wrap-heading wrap-center">
                <h2 class="title"><?php echo esc_html( $title ); ?></h2>
            </div>
            <?php endif; ?>

            <ul class="tabslet-tab">
                <?php foreach ( $tabs as $index => $tab ) : ?>
                <li><a href="#service-tab-<?php echo esc_attr( $index + 1 ); ?>"><?php echo esc_html( $tab['label'] ); ?></a></li>
                <?php endforeach; ?>
            </ul>

            <?php foreach ( $tabs as $index => $tab ) : ?>
            <div class="tabslet-content" id="service-tab-<?php echo esc_attr( $index + 1 ); ?>">
                <?php if ( ! empty( $tab['items'] ) ) : foreach ( $tab['items'] as $item ) : 
                    $img = $item['image'];
                    $it  = $item['title'];
                    $url = $img ? $img['url'] : '';
                    if ( ! $url ) continue;
                ?>
                <div class="items-service zoom-img-parent">
                    <a href="<?php echo esc_url( $url ); ?>" data-fancybox="gallery-<?php echo esc_attr( $index + 1 ); ?>">
                        <div class="box-image img-zoom">
                            <div class="img-ratio">
                                <?php echo get_image_attrachment( $img ); ?>
                            </div>
                        </div>
                        <?php if ( $it ) : ?>
                        <div class="box-content">
                            <div class="box-title"><span class="title"><?php echo esc_html( $it ); ?></span></div>
                        </div>
                        <?php endif; ?>
                    </a>
                </div>
                <?php endforeach; endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
