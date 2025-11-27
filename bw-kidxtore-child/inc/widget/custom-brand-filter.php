<?php 
if (!class_exists('Bzotech_Brand_Filter_Child') && class_exists('woocommerce')) {

    class Bzotech_Brand_Filter_Child extends WP_Widget {

        function __construct() {
            parent::__construct(
                false,
                esc_html__('Custom Brands Filter Child','bw-kidxtore'),
                array('description' => esc_html__('Filter products by brand', 'bw-kidxtore'))
            );
        }

        function widget($args, $instance) {
            echo  '<div id="bzotech_category_filter-5" class="sidebar-widget widget widget_bzotech_category_filter"><h2 class="widget-title">Brands</h2>';

            echo '<input type="hidden" name="load-shop-ajax-nonce" class="load-shop-ajax-nonce" value="' . wp_create_nonce('load-shop-ajax-nonce') . '" />';

            global $wpdb;

            // -----------------------------
            // 5-MINUTE TRANSIENT CACHE
            // -----------------------------
            $cache_key = 'bzotech_brand_widget_cache';
            $brands = get_transient($cache_key);

            if ($brands === false) {

                // Run SQL only if cache missing
                $query = $wpdb->prepare("
                    SELECT 
                        t.term_id,
                        t.name,
                        t.slug,
                        COUNT(DISTINCT p.ID) AS instock_count
                    FROM {$wpdb->posts} p
                    INNER JOIN {$wpdb->postmeta} pm_stock
                        ON pm_stock.post_id = p.ID
                        AND pm_stock.meta_key = %s
                        AND pm_stock.meta_value = %s
                    INNER JOIN {$wpdb->postmeta} pm_thumb
                        ON pm_thumb.post_id = p.ID
                        AND pm_thumb.meta_key = %s
                        AND pm_thumb.meta_value <> ''
                    INNER JOIN {$wpdb->term_relationships} tr
                        ON tr.object_id = p.ID
                    INNER JOIN {$wpdb->term_taxonomy} tt
                        ON tt.term_taxonomy_id = tr.term_taxonomy_id
                        AND tt.taxonomy = %s
                        AND tt.parent = 0
                    INNER JOIN {$wpdb->terms} t
                        ON t.term_id = tt.term_id
                    WHERE p.post_type = 'product'
                    AND p.post_status = 'publish'
                    GROUP BY t.term_id, t.slug, t.name
                    ORDER BY t.name ASC
                ", '_stock_status', 'instock', '_thumbnail_id', 'product_brand');

                $brands = $wpdb->get_results($query);

                // Save to transient for 5 minutes
                set_transient($cache_key, $brands, 5 * MINUTE_IN_SECONDS);
            }

            // -----------------------------
            // OUTPUT
            // -----------------------------
            if (!empty($brands)) {
                echo '<ul>';
                foreach ($brands as $brand) {
                    $active = '';

                    if (isset($_GET['product_brand'])) {
                        $current_brands = explode(',', sanitize_text_field($_GET['product_brand']));
                        if (in_array($brand->slug, $current_brands)) {
                            $active = 'active';
                        }
                    }

                    echo '<li>
                        <h3>
                            <a data-cat="' . esc_attr($brand->slug) . '"
                            href="' . esc_url(bzotech_get_filter_url('product_brand', $brand->slug)) . '"
                            class="load-shop-ajax ' . $active . '">
                            ' . esc_html($brand->name) . '
                            </a>
                        </h3>
                        <span class="smoke">(' . intval($brand->instock_count) . ')</span>
                    </li>';
                }
                echo '</ul>';
            }

            echo '</div>';
        }




        function form($instance) {
            $title = !empty($instance['title']) ? $instance['title'] : 'Brands';
            echo '<p><label>Title: <input class="widefat" name="' . esc_attr($this->get_field_name('title')) . '" value="' . esc_attr($title) . '"></label></p>';
        }

        function update($new_instance, $old_instance) {
            return $new_instance;
        }
    }

    // Register the widget
    add_action('widgets_init', function() {
        register_widget('Bzotech_Brand_Filter_Child');
    });

}
