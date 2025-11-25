<?php 

function display_brands_page_noimage() {
    // Pagination handling using WordPress' native paged query variable
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $brands_per_page = 20; // Number of brands per page
    $offset = ( $paged - 1 ) * $brands_per_page;

    
    $terms = get_terms( array(
        'taxonomy'   => 'product_brand',
        'hide_empty' => true, 
        //'number'     => $brands_per_page, 
        //'offset'     => $offset,
        'orderby'    => 'name', 
        'order'      => 'ASC',   
    ));

    if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
        // Start the output
        $output = '<div class="brands-grid-noimage">';

        // Loop through the terms and display the brand
        foreach ( $terms as $term ) {
            // Get the brand thumbnail
            //$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
            //if ( $thumbnail_id ) {
                //$image_url = wp_get_attachment_url( $thumbnail_id );
                $brand_link = add_query_arg( 'product_brand', $term->slug, get_permalink( woocommerce_get_page_id( 'shop' ) ) );
                $output .= '<div class="brand-item-noimage">';
                $output .= '<a href="' . esc_url( $brand_link ) . '" class="brands-link-noimage">';
                //$output .= '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $term->name ) . '" />';
                $output .= '</a>';
                $output .= '<h3>' . esc_html( $term->name ) . '</h3>';
                $output .= '</div>';
            //}
        }

        // Close the grid container
        $output .= '</div>';

        // Pagination
        /*$total_brands = wp_count_terms( 'product_brand', array( 'hide_empty' => true ) );
        $total_pages = ceil( $total_brands / $brands_per_page );

        if ( $total_pages > 1 ) {
            $output .= '<div class="pagination">';

            // Loop through pages and create pagination links
            for ( $i = 1; $i <= $total_pages; $i++ ) {
                $url = get_pagenum_link($i); // Use WordPress native pagination links
                $output .= '<a href="' . esc_url( $url ) . '" class="page-number' . ( $i === $paged ? ' current' : '' ) . '">' . $i . '</a>';
            }

            $output .= '</div>';
        }
        */
        return $output;
    }

    return 'No brands found with thumbnails and products.';
}

add_shortcode('brands_page_noimage', 'display_brands_page_noimage');
