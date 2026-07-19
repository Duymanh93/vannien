<?php
$posts_per_page      = isset($posts_per_page)      ? intval($posts_per_page) : -1;
$columns             = isset($columns)             ? $columns                : '4';
$orderby             = isset($orderby)             ? $orderby                : 'date';
$order               = isset($order)               ? $order                  : 'DESC';
$section_title       = isset($section_title)       ? $section_title          : '';
$section_description = isset($section_description) ? $section_description    : '';
$show_title          = isset($show_title)          ? $show_title             : 'yes';
$show_description    = isset($show_description)    ? $show_description       : 'yes';

$args = array(
    'post_type'      => 'service',
    'posts_per_page' => $posts_per_page,
    'post_status'    => 'publish',
    'orderby'        => $orderby,
    'order'          => $order,
);

$query = new WP_Query($args);

if ($query->have_posts()) : ?>
    <div class="services-list-wrapper">
        <?php
        $display_title = ( 'yes' === $show_title && !empty($section_title) );
        $display_desc  = ( 'yes' === $show_description && !empty($section_description) );
        if ( $display_title || $display_desc ) : ?>
        <div class="services-section-heading text-center mb-5">
            <?php if ( $display_title ) : ?>
                <h2 class="services-section-title"><?php echo esc_html($section_title); ?></h2>
            <?php endif; ?>
            <?php if ( $display_desc ) : ?>
                <p class="services-section-description"><?php echo esc_html($section_description); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <?php while ($query->have_posts()) : $query->the_post(); 
            $service_icon = get_post_meta(get_the_ID(), '_service_icon', true);
            $service_features_meta = get_post_meta(get_the_ID(), '_service_features', true);
            $features = array_filter(array_map('trim', explode("\n", $service_features_meta)));
            ?>
            <div class="col-12 col-md-<?php echo esc_attr($columns); ?> mb-4">
                <div class="service-card h-100 d-flex flex-column">
                    <div class="service-card-body p-4 flex-grow-1">
                        <?php if (!empty($service_icon)) : ?>
                            <div class="service-icon-box img-icon d-flex align-items-center justify-content-center">
                                <img src="<?php echo esc_url($service_icon); ?>" alt="<?php the_title(); ?>" class="img-fluid" />
                            </div>
                        <?php elseif (has_post_thumbnail()) : ?>
                            <div class="service-icon-box img-icon mb-3 d-flex align-items-center justify-content-center">
                                <?php the_post_thumbnail('thumbnail', array('class' => 'img-fluid')); ?>
                            </div>
                        <?php endif; ?>

                        <h3 class="service-title mb-4">
                            <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>

                        <div class="service-description">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>

                    <?php if (!empty($features)) : ?>
                        <div class="service-card-footer p-4">
                            <ul class="service-features-list list-unstyled mb-0">
                                <?php foreach ($features as $feature) : ?>
                                    <li class="d-flex align-items-start mb-3">
                                        <span class="checkmark me-2"><svg xmlns="http://www.w3.org/2000/svg"
                                           width="18"
                                           height="18"
                                           viewBox="0 0 24 24"
                                           fill="none"
                                           stroke="currentColor"
                                           stroke-width="2.5"
                                           stroke-linecap="round"
                                           stroke-linejoin="round"
                                           style="color:#22c55e;display:inline-block;vertical-align:middle;">
                                           <path d="M20 6L9 17L4 12"/>
                                       </svg></span>
                                       <span class="feature-text"><?php echo esc_html($feature); ?></span>
                                   </li>
                               <?php endforeach; ?>
                           </ul>
                       </div>
                   <?php endif; ?>
               </div>
           </div>
       <?php endwhile; ?>
   </div>
</div>
<?php 
endif; 
wp_reset_postdata();
