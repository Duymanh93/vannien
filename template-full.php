<?php
/**
 * Template Name: Full page
 */
get_header(); ?>
 <!-- // End Fixed navbar -->
 <?php
    if(have_posts()) : while(have_posts()) : the_post();
    the_content();
    endwhile;endif;
get_footer();
?>