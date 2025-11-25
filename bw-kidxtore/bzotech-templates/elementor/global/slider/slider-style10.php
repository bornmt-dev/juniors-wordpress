<?php
namespace Elementor;
extract($settings); 
use Bzotech_Template;
?>

<?php echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-wrapper' ).'>';?>

    <?php echo '<div data-effect="fade" '.$wdata->get_render_attribute_string( 'elbzotech-wrapper-slider' ).'>';?>
        <?php echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-inner' ).'>';?>
            <?php 
            foreach (  $list_testimonial10 as $key => $item ) {

                $wdata->add_render_attribute( 'elbzotech-item-slider-'.$style.'-'.$key, 'class', 'swiper-slide item-slider-global-'.$style.' elementor-repeater-item-'.$item['_id'] );
                echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-item-slider-'.$style.'-'.$key ).'>';
                    
                    echo '<div class="client-info">';
                        if(!empty($item['content'])) echo '<div class="content-slider-custom">
                        
                        <div class="text-center">'.$item['content'].'</div></div>';
                        
                    echo '</div>';
                echo '</div>';
                $wdata->remove_render_attribute( 'elbzotech-item', 'class', 'elementor-repeater-item-'.$item['_id'] );
            } ?>
        </div>
    </div>
    <div class="gallery-thumbs-wrapper">
        <?php echo '<div class="gallery-thumbs swiper-container "'.$wdata->get_render_attribute_string( 'elbzotech-wrapper-slider-gallery' ).'>';?>
            <div class="swiper-wrapper">
                <?php foreach (  $list_testimonial10 as $key => $item ) {?>
                <div class="swiper-slide text-center">
                    <?php 
                    if(!empty($item['image']['url'])) {

                        echo '<div class="image-wrap">';
                        echo Group_Control_Image_Size::get_attachment_image_html( $list_testimonial10[$key], 'thumbnail', 'image' );
                        echo '</div>';
                    }
                    echo '<div class = "info-slider">';
                    if(!empty($item['title'])) echo '<h3 class="title-item title20 font-bold">'.$item['title'].'</h3>';
                    if(!empty($item['description'])) echo '<p class="desc-item title16 font-medium">'.$item['description'].'</p>';
                    echo '</div>';
                    $wdata->remove_render_attribute( 'elbzotech-item', 'class', 'elementor-repeater-item-'.$item['_id'] );
                    ?>
                </div>
                <?php } ?>
          </div>
        </div>
        <?php if ( $slider_navigation_gallery !== '' ):?>
            <div class="bzotech-swiper-navi">
                <div class="swiper-button-nav swiper-button-gallery-next"><?php Icons_Manager::render_icon( $slider_icon_next, [ 'aria-hidden' => 'true' ] );?></div>
                <div class="swiper-button-nav swiper-button-gallery-prev"><?php Icons_Manager::render_icon( $slider_icon_prev, [ 'aria-hidden' => 'true' ] );?></div>
            </div>
        <?php endif?>
    </div>
</div>