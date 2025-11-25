<?php
function display_random_on_sale_products_by_brand() {
    ob_start();

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 6,
        'orderby' => 'rand',
        'meta_query' => array(
            array(
                'key' => '_stock_status',
                'value' => 'instock',
                'compare' => '=',
            ),
        ),
        'tax_query' => array(
            array(
                'taxonomy' => 'product_brand',
                'field'    => 'slug',
                'terms'    => 'lego',
                'operator' => 'IN',
            ),
        ),
    );

    $loop = new WP_Query($args);

    if ($loop->have_posts()) :
        echo '<div class="swiper lego-swiper"><div class="swiper-wrapper">';
        while ($loop->have_posts()) : $loop->the_post();
            echo '<div class="swiper-slide">';
            wc_get_template_part('content', 'product');
            echo '</div>';
        endwhile;
        echo '</div><div class="swiper-pagination"></div><div class="swiper-button-prev"></div><div class="swiper-button-next"></div></div>';
    else :
        echo '<p>No random in-stock products found for this brand.</p>';
    endif;

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('lego', 'display_random_on_sale_products_by_brand');