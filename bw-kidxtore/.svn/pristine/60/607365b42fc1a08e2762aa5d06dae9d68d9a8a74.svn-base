<?php
namespace Elementor;
extract($settings);
$wdata->add_render_attribute( 'wrapper', 'class', 'element-pricing-table-'.$settings['style']);
?>
<div <?php echo ''.$wdata->get_render_attribute_string('wrapper');?>>
	<?php if(!empty($label)) echo '<span class="title14 color-white label-pricing">'.$label.'</span>'; ?>
	<?php if(!empty($title)) echo '<h3 class="title18 text-uppercase title">'.$title.'</h3>'; ?>
	<?php if(!empty($price)) echo '<h3 class="title70 price">'.$price.'</h3>'; ?>
	<?php

	if(!empty($list_pricing_table) and is_array($list_pricing_table)){ ?>
		<div class="list-pricing-table">
			<?php foreach ($list_pricing_table as $key => $value) {
				if ( ! empty( $value['link']['url'] ) ) {
					$wdata->add_link_attributes( 'data_link'.$key, $value['link'] );
				}
				$wdata->add_render_attribute( 'data_link'.$key, 'class', 'item-link' );
				?>
				<?php echo '<a '.$wdata->get_render_attribute_string( 'data_link'.$key ).'>'. $value['title'].'</a>'; ?>

				
				<?php
			} ?>
		</div>
		<?php
	} 
	?>
	<?php if(!empty($button_text)) {
		$wdata->add_render_attribute( 'button-inner', 'href', $button_link['url']);
		$wdata->add_render_attribute( 'button-inner', 'class', 'button-pricing');
		echo '<a '.$wdata->get_render_attribute_string('button-inner').'>'.$button_text.'</a>';
	} ?>
</div>

