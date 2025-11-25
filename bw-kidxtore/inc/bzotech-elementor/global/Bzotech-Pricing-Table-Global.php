<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bzotech_Pricing_Table_Global extends Widget_Base {
	public function get_name() {
		return 'bzotech_pricing_table_global';
	}
	public function get_title() {
		return esc_html__( 'Pricing Table (Global)', 'bw-kidxtore' );
	}
	public function get_icon() {
		return 'eicon-table-of-contents';
	}
	public function get_categories() {
		return [ 'aqb-htelement-category' ];
	}
	public function get_style_depends() {
		return [ 'bzotech-el-pricing-table' ];
	}
	protected function render() {
		$settings = $this->get_settings();
		$attr = array(
			'wdata'		=> $this,
			'settings'	=> $settings,
		);
		echo bzotech_get_template_elementor_global('pricing-table/pricing-table',$settings['style'],$attr);
	}
	
	protected function content_template() {
		
	}
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'style',
			[
				'label' 	=> esc_html__( 'Style', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Style 1', 'bw-kidxtore' ),
					'style2'	=> esc_html__( 'Style 2', 'bw-kidxtore' ),
				],
			]
		);
		$this->add_control(
			'label', [
				'label' => esc_html__( 'Label', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter text', 'bw-kidxtore' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Title text', 'bw-kidxtore' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'price', [
				'label' => esc_html__( 'Price', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter text', 'bw-kidxtore' ),
				'label_block' => true,
			]
		);
		
		
		$repeater = new Repeater();
		$repeater->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Title text', 'bw-kidxtore' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'bw-kidxtore' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'bw-kidxtore' ),
				'show_label' => false,
			]
		);
		$this->add_control(
			'list_pricing_table',
			[
				'label' => esc_html__( 'Add list', 'bw-kidxtore' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater->get_controls(),
				
			]
		);
		$this->add_control(
			'button_text', 
			[
				'label' => esc_html__( 'Text button', 'bw-kidxtore' ),
				'description' => esc_html__( 'Enter text of button', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Read more', 'bw-kidxtore' ),
				'placeholder' => esc_html__( 'Read more', 'bw-kidxtore' ),
			]
		);
		$this->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Link', 'bw-kidxtore' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'bw-kidxtore' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => true,
				],
			]
		);
		$left = is_rtl() ? 'right' : 'left';
		$right = is_rtl() ? 'left' : 'right';
		$this->add_responsive_control(
			'alignment',
			[
				'label' => esc_html__( 'Alignment', 'bw-kidxtore' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'bw-kidxtore' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'bw-kidxtore' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'bw-kidxtore' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'main_color',
			[
				'label' => esc_html__( 'Main Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .element-pricing-table- .price' => 'color: {{VALUE}}',
					'{{WRAPPER}} .button-pricing:hover' => 'background: {{VALUE}}; border-color:{{VALUE}}',
					'{{WRAPPER}} .element-pricing-table-:hover' => 'border-bottom-color: {{VALUE}}',
					'{{WRAPPER}} .element-pricing-table-:hover .button-pricing' => 'border-bottom-color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();
	}
}?>