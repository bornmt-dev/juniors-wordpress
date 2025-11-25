<?php
if(!isset($animation)) $animation = bzotech_get_option('shop_thumb_animation');

if(empty($size)|| $size=='custom') $size = array(400,400);
if(is_array($size)) $size = bzotech_size_random($size);


if(empty($item_thumbnail)){
    $item_thumbnail = 'yes';
}
if(empty($item_title)){
    $item_title = 'yes';
}
if(empty($item_price)){
    $item_price = 'yes';
}
if(empty($item_rate)){
    $item_rate = 'yes';
}
if(empty($item_label)){
    $item_label = 'yes';
}
if(empty($item_quickview)){
    $item_quickview = 'yes';
}
if(empty($item_button)){
    $item_button = 'yes';
}
if(empty($item_countdown)){
    $item_countdown = 'no';
}

$class_attribute = 'attribute-close';
$data_tabs = get_post_meta(get_the_ID(),'bzotech_product_attribute_data',true);
if(!empty($data_tabs) and is_array($data_tabs) and !empty($data_tabs[0]['color_att']['color'])){
	$class_attribute = 'attribute-open';
}
?>
<?php if($view !== 'slider-masory') echo '<div '.$item_wrap.'>';?>
	<?php if($view !== 'slider-masory') echo '<div '.$item_inner.'>';?>
		<?php do_action( 'woocommerce_before_shop_loop_item' );?>
		<?php if($item_thumbnail == 'yes' && has_post_thumbnail()):?>
			<div class="product-thumb <?php echo esc_attr($class_attribute); ?>  product">
				<!-- bzotech_woocommerce_thumbnail_loop have $size and $animation -->
				<?php if($item_label == 'yes') bzotech_product_label()?>
				<?php bzotech_woocommerce_thumbnail_loop($size,$animation);?>
				
				
				<div class="product-extra-link ">
					<?php echo bzotech_wishlist_url();?>
					<?php if($item_quickview == 'yes') bzotech_product_quickview();?>
					<?php echo bzotech_compare_url(); ?>
				</div>
				
				<?php if($item_button == 'yes'):?>
					<?php 
					$icon_after = $icon = '';
					if(!empty($button_icon['value'])){
						$icon = '<i class="'.$button_icon['value'].'"></i>';
						if($button_icon_pos == 'after-text'){
							$icon_after = $icon;
							$icon = '';
						}
					}else{
						$icon = '<i class="las la-shopping-bag"></i>';
					}
					bzotech_addtocart_link([
						'icon'		=>$icon,
						'text'		=>$button_text,
						'icon_after'=>$icon_after,
						'el_class'=>'',
						'style'=>'cart-icon'
					]);
					?>
				<?php endif?>					

				<?php if($item_countdown == 'yes') bzotech_timer_countdown_product('countdown-style-item-'); ?>		

			</div>
		<?php endif?>
		<div class="product-info text-center">
			<?php do_action( 'woocommerce_before_shop_loop_item_title' );?>
			<?php do_action( 'woocommerce_shop_loop_item_title' );?>
			
			<?php if($item_title == 'yes'):?>
					<h3 class="title18 product-title font-title">
						<a class="color-title" title="<?php echo esc_attr(the_title_attribute(array('echo'=>false)))?>" href="<?php the_permalink()?>"><?php the_title()?></a>
					</h3>
			<?php endif?>
			<?php if($item_price == 'yes') bzotech_get_price_html()?>
			<?php 
			global $product;
			$variables_product = new WC_Product_Variable( get_the_ID());
			$available_variations = $variables_product->get_available_variations('array');
			if(!empty($available_variations) && true !== $available_variations ){
				$attributes = $variables_product->get_variation_attributes();
				
				$attribute_keys  = array_keys( $attributes );
				$variations_json = wp_json_encode( $available_variations );
				$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
				?>
				<form class="variations_form cart js-product-variations" action="<?php echo esc_url(get_the_permalink()); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo  get_the_ID(); ?>" data-product_variations="<?php echo esc_attr($variations_attr); // WPCS: XSS ok. ?>">
					<?php do_action( 'woocommerce_before_variations_form' ); ?>
					<div class="variations flex-wrapper justify_content-space-between">
							<?php foreach ( $attributes as $attribute_name => $options ) : ?>
								<div class="attribute-item">
									<div class="attribute-item__label hidden"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></div>
									<div class="attribute-item__value value">
										<?php
											wc_dropdown_variation_attribute_options(
												array(
													'options'   => $options,
													'attribute' => $attribute_name,
													'product'   => $product,
												)
											);
											echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations hidden" href="#">' . esc_html__( 'Clear', 'bw-kidxtore' ) . '</a>' ) ) : '';
										?>
									</div>
								</div>
							<?php endforeach; ?>
					</div>
					<?php do_action( 'woocommerce_after_variations_table' ); ?>

					<div class="single_variation_wrap hidden">
						<?php
							/**
							 * Hook: woocommerce_before_single_variation.
							 */
							do_action( 'woocommerce_before_single_variation' );

							/**
							 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
							 *
							 * @since 2.4.0
							 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
							 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
							 */
							do_action( 'woocommerce_single_variation' );

							/**
							 * Hook: woocommerce_after_single_variation.
							 */
							do_action( 'woocommerce_after_single_variation' );
						?>
					</div>

				<?php do_action( 'woocommerce_after_variations_form' ); ?>
				</form>
			<?php } ?>
			<?php if($item_rate == 'yes') echo bzotech_get_rating_html(true,false)?>
		
			<?php //if(!empty($product_type) && $product_type == 'flash_sale') bzotech_flashsale_countdown_and_stock_prod(); ?>
			<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
		</div>		
		<?php do_action( 'woocommerce_after_shop_loop_item' );?>
<?php if($view !== 'slider-masory') echo '</div></div>';?>
	