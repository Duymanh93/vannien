<div class="ccv_item_service">
    <div class="item_service_before"></div>
    <?php if(!empty($item_image)):?>
        <div class="logo text-center">
            <img src="<?php echo esc_url($item_image['url'])?>">
        </div>
    <?php endif;?>
    <?php if(!empty($item_title)):?>
        <div class="title_service text-center">
            <h2 class="text-uppercase">
                <?php echo ($item_title);?>
            </h2>
        </div>
    <?php endif;?>
    <?php if(!empty($item_description)):?>
        <div class="item_description">
            <?php echo esc_html($item_description);?>
        </div>
    <?php endif;?>
    <?php if(!empty($item_link)):?>
        <div class="item_link">
            <a href="<?php echo esc_url($item_link['url']);?>"><i class="fas fa-forward" aria-hidden="true"></i><?php echo esc_html__('View details','elanding');?></a>
        </div>
    <?php endif;?>
</div>