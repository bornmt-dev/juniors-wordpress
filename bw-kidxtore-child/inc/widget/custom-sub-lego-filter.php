<?php
/**
 * Created by Sublime Text 3.
 * User: MBach90
 * Date: 24/12/15
 * Time: 10:20 AM
 */
if(!class_exists('Bzotech_SubLego_Filter') && class_exists("woocommerce"))
{
    class Bzotech_SubLego_Filter extends WP_Widget {


        protected $default=array();

        static function _init()
        {
            add_action( 'widgets_init', array(__CLASS__,'_add_widget') );
        }

        static function _add_widget()
        {
            if(function_exists('bzotech_reg_widget')) bzotech_reg_widget( 'Bzotech_SubLego_Filter' );
        }

        function __construct() {
            // Instantiate the parent object
            parent::__construct( false, esc_html__('Custom Lego Brands Filter','bw-kidxtore'),
                array( 'description' => esc_html__( 'Custom Lego Brands Filter', 'bw-kidxtore' ), ));

            $this->default=array(
                'title' => '',
                'category' => array(),
            );
        }

        function widget( $args, $instance ) {
            // Widget output
            global $post;
            $check_shop = true;
            if ( isset( $post->post_content ) ) {
                if ( strpos( $post->post_content, '[bzotech_shop' ) ) {
                    $check_shop = true;
                }
            }
            if ( ! is_shop() && ! is_product_taxonomy() ) {
                if ( ! $check_shop ) return;
            }
            if ( ! is_single() ) {

                echo apply_filters( 'bzotech_output_content', $args['before_widget'] );
                if ( ! empty( $instance['title'] ) ) {
                    echo apply_filters( 'bzotech_output_content', $args['before_title'] )
                        . apply_filters( 'widget_title', $instance['title'] )
                        . $args['after_title'];
                }

                // ✅ Fetch only sub-brands of parent "lego"
                $lego_term = get_term_by( 'slug', 'lego', 'product_brand' );
                $brands    = array();
                if ( $lego_term && ! is_wp_error( $lego_term ) ) {
                    $brands = get_terms( array(
                        'taxonomy'   => 'product_brand',
                        'hide_empty' => false,
                        'parent'     => $lego_term->term_id,
                    ) );
                }

                // error_log( "BRANDS: ". print_r($brands, true)  );
                echo '<ul>';
                foreach ( $brands as $brand) {

                    $instock_query = new WP_Query( array(
                        'post_type'      => 'product',
                        'posts_per_page' => -1,
                        'fields'         => 'ids',
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'product_brand',
                                'field'    => 'slug',
                                'terms'    => $brand->slug,
                            ),
                        ),
                        'meta_query'     => array(
                            array(
                                'key'     => '_stock_status',
                                'value'   => 'instock',
                            ),
                        ),
                    ) );

                    $instock_count = $instock_query->found_posts;
        
                    if (  $instock_count > 0 ) {
                        echo '<li><h3><a data-cat="' . esc_attr( $brand->slug ) . '" href="' . esc_url( bzotech_get_filter_url( 'product_brand', $brand->slug ) ) . '" class="load-shop-ajax ' . $active . '"> ' . esc_html( $brand->name ) . '</a></h3><span class="smoke">(' . $instock_count . ')</span></li>';
                    }

                }
                echo '</ul>';
                echo apply_filters( 'bzotech_output_content', $args['after_widget'] );
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
            if(is_object($category)) $category = json_decode(json_encode($category), true);
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:' ,'bw-kidxtore'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <p>
                <label>
                    <?php 
                    // esc_html_e( 'Categories:' ,'bw-kidxtore'); 
                    ?>
                </label></br>
                <?php 
                $cats = get_terms('product_brand');
                if(is_array($cats) && !empty($cats)){
                    foreach ($cats as $cat) {
                        if(in_array($cat->slug, $category)) $checked = 'checked="checked"';
                        else $checked = '';
                        echo '<input '.$checked.' id="'.esc_attr($this->get_field_id( 'category' )).'" type="checkbox" name="'.esc_attr($this->get_field_name( 'category' )).'[]" value="'.esc_attr($cat->slug).'"><span>'.$cat->name.'</span>';
                    }
                }
                else echo esc_html__("No any category.",'bw-kidxtore');
                ?>
            </p>            
        <?php
        }
    }

    Bzotech_SubLego_Filter::_init();

}
