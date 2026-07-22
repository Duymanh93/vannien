<?php
if (empty($slide_items)) {
    return;
}
$slider_show_button = __('Explore','elanding');
?>
<div id="slider-home" class="home-slider-element home-slider">
    <?php foreach ($slide_items as $key => $slide) {
        $background_image_url = !empty($slide['item_slider_image']['url']) ? $slide['item_slider_image']['url'] : '';
        $slider_show_description = !empty($slide['slider_show_description']) ? $slide['slider_show_description'] : '';
        
        $attrs = [
            'style' => [
                'background-image: url(' . esc_url($background_image_url) . ')',
            ]
        ];
        ?>
        <div class="slide-item" data-id="<?php echo esc_attr($slide['_id']) ?>" style="background-image: url('<?php echo esc_url($background_image_url);?> ')">
            <div class="container">
                <div class="row slide-content-wrapper">
                    <div class="col-12 slide-content">
                        <?php
                        if (!empty($slide['item_slider_description'])) {
                            echo '<div class="slide-short-description ' . esc_attr($slider_show_description) . '">' . wp_kses_post($slide['item_slider_description']) . '</div>';
                        }
                        $item_slider_link = is_array($slide['item_slider_link']) ? $slide['item_slider_link'] : [];
                        if (!empty($item_slider_link['url'])) {
                            $item_slider_url_type = !empty($slide['item_slider_url_type']) ? ($slide['item_slider_url_type']) : '';
                            $item_slider_url_text = !empty($slide['item_slider_url_text']) ? $slide['item_slider_url_text'] : esc_html__('Explore Now', 'elanding');
                            echo '<div class="c-button-link"><a href="' . esc_url($item_slider_link['url']) . '" class="slide-link" target="' . esc_attr($item_slider_link['is_external'] ? '_blank' : '') . '">' . esc_html($item_slider_url_text) . '</a></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } ?>
</div>
