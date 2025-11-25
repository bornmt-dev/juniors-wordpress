<?php
namespace Elementor;
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
    'product_type'       => $product_type,
    // 'item_countdown'       => $item_countdown,
    // 'item_brand'       => $item_brand,
    'animation'         => $thumbnail_hover_animation,
    'item_flash_sale'         => $item_flash_sale,
    );
?>
<div class="elbzotech-wrapper-slider elbzotech-wrapper-slider-product <?php if(!empty($slider_navigation)) echo esc_attr('display-swiper-navi-'.$slider_navigation); ?> <?php if(!empty($slider_pagination)) echo esc_attr('display-swiper-pagination-'.$slider_pagination); ?> <?php if(!empty($slider_scrollbar)) echo esc_attr('display-swiper-scrollbar-'.$slider_scrollbar); ?>">
    <?php echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-wrapper' ).'>';?>
        <?php
        if($filter_show == 'yes'){
            $data_filter = array(
                'args'          => $args,
                'attr'          => $attr,
                'filter_style'  => $filter_style,
                'filter_column' => $filter_column,
                'filter_cats'   => $filter_cats,
                'filter_price'  => $filter_price,
                'filter_attr'   => $filter_attr,
                'filter_pos'    => '',
            );
            bzotech_get_template_woocommerce('loop/filter-product','',$data_filter,true);
        }
        ?>
        <?php echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-inner' ).'>'; ?>
            <?php 
            $dates_to_max = [];
            if($product_query->have_posts()) {
                while($product_query->have_posts()) {
                    $product_query->the_post();
                    $attr['count'] = $count;
                    if($product_type == 'flash_sale'){
                        $sale_price_dates_to  = ($date_to = get_post_meta(get_the_ID(), '_sale_price_dates_to', true)) ? date_i18n('Y-m-d', $date_to) : '';
                        $dates_to_max[] .= strtotime($sale_price_dates_to);
                    }
                    bzotech_get_template_woocommerce('loop/grid/grid',$item_style,$attr,true);
                    $count++;
                }
            }
            if($product_type == 'flash_sale' && !empty($dates_to_max)){
                $date =  date("Y-m-d h:i:s",max($dates_to_max));
                echo '<div class="dates_to_max" data-date = "'.$date.'"></div>';
            }
            ?>
        </div>
    </div>
    <?php if ( $slider_navigation !== '' ):?>
            <div class="bzotech-swiper-navi">
                <div class="swiper-button-nav swiper-button-next"><?php Icons_Manager::render_icon( $slider_icon_next, [ 'aria-hidden' => 'true' ] );?></div>
                <div class="swiper-button-nav swiper-button-prev"><?php Icons_Manager::render_icon( $slider_icon_prev, [ 'aria-hidden' => 'true' ] );?></div>
            </div>
    <?php endif?>
    <?php if ( $slider_pagination !== '' ):?>
        <div class="swiper-pagination "></div>
    <?php endif?>
    <?php if ( $slider_scrollbar !== '' ):?>
        <div class="swiper-scrollbar"></div>
    <?php endif?>
</div>