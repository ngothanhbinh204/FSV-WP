<?php
$cid        = get_the_ID();
$slide_text = get_field( 'home_slide_text', $cid );
if ( ! $slide_text ) return;
?>
<section class="section-slide-text">
    <div class="embla w-full embla__title">
        <div class="embla__viewport overflow-hidden">
            <div class="embla__container flex gap-8">
                <?php for ( $i = 0; $i < 6; $i++ ) : ?>
                <div class="embla__slide flex-center flex-[0_0_calc(100%/3)]">
                    <div class="box-slide"><span class="title"><?php echo esc_html( $slide_text ); ?></span></div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>
