<?php 
// Display checkbox on "Edit Account" page
add_action('woocommerce_edit_account_form', function () {
    $user_id = get_current_user_id();
    $value = get_user_meta($user_id, 'newsletter_consent', true);
    ?>
    <br/>
    <p class="form-row form-row-wide mt-2">
        <label>
            <input type="hidden" name="newsletter_consent" value="0" />
            <input type="checkbox" name="newsletter_consent" value="1" <?php checked($value, 1); ?> />
            Yes, I’d like to receive marketing communications including promotions and exclusive offers.
        </label>
    </p>
    <?php
});

// Save checkbox value on account update
add_action('woocommerce_customer_save_account_details', function ($user, $load_address) {
    $user_id = $user->ID;

    $value = isset($_POST['newsletter_consent']) && $_POST['newsletter_consent'] == '1' ? 1 : 0;
    update_user_meta($user_id, 'newsletter_consent', $value);

    error_log("Saved newsletter_consent = $value for user $user_id");
}, 10, 2);


// 3. Save custom fields
add_action('woocommerce_save_account_details', 'born_save_newsletter_field', 12, 1);
function born_save_newsletter_field($user_id) {

    if (isset($_POST['newsletter_consent'])) {
        update_user_meta($user_id, 'newsletter_consent', sanitize_text_field($_POST['newsletter_consent']));
        error_log("Newsletter_consent = ".$_POST['newsletter_consent']);
    }


}
