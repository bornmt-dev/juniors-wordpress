<?php 
add_action('woocommerce_checkout_create_order', 'custom_modify_order_before_save', 20, 2);
function custom_modify_order_before_save($order, $data) {
    $location_id = WC()->session->get('location_id');
    if (empty($location_id)) {
        $location_id = 397;
    }
    $order->update_meta_data('_custom_location_id', $location_id);
    $order->save();
}

add_action( 'woocommerce_after_checkout_validation', 'juniors_validate_stock_per_location', 10, 2 );
function juniors_validate_stock_per_location( $data, $errors ) {

    // if ( !isset( $_POST['selectedShipping'] ) ) {
    //     if ( $_POST['selectedShipping'] ==  "Online" ) {
    //         WC()->session->set('location_id', 397);
    //     }
    // }
    // error_log(  "juniors_validate_stock_per_location data:: ". print_r($data, true) );
    $location_id = WC()->session->get('location_id');

    if ( empty( $location_id ) ) {
        $errors->add(
            'validation',
            'Please select a store for collection.'
        );
        // error_log("Please select a store for collection.");
        return false;
    }
    // Get cart items instead of order (since order isn't created yet)
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $product_id   = $cart_item['product_id'];
        $product_name = $cart_item['data']->get_name();
        $quantity     = $cart_item['quantity'];
        $meta_key = '_stock_at_' . $location_id;
        $current_stock = get_post_meta( $product_id, $meta_key, true );
        $current_stock = $current_stock !== '' ? intval( $current_stock ) : 0;
        if ( $quantity > $current_stock ) {

            $term = get_term($location_id, 'location');
            $location_name = !is_wp_error($term) ? $term->name : $location_id;

            $errors->add(
                'validation',
                'Product "' . $product_name . '" has ' . $current_stock . ' item(s) available in stock. ('. $location_name .')'
            );
            // error_log('Product "' . $product_name . '" has ' . $current_stock . ' item(s) available in stock. ('. $location_name .')');
        }
    }
}

add_action('woocommerce_checkout_create_order_shipping_item', 'add_store_name_to_shipping_line', 20, 4);
function add_store_name_to_shipping_line($item, $package_key, $package, $order) {
    // Get the selected shipping method ID for this package
    $selected_method_id = isset($_POST['shipping_method'][$package_key]) ? sanitize_text_field($_POST['shipping_method'][$package_key]) : '';
    // Default: use the posted location
    // $location_id = !empty($_POST['custom_shipping_location']) ? absint($_POST['custom_shipping_location']) : 0;
    $location_id = WC()->session->get('location_id');
    // Loop through package rates to find the selected one
    if (!empty($package['rates']) && isset($package['rates'][$selected_method_id])) {
        $rate = $package['rates'][$selected_method_id];

        // If the selected method's label is "Online", override location to San Gwann
        if ($rate->get_label() === 'Online') {
            $location_id = 397; // Force to San Gwann only if "Online" is selected
        }
    }
    // Now use the final $location_id to set Store Name
    if ($location_id) {
        $term = get_term($location_id, 'location');
        if (!is_wp_error($term)) {
            $store_name = ucwords(strtolower(str_ireplace('Juniors ', '', $term->name)));
            $item->add_meta_data('Store Name', $store_name, true);
            // Debug log
            if (defined('WP_DEBUG') && WP_DEBUG) {
                // error_log("Store Name set to '{$store_name}' for order #{$order->get_id()} (Location ID: {$location_id})");
            }
        }
    }
}

add_filter('woocommerce_checkout_posted_data', function ($data) {
    if (isset($_POST['custom_shipping_location'])) {
        $data['custom_shipping_location'] = sanitize_text_field($_POST['custom_shipping_location']);
    }
    return $data;
});

add_action('woocommerce_checkout_order_processed', 'update_location_stock_after_order', 20, 3);
function update_location_stock_after_order($order_id, $posted_data, $order) {
    // Default to selected location ID from checkout
    // $location_id = !empty($_POST['custom_shipping_location']) ? absint($_POST['custom_shipping_location']) : 0;
    $location_id = WC()->session->get('location_id');
    // error_log("update_location_stock_after_order() session_location_id: ". $location_id);
    // Check if shipping method is "Online" and override location_id to 397
    foreach ($order->get_shipping_methods() as $shipping_item) {
        if (isset($shipping_item['name']) && $shipping_item['name'] === 'Online') {
            $location_id = 397; // Force to "JUNIORS SAN GWANN"
            break;
        }
    }
    if (!$location_id) {
        return; // No valid location to apply
    }
    // Loop through purchased products
    foreach ($order->get_items('line_item') as $item) {
        $product = $item->get_product();
        if (!$product) continue;
        $product_id = $product->get_id();
        $qty_purchased = $item->get_quantity();
        // Build the meta key for the location-specific stock
        $meta_key = '_stock_at_' . $location_id;
        // Get current stock at this location
        $current_stock = get_post_meta($product_id, $meta_key, true);
        $current_stock = $current_stock !== '' ? intval($current_stock) : 0;
        // Decrease stock by quantity purchased
        $new_stock = max(0, $current_stock - $qty_purchased);
        // Update the stock
        update_post_meta($product_id, $meta_key, $new_stock);
    }
}

add_action('woocommerce_admin_order_data_after_shipping_address', 'display_location_in_admin_order_page', 10, 1);
function display_location_in_admin_order_page($order) {
    // Get the location ID saved in order meta
    $location_id = $order->get_meta('_custom_location_id');
    if ($location_id) {
        // Get the location name based on the location ID
        $term = get_term($location_id, 'location');
        if (!is_wp_error($term)) {
            $location_name = $term->name;
        } else {
            $location_name = 'Juniors Toyshop';
        }
        echo '<p><strong>' . __('Store Location', 'your-text-domain') . ':</strong> ' . esc_html($location_name) . '</p>';
    }
}


// START WRAPPING PAPER FEATURE
// Add submenu under WooCommerce
add_action('admin_menu', function () {
    add_submenu_page(
        'woocommerce',
        'Wrapping Paper Settings',
        'Wrapping Paper',
        'manage_woocommerce',
        'wc-juniours-wrapping-paper',
        'render_born_wc_juniors_wrapping_paper_page'
    );
});

// Register the setting
add_action('admin_init', function () {
    register_setting('wc_juniours_wrapping_paper_group', 'wc_juniours_enable_gift_wrap');

    add_settings_section(
        'wc_juniours_wrapping_paper_section',
        'Gift Wrapping Options',
        '__return_false', // no callback for section description
        'wc-juniours-wrapping-paper'
    );

    add_settings_field(
        'wc_juniours_enable_gift_wrap',
        'Enable Gift Wrapping',
        function () {
            $enabled = get_option('wc_juniours_enable_gift_wrap', 'no');
            ?>
            <label>
                <input type="checkbox" name="wc_juniours_enable_gift_wrap" value="yes" <?php checked($enabled, 'yes'); ?> />
                Allow customers to add gift wrapping to their orders
            </label>
            <?php
        },
        'wc-juniours-wrapping-paper',
        'wc_juniours_wrapping_paper_section'
    );
});

// Render the settings page
function render_born_wc_juniors_wrapping_paper_page() {
    ?>
    <div class="wrap woocommerce">
        <h1>Wrapping Paper Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('wc_juniours_wrapping_paper_group');
            do_settings_sections('wc-juniours-wrapping-paper');
            submit_button('Save Changes');
            ?>
        </form>
    </div>
    <?php
}


// ===============================
// ONLINE SHIPPING SETTINGS PAGE
// ===============================

//   Add submenu under WooCommerce
add_action('admin_menu', function () {
    add_submenu_page(
        'woocommerce',
        'Online Shipping Settings',
        'Online Shipping',
        'manage_woocommerce',
        'wc-online-shipping',
        'render_wc_online_shipping_page'
    );
});

//  Register settings
add_action('admin_init', function () {
    // Register all options
    register_setting('wc_online_shipping_group', 'wc_online_shipping_low_max');
    register_setting('wc_online_shipping_group', 'wc_online_shipping_low_cost');
    register_setting('wc_online_shipping_group', 'wc_online_shipping_mid_min');
    register_setting('wc_online_shipping_group', 'wc_online_shipping_mid_max');
    register_setting('wc_online_shipping_group', 'wc_online_shipping_mid_cost');
    register_setting('wc_online_shipping_group', 'wc_online_shipping_free_min');

    add_settings_section(
        'wc_online_shipping_section',
        'Online Shipping Rules',
        '__return_false',
        'wc-online-shipping'
    );

    // Field: Low Range Max
    add_settings_field(
        'wc_online_shipping_low_max',
        'Low Range: Max Amount (€)',
        function () {
            $val = get_option('wc_online_shipping_low_max', '19.99');
            echo '<input type="number" step="0.01" min="0" name="wc_online_shipping_low_max" value="' . esc_attr($val) . '" class="small-text" />';
            echo '<p class="description">Orders up to this amount will cost the low rate.</p>';
        },
        'wc-online-shipping',
        'wc_online_shipping_section'
    );

    // Field: Low Range Cost
    add_settings_field(
        'wc_online_shipping_low_cost',
        'Low Range: Shipping Cost (€)',
        function () {
            $val = get_option('wc_online_shipping_low_cost', '5');
            echo '<input type="number" step="0.01" min="0" name="wc_online_shipping_low_cost" value="' . esc_attr($val) . '" class="small-text" />';
            echo '<p class="description">Shipping cost for orders up to the low max amount.</p>';
        },
        'wc-online-shipping',
        'wc_online_shipping_section'
    );

    // Field: Mid Range Min
    add_settings_field(
        'wc_online_shipping_mid_min',
        'Mid Range: Min Amount (€)',
        function () {
            $val = get_option('wc_online_shipping_mid_min', '20');
            echo '<input type="number" step="0.01" min="0" name="wc_online_shipping_mid_min" value="' . esc_attr($val) . '" class="small-text" />';
            echo '<p class="description">Orders starting from this value use the mid range cost.</p>';
        },
        'wc-online-shipping',
        'wc_online_shipping_section'
    );

    // Field: Mid Range Max
    add_settings_field(
        'wc_online_shipping_mid_max',
        'Mid Range: Max Amount (€)',
        function () {
            $val = get_option('wc_online_shipping_mid_max', '44.99');
            echo '<input type="number" step="0.01" min="0" name="wc_online_shipping_mid_max" value="' . esc_attr($val) . '" class="small-text" />';
            echo '<p class="description">Upper limit for mid-range shipping.</p>';
        },
        'wc-online-shipping',
        'wc_online_shipping_section'
    );

    // Field: Mid Range Cost
    add_settings_field(
        'wc_online_shipping_mid_cost',
        'Mid Range: Shipping Cost (€)',
        function () {
            $val = get_option('wc_online_shipping_mid_cost', '3');
            echo '<input type="number" step="0.01" min="0" name="wc_online_shipping_mid_cost" value="' . esc_attr($val) . '" class="small-text" />';
            echo '<p class="description">Shipping cost for orders between mid min and mid max.</p>';
        },
        'wc-online-shipping',
        'wc_online_shipping_section'
    );

    // Field: Free Shipping Threshold
    add_settings_field(
        'wc_online_shipping_free_min',
        'Free Shipping Threshold (€)',
        function () {
            $val = get_option('wc_online_shipping_free_min', '45');
            echo '<input type="number" step="0.01" min="0" name="wc_online_shipping_free_min" value="' . esc_attr($val) . '" class="small-text" />';
            echo '<p class="description">Orders equal or above this amount get free shipping.</p>';
        },
        'wc-online-shipping',
        'wc_online_shipping_section'
    );
});

//  Render the settings page
function render_wc_online_shipping_page() {
    ?>
    <div class="wrap woocommerce">
        <h1>Online Shipping Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('wc_online_shipping_group');
            do_settings_sections('wc-online-shipping');
            submit_button('Save Changes');
            ?>
        </form>
    </div>
    <?php
}

// Apply dynamic rates using the saved settings
add_filter('woocommerce_package_rates', function ($rates, $package) {
    $cart_total = WC()->cart->get_subtotal();

    $low_max  = (float) get_option('wc_online_shipping_low_max', 19.99);
    $low_cost = (float) get_option('wc_online_shipping_low_cost', 5);
    $mid_min  = (float) get_option('wc_online_shipping_mid_min', 20);
    $mid_max  = (float) get_option('wc_online_shipping_mid_max', 44.99);
    $mid_cost = (float) get_option('wc_online_shipping_mid_cost', 3);
    $free_min = (float) get_option('wc_online_shipping_free_min', 45);

    foreach ($rates as $key => $rate) {
        if ('Online' === $rate->get_label()) {
            if ($cart_total <= $low_max) {
                $rates[$key]->cost = $low_cost;
            } elseif ($cart_total >= $mid_min && $cart_total <= $mid_max) {
                $rates[$key]->cost = $mid_cost;
            } elseif ($cart_total >= $free_min) {
                $rates[$key]->cost = 0;
            }
        }
    }

    return $rates;
}, 20, 2);

//  Keep label clean
add_filter('woocommerce_cart_shipping_method_full_label', function ($label, $method) {
    return $method->get_label() === 'Online' ? 'Online' : $label;
}, 10, 2);

//  Add a visible "Shipping Fee" line in totals
add_action('woocommerce_review_order_before_order_total', function () {
    $packages = WC()->shipping->get_packages();
    foreach ($packages as $package) {
        $chosen_method = isset($package['rates'][WC()->session->chosen_shipping_methods[0]]) ? $package['rates'][WC()->session->chosen_shipping_methods[0]] : false;
        if ($chosen_method && $chosen_method->get_label() === 'Online') {
            $shipping_cost = wc_price($chosen_method->get_cost());
            echo '<tr class="shipping-cost"><th>Shipping Fee</th><td>' . ($chosen_method->get_cost() > 0 ? $shipping_cost : 'Free') . '</td></tr>';
        }
    }
});



// ===============================================
// SHOW SHIPPING FEE IN CUSTOMER + ADMIN EMAILS
// ===============================================
add_filter('woocommerce_get_order_item_totals', function ($total_rows, $order, $tax_display) {

    if ($shipping_method === 'Online') {
        if ($shipping_total > 0) {
            $fee_text = wc_price($shipping_total);
        } else {
            $fee_text = __('Free', 'woocommerce');
        }

        $total_rows['shipping']['value'] = esc_html($shipping_method) . ' (' . $fee_text . ')';
    }
    
    return $total_rows;
}, 10, 3);


 
// ===============================================
// MULTIPLE WRAPPING PAPER
// ===============================================

/**
 *  Validate wrapping quantity before checkout
 */
add_action( 'woocommerce_checkout_process', function() {
	if ( isset( $_POST['juniors_gift_wrap'] ) && is_array( $_POST['juniors_gift_wrap'] ) ) {
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$product_name = $cart_item['data']->get_name();
			$product_qty  = absint( $cart_item['quantity'] );
			$wrap_qty     = isset( $_POST['juniors_gift_wrap'][ $cart_item_key ] ) ? absint( $_POST['juniors_gift_wrap'][ $cart_item_key ] ) : 0;

			// If wrapping quantity exceeds product quantity, show error and stop checkout
			if ( $wrap_qty > $product_qty ) {
				wc_add_notice(
					sprintf(
						__( 'The wrapping quantity for "%s" cannot exceed the product quantity (%d).', 'woocommerce' ),
						$product_name,
						$product_qty
					),
					'error'
				);
			}
		}
	}
});


/**
 *  Save wrapping quantity (custom meta key: juniors_gift_wrap)
 */
add_action( 'woocommerce_checkout_create_order_line_item', function( $item, $cart_item_key, $values, $order ) {
	if ( isset( $_POST['juniors_gift_wrap'][ $cart_item_key ] ) ) {
		$wrap_qty = absint( $_POST['juniors_gift_wrap'][ $cart_item_key ] );

		//  Allow 0 as valid input (no wrapper)
		$max_qty = isset( $values['quantity'] ) ? absint( $values['quantity'] ) : 1;
		if ( $wrap_qty < 0 ) $wrap_qty = 0;
		if ( $wrap_qty > $max_qty ) $wrap_qty = $max_qty;

		if ( $wrap_qty > 0 ) {
			$item->add_meta_data( 'Wrapper Quantity', $wrap_qty );
		}
	}
}, 10, 4 );



/**
 *  Enqueue AJAX script for wrapper quantity updates
 */
add_action( 'wp_enqueue_scripts', function() {
	if ( is_checkout() ) {
        wp_enqueue_script( 'juniors-gift-wrap-ajax', get_stylesheet_directory_uri() . '/assets/js/juniors-gift-wrap.js', array( 'jquery' ), '1.0', true );
		wp_localize_script( 'juniors-gift-wrap-ajax', 'juniorsGiftWrap', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'juniors_wrap_nonce' ),
		) );
	}
});

/**
 *  AJAX: Update wrapper quantity in cart
 */
add_action( 'wp_ajax_update_gift_wrap_qty', 'juniors_update_gift_wrap_qty' );
add_action( 'wp_ajax_nopriv_update_gift_wrap_qty', 'juniors_update_gift_wrap_qty' );

function juniors_update_gift_wrap_qty() {
	check_ajax_referer( 'juniors_wrap_nonce', 'nonce' );

	$cart_item_key = sanitize_text_field( $_POST['cart_item_key'] ?? '' );
	$wrap_qty      = absint( $_POST['wrap_qty'] ?? 0 );

	if ( ! $cart_item_key || ! isset( WC()->cart->cart_contents[ $cart_item_key ] ) ) {
		wp_send_json_error( array( 'message' => 'Invalid cart item.' ) );
	}

	$cart_item = WC()->cart->cart_contents[ $cart_item_key ];
	$product_name = $cart_item['data']->get_name();
	$product_qty  = absint( $cart_item['quantity'] );

	if ( $wrap_qty > $product_qty ) {
        $wrap_qty = $product_qty;
	}

	//  Save the wrapper quantity
	WC()->cart->cart_contents[ $cart_item_key ]['juniors_gift_wrap'] = $wrap_qty;

	//  Force WooCommerce to save updated cart data
	WC()->cart->set_session();
	WC()->cart->calculate_totals();

	wp_send_json_success();
}


/**
 *  Add €2 per wrapper as extra fee dynamically (and save total wrapper qty to order meta)
 */
add_action( 'woocommerce_cart_calculate_fees', function( $cart ) {
	if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;

	$total_wrap_fee = 0;
	$total_wrap_qty = 0;
	$wrap_cost = 2; // €2 per wrapper

	foreach ( $cart->get_cart() as $cart_item ) {
		if ( isset( $cart_item['juniors_gift_wrap'] ) ) {
			$wrap_qty = absint( $cart_item['juniors_gift_wrap'] );
			$total_wrap_qty += $wrap_qty;
			$total_wrap_fee += $wrap_qty * $wrap_cost;
		}
	}

	if ( $total_wrap_fee > 0 && $total_wrap_qty > 0 ) {
		//  Display the total quantity in the fee label
		$label = sprintf( __( 'Gift Wrapping (%d pcs)', 'woocommerce' ), $total_wrap_qty );
		$cart->add_fee( $label, $total_wrap_fee );

		//  Save temporarily to session, so it’s available at checkout
		WC()->session->set( 'total_gift_wrap_qty', $total_wrap_qty );
	} else {
		// Clear session if none
		WC()->session->__unset( 'total_gift_wrap_qty' );
	}
});


/**
 *  Save total wrapper quantity to the order meta
 */
add_action( 'woocommerce_checkout_create_order', function( $order ) {
	$total_wrap_qty = WC()->session->get( 'total_gift_wrap_qty' );
	if ( $total_wrap_qty && $total_wrap_qty > 0 ) {
		$order->update_meta_data( 'Total Gift Wrapper Quantity', $total_wrap_qty );
	}
}, 20, 1 );
