<?php
/*
Template Name: Home
*/
get_header();
$cid = get_the_ID();

get_template_part( 'modules/home/banner' );
get_template_part( 'modules/home/about' );
get_template_part( 'modules/home/whyus' );
get_template_part( 'modules/home/services' );
get_template_part( 'modules/home/slide-text' );
get_template_part( 'modules/home/products' );
get_template_part( 'modules/home/news' );
get_template_part( 'modules/home/contact' );

get_footer();
