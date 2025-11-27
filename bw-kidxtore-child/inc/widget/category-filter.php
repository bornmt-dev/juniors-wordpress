<?php
/**
 * Created by Sublime Text 3.
 * User: MBach90
 * Date: 24/12/15
 * Time: 10:20 AM
 */
if(!class_exists('Bzotech_Category_Fillter_Child') && class_exists("woocommerce"))
{
    class Bzotech_Category_Fillter_Child extends WP_Widget {


        protected $default=array();

        static function _init()
        {
            add_action( 'widgets_init', array(__CLASS__,'_add_widget') );
        }

        static function _add_widget()
        {
            if(function_exists('bzotech_reg_widget')) bzotech_reg_widget( 'Bzotech_Category_Fillter_Child' );
        }

        function __construct() {
            // Instantiate the parent object
            parent::__construct( false, esc_html__('BZOTECH Categories Filter Child','bw-kidxtore'),
                array( 'description' => esc_html__( 'Filter product shop page', 'bw-kidxtore' ), ));

            $this->default=array(
                'title' => 'Categories',
                'category' => array(),
            );
        }



        function widget( $args, $instance ) {

            // echo apply_filters('bzotech_output_content',$args['before_widget']);
            // if ( ! empty( $instance['title'] ) ) {
            //     echo apply_filters('bzotech_output_content',$args['before_title']) . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
            // }

            echo '<div id="bzotech_category_fillter_child-2" class="sidebar-widget widget widget_bzotech_category_fillter"><h2 class="widget-title">Categories</h2>';
            
            echo '<input type="hidden" name="load-shop-ajax-nonce" class="load-shop-ajax-nonce" value="' . wp_create_nonce( 'load-shop-ajax-nonce' ) . '" />';

            global $wpdb;

            // Run your SQL query
            $categories = $wpdb->get_results("
                SELECT 
                    terms.term_id,
                    terms.name,
                    terms.slug,
                    COUNT(p.ID) as instock_count
                FROM {$wpdb->terms} AS terms
                INNER JOIN {$wpdb->term_taxonomy} AS tax 
                    ON tax.term_id = terms.term_id
                    AND tax.taxonomy = 'product_cat'
                INNER JOIN {$wpdb->term_relationships} AS rel
                    ON rel.term_taxonomy_id = tax.term_taxonomy_id
                INNER JOIN {$wpdb->posts} AS p
                    ON p.ID = rel.object_id
                    AND p.post_type = 'product'
                    AND p.post_status = 'publish'
                INNER JOIN {$wpdb->postmeta} AS pm
                    ON pm.post_id = p.ID
                    AND pm.meta_key = '_stock_status'
                    AND pm.meta_value = 'instock'
                GROUP BY terms.term_id
                ORDER BY terms.name ASC
            ");

            // Echo the categories
            if (!empty($categories)) {
                echo '<ul>';
                foreach ($categories as $cat) {
                    $active = '';
                    if (isset($_GET['product_cat'])) {
                        $cat_current = explode(',', sanitize_text_field($_GET['product_cat']));
                        if (in_array($cat->slug, $cat_current)) {
                            $active = 'active';
                        }
                    }
                    echo '<li>
                            <h3>
                                <a data-cat="' . esc_attr($cat->slug) . '" 
                                href="' . esc_url(bzotech_get_filter_url('product_cat', $cat->slug)) . '" 
                                class="load-shop-ajax ' . $active . '">
                                    ' . esc_html($cat->name) . '
                                </a>
                            </h3>
                            <span class="smoke">(' . intval($cat->instock_count) . ')</span>
                        </li>';
                }
                echo '</ul>';
            }

          
            echo apply_filters('bzotech_output_content',$args['after_widget']);
  

        }

        function update( $new_instance, $old_instance ) {
 
        }

        function form( $instance ) {
            
        }
    }

    Bzotech_Category_Fillter_Child::_init();

}
