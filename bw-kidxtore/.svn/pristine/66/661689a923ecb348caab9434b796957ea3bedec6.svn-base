<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package htvietnam
 */
$page_id = bzotech_get_option('bzotech_404_page');

if(!empty($page_id)){	
	$style = bzotech_get_option('bzotech_404_page_style');
	if($style == 'full-width') {
		get_header('none');
		echo Bzotech_Template::get_vc_pagecontent($page_id);
		get_footer('none');
	}
	else{
		get_header(); ?>
		<div id="main-content" class="main-page-default">
		    <div class="bzotech-container">
				<?php echo Bzotech_Template::get_vc_pagecontent($page_id);?>
			</div>
		</div>
		<?php get_footer();
	}
}
else{
	get_header(); ?>
	<div id="main-content" class="main-page-default">
	    <div class="bzotech-container">
	    	<div class="content-default-404">
		    	<div class="bzotech-row">
		    		<div class="bzotech-col-md-12">
		    			<div class="icon-404 text-center">
		    				
		    				<h2 class="title120 font-bold main-color"><?php esc_html_e("404",'bw-kidxtore'); ?></h2>
		    				<h3 class="text title48 font-semibold font-title"><?php esc_html_e("Oops, you got the wrong result!",'bw-kidxtore')?></h3>
		    				<p class="desc title20 font-medium"><?php esc_html_e("The page you requested could not be found.",'bw-kidxtore')?></p>
		    				<a href="<?php echo esc_url(home_url('/'))?>" class="elbzotech-bt-default"><?php esc_html_e("Back to home",'bw-kidxtore')?></a>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		</div>
	</div>
	<?php get_footer(); 
}
