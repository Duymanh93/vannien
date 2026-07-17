<?php
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Utils;
if(!class_exists('Elementor_Project_Widget')){
	class Elementor_Project_Widget extends Elementor\Widget_Base {

		public function __construct($data = [], $args = [])
		{
		  parent::__construct($data, $args);
		}
		public function get_name() {
			return 'eld_project';
		}
	
		public function get_title() {
			return esc_html__( 'Project', 'elanding');
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
	
			
		   
	
			
			$this->end_controls_section();
		}
	
		protected function render() {
			$settings = $this->get_settings_for_display();
            $settings = array_merge($settings, array('_element' => $this));
			echo elanding_load_template('elementor/project','', $settings);
		}
	
		protected function content_template(){
		}
		
	}
}
