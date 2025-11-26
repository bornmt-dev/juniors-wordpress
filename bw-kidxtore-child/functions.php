<?php 
/**
 * Juniors Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Juniors
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_JUNIORS_VERSION', '1.0.0' );

if ( ! function_exists( 'juniors_child_theme_enqueue_scripts' ) ) {

    function juniors_child_theme_enqueue_scripts() {

        wp_enqueue_style( 'bw-kidxtore-style', get_template_directory_uri() . '/style.css' );

        $main_style = 'bw-kidxtore-style';

         if ( is_front_page() ) { 
            $styles = [
                // 'child-theme-style'    => '/style.css', 
                // 'footer-style'         => '/assets/css/footer.css',
                'homepage-style'         => '/assets/css/homepage.css',
                'mobile-menu-style'         => '/assets/css/mobile-menu.css',
                // 'myaccount-style'         => '/assets/css/myaccount.css',
                // 'policy-style'             => '/assets/css/policy-style.css',
                // 'our-store-style'             => '/assets/css/our-stores.css',
                'lightbox-style'             => '/assets/css/lightbox.css',
                // 'brandspage-style'             => '/assets/css/archive-brands.css',
                // 'shop-style'             => '/assets/css/shop.css',
                // 'single-product-style'             => '/assets/css/single-product.css',
                // 'categoriespage-style'             => '/assets/css/archive-categories.css',
                // 'cart-style'             => '/assets/css/cart.css',
                'mobile-style'           => '/assets/css/mobile-modif.css',
                // 'checkout-style'           => '/assets/css/checkout.css',
                // 'lava-rewards'           => '/assets/css/lava-rewards.css',
                'bx-site-search'           => '/assets/css/search.css'
            ];
         }
         else {
            $styles = [
                'child-theme-style'    => '/style.css', 
                // 'footer-style'         => '/assets/css/footer.css',
                'homepage-style'         => '/assets/css/homepage.css',
                'mobile-menu-style'         => '/assets/css/mobile-menu.css',
                'myaccount-style'         => '/assets/css/myaccount.css',
                'policy-style'             => '/assets/css/policy-style.css',
                'our-store-style'             => '/assets/css/our-stores.css',
                'lightbox-style'             => '/assets/css/lightbox.css',
                'brandspage-style'             => '/assets/css/archive-brands.css',
                'shop-style'             => '/assets/css/shop.css',
                'single-product-style'             => '/assets/css/single-product.css',
                'categoriespage-style'             => '/assets/css/archive-categories.css',
                'cart-style'             => '/assets/css/cart.css',
                'mobile-style'           => '/assets/css/mobile-modif.css',
                'checkout-style'           => '/assets/css/checkout.css',
                'lava-rewards'           => '/assets/css/lava-rewards.css',
                'bx-site-search'           => '/assets/css/search.css'
            ];
         }
        

       
        foreach ( $styles as $handle => $path ) {
            $filepath = get_stylesheet_directory() . $path;
            $version  = file_exists( $filepath ) ? filemtime( $filepath ) : null;

            wp_enqueue_style( $handle, get_stylesheet_directory_uri() . $path, array( $main_style ), $version, 'all' );
        }


         if ( is_front_page() ) {  
            $scripts = [
                'customjs'    => '/assets/js/custom.js',
                // 'lightboxjs'    => '/assets/js/lightbox.js',
                // 'filterby-categories' => '/assets/js/filterby-categories.js',
            ];
         }
         else {
            $scripts = [
                'customjs'    => '/assets/js/custom.js',
                'lightboxjs'    => '/assets/js/lightbox.js',
                'filterby-categories' => '/assets/js/filterby-categories.js',
            ];
         }

       
        foreach ( $scripts as $handle => $path ) {
            $filepath = get_stylesheet_directory() . $path;
            $version  = file_exists( $filepath ) ? filemtime( $filepath ) : null;
            wp_enqueue_script(
                $handle, 
                get_stylesheet_directory_uri() . $path,
                array('jquery'), 
                $version, 
                true
            );
        }

    }
    add_action( 'wp_enqueue_scripts', 'juniors_child_theme_enqueue_scripts' );
}


$functions_dir = get_stylesheet_directory() . '/functions/'; 

if ( is_dir( $functions_dir ) ) {
    
    $files = glob( $functions_dir . '*.php' );
    
    foreach ( $files as $file ) {
        require_once $file;
    }
}

add_action( 'elementor_pro/posts/query/custom_brand_filter', function( $query ) {
    $query->set( 'tax_query', [
        [
            'taxonomy' => 'product_brand',
            'field'    => 'slug',
            'terms'    => ['lego'],
        ],
    ]);
});



// Automatically require all PHP files in the /hooks/ folder
$hooks_dir = get_stylesheet_directory() . '/hooks/';

if ( is_dir( $hooks_dir ) ) {

    $files = glob( $hooks_dir . '*.php' );

    foreach ( $files as $file ) {
        require_once $file;
    }
}

// Automatically require all PHP files in the /shortcodes/ folder
$shortcodes_dir = get_stylesheet_directory() . '/shortcodes/'; 

if ( is_dir( $shortcodes_dir ) ) {
    
    $files = glob( $shortcodes_dir . '*.php' );
    
    foreach ( $files as $file ) {
        require_once $file;
    }
}


 
// Add all custom product meta fields as text inputs
add_action('woocommerce_product_options_general_product_data', 'add_custom_product_meta_fields_text');
function add_custom_product_meta_fields_text() {
    echo '<div class="options_group">';

    // esi_product_sysref
    woocommerce_wp_text_input(array(
        'id'          => 'esi_product_sysref',
        'label'       => __('ESI Product SysRef', 'woocommerce'),
        'desc_tip'    => true,
        'description' => __('Enter the system reference for this product.', 'woocommerce'),
    ));

    // product_age
    woocommerce_wp_text_input(array(
        'id'          => 'product_age',
        'label'       => __('Product Age', 'woocommerce'),
        'desc_tip'    => true,
        'description' => __('Enter the age of the product (e.g., 2 years, 6 months).', 'woocommerce'),
    ));

    // product_age_range
    woocommerce_wp_text_input(array(
        'id'          => 'product_age_range',
        'label'       => __('Product Age Range', 'woocommerce'),
        'desc_tip'    => true,
        'description' => __('Enter the suitable age range for this product.', 'woocommerce'),
    ));

    // product_is_best_seller (text field, not checkbox)
    woocommerce_wp_text_input(array(
        'id'          => 'product_is_best_seller',
        'label'       => __('Product Is Best Seller', 'woocommerce'),
        'desc_tip'    => true,
        'description' => __('Type yes/no or leave blank.', 'woocommerce'),
    ));

    // product_is_bestseller (text field)
    woocommerce_wp_text_input(array(
        'id'          => 'product_is_bestseller',
        'label'       => __('Product Is Bestseller', 'woocommerce'),
        'desc_tip'    => true,
        'description' => __('Type yes/no or leave blank.', 'woocommerce'),
    ));

    // product_is_new (text field)
    woocommerce_wp_text_input(array(
        'id'          => 'product_is_new',
        'label'       => __('Product Is New', 'woocommerce'),
        'desc_tip'    => true,
        'description' => __('Type yes/no or leave blank.', 'woocommerce'),
    ));

    // product_lava_points
    woocommerce_wp_text_input(array(
        'id'          => 'product_lava_points',
        'label'       => __('Lava Points', 'woocommerce'),
        'type'        => 'number',
        'custom_attributes' => array('step' => '1', 'min' => '0'),
        'desc_tip'    => true,
        'description' => __('Number of Lava Points earned for this product.', 'woocommerce'),
    ));

    // total_sales
    woocommerce_wp_text_input(array(
        'id'          => 'total_sales',
        'label'       => __('Total Sales (Manual Override)', 'woocommerce'),
        'type'        => 'number',
        'custom_attributes' => array('step' => '1', 'min' => '0'),
        'desc_tip'    => true,
        'description' => __('Override WooCommerce total sales count (optional).', 'woocommerce'),
    ));

    // vcv-be-editor
    woocommerce_wp_text_input(array(
        'id'          => 'vcv-be-editor',
        'label'       => __('VCV BE Editor', 'woocommerce'),
        'desc_tip'    => true,
        'description' => __('Visual Composer backend editor meta.', 'woocommerce'),
    ));

    // vcvSourceCssFileUrl
    woocommerce_wp_text_input(array(
        'id'          => 'vcvSourceCssFileUrl',
        'label'       => __('VCV Source CSS File URL', 'woocommerce'),
        'desc_tip'    => true,
        'description' => __('URL to the Visual Composer Source CSS file.', 'woocommerce'),
    ));

    echo '</div>';
}

add_filter('post_class', function($classes, $class, $post_id){
    if ('product' === get_post_type($post_id)) {
        $brands = wp_get_post_terms($post_id, 'product_brand');
        foreach ($brands as $brand) {
            $classes[] = 'brand-' . sanitize_html_class($brand->slug);
        }
    }
    return $classes;
}, 10, 3);


//Removes dashboard, downloads, payment-methods in my-account navigation//
function display_vat_message_behind_price($price, $product) {
    // Append "Prices include VAT" to the price HTML
    $price .= ' <span class="vat-message">includes VAT</span>';
    return $price;
}
add_filter('woocommerce_get_price_html', 'display_vat_message_behind_price', 10, 2);

function custom_remove_my_account_menu_items( $items ) {

    unset( $items['dashboard']);
    unset( $items['downloads']);
    unset( $items['payment-methods']); 
    unset( $items['orders']);

    return $items;
}
add_filter('woocommerce_account_menu_items', 'custom_remove_my_account_menu_items', 999);

//re-arrange the my-account navigation items//
function custom_rearrange_my_account_items ($items) {

    $new_order = array (
        'edit-account'  => __('Account details', 'woocommerce'), 
        'edit-address'  => __('Addresses', 'woocommerce'),
     //   'points'        => __('My Points', 'woocommerce'),   // 
        'orders'        => __('Orders', 'woocommerce'),
        'logout'        => __('Logout', 'woocommerce') 
    );

    return $new_order;
}
add_filter('woocommerce_account_menu_items', 'custom_rearrange_my_account_items', 999);

//GIFT RECEIPT

// Save the checkbox value into session
add_action('wp_ajax_set_gift_receipt', 'set_gift_receipt');
add_action('wp_ajax_nopriv_set_gift_receipt', 'set_gift_receipt');

function set_gift_receipt() {
    if (isset($_POST['gift_receipt'])) {
        WC()->session->set('gift_receipt', sanitize_text_field($_POST['gift_receipt']));
    }
    wp_die();
}

// Save to order only if value is "yes"
add_action('woocommerce_checkout_create_order', 'save_gift_receipt_to_order', 10, 2);

function save_gift_receipt_to_order($order, $data) {
    $gift_receipt = WC()->session->get('gift_receipt');

     // Always clear it first
    $order->delete_meta_data('_gift_receipt');

    if ($gift_receipt === 'yes') {
        $order->update_meta_data('_gift_receipt', 'YES');
    }elseif ($gift_receipt === 'no'){
        $order->update_meta_data('_gift_receipt', 'NO');
    }else{
        $order->update_meta_data('_gift_receipt', 'NO');
    }
}

// Display in admin if set
add_action('woocommerce_admin_order_data_after_order_details', 'show_gift_receipt_in_general', 10, 1);

function show_gift_receipt_in_general($order) {
    $gift_receipt = $order->get_meta('_gift_receipt');

    if (!empty($gift_receipt)) {
        echo '<p><strong>Gift Receipt:</strong> ' . esc_html($gift_receipt) . '</p>';
    }
}

  
// Clear session after order placed
add_action('woocommerce_thankyou', function() {
    WC()->session->__unset('gift_receipt');
});



// changes default sorting to sort by //
add_filter('woocommerce_catalog_orderby','custom_woocommerce_catalog_orderby');
function custom_woocommerce_catalog_orderby($sortby) {
    $sortby['menu_order'] = __ ('Sort by', 'bw-kidxtore-child');

    return $sortby;

}


add_filter( 'woocommerce_checkout_fields', 'custom_reorder_billing_fields' );
function custom_reorder_billing_fields( $fields ) {
    // Set new priorities for billing fields (lower = shown earlier)
    $fields['billing']['billing_first_name']['priority'] = 10;
    $fields['billing']['billing_last_name']['priority']  = 20;
    $fields['billing']['billing_phone']['priority']      = 30;
    $fields['billing']['billing_email']['priority']      = 40;
    $fields['billing']['billing_country']['priority']    = 50;
    $fields['billing']['billing_address_1']['priority']  = 60;
    $fields['billing']['billing_address_2']['priority']  = 70;
    $fields['billing']['billing_state']['priority']      = 80;
    $fields['billing']['billing_city']['priority']       = 90;
    $fields['billing']['billing_postcode']['priority']   = 100;
    // $fields['billing']['billing_company']['priority']    = 110;

  

    return $fields;
}

//ADD-ONS

add_action('woocommerce_review_order_before_payment', 'show_gift_addons_in_order_review');
function show_gift_addons_in_order_review() {
    ?>
    <div class="gift-addons" style="margin-bottom: 20px;">

        <div class="loyale-redeem-points-form">
            <?php 
            echo do_shortcode('[loyale-order-total-points]'); 
            echo do_shortcode('[loyale-redeem-points-form title="" subtitle=""]'); 
            ?>
        </div>

        <div class="gift-addons-title" style="font-weight: bold; margin-bottom: 10px;">
            Make it extra special 🎁
        </div>
        <div class="gift-addons-options">
            <?php 
            $gift_wrap_enabled = get_option('wc_juniours_enable_gift_wrap');
            if ($gift_wrap_enabled === 'yes') { ?>
            <!-- <label style="display: block; margin-bottom: 5px;">
                <input type="checkbox" name="addon_gift_wrapping" <?php checked( WC()->session->get('addon_gift_wrapping'), 'yes' ); ?> />
                Gift Wrapping (+€2)
            </label> -->
            <?php } ?>
            <label style="display: block; margin-bottom: 5px;">
                <input type="checkbox" name="addon_greeting_card" <?php checked( WC()->session->get('addon_greeting_card'), 'yes' ); ?> />
                Greeting Card (+€2.50)
            </label>
            <label style="display: block; padding-top:10px; color: #2792D7;">
                Need Batteries? Click <a style="text-decoration: underline; color: #2792D7;" href="/shop/?product_cat=battery">here!</a>
            </label>
        </div>

        
    </div>
    <?php
}

// Store Add-on Selections in Session
add_action('woocommerce_checkout_update_order_review', 'store_addon_fields_in_session');
function store_addon_fields_in_session($post_data) {
    parse_str($post_data, $parsed_data);

    // $gift_wrap_enabled = get_option('wc_juniours_enable_gift_wrap');
    // if ($gift_wrap_enabled === 'yes') {
    //     WC()->session->set('addon_gift_wrapping', isset($parsed_data['addon_gift_wrapping']) ? 'yes' : 'no');
    // }
    // else {
    //     WC()->session->set('addon_gift_wrapping', 'no' );
    // }

    WC()->session->set('addon_greeting_card', isset($parsed_data['addon_greeting_card']) ? 'yes' : 'no');
    /* WC()->session->set('addon_batteries', isset($parsed_data['addon_batteries']) ? 'yes' : 'no'); */
}

// Apply Fees Based on Selections
add_action('woocommerce_cart_calculate_fees', 'add_gift_addon_fees', 20, 1);
function add_gift_addon_fees($cart) {
    if (is_admin() || !is_checkout()) return;

    // $gift_wrap_enabled = get_option('wc_juniours_enable_gift_wrap');
    // if ($gift_wrap_enabled === 'yes') {
    //     if (WC()->session->get('addon_gift_wrapping') === 'yes') {
    //         $cart->add_fee('Gift Wrapping', 2);
    //     }
    // } 
    
    if (WC()->session->get('addon_greeting_card') === 'yes') {
        $cart->add_fee('Greeting Card', 2.50);
    }   

    /* if (WC()->session->get('addon_batteries') === 'yes') {
        $cart->add_fee('Batteries', 2);
    } */
}

// // Display Add-ons in Admin Order Panel
// add_action('woocommerce_admin_order_data_after_order_details', 'show_gift_addons_in_admin');
// function show_gift_addons_in_admin($order) {
//     if ($order->get_meta('addon_gift_wrapping') === 'yes') {
//         echo '<p><strong>Gift Add-on:</strong> Gift Wrapping</p>';
//     }
//     if ($order->get_meta('addon_greeting_card') === 'yes') {
//         echo '<p><strong>Gift Add-on:</strong> Greeting Card</p>';
//     }
//     /* if ($order->get_meta('addon_batteries') === 'yes') {
//         echo '<p><strong>Gift Add-on:</strong> Batteries</p>';
//     } */
// }

// Save Add-on Data to Order
add_action('woocommerce_checkout_create_order', 'save_gift_addons_to_order', 20, 2);
function save_gift_addons_to_order($order, $data) {
    // $order->update_meta_data('addon_gift_wrapping', WC()->session->get('addon_gift_wrapping'));
    $order->update_meta_data('addon_greeting_card', WC()->session->get('addon_greeting_card'));
    /* $order->update_meta_data('addon_batteries', WC()->session->get('addon_batteries')); */
}


add_action('wp_footer', 'refresh_cart_totals_on_addon_click');
function refresh_cart_totals_on_addon_click() {
    if (is_checkout() && !is_wc_endpoint_url()) : ?>
    <script>
        // jQuery(function($) {
        //     $('form.checkout').on('change', 'input[name="addon_gift_wrapping"], input[name="addon_greeting_card"], input[name="addon_batteries"]', function() {
        //         console.log('Addon checkbox changed. Triggering update_checkout...');
        //         $('body').trigger('update_checkout');
        //     });
        // });
        jQuery(function($) {
            $('form.checkout').on('change', 'input[name="addon_greeting_card"], input[name="addon_batteries"]', function() {
                // console.log('Addon checkbox changed. Triggering update_checkout...');
                $('body').trigger('update_checkout');
            });
        });
    </script>
    <?php endif;
}

/* add_action('wp_ajax_update_cart_quantity_checkout', 'ajax_update_cart_quantity_checkout');
add_action('wp_ajax_nopriv_update_cart_quantity_checkout', 'ajax_update_cart_quantity_checkout');

function ajax_update_cart_quantity_checkout() {
    if ( ! isset($_POST['cart_item_key']) || ! isset($_POST['quantity']) ) {
        wp_send_json_error(['message' => 'Invalid request.']);
    }

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);

    if ( $quantity < 1 ) {
        wp_send_json_error(['message' => 'Invalid quantity.']);
    }

    WC()->cart->set_quantity($cart_item_key, $quantity, true);
    WC()->cart->calculate_totals();

    wp_send_json_success(['message' => 'Cart updated']);
}

    add_action('wp_enqueue_scripts', function() {
        if (is_checkout()) {
            wp_enqueue_script('custom-checkout-qty-update', get_stylesheet_directory_uri() . '/js/custom-qty-update.js', ['jquery'], null, true);
            wp_localize_script('custom-checkout-qty-update', 'custom_cart_ajax', [
                'ajax_url' => admin_url('admin-ajax.php'),
            ]);
        }
    }); */


add_action('pre_get_posts', 'filter_shop_page_on_sale_products');
function filter_shop_page_on_sale_products($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (is_shop() && isset($_GET['onsale']) && $_GET['onsale'] == '1') {
       
        $product_ids_on_sale = wc_get_product_ids_on_sale();
        $query->set('post__in', $product_ids_on_sale);
    }
}


add_filter('woocommerce_shipping_package_name', 'rename_shipping_label_on_checkout');
function rename_shipping_label_on_checkout($package_name) {
    return 'Order Options';
}

add_action( 'woocommerce_cart_calculate_fees', 'add_juniors_bag_fee', 10, 1 );
function add_juniors_bag_fee( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
        return;
    }

    if ( did_action( 'woocommerce_cart_calculate_fees' ) >= 2 ) {
        return;
    }

    $cart->add_fee( "Junior's Bag", 1.00, false ); 
}

add_filter( 'woocommerce_get_terms_and_conditions_checkbox_text', 'custom_terms_text' );

function custom_terms_text( $text ) {
    $terms_page = get_permalink( wc_get_page_id( 'terms' ) );
    return 'I have read and agreed to the website <a href="' . esc_url( $terms_page ) . '" target="_blank">terms and conditions</a>';
}
 

add_action('pre_get_posts', 'filter_instock_and_product_characters_by_url', 99);
function filter_instock_and_product_characters_by_url($query) {
    if(!is_admin() && $query->is_main_query() && (is_shop() || is_product_category()))  {
        // // Always filter only in-stock products
        // $meta_query = (array) $query->get('meta_query');
        // $meta_query[] = array(
        //     'key'     => '_stock_status',
        //     'value'   => 'instock',
        //     'compare' => '='
        // );
        // $query->set('meta_query', $meta_query);
        // Optional: Filter by "product_characters" if URL param is set
        if (isset($_GET['product_characters']) && $_GET['product_characters'] === 'any_value') {
            $tax_query = (array) $query->get('tax_query');
            $tax_query[] = array(
                'taxonomy' => 'pa_product-characters',
                'field'    => 'slug',
                'terms'    => get_terms(array(
                    'taxonomy'   => 'pa_product-characters',
                    'fields'     => 'slugs',
                    'hide_empty' => false
                )),
                'operator'  => 'IN'
            );
            $query->set('tax_query', $tax_query);
        }
    }
}
// add_action( 'wp_enqueue_scripts', 'bbloomer_disable_woocommerce_cart_fragments', 11 ); 
// function bbloomer_disable_woocommerce_cart_fragments() { 
//   wp_enqueue_script( 'wc-cart-fragments' ); 
// }

add_action( 'woocommerce_created_customer', 'save_marketing_consent_user_meta' );

function save_marketing_consent_user_meta( $customer_id ) {
    update_user_meta( $customer_id, 'newsletter_consent', !empty($_POST['newsletter_consent']) ? 1 : 0 );
    update_user_meta( $customer_id, 'marketing_emails_consent', !empty($_POST['marketing_emails_consent']) ? 1 : 0 );
}

add_filter( 'woocommerce_email_subject_new_order', 'custom_email_subject_new_order', 10, 2 );

function custom_email_subject_new_order( $subject, $order ) {
    if ( is_a( $order, 'WC_Order' ) ) {

        // Get store name from custom meta
        $get_store_name = bornGetLocationNameByID( $order->get_meta( '_custom_location_id' ) );

        // Get shipping method title (e.g., "Online" or "Pickup")
        $shipping = '';
        foreach ( $order->get_shipping_methods() as $shipping_item ) {
            $shipping = $shipping_item->get_name();
            break; // use first method only
        }

        // Replace placeholders in subject
        $subject = str_replace( '{get_store_name}', $get_store_name, $subject );
        $subject = str_replace( '{shipping}', $shipping, $subject );
    }

    return $subject;
}


// add_filter('woocommerce_registration_redirect', 'custom_woocommerce_registration_redirect');
// function custom_woocommerce_registration_redirect($redirect) {
//     $referer = wp_get_referer();
//     if ($referer && strpos($referer, 'checkout') !== false) {
//         return $redirect;
//     }
//     return home_url('/my-account/');
// }

add_action('wp_ajax_nopriv_elbzotech_register_user_ajax', 'elbzotech_register_user_ajax');
function elbzotech_register_user_ajax() {
    // Validate and sanitize email
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';

    if (empty($email) || !is_email($email)) {
        wp_send_json_error(['message' => __('A valid email is required.', 'bw-kidxtore')]);
    }

    // Check if email already exists
    if (email_exists($email)) {
        wp_send_json_error(['message' => __('This email is already registered.', 'bw-kidxtore')]);
    }

    // Generate username from email
    $username = sanitize_user(current(explode('@', $email)));

    // Ensure unique username
    $original_username = $username;
    $i = 1;
    while (username_exists($username)) {
        $username = $original_username . $i;
        $i++;
    }

    // Generate password
    $password = wp_generate_password();

    // Create customer
    $user_id = wc_create_new_customer($email, $username, $password);

    if (is_wp_error($user_id)) {
        wp_send_json_error(['message' => $user_id->get_error_message()]);
    }

    // Log the user in automatically
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);
    do_action('wp_login', $username, get_user_by('ID', $user_id));

    // Send password reset email
    $reset_key = get_password_reset_key(get_user_by('ID', $user_id));
    $reset_url = wc_lostpassword_url() . '?key=' . $reset_key . '&login=' . rawurlencode($username);

    wp_mail(
        $email,
        __('Set your password', 'bw-kidxtore'),
        sprintf(__('Welcome to Junior`s Toyshop! Please set your password by clicking the link below:' . "\n\n%s", 'bw-kidxtore'), $reset_url)
    );

    // Return success with optional redirect
    wp_send_json_success([
        'message' => __('Registration successful. Please check your email to set your password.', 'bw-kidxtore'),
        'redirect' => home_url('/my-account/')
    ]); 
}

add_filter( 'wp_get_attachment_image_attributes', function( $attr, $attachment ) {
    return $attr;
}, 10, 2 );


// add_filter( 'post_thumbnail_html', 'add_alt_to_missing_product_images', 10, 3 );
// add_filter( 'woocommerce_product_get_image', 'add_alt_to_missing_product_images', 10, 5 );
// function add_alt_to_missing_product_images( $image_html ) {
//     if ( strpos( $image_html, 'alt=""' ) !== false ) {
//         $image_html = str_replace( 'alt=""', 'alt="Juniors Toyshop Product"', $image_html );
//     } elseif ( ! preg_match( '/alt="/', $image_html ) ) {
//         // If alt attribute is missing entirely
//         $image_html = str_replace( '<img', '<img alt="Juniors Toyshop Product"', $image_html );
//     }
//     return $image_html;
// }
// add_action( 'elementor/frontend/the_content', function( $content ) {
//     if ( strpos( $content, '<img' ) !== false ) {
//         $content = preg_replace_callback(
//             '/<img[^>]*>/i',
//             function( $matches ) {
//                 $img = $matches[0];
//                 if ( strpos( $img, 'alt=' ) === false || strpos( $img, 'alt=""' ) !== false ) {
//                     $img = preg_replace( '/alt=".*?"/', 'alt="Juniors Toyshop Product"', $img );
//                     if ( strpos( $img, 'alt=' ) === false ) {
//                         $img = str_replace( '<img', '<img alt="Juniors Toyshop Product"', $img );
//                     }
//                 }
//                 return $img;
//             },
//             $content
//         );
//     }
//     return $content;
// });


// Replace .avif images with .webp. When product images were converted to .avif from webp during middlelayer import, the webp image should also be stored in WP with the same name.
add_filter(
    'wp_get_attachment_image_attributes', function ($attributes, $attachment, $size) {
        if (!is_product() || !isset($attributes['src']) || !is_string($attributes['src'])) {
            return $attributes;
        }
        if (false !== isset($attributes['src']) && strpos($attributes['src'], '.avif')) {
            $attributes['src'] = str_replace('.avif', '.webp', $attributes['src']);
        }
        return $attributes;
    }, 10, 3
);

//new registered account to brevo
// add_action( 'woocommerce_save_account_details', 'ac_add_new_customer_to_brevo', 10, 1 );
// add_action( 'woocommerce_created_customer', 'ac_add_new_customer_to_brevo', 10, 1 );
// function ac_add_new_customer_to_brevo( $customer_id ) {
//     // Your Brevo API key
//     $api_key = BREVO_API_KEY;
//     $list_id = 3;

//     // Get user data
//     $user_info = get_userdata( $customer_id );
//     $email     = $user_info->user_email;
//     $birthday = get_user_meta( $customer_id, 'date_of_birth', true ); 
//     $gender   = get_user_meta( $customer_id, 'child_gender', true );   

//     // Check if they opted in to newsletter
//     if ( isset( $_POST['newsletter_consent'] ) && $_POST['newsletter_consent'] == '1' ) {
//         $emailBlacklisted = false;
//     }
//     else {
//         $emailBlacklisted = true;
//     }
//     $data = [
//         'email'            => $email,
//         'listIds'          => [ $list_id ],
//         'updateEnabled'    => true,
//         'emailBlacklisted' => $emailBlacklisted,
//         'smsBlacklisted'   => false,
//         'attributes'       => [
//             'BIRTHDAY'  => $birthday, // must match YYYY-MM-DD in Brevo
//             'GENDER'    => $gender
//         ]
//     ];
//     $response = wp_remote_post( 'https://api.brevo.com/v3/contacts', [
//         'headers' => [
//             'api-key'      => $api_key,
//             'Content-Type' => 'application/json',
//         ],
//         'body' => wp_json_encode( $data ),
//     ] );
//     if ( is_wp_error( $response ) ) {
//         error_log( 'Brevo API error: ' . $response->get_error_message() );
//     }
// }

add_action( 'woocommerce_save_account_details', 'ac_update_customer_details_to_brevo', 10, 1 );

function ac_update_customer_details_to_brevo( $customer_id ) {
    
    // Safety check for API Key
    if ( ! defined( 'BREVO_API_KEY' ) ) {
        error_log( 'Brevo API Key is not defined.' );
        return; 
    }
    
    $api_key = BREVO_API_KEY;
    $list_id = 3;

    $user_info = get_userdata( $customer_id );
    $email= $user_info->user_email;

    // --- 1. Data Retrieval ---
    $birthday = sanitize_text_field( $_POST['date_of_birth'] ?? '' ); 
    $gender = sanitize_text_field( $_POST['child_gender'] ?? '' );
    
    $emailBlacklisted = ! ( isset( $_POST['newsletter_consent'] ) && $_POST['newsletter_consent'] == '1' );

    // --- 2. Build Attributes Array ---
    $attributes = [];

    if ( ! empty( $gender ) ) {
        $attributes['GENDER'] = $gender;
    }
    
    if ( ! empty( $birthday ) ) {
        $attributes['BIRTHDAY'] = $birthday; 
    }
    
    // --- 3. Skip Logic ---
    $old_blacklisted_status = get_user_meta($customer_id, 'brevo_email_blacklisted', true);

    if ( empty($attributes) && ($emailBlacklisted == $old_blacklisted_status) ) {
        return;
    }

    $data = [
        'listIds'=> [ $list_id ],
        'emailBlacklisted' => $emailBlacklisted,
        'smsBlacklisted' => false,
        'attributes'  => $attributes
    ];
    
    $api_url = 'https://api.brevo.com/v3/contacts/' . urlencode( $email );

    // --- 4. Execute PUT Request with TEMPORARY SSL BYPASS ---
    $response = wp_remote_request( $api_url, [
        'method' => 'PUT', 
        'headers' => [
            'api-key' => $api_key,
            'Content-Type' => 'application/json',
            'Accept'  => 'application/json',
        ],
        'body'=> wp_json_encode( $data ),
        'timeout' => 10,
        'sslverify' => false, // <--- TEMPORARY FIX
    ] );
// --- 5. Error Logging and Status Save ---
    
    // Define the custom log file path (to ensure it writes, bypassing WP's buffer)
    $custom_log_file = WP_CONTENT_DIR . '/brevo-api-trace.log';
    
    // Log the payload details before the request runs (Critical step)
    $payload_log = 'Brevo Payload: ' . wp_json_encode( $data ) . ' | URL: ' . $api_url;
    error_log( $payload_log, 3, $custom_log_file ); 

    if ( is_wp_error( $response ) ) {
        $error_message = 'Brevo API WP_ERROR: ' . $response->get_error_message();
        error_log( $error_message, 3, $custom_log_file ); 
        
    } else {
        $status = wp_remote_retrieve_response_code( $response );
        $body = wp_remote_retrieve_body( $response );
        
        if ( $status !== 204 ) { 
            // Log the failed status and response body from Brevo (e.g., 400 Bad Request)
            $fail_message = "Brevo Contact Update FAILED. Status: {$status}. Response: {$body}";
            error_log( $fail_message, 3, $custom_log_file );
            
            // Re-add the user notice for feedback
            wc_add_notice( 'Error: Your details were saved, but there was an issue updating your preferences.', 'error' );
            
        } else {
            // Log success for confirmation
            error_log( 'Brevo Contact Update SUCCESS. Status: 204', 3, $custom_log_file );
            // Success logic
            update_user_meta($customer_id, 'brevo_email_blacklisted', $emailBlacklisted);
        }
    }
}

add_action( 'init', function() {
    // Unschedule the WooCommerce related products transient cleanup event
    $timestamp = wp_next_scheduled( 'wc_delete_related_product_transients_async' );
    if ( $timestamp ) {
        wp_unschedule_event( $timestamp, 'wc_delete_related_product_transients_async' );
    }

    // Prevent WooCommerce from scheduling it again
    remove_action( 'woocommerce_scheduled_delete_related_product_transients', 'wc_delete_related_product_transients' );
}, 20 );

add_action('admin_menu', function () {
    add_submenu_page(
        'woocommerce',
        'Product Stock Threshold Settings',
        'Stock Thresholds',
        'manage_woocommerce',
        'wc-stock-thresholds',
        'render_born_wc_stock_thresholds_page'
    );
});

add_action('admin_init', function () {
    register_setting('wc_stock_threshold_group', 'born_wc_stock_thresholds');

    add_settings_section(
        'wc_stock_threshold_section',
        'Set Product Stock Level Thresholds',
        null,
        'wc-stock-thresholds'
    );

    $fields = [
        'out_max' => 'Out of Stock (Max)',
        'low_max' => 'Low Stock (Max)',
    ];

    foreach ($fields as $key => $label) {
        add_settings_field(
            $key,
            $label,
            function () use ($key) {
                $options = get_option('born_wc_stock_thresholds');
                $value = isset($options[$key]) ? esc_attr($options[$key]) : '';
                echo "<input type='number' name='born_wc_stock_thresholds[{$key}]' value='{$value}' />";
            },
            'wc-stock-thresholds',
            'wc_stock_threshold_section'
        );
    }
});

function render_born_wc_stock_thresholds_page() {
    ?>
    <div class="wrap woocommerce">
        <h1>Product Stock Threshold Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('wc_stock_threshold_group');
            do_settings_sections('wc-stock-thresholds');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * Use WooCommerce product short description as Yoast meta description
 * only if the Yoast meta description field is empty.
 * Limit to ~160 characters and remove new lines for SEO.
 */
add_filter( 'wpseo_metadesc', 'my_wc_short_description_as_meta', 10, 1 );

function my_wc_short_description_as_meta( $meta_description ) {
    if ( is_product() && empty( $meta_description ) ) {
        global $post;
        if ( $post && ! empty( $post->post_excerpt ) ) {
            // Strip tags/shortcodes
            $short_description = wp_strip_all_tags( $post->post_excerpt );

            // Replace new lines / multiple spaces with a single space
            $short_description = preg_replace( '/\s+/', ' ', $short_description );
            $short_description = trim( $short_description );

            // Limit to 160 characters
            if ( mb_strlen( $short_description ) > 150 ) {
                $short_description = mb_substr( $short_description, 0, 147 ) . '…';
            }

            return $short_description;
        }
    }
    return $meta_description; // fallback to Yoast value or other defaults
}

/**
 * Force WooCommerce product title format for Yoast SEO
 * Format: Product Name - Category - Brand
 * Falls back gracefully if category or brand is missing.
 */
add_filter( 'wpseo_title', 'my_force_wc_product_title', 20, 1 );

function my_force_wc_product_title( $title ) {
    if ( is_product() ) {
        global $post;
        $product = wc_get_product( $post->ID );

        if ( $product ) {
            // Product name
            $product_name = $product->get_name();

            // Category (first assigned category if exists)
            $category_name = '';
            $categories = wp_get_post_terms( $post->ID, 'product_cat' );
            if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
                $category_name = $categories[0]->name;
            }

            // Brand (support WooCommerce Brands taxonomy or attribute "pa_brand")
            $brand = '';
            if ( taxonomy_exists( 'product_brand' ) ) {
                $brands = wp_get_post_terms( $post->ID, 'product_brand' );
                if ( ! empty( $brands ) && ! is_wp_error( $brands ) ) {
                    $brand = $brands[0]->name;
                }
            } elseif ( $product->get_attribute( 'pa_brand' ) ) {
                $brand = $product->get_attribute( 'pa_brand' );
            }

            // Build parts without empty values
            $title_parts = array_filter( [ $product_name, $category_name, $brand ] );

            // Force new title format
            $title = implode( ' - ', $title_parts );
        }
    }

    return $title;
}


function my_agnostic_flush_cache( $post_id ) {
    
    // 1. Support for WP Super Cache
    if ( function_exists( 'wp_cache_post_change' ) ) {
        wp_cache_post_change( $post_id );
    }
    
    // 2. Support for W3 Total Cache (if you ever switch back)
    elseif ( function_exists( 'w3tc_pgcache_flush_post' ) ) {
        w3tc_pgcache_flush_post( $post_id );
    }
    
    // 3. Support for Autoptimize (another popular one)
    elseif ( class_exists( 'autoptimizeCache' ) ) {
        autoptimizeCache::clearall();
    }

    // 4. Always clear default WordPress internal cache
    clean_post_cache( $post_id );
}

add_action( 'woocommerce_new_product', 'purge_product_cache_on_update', 10, 1 );
add_action( 'woocommerce_update_product', 'purge_product_cache_on_update', 10, 1 );
function purge_product_cache_on_update( $product_id ) {

    my_agnostic_flush_cache( $product_id );
}

add_filter( 'woocommerce_get_price_suffix', 'remove_woocommerce_price_suffix', 10, 4 );
function remove_woocommerce_price_suffix( $suffix, $product, $price, $qty ) {
    return '';  
}

add_filter('wp_get_attachment_metadata', function($meta, $id) {
    if (!is_array($meta)) {
        return [
            'file'   => '',
            'sizes'  => [],
            'width'  => 0,
            'height' => 0
        ];
    }
 
    if (!isset($meta['file'])) {
        $meta['file'] = '';
    }
    if (!isset($meta['sizes'])) {
        $meta['sizes'] = [];
    }

    return $meta;

}, 10, 2);

function custom_price_filter_widget_title_tag($params) {
    // Check the widget ID
    if (isset($params[0]['widget_id']) && $params[0]['widget_id'] === 'woocommerce_price_filter-3') {
        // Override before_title/after_title for this widget
        $params[0]['before_title'] = '<h3 class="widget-title">';
        $params[0]['after_title']  = '</h3>';
    }
    return $params;
} add_filter('dynamic_sidebar_params', 'custom_price_filter_widget_title_tag');


add_action( 'wp_login_failed', 'custom_login_fail_redirect' );
function custom_login_fail_redirect( $username ) {
    $login_page = home_url('/my-account/'); 
    wp_redirect( $login_page . '?login=failed' );
    exit;
}

add_filter( 'authenticate', 'custom_authenticate_redirect', 30, 3 );
function custom_authenticate_redirect($user, $username, $password) {
    if ( $user instanceof WP_Error ) {
        $login_page = home_url('/my-account/');
        wp_redirect( $login_page . '?login=failed' );
        exit;
    }
    return $user;
}



add_action( 'pre_get_posts', 'bzotech_hide_out_of_stock_or_no_image_products', 20 );
function bzotech_hide_out_of_stock_or_no_image_products( $query ) {
    if ( ! is_admin() && $query->is_main_query() && ( is_shop() || is_product_category() || is_product_tag() ) ) {

        $meta_query = $query->get('meta_query') ?: array();

        // Hide out-of-stock products
        $meta_query[] = array(
            'key'     => '_stock_status',
            'value'   => 'instock',
            'compare' => '='
        );

        // Hide products without featured image
        $meta_query[] = array(
            'key'     => '_thumbnail_id',
            'compare' => 'EXISTS'
        );

        $query->set( 'meta_query', $meta_query );
    }
}



// Load the child widget class
require_once get_stylesheet_directory() . '/inc/widget/price-filter.php';
require_once get_stylesheet_directory() . '/inc/widget/category-filter.php';

add_action( 'widgets_init', function() {
 
    // Register child widget
    if ( class_exists( 'bzotech_register_Widget_Price_Filter_child' ) ) {
        register_widget( 'bzotech_register_Widget_Price_Filter_child' );
    }

    if ( class_exists( 'Bzotech_Category_Fillter_Child' ) ) {
        register_widget( 'Bzotech_Category_Fillter_Child' );
    }
});
