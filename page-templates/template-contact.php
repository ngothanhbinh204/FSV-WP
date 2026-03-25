<?php
/* Template Name: Contact Listing */
get_header(); 

// Custom Banner for Contact Page using its own ACF fields
$cid        = get_the_ID();
$banner_bg  = get_field( 'banner_img', $cid );
$banner_sub = get_field( 'banner_sub_title', $cid );
$banner_ttl = get_field( 'banner_title', $cid ) ?: get_the_title();

// Section Left
$con_badge    = get_field( 'contact_badge', $cid );
$con_title    = get_field( 'contact_title', $cid );
$con_list     = get_field( 'contact_address_list', $cid );
$con_map      = get_field( 'google_map_iframe', $cid );

// Section Right
$form_title   = get_field( 'form_title', $cid );
$form_code    = get_field( 'contact_form_shortcode', $cid );
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
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Home', 'canhcamtheme' ); ?></a>
                    <span class="separator"> |</span>
                    <span class="last"><?php the_title(); ?></span>
                </p>
            </nav>
        </div>
    </section>
</section>

<section class="section-contact">
    <div class="container">
        <div class="section-py">
            <div class="block-flex">
                <div class="block-left">
                    <div class="title">
                        <?php if ( $con_badge ) : ?><span><?php echo esc_html( $con_badge ); ?></span><?php endif; ?>
                        <?php if ( $con_title ) : ?><h1 class="heading-1 text-primary-1"><?php echo esc_html( $con_title ); ?></h1><?php endif; ?>
                    </div>
                    <?php if ( $con_list ) : ?>
                    <ul>
                        <?php foreach ( $con_list as $item ) : ?>
                        <li>
                            <i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
                            <?php if ( ! empty( $item['link'] ) ) : ?>
                                <a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank"><?php echo esc_html( $item['text'] ); ?></a>
                            <?php else : ?>
                                <span><?php echo wp_kses_post( $item['text'] ); ?></span>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                    <?php if ( $con_map ) : ?>
                    <div class="img img-ratio ratio:pt-[252_480]">
                        <?php 
                        echo $con_map;
                        ?>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="block-right">
                    <?php if ( $form_title ) : ?>
                    <div class="title-contact-form">
                        <?php echo wp_kses_post( $form_title ); ?>
                    </div>
                    <?php endif; ?>

                    <?php if ( $form_code ) : ?>
                    <div class="block-form-contact">
                        <?php echo do_shortcode( $form_code ); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
