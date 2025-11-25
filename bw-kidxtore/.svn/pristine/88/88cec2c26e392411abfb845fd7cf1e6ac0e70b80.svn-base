<?php
namespace Elementor;
$animation='';
extract($settings);
$attr = array(
    'item_wrap'         => $item_wrap,
    'item_inner'        => $item_inner,
    'button_icon_pos'   => $button_icon_pos,
    'button_icon'       => $button_icon,
    'button_text'       => $button_text,
    'size'              => $size,
    'view'              => $view,
    'column'            => $column,
    'item_style'        => $item_style,
    'item_thumbnail'    => $item_thumbnail,
    'item_quickview'    => $item_quickview,
    'item_label'        => $item_label,
    'item_title'        => $item_title,
    'item_rate'         => $item_rate,
    'item_price'        => $item_price,
    'item_countdown'        => $item_countdown,
    'item_button'       => $item_button,
    // 'item_countdown'       => $item_countdown,
    // 'item_brand'       => $item_brand,
    'animation'         => $thumbnail_hover_animation,
    'item_flash_sale'         => $item_flash_sale,
    );
?>
<div class="elbzotech-wrapper-slider elbzotech-slider-better">
    <?php echo '<div class="elbzotech-swiper-slider swiper-container"  data-items-custom="" data-items="1" data-items-widescreen="" data-items-laptop="" data-items-tablet-extra="" data-items-tablet="" data-items-mobile-extra="" data-items-mobile="" data-space="0" data-space-widescreen="" data-space-laptop="" data-space-tablet-extra="" data-space-tablet="" data-space-mobile-extra="" data-space-mobile="" data-column="1" data-auto="" data-center="" data-loop="yes" data-speed="" data-navigation="style2" data-pagination="" data-effect="fade">';?>

        <?php echo '<div class="swiper-wrapper">'; ?>
            <?php 
            if($product_query->have_posts()) {
                while($product_query->have_posts()) {
                    $product_query->the_post();
                    $attr['count'] = $count;
                    ?>
                    <div class="swiper-slide">
                    	<div class="item-product product">
                            <?php if($item_label == 'yes') bzotech_product_label()?>
                    		<div class="product-thumb">                    			
                    			<?php bzotech_woocommerce_thumbnail_loop($size,$animation);?>
                    		</div>
                    		<div class="product-info bg-white text-center">
                    			<?php if($item_title == 'yes'):?>
									<h3 class="title16 product-title font-medium">
										<a class="color-title" title="<?php echo esc_attr(the_title_attribute(array('echo'=>false)))?>" href="<?php the_permalink()?>"><?php the_title()?></a>
									</h3>
								<?php endif?>
								<?php if($item_price == 'yes') bzotech_get_price_html()?>
								<?php if($item_rate == 'yes') bzotech_get_rating_html(true,true)?>
								<?php echo '<a class="all_review" href="'.get_the_permalink().'">'.esc_html__('ALL REVIEWS','bw-kidxtore').'</a>'; ?>
                    		</div>
                    	</div>
                    </div>
                    <?php

                    $count++;
                }
            }
            ?>
        </div>
    </div>
  	<div class="bzotech-swiper-navi">
        <div class="swiper-button-nav swiper-button-next"><?php Icons_Manager::render_icon( $slider_icon_next, [ 'aria-hidden' => 'true' ] );?></div>
        <div class="swiper-button-nav swiper-button-prev"><?php Icons_Manager::render_icon( $slider_icon_prev, [ 'aria-hidden' => 'true' ] );?></div>
    </div>
</div>