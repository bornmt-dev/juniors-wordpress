<?php 


function display_categories_page() {
   
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $categories_per_page = 20;
    $offset = ( $paged - 1 ) * $categories_per_page;

   
    $terms = get_terms( array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => true, 
        'orderby'    => 'name', 
        'order'      => 'ASC',   
    ));

    if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
       
        $output = '<div class="category-grid">';

       
        foreach ( $terms as $term ) {
            
            $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
             if ( esc_html( $term->name ) != "Uncategorized" ) {
                $image_url = wp_get_attachment_url( $thumbnail_id );
                
                $category_url = '/shop/?product_cat=' . $term->slug;

                
                $product_count = $term->count; 

                $output .= '<div class="category-item">';
                $output .= '<a href="' . esc_url( $category_url ) . '" class="category-link">'; // Updated link
                $output .= '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $term->name ) . '" />';
                $output .= '</a>';
                $output .= '<h3>' . esc_html( $term->name ) . '</h3>';
                $output .= '<p class="category-product-count">' . esc_html( $product_count ) . ' Items</p>'; // Display product count
                $output .= '</div>';
            }
        }

        // Close the grid container
        $output .= '</div>';

        // Pagination (optional, if needed)
        /*$total_category = wp_count_terms( 'product_cat', array( 'hide_empty' => true ) );
        $total_pages = ceil( $total_category / $categories_per_page );

        if ( $total_pages > 1 ) {
            $output .= '<div class="pagination">';

            // Loop through pages and create pagination links
            for ( $i = 1; $i <= $total_pages; $i++ ) {
                $url = get_pagenum_link($i); // Use WordPress native pagination links
                $output .= '<a href="' . esc_url( $url ) . '" class="page-number' . ( $i === $paged ? ' current' : '' ) . '">' . $i . '</a>';
            }

            $output .= '</div>';
        }*/
        return $output;
    }

    return 'No categories found with thumbnails and products.';
}

add_shortcode('category_page', 'display_categories_page');
