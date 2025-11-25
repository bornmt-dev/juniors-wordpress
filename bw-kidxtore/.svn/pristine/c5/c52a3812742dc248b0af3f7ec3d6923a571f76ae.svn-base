<?php
namespace Elementor;
extract($settings); 
use Bzotech_Template;
?>

<div class="client-slider elbzotech-wrapper-slider-global-style5">
    <div class="slick text-center">
        <?php 
        foreach (  $list_testimonial2 as $key => $item ) {

            $wdata->add_render_attribute( 'elbzotech-item-slider-'.$style.'-'.$key, 'class', 'item-client item-slider-global-'.$style.' elementor-repeater-item-'.$item['_id'] );
            echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-item-slider-'.$style.'-'.$key ).'>';
                
                echo '<div class="client-info">';
                    if(!empty($item['content'])) echo '<div class="content-slider-custom bg-color2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="26" viewBox="0 0 36 26" fill="none">
                    <path d="M9.76818 11.2233C11.3113 11.6861 12.6624 12.6355 13.6188 13.9291C14.5753 15.2227 15.0854 16.7907 15.0729 18.3979C15.0729 20.3916 14.2788 22.3036 12.8655 23.7133C11.4521 25.1231 9.53522 25.915 7.53643 25.915C5.53765 25.915 3.62072 25.1231 2.20736 23.7133C0.794008 22.3036 0 20.3916 0 18.3979C0.0805719 16.5914 0.592625 14.8302 1.49354 13.2609L8.01711 0.915039H12.3604L9.76818 11.2233ZM30.6951 11.2233C32.2382 11.6861 33.5893 12.6355 34.5457 13.9291C35.5022 15.2227 36.0123 16.7907 35.9998 18.3979C35.9073 20.3318 35.0719 22.1559 33.6671 23.4918C32.2623 24.8278 30.3958 25.5731 28.4547 25.5731C26.5137 25.5731 24.6472 24.8278 23.2424 23.4918C21.8375 22.1559 21.0022 20.3318 20.9097 18.3979C20.9981 16.5927 21.5096 14.8332 22.4033 13.2609L28.9268 0.915039H33.2702L30.6951 11.2233Z" fill="#70BBFF"/>
                    <path d="M9.76818 11.2233C11.3113 11.6861 12.6624 12.6355 13.6188 13.9291C14.5753 15.2227 15.0854 16.7907 15.0729 18.3979C15.0729 20.3916 14.2788 22.3036 12.8655 23.7133C11.4521 25.1231 9.53522 25.915 7.53643 25.915C5.53765 25.915 3.62072 25.1231 2.20736 23.7133C0.794008 22.3036 0 20.3916 0 18.3979C0.0805719 16.5914 0.592625 14.8302 1.49354 13.2609L8.01711 0.915039H12.3604L9.76818 11.2233ZM30.6951 11.2233C32.2382 11.6861 33.5893 12.6355 34.5457 13.9291C35.5022 15.2227 36.0123 16.7907 35.9998 18.3979C35.9073 20.3318 35.0719 22.1559 33.6671 23.4918C32.2623 24.8278 30.3958 25.5731 28.4547 25.5731C26.5137 25.5731 24.6472 24.8278 23.2424 23.4918C21.8375 22.1559 21.0022 20.3318 20.9097 18.3979C20.9981 16.5927 21.5096 14.8332 22.4033 13.2609L28.9268 0.915039H33.2702L30.6951 11.2233Z" fill="white" fill-opacity="0.5"/>
                    </svg>
                    <div class="text-center">'.$item['content'].'</div></div>';
                    if(!empty($item['title'])) echo '<h3 class="item-title title20 font-medium">'.$item['title'].'</h3>';
                    if(!empty($item['description'])) echo '<p class="item-des title14 font-medium">'.$item['description'].'</p>';
                    
                echo '</div>';
                if(!empty($item['image']['url'])) {
                    echo '<div class="image-wrap client-thumb elementor-animation-'.$image_hover_animation.'"><span>';
                    echo Group_Control_Image_Size::get_attachment_image_html( $list_testimonial2[$key], 'thumbnail', 'image' );
                    echo '</span></div>';
                }  
            echo '</div>';
            $wdata->remove_render_attribute( 'elbzotech-item', 'class', 'elementor-repeater-item-'.$item['_id'] );
        }
        ?>
    </div>
</div>