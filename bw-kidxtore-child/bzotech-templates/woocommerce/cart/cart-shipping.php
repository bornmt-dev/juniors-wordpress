<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.8.0
 */

defined( 'ABSPATH' ) || exit;

$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';

 
?>
<?php if ( is_cart() ) : ?>
<tr class="gift-checkbox-row">
    <td colspan="2">
        <label for="gift-checkbox">
            <input type="checkbox" name="gift-checkbox" id="gift-checkbox" style="float: left;" />
            <span>This order will be a gift</span><br>(Gift-wrapped upon delivery)
        </label>
    </td>
</tr>
<tr class="gift-note-row" style="display:none;">
    <td colspan="2">
        <label for="gift-note" style="display: block; margin-bottom: 5px;">Gift note</label>
        <textarea name="gift-note" id="gift-note" rows="3" style="width: 100%; height: 80px; resize: none;" draggable="false"></textarea>
    </td>
</tr>
<?php endif; ?>
<tr class="woocommerce-shipping-totals shipping">
	<th><?php echo wp_kses_post( $package_name ); ?></th>
	<td data-title="<?php echo esc_attr( $package_name ); ?>">
		<?php if ( ! empty( $available_methods ) && is_array( $available_methods ) ) : ?>


		<?php 
		$is_available_online_shipping = is_available_online_shipping();

		// if ( $is_available_online_shipping ) {
		//     echo "Available Online :) ";
		// } else {
		//     echo "NOT Available Online :( ";
		// }
		?>

		<ul id="shipping_method" class="woocommerce-shipping-methods">
			<?php foreach ( $available_methods as $method ) : ?>
				<?php
				$is_online = ( $method->label === "Online" );
				$disabled = ( ! $is_available_online_shipping && $is_online ) ? 'disabled' : '';

				// Prevent "Online" from being preselected when it's disabled
				$is_selected = ( $method->id === $chosen_method && $disabled === '' );

				// Apply opacity to the entire <li> and input if disabled
				$li_style = $input_style = ( $disabled === 'disabled' ) ? 'style="opacity: 0.6;"' : '';
				?>
				<li <?php echo $li_style; ?>>
					<?php
					if ( count( $available_methods ) > 1 ) {
						printf(
							'<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s %5$s %6$s />',
							$index,
							esc_attr( sanitize_title( $method->id ) ),
							esc_attr( $method->id ),
							checked( $is_selected, true, false ),
							$disabled,
							$input_style
						);
					} else {
						printf(
							'<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />',
							$index,
							esc_attr( sanitize_title( $method->id ) ),
							esc_attr( $method->id )
						);
					}

					printf(
						'<label for="shipping_method_%1$s_%2$s">%3$s</label>',
						$index,
						esc_attr( sanitize_title( $method->id ) ),
						wc_cart_totals_shipping_method_label( $method )
					);

					do_action( 'woocommerce_after_shipping_rate', $method, $index );
					?>
				</li>
			<?php endforeach; ?>
		</ul>


			<?php if ( is_cart() ) : ?>
				<p class="woocommerce-shipping-destination">
					<?php
					if ( $formatted_destination ) {
						// Translators: $s shipping destination.
						printf( esc_html__( 'Shipping to %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' );
						$calculator_text = esc_html__( 'Change address', 'woocommerce' );
					} else {
						echo wp_kses_post( apply_filters( 'woocommerce_shipping_estimate_html', __( 'Shipping options will be updated during checkout.', 'woocommerce' ) ) );
					}
					?>
				</p>
			<?php endif; ?>
			<?php
		elseif ( ! $has_calculated_shipping || ! $formatted_destination ) :
			if ( is_cart() && 'no' === get_option( 'woocommerce_enable_shipping_calc' ) ) {
				echo wp_kses_post( apply_filters( 'woocommerce_shipping_not_enabled_on_cart_html', __( 'Shipping costs are calculated during checkout.', 'woocommerce' ) ) );
			} else {
				echo wp_kses_post( apply_filters( 'woocommerce_shipping_may_be_available_html', __( 'Enter your address to view shipping options.', 'woocommerce' ) ) );
			}
		elseif ( ! is_cart() ) :
			echo wp_kses_post( apply_filters( 'woocommerce_no_shipping_available_html', __( 'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'woocommerce' ) ) );
		else :
			echo wp_kses_post(
				/**
				 * Provides a means of overriding the default 'no shipping available' HTML string.
				 *
				 * @since 3.0.0
				 *
				 * @param string $html                  HTML message.
				 * @param string $formatted_destination The formatted shipping destination.
				 */
				apply_filters(
					'woocommerce_cart_no_shipping_available_html',
					// Translators: $s shipping destination.
					sprintf( esc_html__( 'No shipping options were found for %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ),
					$formatted_destination
				)
			);
			$calculator_text = esc_html__( 'Enter a different address', 'woocommerce' );
		endif;
		?>

		<?php if ( $show_package_details ) : ?>
			<?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
		<?php endif; ?>

		<?php if ( $show_shipping_calculator ) : ?>
			<?php woocommerce_shipping_calculator( $calculator_text ); ?>
		<?php endif; ?>
	</td>
</tr>


<?php if (is_checkout()) { ?>
<tr class="woocommerce-shipping-location">
    <td colspan="2">
        <!-- <label for="custom_shipping_location" style="display:block; font-weight:600; margin-bottom:5px;">
            <?php esc_html_e( 'Select Location', 'your-text-domain' ); ?>
        </label> -->
        <p>Collection point</p>
        <select name="custom_shipping_location" id="custom_shipping_location" class="custom-shipping-location" style="width:100%;">
            <option value=""><?php esc_html_e( 'Select location to collect order', 'your-text-domain' ); ?></option>
            <?php 
            $terms = get_terms([
                'taxonomy'   => 'location',
                'hide_empty' => false,
            ]);
            if ( ! is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                    $term_name = ucwords( strtolower( str_ireplace( 'Juniors ', '', $term->name ) ) );
                    echo "<option value='{$term->term_id}'>{$term_name}</option>";
                }
            }
            ?>
        </select>

        <div id="location-stock-response"></div>

			<style>
				#location-stock-response {
					display: flex;
					flex-direction: column;
				}
				#location-stock-response > div > span {
					width: 100%;
					font-size: 14px;
					font-weight: 400;
					display: block;
					text-align: left;
					color: #9a0404;
					margin-top:10px;
					margin-bottom:5px;
				}
				#location-stock-response > div > div {
					display: flex;
					background: #f1f1f1;
					padding: 8px;
					border-radius: 8px;
					justify-content: space-between;
				}

				#location-stock-response > div > div > div{ 
					display: flex;
				}

				#location-stock-response > div > div  img  {
					width: 50px;
					height: 50px;
					border-radius: 8px;
					object-fit:cover;
					object-position: center;
					margin-right: 15px;
				}

				#location-stock-response > div > div  h5  {
					font-weight: 500;
					margin-top: 0;
					margin-bottom: 0;
					margin-right: 10px;
					font-size: 14px;
					text-align: left;
					margin-top: 5px;
				}

				#location-stock-response > div > div > span  {
					padding: 8px 10px;
					line-height: 1;
					height: fit-content;
					background: #ff00005c;
					border-radius: 8px;
					font-size: 12px;
					color: #9a0404;
					font-weight: 500;
					min-width: 94px;
					white-space: nowrap;
				}

			</style>

    </td>
</tr>
<?php } ?>


<?php if ( is_cart() && wc_coupons_enabled() ) : ?>
<tr class="woocommerce-cart-coupon-row">
    <td colspan="2">
        <div id="coupon-toggle" style="cursor:pointer;padding:10px 0; display:flex; justify-content:space-between; align-items:center;">
            <span style="font-weight:500;">Add A Coupon</span>
            <svg id="coupon-arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="transition: transform 0.3s;" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M1.646 5.646a.5.5 0 0 1 .708 0L8 11.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
			</svg>

        </div>
        <div id="coupon-form-wrapper" style="display:none; margin-top:10px;">
            <form class="woocommerce-cart-coupon" method="post" style="display:flex; flex-wrap:wrap; gap:10px;">
                <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" style="flex:1; min-width:180px;" />
                <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
                <?php do_action( 'woocommerce_cart_coupon' ); ?>
            </form>
        </div>
    </td>
</tr>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggle = document.getElementById('coupon-toggle');
    const form = document.getElementById('coupon-form-wrapper');
    const arrow = document.getElementById('coupon-arrow');

    toggle.addEventListener('click', function() {
        const isVisible = form.style.display === 'block';
        form.style.display = isVisible ? 'none' : 'block';
        arrow.style.transform = isVisible ? 'rotate(0deg)' : 'rotate(180deg)';
    });
});
</script>
<?php endif; ?>