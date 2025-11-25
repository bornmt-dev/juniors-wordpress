<?php
namespace Elementor;
extract($settings);
use Bzotech_Template;
$wdata->add_render_attribute( 'wrapper', 'class', 'js-info-box-menu-vertical dropdow-style-'.$style_show_dropdow.' bzoteche-info-box-global-'.$settings['style']);
$icon_title_html = '';
if(!empty( $icon['value'])){				
	if( $icon['library'] == 'svg')
		$icon_title_html = '<img class="item-icon-e" alt="'.esc_attr__('svg','bw-kidxtore').'" src="'.$icon['value']['url'].'">';
	else $icon_title_html = '<i class="item-icon-e '.$icon['value'].'"></i>';
} 
?>
<div <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('wrapper'));?>>
	
	<?php 
	if(!empty($title)) echo '<div class="header-info header-info-'.$style_title_menu_vertical.'"><h3 class="title-info"><span>'.$icon_title_html.$title.'</span><i class="las la-angle-down"></i></h3></div>';
	?>
	<?php 
	if(!empty($list_menu_vertical) and is_array($list_menu_vertical)) { 
        echo '<div class="list-menu-vertical-wap"><div class = "list-menu-vertical flex-wrapper info-container-flex-e">';?>
        <?php
        foreach ($list_menu_vertical as $key => $item ) {
        	$icon_menu_html = '';
        	echo '<div class="list-menu-vertical__item">';
				if(!empty( $item['icon']['value'])){				
					if( $item['icon']['library'] == 'svg')
						$icon_menu_html = '<img class="item-icon-menu-vertical" alt="'.esc_attr__('svg','bw-kidxtore').'" src="'.$item['icon']['value']['url'].'">';
					else $icon_menu_html = '<i class="item-icon-menu-vertical '.$item['icon']['value'].'"></i>';
				}
				$icon_sub_menu = '';
				if(!empty($item['template'])) $icon_sub_menu = '<i class="las la-angle-right icon_sub_menu"></i>';
				$image_html = '';
				if(!empty($item['image']['url'])){
				    $image_html = '<span class="image-icon">'.wp_get_attachment_image( $item['image']['id'] ,'full').'</span>';
				}
				if(!empty($item['link']) )
				$wdata->add_link_attributes( 'data_link_menu'.$key, $item['link']);
				if(!empty($item['image']['url'])){
					
					echo '<a '.$wdata->get_render_attribute_string( 'data_link_menu'.$key ).' class="list-menu-vertical__item-link have-icon"><div class="item-cont">'.$image_html.'<span class="elementor-repeater-item-'.$item['_id'].'">'.$item['title'].'</span></div>'.$icon_sub_menu.'</a>';
				} else {
					echo '<a '.$wdata->get_render_attribute_string( 'data_link_menu'.$key ).' class="list-menu-vertical__item-link">'.$icon_menu_html.'<span class="elementor-repeater-item-'.$item['_id'].'">'.$item['title'].'</span>'.$icon_sub_menu.'</a>';
				}
					
				if(!empty($item['template'])) echo '<div class="list-menu-vertical__item-sub container-base-e">'.Bzotech_Template::get_vc_pagecontent($item['template']).'</div>';	
       		echo '</div>';
        }
        echo '</div></div>';
    }
	?>

</div>