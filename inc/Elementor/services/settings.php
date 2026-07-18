<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if(!class_exists('Elementor_Services_Widget')){
	class Elementor_Services_Widget extends Elementor\Widget_Base {

		public function __construct($data = [], $args = [])
		{
		  parent::__construct($data, $args);
		}
		public function get_name() {
			return 'eld_services';
		}
	
		public function get_title() {
			return esc_html__( 'ELD Services List', 'elanding');
		}
	
		public function get_icon() {
			return 'fas fa-list-alt';
		}
	
		public function get_categories() {
			return [ 'elanding' ];
		}
	
		protected function _register_controls() {

			// ── Section Heading ──────────────────────────────────────────────
			$this->start_controls_section(
				'heading_section',
				[
					'label' => esc_html__( 'Section Heading', 'elanding'),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'section_title',
				[
					'label'       => esc_html__( 'Title', 'elanding'),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => esc_html__( 'Nhập tiêu đề...', 'elanding'),
					'default'     => '',
					'label_block' => true,
				]
			);

			$this->add_control(
				'section_description',
				[
					'label'       => esc_html__( 'Mô tả', 'elanding'),
					'type'        => Controls_Manager::TEXTAREA,
					'placeholder' => esc_html__( 'Nhập mô tả...', 'elanding'),
					'default'     => '',
					'rows'        => 4,
				]
			);

			$this->end_controls_section();

			// ── Query Settings ───────────────────────────────────────────────
			$this->start_controls_section(
				'content_section',
				[
					'label' => esc_html__( 'Query Settings', 'elanding'),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
            
            $this->add_control(
                'posts_per_page',
                [
                    'label' => esc_html__('Number of Services', 'elanding'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => -1,
                ]
            );

            $this->add_control(
                'columns',
                [
                    'label' => esc_html__('Columns', 'elanding'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '12' => '1 Column',
                        '6' => '2 Columns',
                        '4' => '3 Columns',
                        '3' => '4 Columns',
                    ],
                    'default' => '4',
                ]
            );

            $this->add_control(
                'orderby',
                [
                    'label' => esc_html__('Order By', 'elanding'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'date' => 'Date',
                        'title' => 'Title',
                        'menu_order' => 'Menu Order',
                        'rand' => 'Random',
                    ],
                    'default' => 'date',
                ]
            );

            $this->add_control(
                'order',
                [
                    'label' => esc_html__('Order', 'elanding'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'ASC' => 'Ascending',
                        'DESC' => 'Descending',
                    ],
                    'default' => 'DESC',
                ]
            );
	
			$this->end_controls_section();
		}
	
		protected function render() {
			$settings = $this->get_settings_for_display();
            $settings = array_merge($settings, array('_element' => $this));
	
			echo elanding_load_template('elementor/services', '', $settings);
		}
	
		protected function content_template(){
		}
	}
}
