<?php
namespace Elementor;
use WP_Query;
extract($settings);
if(empty($custom_ids)) return; 
$custom_ids = explode(',',$custom_ids);
if(count($custom_ids) == 1){
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'post__in'=> $custom_ids
    );
}else{
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'post__in'=> $custom_ids,
        'orderby', 'post__in'
    );
}
$class_wrapper="multiple-product";
if(count($custom_ids) == 1) $class_wrapper='one-product';
$wdata->add_render_attribute( 'wrapper', 'class', 'bzoteche-info-box-'.$settings['style'].' item-info-box flex-wrapper '.$class_wrapper);
 $product_query = new WP_Query($args);
?>

<div <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('wrapper'));?>>

		<?php
        $thumb_ids ='';
        if(count($custom_ids) == 1){
    		if($product_query->have_posts()) {
                while($product_query->have_posts()) {
                    $product_query->the_post();
                    global $product;
                    
                        $thumb_id = array(get_post_thumbnail_id(get_the_ID()));
                        $attachment_ids = $product->get_gallery_image_ids(get_the_ID());
                        $attachment_ids = array_merge($thumb_id,$attachment_ids);
                        $gallerys = ''; $i = 1;
                        foreach ( $attachment_ids as $attachment_id ) {
                            $image_link = wp_get_attachment_url( $attachment_id );
                            if($i == 1) $gallerys .= $image_link;
                            else $gallerys .= ','.$image_link;
                            $i++;
                        }
                        

                        ?>
                        <div class="info-box__image product-detail-gallery-js style-gallery-vertical2 flex-wrapper">
                            <?php
                            if ( $attachment_ids && has_post_thumbnail() && count($attachment_ids) > 1) {
                                ?>
                                <div class="gallery-control">
                                    <div class="gallery-slider carousel" data-visible="3">
                                        <?php
                                        $i = 1;
                                        foreach ( $attachment_ids as $attachment_id ) {
                                            if($i == 1) $active = 'active';
                                            else $active = '';
                                            $attributes      = array(
                                                'data-src'      => wp_get_attachment_image_url( $attachment_id, 'woocommerce_single' ),
                                                'data-srcset'   => wp_get_attachment_image_srcset( $attachment_id, 'woocommerce_single' ),
                                                'data-srcfull'  => wp_get_attachment_image_url( $attachment_id, 'full' ),
                                            );
                                            $html = wp_get_attachment_image($attachment_id,array(140,140),false,$attributes );
                                            echo   '<a  data-number="'.esc_attr($i).'" title="'.esc_attr( get_the_title( $attachment_id ) ).'" class="'.esc_attr($active).'" href="javascript:;">
                                                        '.apply_filters( 'woocommerce_single_product_image_thumbnail_html',$html,$attachment_id).'
                                                    </a>';
                                            $i++;
                                        }
                                        ?>
                                    </div>
                                </div>

                                <?php
                                do_action( 'woocommerce_product_thumbnails' );
                            }
                            ?>
                            <div class="mid" data-gallery="<?php echo esc_attr($gallerys)?>">
                                <?php bzotech_product_label()?>
                                <a href="<?php the_permalink()?>">
                                    <?php echo wp_get_attachment_image( get_post_thumbnail_id(get_the_ID()),'full' ); ?>
                                </a>
                            </div>
                            
                        </div>
                        <div class="info-box-content">
                            <?php $date = bzotech_timer_countdown_product(false); ?>
                            <?php
                            if(!empty($date)){
                                echo '<div class="bzotech-countdown flex-wrapper flex_wrap-wrap align_items-center color-white" data-date="'.$date.'">';
                                 echo '<div class="clock day"><strong class="number ">%D</strong><sup class="text">'.$day_pro.'</sup></div>';
                                 echo '<div class="clock hour"><strong class="number ">%H</strong><sup class="text">'.$hour_pro.'</sup></div>';
                                 echo '<div class="clock min"><strong class="number ">%M</strong><sup class="text">'.$min_pro.'</sup></div>';
                                 echo '<div class="clock sec"><strong class="number ">%S</strong><sup class="text">'.$sec_pro.'</sup></div>';
                                echo '</div>';
                            }
                            ?>
                            <div class="info-box__summary">
                                <h3 class="product-title-single "><a href="<?php the_permalink()?>"><?php echo get_the_title(); ?></a></h3>
                                <?php echo woocommerce_template_single_price(); ?>
                                <?php echo woocommerce_template_single_excerpt(); ?>
                                <div class="info-box__summary-cart flex-wrapper">
                                    <?php echo '<a class="btn-add-cart" href="'.get_the_permalink().'">'.esc_html__('ADD TO CART','bw-kidxtore').'</a>';
                                    ?>
                                    <div class="wishlist_compare_product product"> 
                                        <?php echo bzotech_wishlist_url(); 
                                        // echo bzotech_compare_url(); 
                                        ?>
                                    </div>
                                </div> 

                            </div>
                        </div>
                        <?php
                   
                    
                }
            }
		}else{
            if($product_query->have_posts()) {
                ?>
                 <div class="elbzotech-swiper-slider swiper-container"  data-items-custom="0:1" data-items="1" data-items-tablet="1" data-items-mobile="1" data-space="10" data-space-tablet="0" data-space-mobile="0" data-column="" data-auto="" data-center="" data-loop="yes" data-speed="" data-navigation="yes" data-pagination="" data-effect="fade">
                    <div class="swiper-wrapper">
                        <?php
                        while($product_query->have_posts()) {
                            $product_query->the_post();
                            global $product;
                            $date = bzotech_timer_countdown_product_return();
                     
                            ?>
                            <div class="swiper-slide flex-wrapper">
                                <div class="info-box__image">
                                
                                    <div class="mid">
                                        <?php bzotech_product_label()?>
                                        <a href="<?php the_permalink()?>">
                                            <?php echo wp_get_attachment_image( get_post_thumbnail_id(get_the_ID()),'full' ); ?>
                                        </a>
                                    </div>
                                
                                </div>
                                <div class="info-box-content">
                                    <?php
                                    if(!empty($date)){
                                        echo '<div class="bzotech-countdown flex-wrapper flex_wrap-wrap align_items-center color-white" data-date="'.$date.'">';
                                         echo '<div class="clock day"><strong class="number ">%D</strong><sup class="text">'.$day_pro.'</sup></div>';
                                         echo '<div class="clock hour"><strong class="number ">%H</strong><sup class="text">'.$hour_pro.'</sup></div>';
                                         echo '<div class="clock min"><strong class="number ">%M</strong><sup class="text">'.$min_pro.'</sup></div>';
                                         echo '<div class="clock sec"><strong class="number ">%S</strong><sup class="text">'.$sec_pro.'</sup></div>';
                                        echo '</div>';
                                    }
                                    ?>
                                    <div class="info-box__summary">
                                        <h3 class="product-title-single"><a href="<?php the_permalink()?>"><?php echo get_the_title(); ?></a></h3>
                                        
                                        <?php echo woocommerce_template_single_rating(); ?>
                                        <?php echo woocommerce_template_single_excerpt(); ?>
                                        <?php echo woocommerce_template_single_price(); ?>
                                        <div class="info-box__summary-cart flex-wrapper">
                                            <?php echo '<a class="btn-add-cart" href="'.get_the_permalink().'">'.esc_html__('ADD TO CART','bw-kidxtore').'</a>';
                                            ?>
                                            <div class="wishlist_compare_product product"> 
                                                <?php echo bzotech_wishlist_url(); 
                                                //echo bzotech_compare_url(); 
                                                ?>
                                            </div>
                                        </div> 

                                    </div>
                                </div>
                            </div>
                            <?php
                            $thumb_ids = $thumb_ids.','.get_post_thumbnail_id(get_the_ID());
                        }
                        ?>
                    </div>
                    <div class="bzotech-swiper-navi">
                        <div class="swiper-button-nav swiper-button-next"><i class="las la-angle-up"></i></div>
                        <div class="swiper-button-nav swiper-button-prev"><i class="las la-angle-down"></i></div>
                    </div>
                </div>
                <div class="gallery-thumbs" data-navigation="" data-direction="vertical" data-perviewdestop="4" data-perviewtable="4" data-perviewmobi="3" data-space="15">
                    <div class="swiper-wrapper">
                        <?php $thumb_ids = explode(',', $thumb_ids);
                        foreach($thumb_ids as $value){
                            if(!empty($value))
                                echo '<div class="swiper-slide">'.wp_get_attachment_image($value).'</div>'; 
                        }
                        ?>
                      
                    </div>
                    
                </div>
                <?php
            } 
        }
		?>

</div>
