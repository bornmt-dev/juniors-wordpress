<?php
$price_course = get_post_meta(get_the_ID(), 'price_course', true);
if(empty($size)) $size = [400,240];
?>
<div class="item-course">
	 <div class="course-thumb zoom-image">
        <a href="<?php echo esc_url(get_the_permalink()) ?>" class="adv-thumb-link">
            <?php echo get_the_post_thumbnail(get_the_ID(),$size); ?>
        </a>
    </div>
    <div class="course-info">
	    
	    <h3 class="title20 course-title font-bold"><a class="color-title" href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?></a></h3>
	    <ul class="list-none list-meta-course-item">
		    <?php
		    $opening_date = get_post_meta(get_the_ID(), 'opening_date', true); 
		    $study_time = get_post_meta(get_the_ID(), 'study_time', true); 
			$address = get_post_meta(get_the_ID(), 'address', true); 
			if(!empty($address)){
				echo '<li><i class="las la-clock"></i>
					<span class="meta-content">'.$opening_date.' - '.$study_time.'</span>
				</li>';
			} ?>
			<?php
			$address = get_post_meta(get_the_ID(), 'address', true); 
			if(!empty($address)){
				echo '<li><i class="las la-map-marker"></i>
					<span class="meta-content">'.$address.' </span>
				</li>';
			} ?>
		</ul>
		<div class="course-info-bottom flex-wrapper flex_wrap-wrap justify_content-space-between align_items-center">
			<?php echo '<div class="price-course-wrap flex-wrapper align_items-center"><span class="label-price-course">'.esc_html__('Price','bw-kidxtore').'</span><span class="price-course">'.wc_price($price_course).'</span></div>';?>
			<?php echo '<div class="btn-find-out-more"><a href="'.esc_url(get_the_permalink()).'">'.esc_html__('Find out more','bw-kidxtore').'</a></div>';?>
		</div>
	</div>
</div>