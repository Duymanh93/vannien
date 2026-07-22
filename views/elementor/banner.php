<?php
if (empty($banner_image['url'])) {
    return;
}
$url = !empty($banner_link['url']) ? $banner_link['url'] : '';
$is_external = !empty($banner_link['is_external']) ? '_blank' : '_self';
$nofollow = !empty($banner_link['nofollow']) ? 'rel="nofollow"' : '';
?>
<div class="eld-banner-wrapper">
    <div class="absolute -inset-4 bg-primary/5 rounded-3xl transform rotate-3"></div>
    <?php if (!empty($url)) : ?>
        <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($is_external); ?>" <?php echo $nofollow; ?> class="eld-banner-link">
            <img src="<?php echo esc_url($banner_image['url']); ?>" alt="<?php echo esc_attr(!empty($banner_image['alt']) ? $banner_image['alt'] : 'Banner'); ?>">
        </a>
    <?php else : ?>
        <img src="<?php echo esc_url($banner_image['url']); ?>" alt="<?php echo esc_attr(!empty($banner_image['alt']) ? $banner_image['alt'] : 'Banner'); ?>">
    <?php endif; ?>
</div>
