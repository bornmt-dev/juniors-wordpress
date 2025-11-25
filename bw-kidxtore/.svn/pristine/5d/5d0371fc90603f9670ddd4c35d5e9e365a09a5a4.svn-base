<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Bzotech_Search_Global extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'bzotech-search_global';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Search form (Global)', 'bw-kidxtore' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-search';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'aqb-htelement-category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'hello-world' ];
	}

	public function get_style_depends() {
		return [ 'bzotech-el-search' ];
	}
	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label' 	=> esc_html__( 'Style', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default'		=> esc_html__( 'Style 1 (Default)', 'bw-kidxtore' ),
					'style2'  		=> esc_html__( 'Style 2 (Home 7)', 'bw-kidxtore' ),
					'style3'  		=> esc_html__( 'Style 3 (Home 8)', 'bw-kidxtore' ),
					'style4'  		=> esc_html__( 'Style 4 (Home 10)', 'bw-kidxtore' ),
					'icon'  		=> esc_html__( 'Style icon (Icon popup)', 'bw-kidxtore' ),
					
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_button',
			[
				'label' => esc_html__( 'Search button', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'style' => ['default','style2']
				]
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'bw-kidxtore' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-search',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'search_bttext',
			[
				'label' => esc_html__( 'Add text', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your text to add search button', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			'search_bttext_pos',
			[
				'label' => esc_html__( 'Text position', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after-icon',
				'options' => [
					'after-icon'   => esc_html__( 'After icon', 'bw-kidxtore' ),
					'before-icon'  => esc_html__( 'Before icon', 'bw-kidxtore' ),
				],
				'condition' => [
					'search_bttext!' => '',
					'icon[value]!' => '',
				]
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_icon_popup',
			[
				'label' => esc_html__( 'Icon - popup', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'style' => ['icon','icon2']
				]
			]
		);

		$this->add_control(
			'icon_popup',
			[
				'label' => esc_html__( 'Icon', 'bw-kidxtore' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-search',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'search_bttext_popup',
			[
				'label' => esc_html__( 'Add text', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your text to add search button', 'bw-kidxtore' ),
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_form',
			[
				'label' => esc_html__( 'Form', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label' => esc_html__( 'Placeholder', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter key to search', 'bw-kidxtore' ),
				'placeholder' => esc_html__( 'Type your placeholder here', 'bw-kidxtore' ),
			]
		);
		$this->add_control(
			'search_in',
			[
				'label'		=> esc_html__( 'Search in', 'bw-kidxtore' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> 'product',
				'options'   => [
					'product'  => esc_html__( 'Product', 'bw-kidxtore' ),
					'post'     => esc_html__( 'Post', 'bw-kidxtore' ),
					'all'      => esc_html__( 'All', 'bw-kidxtore' ),
				],
			]
		);
		$this->add_control(
			'show_cat',
			[
				'label' => esc_html__( 'Show choose category', 'bw-kidxtore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'bw-kidxtore' ),
				'label_off' => esc_html__( 'Hide', 'bw-kidxtore' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'search_in!' => 'all'
				]
			]
		);
		$this->add_control(
			'cats', 
			[
				'label' => esc_html__( 'Categories', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter slug categories. The values separated by ",". Example cat-1,cat-2. Default will show all categories', 'bw-kidxtore' ),
				'condition' => [
					'show_cat' => 'yes'
				]
			]
		);
		$this->add_control(
			'live_search',
			[
				'label' => esc_html__( 'Live search', 'bw-kidxtore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-kidxtore' ),
				'label_off' => esc_html__( 'Off', 'bw-kidxtore' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_cat',
			[
				'label' => esc_html__( 'Categories dropdown', 'bw-kidxtore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_cat' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_cat',
			[
				'label' => esc_html__( 'Title', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'All categories', 'bw-kidxtore' ),
				'placeholder' => esc_html__( 'Type your title here', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			'title_cat_color',
			[
				'label' => esc_html__( 'Title Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elbzotech-dropdown-box .current-search-cat' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'width_cat',
			[
				'label' => esc_html__( 'Width', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-dropdown-box' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_cat',
			[
				'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-dropdown-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_cat',
			[
				'label' => esc_html__( 'Margin', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-dropdown-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_cat',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elbzotech-dropdown-box',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_cat',
				'selector' => '{{WRAPPER}} .elbzotech-dropdown-box',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_cat_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-dropdown-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_icon_popup',
			[
				'label' => esc_html__( 'Style icon popup', 'bw-kidxtore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => ['icon','icon2']
				]
			]
		);

		$this->add_responsive_control(
			'width_icon_popup',
			[
				'label' => esc_html__( 'Width', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height_icon_popup',
			[
				'label' => esc_html__( 'Height', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'line-height_icon_popup',
			[
				'label' => esc_html__( 'Line Height', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'size_icon_popup',
			[
				'label' => esc_html__( 'Size icon', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$start = is_rtl() ? 'right' : 'left';
		$end = is_rtl() ? 'left' : 'right';
		$this->add_responsive_control(
			'flex_direction',
			[
				'label' => esc_html__( 'Direction', 'bw-kidxtore' ),
				'type' => Controls_Manager::CHOOSE,
				'responsive' => true,
				'label_block' => true,
				'options' => [
					'row' => [
						'title' => esc_html_x( 'Row - horizontal', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-arrow-' . $end,
					],
					'column' => [
						'title' => esc_html_x( 'Column - vertical', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-arrow-down',
					],
					'row-reverse' => [
						'title' => esc_html_x( 'Row - reversed', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-arrow-' . $start,
					],
					'column-reverse' => [
						'title' => esc_html_x( 'Column - reversed', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-arrow-up',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'flex-direction: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
				'label' => esc_html__( 'Justify Content', 'bw-kidxtore' ),
				'type' => Controls_Manager::CHOOSE,
				'responsive' => true,
				'label_block' => true,
				'options' => [
					'flex-start' => [
						'title' => esc_html_x( 'Start', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html_x( 'Center', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-justify-center-h',
					],
					'flex-end' => [
						'title' => esc_html_x( 'End', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-justify-end-h',
					],
					'space-between' => [
						'title' => esc_html_x( 'Space Between', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-justify-space-between-h',
					],
					'space-around' => [
						'title' => esc_html_x( 'Space Around', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-justify-space-around-h',
					],
					'space-evenly' => [
						'title' => esc_html_x( 'Space Evenly', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-justify-space-evenly-h',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'justify-content: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'align_items',
			[
				'label' => esc_html__( 'Align Items', 'bw-kidxtore' ),
				'type' => Controls_Manager::CHOOSE,
				'responsive' => true,
				'options' => [
					'flex-start' => [
						'title' => esc_html_x( 'Start', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-align-start-v',
					],
					'center' => [
						'title' => esc_html_x( 'Center', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-align-center-v',
					],
					'flex-end' => [
						'title' => esc_html_x( 'End', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-align-end-v',
					],
					'stretch' => [
						'title' => esc_html_x( 'Stretch', 'Flex Container Control', 'bw-kidxtore' ),
						'icon' => 'eicon-flex eicon-align-stretch-v',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'align-items: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'align_icon_popup',
			[
				'label' => esc_html__( 'Alignment', 'bw-kidxtore' ),
				'type' => Controls_Manager::CHOOSE,
				'default'	=> '',
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
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->start_controls_tabs( 'icon_popup_effects' );

		$this->start_controls_tab( 'icon_popup_normal',
			[
				'label' => esc_html__( 'Normal', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			'color_icon_popup',
			[
				'label' => esc_html__( 'Icon Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'color_text_popup',
			[
				'label' => esc_html__( 'Text Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup .bttext_popup' => 'color: {{VALUE}}',
				],
			]

		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_popup_typography_hover_css',
				'label' => esc_html__( 'Typography Text', 'bw-kidxtore' ),
				'selector' => '{{WRAPPER}} .search-icon-popup .bttext_popup',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_icon_popup',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .search-icon-popup',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_icon_popup',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .search-icon-popup',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_icon_popup',
				'selector' => '{{WRAPPER}} .search-icon-popup',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_icon_popup',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'icon_popup_hover',
			[
				'label' => esc_html__( 'Hover', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			'color_icon_popup_hover',
			[
				'label' => esc_html__( 'Icon Color Hover', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup:hover i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'color_text_popup_hover',
			[
				'label' => esc_html__( 'Text Color Hover', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup:hover .bttext_popup' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_icon_popup_hover',
				'label' => esc_html__( 'Background Hover', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .search-icon-popup:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_icon_popup_hover',
				'exclude' => [
					'box_shadow_position',
				],
				'label' => esc_html__( 'Box Shadow Hover', 'bw-kidxtore' ),
				'selector' => '{{WRAPPER}} .search-icon-popup:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_icon_popup_hover',
				'label' => esc_html__( 'Border Hover', 'bw-kidxtore' ),
				'selector' => '{{WRAPPER}} .search-icon-popup:hover',
			]
		);

		$this->add_responsive_control(
			'border_icon_popup_hover',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Border Radius Hover', 'bw-kidxtore' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();	

		$this->add_control(
			'separator_icon_popup',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_responsive_control(
			'padding_icon_popup',
			[
				'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_icon_popup',
			[
				'label' => esc_html__( 'Margin', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .search-icon-popup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
 		
		$this->end_controls_section();

		$this->get_style_form();
		$this->start_controls_section(
			'section_style_form_input',
			[
				'label' => esc_html__( 'Style input', 'bw-kidxtore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->get_style_form_input();
		$this->end_controls_section();

		$this->get_style_form_btn_search();
		$this->start_controls_section(
			'section_style_box_live',
			[
				'label' => esc_html__( 'Style box live', 'bw-kidxtore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'live_search' => ['yes']
				]
			]
		);
		$this->get_style_box_live();
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();
		$attr = array(
			'wdata'			=> $this,
			'settings'			=> $settings,
		);
		echo bzotech_get_template_elementor_global('search/search',$settings['style'],$attr,true);
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
	public function get_style_box_live() {
		$this->add_responsive_control(
			'width_box_live',
			[
				'label' => esc_html__( 'Width', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%','custom' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .box-live-e' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'height_box_live',
			[
				'label' => esc_html__( 'Height', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%','custom' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .box-live-e' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'left_box_live',
			[
				'label' => esc_html__( 'Left position', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%','custom' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .box-live-e' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_cat_live',
			[
				'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .box-live-e' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}
	public function get_style_form() {
		$this->start_controls_section(
			'section_style_form',
			[
				'label' => esc_html__( 'Style form', 'bw-kidxtore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->get_style_type_container_flex_base('container_flex_form','elbzotech-search-global-form');

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_form',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elbzotech-search-global-form',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_form',
				'selector' => '{{WRAPPER}} .elbzotech-search-global-form',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius_form',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'width_form',
			[
				'label' => esc_html__( 'Width', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%','custom' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'height_form',
			[
				'label' => esc_html__( 'Height', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%','custom' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'padding_form',
			[
				'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_form',
			[
				'label' => esc_html__( 'Margin', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}
	public function get_style_form_input() {
		$this->add_control(
			'color_form_input',
			[
				'label' => esc_html__( 'Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form input[name="s"]' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_input_typography_hover_css',
				'label' => esc_html__( 'Typography Text', 'bw-kidxtore' ),
				'selector' => '{{WRAPPER}} .elbzotech-search-global-form input[name="s"]',
			]
		);
		$this->add_responsive_control(
			'width_form_input',
			[
				'label' => esc_html__( 'Width', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%','custom' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form input[name="s"]' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'height_form_input',
			[
				'label' => esc_html__( 'Height', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%','custom' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form input[name="s"]' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'padding_form_input',
			[
				'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form input[name="s"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_form_input',
			[
				'label' => esc_html__( 'Margin', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form input[name="s"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_form_input',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elbzotech-search-global-form input[name="s"]',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_form_input',
				'selector' => '{{WRAPPER}} .elbzotech-search-global-form input[name="s"]',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius_form_input',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form input[name="s"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
	}
	public function get_style_form_btn_search() {
		$this->start_controls_section(
			'section_style_button_search',
			[
				'label' => esc_html__('Button', 'bw-kidxtore'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->get_style_type_container_flex_base('btn_search_flex', 'elbzotech-text-bt-search');

		$this->start_controls_tabs('button_search_effects');

		$this->start_controls_tab('button_search_normal',
			[
				'label' => esc_html__('Normal', 'bw-kidxtore'),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_search_typography',
				'selector' => '{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search',
				'label' => esc_html__('Typography', 'bw-kidxtore'),
			]
		);
		$this->add_control(
			'button_search_color',
			[
				'label' => esc_html__('Color', 'bw-kidxtore'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_search_background',
				'label' => esc_html__('Background', 'bw-kidxtore'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_search_shadow',
				'selector' => '{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_search_border',
				'selector' => '{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search',
			]
		);
		$this->add_responsive_control(
			'button_search_border_radius',
			[
				'label' => esc_html__('Border Radius', 'bw-kidxtore'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_search_padding',
			[
				'label' => esc_html__('Padding', 'bw-kidxtore'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
				],
			]
		);
		$this->add_responsive_control(
			'button_search_width_css',
			[
				'label' => esc_html__('Width', 'bw-kidxtore'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px', 'vw'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_search_height_css',
			[
				'label' => esc_html__('Height', 'bw-kidxtore'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px', 'vw'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search' => 'height: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);
		$this->add_responsive_control(
			'button_search_line_height_css',
			[
				'label' => esc_html__('Line Height', 'bw-kidxtore'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px', 'vw'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search' => 'Line-height: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('button_search_hover',
			[
				'label' => esc_html__('Hover', 'bw-kidxtore'),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_search_typography_hover',
				'label' => esc_html__('Typography hover', 'bw-kidxtore'),
				'selector' => '{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search:hover',
			]
		);
		$this->add_control(
			'button_search_color_hover',
			[
				'label' => esc_html__('Color hover', 'bw-kidxtore'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search:hover' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_search_background_hover',
				'label' => esc_html__('Background hover', 'bw-kidxtore'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_search_shadow_hover',
				'label' => esc_html__('button shadow hover', 'bw-kidxtore'),
				'selector' => '{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_search_border_hover',
				'label' => esc_html__('Border hover', 'bw-kidxtore'),
				'selector' => '{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search:hover',
			]
		);

		$this->add_responsive_control(
			'button_search_border_radius_hover',
			[
				'label' => esc_html__('Border Radius hover', 'bw-kidxtore'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_search_padding_hover',
			[
				'label' => esc_html__('Padding hover', 'bw-kidxtore'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'button_search_hover_transition',
			[
				'label' => esc_html__('Transition Duration', 'bw-kidxtore'),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'before',
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elbzotech-search-global-form .elbzotech-text-bt-search' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_section();
		
	}
	public function get_style_type_container_flex_base($key = 'container_flex', $class = "container-flex-e") {

		$start = is_rtl() ? 'right' : 'left';
		$end = is_rtl() ? 'left' : 'right';
		$this->add_responsive_control(
			$key . '_flex_direction',
			[
				'label' => esc_html__('Direction', 'bw-kidxtore'),
				'type' => Controls_Manager::CHOOSE,
				'responsive' => true,
				'label_block' => true,
				'options' => [
					'row' => [
						'title' => esc_html_x('Row - horizontal', 'Flex Container Control', 'bw-kidxtore'),
						'icon' => 'eicon-arrow-' . $end,
					],
					'column' => [
						'title' => esc_html_x('Column - vertical', 'Flex Container Control', 'bw-kidxtore'),
						'icon' => 'eicon-arrow-down',
					],
					'row-reverse' => [
						'title' => esc_html_x('Row - reversed', 'Flex Container Control', 'bw-kidxtore'),
						'icon' => 'eicon-arrow-' . $start,
					],
					'column-reverse' => [
						'title' => esc_html_x('Column - reversed', 'Flex Container Control', 'bw-kidxtore'),
						'icon' => 'eicon-arrow-up',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .' . $class => 'flex-direction: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			$key . '_alignment',
			[
				'label' => esc_html__('Justify Content', 'bw-kidxtore'),
				'type' => Controls_Manager::CHOOSE,
				'responsive' => true,
				'label_block' => true,
				'options' => [
					'flex-start' => [
						'title' => esc_html_x('Start', 'Flex Container Control', 'bw-kidxtore'),
						'icon' => 'eicon-flex eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html_x('Center', 'Flex Container Control', 'bw-kidxtore'),
						'icon' => 'eicon-flex eicon-justify-center-h',
					],
					'flex-end' => [
						'title' => esc_html_x('End', 'Flex Container Control', 'bw-kidxtore'),
						'icon' => 'eicon-flex eicon-justify-end-h',
					],
					'space-between' => [
						'title' => esc_html_x('Space Between', 'Flex Container Control', 'bw-kidxtore'),
						'icon' => 'eicon-flex eicon-justify-space-between-h',
					],
					'space-around' => [
						'title' => esc_html_x('Space Around', 'Flex Container Control', 'bw-kidxtore'),
						'icon' => 'eicon-flex eicon-justify-space-around-h',
					],
					'space-evenly' => [
						'title' => esc_html_x('Space Evenly', 'Flex Container Control', 'bw-kidxtore'),
						'icon' => 'eicon-flex eicon-justify-space-evenly-h',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .' . $class => 'justify-content: {{VALUE}};',
				],
				'default' => '',
			]
		);

		$this->add_responsive_control(
			$key . 'align_items',
			[
				'label' => esc_html__('Align Items', 'bw-kidxtore'),
				'type' => Controls_Manager::CHOOSE,
				'responsive' => true,
				'options' => [
					'flex-start' => [
						'title' => esc_html_x('Start', 'Flex Container Control', 'bw-kidxtore'),
						'icon' => 'eicon-flex eicon-align-start-v',
					],
					'center' => [
						'title' => esc_html_x('Center', 'Flex Container Control', 'bw-kidxtore'),
						'icon' => 'eicon-flex eicon-align-center-v',
					],
					'flex-end' => [
						'title' => esc_html_x('End', 'Flex Container Control', 'bw-kidxtore'),
						'icon' => 'eicon-flex eicon-align-end-v',
					],
					'stretch' => [
						'title' => esc_html_x('Stretch', 'Flex Container Control', 'bw-kidxtore'),
						'icon' => 'eicon-flex eicon-align-stretch-v',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .' . $class => 'align-items: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			$key . 'gap_item',
			[
				'label' => esc_html__('Gap', 'bw-kidxtore'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .' . $class => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			$key . 'flex_wrap',
			[
				'label' => esc_html__('Wrap', 'bw-kidxtore'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'nowrap' => [
						'title' => esc_html__('No Wrap', 'bw-kidxtore'),
						'icon' => 'eicon-flex eicon-nowrap',
					],
					'wrap' => [
						'title' => esc_html__('Wrap', 'bw-kidxtore'),
						'icon' => 'eicon-flex eicon-wrap',
					],
				],
				'description' => esc_html__(
					'Items within the container can stay in a single line (No wrap), or break into multiple lines (Wrap).', 'bw-kidxtore'
				),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .' . $class => 'flex-wrap: {{VALUE}};',
				],
				'responsive' => true,
			]
		);

	}
	
}
