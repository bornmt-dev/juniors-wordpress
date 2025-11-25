<?php
namespace Elementor;
$col_grid_widescreen = $col_grid_laptop =$col_grid_tablet_extra =$col_grid_tablet=$col_grid_mobile_extra ='';
extract($settings);
$wdata->add_render_attribute( 'elbzotech-wrapper', 'class', '' );


echo'<div class="action-type-'.$action_type_click.' elbzotech-instagram-global list-instagram-global-'.$style.' item-instagram-global-'.$style_item.' instag-container-flex-e">';
	if($settings['media_from'] == 'media-lib'){
    	foreach (  $settings['list_images'] as $key => $item ) {
			
			if($action_type_click == 'popup'){
				$wdata->add_render_attribute( 'instagram-link-'.$key, 'class', 'img-wrap ');
			}else{
				if($item['link']['is_external']) $wdata->add_render_attribute( 'instagram-link-'.$key, 'target', "_blank");
				if($item['link']['nofollow']) $wdata->add_render_attribute( 'instagram-link-'.$key, 'rel', "nofollow");
				if($item['link']['url']) $wdata->add_render_attribute( 'instagram-link-'.$key, 'href', $item['link']['url']);
				$wdata->add_render_attribute( 'instagram-link-'.$key, 'class', 'img-wrap ');
			}
			echo '<div href="'.wp_get_attachment_url($item['image']['id'],'full').'" class="item-instagram global-grid-item-e elementor-repeater-item-'.$item['_id'].'">';
				echo '<a '.$wdata->get_render_attribute_string('instagram-link-'.$key).'>';
					echo Group_Control_Image_Size::get_attachment_image_html( $settings['list_images'][$key], 'thumbnail', 'image' );
				
					/*if($item['text_hover']){
					echo '<h3 class="instagram-text-follow color-white">';
						echo '<i class="lab la-instagram title16"></i><span class="text font-sub title100 ">'.$item['text_hover'].'</span>';
					echo '</h3>';
					}*/
				echo '</a>';
			echo '</div>';
		}
	}
	else{
		if(!empty($settings['token']) && function_exists('bzotech_get_data_instagram')){
            $media_array = bzotech_get_data_instagram($settings['token'],$settings['number'],$settings['caption_text_hover']);

            if(!empty($media_array) && is_array($media_array)){
                foreach ($media_array as $item) {
                    if(!empty($item['media_url'])){
                    	echo '<div class="item-instagram global-grid-item-e">';
                    	echo '<a href="'.esc_url($item['permalink']).'" rel="nofollow" class="img-wrap"><img alt="'.esc_attr__('instagram','bw-kidxtore').'" src="'.esc_url($item['media_url']).'"/></a>';
		               /* if(!empty($item['caption']))
		                echo '<h3 class="instagram-text-follow"><i class="lab la-instagram title16"></i> <span class="text">'.$item['caption'].'</span></h3>';*/
	                    echo '</div>';
                    }
                }              
            }
        }
	}
	?>
</div>