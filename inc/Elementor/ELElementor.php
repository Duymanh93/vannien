<?php
namespace ChengChivas\Elementor;
if(!class_exists('ELElementor')) {
    class ELElementor{
        private static $loaded_elements;
        private static $_instance = null;
        public function __construct()
        {
            add_action('elementor/elements/categories_registered', [$this, '_register_elementor_categories'],1);
            add_action('init', [$this, '_register_element_action']);
            add_action('elementor/widgets/widgets_registered', [$this, '_register_element']);
            add_action('elementor/controls/controls_registered', [$this, '_register_controls']);
            $this->_register_element_action_admin();
            add_action('init', [$this, 'add_to_elementor'], 1);
            add_filter('elementor/post_types', [$this, 'add_post_type_support']);
        }
    
        public function add_to_elementor()
        {
            $cpt_support = get_option('elementor_cpt_support', []);
            if (empty($cpt_support)) {
                $cpt_support = ['post', 'page', 'footer'];
            } else {
                if (!in_array('footer', $cpt_support)) {
                    $cpt_support[] = 'footer';
                }
            }
            update_option('elementor_cpt_support', $cpt_support);
        }
    
        public function _register_controls()
        {
            
        }
    
        public function _register_elementor_categories($elements_manager)
        {
            $elements_manager->add_category(
                'elanding',
                [
                    'title' => esc_html__( 'Elanding', 'elanding'),
                    'icon' => 'fa fa-plug',
                ]
            );
            return $elements_manager;
            
        }
    
        public function _register_element_action()
        {
            if (empty($folder)) {
                $folder = 'Elementor';
            }
            $folders = glob(trailingslashit(get_template_directory() . '/inc/' . $folder . "/*"));
            if (!empty($folders)) {
                foreach ($folders as $key => $folder_path) {
                    if (is_dir($folder_path)) {
                        self::$loaded_elements[] = $folder_path;
                        $folder_name = elanding_path_info($folder_path);
                        $settings_file = trailingslashit($folder_path) . 'action.php';
                        $custom_file = trailingslashit(get_stylesheet_directory()) . 'inc/Elementor/' . $folder_name . '/action.php';
                        if (is_file($settings_file)) {
                            if (is_file($custom_file)) {
                                require($custom_file);
                            } else {
                                require($settings_file);
                            }
                        }
                    }
                }
            }
        }
        public function _register_element_action_admin()
        {
            if (empty($folder)) {
                $folder = 'Elementor';
            }
            $folders = glob(trailingslashit(get_template_directory() . '/inc/' . $folder . "/*"));
            if (!empty($folders)) {
                foreach ($folders as $key => $folder_path) {
                    if (is_dir($folder_path)) {
                        $folder_name = elanding_path_info($folder_path);
                        $settings_file = trailingslashit($folder_path) . 'action_admin.php';
                        $custom_file = trailingslashit(get_stylesheet_directory()) . 'inc/Elementor/' . $folder_name . '/action_admin.php';
                        if (is_file($settings_file)) {
                            if (is_file($custom_file)) {
                                require($custom_file);
                            } else {
                                require($settings_file);
                            }
                        }
                    }
                }
            }
        }
    
        public function _register_element($manager, $folder = '')
        {
            if (empty(self::$loaded_elements)) {
                return;
            }
    
            foreach (self::$loaded_elements as $folder_path) {
                if (is_dir($folder_path)) {
                    $folder_name = elanding_path_info($folder_path);
                    $settings_file = trailingslashit($folder_path) . 'settings.php';
                    $custom_file = trailingslashit(get_stylesheet_directory()) . 'inc/Elementor/' . $folder_name . '/settings.php';
                    if (is_file($settings_file)) {
                        if (is_file($custom_file)) {
                            require($custom_file);
                        } else {
                            require($settings_file);
                        }
    
                        $name = 'Elementor_' . ucwords(str_replace('-', '_', $folder_name), '_') . '_Widget';
                        if (class_exists($name)) {
                            \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new $name());
                        }
                    }
                }
            }
        }
        public function add_post_type_support($post_types)
        {
            if (!in_array('footer', $post_types)) {
                $post_types[] = 'footer';
            }
            return $post_types;
        }
    
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
    
        public static function not()
        {
        }
    }
}
