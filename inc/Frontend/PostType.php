<?php
namespace ChengChivas\Frontend;

if (!class_exists('PostType')) {
    class PostType
    {
        public function __construct()
        {
            add_action('after_setup_theme', [$this, '_init_setup'], 30);
        }

        public function _init_setup()
        {
            add_action('init', [$this, '_init_service_post_type'], 11);
            add_action('init', [$this, '_init_footer_post_type'], 12);
            add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
            add_action( 'save_post',      array( $this, 'save_metabox_footer'         ) );
            add_action( 'save_post',      array( $this, 'save_metabox_service'        ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
        }

        public function admin_scripts($hook) {
            global $post;
            if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
                if ( isset( $post->post_type ) && 'service' === $post->post_type ) {
                    wp_enqueue_media();
                }
            }
        }

        public function add_meta_box($post_type){
            if ( $post_type === 'footer' ) {
                add_meta_box(
                    'address_footer',
                    __( 'Infor footer', 'elanding' ),
                    array( $this, 'render_meta_box_address' ),
                    $post_type,
                    'advanced',
                    'high'
                );
            }
            if ( $post_type === 'service' ) {
                add_meta_box(
                    'service_details',
                    __( 'Service Details', 'elanding' ),
                    array( $this, 'render_meta_box_service' ),
                    $post_type,
                    'advanced',
                    'high'
                );
            }
        }

        public function save_metabox_footer($post_id){
            if ( ! isset( $_POST['add_address_footer_nonce'] ) ) {
                return $post_id;
            }
            $nonce = $_POST['add_address_footer_nonce'];
            if ( ! wp_verify_nonce( $nonce, 'add_address_footer' ) ) {
                return $post_id;
            }
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return $post_id;
            }
            if ( 'footer' == $_POST['post_type'] ) {
                if ( ! current_user_can( 'edit_page', $post_id ) ) {
                    return $post_id;
                }
            } else {
                if ( ! current_user_can( 'edit_post', $post_id ) ) {
                    return $post_id;
                }
            }
            $address_footer = sanitize_text_field( $_POST['address_footer'] );
            $time_footer = sanitize_text_field( $_POST['time_footer'] );
            $percentage_footer = sanitize_text_field( $_POST['percentage_footer'] );
            update_post_meta( $post_id, '_address_footer', $address_footer );
            update_post_meta( $post_id, '_time_footer', $time_footer );
            update_post_meta( $post_id, '_percentage_footer', $percentage_footer );
        }

        public function render_meta_box_address($post){
            wp_nonce_field( 'add_address_footer', 'add_address_footer_nonce' );
            $address_footer = get_post_meta( $post->ID, '_address_footer', true );
            $time_footer = get_post_meta( $post->ID, '_time_footer', true );
            $percentage_footer = get_post_meta( $post->ID, '_percentage_footer', true );
            ?>
            <label for="address_footer">
                <?php _e( 'Address footer', 'elanding' ); ?>
            </label>
            <input type="text" class="regular-text" id="address_footer" name="address_footer" value="<?php echo esc_attr( $address_footer ); ?>" />

            <label for="time_footer">
                <?php _e( 'Time footer', 'elanding' ); ?>
            </label>
            <input type="text" class="regular-text" id="time_footer" name="time_footer" value="<?php echo esc_attr( $time_footer ); ?>" />

            <label for="percentage_footer">
                <?php _e( 'Percentage footer', 'elanding' ); ?>
            </label>
            <input type="text" class="regular-text" id="percentage_footer" name="percentage_footer" value="<?php echo esc_attr( $percentage_footer ); ?>" />
        <?php
        }
      
        public function _init_service_post_type()
        {
            $register_service = apply_filters('elanding_apply_register_services', true);
            if (!$register_service) {
                return false;
            }

            $labels = array(
                'name' => esc_html__('Service', 'elanding'),
                'singular_name' => esc_html__('Service', 'elanding'),
                'add_new' => esc_html__('Add New Service', 'elanding'),
                'add_new_item' => esc_html__('Add New Service', 'elanding'),
                'edit_item' => esc_html__('Edit Service', 'elanding'),
                'new_item' => esc_html__('New Service', 'elanding'),
                'view_item' => esc_html__('View Service', 'elanding'),
                'search_items' => esc_html__('Search Service', 'elanding'),
                'not_found' => esc_html__('No Service found', 'elanding'),
                'not_found_in_trash' => esc_html__('No Service found in Trash', 'elanding'),
                'parent_item_colon' => esc_html__('Parent Service:', 'elanding'),
                'menu_name' => esc_html__('Service', 'elanding'),
            );
            $args = array(
                'labels' => $labels,
                'hierarchical' => true,
                'description' => 'List Services',
                'supports' => array('title', 'excerpt', 'editor', 'thumbnail'),
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 3,
                'menu_icon' => 'dashicons-admin-tools',
                'show_in_nav_menus' => true,
                'publicly_queryable' => true,
                'exclude_from_search' => true,
                'has_archive' => false,
                'query_var' => true,
                'can_export' => true,
                'capability_type' => 'post',
                'rewrite' => array('slug' => 'service', 'with_front' => true)
            );
            register_post_type('service', $args);
        }

        public function _init_footer_post_type()
        {
            $register_footer = apply_filters('elanding_apply_register_footer', true);
            if (!$register_footer) {
                return false;
            }

            $labels = array(
                'name' => esc_html__('footer', 'elanding'),
                'singular_name' => esc_html__('footer', 'elanding'),
                'add_new' => esc_html__('Add New footer', 'elanding'),
                'add_new_item' => esc_html__('Add New footer', 'elanding'),
                'edit_item' => esc_html__('Edit footer', 'elanding'),
                'new_item' => esc_html__('New footer', 'elanding'),
                'view_item' => esc_html__('View footer', 'elanding'),
                'search_items' => esc_html__('Search footer', 'elanding'),
                'not_found' => esc_html__('No footer found', 'elanding'),
                'not_found_in_trash' => esc_html__('No footer found in Trash', 'elanding'),
                'parent_item_colon' => esc_html__('Parent footer:', 'elanding'),
                'menu_name' => esc_html__('footer', 'elanding'),
            );
            $args = array(
                'labels' => $labels,
                'hierarchical' => true,
                'description' => 'List footers',
                'supports' => array('title', 'excerpt', 'editor', 'thumbnail'),
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 3,
                'menu_icon' => 'dashicons-post-status',
                'show_in_nav_menus' => true,
                'publicly_queryable' => true,
                'exclude_from_search' => true,
                'has_archive' => false,
                'query_var' => true,
                'can_export' => true,
                'capability_type' => 'post',
                'rewrite' => array('slug' => 'footer', 'with_front' => true)
            );
            register_post_type('footer', $args);
        }

        public function render_meta_box_service($post){
            wp_nonce_field( 'add_service_details', 'add_service_details_nonce' );
            $service_icon = get_post_meta( $post->ID, '_service_icon', true );
            $service_features = get_post_meta( $post->ID, '_service_features', true );
            ?>
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">
                    <?php _e( 'Service Icon (Image or SVG URL)', 'elanding' ); ?>
                </label>
                <div class="service-icon-preview-wrapper" style="margin-bottom: 10px;">
                    <img id="service_icon_preview" src="<?php echo esc_url( $service_icon ); ?>" style="max-width: 100px; max-height: 100px; display: <?php echo !empty($service_icon) ? 'block' : 'none'; ?>; border: 1px solid #ddd; padding: 5px; background: #fff;" />
                </div>
                <input type="text" class="regular-text" id="service_icon" name="service_icon" value="<?php echo esc_attr( $service_icon ); ?>" style="margin-bottom: 5px;" readonly />
                <button type="button" class="button button-secondary" id="service_icon_upload_btn"><?php _e( 'Upload Image/SVG', 'elanding' ); ?></button>
                <button type="button" class="button button-link" id="service_icon_remove_btn" style="color: #a00; display: <?php echo !empty($service_icon) ? 'inline-block' : 'none'; ?>; vertical-align: middle;"><?php _e( 'Remove', 'elanding' ); ?></button>
            </div>

            <div>
                <label for="service_features" style="display: block; font-weight: bold; margin-bottom: 5px;">
                    <?php _e( 'Features List (One feature per line)', 'elanding' ); ?>
                </label>
                <textarea class="large-text" id="service_features" name="service_features" rows="5" placeholder="Feature 1&#10;Feature 2&#10;Feature 3"><?php echo esc_textarea( $service_features ); ?></textarea>
            </div>

            <script type="text/javascript">
            jQuery(document).ready(function($){
                var image_frame;
                $('#service_icon_upload_btn').click(function(e) {
                    e.preventDefault();
                    if (image_frame) {
                        image_frame.open();
                        return;
                    }
                    image_frame = wp.media({
                        title: 'Select Service Icon (Image or SVG)',
                        multiple: false,
                        library: {
                            type: 'image'
                        }
                    });
                    image_frame.on('select', function() {
                        var attachment = image_frame.state().get('selection').first().toJSON();
                        var img_url = attachment.url;
                        $('#service_icon').val(img_url);
                        $('#service_icon_preview').attr('src', img_url).show();
                        $('#service_icon_remove_btn').show();
                    });
                    image_frame.open();
                });

                $('#service_icon_remove_btn').click(function(e) {
                    e.preventDefault();
                    $('#service_icon').val('');
                    $('#service_icon_preview').attr('src', '').hide();
                    $(this).hide();
                });
            });
            </script>
            <?php
        }

        public function save_metabox_service($post_id){
            if ( ! isset( $_POST['add_service_details_nonce'] ) ) {
                return $post_id;
            }
            $nonce = $_POST['add_service_details_nonce'];
            if ( ! wp_verify_nonce( $nonce, 'add_service_details' ) ) {
                return $post_id;
            }
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return $post_id;
            }
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
    
            if ( isset( $_POST['service_icon'] ) ) {
                update_post_meta( $post_id, '_service_icon', sanitize_text_field( $_POST['service_icon'] ) );
            }
            if ( isset( $_POST['service_features'] ) ) {
                update_post_meta( $post_id, '_service_features', sanitize_textarea_field( $_POST['service_features'] ) );
            }
        }
    }
}
