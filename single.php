<?php
get_header();
if (have_posts()) { ?>
    <?php echo apply_filters('eld_single_template', elanding_load_template('common/banner')); ?>
    <div class="content-wrapper">
        
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <h3 class="page-header__title page-title">
                        <?php the_title();?>
                    </h3>
                    <?php the_content(); ?>
                    <div class="releated-post">
                        <h4>
                            <?php echo esc_html__('Other news','elanding');?>
                        </h4>
                        <?php  
                        $terms = wp_get_post_terms(get_the_ID(), 'category');
                        if (!empty($terms) && !is_wp_error($terms)) {
                            $term = $terms[0];
                            $id_term = $term->term_id;
                            $get_posts = get_posts( array( 'post_type'=> 'post', 
                               'posts_per_page' =>5, 
                               'post_status' => 'publish', 
                               'post__not_in' => array(get_the_ID()),
                               'orderby'=> 'post__not_in',
                               'tax_query' => array(
                                   array(
                                       'taxonomy' => 'category',
                                       'field'    => 'term_id',
                                       'terms'    => array($id_term),
                                   ),
                               ),
                           ) );
                           if($get_posts){ ?>
                            <ul class="list-unstyled mr-auto">
                                <?php
                                foreach ($get_posts as $key => $recent) { 
                                    $words = 8;
                                    $more = ' …   ';
                                    
                                    $excerpt_title = wp_trim_words( get_the_title($recent->ID), $words, $more );
                                    ?>
                                    <li class="d-flex align-items-center">
                                        <a href="<?php echo get_the_permalink($recent->ID);?>"><i class='fas fa-caret-right'></i><?php echo $excerpt_title;?> <span> <?php echo  get_the_date('d/m/Y', $recent->ID);?></span></a>
                                    </li>
                                <?php }

                                ?>
                                
                                
                            </ul>
                        <?php    }
                    } ?>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <?php dynamic_sidebar('sidebar'); ?>
            </div>
        </div>
    </div>
</div>

<?php }

get_footer();