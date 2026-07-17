<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 5/31/2019
 * Time: 8:52 AM
 */
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
            add_action('init', [$this, '_init_project_post_type'], 12);
            add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
            add_action( 'save_post',      array( $this, 'save_metabox_project'         ) );
        }

        public function add_meta_box($post_type){
            // Limit meta box to certain post types.
            $post_types = array( 'project');
            
            if ( in_array( $post_type, $post_types ) ) {
                add_meta_box(
                    'address_project',
                    __( 'Infor project', 'elanding' ),
                    array( $this, 'render_meta_box_address' ),
                    $post_type,
                    'advanced',
                    'high'
                );
            }
        }

        public function save_metabox_project($post_id){
            // Check if our nonce is set.
            if ( ! isset( $_POST['add_address_project_nonce'] ) ) {
                return $post_id;
            }
    
            $nonce = $_POST['add_address_project_nonce'];
    
            // Verify that the nonce is valid.
            if ( ! wp_verify_nonce( $nonce, 'add_address_project' ) ) {
                return $post_id;
            }
    
            /*
            * If this is an autosave, our form has not been submitted,
            * so we don't want to do anything.
            */
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return $post_id;
            }
    
            // Check the user's permissions.
            if ( 'project' == $_POST['post_type'] ) {
                if ( ! current_user_can( 'edit_page', $post_id ) ) {
                    return $post_id;
                }
            } else {
                if ( ! current_user_can( 'edit_post', $post_id ) ) {
                    return $post_id;
                }
            }
    
            /* OK, it's safe for us to save the data now. */
    
            // Sanitize the user input.
            $address_project = sanitize_text_field( $_POST['address_project'] );
            $time_project = sanitize_text_field( $_POST['time_project'] );
            $percentage_project = sanitize_text_field( $_POST['percentage_project'] );
    
            // Update the meta field.
            update_post_meta( $post_id, '_address_project', $address_project );
            update_post_meta( $post_id, '_time_project', $time_project );
            update_post_meta( $post_id, '_percentage_project', $percentage_project );
        }

        public function render_meta_box_address($post){
            // Add an nonce field so we can check for it later.
            wp_nonce_field( 'add_address_project', 'add_address_project_nonce' );
    
            // Use get_post_meta to retrieve an existing value from the database.
            $address_project = get_post_meta( $post->ID, '_address_project', true );
            $time_project = get_post_meta( $post->ID, '_time_project', true );
            $percentage_project = get_post_meta( $post->ID, '_percentage_project', true );
    
            // Display the form, using the current value.
            ?>
            <label for="address_project">
                <?php _e( 'Address project', 'elanding' ); ?>
            </label>
            <input type="text" class="regular-text" id="address_project" name="address_project" value="<?php echo esc_attr( $address_project ); ?>" />

            <label for="time_project">
                <?php _e( 'Time project', 'elanding' ); ?>
            </label>
            <input type="text" class="regular-text" id="time_project" name="time_project" value="<?php echo esc_attr( $time_project ); ?>" />

            <label for="percentage_project">
                <?php _e( 'Percentage project', 'elanding' ); ?>
            </label>
            <input type="text" class="regular-text" id="percentage_project" name="percentage_project" value="<?php echo esc_attr( $percentage_project ); ?>" />
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
        public function _init_project_post_type()
        {
            $register_project = apply_filters('elanding_apply_register_project', true);
            if (!$register_project) {
                return false;
            }

            $labels = array(
                'name' => esc_html__('Project', 'elanding'),
                'singular_name' => esc_html__('Project', 'elanding'),
                'add_new' => esc_html__('Add New Project', 'elanding'),
                'add_new_item' => esc_html__('Add New Project', 'elanding'),
                'edit_item' => esc_html__('Edit Project', 'elanding'),
                'new_item' => esc_html__('New Project', 'elanding'),
                'view_item' => esc_html__('View Project', 'elanding'),
                'search_items' => esc_html__('Search Project', 'elanding'),
                'not_found' => esc_html__('No Project found', 'elanding'),
                'not_found_in_trash' => esc_html__('No Project found in Trash', 'elanding'),
                'parent_item_colon' => esc_html__('Parent Project:', 'elanding'),
                'menu_name' => esc_html__('Project', 'elanding'),
            );
            $args = array(
                'labels' => $labels,
                'hierarchical' => true,
                'description' => 'List Projects',
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
                'rewrite' => array('slug' => 'project', 'with_front' => true)
            );
            register_post_type('project', $args);
        }
    }
}
