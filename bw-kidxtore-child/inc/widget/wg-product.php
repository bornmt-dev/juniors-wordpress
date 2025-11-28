<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18/11/2016
 * Time: 9:18 SA
 */
if ( !class_exists('WC_Product') ) {
    return;
}

if(!class_exists('Bzotech_Widget_Product_Slider_Child')) {
    class Bzotech_Widget_Product_Slider_Child extends WC_Widget
    {
        static function _init()
        {
            add_action('widgets_init', array(__CLASS__, '_add_widget'));
        }

        static function _add_widget()
        {
            if(function_exists('bzotech_reg_widget')) bzotech_reg_widget( 'Bzotech_Widget_Product_Slider_Child' );

        }

        /**
         * Constructor.
         */
        public function __construct()
        {
            $this->widget_cssclass = 'woocommerce widget widget-product-slider poroduct-type';
            $this->widget_description = esc_html__('Display a list of your products on your site.', 'bw-kidxtore');
            $this->widget_id = 'Bzotech_Widget_Product_Slider_Child';
            $this->widget_name = esc_html__('BZOTECH Products slider Child', 'bw-kidxtore');

            parent::__construct();
        }

        /**
         * Updates a particular instance of a widget.
         *
         * @see WP_Widget->update
         *
         * @param array $new_instance
         * @param array $old_instance
         *
         * @return array
         */
        public function update($new_instance, $old_instance)
        {
            $this->init_settings();

            return parent::update($new_instance, $old_instance);
        }

        public function form($instance)
        {
            $this->init_settings();

            parent::form($instance);
        }

        /**
         * Init settings after post types are registered.
         */
        public function init_settings()
        {

            $category_array = array();
            $tags = get_terms('product_cat');
            if(is_array($tags) && !empty($tags)){
                foreach ($tags as $tag) {
                    $category_array['bzotech_cart_'.$tag->slug]=array(
                        'type' => 'checkbox',
                        'std' => $tag->slug,
                        'label' => $tag->name,
                        'class' => 'bzotech_cat_admin',
                    );
                }
            }
            $this->settings = array_merge(
                array(
                    'title'  => array(
                        'type'  => 'text',
                        'std'   => esc_html__( 'Products list', 'bw-kidxtore' ),
                        'label' => esc_html__( 'Title', 'bw-kidxtore' ),
                    ),
                    'number_post'  => array(
                        'type'  => 'text',
                        'std'   => '8',
                        'label' => esc_html__( 'Number post (Default: 8)', 'bw-kidxtore' ),
                    ),
                    'product_type' => array(
                        'type'  => 'select',
                        'std'   => '',
                        'label' => esc_html__( 'Product type', 'bw-kidxtore' ),
                        'options' => array(
                            '' => esc_html__('Default','bw-kidxtore'),
                            'trending'  =>  esc_html__('Trending','bw-kidxtore'),
                            'featured'  =>  esc_html__('Featured Products','bw-kidxtore'),
                            'bestsell'  =>  esc_html__('Best Sellers','bw-kidxtore'),
                            'onsale'  =>  esc_html__('On Sale','bw-kidxtore'),
                            'toprate'  =>  esc_html__('Top rate','bw-kidxtore'),
                            'mostview'  =>  esc_html__('Most view','bw-kidxtore'),
                        ),
                    ),
                    'title_category' => array(
                        'type'  => 'text',
                        'std'   => '',
                        'class' => 'bzotech_title_filter_category_admin',
                        'label' => esc_html__( 'Filter by category (Default get all)', 'bw-kidxtore' ),
                    ),

                ),
                $category_array,
                array(
                    'order_by' => array(
                        'type'  => 'select',
                        'std'   => '',
                        'class' => 'bzotech_order_by_admin',
                        'label' => esc_html__( 'Order by', 'bw-kidxtore' ),
                        'options' => array(
                            'none'   => esc_html__('None','bw-kidxtore'),
                            'ID'  => esc_html__('Post ID','bw-kidxtore'),
                            'author' => esc_html__('Author','bw-kidxtore'),
                            'title' => esc_html__('Post Title','bw-kidxtore'),
                            'name' => esc_html__('Post Name','bw-kidxtore'),
                            'date' => esc_html__('Post Date','bw-kidxtore'),
                            'modified' => esc_html__('Last Modified Date','bw-kidxtore'),
                            'parent' => esc_html__('Post Parent','bw-kidxtore'),
                            'rand' => esc_html__('Random','bw-kidxtore'),
                            'comment_count' => esc_html__('Comment Count','bw-kidxtore'),
                            'post_views' => esc_html__('View Post','bw-kidxtore'),
                            'rating' => esc_html__('Rating Product','bw-kidxtore'),
                            'price' => esc_html__('Sort by price','bw-kidxtore'),
                        ),
                    ),
                    'order' => array(
                        'type'  => 'select',
                        'std'   => 'DESC',
                        'label' => esc_html__( 'Order', 'bw-kidxtore' ),
                        'options' => array(
                            'DESC' => esc_html__( 'Descending', 'bw-kidxtore' ),
                            'ASC'  => esc_html__( 'Ascending', 'bw-kidxtore' ),
                        ),
                    ),

                    'number_row' => array(
                        'type'  => 'text',
                        'std'   => '4',
                        'label' => esc_html__( 'Number product in item silder (Default: 4)', 'bw-kidxtore' ),
                    ),
                    'image_size' => array(
                        'type'  => 'text',
                        'std'   => '',
                        'label' => esc_html__( 'Custom image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme. Alternatively enter size in pixels : 200x100 (Width x Height))', 'bw-kidxtore' ),
                    ),
                )
            );
        }

        /**
         * Output widget.
         *
         * @see WP_Widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget($args, $instance)
        {
            // Get selected category slugs
            $selected_categories = array();
            foreach ($instance as $key => $value) {
                if (strpos($key, 'bzotech_cart_') === 0 && $value) {
                    $slug = str_replace('bzotech_cart_', '', $key);
                    $selected_categories[] = $slug;
                }
            }

            // Default number of posts
            $number_posts = !empty($instance['number_post']) ? intval($instance['number_post']) : 5;

            // Unique transient key based on widget ID + selected categories
            $transient_key = 'bzotech_slider_' . md5($this->id . implode(',', $selected_categories) . $number_posts);

            // Try to get cached output
            $output = get_transient($transient_key);

            if (false === $output) {
                // WP_Query meta_query to only show in-stock products with featured image
                $meta_query = array(
                    'relation' => 'AND',
                    array(
                        'key'     => '_stock_status',
                        'value'   => 'instock',
                        'compare' => '='
                    ),
                    array(
                        'key'     => '_thumbnail_id',
                        'compare' => 'EXISTS'
                    )
                );

                // WP_Query arguments
                $query_args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => $number_posts,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'meta_query'     => $meta_query
                );

                // If category selected, filter by category
                if (!empty($selected_categories)) {
                    $query_args['tax_query'] = array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'slug',
                            'terms'    => $selected_categories,
                        ),
                    );
                }

                $products = new WP_Query($query_args);

                // Start output buffering
                ob_start();

                if ($products->have_posts()) : ?>
                    <div id="bzotech_widget_product_slider-<?php echo esc_attr($this->id); ?>" class="sidebar-widget widget woocommerce widget widget-product-slider poroduct-type">
                        <h2 class="widget-title"><?php echo !empty($instance['title']) ? esc_html($instance['title']) : 'Products'; ?></h2>
                        <div class="wg-product-slider">
                            <?php while ($products->have_posts()) : $products->the_post(); 
                                global $product; ?>
                                <div class="swiper-slide">
                                    <div class="item-product item-product-wg flex-wrapper">
                                        <div class="product-thumb">
                                            <a href="<?php the_permalink(); ?>" class="product-thumb-link">
                                                <?php echo $product->get_image('medium'); ?>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h3 class="product-title">
                                                <a class="color-title" href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <div class="product-price price">
                                                <?php echo $product->get_price_html(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <?php
                    wp_reset_postdata();
                else :
                    echo '<p>' . esc_html__('No products found', 'bw-kidxtore') . '</p>';
                endif;

                // Save output to transient for 5 minutes
                $output = ob_get_clean();
                set_transient($transient_key, $output, 5 * MINUTE_IN_SECONDS);
            }

            // Output cached content
            echo $output;
        }



    }
    Bzotech_Widget_Product_Slider_Child::_init();
}