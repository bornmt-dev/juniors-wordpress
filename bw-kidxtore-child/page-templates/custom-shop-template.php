<?php
/* Template Name: Custom Shop Page */

get_header();
?>

<?php //echo do_shortcode('[your_filter_shortcode]'); ?>
 

<?php do_action('bzotech_before_main_content')?>

<div id="main-content" class="main-page-default">
    <div class="bzotech-container">
        <div class="bzotech-row">
            <?php bzotech_output_sidebar('left')?>
            <div class="<?php echo esc_attr(bzotech_get_main_class()); ?>">
                <div class="shop-page-products-section">
                    
                    <?php
                   
                    $args = array(
                        'post_type' => 'product', 
                        'posts_per_page' => 12, 
                        'post_status' => 'publish',
                        'orderby'        => 'title', 
                        'order'          => 'ASC'  
                    );

                    
                    $query = new WP_Query($args);

                    // Start the loop
                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                            wc_get_template_part( 'content', 'product' );
                        endwhile;
                    else :
                        echo '<p>No products found for this filter.</p>';
                    endif;

                    // Reset the query to avoid conflicts
                    wp_reset_postdata();
                    ?>
                </div>
            </div> 
            <?php bzotech_output_sidebar('right')?>
        </div>
    </div>
</div>

<?php
get_footer();