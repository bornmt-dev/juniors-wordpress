<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

		<h3><?php esc_html_e( 'Billing & Delivery Details', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper">
		<?php
		$fields = $checkout->get_checkout_fields( 'billing' );

		foreach ( $fields as $key => $field ) {
			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
		?>
	</div>
	
	<div class="custom-lava-rewards-fields lava-fields-group-wrapper"> 
		<h3><?php esc_html_e('Rewards', 'woocommerce'); ?></h3>
		<p class="subheading"><?php esc_html_e('This information will be used to provide rewards and surprises exclusively for customers who receive marketing communications from us.', 'woocommerce'); ?></p>

		<?php
		$user_id = get_current_user_id();
		$lava_reward_no = $user_id ? get_user_meta($user_id, 'lava_reward_no', true) : '';
		$date_of_birth = $user_id ? get_user_meta($user_id, 'date_of_birth', true) : '';
		$child_gender = $user_id ? get_user_meta($user_id, 'child_gender', true) : '';
		?>

		<!-- LAVA Reward No (readonly) -->
		<label class="form-row form-row-wide " for="billing_lava_reward_no">
			<label for="billing_lava_reward_no" ><?php esc_html_e('LAVA Rewards No', 'woocommerce'); ?></label>
			<input type="text" class="input-text" name="billing_lava_reward_no" id="billing_lava_reward_no" value="<?php echo esc_attr($lava_reward_no); ?>" />
		</label>

		<!-- Date of Birth -->
		<label class="form-row form-row-wide" for="date_of_birth">
			<label for="date_of_birth"><?php esc_html_e(' Date of birth of your child', 'woocommerce'); ?></label>
			<input type="date" class="input-text" name="date_of_birth" id="date_of_birth" value="<?php echo esc_attr($date_of_birth); ?>" />
		</label>

		<!-- Child Gender -->
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



	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
	
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
