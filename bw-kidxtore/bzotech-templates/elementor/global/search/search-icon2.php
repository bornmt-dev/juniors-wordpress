<?php
namespace Elementor;
extract($settings);
$icon_search_default = bzotech_get_icon_svg('icon_search_default');
$icon_search_default_white = bzotech_get_icon_svg('icon_search_default_white');
?>
<div class="elbzotech-search-wrap-global elbzotech-search-global-icon <?php echo 'elbzotech-search-global-'.esc_attr($settings['style'].' live-search-'.$live_search)?>">
	
	<div class="search-icon-popup">
		<?php if(!empty( $icon_popup['value'])) Icons_Manager::render_icon( $icon_popup, [ 'aria-hidden' => 'true' ] );
		else echo apply_filters('bzotech_output_content',$icon_search_default);?>
	</div>
	<div class="elbzotech-search-form-wrap">
		<i class="la la-close elbzotech-close-search-form-global"></i>
		<div class="content-form-popup">

			<form class="elbzotech-search-form <?php echo esc_attr($align_form)?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php echo '<h3 class="text-center title34 font-regular font-title">'.esc_html__('Search For Products','bw-kidxtore').'</h3>'; ?>
		       	<div class="input-submit-form flex-wrapper align_items-stretch">
			        <input name="s" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" value="<?php echo esc_attr($settings['placeholder']);?>" type="text" autocomplete="off">

			        <?php if($search_in != 'all'):?>
			            <input type="hidden" name="post_type" value="<?php echo esc_attr($search_in)?>" />
			        <?php endif;?>
			        <div class="elbzotech-submit-form">
			            <button type="submit" value="" class="elbzotech-text-bt-search">
				            <?php if($settings['search_bttext'] && $settings['search_bttext_pos'] == 'before-icon') echo '<span>'.$settings['search_bttext'].'</span>'?>
			            	<?php 
		            		if(!empty( $icon_popup['value'])) Icons_Manager::render_icon( $icon_popup, [ 'aria-hidden' => 'true' ] );
							else echo apply_filters('bzotech_output_content',$icon_search_default);
			            	
							?>
				            	
				            	<?php if($settings['search_bttext'] && $settings['search_bttext_pos'] == 'after-icon') echo '<span>'.$settings['search_bttext'].'</span>'?>
			            </button>
			        </div>
			    </div>
		        <?php if($show_cat == 'yes' && $search_in != 'all'):?>
		            <div class="dropdown-box-cate flex-wrapper ">
		                <span class="title-cate color-title font-semibold">
		                	<?php echo esc_html__('Categories search','bw-kidxtore')?>		                		
		                </span>
		                <ul class="list-none">
		                    <li class="active"><a class="select-cat-search" href="#" data-filter=""><?php echo esc_html($title_cat)?></a></li>
		                    <?php
		                        $taxonomy = 'category';
		                        $tax_key = 'category_name';
		                        if($search_in == 'product') $taxonomy = $tax_key = 'product_cat';
		                        if(!empty($cats)){
		                            $custom_list = explode(",",$cats);
		                            foreach ($custom_list as $key => $cat) {
		                                $term = get_term_by( 'slug',$cat, $taxonomy );
		                                if(!empty($term) && is_object($term)){
		                                    if(!empty($term) && is_object($term)){
		                                        echo '<li><a class="select-cat-search" href="#" data-filter="'.$term->slug.'">'.$term->name.'</a></li>';
		                                    }
		                                }
		                            }
		                        }
		                        else{
		                            $product_cat_list = get_terms($taxonomy);
		                            if(is_array($product_cat_list) && !empty($product_cat_list)){
		                                foreach ($product_cat_list as $cat) {
		                                    echo '<li><a class="select-cat-search" href="#" data-filter="'.$cat->slug.'">'.$cat->name.'</a></li>';
		                                }
		                            }
		                        }
		                    ?>
		                </ul>
		            </div>
		            <input class="cat-value" type="hidden" name="<?php echo esc_attr($tax_key)?>" value="" />
		        <?php endif;?>
		        <div class="elbzotech-list-product-search">
			        <div class="content-list-product-search">
			            <p class="text-center"><?php esc_html_e("Please enter key search to display results.",'bw-kidxtore')?></p>
			        </div>
		        </div>
		    </form>
		</div>
	</div>
</div>