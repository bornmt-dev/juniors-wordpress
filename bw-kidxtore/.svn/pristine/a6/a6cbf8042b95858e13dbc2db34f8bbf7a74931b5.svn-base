<?php
$check_related = bzotech_get_option('course_single_related','1');
if($check_related == '1'):
    $categories = get_the_terms(get_the_ID(),'courses_category');
    //var_dump($categories );
    $category_ids = array();
    foreach($categories as $individual_category){
        $category_ids[] = $individual_category->term_id;
    }
   
    $title_df   = esc_html__("Related Courses",'bw-kidxtore');
    $title 		= bzotech_get_option('course_single_related_title',$title_df);
    $number 	= bzotech_get_option('course_single_related_number','6');
    $size 		= bzotech_get_option('course_single_related_size','600x350');
    $itemres 	= bzotech_get_option('course_single_related_item','0:1,480:2,990:3');
    $item_style = bzotech_get_option('course_single_related_item_style');    
    $args=array(
        'post_type'         => 'bzotech_courses',
        'post__not_in' 		=> array(get_the_ID()),
        'posts_per_page'	=> (int)$number,
        );
    $args['tax_query'][]=array(
        'taxonomy'=>'courses_category',
        'field'=>'id',
        'terms'=> $category_ids
    );
    $query = new wp_query($args); 
    if($query->post_count > 0):
    ?>
    <div class="single-related-post">
    	<h3 class="single-related-post__title title48 font-title color-title">
    		<?php echo esc_html($title)?> 
    	</h3>
        <?php 
        $items_custom = bzotech_get_option('course_single_related_item','0:1,480:2,1170:3');
        $items = '2'; /*number*/
        $items_tablet = '2'; /*number*/
        $items_mobile = '1'; /*number*/
        $space = '30'; /*number px*/
        $space_tablet = ''; /*number px*/
        $space_mobile = ''; /*number px*/
        $column = ''; /*number*/
        $auto = ''; /*yes or empty*/
        $center = ''; /*yes or empty*/
        $loop = ''; /*yes or empty*/
        $speed = ''; /*number ms*/
        $navigation = 'yes'; /*yes or empty*/
        $pagination = ''; /*yes or empty*/
        $size = bzotech_get_size_crop($size);

        $item_wrap = 'class="item-grid-post-'.$item_style.' swiper-slide"';
        $item_inner = 'class="item-post"';
        $button_icon_pos = $button_icon = $item_button= $item_excerpt= '';
        $button_text = esc_html__("Read more", 'bw-kidxtore');
        $item_thumbnail = $item_title  =  $item_meta = 'yes';
        $item_meta_select = ['date','comments'];
        //$thumbnail_hover_animation = '';
        $type_active = 'grid';
        $view = 'slider';
        $excerpt = 100;
        $attr = array(
            'item_wrap'         => $item_wrap,
            'item_inner'        => $item_inner,
            'type_active'       => $type_active,
            'button_icon_pos'   => $button_icon_pos,
            'button_icon'       => $button_icon,
            'button_text'       => $button_text,
            'size'              => $size,
            'excerpt'           => $excerpt,
            'view'              => $view,
            'item_thumbnail'    => $item_thumbnail,
            'item_title'        => $item_title,
            'item_excerpt'      => $item_excerpt,
            'item_button'       => $item_button,
            //'thumbnail_hover_animation'     => $thumbnail_hover_animation,
        );
        ?>
    	<div class="related-course-slider">
            
        		<div class="elbzotech-swiper-slider swiper-container slider-nav-group-top bzotech-swiper-navi" 
                data-items-custom="<?php echo esc_attr($items_custom)?>" 
                data-items="<?php echo esc_attr($items)?>" 
                data-items-tablet="<?php echo esc_attr($items_tablet)?>" 
                data-items-mobile="<?php echo esc_attr($items_mobile)?>" 
                data-space="<?php echo esc_attr($space)?>" 
                data-space-tablet="<?php echo esc_attr($space_tablet)?>" 
                data-space-mobile="<?php echo esc_attr($space_mobile)?>" 
                data-column="<?php echo esc_attr($column)?>" 
                data-auto="<?php echo esc_attr($auto)?>" 
                data-center="<?php echo esc_attr($center)?>" 
                data-loop="<?php echo esc_attr($loop)?>" 
                data-speed="<?php echo esc_attr($speed)?>" 
                data-navigation="<?php echo esc_attr($navigation)?>" 
                data-pagination="<?php echo esc_attr($pagination)?>" 
                >
                    <div class="swiper-wrapper">
                        <?php 
                        if($query->have_posts()) {
                            while($query->have_posts()) {
                                $query->the_post();
                                echo '<div class="swiper-slide course-grid-post-item-">';
                                bzotech_get_template('course/item-course','',$attr,true);
                                echo '</div>';
                            }
                        }
                        ?>
            		</div>
                    <?php if ( $navigation == 'yes' ):?>
                        <div class="swiper-button-nav swiper-button-next"><i class="las la-angle-right"></i></div>
                        <div class="swiper-button-nav swiper-button-prev"><i class="las la-angle-left"></i></div>
                    <?php endif?>
                    <?php if ( $pagination == 'yes' ):?>
                        <div class="swiper-pagination"></div>
                    <?php endif?>
                </div>
       
    	</div>
    </div>
    <?php 
    endif;
    wp_reset_postdata();
    ?>
<?php endif?>