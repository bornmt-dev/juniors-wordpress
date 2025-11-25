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
class Bzotech_Products_Global extends Widget_Base {

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
		return 'bzotech-products-global';
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
		return esc_html__( 'Products list (Global)', 'bw-kidxtore' );
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
		return [ 'bzotech-el-products' ];
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
		if(!class_exists('woocommerce')) return;
		$slider_items_widescreen =$slider_items_laptop = $slider_items_tablet_extra =$slider_items_mobile_extra =$slider_items_mobile =$slider_space_widescreen =$slider_space_laptop =$slider_space_tablet_extra =$slider_space_tablet =$slider_space_mobile_extra= $slider_space_mobile ='';
		$column_widescreen = $column_laptop =$slider_items_tablet =$column_tablet_extra =$column_tablet =$column_mobile_extra =$column_mobile ='';
		$settings = $this->get_settings();
		extract($settings);
		$get_type =$view = str_replace('elbzotech-product-', '', $display);
		if(isset($column['size']) && $get_type == 'grid') {
			if($column['size']<4)
				$get_type = 'grid-'.$column['size'].'col';
			else
				$get_type = 'grid-ncol';
		}
		if(isset($_GET['type']) && $_GET['type']) $get_type = sanitize_text_field($_GET['type']);
		if($get_type == 'grid-2col' ||$get_type == 'grid-3col' || $get_type == 'grid-ncol') $view = 'grid'; else if($get_type == 'list')$view = 'list';
        if(isset($_GET['number']) && $_GET['number']) $number = sanitize_text_field($_GET['number']);
		
        if(!empty($css_class)) $el_class .= ' '.$css_class;
        $filter_show = '';
        $el_class = 'product-'.$view.'-view '.$grid_type.' filter-'.$filter_show;

		if(isset($column['size'])) $column =$column_style_type = $column['size'];
		if(isset($column_widescreen['size'])) $column_widescreen = $column_widescreen['size'];
		if(isset($column_laptop['size'])) $column_laptop = $column_laptop['size'];
		if(isset($column_tablet_extra['size'])) $column_tablet_extra = $column_tablet_extra['size'];
		if(isset($column_tablet['size'])) $column_tablet = $column_tablet['size'];
		if(isset($column_mobile_extra['size'])) $column_mobile_extra = $column_mobile_extra['size'];
		if(isset($column_mobile['size'])) $column_mobile = $column_mobile['size'];
		if(!empty($column_custom)){
        	$column = $column_tablet = $column_mobile = $column_widescreen= $column_laptop= $column_tablet_extra= $column_mobile_extra='';
        }
        if($get_type == 'grid-2col'){
		    $column = 2;
		}else if($get_type == 'grid-3col'){
		    $column = 3;
		}
		if ( $view == 'grid' ) {
			$this->add_render_attribute( 'elbzotech-item-grid', 'class', 'list-col-item item-grid-product-'.$item_style.' list-'.esc_attr($column).'-item list-'.esc_attr($column_widescreen).'-item-widescreen list-'.esc_attr($column_laptop).'-item-laptop  list-'.esc_attr($column_tablet_extra).'-item-tablet-extra list-'.esc_attr($column_tablet).'-item-tablet list-'.esc_attr($column_mobile_extra).'-item-mobile-extra list-'.esc_attr($column_mobile).'-item-mobile');
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-grid',$column_custom);
		}
		$this->add_render_attribute( 'elbzotech-item', 'class', 'item-product');
		if ( $view == 'slider') { 
			$this->add_render_attribute( 'elbzotech-wrapper', 'class', 'elbzotech-swiper-slider swiper-container' );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-custom', $slider_items_custom );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items', $slider_items );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-widescreen', $slider_items_widescreen );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-laptop', $slider_items_laptop );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-tablet-extra', $slider_items_tablet_extra);
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-tablet', $slider_items_tablet);
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-mobile-extra', $slider_items_mobile_extra);
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-mobile', $slider_items_mobile );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space', $slider_space );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-widescreen', $slider_space_widescreen );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-laptop', $slider_space_laptop );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-tablet-extra', $slider_space_tablet_extra );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-tablet', $slider_space_tablet );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-mobile-extra', $slider_space_mobile_extra );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-mobile', $slider_space_mobile );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column', $slider_column );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-auto', $slider_auto );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-center', $slider_center );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-loop', $slider_loop );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-speed', $slider_speed );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-navigation', $slider_navigation );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-pagination', $slider_pagination );
			$this->add_render_attribute( 'elbzotech-inner', 'class', 'swiper-wrapper' );
			$this->add_render_attribute( 'elbzotech-item-grid', 'class', 'swiper-slide item-grid-product-'.$item_style);
		}else if ( $view == 'slider-masory') {
			$this->add_render_attribute( 'elbzotech-wrapper', 'class', 'elbzotech-swiper-slider swiper-container' );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-custom', $slider_items_custom );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items', $slider_items );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-widescreen', $slider_items_widescreen );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-laptop', $slider_items_laptop );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-tablet-extra', $slider_items_tablet_extra);
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-tablet', $slider_items_tablet);
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-mobile-extra', $slider_items_mobile_extra);
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-items-mobile', $slider_items_mobile );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space', $slider_space );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-widescreen', $slider_space_widescreen );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-laptop', $slider_space_laptop );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-tablet-extra', $slider_space_tablet_extra );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-tablet', $slider_space_tablet );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-mobile-extra', $slider_space_mobile_extra );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-space-mobile', $slider_space_mobile );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column', $slider_column );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-auto', $slider_auto );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-center', $slider_center );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-loop', $slider_loop );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-speed', $slider_speed );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-navigation', $slider_navigation );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-pagination', $slider_pagination );
			$this->add_render_attribute( 'elbzotech-inner', 'class', 'swiper-wrapper' );
			if($slider_items_group > 1) 
				$this->add_render_attribute( 'elbzotech-item-grid', 'class', 'width_masory item-grid-product-'.$item_style);
			else
				$this->add_render_attribute( 'elbzotech-item-grid', 'class', 'swiper-slide item-grid-product-'.$item_style);
		}else if ( $view == 'grid-masory') {
			$this->add_render_attribute( 'elbzotech-wrapper', 'class', 'elbzotech-products-wrap js-content-wrap '.$el_class );
			$this->add_render_attribute( 'elbzotech-inner', 'class', 'js-content-main list-product-wrap ');
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column', $column );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-widescreen', $column_widescreen );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-laptop', $column_laptop );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-tablet-extra', $column_tablet_extra );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-tablet', $column_tablet );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-mobile-extra', $column_mobile_extra );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-mobile', $column_mobile );
		}
		else{

			$this->add_render_attribute( 'elbzotech-wrapper', 'class', 'elbzotech-products-wrap js-content-wrap '.$el_class );
			$this->add_render_attribute( 'elbzotech-inner', 'class', 'js-content-main list-product-wrap bzotech-row');
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column', $column );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-widescreen', $column_widescreen );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-laptop', $column_laptop );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-tablet-extra', $column_tablet_extra );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-tablet', $column_tablet );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-mobile-extra', $column_mobile_extra );
			$this->add_render_attribute( 'elbzotech-wrapper', 'data-column-mobile', $column_mobile );
		}
        
        $paged = (get_query_var('paged') && $view != 'slider'&& $view != 'slider-masory') ? get_query_var('paged') : 1;
        $args = array(
            'post_type'         => 'product',
            'posts_per_page'    => $number,
            'orderby'           => $orderby,
            'order'             => $order,
            'paged'             => $paged,
            );
        $hide_out_of_stock = get_option('woocommerce_hide_out_of_stock_items', 'no');
        if ($hide_out_of_stock === 'yes') {
		    $args['meta_query'][] = array(
		        'key'     => '_stock_status',
		        'value'   => 'outofstock',
		        'compare' => '!=',
		    );
		}
        if($product_type == 'trending'){
            $args['meta_query'][] = array(
                    'key'     => 'trending_product',
                    'value'   => '1',
                    'compare' => '=',
                );
        }
        if($product_type == 'toprate'){
            $args['meta_key'] = '_wc_average_rating';
            $args['orderby'] = 'meta_value_num';
            $args['meta_query'] = WC()->query->get_meta_query();
            $args['tax_query'][] = WC()->query->get_tax_query();
        }
        if($product_type == 'mostview'){
            $args['meta_key'] = 'post_views';
            $args['orderby'] = 'meta_value_num';
        }
        if($product_type == 'menu_order'){
            $args['meta_key'] = 'menu_order';
            $args['orderby'] = 'meta_value_num';
        }
        if($product_type == 'bestsell'){
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
        }
        if($product_type=='onsale'){
            $args['meta_query']['relation']= 'OR';
            $args['meta_query'][]=array(
                'key'   => '_sale_price',
                'value' => 0,
                'compare' => '>',                
                'type'          => 'numeric'
            );
            $args['meta_query'][]=array(
                'key'   => '_min_variation_sale_price',
                'value' => 0,
                'compare' => '>',                
                'type'          => 'numeric'
            );
        }
        if($product_type == 'featured'){
            $args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN',
            );
        }
        if($product_type == 'flash_sale'){
            $args['meta_query']['relation']= 'AND';
            $args['meta_query'][]=array(
                'key'   => '_sale_price',
                'value' => 0,
                'compare' => '>',                
                'type'          => 'numeric'
            );
            $args['meta_query'][1]['relation']='OR';
            $args['meta_query'][1][]=array(
                'key'   => '_sale_price_dates_from',
                'value' => strtotime(date('Y-m-d')),
                'compare' => '<=',                
                'type'          => 'numeric'
            );
            $args['meta_query'][1][]=array(
                'key'   => '_sale_price_dates_from',
                'compare' => 'NOT EXISTS',              
            );
            $args['meta_query'][]=array(
                'key'   => '_sale_price_dates_to',
                'value' => strtotime(date('Y-m-d')),
                'compare' => '>',                
                'type'          => 'numeric'
            );
            $args['meta_query'][]=array(
                'key'   => '_stock',
                'value' => 0,
                'compare' => '>',                
                'type'          => 'numeric'
            );
        }

        if(isset( $_GET['product_cat'])) $cats = sanitize_text_field($_GET['product_cat']);
        if(!empty($cats)) {
            $custom_list = explode(",",$cats);
            $args['tax_query'][]=array(
                'taxonomy'=>'product_cat',
                'field'=>'slug',
                'terms'=> $custom_list
            );
        }
		
        if(!empty($custom_ids)){
            $args['post__in'] = explode(',', $custom_ids);
        }
        $args['tax_query'][] = array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'exclude-from-catalog',
            'operator' => 'NOT IN',
        );
        if( isset( $_GET['min_price']) && isset( $_GET['max_price']) ){
            $min = sanitize_text_field($_GET['min_price']);
            $max = sanitize_text_field($_GET['max_price']);
            $args['post__in'] = bzotech_filter_price($min,$max);
        }
        // Filter by rating.
		if ( isset( $_GET['rating_filter'] ) ) {
			$product_visibility_terms  = wc_get_product_visibility_term_ids();
			$product_visibility_not_in = array( is_search() && $main_query ? $product_visibility_terms['exclude-from-search'] : $product_visibility_terms['exclude-from-catalog'] );
			// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			$rating_filter = array_filter( array_map( 'absint', explode( ',', wp_unslash( $_GET['rating_filter'] ) ) ) );
			$rating_terms  = array();
			for ( $i = 1; $i <= 5; $i ++ ) {
				if ( in_array( $i, $rating_filter, true ) && isset( $product_visibility_terms[ 'rated-' . $i ] ) ) {
					$rating_terms[] = $product_visibility_terms[ 'rated-' . $i ];
				}
			}
			if ( ! empty( $rating_terms ) ) {
				 $args['tax_query'][] = array(
					'taxonomy'      => 'product_visibility',
					'field'         => 'term_taxonomy_id',
					'terms'         => $rating_terms,
					'operator'      => 'IN',
					'rating_filter' => true,
				);
			}
		}

	    $attributes = wc_get_attribute_taxonomies();
	   	if(!empty($attributes) && is_array($attributes)){
	   		foreach($attributes as $attribute){
	   			
	   			if ( isset( $_GET['filter_'.$attribute->attribute_name] ) ) {
					$filter_brand = array_filter(explode( ',', wp_unslash( $_GET['filter_'.$attribute->attribute_name] ) ) );
					if ( ! empty( $filter_brand ) ) {
						 $args['tax_query'][] =array(
					        'taxonomy'        => 'pa_'.$attribute->attribute_name,
					        'field'           => 'slug',
					        'terms'           =>  $filter_brand,
					        'operator'        => 'IN',
					    );
					}
				}
	   		}
	   	}
		
        $product_query = new WP_Query($args);
        $count = 1;
        $count_query = $product_query->post_count;
        $max_page = $product_query->max_num_pages;
        $size = $thumbnail_size;
        if($size == 'custom' && !empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height']))
        	$size = array($thumbnail_custom_dimension['width'],$thumbnail_custom_dimension['height']);
        
        if($grid_type == 'grid-masonry' and !empty($size_masonry)){
			$size = bzotech_get_size_crop($size_masonry);
        }

        $size_list = $thumbnail_list_size;
        if($size_list == 'custom' && !empty($thumbnail_list_custom_dimension['width']) && !empty($thumbnail_list_custom_dimension['height'])) $size_list = array($thumbnail_list_custom_dimension['width'],$thumbnail_list_custom_dimension['height']);
       


        $item_wrap = $this->get_render_attribute_string( 'elbzotech-item-grid' );
        $item_inner = $this->get_render_attribute_string( 'elbzotech-item' );
        $attr = array(
            'el_class'      => $el_class,
            'product_query' => $product_query,
            'count'         => $count,
            'count_query'   => $count_query,
            'max_page'      => $max_page,
            'args'          => $args,
            'column'        => $column,
            'column_style_type'        => $column_style_type,
            'view'       	=> $view,
            'settings'      => $settings,
            'size'      	=> $size,
            'item_wrap'		=> $item_wrap,
            'item_inner'	=> $item_inner,
            'get_type'	=> $get_type,
            'wdata'			=> $this,
        );
        if($display_tab !== '' && is_array($tabs) && count($tabs) >=1){
        	$tab_title_html = $tab_content_html = '';
        	foreach ($tabs as $key => $tab) {
        		extract($tab);
        		if($key == 0) $active = 'active';
        		else $active = '';
        		$args = array(
		            'post_type'         => 'product',
		            'posts_per_page'    => $number,
		            'orderby'           => $orderby,
		            'order'             => $order,
		            'paged'             => $paged,
		            );
		        if($product_type == 'trending'){
		            $args['meta_query'][] = array(
		                    'key'     => 'trending_product',
		                    'value'   => '1',
		                    'compare' => '=',
		                );
		        }
		        if($product_type == 'toprate'){
		            $args['meta_key'] = '_wc_average_rating';
		            $args['orderby'] = 'meta_value_num';
		            $args['meta_query'] = WC()->query->get_meta_query();
		            $args['tax_query'][] = WC()->query->get_tax_query();
		        }
		        if($product_type == 'mostview'){
		            $args['meta_key'] = 'post_views';
		            $args['orderby'] = 'meta_value_num';
		        }
		        if($product_type == 'menu_order'){
		            $args['meta_key'] = 'menu_order';
		            $args['orderby'] = 'meta_value_num';
		        }
		        if($product_type == 'bestsell'){
		            $args['meta_key'] = 'total_sales';
		            $args['orderby'] = 'meta_value_num';
		        }
		        if($product_type=='onsale'){
		            $args['meta_query']['relation']= 'OR';
		            $args['meta_query'][]=array(
		                'key'   => '_sale_price',
		                'value' => 0,
		                'compare' => '>',                
		                'type'          => 'numeric'
		            );
		            $args['meta_query'][]=array(
		                'key'   => '_min_variation_sale_price',
		                'value' => 0,
		                'compare' => '>',                
		                'type'          => 'numeric'
		            );
		        }
		        if($product_type == 'featured'){
		            $args['tax_query'][] = array(
		                'taxonomy' => 'product_visibility',
		                'field'    => 'name',
		                'terms'    => 'featured',
		                'operator' => 'IN',
		            );
		        }
		        if($product_type == 'flash_sale'){
		            $args['meta_query']['relation']= 'AND';
		            $args['meta_query'][]=array(
		                'key'   => '_sale_price',
		                'value' => 0,
		                'compare' => '>',                
		                'type'          => 'numeric'
		            );
		            $args['meta_query'][1]['relation']='OR';
		            $args['meta_query'][1][]=array(
		                'key'   => '_sale_price_dates_from',
		                'value' => strtotime(date('Y-m-d')),
		                'compare' => '<=',                
		                'type'          => 'numeric'
		            );
		            $args['meta_query'][1][]=array(
		                'key'   => '_sale_price_dates_from',
		                'compare' => 'NOT EXISTS',              
		            );
		            $args['meta_query'][]=array(
		                'key'   => '_sale_price_dates_to',
		                'value' => strtotime(date('Y-m-d')),
		                'compare' => '>',                
		                'type'          => 'numeric'
		            );
		            $args['meta_query'][]=array(
		                'key'   => '_stock',
		                'value' => 0,
		                'compare' => '>',                
		                'type'          => 'numeric'
		            );
		        }
		        if(!empty($cats)) {
		            $custom_list = explode(",",$cats);
		            $args['tax_query'][]=array(
		                'taxonomy'=>'product_cat',
		                'field'=>'slug',
		                'terms'=> $custom_list
		            );
		        }
				
		        if(!empty($custom_ids)){
		            $args['post__in'] = explode(',', $custom_ids);
		        }
		        $args['tax_query'][] = array(
		            'taxonomy' => 'product_visibility',
		            'field'    => 'name',
		            'terms'    => 'exclude-from-catalog',
		            'operator' => 'NOT IN',
		        );
		        $attr['args'] = $args;
		        $product_query = new WP_Query($args);
		        $count = 1;
		        $count_query = $product_query->post_count;
		        $max_page = $product_query->max_num_pages;
		        $attr['product_query'] = $product_query;
		        $attr['count'] = $count;
		        $attr['count_query'] = $count_query;
		        $attr['max_page'] = $max_page;
		        $id_tab_rand = $_id.rand(10,1000);
		        $tab_icon_html= '';
		        if(!empty($icon_image['url'])){
					$class_icon_image_hover ='';
					if(!empty($icon_image_hover['url'])) $class_icon_image_hover = 'icon-image-hover__active';
					$tab_icon_html .= '<span class="'.$class_icon_image_hover.'">';
					$tab_icon_html .= Group_Control_Image_Size::get_attachment_image_html( $tabs[$key],'','icon_image');
					
					if(!empty($icon_image_hover['url'])){
						$tab_icon_html .= '<span class="img-hover">'.Group_Control_Image_Size::get_attachment_image_html( $tabs[$key],'','icon_image_hover').'</span>';
					}
					$tab_icon_html .= '</span>';
				}else if(!empty( $icon['value'])){
					$tab_icon_html .= '<span class="">';		
					if( $icon['library'] == 'svg')
						$tab_icon_html .= '<img alt="'.esc_attr__('svg','bw-kidxtore').'" src="'.$icon['value']['url'].'">';
					else
					$tab_icon_html .= '<i class="style-header-tab-icon-item-e  '.$icon['value'].'"></i>';
					$tab_icon_html .= '</span>';
				} 

        		$tab_title_html .= 	'<li class="tab-item-wrap '.$active.'">
        								<a href="#'.$id_tab_rand.'" data-target="#'.$id_tab_rand.'" data-toggle="tab" aria-expanded="false">';
        		if($icon_pos != 'after-text' && $tab_icon_html) $tab_title_html .= $tab_icon_html;
        		$tab_title_html .=		$title;
        		if($icon_pos == 'after-text' && $tab_icon_html) $tab_title_html .= $tab_icon_html;
        		$tab_title_html .=		'</a>
        							</li>';
        		$tab_content_html .= '<div id="'.$id_tab_rand.'" class="tab-pane '.$active.'">';
        		$tab_content_html .= bzotech_get_template_elementor_global('products/shop',$view,$attr,false);
        		$tab_content_html .= '</div>';

        		if($link_btn['is_external']) $this->add_render_attribute( 'link-btn-tab', 'target', "_blank");
				if($link_btn['nofollow']) $this->add_render_attribute( 'link-btn-tab', 'rel', "nofollow");
				if($link_btn['url']) $this->add_render_attribute( 'link-btn-tab', 'href', $link_btn['url']);
				$button_tab_html = '';
        		if(!empty($title_btn)) $button_tab_html = '<a class="view-all" '.$this->get_render_attribute_string('link-btn-tab').'>'.$title_btn.'</a>';
        		$this->remove_render_attribute( 'link-btn-tab', 'target', "_blank" );
				$this->remove_render_attribute( 'link-btn-tab', 'rel', "nofollow");
				$this->remove_render_attribute( 'link-btn-tab', 'href', $link_btn['url']);
        		
        	}
        	$title_tab_html = '';
        	if(!empty($title_tab_product)) $title_tab_html = '<h3 class="title20 font-medium">'.$title_tab_product.'</h3>';

        	echo 	'<div class="product-tab-wrap tab-wrap product-tab-'.$display_tab.'">
        				<div class="product-tab-title">
        					<div class="inner">
        						'.$title_tab_html.'
								<ul class="list-none nav nav-tabs" role="tablist">
									'.$tab_title_html.'
								</ul>
							</div>
						</div>
						<div class="product-tab-content">
							<div class="tab-content">
								'.$tab_content_html.'
							</div>
							'.$button_tab_html.'
						</div>
					</div>';
        }
        else bzotech_get_template_elementor_global('products/shop',$view,$attr,true);
        wp_reset_postdata();
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
		// BEGIN TAB_CONTENT
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Layout', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'display',
			[
				'label' 	=> esc_html__( 'Display type (Layout)', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'elbzotech-product-grid',
				'options'   => [
					'elbzotech-product-grid'		=> esc_html__( 'Grid', 'bw-kidxtore' ),
					'elbzotech-product-list'		=> esc_html__( 'List', 'bw-kidxtore' ),
					'elbzotech-product-slider'		=> esc_html__( 'Slider', 'bw-kidxtore' ),
					'elbzotech-product-grid-masory'		=> esc_html__( 'Grid Masory', 'bw-kidxtore' ),
					'elbzotech-product-slider-better'		=> esc_html__( 'Slider (Start feeling better)', 'bw-kidxtore' ),
				],
			]
		);

		$this->add_control(
			'item_style',
			[
				'label' 	=> esc_html__( 'Item Grid Style', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => bzotech_get_product_style(),
			]
		);

		

		$this->add_control( 
			'display_tab',
			[
				'label' => esc_html__( 'Display tab', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default' => '',
				'options'   => [
					''		=> esc_html__( 'Off', 'bw-kidxtore' ),
					'style1'		=> esc_html__( 'Style 1 (Default)', 'bw-kidxtore' ),
					'style2'		=> esc_html__( 'Style 2 (home 4)', 'bw-kidxtore' ),
					'style3'		=> esc_html__( 'Style 3 (home 5)', 'bw-kidxtore' ),
					'style4'		=> esc_html__( 'Style 4 (home 7)', 'bw-kidxtore' ),
					'style5'		=> esc_html__( 'Style 5 (home 13)', 'bw-kidxtore' ),
				],
			]
		);

		$this->add_control(
			'item_thumbnail',
			[
				'label' => esc_html__( 'Thumbnail', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options'   => [
					''		=> esc_html__( 'Default', 'bw-kidxtore' ),
					'yes'		=> esc_html__( 'Show', 'bw-kidxtore' ),
					'no'		=> esc_html__( 'Hide', 'bw-kidxtore' ),
				],
			]
		);

		$this->add_control(
			'item_title',
			[
				'label' => esc_html__( 'Title', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options'   => [
					''		=> esc_html__( 'Default', 'bw-kidxtore' ),
					'yes'		=> esc_html__( 'Show', 'bw-kidxtore' ),
					'no'		=> esc_html__( 'Hide', 'bw-kidxtore' ),
				],
			]
		);

		$this->add_control(
			'item_quickview',
			[
				'label' => esc_html__( 'Quick View', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options'   => [
					''		=> esc_html__( 'Default', 'bw-kidxtore' ),
					'yes'		=> esc_html__( 'Show', 'bw-kidxtore' ),
					'no'		=> esc_html__( 'Hide', 'bw-kidxtore' ),
				],
			]
		);

		$this->add_control(
			'item_label',
			[
				'label' => esc_html__( 'Label', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options'   => [
					''		=> esc_html__( 'Default', 'bw-kidxtore' ),
					'yes'		=> esc_html__( 'Show', 'bw-kidxtore' ),
					'no'		=> esc_html__( 'Hide', 'bw-kidxtore' ),
				],
			]
		);

		$this->add_control(
			'item_price',
			[
				'label' => esc_html__( 'Price', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options'   => [
					''		=> esc_html__( 'Default', 'bw-kidxtore' ),
					'yes'		=> esc_html__( 'Show', 'bw-kidxtore' ),
					'no'		=> esc_html__( 'Hide', 'bw-kidxtore' ),
				],
			]
		);

		$this->add_control(
			'item_rate',
			[
				'label' => esc_html__( 'Rate', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options'   => [
					''		=> esc_html__( 'Default', 'bw-kidxtore' ),
					'yes'		=> esc_html__( 'Show', 'bw-kidxtore' ),
					'no'		=> esc_html__( 'Hide', 'bw-kidxtore' ),
				],
			]
		);

		$this->add_control(
			'item_button',
			[
				'label' => esc_html__( 'Button', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options'   => [
					''		=> esc_html__( 'Default', 'bw-kidxtore' ),
					'yes'		=> esc_html__( 'Show', 'bw-kidxtore' ),
					'no'		=> esc_html__( 'Hide', 'bw-kidxtore' ),
				],
			]
		);
		$this->add_control(
			'item_excerpt',
			[
				'label' => esc_html__( 'Excerpt', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options'   => [
					''		=> esc_html__( 'Default', 'bw-kidxtore' ),
					'yes'		=> esc_html__( 'Show', 'bw-kidxtore' ),
					'no'		=> esc_html__( 'Hide', 'bw-kidxtore' ),
				],
			]
		);
		$this->add_control(
			'excerpt',
			[
				'label' => esc_html__( 'Number of text for excerpt', 'bw-kidxtore' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 999,
				'step' => 1,
				'default' => 80,
				'condition' => [
					'item_excerpt' => 'yes',
				]
			]
		);
		$this->add_control(
			'item_countdown',
			[
				'label' => esc_html__( 'Show countdown timer', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options'   => [
					''		=> esc_html__( 'Default', 'bw-kidxtore' ),
					'yes'		=> esc_html__( 'Show', 'bw-kidxtore' ),
					'no'		=> esc_html__( 'Hide', 'bw-kidxtore' ),
				],
			]
		);
		$this->add_control(
			'item_flash_sale',
			[
				'label' => esc_html__( 'Flash Sale', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options'   => [
					''		=> esc_html__( 'Default', 'bw-kidxtore' ),
					'yes'		=> esc_html__( 'Show', 'bw-kidxtore' ),
					'no'		=> esc_html__( 'Hide', 'bw-kidxtore' ),
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_posts',
			[
				'label' => esc_html__( 'Query', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
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
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' 	=> esc_html__( 'Order by', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'None', 'bw-kidxtore' ),
					'ID'		=> esc_html__( 'ID', 'bw-kidxtore' ),
					'author'	=> esc_html__( 'Author', 'bw-kidxtore' ),
					'title'		=> esc_html__( 'Title', 'bw-kidxtore' ),
					'name'		=> esc_html__( 'Name', 'bw-kidxtore' ),
					'date'		=> esc_html__( 'Date', 'bw-kidxtore' ),
					'modified'		=> esc_html__( 'Last Modified Date', 'bw-kidxtore' ),
					'parent'		=> esc_html__( 'Parent', 'bw-kidxtore' ),
					'post_views'		=> esc_html__( 'Post views', 'bw-kidxtore' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' 	=> esc_html__( 'Order', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'DESC',
				'options'   => [
					'DESC'		=> esc_html__( 'DESC', 'bw-kidxtore' ),
					'ASC'		=> esc_html__( 'ASC', 'bw-kidxtore' ),
				],
			]
		);

		$this->add_control(
			'product_type',
			[
				'label' 	=> esc_html__( 'Product type', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					'' 				=> esc_html__('Default','bw-kidxtore'),
                    'trending' 		=> esc_html__('Trending','bw-kidxtore'),
                    'featured' 		=> esc_html__('Featured Products','bw-kidxtore'),
                    'bestsell' 		=> esc_html__('Best Sellers','bw-kidxtore'),
                    'onsale' 		=> esc_html__('On Sale','bw-kidxtore'),
                    'toprate' 		=> esc_html__('Top Rate','bw-kidxtore'),
                    'mostview' 		=> esc_html__('Most View','bw-kidxtore'),
                    'menu_order' 	=> esc_html__('Menu Order','bw-kidxtore'),
                    'flash_sale' 	=> esc_html__('Flash Sale','bw-kidxtore'),
				],
			]
		);

		$this->add_control(
			'custom_ids', 
			[
				'label' => esc_html__( 'Show by IDs', 'bw-kidxtore' ),
				'description' => esc_html__( 'Enter IDs list. The values separated by ",". Example 11,12', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '11,12', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			'cats', 
			[
				'label' => esc_html__( 'Categories', 'bw-kidxtore' ),
				'description' => esc_html__( 'Enter slug categories. The values separated by ",". Example cat-1,cat-2. Default will show all categories', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'cat-1,cat-2', 'bw-kidxtore' ),
			]
		);

		

		$this->end_controls_section();

		$this->start_controls_section(
			'section_list_setting',
			[
				'label' => esc_html__( 'List setting', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'display' => ['elbzotech-product-grid','elbzotech-product-list'],
				]
			]
		);
		$this->add_control(
			'item_list_style',
			[
				'label' 	=> esc_html__( 'Item List Style', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'Style 1 - default', 'bw-kidxtore' ),
				],
			]
		);
		$this->add_control(
			'excerpt_list',
			[
				'label' => esc_html__( 'Excerpt list', 'bw-kidxtore' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 1000,
				'step' => 1,
			]
		);

		$this->add_responsive_control(
			'item_list_thumb_width',
			[
				'label' => esc_html__( 'Thumbnail Width', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' , 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 0.01,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .list-thumb-wrap' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .list-info-wrap' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_list', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'custom',
				'separator' => 'none',
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_grid',
			[
				'label' => esc_html__( 'Grid Setting', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'display' => ['elbzotech-product-grid','elbzotech-product-list'],
				]
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
						'max' => 8,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'condition' => [
					'column_custom' => '',
				]
			]
		); 
		$this->add_control(
			'column_custom',
			[
				'label' => esc_html__( 'Column custom by display', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'description'	=> esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:1,375:2,991:3,1170:4', 'bw-kidxtore' ),
				'default' => '',
				
			]
		);
		$this->add_control(
			'grid_type',
			[
				'label' 	=> esc_html__( 'Grid type', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''				=> esc_html__( 'Default', 'bw-kidxtore' ),
					'grid-masonry'	=> esc_html__( 'Masonry', 'bw-kidxtore' ),
				],
			]
		);

		$this->add_control(
			'pagination',
			[
				'label' 	=> esc_html__( 'Grid pagination', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''				=> esc_html__( 'None', 'bw-kidxtore' ),
					'pagination'	=> esc_html__( 'Pagination', 'bw-kidxtore' ),
					'load-more'		=> esc_html__( 'Load more', 'bw-kidxtore' ),
				],
			]
		);

		$this->end_controls_section();

		$this->get_slider_settings();
		$this->get_slider_masory_settings();
		$this->start_controls_section(
			'section_top_filter',
			[
				'label' => esc_html__( 'Top filter', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'display' => ['elbzotech-product-list', 'elbzotech-product-grid'],
				]
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

		$this->start_controls_section(
			'section_tab',
			[
				'label' => esc_html__( 'Tab', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'display_tab!' => '',
				]
			]
		);
		$this->add_control(
			'title_tab_product', 
			[
				'label' => esc_html__( 'Title Tab', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Dont miss this weeks sales', 'bw-kidxtore' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Tab Title' , 'bw-kidxtore' ),
				'label_block' => true,
			]
		);

		$repeater->add_control( 
			'icon',
			[
				'label' => esc_html__( 'Icon', 'bw-kidxtore' ),
				'type' => Controls_Manager::ICONS,
				'condition' => [
					'icon_image[url]' =>  '',
				]
			]
		);
		$repeater->add_control(
			'icon_image',
			[
				'label' => esc_html__( 'Icon image', 'bw-kidxtore' ),
				'description'	=> esc_html__( 'You can choose the icon image here (Replace for icon)', 'bw-kidxtore' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'icon[value]' =>  '',
				]
			]
		);
		$repeater->add_control(
			'icon_image_hover',
			[
				'label' => esc_html__( 'Icon image hover', 'bw-kidxtore' ),
				'description'	=> esc_html__( 'You can choose the icon image here (Replace for icon)', 'bw-kidxtore' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'icon_image[url]!' =>  '',
				]
			]
		);

		$repeater->add_control(
			'icon_pos',
			[
				'label' => esc_html__( 'Icon position', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after-icon',
				'options' => [
					'after-text'   => esc_html__( 'After text', 'bw-kidxtore' ),
					'before-text'  => esc_html__( 'Before text', 'bw-kidxtore' ),
				],
			]
		);

		$repeater->add_control(
			'number',
			[
				'label' => esc_html__( 'Number', 'bw-kidxtore' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000,
				'step' => 1,
			]
		);

		$repeater->add_control(
			'orderby',
			[
				'label' 	=> esc_html__( 'Order by', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'None', 'bw-kidxtore' ),
					'ID'		=> esc_html__( 'ID', 'bw-kidxtore' ),
					'author'	=> esc_html__( 'Author', 'bw-kidxtore' ),
					'title'		=> esc_html__( 'Title', 'bw-kidxtore' ),
					'name'		=> esc_html__( 'Name', 'bw-kidxtore' ),
					'date'		=> esc_html__( 'Date', 'bw-kidxtore' ),
					'modified'		=> esc_html__( 'Last Modified Date', 'bw-kidxtore' ),
					'parent'		=> esc_html__( 'Parent', 'bw-kidxtore' ),
					'post_views'		=> esc_html__( 'Post views', 'bw-kidxtore' ),
				],
			]
		);

		$repeater->add_control(
			'order',
			[
				'label' 	=> esc_html__( 'Order', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'DESC',
				'options'   => [
					'DESC'		=> esc_html__( 'DESC', 'bw-kidxtore' ),
					'ASC'		=> esc_html__( 'ASC', 'bw-kidxtore' ),
				],
			]
		);

		$repeater->add_control(
			'product_type',
			[
				'label' 	=> esc_html__( 'Product type', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'DESC',
				'options'   => [
					'' 				=> esc_html__('Default','bw-kidxtore'),
                    'trending' 		=> esc_html__('Trending','bw-kidxtore'),
                    'featured' 		=> esc_html__('Featured Products','bw-kidxtore'),
                    'bestsell' 		=> esc_html__('Best Sellers','bw-kidxtore'),
                    'onsale' 		=> esc_html__('On Sale','bw-kidxtore'),
                    'toprate' 		=> esc_html__('Top rate','bw-kidxtore'),
                    'mostview' 		=> esc_html__('Most view','bw-kidxtore'),
                    'menu_order' 	=> esc_html__('Menu order','bw-kidxtore'),
                    'flash_sale' 	=> esc_html__('Flash Sale','bw-kidxtore'),
				],
			]
		);

		$repeater->add_control(
			'custom_ids', 
			[
				'label' => esc_html__( 'Show by IDs', 'bw-kidxtore' ),
				'description' => esc_html__( 'Enter IDs list. The values separated by ",". Example 11,12', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '11,12', 'bw-kidxtore' ),
			]
		);

		$repeater->add_control(
			'cats', 
			[
				'label' => esc_html__( 'Categories', 'bw-kidxtore' ),
				'description' => esc_html__( 'Enter slug categories. The values separated by ",". Example cat-1,cat-2. Default will show all categories', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'cat-1,cat-2', 'bw-kidxtore' ),
			]
		);

		

		$repeater->add_control(
			'title_btn', 
			[
				'label' => esc_html__( 'Title Button', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'View All', 'bw-kidxtore' ),
			]
		);
		$repeater->add_control(
			'link_btn',
			[
				'label' => esc_html__( 'Link Button', 'bw-kidxtore' ),
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
			'tabs',
			[
				'label' => esc_html__( 'Add tab', 'bw-kidxtore' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater->get_controls(),
				'default' => [],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
		// END TAB_CONTENT

		// BEGIN TAB_STYLE

		$this->start_controls_section(
			'section_style_item',
			[
				'label' => esc_html__( 'Item', 'bw-kidxtore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_width',
			[
				'label' => esc_html__( 'Width', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' , 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 0.01,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-slider-view .item-product' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .product-grid-view .list-col-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->get_box_settings('item','item-product');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_thumbnail',
			[
				'label' => esc_html__( 'Thumbnail', 'bw-kidxtore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'custom',
				'separator' => 'none',
				'condition' => [
					'item_thumbnail' => 'yes',
					'grid_type!' => 'grid-masonry',
				]
			]
		);
		$this->add_control(
			'size_masonry',
			[
				'label' => esc_html__( 'Random image size', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Random image size mansory type (EX: 300x350,300x300,300x250)', 'bw-kidxtore' ),
				'condition' => [
					'grid_type' => 'grid-masonry',
					'item_thumbnail' => 'yes',
				]
			]
		);
		$this->add_control(
			'size_random_img',
			[
				'label' => esc_html__( 'Random image size', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Random image size mansory type (EX: 300x350,300x300,300x250)', 'bw-kidxtore' ),
				
			]
		);
		$this->get_thumb_styles('thumbnail','product-thumb');

		$this->get_box_image('thumbnail','product-thumb');

		$this->end_controls_section();

		$this->get_slider_styles();

		$this->start_controls_section(
			'section_style_info',
			[
				'label' => esc_html__( 'Info', 'bw-kidxtore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'info_align',
			[
				'label' => esc_html__( 'Alignment', 'bw-kidxtore' ),
				'type' => Controls_Manager::CHOOSE,
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
					'justify' => [
						'title' => esc_html__( 'Justified', 'bw-kidxtore' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .product-info' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->get_box_settings_info('info','product-info');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'bw-kidxtore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'title_line_clamp',
			[
				'label' => esc_html__( 'Line clamp', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-info .product-title' => 'overflow: hidden;display: -webkit-box; -webkit-box-orient: vertical; overflow-wrap: break-word;-webkit-line-clamp: {{SIZE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_min_height',
			[
				'label' => esc_html__( 'Min height', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px','custom' ],
				'range' => [
					'px' => [
						'min' => 0,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-info .product-title' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->get_text_styles('title','product-info .product-title a');

		$this->add_responsive_control(
			'title_space',
			[
				'label' => esc_html__( 'Space', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-info .product-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_price',
			[
				'label' => esc_html__( 'Price', 'bw-kidxtore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'price_regular',
			[
				'label' => esc_html__( 'Regular', 'bw-kidxtore' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'regular_typography',
				'selectors' => [
					'{{WRAPPER}} .product-price > span',
					'{{WRAPPER}} .product-price ins',
				]
			]
		);

		$this->add_control(
			'regular_color',
			[
				'label' => esc_html__( 'Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-price > span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .product-price ins' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_sale',
			[
				'label' => esc_html__( 'Sale', 'bw-kidxtore' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sale_typography',
				'selectors' => [
					'{{WRAPPER}} .product-price > del',
				]
			]
		);

		$this->add_control(
			'sale_color',
			[
				'label' => esc_html__( 'Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-price > del' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_price',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_responsive_control(
			'price_space',
			[
				'label' => esc_html__( 'Space', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-info .product-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__( 'Button', 'bw-kidxtore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'item_button' => 'yes',
				]
			]
		);

		$this->get_button_styles('button','addcart-link');

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_tab',
			[
				'label' => esc_html__( 'Tab', 'bw-kidxtore' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_tab' => 'style1',
				]
			]
		); 
		$this->add_control(
			'bg_image_tab',
			[
				'label' => esc_html__( 'Background image', 'bw-kidxtore' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'display_tab' => 'style2',
				]
			]
		);
		$this->add_responsive_control(
			'tab_align',
			[
				'label' => esc_html__( 'Alignment', 'bw-kidxtore' ),
				'type' => Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .nav-tabs' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_item_width',
			[
				'label' => esc_html__( 'Item width', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_item_height',
			[
				'label' => esc_html__( 'Item height', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a',
			]
		);

		$this->add_responsive_control(
			'tab_size_icon',
			[
				'label' => esc_html__( 'Size icon', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_spacing',
			[
				'label' => esc_html__( 'Space', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .product-tab-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'tab_icon_spacing_left',
			[
				'label' => esc_html__( 'Icon Space left', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a i' => 'margin-left: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'tab_icon_spacing_right',
			[
				'label' => esc_html__( 'Icon Space right', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a i' => 'margin-right: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs( 'tab_effects' );

		$this->start_controls_tab( 'tab_normal',
			[
				'label' => esc_html__( 'Normal', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			'tab_color',
			[
				'label' => esc_html__( 'Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_background',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .nav-tabs > li > a',
			]
		);

		$this->add_responsive_control(
			'tab_padding',
			[
				'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_border',
                'label' => esc_html__( 'Border', 'bw-kidxtore' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a',
			]
        );

        $this->add_responsive_control(
			'tab_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_shadow',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_hover',
			[
				'label' => esc_html__( 'Hover', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			'tab_color_hover',
			[
				'label' => esc_html__( 'Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_background_hover',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .nav-tabs > li > a:hover',
			]
		);

		$this->add_responsive_control(
			'tab_padding_hover',
			[
				'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_border_hover',
                'label' => esc_html__( 'Border', 'bw-kidxtore' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a:hover',
			]
        );

        $this->add_responsive_control(
			'tab_radius_hover',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_shadow_hover',
				'selector' => '{{WRAPPER}} .nav-tabs > li > a:hover',
			]
		);

		$this->add_control(
			'tab_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li > a' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_active',
			[
				'label' => esc_html__( 'Active', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			'tab_color_active',
			[
				'label' => esc_html__( 'Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li.active > a' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tab_background_active',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .nav-tabs > li.active > a',
			]
		);

		$this->add_responsive_control(
			'tab_padding_active',
			[
				'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
					'{{WRAPPER}} .nav-tabs > li.active > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_border_active',
                'label' => esc_html__( 'Border', 'bw-kidxtore' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .nav-tabs > li.active > a',
			]
        );

        $this->add_responsive_control(
			'tab_radius_active',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .nav-tabs > li.active > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_shadow_active',
				'selector' => '{{WRAPPER}} .nav-tabs > li.active > a',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// END TAB_STYLE
	}

	public function get_button_styles($key='button', $class="btn-class") {

		$this->add_control(
			$key.'_text', 
			[
				'label' => esc_html__( 'Text', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
			]
		);

		$this->add_responsive_control(
			$key.'_align',
			[
				'label' => esc_html__( 'Alignment', 'bw-kidxtore' ),
				'type' => Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .'.$class.'-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $key.'_typography',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->add_control(
			$key.'_icon',
			[
				'label' => esc_html__( 'Icon', 'bw-kidxtore' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$this->add_responsive_control(
			$key.'_size_icon',
			[
				'label' => esc_html__( 'Size icon', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$key.'_icon_pos',
			[
				'label' => esc_html__( 'Icon position', 'bw-kidxtore' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after-icon',
				'options' => [
					'after-text'   => esc_html__( 'After text', 'bw-kidxtore' ),
					'before-text'  => esc_html__( 'Before text', 'bw-kidxtore' ),
				],
				'condition' => [
					$key.'_text!' => '',
					$key.'_icon[value]!' => '',
				]
			]
		);

		$this->add_responsive_control(
			$key.'_spacing',
			[
				'label' => esc_html__( 'Space', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.'-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			$key.'_icon_spacing_left',
			[
				'label' => esc_html__( 'Icon Space left', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' i' => 'margin-left: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			$key.'_icon_spacing_right',
			[
				'label' => esc_html__( 'Icon Space right', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' i' => 'margin-right: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs( $key.'_effects' );

		$this->start_controls_tab( $key.'_normal',
			[
				'label' => esc_html__( 'Normal', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			$key.'_color',
			[
				'label' => esc_html__( 'Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $key.'_background',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->add_responsive_control(
			$key.'_padding',
			[
				'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_shadow',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( $key.'_hover',
			[
				'label' => esc_html__( 'Hover', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			$key.'_color_hover',
			[
				'label' => esc_html__( 'Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $key.'_background_hover',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .'.$class.':hover',
			]
		);

		$this->add_responsive_control(
			$key.'_padding_hover',
			[
				'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_shadow_hover',
				'selector' => '{{WRAPPER}} .'.$class.':hover',
			]
		);

		$this->add_control(
			$key.'_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}
	
	public function get_text_styles($key='text', $class="text-class") {
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $key.'_typography',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->start_controls_tabs( $key.'_effects' );

		$this->start_controls_tab( $key.'_normal',
			[
				'label' => esc_html__( 'Normal', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			$key.'_color',
			[
				'label' => esc_html__( 'Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => $key.'_shadow',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( $key.'_hover',
			[
				'label' => esc_html__( 'Hover', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			$key.'_color_hover',
			[
				'label' => esc_html__( 'Color', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => $key.'_shadow_hover',
				'selector' => '{{WRAPPER}} .'.$class.':hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}

	public function get_thumb_styles($key='thumb', $class="thumb-image") {
		$this->start_controls_tabs( $key.'_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			$key.'_opacity',
			[
				'label' => esc_html__( 'Opacity', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => $key.'_css_filters',
				'selector' => '{{WRAPPER}} .'.$class.' img',
			]
		);

		$this->add_control(
			$key.'_overlay',
			[
				'label' => esc_html__( 'Overlay', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.' .product-thumb-link:before' => 'background-color: {{VALUE}}; opacity: 1; visibility: visible;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'bw-kidxtore' ),
			]
		);

		$this->add_control(
			$key.'_opacity_hover',
			[
				'label' => esc_html__( 'Opacity', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => $key.'_css_filters_hover',
				'selector' => '{{WRAPPER}} .'.$class.':hover img',
			]
		);

		$this->add_control(
			$key.'_overlay_hover',
			[
				'label' => esc_html__( 'Overlay', 'bw-kidxtore' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .'.$class.':hover .product-thumb-link:before' => 'background-color: {{VALUE}}; opacity: 1; visibility: visible;',
				],
			]
		);

		$this->add_control(
			$key.'_background_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' img' => 'transition-duration: {{SIZE}}s',
					'{{WRAPPER}} .'.$class.' .product-thumb-link::after' => 'transition-duration: {{SIZE}}s',
					'{{WRAPPER}} .'.$class.' .product-thumb-link' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			$key.'_hover_animation',
			[
				'label' 	=> esc_html__( 'Hover Animation', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'elbzotech-post-grid',
				'options'   => [
					''					=> esc_html__( 'None', 'bw-kidxtore' ),
					'zoom-thumb'		=> esc_html__( 'Zoom', 'bw-kidxtore' ),
					'rotate-thumb'		=> esc_html__( 'Rotate', 'bw-kidxtore' ),
					'zoomout-thumb'		=> esc_html__( 'Zoom Out', 'bw-kidxtore'),
					'translate-thumb'	=> esc_html__( 'Translate', 'bw-kidxtore'),
					'slider-thumb'	=> esc_html__( 'Slider', 'bw-kidxtore'),
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}
	public function get_slider_masory_settings() {
		$this->start_controls_section(
			'section_slider_masory',
			[
				'label' => esc_html__( 'Masory settings', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				
			]
		);

		$this->add_control(
			'slider_items_group',
			[
				'label' => esc_html__( 'Group item products', 'bw-kidxtore' ),
				'type' => Controls_Manager::NUMBER,
				'description'	=> esc_html__( 'Group the number of products into 1  item of slider', 'bw-kidxtore' ),
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 1,
				'condition' => [
					'display' => ['elbzotech-product-slider-masory'],
				]
			]
		);
		$this->add_control(
			'column_custom_masory',
			[
				'label' => esc_html__( 'Column custom by display', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'description'	=> esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:1,375:2,991:3,1170:4', 'bw-kidxtore' ),
				'default' => '',
				'condition' => [
					'display' => ['elbzotech-product-grid-masory'],
				]
			]
		);
		$this->add_responsive_control(
			'space_item',
			[
				'label' => esc_html__( 'Space item (px)', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .width_masory' => 'padding: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .list-product-wrap' => 'margin: -{{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'display' => ['elbzotech-product-slider-masory','elbzotech-product-grid-masory'],
				]
			]
		);
		$repeater_masory = new Repeater();

		$repeater_masory->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%','px','vw' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater_masory->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'custom',
				'separator' => 'none',
			]
		);
		$default_template = [
					'style1'		=> esc_html__( 'Style 1 (Replace)', 'bw-kidxtore' ),
					'style2'		=> esc_html__( 'Style 2 (Replace)', 'bw-kidxtore' ),
					'style3'		=> esc_html__( 'Style 3 (Replace)', 'bw-kidxtore' ),
					'style5'		=> esc_html__( 'Style 5 (Replace)', 'bw-kidxtore' ),
				];
		$repeater_masory->add_control(
			'template',
			[
				'label' 	=> esc_html__( 'Replace style or Insert template', 'bw-kidxtore' ),
				'description'	=> esc_html__( 'Replace the display style or insert content in the template', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => bzotech_list_post_type('elementor_library',true,$default_template),
			]
		);
		$repeater_masory->add_control(
			'add_class_css', 
			[
				'label' => esc_html__( 'Add class CSS', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter name class' , 'bw-kidxtore' ),
			]
		);
		$this->add_control(
			'list_grid_custom',
			[
				'label' => esc_html__( 'Add layout masory', 'bw-kidxtore' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty'=>false,
				'fields' => $repeater_masory->get_controls(),
				'condition' => [
					'display' => ['elbzotech-product-slider-masory','elbzotech-product-grid-masory'],
				]
			]
		);

		$this->end_controls_section();
	}
	public function get_slider_settings() {
		$this->start_controls_section(
			'section_slider',
			[
				'label' => esc_html__( 'Slider', 'bw-kidxtore' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'display' => ['elbzotech-product-slider','elbzotech-product-slider-masory'],
				]
			]
		);

		$this->add_responsive_control(
			'slider_items',
			[
				'label' => esc_html__( 'Items', 'bw-kidxtore' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'slider_auto' => '',
					'slider_items_custom' => '',
				]
			]
		);
		$this->add_control(
			'slider_items_custom',
			[
				'label' => esc_html__( 'Items custom by display', 'bw-kidxtore' ),
				'type' => Controls_Manager::TEXT,
				'description'	=> esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:1,375:2,991:3,1170:4', 'bw-kidxtore' ),
				'default' => '',
				'condition' => [
					'slider_auto' => '',
				]
			]
		);

		$this->add_responsive_control(
			'slider_space',
			[
				'label' => esc_html__( 'Space(px)', 'bw-kidxtore' ),
				'description'	=> esc_html__( 'For example: 20', 'bw-kidxtore' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'default' => 0
			]
		);

		$this->add_control(
			'slider_column',
			[
				'label' => esc_html__( 'Columns', 'bw-kidxtore' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label' => esc_html__( 'Speed(ms)', 'bw-kidxtore' ),
				'description'	=> esc_html__( 'For example: 3000 or 5000', 'bw-kidxtore' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 3000,
				'max' => 10000,
				'step' => 100,
			]
		);		

		$this->add_control(
			'slider_auto',
			[
				'label' => esc_html__( 'Auto width', 'bw-kidxtore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-kidxtore' ),
				'label_off' => esc_html__( 'Off', 'bw-kidxtore' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_center',
			[
				'label' => esc_html__( 'Center', 'bw-kidxtore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-kidxtore' ),
				'label_off' => esc_html__( 'Off', 'bw-kidxtore' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_loop',
			[
				'label' => esc_html__( 'Loop', 'bw-kidxtore' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'bw-kidxtore' ),
				'label_off' => esc_html__( 'Off', 'bw-kidxtore' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slider_navigation',
			[
				'label' 	=> esc_html__( 'Navigation', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'None', 'bw-kidxtore' ),
					'style1'		=> esc_html__( 'Style 1', 'bw-kidxtore' ),
					'group'		=> esc_html__( 'Style 2 (Group)', 'bw-kidxtore' ),
					'group2'		=> esc_html__( 'Style 3 (Group bottom)', 'bw-kidxtore' ),
					'yes'		=> esc_html__( 'Default custom', 'bw-kidxtore' ),
				],
			]
		);
		$this->add_control(
			'slider_pagination',
			[
				'label' 	=> esc_html__( 'Pagination', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'None', 'bw-kidxtore' ),
					'style1'		=> esc_html__( 'Style 1 (Square)', 'bw-kidxtore' ),
					'style2'		=> esc_html__( 'style 2 (Round)', 'bw-kidxtore' ),
					'style3'		=> esc_html__( 'style 3 (Line)', 'bw-kidxtore' ),
					'number'		=> esc_html__( 'style 4 (Number)', 'bw-kidxtore' ),
					'yes'		=> esc_html__( 'Default custom', 'bw-kidxtore' ),
				],
			]
		);
		$this->add_control(
			'slider_scrollbar',
			[
				'label' 	=> esc_html__( 'Scrollbar', 'bw-kidxtore' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''		=> esc_html__( 'None', 'bw-kidxtore' ),
					'yes'		=> esc_html__( 'Default custom', 'bw-kidxtore' ),
				],
			]
		);
		$this->end_controls_section();
	}

	public function get_box_image($key='box-key',$class="box-class") {
		$this->add_responsive_control(
			$key.'_padding',
			[
				'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
        );

        $this->add_responsive_control(
			$key.'_margin',
			[
				'label' => esc_html__( 'Margin', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => $key.'_border',
				'selectors' => [
					'{{WRAPPER}} .'.$class.' .product-thumb-link',
					'{{WRAPPER}} .'.$class.' .product-thumb-link::before',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			$key.'_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class.' .product-thumb-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .'.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .'.$class.' .product-thumb-link',
			]
		);
	}

	public function get_box_settings($key='box-key',$class="box-class") {

		$this->add_responsive_control(
			$key.'_padding_wrap',
			[
				'label' => esc_html__( 'Padding Column', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .list-col-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};margin-bottom:0px;',
					'{{WRAPPER}} .list-product-wrap' => 'margin: -{{TOP}}{{UNIT}} -{{RIGHT}}{{UNIT}} -{{BOTTOM}}{{UNIT}} -{{LEFT}}{{UNIT}};clear: both;',
				],
			]
        );

		$this->add_responsive_control(
			$key.'_padding',
			[
				'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_responsive_control(
			$key.'_margin',
			[
				'label' => esc_html__( 'Margin', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $key.'_background',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .'.$class,
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => $key.'_border',
                'label' => esc_html__( 'Border', 'bw-kidxtore' ),
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .'.$class,
			]
        );

        $this->add_responsive_control(
			$key.'_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .'.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $key.'_shadow',
				'selector' => '{{WRAPPER}} .'.$class,
			]
		);
	}
	public function get_box_settings_info($key='box-key',$class="box-class") {

			$this->add_responsive_control(
				$key.'_padding',
				[
					'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
					'type' => Controls_Manager::DIMENSIONS,
	                'size_units' => [ 'px', ],
					'selectors' => [
						'{{WRAPPER}} .'.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
	        );

	        $this->add_responsive_control(
				$key.'_margin',
				[
					'label' => esc_html__( 'Margin', 'bw-kidxtore' ),
					'type' => Controls_Manager::DIMENSIONS,
	                'size_units' => [ 'px', ],
					'selectors' => [
						'{{WRAPPER}} .'.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
	        );

	        $this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => $key.'_background',
					'label' => esc_html__( 'Background', 'bw-kidxtore' ),
					'types' => [ 'classic' ],
					'selector' => '{{WRAPPER}} .'.$class,
				]
	        );

	        $this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => $key.'_border',
	                'label' => esc_html__( 'Border', 'bw-kidxtore' ),
	                'separator' => 'before',
					'selector' => '{{WRAPPER}} .'.$class,
				]
	        );

	        $this->add_responsive_control(
				$key.'_radius',
				[
					'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .'.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => $key.'_shadow',
					'selector' => '{{WRAPPER}} .'.$class,
				]
			);
		}

	public function get_slider_styles() {
		$this->start_controls_section(
			'section_style_slider_nav',
			[
				'label' => esc_html__( 'Slider Navigation', 'bw-kidxtore' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'display' => ['elbzotech-product-slider','elbzotech-product-slider-masory'],
					'slider_navigation!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'width_slider_nav',
			[
				'label' => esc_html__( 'Width', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height_slider_nav',
			[
				'label' => esc_html__( 'Height', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .swiper-button-nav i' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding_slider_nav',
			[
				'label' => esc_html__( 'Padding', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin_slider_nav',
			[
				'label' => esc_html__( 'Margin', 'bw-kidxtore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'slider_nav_effects' );

		$this->start_controls_tab( 'slider_nav_normal',
			[
				'label' => esc_html__( 'Normal', 'bw-kidxtore' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_nav',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-button-nav',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_slider_nav',
				'selector' => '{{WRAPPER}} .swiper-button-nav',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_slider_nav',
				'selector' => '{{WRAPPER}} .swiper-button-nav',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius_slider_nav',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'slider_nav_hover',
			[
				'label' => esc_html__( 'Hover', 'bw-kidxtore' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_nav_hover',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-button-nav:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_slider_nav_hover',
				'selector' => '{{WRAPPER}} .swiper-button-nav:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_slider_nav_hover',
				'selector' => '{{WRAPPER}} .swiper-button-nav:hover',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius_slider_nav_hover',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();	

		$this->add_control(
			'separator_slider_nav',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'slider_icon_next',
			[
				'label' => esc_html__( 'Icon next', 'bw-kidxtore' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'las la-angle-right',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'slider_icon_prev',
			[
				'label' => esc_html__( 'Icon prev', 'bw-kidxtore' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'las la-angle-left',
					'library' => 'solid',
				],
			]
		);

		$this->add_responsive_control(
			'slider_icon_size',
			[
				'label' => esc_html__( 'Size icon', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-nav i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_nav_space',
			[
				'label' => esc_html__( 'Space', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_slider_pag',
			[
				'label' => esc_html__( 'Slider Pagination', 'bw-kidxtore' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'display' =>  ['elbzotech-product-slider','elbzotech-product-slider-masory'],
					'slider_pagination!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'width_slider_pag',
			[
				'label' => esc_html__( 'Width', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination span' => 'width: {{SIZE}}{{UNIT}};',
				], 
			]
		);

		$this->add_responsive_control(
			'height_slider_pag',
			[
				'label' => esc_html__( 'Height', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination span' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_bg_normal',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'background_pag_heading',
			[
				'label' => esc_html__( 'Normal', 'bw-kidxtore' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_pag',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-pagination span',
			]
		);

		$this->add_control(
			'opacity_pag',
			[
				'label' => esc_html__( 'Opacity', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination span' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'separator_bg_active',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'background_pag_heading_active',
			[
				'label' => esc_html__( 'Active', 'bw-kidxtore' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_slider_pag_active',
				'label' => esc_html__( 'Background', 'bw-kidxtore' ),
				'description'	=> esc_html__( 'Active status', 'bw-kidxtore' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .swiper-pagination span.swiper-pagination-bullet-active',
			]
		);

		$this->add_control(
			'opacity_pag_active',
			[
				'label' => esc_html__( 'Opacity', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination span.swiper-pagination-bullet-active' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'separator_shadow',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'shadow_slider_pag',
				'selector' => '{{WRAPPER}} .swiper-pagination span',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_slider_pag',
				'selector' => '{{WRAPPER}} .swiper-pagination span',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius_slider_pag',
			[
				'label' => esc_html__( 'Border Radius', 'bw-kidxtore' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_pag_space',
			[
				'label' => esc_html__( 'Space', 'bw-kidxtore' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

}