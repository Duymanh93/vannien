<?php
get_header();
if (have_posts()) { ?>
    <?php echo apply_filters('eld_single_template', elanding_load_template('common/banner')); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <?php if ( ! is_front_page() ) : ?>
                        <div class="page-header__title page-title">
                            <h1><?php the_title(); ?></h1>
                        </div>
                    <?php endif; ?>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
<?php }
get_footer();