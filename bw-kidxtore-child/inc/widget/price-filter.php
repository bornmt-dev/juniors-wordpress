<?php
/* --------------------------- */
/* PRICE FILTER WIDGET CHILD   */
/* --------------------------- */
if (class_exists('WC_Widget')) {

    class Bzotech_Widget_Price_Filter_Child extends WC_Widget {

        public function __construct() {
            $this->widget_cssclass    = 'woocommerce widget_price_filter';
            $this->widget_description = esc_html__('Child: Display a slider to filter products by price.', 'bw-kidxtore');
            $this->widget_id          = 'woocommerce_price_filter_child';
            $this->widget_name        = esc_html__('BZOTECH Child Filter By Price', 'bw-kidxtore');

            parent::__construct();
        }

        public function widget($args, $instance) {
            global $wp;

            wp_enqueue_script('wc-price-slider');

            // Get cached price range
            $prices = get_transient('bzotech_filtered_price');
            if (false === $prices) {
                $prices = $this->get_filtered_price();
                set_transient('bzotech_filtered_price', $prices, HOUR_IN_SECONDS);
            }

            if (!$prices || $prices->min_price === $prices->max_price) return;

            $this->widget_start($args, $instance);

            $form_action = '' === get_option('permalink_structure') ?
                remove_query_arg(array('page', 'paged', 'product-page'), add_query_arg($wp->query_string, '', home_url($wp->request))) :
                preg_replace('%\/page/[0-9]+%', '', home_url(trailingslashit($wp->request)));

            $min_price = isset($_GET['min_price']) ? esc_attr($_GET['min_price']) : floor($prices->min_price);
            $max_price = isset($_GET['max_price']) ? esc_attr($_GET['max_price']) : ceil($prices->max_price);

            echo '<input type="hidden" name="load-product-filter-ajax-nonce" class="load-product-filter-ajax-nonce" value="' . wp_create_nonce('load-product-filter-ajax-nonce') . '" />';
            echo '<form method="get" action="' . esc_url($form_action) . '">
                    <div class="price_slider_wrapper">
                        <div class="price_slider"></div>
                        <div class="price_slider_amount">
                            <input type="text" id="min_price" name="min_price" value="' . esc_attr($min_price) . '" data-min="' . floor($prices->min_price) . '" placeholder="' . esc_attr__('Min price', 'bw-kidxtore') . '" />
                            <input type="text" id="max_price" name="max_price" value="' . esc_attr($max_price) . '" data-max="' . ceil($prices->max_price) . '" placeholder="' . esc_attr__('Max price', 'bw-kidxtore') . '" />
                            <div class="price_label flex-wrapper justify_content-space-between align-content-center"><span class="from"></span> &mdash; <span class="to"></span></div>
                            <button type="submit" class="elbzotech-bt-default load-shop-ajax">' . esc_html__('Filter', 'bw-kidxtore') . '</button>
                            ' . wc_query_string_form_fields(null, array('min_price', 'max_price'), '', true) . '
                            <div class="clear"></div>
                        </div>
                    </div>
                </form>';

            $this->widget_end($args);
        }

        protected function get_filtered_price() {
            global $wpdb;

            $sql = "
                SELECT MIN( CAST(pm.meta_value AS DECIMAL(10,2) ) ) AS min_price,
                       MAX( CAST(pm.meta_value AS DECIMAL(10,2) ) ) AS max_price
                FROM {$wpdb->posts} p
                INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
                WHERE p.post_type = 'product'
                  AND p.post_status = 'publish'
                  AND pm.meta_key = '_price'
                  AND EXISTS (
                      SELECT 1
                      FROM {$wpdb->postmeta} s
                      WHERE s.post_id = p.ID
                        AND s.meta_key = '_stock_status'
                        AND s.meta_value = 'instock'
                  )
            ";

            return $wpdb->get_row($sql);
        }
    }

    add_action('widgets_init', function () {
        if (class_exists('Bzotech_Widget_Price_Filter_Child')) {
            register_widget('Bzotech_Widget_Price_Filter_Child');
        }
    });
}
