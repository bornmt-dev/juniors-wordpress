<?php 
add_action( 'wp_ajax_juniors_location_checker', 'juniors_location_checker_callback' );
add_action( 'wp_ajax_nopriv_juniors_location_checker', 'juniors_location_checker_callback' );
function juniors_location_checker_callback() {
    
    if ( isset( $_POST['selectedShipping'] ) ) {
        WC()->session->set('location_id', 397);
        wp_send_json_success( $data = ["succes"] );
    }

}

add_action( 'wp_ajax_custom_check_stock', 'custom_check_stock_callback' );
add_action( 'wp_ajax_nopriv_custom_check_stock', 'custom_check_stock_callback' );

function custom_check_stock_callback() {
    if ( ! isset( $_POST['action'] ) ) {
        if ( $_POST['action'] !=  "custom_check_stock" ) {
            wp_send_json_error( [ 'message' => 'Missing location ID' ] );
        }
    }

    if ( isset( $_POST['selectedShipping'] ) ) {
        if ( $_POST['selectedShipping'] ==  "Online" ) {
            WC()->session->set('location_id', 397);
        }
    }
 
    $location_id = intval( $_POST['location_id'] );
    WC()->session->set('location_id', $location_id);
   
    $data = [];
    $is_available = true;

    $thresholds = get_option('born_wc_stock_thresholds', []);
    $out_max = (int) ($thresholds['out_max'] ?? 2);

    if ( WC()->cart && ! WC()->cart->is_empty() ) {
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $product        = $cart_item['data']; // FIX: define $product first
            $product_id     = $product->get_id();
            $product_name     = $product->get_name();
            $selected_qty   = $cart_item['quantity'];
            $product_image = wp_get_attachment_image_url( $product->get_image_id(), 'thumbnail' );

            $current_qty = (int)get_post_meta($product_id, '_stock_at_'.$location_id, true) - $out_max;
 
            if (!$current_qty) {
                $current_qty = 0;
            }

            if ( $selected_qty <= $current_qty) {
                $is_available = false;
                continue;
            }
            else {
                $data[] = [
                    "product_id"    => $product_id,
                    "product_name"    => $product_name,
                    "product_image"    => $product_image,
                    "selected_qty"  => $selected_qty,
                    "current_qty"  => $current_qty
                ];
            }

        }
    }

    if (!$is_available) {
        WC()->session->set('is_stocks_available', 0);
    }
    else {
        WC()->session->set('is_stocks_available', 1);
    }

    wp_send_json_success( $data );

}

function custom_enqueue_cart_scripts() {

    if ( !is_front_page() ) { 
        wp_enqueue_script(
            'custom-clc-ajax-js',
            get_stylesheet_directory_uri() . '/assets/ajax/location-stock-check.js',
            array('jquery'),
            time(), // changing version disables caching
            true
        );
        

        wp_localize_script(
            'custom-clc-ajax-js',
            'custom_clc_params',
            array(
                'ajax_url' => admin_url('admin-ajax.php')
            )
        );
    }

}
add_action('wp_enqueue_scripts', 'custom_enqueue_cart_scripts');


function is_available_online_shipping () {

    $thresholds = get_option('born_wc_stock_thresholds', []);
    $out_max = (int) ($thresholds['out_max'] ?? 2);

    $location_id = 397;  // San Gwann Location
    $return = true;
    if ( WC()->cart && ! WC()->cart->is_empty() ) {
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $product        = $cart_item['data']; 
            $product_id     = $product->get_id();
            $selected_qty   = $cart_item['quantity']; 

      
            $current_qty = (int)get_post_meta($product_id, '_stock_at_'.$location_id, true) - $out_max;

            if (!$current_qty) {
                $current_qty = 0;
            }

            if ( $selected_qty <= $current_qty) {
                continue;
            }
            else {
                $return = false;
            }
        }
    }
    return $return;
}