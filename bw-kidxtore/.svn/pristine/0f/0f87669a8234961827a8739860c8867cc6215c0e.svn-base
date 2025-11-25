<?php
namespace Elementor;
use Bzotech_Template;
$type_active_temp = $type_active;
$column_temp = $column;
extract($settings);
$type_active = $type_active_temp;
$column = $column_temp;


$slug = $item_style;
if($view == 'grid' && $type_active == 'list'){
	$view = $type_active;
	$slug = $item_list_style;
    $item_thumbnail = $item_thumbnail_list;
    $item_title = $item_title_list;
    $item_excerpt = $item_excerpt_list;
    $excerpt_list = $excerpt_list;
    $item_button = $item_button_list;
    $item_meta = $item_meta_list;
    $item_meta_select = $item_meta_select_list;
}
$attr = array(
    'item_wrap'         => $item_wrap,
    'item_inner'        => $item_inner,
    'type_active'       => $type_active,
    'button_icon_pos'   => $button_icon_pos,
    'button_icon'       => $button_icon,
    'button_text'       => $button_text,
    'size'              => $size,
    'size_list'         => $size_list,
    'excerpt'           => $excerpt,
    'column'            => $column,
    'item_style'        => $item_style,
    'item_list_style'   => $item_list_style,
    'excerpt_list'      => $excerpt_list,
    'view'              => $view,
    'item_thumbnail'    => $item_thumbnail,
    'item_title'        => $item_title,
    'item_excerpt'      => $item_excerpt,
    'item_button'       => $item_button,
    'item_meta'         => $item_meta,
    'item_meta_select'  => $item_meta_select,
    'thumbnail_hover_animation'     => $thumbnail_hover_animation,
);
$wdata->add_render_attribute( 'elbzotech-wrapper', 'class', ' blog-'.$view.'-post-item-'.$slug);

if($show_top_filter == 'yes')
echo bzotech_get_template('top-filter','',array('style'=>$type_active,'number'=>$number,'count_query'=>$post_query->found_posts,'show_number'=>$show_number,'show_type'=>$show_type,'column_style_type'=>$column_style_type));
$dem=1;
?>
<?php echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-wrapper' ).'>';?>
	<?php echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-inner' ).'>';?>
    	<?php 
    	if($post_query->have_posts()) {
            while($post_query->have_posts()) {                
                $post_query->the_post();
                $attr['dem'] = $dem;
                if($dem == 1 || $dem % 7 == 1 || $dem % 7 == 4|| $dem % 7 == 5)
                echo'<div class="group bzotech-col-sx-4">'; 
                if($dem % 7==4){  ?>
                    <div class="post-item-group-main">
                        <?php if(has_post_thumbnail()):?>
                            <div class="post-thumb">
                                <a href="<?php echo esc_url(get_the_permalink()) ?>" class="adv-thumb-link elementor-animation-<?php echo esc_attr($thumbnail_hover_animation)?>">
                                    <?php echo get_the_post_thumbnail(get_the_ID(),array(460,475)); ?>
                                </a>
                            </div>
                        <?php endif?>
                        <div class="post-info">
                            <?php bzotech_display_metabox('detail-post',['date'],'','color-white'); ?>
                            <h3 class="title26 post-title font-bold "><a class="color-white" href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?></a></h3>
                            <div class="author-read-more flex-wrapper justify_content-space-between align_items-center">
                               <?php bzotech_display_metabox('',['author'],'','color-white'); ?>
                               <a class="read-more color-white" href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo esc_html__('Read More','bw-kidxtore')?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }else{ ?>

                    <div class="post-item-group bzotech-col-sx-4 flex-wrapper">
                        <?php if(has_post_thumbnail()):?>
                            <div class="post-thumb">
                                <a href="<?php echo esc_url(get_the_permalink()) ?>" class="adv-thumb-link elementor-animation-<?php echo esc_attr($thumbnail_hover_animation)?>">
                                    <?php echo get_the_post_thumbnail(get_the_ID(),array(208,138)); ?>
                                </a>
                            </div>
                        <?php endif?>
                        <div class="post-info">
                            <?php bzotech_display_metabox('detail-post',['date']); ?>
                            <h3 class="title20 post-title font-bold"><a class="color-title" href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?></a></h3>
                           <?php bzotech_display_metabox('',['author']); ?>
                        </div>
                    </div>
                    <?php

                }

                if($dem == $count_query ||$dem % 7 == 3||$dem % 7 == 4|| $dem % 7 == 0)
                echo'</div>';
                $dem = $dem+1;
    		}
    	}
    	?>
	</div>
	<?php
	if($pagination == 'load-more' && $max_page > 1){
        $data_load = array(
            "args"        => $args,
            "attr"        => $attr,
            );
        $data_loadjs = json_encode($data_load);
        echo    '<input type="hidden" name="load-more-post-ajax-nonce" class="load-more-post-ajax-nonce" value="' . wp_create_nonce( 'load-more-post-ajax-nonce' ) . '" /><div class="btn-loadmore">
                    <a href="#" class="blog-loadmore loadmore elbzotech-bt-default elbzotech-bt-medium" 
                        data-load="'.esc_attr($data_loadjs).'" data-paged="1" 
                        data-maxpage="'.esc_attr($max_page).'">
                        '.esc_html__("Load more",'bw-kidxtore').'
                    </a>
                </div>';
    }
    if($pagination == 'pagination') bzotech_paging_nav($post_query,'',true);
	?>
</div>