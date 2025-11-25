<?php
namespace Elementor;
extract($settings);

$wdata->add_render_attribute( 'wrapper', 'class', 'bzoteche-info-box-'.$settings['style'].' item-info-box-global');

?>

<div <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('wrapper'));?>>
	
	<?php
	if(!empty($date) || !empty($date_class)){
		echo '<div class="bzotech-countdown flex-wrapper container-flex-e" data-date-selector = "'.$date_class.'" data-date="'.$date.'">';
		 echo '<div class="clock day flex-wrapper info-container-flex-e"><strong class="number title20 item-number-e">%D</strong><span class="text title20 item-title-e">'.$day.'</span></div>';
         echo '<div class="clock hour flex-wrapper info-container-flex-e"><strong class="number title20 item-number-e">%H</strong><span class="text title20 item-title-e">'.$hour.'</span></div>';
         echo '<div class="clock min flex-wrapper info-container-flex-e"><strong class="number title20 item-number-e">%M</strong><span class="text title20 item-title-e">'.$min.'</span></div>';
       	 echo '<div class="clock sec flex-wrapper info-container-flex-e"><strong class="number title20 item-number-e">%S</strong><span class="text title20 item-title-e">'.$sec.'</span></div>';
		echo '</div>';
	}
	?>

</div>

