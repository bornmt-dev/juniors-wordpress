<?php
/**
 * Created by Sublime Text 3.
 * Date: 13/08/15
 * Time: 10:20 AM
 */
/*Set style default*/
global $bzotech_demo;
if($bzotech_demo == '6'){
    $main_color = '#ff67b0';
    $main_color2 = '#ffcc69'; /* main 000 50% */
    $gray_color = '#454545'; 
    $border_color = '#D6D6D6';
    $body_bg = '#ffffff';    
    $preload_bg = $main_color;
    $container_width = '1560px';
    /* 1440 + 120 */
    $gutter = '15px';
    $title_typo = array('font-family'=>'Fredoka','color'=>'#454545');
    $body_typo = array('font-family'=>'Nunito','color'=>'#727272','font-size'=>'14px','line-height'=>'24px');
    $letter_spacing_body = '0.0025em'; 
} 
if($bzotech_demo == '3'){
    $main_color = '#737FF6';
    $main_color2 = '#3A407B'; /* main 000 50% */
    $gray_color = '#454545'; 
    $border_color = '#D6D6D6';
    $body_bg = '#ffffff';    
    $preload_bg = $main_color;
    $container_width = '1560px';
    /* 1440 + 120 */
    $gutter = '15px';
    $title_typo = array('font-family'=>'Fredoka','color'=>'#454545');
    $body_typo = array('font-family'=>'Poppins','color'=>'#727272','font-size'=>'14px','line-height'=>'24px');
    $letter_spacing_body = '0.0025em'; 
} 
else if($bzotech_demo == '2'){
    $main_color = '#FF90BD';
    $main_color2 = '#70BBFF';
    $gray_color = '#454545';
    $border_color = '#D6D6D6';
    $body_bg = '#ffffff';
    $preload_bg = $main_color;
    $container_width = '1560px';
    /* 1440 + 120 */
    $gutter = '15px';
    $title_typo = array('font-family'=>'Fredoka','color'=>'rgb(56, 94, 128)');
    $body_typo = array('font-family'=>'Poppins','color'=>'#727272','font-size'=>'14px','line-height'=>'24px');
    $letter_spacing_body = '0.0025em'; 
} else{

    $main_color = '#FF8C22';
    $main_color2 = '#FF8C22';
    $gray_color = '#454545';
    $border_color = '#D6D6D6';
    $body_bg = '#ffffff';
    $preload_bg = $main_color;
    $container_width = '1560px';
    /* 1440 + 120 */
    $gutter = '15px';
    $title_typo = array('font-family'=>'Fredoka','color'=>'#111');
    $body_typo = array('font-family'=>'Poppins','color'=>'#727272','font-size'=>'14px','line-height'=>'24px');
    $letter_spacing_body = '0.0025em'; 
}


/*Get style default*/
$get_main_color = bzotech_get_value_by_id('main_color');
$get_main_color2 = bzotech_get_value_by_id('main_color2');
$get_body_bg = bzotech_get_value_by_id('body_bg');
$get_container_width = bzotech_get_value_by_id('container_width');

$get_preload_bg = bzotech_get_option('preload_bg');

/*Structure var() : var(--bzo-$key-$name_attribute)*/
$body_typography = bzotech_get_css_option_array_type('body_typo',$body_typo);
$title_typography = bzotech_get_css_option_array_type('title_typo',$title_typo);


if(!empty($get_main_color)){
    $preload_bg=$get_main_color;
    $main_color = $get_main_color;
} 
if(!empty($get_main_color2)) $main_color2 = $get_main_color2;
if(!empty($get_body_bg)) $body_bg = $get_body_bg;
if(!empty($get_container_width)) $container_width = $get_container_width;
if(!empty($get_preload_bg)) $preload_bg = $get_preload_bg;

$main_color_mix_white = bzotech_mix_color($main_color,'#fff','1',0.8);
$main_color_mix_white2 = bzotech_mix_color($main_color,'#fff','1',0.65);
$main_color_mix_white_bg = bzotech_mix_color($main_color,'#fff','1',0.15);
$main_color2_mix = bzotech_mix_color($main_color2,'#fff','1',0.30);
$main_color_darken = bzotech_mix_color($main_color,'#000','1',0.8);
$style = ':root {
            --bzo-main-color: ' . $main_color . ';
            --bzo-main-color2: ' . $main_color2 . ';
            --bzo-main-color-mix: ' . $main_color_mix_white . ';
            --bzo-main-color-mix2: ' . $main_color_mix_white2 . ';
            --bzo-main-color-mix-bg: ' . $main_color_mix_white_bg . ';
            --bzo-main-color2-mix: ' . $main_color2_mix . ';
            --bzo-gray-color: ' . $gray_color . ';
            --bzo-border-color: ' . $border_color . ';
            --bzo-main-color-darken: ' . $main_color_darken . ';
            --bzo-body-background: ' . $body_bg . ';
            --bzo-container-width: ' . $container_width . ';
            --bzo-preload-background: ' . $preload_bg . '; 
            --bzo-gutter: ' . $gutter . ';
            --bzo-gutter-minus: -' . $gutter . ';
            --bzo-letter-spacing-body: ' . $letter_spacing_body . ';
           '.$body_typography.'
           '.$title_typography.'
        }';
if(!empty($style)) echo apply_filters('bzotech_output_root_css',$style);