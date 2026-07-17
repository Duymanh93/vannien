<?php
namespace ChengChivas\Admin;
if(!class_exists('LCustomize')) {
    class LCustomize{
        public function __construct(){
            
        }
        public function admin_customizer_init(){
            add_action( 'customize_register', array($this,'customizer_lheader'));
            add_action( 'init', array($this,'customizer_lheader_section'));
        }
        
        public function customizer_lheader_section(){
            
        }

        public function customizer_lheader($wp_customize){
            $wp_customize->add_panel('panel_footer', array(
                'title' => esc_html__('Footer', 'elanding'),
                'priority' => 10,
                'capability' => 'edit_theme_options',
            ));
            
            $wp_customize->add_section(eld_prefix() . 'section_footer', array(
                'title' => esc_html__('Infor company', 'elanding'),
                'priority' => 10,
                'capability' => 'edit_theme_options',
                'panel' => 'panel_footer',
            ));

            $wp_customize->add_setting(eld_prefix() . 'name_company', array(
                'default'        => '',
                'transport' => 'refresh',
                'capability' => 'edit_theme_options',
            ));

            
            $wp_customize->add_control(eld_prefix() . 'name_company', array(
                'label'   => 'Name company',
                'section' => eld_prefix() . 'section_footer',
                'type'    => 'text',
            ));

            $wp_customize->add_setting(eld_prefix() . 'number_tel', array(
                'default'        => '',
                'transport' => 'refresh',
                'capability' => 'edit_theme_options',
            ));

            
            $wp_customize->add_control(eld_prefix() . 'number_tel', array(
                'label'   => 'Tel',
                'section' => eld_prefix() . 'section_footer',
                'type'    => 'text',
            ));

            $wp_customize->add_setting(eld_prefix() . 'number_hotline', array(
                'default'        => '',
                'transport' => 'refresh',
                'capability' => 'edit_theme_options',
            ));

            
            $wp_customize->add_control(eld_prefix() . 'number_hotline', array(
                'label'   => 'Hotline',
                'section' => eld_prefix() . 'section_footer',
                'type'    => 'text',
            ));

            $wp_customize->add_setting(eld_prefix() . 'gmail_contact', array(
                'default'        => '',
                'transport' => 'refresh',
                'capability' => 'edit_theme_options',
            ));

            
            $wp_customize->add_control(eld_prefix() . 'gmail_contact', array(
                'label'   => 'Email',
                'section' => eld_prefix() . 'section_footer',
                'type'    => 'text',
            ));



            $wp_customize->add_section(eld_prefix() . 'section_social', array(
                'title' => esc_html__('Social', 'elanding'),
                'capability' => 'edit_theme_options',
                'panel' => 'panel_footer',
            ));

            $wp_customize->add_setting(eld_prefix() . 'link_facebook', array(
                'default'        => '',
                'transport' => 'refresh',
            ));

            $wp_customize->add_control(eld_prefix() . 'link_facebook', array(
                'label'   => 'Link facebook',
                'section' => eld_prefix() . 'section_social',
                'type'    => 'text',
            ));

            $wp_customize->add_setting(eld_prefix() . 'link_twitter', array(
                'default'        => '',
                'transport' => 'refresh',
            ));
            $wp_customize->add_control(eld_prefix() . 'link_twitter', array(
                'label'   => 'Link twitter',
                'section' => eld_prefix() . 'section_social',
                'type'    => 'text',
            ));

            $wp_customize->add_setting(eld_prefix() . 'link_instagram', array(
                'default'        => '',
                'transport' => 'refresh',
            ));
            $wp_customize->add_control(eld_prefix() . 'link_instagram', array(
                'label'   => 'Link twitter',
                'section' => eld_prefix() . 'section_social',
                'type'    => 'text',
            ));
           
        }
    }
}