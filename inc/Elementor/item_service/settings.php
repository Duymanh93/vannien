<?php
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Utils;
if(!class_exists('Elementor_Item_Service_Widget')){
	class Elementor_Item_Service_Widget extends Elementor\Widget_Base {

		public function __construct($data = [], $args = [])
		{
		  parent::__construct($data, $args);
		}
		public function get_name() {
			return 'eld_service';
		}
	
		public function get_title() {
			return esc_html__( 'ELD Item Service', 'elanding');
		}
	
		public function get_icon() {
			return 'fas fa-solar-panel';
		}
	
		public function get_categories() {
			return [ 'elanding' ];
		}
	
		protected function _register_controls() {
			$this->start_controls_section(
				'content_section',
				[
					'label' => esc_html__( 'Settings', 'elanding'),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
            
            $this->add_control(
                'item_image',
                [
                    'label' => esc_html__('Image', 'elanding'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );
            
            $this->add_control(
                'item_title',
                [
                    'label' => esc_html__('Title', 'elanding'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'item_description',
                [
                    'label' => esc_html__('Description Heading', 'elanding'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );

			$this->add_control(
                'item_link',
                [
                    'label' => esc_html__('Link', 'elanding'),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__('https://your-link.com', 'elanding'),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                ]
            );
            
	
			$this->add_control(
				'slide_items',
				[
					'label'       => esc_html__('List Slider', 'go-now'),
					'type'        => Controls_Manager::REPEATER,
					'label_block' => true,
					'fields'      => $this->get_controls(),
					'title_field' => '{{{ item_slider_description }}}',
				]
			);
	
			
			$this->end_controls_section();
		}
	
		protected function render() {
			$settings = $this->get_settings_for_display();
            
            $settings = array_merge($settings, array('_element' => $this));
	
			echo elanding_load_template('elementor/item_service','', $settings);
		}
	
		protected function content_template(){
		}
		
	}
}
