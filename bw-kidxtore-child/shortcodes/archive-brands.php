<?php 
function display_brands_page($atts) {
    $atts = shortcode_atts(array(
        'slug' => '', // Optional slug to filter child brands
    ), $atts);

    $slug = sanitize_title($atts['slug']);

    // Pagination
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $brands_per_page = 20;
    $offset = ( $paged - 1 ) * $brands_per_page;

    // Determine parent term ID if slug is provided
    $args = array(
        'taxonomy'   => 'product_brand',
        // 'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    );

    if (!empty($slug)) {
        $parent_term = get_term_by('slug', $slug, 'product_brand');
        if ($parent_term && !is_wp_error($parent_term)) {
            $args['parent'] = $parent_term->term_id;
        } else {
            return 'Invalid brand slug provided.';
        }
    } else {
        $args['parent'] = 0; // Show only top-level brands by default
    }

    $terms = get_terms($args);

    if (!empty($terms) && !is_wp_error($terms)) {
        $output = '<div class="brands-grid">';
        foreach ($terms as $term) {
            $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
            if ($thumbnail_id) {
                $image_url = wp_get_attachment_url($thumbnail_id);
                $brand_link = add_query_arg('product_brand', $term->slug, get_permalink(woocommerce_get_page_id('shop')));
                $output .= '<div class="brand-item">';
                $output .= '<a href="' . esc_url($brand_link) . '" class="brands-link">';
                $output .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($term->name) . '" />';
                $output .= '</a>';
                $output .= '<h3>' . esc_html($term->name) . '</h3>';
                $output .= '</div>';
            }
        }
        $output .= '</div>';
        return $output;
    }

    return 'No brands found with thumbnails.';
}

add_shortcode('brands_page', 'display_brands_page');