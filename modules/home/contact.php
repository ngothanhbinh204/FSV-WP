<?php
$cid               = get_option( 'page_on_front' );
$contact_bg        = get_field( 'home_contact_bg', $cid );
$contact_badge     = get_field( 'home_contact_badge', $cid );
$contact_title     = get_field( 'home_contact_title', $cid );
$contact_desc      = get_field( 'home_contact_desc', $cid );
$contact_shortcode = get_field( 'home_contact_form_shortcode', $cid );
?>
<section class="section-hone-6"<?php echo $contact_bg ? ' data-background="' . esc_url( get_image_attrachment( $contact_bg, 'url' ) ) . '"' : ''; ?>>
    <?php if ( $contact_badge ) : ?>
    <span class="title-contact"><?php echo esc_html( $contact_badge ); ?></span>
    <?php endif; ?>
    <div class="box-content">
        <div class="box-left">
            <?php if ( $contact_title ) : ?>
            <h2 class="title"><?php echo esc_html( $contact_title ); ?></h2>
            <?php endif; ?>
            <?php if ( $contact_desc ) : ?>
            <div class="desc format-content"><?php echo wp_kses_post( $contact_desc ); ?></div>
            <?php endif; ?>
        </div>
        <div class="box-right">
            <?php if ( $contact_shortcode ) : ?>
            <?php echo do_shortcode( wp_kses_post( $contact_shortcode ) ); ?>
            <?php endif; ?>
        </div>
    </div>
</section>
