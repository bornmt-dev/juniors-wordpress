<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bzotech_Tool_Panel_Global extends Widget_Base {
	public function get_name() {
		return 'bzotech_tool_panel_global';
	}
	public function get_title() {
		return esc_html__( 'Tool Panel (Global)', 'bw-kidxtore' );
	}
	public function get_icon() {
		return 'eicon-tabs';
	}
	public function get_categories() {
		return [ 'aqb-htelement-category' ];
	}

	public function get_style_depends() {
		return [ 'bzotech-el-tool-panel' ];
	}

	protected function render() {
		$settings = $this->get_settings();
		$attr = array(
			'wdata'		=> $this,
			'settings'	=> $settings,
		);
		extract($settings);
		$html ='';
		$data_content = array(
			'buy_link' => $buy_link['url'],
			'image' => $image['url'],
			'title' => $title,
			'list_demo' => $list_demo
		);
		
		$data_content = json_encode($data_content);

		$html .=    '<div class="widget-indexdm" id="widget_indexdm">
                        
                        <a href="'.$buy_link['url'].'" target="_blank" class="dm-button" data-title="Buy now" data-title-close="Buy now"><img src="https://kidxtore.bzotech.com/wp-content/uploads/2023/07/buy-icon.webp" alt="icon" /><span>Buy now</span></a>
                        <a href="'.$support_link['url'].'" target="_blank" class="dm-button dm-support" data-title="Support" data-title-close="Support"><img src="https://kidxtore.bzotech.com/wp-content/uploads/2023/07/support-icon.webp" alt="icon" /><span>Support</span></a>
                        
                        <div class="widget-indexdm-inner bzotech-scrollbar"></div>          
                    </div>
                    <div id="indexdm_img"><div class="img-demo"></div></div>';
		echo apply_filters('bzotech_output_tool_panel',$html);
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
			'image',
			[
				'label' => esc_html__( 'Image preview', 'bw-kidxtore' ),
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
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '', 'bw-kidxtore' ),
				'label_block' => true,
				
			]
		);
		$this->add_control(
			'desc',
			[
				'label' => esc_html__( 'Desc', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '', 'bw-kidxtore' ),
				'label_block' => true,
				
			]
		);
		$this->add_control(
			'buy_link',
			[
				'label' => esc_html__( 'Link Buy', 'bw-kidxtore' ),
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
		$this->add_control(
			'support_link',
			[
				'label' => esc_html__( 'Link Support', 'bw-kidxtore' ),
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
		$this->add_control(
			'guide_link',
			[
				'label' => esc_html__( 'Link Guide', 'bw-kidxtore' ),
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
		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title Demo', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Demo 1', 'bw-kidxtore' ),
				'placeholder' => esc_html__( 'Demo 1', 'bw-kidxtore' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Image Demo', 'bw-kidxtore' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => true,
				],
			]
		);
		$repeater->add_control(
			'image_pre',
			[
				'label' => esc_html__( 'Image preview', 'bw-kidxtore' ),
				'type' => Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => true,
				],
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link Demo', 'bw-kidxtore' ),
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
		
		$this->add_control(
			'list_demo',
			[
				'label' => esc_html__( 'Items demo', 'bw-kidxtore' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'separator' => 'before',
			]
		);
		
		$this->end_controls_section();
		
	}


}
