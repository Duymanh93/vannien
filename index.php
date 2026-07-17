<?php
get_header();
if (have_posts()) { ?>
<?php echo apply_filters('eld_single_template', elanding_load_template('common/banner')); ?>
	<div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="page-header__title page-title">
                        <?php 
                            if (is_archive()) {
                                the_archive_title();
                            } else if (is_search()) {
                                esc_html_e('Search Results for: ', 'elanding');
                                the_search_query();
                            } else {
                                single_post_title();
                            }
                        ?>
                    </h3>
                </div>
            </div>
            <div class="row">
                <?php 
                global $wp_query;
                   
                    if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
                        $post_date = get_the_date( 'd' ); 
                        $post_mon = get_the_date( 'm' );
                        $post_year = get_the_date( 'Y' );
                        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                        if(is_sticky(get_the_ID())){
                            $class = "col-md-6";
                            
                            if(!has_post_thumbnail()){
                                $class = "col-md-12 item-post";  
                            }
                            ?>
                            <div class="col-12">
                                <div class="row d-flex align-items-center sticky">
                                    <?php if(has_post_thumbnail()){ ?>
                                    <div class="col-12 col-md-6 item-post">
                                        <div class="item-post-img">
                                            <span>
                                            <span>
                                                    <?php echo esc_html($post_date); ?>
                                            </span>
                                            <?php echo esc_html($post_mon) .'/'.esc_html($post_year); ?>
                                            </span>
                                            <img class="img-fluid" src="<?php echo esc_url($featured_img_url);?>" alt="<?php the_title();?>">
                                        </div>
                                        
                                    </div>
                                    <?php }?>
                                    <div class="col-12 <?php echo esc_attr($class);?>">
                                        <a href="<?php the_permalink()?>">
                                            <h3 class="page-header__title page-title">
                                                <?php echo eld_title_excerpt(10);?>
                                            </h3>
                                        </a>
                                        <div class="content-exerpt">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <?php } else {  ?>
                            <div class="col-12 col-md-4">
                                <div class="item-post-img">
                                    <span>
                                        <span>
                                            <?php echo esc_html($post_date); ?>
                                        </span>
                                        <?php echo esc_html($post_mon) .'/'.esc_html($post_year); ?>
                                    </span>
                                </div>
                                <img class="img-fluid" src="<?php echo esc_url($featured_img_url);?>" alt="<?php the_title();?>">
                                <a href="<?php the_permalink()?>">
                                    <h3 class="page-header__title page-title small-title">
                                        <?php echo eld_title_excerpt(10);?>
                                    </h3>
                                </a>
                            </div>
                        <?php }
                    ?>
                
                    <?php endwhile; endif;
                    wp_reset_postdata();
                    ?>
                <nav class="stt-pagination woocommerce-pagination">
					<?php
					$big = 999999999;
                    $current = get_query_var('paged', 1);
					echo paginate_links(
						apply_filters(
							'stt_post_pagination_args',
							array( // WPCS: XSS ok.
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'total' => $wp_query->max_num_pages,
								'prev_text' => '<i class="wl-icon-arrow-left"></i>',
								'next_text' => '<i class="wl-icon-arrow-right"></i>',
								'type' => 'list',
								'current' => max(1, $current),
								'end_size' => 3,
								'mid_size' => 3,
							)
						)
					); ?>
				</nav>
                    
            </div>
        </div>
     
	</div>
	
<?php }

get_footer();