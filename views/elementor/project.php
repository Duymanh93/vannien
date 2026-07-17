<?php
$arr = array(
    'post_type' => 'project',
    'post_status' => 'publish',
    'posts_per_page' => -1
);
$query_project = new WP_Query($arr);
if($query_project->have_posts()) : ?>
<div class="project__slider-element project__slider">
    <?php while ($query_project->have_posts()) : $query_project->the_post(); 
        $background_image = get_the_post_thumbnail_url( get_the_ID(), 'full', true );
        $address_project = get_post_meta( get_the_ID(), '_address_project', true );
        $time_project = get_post_meta( get_the_ID(), '_time_project', true );
        $percentage_project = get_post_meta( get_the_ID(), '_percentage_project', true );
    ?>
    <div class="item-project">
        <img src="<?php echo esc_url($background_image);?>" alt="<?php the_title();?>">
        <div class="infor">
            <h2>
                <?php the_title();?>
            </h2>
            <ul class="list-unstyled">
                <li>
                    <i class="fas fa-map-marker-alt"></i> <?php echo esc_html($address_project);?>
                </li>
                <li>
                    <i class="far fa-clock"></i> <?php echo esc_html($time_project);?>
                </li>
                <li>
                    <i class="fas fa-percent"></i> <?php echo esc_html($percentage_project);?>
                </li>
            </ul>
        </div>
    </div>
        
    <?php endwhile;?>
</div>
<?php 
endif; wp_reset_postdata();