<?php
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Utils;
if(!class_exists('Elementor_Banner_Widget')){
	class Elementor_Banner_Widget extends Elementor\Widget_Base {

		public function __construct($data = [], $args = [])
		{
		  parent::__construct($data, $args);
		}
		public function get_name() {
			return 'eld_banner';
		}
	
		public function get_title() {
			return esc_html__( 'ELD Slider', 'elanding');
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
	
			
		   
			
	
			$repeater = new \Elementor\Repeater();
            
            $repeater->add_control(
                'item_slider_image',
                [
                    'label' => esc_html__('Image', 'elanding'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );
            
            $repeater->add_control(
                'item_slider_description',
                [
                    'label' => esc_html__('Description Heading', 'elanding'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );
			$repeater->add_control(
                'item_slider_link',
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
					'fields'      => $repeater->get_controls(),
					'title_field' => '{{{ item_slider_description }}}',
				]
			);
	
			
			$this->end_controls_section();
		}
	
		protected function render() {
			$settings = $this->get_settings_for_display();
			$this->add_inline_editing_attributes( 'description_box', 'advanced' );
			$settings = array(
				'slide_items' => $settings['slide_items'],
			);
	
			echo elanding_load_template('elementor/banner','', $settings);
		}
	
		protected function content_template(){
		}
		
	}
}
