<?php 
 // // Save custom fields to the order meta
add_action('woocommerce_checkout_update_order_meta', 'save_custom_billing_fields');
function save_custom_billing_fields($order_id) {
    if (!empty($_POST['billing_lava_reward_no'])) {
        update_post_meta($order_id, '_billing_lava_reward_no', sanitize_text_field($_POST['billing_lava_reward_no']));
    }
    if (!empty($_POST['date_of_birth'])) {
        update_post_meta($order_id, '_date_of_birth', sanitize_text_field($_POST['date_of_birth']));
    }
    if (!empty($_POST['child_gender'])) {
        update_post_meta($order_id, 'child_gender', sanitize_text_field($_POST['child_gender']));
    }
}

// Display custom fields in WooCommerce admin order page
add_action('woocommerce_admin_order_data_after_order_details', 'display_custom_billing_fields_admin', 10, 1);
function display_custom_billing_fields_admin($order) {
    $lava_reward_no = get_post_meta($order->get_id(), '_billing_lava_reward_no', true);
    $date_of_birth = get_post_meta($order->get_id(), '_date_of_birth', true);
    $child_gender = get_post_meta($order->get_id(), '_child_gender', true);

    if ($lava_reward_no) {
        echo '<p><strong>' . __('LAVA Reward No') . ':</strong> ' . esc_html($lava_reward_no) . '</p>';
    }
    if ($date_of_birth) {
        echo '<p><strong>' . __('Date of Birth') . ':</strong> ' . esc_html($date_of_birth) . '</p>';
    }
    if ($child_gender) {
        echo '<p><strong>' . __('Gender of the Child') . ':</strong> ' . esc_html($child_gender) . '</p>';
    }
}

add_action( 'woocommerce_checkout_create_order', 'save_custom_lava_reward_meta', 20, 2 );

function save_custom_lava_reward_meta( $order, $data ) {
    if ( isset( $_POST['billing_lava_reward_no'] ) ) {
        $order->update_meta_data( 'billing_lava_reward_no', sanitize_text_field( $_POST['billing_lava_reward_no'] ) );
    }

    if ( isset( $_POST['date_of_birth'] ) ) {
        $order->update_meta_data( 'date_of_birth', sanitize_text_field( $_POST['date_of_birth'] ) );
    }

    if ( isset( $_POST['child_gender'] ) ) {
        $order->update_meta_data( 'child_gender', sanitize_text_field( $_POST['child_gender'] ) );
    }
}