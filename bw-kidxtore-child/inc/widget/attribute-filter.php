<?php
/**
 * Created by Sublime Text 3.
 * User: MBach90
 * Date: 24/12/15
 * Time: 10:20 AM
 */
if(!class_exists('Bzotech_Attribute_Filter_Child') && class_exists("woocommerce")){
    class Bzotech_Attribute_Filter_Child extends WP_Widget {


        protected $default=array();

        static function _init()
        {
            add_action( 'widgets_init', array(__CLASS__,'_add_widget') );
        }

        static function _add_widget()
        {
            if(function_exists('bzotech_reg_widget')) bzotech_reg_widget( 'Bzotech_Attribute_Filter_Child' );
        }

        function __construct() {
            // Instantiate the parent object
            parent::__construct( false, esc_html__('BZOTECH Attribute Filter Child','bw-kidxtore'),
                array( 'description' => esc_html__( 'Filter product shop page', 'bw-kidxtore' ), ));

            $this->default=array(
                'title'             => '',
                'attribute'         => '',
            );
        }


        function widget( $args, $instance ) {
            global $post;

            // Only show on shop pages or elementor-widget-bzotech-products
            $check_shop = true;
            if ( isset($post->post_content) && strpos($post->post_content, 'elementor-widget-bzotech-products') === false ) {
                $check_shop = false;
            }
            if ( ! is_shop() && ! is_product_taxonomy() && ! $check_shop ) return;

            $instance = wp_parse_args($instance, $this->default);
            $title    = !empty($instance['title']) ? $instance['title'] : '';
            $attribute = $instance['attribute'];
            $taxonomy  = "pa_" . $attribute;

            // Get current filter value
            $term_current = isset($_GET['filter_' . $attribute]) ? explode(',', sanitize_text_field($_GET['filter_' . $attribute])) : [];

            // Transient key includes selected filter to avoid stale data
            $transient_key = 'bzotech_attribute_filter_widget_' . $attribute . '_' . md5(implode(',', $term_current));
            $output = get_transient($transient_key);

            if ( false === $output ) {
                ob_start();

                // echo $args['before_widget'];
                // if ( $title ) echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
                echo '<div id="bzotech_attribute_filter-3" class="sidebar-widget widget widget_bzotech_attribute_filter"><h2 class="widget-title">'.$title.'</h2>';

                // Get terms and product counts in one call
                $terms = get_terms([
                    'taxonomy'   => $taxonomy,
                    'hide_empty' => true, // fetch all terms
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                ]);

                if ( ! empty($terms) && ! is_wp_error($terms) ) {

                    // Get term meta in batch
                    $term_ids = wp_list_pluck($terms, 'term_id');
                    $term_images = array_map(function($id){ return get_term_meta($id,'image',true); }, $term_ids);
                    $term_colors = array_map(function($id){ return get_term_meta($id,'color',true); }, $term_ids);
                    $term_labels = array_map(function($id){ return get_term_meta($id,'label',true); }, $term_ids);

                    // Get attribute object once
                    $attr = Bzotech_Woocommerce_Attributes::bzotech_get_tax_attribute($taxonomy);

                    echo '<input type="hidden" name="load-shop-ajax-nonce" class="load-shop-ajax-nonce" value="' . wp_create_nonce('load-shop-ajax-nonce') . '" />';

                    switch ($attr->attribute_type) {

                        case 'image':
                        case 'color':
                        case 'label':
                            echo '<div class="tawcvs-swatches attribute-type-' . esc_attr($attr->attribute_type) . '">';
                            foreach ($terms as $term) {
                                $selected = in_array($term->slug, $term_current) ? 'selected' : '';

                                $data_id = 'filter_' . $attribute . '=' . $term->slug;
                                $url = esc_url(bzotech_get_filter_url('filter_' . $attr->attribute_name, $term->slug));

                                if ($attr->attribute_type === 'image') {
                                    $image = isset($term_images[$term->term_id]) ? wp_get_attachment_image_url($term_images[$term->term_id], 'thumbnail') : WC()->plugin_url() . '/assets/images/placeholder.png';
                                    echo sprintf('<a data-attribute="%s" data-term="%s" class="load-shop-ajax swatch swatch-image swatch-%s %s" title="%s" data-value="%s" href="%s"><img src="%s" alt="%s"><span class="hide">%s</span></a>',
                                        esc_attr($attribute), esc_attr($term->slug), esc_attr($term->slug), $selected,
                                        esc_attr($term->name), esc_attr($term->slug), $url, esc_attr($image), esc_attr($term->name), $data_id
                                    );
                                } elseif ($attr->attribute_type === 'color') {
                                    $color = $term_colors[$term->term_id] ?? '';
                                    $class_white_color = in_array(strtolower($color), ['#fff','#ffffff']) ? 'class_white_bg_color' : '';
                                    if ($color) {
                                        echo sprintf('<a data-attribute="%s" data-term="%s" class="load-shop-ajax swatch swatch-color %s swatch-%s %s" title="%s" href="%s" %s><span class="span-trong" %s></span></a>',
                                            esc_attr($attribute), esc_attr($term->slug), esc_attr($class_white_color),
                                            esc_attr($term->slug), $selected, esc_attr($term->name), $url, esc_attr($data_id),
                                            bzotech_add_html_attr('background-color:'.$color)
                                        );
                                    }
                                } elseif ($attr->attribute_type === 'label') {
                                    $label = $term_labels[$term->term_id] ?: $term->name;
                                    echo sprintf('<a data-attribute="%s" data-term="%s" class="load-shop-ajax swatch swatch-label swatch-%s %s" title="%s" data-value="%s" href="%s" %s><span class="label-attr">%s</span><span class="count">(%d)</span></a>',
                                        esc_attr($attribute), esc_attr($term->slug), esc_attr($term->slug), $selected,
                                        esc_attr($term->name), esc_attr($term->slug), $url, esc_attr($data_id),
                                        esc_html($label), intval($term->count)
                                    );
                                }
                            }
                            echo '</div>';
                            break;

                        default:
                            echo '<ul class="list-filter attribute-type-default filter_'.$attribute.'">';
                            foreach ($terms as $term) {
                                $active = in_array($term->slug, $term_current) ? 'active' : '';
                                $term_name = $term->name;

                                // Special renaming
                                $renames = [
                                    "0TO18MONTHS" => "0 - 18 Months",
                                    "TWOTOFIVE" => "2 - 5 Years",
                                    "SIXTOEIGHT" => "6 - 8 Years",
                                    "NINETOELEVEN" => "9 - 11 Years",
                                    "TWELVETOSEVENTEEN" => "12 - 17 Years",
                                    "OVER18" => "18+ Years"
                                ];
                                if (isset($renames[$term->name])) $term_name = $renames[$term->name];

                                $data_id = 'data-filter_'.$attribute.'='.$term->slug;
                                echo '<li class="title16 main-color2 font-medium '.esc_attr($term->slug).'-inline '.esc_attr($active) .'">
                                        <h3><a title="'.$term->name.'" data-attribute="'.esc_attr($attribute).'" data-term="'.esc_attr($term->slug).'" class="main-color2 load-shop-ajax bgcolor-'.esc_attr($term->slug).'" href="'.esc_url(bzotech_get_filter_url('filter_'.$attribute,$term->slug)).'" '.$data_id.'>
                                        <span></span>'.$term_name.'</a></h3>
                                        <span class="count hidden">('.intval($term->count).')</span>
                                    </li>';
                            }
                            echo '</ul>';
                            break;
                    }
                }

                echo $args['after_widget'];

                $output = ob_get_clean();
                set_transient($transient_key, $output, 5 * MINUTE_IN_SECONDS);
            }

            echo $output;
        }


        protected function get_filtered_term_product_counts( $term_ids, $taxonomy, $query_type ,$check_shop) {
            global $wpdb;
            if(!$check_shop){
                $tax_query  = WC_Query::get_main_tax_query();
                $meta_query = WC_Query::get_main_meta_query();
                if ( 'or' === $query_type ) {
                    foreach ( $tax_query as $key => $query ) {
                        if ( is_array( $query ) && $taxonomy === $query['taxonomy'] ) {
                            unset( $tax_query[ $key ] );
                        }
                    }
                }

                $meta_query      = new WP_Meta_Query( $meta_query );
                $tax_query       = new WP_Tax_Query( $tax_query );
                $meta_query_sql  = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
                $tax_query_sql   = $tax_query->get_sql( $wpdb->posts, 'ID' );

                // Generate query.
                $query           = array();
                $query['select'] = "SELECT COUNT( DISTINCT {$wpdb->posts}.ID ) as term_count, terms.term_id as term_count_id";
                $query['from']   = "FROM {$wpdb->posts}";
                $query['join']   = "
                    INNER JOIN {$wpdb->term_relationships} AS term_relationships ON {$wpdb->posts}.ID = term_relationships.object_id
                    INNER JOIN {$wpdb->term_taxonomy} AS term_taxonomy USING( term_taxonomy_id )
                    INNER JOIN {$wpdb->terms} AS terms USING( term_id )
                    " . $tax_query_sql['join'] . $meta_query_sql['join'];

                $query['where']   = "
                    WHERE {$wpdb->posts}.post_type IN ( 'product' )
                    AND {$wpdb->posts}.post_status = 'publish'"
                    . $tax_query_sql['where'] . $meta_query_sql['where'] .
                    'AND terms.term_id IN (' . implode( ',', array_map( 'absint', $term_ids ) ) . ')';

                if ( $search = WC_Query::get_main_search_query_sql() ) {
                    $query['where'] .= ' AND ' . $search;
                }

                $query['group_by'] = 'GROUP BY terms.term_id';
                $query             = apply_filters( 'woocommerce_get_filtered_term_product_counts_query', $query );
                $query             = implode( ' ', $query );

                // We have a query - let's see if cached results of this query already exist.
                $query_hash    = md5( $query );
                $cached_counts = (array) get_transient( 'wc_layered_nav_counts' );

                if ( ! isset( $cached_counts[ $query_hash ] ) ) {
                    $results                      = $wpdb->get_results( $wpdb->prepare($query), ARRAY_A ); // @codingStandardsIgnoreLine
                    $counts                       = array_map( 'absint', wp_list_pluck( $results, 'term_count', 'term_count_id' ) );
                    $cached_counts[ $query_hash ] = $counts;
                    set_transient( 'wc_layered_nav_counts', $cached_counts, DAY_IN_SECONDS );
                }

                return array_map( 'absint', (array) $cached_counts[ $query_hash ] );
            }
        }

        function update( $new_instance, $old_instance ) {

            // Save widget options
            $instance=array();
            $instance=wp_parse_args($instance,$this->default);
            $new_instance=wp_parse_args($new_instance,$instance);

            return $new_instance;
        }

        function form( $instance ) {
            // Output admin widget options form

            $instance=wp_parse_args($instance,$this->default);
            extract($instance);
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:' ,'bw-kidxtore'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <p>
                <label><?php esc_html_e( 'Attribute:' ,'bw-kidxtore'); ?></label></br>
                <select id="<?php echo esc_attr($this->get_field_id( 'attribute' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'attribute' )); ?>">
                    <?php
                    global $wpdb;
                    $attribute_taxonomies = wc_get_attribute_taxonomies();
                    if(!empty($attribute_taxonomies)){
                        foreach($attribute_taxonomies as $attr){
                            $selected=selected($attr->attribute_name,$attribute,false);
                            echo "<option {$selected} value='{$attr->attribute_name}'>{$attr->attribute_label}</option>";
                        }
                    }
                    else echo esc_html__("No any attribute.",'bw-kidxtore');
                    ?>
                </select>
            </p>
            <?php
        }
    }

    Bzotech_Attribute_Filter_Child::_init();

}
