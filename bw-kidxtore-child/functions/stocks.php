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
          
            error_log( "TERM Name: ".$term->name );
            if ( $term->name === 'JUNIORS PAMA' ) {
                continue;
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

    $product_id = $product->get_id();
    if ( ! $product_id ) {
        return;
    }

    // ----------------------------
    // 1) normalize low stock values => set to 0
    // ----------------------------
    $metas = get_post_meta( $product_id );

    foreach ( $metas as $meta_key => $meta_values ) {

        if ( strpos( $meta_key, '_stock_at_' ) === 0 ) {

            // defensive: ensure we have a value
            $raw = isset( $meta_values[0] ) ? $meta_values[0] : '';
            $value = intval( $raw );

            if ( $value <= 2 ) {
                // Only update if it's not already 0 to avoid extra writes
                if ( $value !== 0 ) {
                    update_post_meta( $product_id, $meta_key, 0 );

                }
            }
        }
    }

    // ----------------------------
    // 2) validate using existing function and redirect if invalid
    // ----------------------------
    if ( ! bornValidateProductStocks( $product_id ) ) {

        // Get first category
        $terms = get_the_terms( $product_id, 'product_cat' );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $category_slug = $terms[0]->slug;
            $sku = $product->get_sku(); 
            wp_safe_redirect( home_url( '/shop/?product_cat=' . $category_slug. "&outofstock=".$sku  ) );
            exit;
        }

        // Fallback if no category
        wp_safe_redirect( home_url( '/shop/' ) );
        exit;
    }

    // If valid, just continue loading the product page
}


add_action('woocommerce_before_shop_loop', 'bzotech_outofstock_warning', 5);
function bzotech_outofstock_warning() {
    if ( isset($_GET['outofstock']) ) {
        $sku = $_GET['outofstock'];
        wc_print_notice( 
            $sku.' is currently out of stock. You may choose another similar product.', 
            'notice' 
        );
    }
}
