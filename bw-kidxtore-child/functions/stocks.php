<?php 
function getStockPerLocationByID($product_id) {
    $data = [];
    $terms = get_terms([
        'taxonomy'   => 'location',
        'hide_empty' => false,
    ]);

    $thresholds = get_option('born_wc_stock_thresholds', []);

    $out_max = (int) ($thresholds['out_max'] ?? 2);
    $low_max = (int) ($thresholds['low_max'] ?? 5);

    if (!is_wp_error($terms)) {
        foreach ($terms as $term) {

            $term_id  = $term->term_id;
            $term_name  = $term->name;

            $stocks = get_post_meta( $product_id ,'_stock_at_'.$term_id, true);

            if ($stocks <= $out_max ) {
                $class = " txt-red ";
                $text = "Out of Stock";
            }

            else if ($stocks <=  $low_max ) {
                $class = " txt-orange ";
                $text = "Low stock";
            }

            else {
                $class = " txt-green";
                $text = "In Stock";
            }

            if ($term_name == "JUNIORS SAN GWANN") {
                $is_main = true;
            }
            else {
                $is_main = false;
            }
          
            $data[] = [
                "location" =>  ucwords(strtolower(str_ireplace('Juniors ', '', $term_name))),
                "stocks" => $stocks,
                "class"  => $class,
                "text"  => $text,
                "is_main" => $is_main
            ];

        }
    }
    return  $data;
}


function bornValidateProductStocks($product_id) {
    
    $terms = get_terms([
        'taxonomy'   => 'location',
        'hide_empty' => false,
    ]);

    $stock_available = false;

    $thresholds = get_option('born_wc_stock_thresholds', []);

    $out_max = (int) ($thresholds['out_max'] ?? 2);

    if (!is_wp_error($terms)) {
        foreach ($terms as $term) {

            $term_id  = $term->term_id;
            $term_name  = $term->name;

            $stocks = get_post_meta( $product_id ,'_stock_at_'.$term_id, true);

            if ($stocks > $out_max ) {
                $stock_available = true;
            }

        }
    }

    return  $stock_available;
}


add_action( 'template_redirect', 'born_redirect_invalid_product_stock' );
function born_redirect_invalid_product_stock() {
    if ( ! is_product() ) {
        return;
    }

    global $post;

    $product = wc_get_product( $post->ID );
    if ( ! $product ) {
        return;
    }

    // Validate stock using your custom function
    if ( ! bornValidateProductStocks( $product->get_id() ) ) {

        // Get first category
        $terms = get_the_terms( $product->get_id(), 'product_cat' );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $category_slug = $terms[0]->slug;

            // Redirect using product_cat query parameter
            wp_safe_redirect( home_url( '/shop/?product_cat=' . $category_slug ) );
            exit;
        }

        // Fallback if no category
        wp_safe_redirect( home_url( '/shop/' ) );
        exit;
    }
}