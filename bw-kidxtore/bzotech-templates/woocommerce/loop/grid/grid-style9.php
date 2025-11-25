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
			<div class="product-thumb <?php echo esc_attr($class_attribute); ?> product">
				<!-- bzotech_woocommerce_thumbnail_loop have $size and $animation -->
				<?php if($item_label == 'yes') bzotech_product_label()?>
				<?php bzotech_woocommerce_thumbnail_loop($size,$animation);?>
				<div class="product-extra-link">									
					
				</div>
				<?php if($item_countdown == 'yes') bzotech_timer_countdown_product('countdown-style-item-'); ?>								
			</div>
		<?php endif?>
		<div class="product-info">
			<?php do_action( 'woocommerce_before_shop_loop_item_title' );?>
			<div class="product-info-inner">
				<?php if($item_title == 'yes'):?>
					<h3 class="title16 product-title font-medium">
						<a class="color-title" title="<?php echo esc_attr(the_title_attribute(array('echo'=>false)))?>" href="<?php the_permalink()?>"><?php the_title()?></a>
					</h3>
				<?php endif?>
				<?php do_action( 'woocommerce_shop_loop_item_title' );?>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>

				<?php if($item_rate == 'yes') bzotech_get_rating_html(true,false)?>			
				<?php if($item_price == 'yes') bzotech_get_price_html()?>
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
						$icon = '<i class="las la-cart-plus"></i>';
						$icon_after = '';
					}
					bzotech_addtocart_link([
						'icon'		=>$icon,
						'icon_after'=>$icon_after,
						'el_class'=>'addcart-link-style9',
						'style'=>'cart-icon'
					]);
					?>
				<?php endif?>
			</div>
			<?php if(!empty($product_type) && $product_type == 'flash_sale') bzotech_flashsale_countdown_and_stock_prod(); ?>

			
		</div>		
		<?php do_action( 'woocommerce_after_shop_loop_item' );?>
<?php if($view !== 'slider-masory') echo '</div></div>';?>
	