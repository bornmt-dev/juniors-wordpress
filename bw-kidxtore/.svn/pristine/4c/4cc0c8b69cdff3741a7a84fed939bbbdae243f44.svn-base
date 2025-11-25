<?php
namespace Elementor;
use WP_Query;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Bzotech_Filter_Product_Global extends Widget_Base {

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
		return 'bzotech-filter-product-global';
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
		return esc_html__( 'Filter product', 'bw-kidxtore' );
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
		return 'eicon-posts-ticker';
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
		return [ 'bzotech-el-filter-products' ];
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
		extract($settings);
		if(isset($column['size'])) $column =$column_style_type = $column['size'];
		if(isset($_GET['number']) && $_GET['number']) $number = sanitize_text_field($_GET['number']);
		$get_type = 'list';
		if($style == 'grid'){
                $get_type = 'grid-'.$column_style_type.'col';
                if($column_style_type>=4) $get_type = 'grid-ncol';
            } 
        if(isset($_GET['type'])) $get_type = sanitize_text_field($_GET['type']);
		if($show_top_filter == 'yes') {
			echo '<div class="el-filter-top">';
			bzotech_get_template('top-filter','',array('style'=>$get_type,'number'=>$number,'show_number'=>$show_number,'show_type'=>$show_type,'show_order'=>$show_order,'column_style_type'=>$column_style_type),true);
			echo '</div>';
		}
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
			'section_top_filter',
			[
				'label' => esc_html__( 'Top filter', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_top_filter',
			[
				'label' => esc_html__( 'Status', 'bw-kidxtore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-kidxtore' ),
				'label_off' => esc_html__( 'Off', 'bw-kidxtore' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_responsive_control(
			'column',
			[
				'label' => esc_html__( 'Column', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' =>4,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'condition' => [
					'show_top_filter' => 'yes',
				]
			]
		); 
		$this->add_control(
			'show_type',
			[
				'label' => esc_html__( 'Type', 'bw-kidxtore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-kidxtore' ),
				'label_off' => esc_html__( 'Off', 'bw-kidxtore' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'show_top_filter' => 'yes',
				]
			]
		);

		$this->add_control(
			'style',
			[
				'label' 	=> esc_html__( 'Display type (Layout)', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'grid',
				'options'   => [
					'grid'		=> esc_html__( 'Grid', 'bw-kidxtore' ),
					'list'		=> esc_html__( 'List', 'bw-kidxtore' ),
				],
				'condition' => [
					'show_type' => 'yes',
					'show_top_filter' => 'yes',
				]
			]
		);
		$this->add_control(
			'show_number',
			[
				'label' => esc_html__( 'Number', 'bw-kidxtore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-kidxtore' ),
				'label_off' => esc_html__( 'Off', 'bw-kidxtore' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'show_top_filter' => 'yes',
				]
			]
		);
		$this->add_control(
			'number',
			[
				'label' => esc_html__( 'Number', 'bw-kidxtore' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000,
				'step' => 1,
				'condition' => [
					'show_number' => 'yes',
					'show_top_filter' => 'yes',
				]
			]
		);
		$this->add_control(
			'show_order',
			[
				'label' => esc_html__( 'Order', 'bw-kidxtore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-kidxtore' ),
				'label_off' => esc_html__( 'Off', 'bw-kidxtore' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'show_top_filter' => 'yes',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_filter',
			[
				'label' => esc_html__( 'Filter Button', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'filter_show',
			[
				'label' => esc_html__( 'Status', 'bw-kidxtore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-kidxtore' ),
				'label_off' => esc_html__( 'Off', 'bw-kidxtore' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'filter_style',
			[
				'label' 	=> esc_html__( 'Style', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''					=> esc_html__( 'Style 1', 'bw-kidxtore' ),
					'filter-col'		=> esc_html__( 'Style 2', 'bw-kidxtore' ),
					'filter-col filter-col-list'	=> esc_html__( 'Style 3', 'bw-kidxtore' ),
				],
				'condition' => [
					'filter_show' => 'yes',
				]
			]
		);

		$this->add_control(
			'filter_column',
			[
				'label' 	=> esc_html__( 'Column', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'filter-4-col',
				'options'   => [
					'filter-2-col'				=> esc_html__( '2 Column', 'bw-kidxtore' ),
					'filter-3-col'				=> esc_html__( '3 Column', 'bw-kidxtore' ),
					'filter-4-col'				=> esc_html__( '4 Column', 'bw-kidxtore' ),
				],
				'condition' => [
					'filter_show' => 'yes',
					'filter_style' => ['filter-col','filter-col filter-col-list'],
				]
			]
		);

		$this->add_control(
			'filter_cats', 
			[
				'label' => esc_html__( 'Categories', 'bw-kidxtore' ),
				'description' => esc_html__( 'Enter slug categories. The values separated by ",". Example cat-1,cat-2', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'cat-1,cat-2', 'bw-kidxtore' ),
				'condition' => [
					'filter_show' => 'yes',
				]
			]
		);

		$this->add_control(
			'filter_price',
			[
				'label' => esc_html__( 'Price', 'bw-kidxtore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-kidxtore' ),
				'label_off' => esc_html__( 'Off', 'bw-kidxtore' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'filter_show' => 'yes',
				]
			]
		);

		$this->add_control(
			'filter_attr', 
			[
				'label' => esc_html__( 'Attributes', 'bw-kidxtore' ),
				'description' => esc_html__( 'Enter slug attributes. The values separated by ",". Example attribute-1,attribute-2', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'cat-1,cat-2', 'bw-kidxtore' ),
				'condition' => [
					'filter_show' => 'yes',
				]
			]
		);

		$this->end_controls_section();
	}


}