<?php
/**
 * The template for displaying all single posts.
 *
 * @package BzoTech-Framework
 */

get_header();
do_action('bzotech_before_main_content');
?>
<div id="main-content"  class="single-course">
    <div class="bzotech-container">
        <div class="bzotech-row">
            <div class=" bzotech-col-lg-12 bzotech-col-md-12 bzotech-col-sm-12 bzotech-col-xs-12">
                <?php
                
                while ( have_posts() ) : the_post();
                    global $post;
                    echo '<div class="content-single-course">';

                         ?>
                        <div class="content-course-default">
                            <?php
                            if( ! empty( $post->post_title ) ){ ?>
                                 <h2 class="title48 font-title title-post-single color-title text-capitalize">
                                    <?php the_title()?>
                                </h2>
                            <?php }?>
                            <?php 
                           	if (has_post_thumbnail()) { ?>
							    <div class="single-course-media-format">
							        <div class="format-standard banner-advs">
							            <?php echo get_the_post_thumbnail(get_the_ID(),'full'); ?>
							        </div>
							    </div>
							    <?php
							}
                            ?>  
                            <div class="bzotech-row list-meta-course">
                            	<div class=" bzotech-col-lg-4 bzotech-col-md-4 bzotech-col-sm-6 bzotech-col-xs-12">
                            		<div class="meta-details meta-course-item">
                            			<h3 class="bg-color color-white text-center title20 font-bold"><?php echo esc_html__('Details','bw-kidxtore');?></h3>
                            			<ul>
                            				<?php
                            				$opening_date = get_post_meta(get_the_ID(), 'opening_date', true); 
                            				if(!empty($opening_date)){?>
	                            				<li>
	                            					<span class="meta-label"><?php echo esc_html__('Start:','bw-kidxtore')?></span>
	                            					<div class="meta-content"><?php echo apply_filters('bzotech_output_html',$opening_date)?></div>
	                            				</li>
	                            			<?php }?>

	                            			<?php
                            				$end_date = get_post_meta(get_the_ID(), 'end_date', true); 
                            				if(!empty($end_date)){?>
	                            				<li>
	                            					<span class="meta-label"><?php echo esc_html__('End:','bw-kidxtore')?></span>
	                            					<div class="meta-content"><?php echo apply_filters('bzotech_output_html',$end_date)?></div>
	                            				</li>
	                            			<?php }?>
	                            			<?php
                            				$study_time = get_post_meta(get_the_ID(), 'study_time', true); 
                            				if(!empty($study_time)){?>
	                            				<li>
	                            					<span class="meta-label"><?php echo esc_html__('Study time:','bw-kidxtore')?></span>
	                            					<div class="meta-content"><?php echo apply_filters('bzotech_output_html',$study_time)?></div>
	                            				</li>
	                            			<?php }?>
	                            			<?php
                            				$price_course = get_post_meta(get_the_ID(), 'price_course', true); 
                            				if(!empty($price_course)){?>
	                            				<li>
	                            					<span class="meta-label"><?php echo esc_html__('Cost:','bw-kidxtore')?></span>
	                            					<div class="meta-content"><?php echo wc_price($price_course);?></div>
	                            				</li>
	                            			<?php }?>
                            			</ul>
                            		</div>
                            	</div>
                            	<div class=" bzotech-col-lg-4 bzotech-col-md-4 bzotech-col-sm-6 bzotech-col-xs-12">
                            		<div class="meta-teacher meta-course-item">
                            			<h3 class="bg-color color-white text-center title20 font-bold"><?php echo esc_html__('Teacher','bw-kidxtore');?></h3>
                            			<?php 
                            			$terms_teacher =get_the_terms(get_the_ID(),'bzotech_courses_teacher');
                            			if(!empty($terms_teacher) && is_array($terms_teacher)){
                            				
                            				foreach ($terms_teacher as $key => $term) {
                            					if(!empty($term->term_id)){
                            						echo '<ul>';
	                            						?>
	                            						<li>
			                            					<span class="meta-label"><?php echo esc_html__('Instructors:','bw-kidxtore')?></span>
			                            					<div class="meta-content"><?php echo apply_filters('bzotech_output_html',$term->name) ?></div>
			                            				</li>
	                            						<?php
	                            						$phone = get_term_meta($term->term_id, 'phone_teacher', true);
	                            						$link_phone = get_term_meta($term->term_id, 'link_phone_teacher', true);
	                            						$email_teacher = get_term_meta($term->term_id, 'email_teacher', true);
	                            						$link_face_teacher = get_term_meta($term->term_id, 'link_face_teacher', true);
	                            						$link_twitter_teacher = get_term_meta($term->term_id, 'link_twitter_teacher', true);
	                            						$link_instagram_teacher = get_term_meta($term->term_id, 'link_instagram_teacher', true);
	                            						if(!empty($phone)){
	                            							echo '<li>
			                            					<span class="meta-label">'.esc_html__('Phone:','bw-kidxtore').'</span>
			                            					<div class="meta-content"><a href="'.esc_url($link_phone).'">'.$phone.'</a></div></li>';
	                            						}
	                            						if(!empty($email_teacher)){
	                            							echo '<li>
			                            					<span class="meta-label">'.esc_html__('Email:','bw-kidxtore').'</span>
			                            					<div class="meta-content"><a href="mailto:'.$email_teacher.'">'.$email_teacher.'</a></div></li>';
	                            						}
	                            						if(!empty($link_face_teacher)||!empty($link_twitter_teacher)||!empty($link_instagram_teacher)){
	                            							echo '<li>
			                            					<span class="meta-label">'.esc_html__('Social :','bw-kidxtore').'</span>
			                            					<div class="meta-content teacher-socials">';
			                            					if(!empty($link_face_teacher))
			                            					echo '<a href="'.esc_url($link_face_teacher).'"><i class="lab la-facebook-f"></i></a>';
			                            					if(!empty($link_twitter_teacher))
			                            					echo '<a href="'.esc_url($link_twitter_teacher).'"><i class="lab la-twitter"></i></a>';
			                            					if(!empty($link_instagram_teacher))
			                            					echo '<a href="'.esc_url($link_instagram_teacher).'"><i class="lab la-instagram"></i></a>';
			                            					echo '</div></li>';
	                            						}
                            						echo '</ul>';
                            					}
                            				}
                            				
                            			}
                            			?>
                            			
                            		</div>
                            	</div>
                            	<div class="meta-course-last bzotech-col-lg-4 bzotech-col-md-4 bzotech-col-sm-12 bzotech-col-xs-12">
                            		<div class="meta-attribute meta-course-item">
                            			<h3 class="bg-color color-white text-center title20 font-bold"><?php echo esc_html__('Other information','bw-kidxtore');?></h3>
                            			
                            			<ul>
                            				<?php
                            				$address = get_post_meta(get_the_ID(), 'address', true); 
                            				if(!empty($address)){?>
	                            				<li>
	                            					<span class="meta-label"><?php echo esc_html__('Address:','bw-kidxtore')?></span>
	                            					<div class="meta-content"><?php echo apply_filters('bzotech_output_html',$address)?></div>
	                            				</li>
	                            			<?php }?>
	                            			<?php 
	                            			$terms_attr =get_the_terms(get_the_ID(),'bzotech_courses_attribute');
	                            			if(!empty($terms_attr) && is_array($terms_attr)){	
	                            				foreach ($terms_attr as $key => $term) {
	                            					if(!empty($term->term_id)){
	                            						echo '<li>
			                            					<span class="meta-label">'.$term->name.'</span>
			                            					<div class="meta-content">'.$term->description.'</div>
			                            				</li>';
	                        						}
	                        					}
	                        				}?>
	                            			
                            			</ul>
                            		</div>
                            	</div>
                            </div>
                            <div class="detail-content-wrap clearfix"><?php the_content(); ?></div>
                        </div>
                        <?php
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bw-kidxtore' ),
                            'after'  => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                        ) );
                        bzotech_get_template( 'course/related','',false,true );
                    echo '</div>';
                endwhile; ?>
            </div>
        </div>
    </div>
</div>
<?php
do_action('bzotech_after_main_content');
get_footer();