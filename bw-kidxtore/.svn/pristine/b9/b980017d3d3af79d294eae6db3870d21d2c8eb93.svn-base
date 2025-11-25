<?php
namespace Elementor;
$slider_items_widescreen =$slider_items_laptop = $slider_items_tablet = $slider_items_tablet_extra =$slider_items_mobile_extra =$slider_items_mobile =$slider_space_widescreen =$slider_space_laptop =$slider_space_tablet_extra =$slider_space_tablet =$slider_space_mobile_extra= $slider_space_mobile ='';
extract($settings);
$wdata->add_render_attribute( 'elbzotech-wrapper', 'class', 'elbzotech-swiper-slider swiper-container action-type-popup' );

$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items-custom', $slider_items_custom );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items', $slider_items );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items-widescreen', $slider_items_widescreen );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items-laptop', $slider_items_laptop );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items-tablet-extra', $slider_items_tablet_extra);
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items-tablet', $slider_items_tablet);
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items-mobile-extra', $slider_items_mobile_extra);
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-items-mobile', $slider_items_mobile );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-space', $slider_space );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-space-widescreen', $slider_space_widescreen );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-space-laptop', $slider_space_laptop );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-space-tablet-extra', $slider_space_tablet_extra );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-space-tablet', $slider_space_tablet );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-space-mobile-extra', $slider_space_mobile_extra );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-space-mobile', $slider_space_mobile );



$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-column', $slider_column );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-loop', $slider_loop);
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-speed', $slider_speed );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-navigation', $slider_navigation );
$wdata->add_render_attribute( 'elbzotech-wrapper', 'data-pagination', $slider_pagination );
$wdata->add_render_attribute( 'elbzotech-inner', 'class', 'swiper-wrapper' );
$wdata->add_render_attribute( 'elbzotech-item', 'class', 'swiper-slide' );
$hover_animation='';
$animation_class = '';
if($hover_animation) $animation_class = 'elementor-animation-'.$hover_animation;
?>
<div class="elbzotech-instagram elbzotech-wrapper-slider <?php if(!empty($slider_navigation)) echo esc_attr('display-swiper-navi-'.$slider_navigation); ?> <?php if(!empty($slider_pagination)) echo esc_attr('display-swiper-pagination-'.$slider_pagination); ?> <?php if(!empty($slider_scrollbar)) echo esc_attr('display-swiper-scrollbar-'.$slider_scrollbar); ?>">
<?php
	echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-wrapper' ).'>';
		echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-inner' ).'>';

	    	if($settings['media_from'] == 'media-lib'){
		    	foreach (  $settings['list_images'] as $key => $item ) {
					if($item['link']['is_external']) $wdata->add_render_attribute( 'instagram-link', 'target', "_blank");
					if($item['link']['nofollow']) $wdata->add_render_attribute( 'instagram-link', 'rel', "nofollow");
					if($item['link']['url']) $wdata->add_render_attribute( 'instagram-link', 'href', $item['link']['url']);

					$wdata->add_render_attribute( 'elbzotech-item', 'class', 'elementor-repeater-item-'.$item['_id'] );
					echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-item' ).'>';
						echo '<div class="item-instagram item-instagram-global-'.$style_item.'" href="'.wp_get_attachment_url($item['image']['id'],'full').'">';
							echo '<a '.$wdata->get_render_attribute_string('instagram-link').' class="img-wrap">'; 
								echo Group_Control_Image_Size::get_attachment_image_html( $settings['list_images'][$key], 'thumbnail', 'image' );
							
								if($item['text_hover']){
									echo '<h3 class="instagram-text-follow">';
										echo '<i class="lab la-instagram title16"></i><span class="text">'.$item['text_hover'].'</span>';
									echo '</h3>';
								}else{
									echo '<div class="instagram-text-follow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
  <path d="M12.0011 0.479492C8.74209 0.479492 8.33309 0.493743 7.05307 0.551993C5.77556 0.610494 4.90355 0.812746 4.14054 1.1095C3.35128 1.416 2.68178 1.82601 2.01477 2.49326C1.34726 3.16027 0.937259 3.82978 0.629756 4.61878C0.332253 5.38204 0.129751 6.2543 0.0722506 7.53132C0.015 8.81133 0 9.22058 0 12.4796C0 15.7387 0.0145004 16.1464 0.072501 17.4264C0.131252 18.7039 0.333504 19.5759 0.630007 20.3389C0.93676 21.1282 1.34676 21.7977 2.01402 22.4647C2.68078 23.1322 3.35028 23.5432 4.13904 23.8497C4.90255 24.1465 5.77481 24.3487 7.05207 24.4072C8.33209 24.4655 8.74084 24.4797 11.9996 24.4797C15.2589 24.4797 15.6667 24.4655 16.9467 24.4072C18.2242 24.3487 19.0972 24.1465 19.8607 23.8497C20.6497 23.5432 21.3182 23.1322 21.985 22.4647C22.6525 21.7977 23.0625 21.1282 23.37 20.3392C23.665 19.5759 23.8675 18.7037 23.9275 17.4267C23.985 16.1467 24 15.7387 24 12.4796C24 9.22058 23.985 8.81158 23.9275 7.53157C23.8675 6.25405 23.665 5.38204 23.37 4.61903C23.0625 3.82978 22.6525 3.16027 21.985 2.49326C21.3175 1.82576 20.65 1.41575 19.86 1.1095C19.0949 0.812746 18.2224 0.610494 16.9449 0.551993C15.6649 0.493743 15.2574 0.479492 11.9974 0.479492H12.0011ZM10.9246 2.64201C11.2441 2.64151 11.6006 2.64201 12.0011 2.64201C15.2052 2.64201 15.5849 2.65351 16.8502 2.71102C18.0202 2.76452 18.6552 2.96002 19.0782 3.12427C19.6382 3.34177 20.0375 3.60177 20.4572 4.02178C20.8772 4.44178 21.1372 4.84179 21.3552 5.40179C21.5195 5.8243 21.7152 6.4593 21.7685 7.62932C21.826 8.89433 21.8385 9.27433 21.8385 12.4769C21.8385 15.6794 21.826 16.0594 21.7685 17.3244C21.715 18.4944 21.5195 19.1294 21.3552 19.5519C21.1377 20.1119 20.8772 20.5107 20.4572 20.9305C20.0372 21.3505 19.6385 21.6105 19.0782 21.828C18.6557 21.993 18.0202 22.188 16.8502 22.2415C15.5852 22.299 15.2052 22.3115 12.0011 22.3115C8.79684 22.3115 8.41709 22.299 7.15207 22.2415C5.98206 22.1875 5.34706 21.992 4.9238 21.8277C4.3638 21.6102 3.96379 21.3502 3.54379 20.9302C3.12378 20.5102 2.86378 20.1112 2.64578 19.5509C2.48153 19.1284 2.28577 18.4934 2.23252 17.3234C2.17502 16.0584 2.16352 15.6784 2.16352 12.4739C2.16352 9.26933 2.17502 8.89133 2.23252 7.62632C2.28602 6.4563 2.48153 5.8213 2.64578 5.39829C2.86328 4.83829 3.12378 4.43828 3.54379 4.01828C3.96379 3.59827 4.3638 3.33827 4.9238 3.12027C5.34681 2.95527 5.98206 2.76027 7.15207 2.70652C8.25909 2.65651 8.68809 2.64151 10.9246 2.63901V2.64201ZM18.4067 4.63453C17.6117 4.63453 16.9667 5.27879 16.9667 6.07405C16.9667 6.86906 17.6117 7.51407 18.4067 7.51407C19.2017 7.51407 19.8467 6.86906 19.8467 6.07405C19.8467 5.27904 19.2017 4.63404 18.4067 4.63404V4.63453ZM12.0011 6.31705C8.59784 6.31705 5.83856 9.07633 5.83856 12.4796C5.83856 15.8829 8.59784 18.6409 12.0011 18.6409C15.4044 18.6409 18.1627 15.8829 18.1627 12.4796C18.1627 9.07633 15.4042 6.31705 12.0009 6.31705H12.0011ZM12.0011 8.47958C14.2101 8.47958 16.0012 10.2703 16.0012 12.4796C16.0012 14.6886 14.2101 16.4797 12.0011 16.4797C9.79185 16.4797 8.00108 14.6886 8.00108 12.4796C8.00108 10.2703 9.79185 8.47958 12.0011 8.47958Z" fill="white"/>
</svg></div>';
								}
							echo '</a>';
						echo '</div>';
					echo '</div>';
					$wdata->remove_render_attribute( 'instagram-link', 'target', "_blank" );
					$wdata->remove_render_attribute( 'instagram-link', 'rel', "nofollow");
					$wdata->remove_render_attribute( 'instagram-link', 'href', $item['link']['url']);
					$wdata->remove_render_attribute( 'elbzotech-item', 'class', 'elementor-repeater-item-'.$item['_id'] );
				}
			}
			else{
				if(!empty($settings['username']) && function_exists('bzotech_scrape_instagram')){
	                $media_array = bzotech_scrape_instagram($settings['username'], $settings['number'], $settings['token'], $settings['photos_size']);
	                if(isset($media_array['photos'])) $media_array = $media_array['photos'];
	                if(!empty($media_array)){
	                    foreach ($media_array as $item) {
	                        if(isset($item['link']) && isset($item['thumbnail_src'])){
	                        	echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-item' ).'>';
	                        		echo '<div class="item-instagram item-instagram-global-'.$style_item.'">';
			                        	echo '<a href="'.esc_url($item['link']).'" rel="nofollow" class="img-wrap '.esc_attr($animation_class).'">
				                    		<img alt="'.esc_attr__('instagram','bw-kidxtore').'" src="'.esc_url($item['thumbnail_src']).'"/>';
				                		echo '<h3 class="instagram-text-follow"><i class="lab la-instagram title16"></i> <span class="text">'.esc_html__("Instagram",'bw-kidxtore').'</span></h3>';      	
				                    echo '</a></div>';
			                    echo '</div>';
	                        }
	                    }              
	                }
	            }
			}
	    	?>
		</div>
	</div>
	<?php if ( $slider_navigation !== '' ):?>
		<div class="bzotech-swiper-navi">
		    <div class="swiper-button-nav swiper-button-next"><?php Icons_Manager::render_icon( $settings['slider_icon_next'], [ 'aria-hidden' => 'true' ] );?></div>
			<div class="swiper-button-nav swiper-button-prev"><?php Icons_Manager::render_icon( $settings['slider_icon_prev'], [ 'aria-hidden' => 'true' ] );?></div>
		</div>
	<?php endif;
	if ( $slider_pagination !== '' ):?>
		<div class="swiper-pagination"></div>
	<?php endif; ?>
	 <?php if ( $slider_scrollbar !== '' ):?>
        <div class="swiper-scrollbar"></div>
    <?php endif?>
</div>