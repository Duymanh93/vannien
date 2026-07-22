<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if (!class_exists('Elementor_Banner_Widget')) {
	class Elementor_Banner_Widget extends Elementor\Widget_Base {

		public function __construct($data = [], $args = [])
		{
			parent::__construct($data, $args);
		}

		public function get_name() {
			return 'eld_banner';
		}

		public function get_title() {
			return esc_html__( 'ELD Banner', 'elanding');
		}

		public function get_icon() {
			return 'eicon-image-box';
		}

		public function get_categories() {
			return [ 'elanding' ];
		}

		protected function _register_controls() {
			$this->start_controls_section(
				'content_section',
				[
					'label' => esc_html__( 'Banner Settings', 'elanding'),
					'tab'   => Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'banner_image',
				[
					'label'   => esc_html__('Ảnh Banner', 'elanding'),
					'type'    => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'banner_link',
				[
					'label'         => esc_html__('Link Banner', 'elanding'),
					'type'          => Controls_Manager::URL,
					'placeholder'   => esc_html__('https://your-link.com', 'elanding'),
					'show_external' => true,
					'default'       => [
						'url'         => '',
						'is_external' => false,
						'nofollow'    => false,
					],
				]
			);

			$this->end_controls_section();
		}

		protected function render() {
			$settings = $this->get_settings_for_display();
			$settings = array_merge($settings, array('_element' => $this));

			echo elanding_load_template('elementor/banner', '', $settings);
		}

		protected function content_template() {
		}
	}
}
