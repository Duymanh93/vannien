<?php
if ( is_front_page() || is_home() ) {
    return;
}
$background_image = get_the_post_thumbnail_url( get_the_ID(), 'full', true );
$background_color = "#64070b";
$class = '';
if (!empty($background_image)) {
    $class = 'has-background';
}

?>
<div class="page-thumbnail <?php echo esc_attr($class); ?>" style="background-color: <?php echo esc_attr($background_color); ?>;
        background-image: url(<?php echo esc_url($background_image);?>)">
    <div class="page-header"> </div>
</div>