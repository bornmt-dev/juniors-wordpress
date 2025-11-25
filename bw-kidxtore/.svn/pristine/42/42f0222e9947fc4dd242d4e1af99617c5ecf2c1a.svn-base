<?php
extract($settings);

if($header_style == ''){
	/*Style Text Editor*/
	echo '<div class="elbzotech-text-editor-global text-css-e '.bzotech_implode($css_by_theme_title).'">'.bzotech_parse_text_editor($editor).'</div>';

}else{
	if(!empty($title_id)) $title=$title_id;
	$wdata->add_render_attribute( 'heading', 'class', bzotech_implode($css_by_theme_title).' container-flex-e elbzotech-heading-global font-title text-css-e font-medium title20 color-title elbzotech-heading-global-'.$settings['header_style'] );
	if($title_line == 'yes') $title_line = '<span class="'.bzotech_implode($line_css_by_theme_title).'  elbzotech-heading-global__line line-e bg-color"></span>';
	if ( !empty( $settings['link']['url'] ) ) {
			$wdata->add_link_attributes( 'url', $settings['link'] );
			
			$title = sprintf( '<a %1$s>%2$s</a>', $wdata->get_render_attribute_string( 'url' ), $title );
		}
	echo sprintf( '<%1$s %2$s>%3$s%4$s</%1$s>', $settings['header_size'], $wdata->get_render_attribute_string( 'heading' ), $title,$title_line);
	
} 