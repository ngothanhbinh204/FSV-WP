<?php
$cid      = get_the_ID();
$sol_img  = get_field( 'srv_solution_image', $cid );
$sol_desc = get_field( 'srv_solution_desc', $cid );
if ( ! $sol_img && ! $sol_desc ) return;
?>
<section class="section-service-1">
    <div class="box-content">
        <?php if ( $sol_img ) : ?>
        <div class="box-image">
            <div class="img-ratio ratio:pt-[590_607]">
                <?php echo get_image_attrachment( $sol_img ); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if ( $sol_desc ) : ?>
        <div class="box-caption format-content">
            <?php echo wp_kses_post( $sol_desc ); ?>
        </div>
        <?php endif; ?>
    </div>
</section>
