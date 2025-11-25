<?php 

add_shortcode('random_on_sale_products', function($atts) {
    $atts = shortcode_atts([
        'limit' => 6,
    ], $atts, 'random_on_sale_products');

    $args = [
        'post_type'      => 'product',
        'posts_per_page' => $atts['limit'],
        'post_status'    => 'publish',
        'orderby'        => 'rand',
        'meta_query'     => array(
            array(
                'key'     => '_sale_price',
                'value'   => 0,
                'compare' => '>',
                'type'    => 'NUMERIC',
            ),
            array(
                'key'     => '_stock_status',
                'value'   => 'instock',
                'compare' => '=',
            ),
        ),
    ];

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {
        echo '<div class="swiper onsale-swiper"><div class="swiper-wrapper">';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div class="swiper-slide">';
            wc_get_template_part('content', 'product');
            echo '</div>';
        }
        echo '</div><div class="swiper-pagination"></div><div class="swiper-button-prev"></div><div class="swiper-button-next"></div></div>';
    } else {
        echo '<p>No on-sale products available.</p>';
    }

    wp_reset_postdata();
    return ob_get_clean();
});