<?php
get_header();
if (have_posts()) { ?>
<?php echo apply_filters('eld_single_template', elanding_load_template('common/banner')); ?>
	<div class="content-wrapper">
        
        <div class="container">
            <div class="row">
                <div class="col-12">
                <h3 class="page-header__title page-title">
                    <?php echo esc_html__('OUR SERVICE','elanding');?>
                </h3>
                <h4 class="title">
                <?php the_title();?>
                </h4>
                <?php the_content(); ?>
                </div>
            </div>
        </div>
	</div>
	
<?php }

get_footer();