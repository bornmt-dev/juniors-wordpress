<?php
namespace Elementor;
use Bzotech_Template;
$type_active_temp = $type_active;
$column_temp = $column;
extract($settings);
$type_active = $type_active_temp;
$column = $column_temp;


$slug = $item_style;
$wdata->add_render_attribute( 'elbzotech-wrapper', 'class', ' course-'.$view.'-post-item-'.$slug);

$dem=1;
$dem_grid=0;
?>
<?php echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-wrapper' ).'>';?>
	<?php echo '<div '.$wdata->get_render_attribute_string( 'elbzotech-inner' ).'>';?>
    	<?php 
    	if($post_query->have_posts()) {
            while($post_query->have_posts()) {
                
                
                $post_query->the_post();
                $attr['dem'] =$dem;
                echo '<div '.$item_wrap.'>';
    			bzotech_get_template('course/item-course',$slug,null,true);
                echo '</div>';
                $dem = $dem+1;
                $dem_grid = $dem_grid+1;

                
    		}
    	}
    	?>
	</div>
	
</div>