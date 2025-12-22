<?php
// 1. Display "LAVA Reward No" and "Date of Birth" on My Account > Edit Account page
add_action('woocommerce_edit_account_form', 'born_display_custom_account_fields');
function born_display_custom_account_fields() {
    $user_id = get_current_user_id();

    $lava_reward_no   = get_user_meta($user_id, 'lava_reward_no', true);
    $date_of_birth    = get_user_meta($user_id, 'date_of_birth', true);
    $child_gender    = get_user_meta($user_id, 'child_gender', true); // renamed for consistency
    ?>
    <div class="custom-lava-rewards-fields lava-fields-group-wrapper"> 
		<h3><?php esc_html_e('Rewards', 'woocommerce'); ?></h3>
		<p class="subheading"><?php esc_html_e('This information will be used to provide rewards and surprises exclusively for customers who receive marketing communications from us.', 'woocommerce'); ?></p>
		<label class="form-row form-row-wide " for="lava_reward_no">
			<label for="lava_reward_no" ><?php esc_html_e('LAVA Reward No', 'woocommerce'); ?></label>
			<input type="number" class="input-text" name="lava_reward_no" id="lava_reward_no" value="<?php echo esc_attr($lava_reward_no); ?>" />
		</label>
        
		<label class="form-row form-row-wide" for="date_of_birth">
			<label for="date_of_birth"><?php esc_html_e('Date of birth of your child', 'woocommerce'); ?></label>
			<input type="date" class="input-text" name="date_of_birth" id="date_of_birth" value="<?php echo esc_attr($date_of_birth); ?>" />
		</label>
    
		<label class="form-row form-row-wide" for="child_gender">
			<label for="child_gender"><?php esc_html_e('Gender of the Child', 'woocommerce'); ?></label>
			<select name="child_gender" id="child_gender" class="select">
				<option value=""><?php esc_html_e('Select Gender', 'woocommerce'); ?></option>
				<option value="male" <?php selected($child_gender, 'male'); ?>><?php esc_html_e('Male', 'woocommerce'); ?></option>
				<option value="female" <?php selected($child_gender, 'female'); ?>><?php esc_html_e('Female', 'woocommerce'); ?></option>
			</select>
		</label>
        <p class="disclaimer">Disclaimer: To earn Lava Rewards points, please ensure you're logged into the Junior’s website using your Lava Rewards email and password when placing your order. Points will be added to your account after your invoice is processed - approximately two weeks following delivery. If you believe any points are missing, feel free to contact Lava Rewards support at <a target="_blank" href="mailto:info@lavarewards.com.mt" >info@lavarewards.com.mt</a> for assistance.</p>
	</div>
    <?php
}

// 2. Validate the Date of Birth field if needed (optional since it's readonly)
add_action('woocommerce_save_account_details_errors', 'born_validate_custom_account_fields', 10, 2);
function born_validate_custom_account_fields($errors, $user) {
    // Optional: validation logic only if made editable
    // if (isset($_POST['date_of_birth']) && empty($_POST['date_of_birth'])) {
    //     $errors->add('date_of_birth_error', __('Please enter your date of birth.', 'woocommerce'));
    // }
}

// 3. Save custom fields
add_action('woocommerce_save_account_details', 'born_save_custom_account_fields', 12, 1);
function born_save_custom_account_fields($user_id) {
    if (isset($_POST['lava_reward_no'])) {
        update_user_meta($user_id, 'lava_reward_no', sanitize_text_field($_POST['lava_reward_no']));
    }

    if (isset($_POST['date_of_birth'])) {
        update_user_meta($user_id, 'date_of_birth', sanitize_text_field($_POST['date_of_birth']));
    }

    if (isset($_POST['child_gender'])) {
        update_user_meta($user_id, 'child_gender', sanitize_text_field($_POST['child_gender']));
    }
}

// 4. Display custom fields on the WordPress Admin User Profile page
add_action('show_user_profile', 'born_display_admin_custom_profile_fields'); // For current user's profile
add_action('edit_user_profile', 'born_display_admin_custom_profile_fields'); // For other users' profiles

/**
 * Displays custom fields on the WordPress Admin User Profile page.
 *
 * @param WP_User $user The user object.
 */
function born_display_admin_custom_profile_fields($user) {
    // Get existing meta data for the user
    $lava_reward_no  = get_user_meta($user->ID, 'lava_reward_no', true);
    $date_of_birth   = get_user_meta($user->ID, 'date_of_birth', true);
    $child_gender    = get_user_meta($user->ID, 'child_gender', true);

    ?>
    <h3><?php _e('Additional Information', 'woocommerce'); ?></h3>

    <table class="form-table">
        <tr>
            <th><label for="lava_reward_no_admin"><?php _e('LAVA Reward No', 'woocommerce'); ?></label></th>
            <td>
                <input type="text" name="lava_reward_no" id="lava_reward_no_admin"
                       value="<?php echo esc_attr($lava_reward_no); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Enter the LAVA Reward Number.', 'woocommerce'); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="date_of_birth_admin"><?php _e('Date of birth of your child', 'woocommerce'); ?></label></th>
            <td>
                <input type="date" name="date_of_birth" id="date_of_birth_admin"
                       value="<?php echo esc_attr($date_of_birth); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Please enter the date of birth (YYYY-MM-DD).', 'woocommerce'); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="child_gender_admin"><?php _e('Gender of the Child', 'woocommerce'); ?></label></th>
            <td>
                <input type="text" name="child_gender" id="child_gender_admin"
                       value="<?php echo esc_attr($child_gender); ?>" class="regular-text" /><br />
                <span class="description"><?php _e('Please enter the gender of the child.', 'woocommerce'); ?></span>
            </td>
        </tr>
    </table>
    <?php
}

// 5. Save custom fields from the WordPress Admin User Profile page
add_action('personal_options_update', 'born_save_admin_custom_profile_fields'); // For current user's profile
add_action('edit_user_profile_update', 'born_save_admin_custom_profile_fields'); // For other users' profiles

/**
 * Saves custom fields from the WordPress Admin User Profile page.
 *
 * @param int $user_id The ID of the user being updated.
 */
function born_save_admin_custom_profile_fields($user_id) {
    // Check if the current user has permission to edit the user
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    // Save 'lava_reward_no' field
    if (isset($_POST['lava_reward_no'])) {
        update_user_meta($user_id, 'lava_reward_no', sanitize_text_field($_POST['lava_reward_no']));
    }

    // Save 'date_of_birth' field
    if (isset($_POST['date_of_birth'])) {
        update_user_meta($user_id, 'date_of_birth', sanitize_text_field($_POST['date_of_birth']));
    }

    // Save 'child_gender' field
    if (isset($_POST['child_gender'])) {
        update_user_meta($user_id, 'child_gender', sanitize_text_field($_POST['child_gender']));
    }
}

add_action('wp_logout', 'custom_redirect_after_logout');
function custom_redirect_after_logout() {
    wp_redirect(home_url()); // 👈 Change this to any URL you like
    exit;
}