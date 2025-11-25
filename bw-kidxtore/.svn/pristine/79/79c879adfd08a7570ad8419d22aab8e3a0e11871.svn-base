<?php
if(!function_exists('bzotech_change_required')){
    function bzotech_change_required($condition){
        if(is_string($condition)){            
            $requireds = array();
            $conditions = explode(',', $condition);
            foreach ($conditions as $key => $value) {
                $value = str_replace('(on)', '(1)', $value);
                $value = str_replace('(off)', '(0)', $value);
                $value = str_replace(')', '', $value);
                $value = str_replace('is', '=', $value);
                $value = str_replace('(', ':', $value);
                $requireds[] = explode(':', $value);
            }
            $condition = $requireds;
        }
        return $condition;
    }
}
if(!function_exists('bzotech_fix_type_redux')){
    function bzotech_fix_type_redux($settings){
        switch ($settings['type']) {
            case 'checkbox':
                if(isset($settings['choices'])){
                    $vals = $settings['choices'];
                    $new_vals = array();
                    foreach ($vals as $val) {
                        $new_vals[$val['value']] = $val['label'];
                    }
                    $settings['options'] = $new_vals;
                    unset($settings['choices']); 
                }
                break;
            case 'select':
                if(isset($settings['choices'])){
                    $vals = $settings['choices'];
                    $new_vals = array();
                    foreach ($vals as $val) {
                        if(isset($val['label'])) $new_vals[$val['value']] = $val['label'];
                    }
                    $settings['options'] = $new_vals;
                    unset($settings['choices']); 
                }
                break;

            case 'on-off':
                $settings['type'] = 'switch';
                if(isset($settings['std'])){
                    if($settings['std'] == 'on') $settings['default'] = true;
                    else $settings['default'] = false;
                    unset($settings['std']);
                }
                break;

            case 'colorpicker-opacity':
                $settings['type'] = 'color_rgba';
                break;

            case 'upload':
                $settings['type'] = 'media';
                break;

            case 'background':
                if(!isset($settings['preview_media'])) $settings['preview_media'] = true;
                break;

            case 'sidebar-select':
                $settings['type'] = 'select';
                $settings['data'] = 'sidebars';
                break;

            case 'post_types':
                $settings['type'] = 'select';
                $settings['data'] = 'post_types';
                break;

            case 'numeric-slider':
                $settings['type'] = 'slider';
                $data = $settings['min_max_step'];
                $data = explode(',', $data);
                $settings['min'] = (int)$data[0];
                $settings['max'] = (int)$data[1];
                $settings['step'] = (int)$data[2];
                unset($settings['min_max_step']);
                break;

            case 'list-item':
                $settings['type'] = 'repeater';
                $data = $settings['settings'];

                foreach ($data as $item_key => $item_field) {
                    $data[$item_key] = bzotech_fix_type_redux($item_field);
                }
                $title_df = array(array(
                    'id'       => 'title',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Title', 'bw-kidxtore' ),
                ));
                $settings['fields'] = array_merge($title_df,$data);
                unset($settings['settings']);
                break;
            
            default:
                
                break;
        }
        // change title
        if(isset($settings['label'])){
            $settings['title'] = $settings['label'];
            unset($settings['label']);
        } 
        // change default
        if(isset($settings['std'])){
            $settings['default'] = $settings['std'];
            unset($settings['std']);
        }

        // change require
        if(isset($settings['condition'])){
            $settings['required'] = bzotech_change_required($settings['condition']);
            unset($settings['condition']);
        }

        return $settings;
    }
}

if(class_exists('Redux')){
    $bzotech_option_name = bzotech_get_option_name();
    add_filter("redux/metaboxes/".$bzotech_option_name."/boxes", "bzotech_custom_meta_boxes");
}
else add_action('admin_init', 'bzotech_custom_meta_boxes');
if(!function_exists('bzotech_register_metabox')){
    function bzotech_register_metabox($settings){
        foreach ($settings as $key => $setting) {
            if(is_array($setting['fields'])){
                $new_options = [];
                foreach ($setting['fields'] as $keyf => $field) {                    
                    $stemp = bzotech_fix_type_redux($field);
                    if($field['type'] == 'tab'){
                        $tab_id = $field['id'];
                        $new_options[$tab_id] = array_merge($new_options,$stemp);
                        if(!isset($new_options[$tab_id]['icon'])) $new_options[$tab_id]['icon'] = '';
                    }
                    else{
                        if(!isset($tab_id)) $tab_id = 0;
                        $new_options[$tab_id]['fields'][] = $stemp;
                    }
                }
            }
            if(isset($new_options['title'])) $new_options['icon'] = '';
            unset($new_options['type']);
            $new_options2 = array();
            foreach ($new_options as $key2 => $value) {
                $new_options2[] = $new_options[$key2];
            }
            $settings[$key]['post_types'] = $settings[$key]['pages'];
            $settings[$key]['position'] = $settings[$key]['context'];
            $settings[$key]['sections'] = $new_options2;
            unset($settings[$key]['fields']);
            unset($settings[$key]['pages']);
            unset($settings[$key]['context']);
        }
        return $settings;
    }
}
if(!function_exists('bzotech_custom_meta_boxes')){
    function bzotech_custom_meta_boxes(){
        
        $format_metabox = array(
            'id'        => 'block_format_content',
            'title'     => esc_html__('Format Settings', 'bw-kidxtore'),
            'desc'      => '',
            'pages'     => array('post'),
            'context'   => 'normal',
            'priority'  => 'high',
            'fields'    => array(    
                array(
                    'id'         => 'bzotech_style_post_detail',
                    'label'      => esc_html__('Style Single Post','bw-kidxtore'),
                    'type'       => 'select',
                    'std'=>'',
                    'choices'    => array(
                        array(
                            'label' => esc_html__('--Select--','bw-kidxtore'),
                            'value' => '',
                        ),
                        array(
                            'label' => esc_html__('default','bw-kidxtore'),
                            'value' => 'style1'
                        ),
                        array(
                            'label' => esc_html__('Style 2','bw-kidxtore'),
                            'value' => 'style2'
                        ),
                    ),
                ),    
                array(
                    'id'        => 'format_gallery',
                    'label'     => esc_html__('Add Gallery', 'bw-kidxtore'),
                    'type'      => 'gallery',
                    'desc'      => esc_html__('Choose images from media.','bw-kidxtore'),
                ),
                array(
                    'id'        => 'format_media',
                    'label'     => esc_html__('Link Media', 'bw-kidxtore'),
                    'type'      => 'text',
                    'desc'      => esc_html__('Enter media url(Youtube, Vimeo, SoundCloud ...).','bw-kidxtore'),
                ),
            ),
        );
        // SideBar
        $page_settings = array(
            'id'        => 'bzotech_sidebar_option',
            'title'     => esc_html__('Page Settings','bw-kidxtore'),
            'pages'     => array( 'page','post','product'),
            'context'   => 'normal',
            'priority'  => 'low',
            'fields'    => array(
                // General tab
                array(
                    'id'        => 'page_general',
                    'type'      => 'tab',
                    'label'     => esc_html__('General Settings','bw-kidxtore')
                ),
                array(
                    'id'        => 'bzotech_header_page',
                    'label'     => esc_html__('Choose page header','bw-kidxtore'),
                    'type'      => 'select',
                    'std'=>'',
                    'options'   => bzotech_list_post_type('bzotech_header'),
                    'desc'      => esc_html__('Include Header content. Go to Header page in admin menu to edit/create header content. Default is value of Theme Option.','bw-kidxtore'),
                ),
                array(
                    'id'         => 'bzotech_footer_page',
                    'label'      => esc_html__('Choose page footer','bw-kidxtore'),
                    'type'       => 'select',
                    'std'=>'',
                    'options'    => bzotech_list_post_type('bzotech_footer'),
                    'desc'       => esc_html__('Include Footer content. Go to Footer page in admin menu to edit/create footer content. Default is value of Theme Option.','bw-kidxtore'),
                ),
                array(
                    'id'         => 'bzotech_sidebar_position',
                    'label'      => esc_html__('Sidebar position ','bw-kidxtore'),
                    'type'       => 'select',
                    'choices'    => array(
                        array(
                            'label' => esc_html__('--Select--','bw-kidxtore'),
                            'value' => '',
                        ),
                        array(
                            'label' => esc_html__('No Sidebar','bw-kidxtore'),
                            'value' => 'no'
                        ),
                        array(
                            'label' => esc_html__('Left sidebar','bw-kidxtore'),
                            'value' => 'left'
                        ),
                        array(
                            'label' => esc_html__('Right sidebar','bw-kidxtore'),
                            'value' => 'right'
                        ),
                    ),
                    'desc'      => esc_html__('Choose sidebar position for current page/post(Left,Right or No Sidebar).','bw-kidxtore'),
                ),
                array(
                    'id'        => 'bzotech_select_sidebar',
                    'label'     => esc_html__('Selects sidebar','bw-kidxtore'),
                    'type'      => 'sidebar-select',
                    'condition' => 'bzotech_sidebar_position:not(no),bzotech_sidebar_position:not()',
                    'desc'      => esc_html__('Choose a sidebar to display.','bw-kidxtore'),
                ),
                array(
                    'id'         => 'bzotech_sidebar_style',
                    'label'      => esc_html__('Sidebar style ','bw-kidxtore'),
                    'type'       => 'select',
                    'condition' => 'bzotech_sidebar_position:not(no),bzotech_sidebar_position:not()',
                    'choices'    => array(
                        array(
                            'label' => esc_html__('--Select--','bw-kidxtore'),
                            'value' => '',
                        ),
                        array(
                            'label' => esc_html__('Default','bw-kidxtore'),
                            'value' => 'default'
                        ),
                        array(
                            'label' => esc_html__('Style 2','bw-kidxtore'),
                            'value' => 'style2'
                        ),
                    ),
                    'desc'      => esc_html__('Choose sidebar style for current page/post.','bw-kidxtore'),
                ),
                array(
                    'id'          => 'before_append',
                    'label'       => esc_html__('Append content before','bw-kidxtore'),
                    'type'        => 'select',
                    'std'=>'',
                    'options'     => bzotech_list_post_type('bzotech_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to before main content of page/post.','bw-kidxtore'),
                ),
                array(
                    'id'          => 'after_append',
                    'label'       => esc_html__('Append content after','bw-kidxtore'),
                    'type'        => 'select',
                    'std'=>'',
                    'options'     => bzotech_list_post_type('bzotech_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to after main content of page/post.','bw-kidxtore'),
                ),
                array(
                    'id'          => 'show_title_page',
                    'label'       => esc_html__('Show title', 'bw-kidxtore'),
                    'type'        => 'on-off',
                    'std'         => 'on',
                    'desc'        => esc_html__('Show/hide title of page.','bw-kidxtore'),
                ),
                array(
                    'id' => 'post_single_page_share',
                    'label' => esc_html__('Show Share Box', 'bw-kidxtore'),
                    'type' => 'select',
                    'std'   => '',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('--Theme Option--','bw-kidxtore'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('On','bw-kidxtore'),
                            'value'=>'1'
                        ),
                        array(
                            'label'=>esc_html__('Off','bw-kidxtore'),
                            'value'=>'0'
                        ),
                    ),
                    'desc'        => esc_html__( 'You can show/hide share box independent on this page. ', 'bw-kidxtore' ),
                ),
                // End general tab
                // Custom color
                array(
                    'id'        => 'page_color',
                    'type'      => 'tab',
                    'label'     => esc_html__('Custom color','bw-kidxtore')
                ),
                array(
                    'id'          => 'body_bg',
                    'label'       => esc_html__('Body Background','bw-kidxtore'),
                    'type'        => 'colorpicker-opacity',
                    'desc'        => esc_html__( 'Change body background of page.', 'bw-kidxtore' ),
                ),
                array(
                    'id'          => 'main_color',
                    'label'       => esc_html__('Main color','bw-kidxtore'),
                    'type'        => 'colorpicker-opacity',
                    'desc'        => esc_html__( 'Change main color of this page.', 'bw-kidxtore' ),
                ),
                array(
                    'id'          => 'main_color2',
                    'label'       => esc_html__('Main color 2','bw-kidxtore'),
                    'type'        => 'colorpicker-opacity',
                    'desc'        => esc_html__( 'Change main color 2 of this page.', 'bw-kidxtore' ),
                ),
                 array(
                        'id'          => 'body_typo',
                        'type'        => 'typography',
                        'title'       => esc_html__('Body typography','bw-kidxtore'),
                        'desc'        => esc_html__( 'Custom the body font.', 'bw-kidxtore' ),
                    ),
                    array(
                        'id'          => 'title_typo',
                        'type'        => 'typography',
                        'title'       => esc_html__('Title typography','bw-kidxtore'),
                        'desc'        => esc_html__( 'Custom font in Title.', 'bw-kidxtore' ),
                        'font-weight'=>false,
                        'font-size'=>false,
                        'color'=>true,
                        'line-height'=>false,
                        'text-align'=>false,
                        'subsets'=>false,
                    ),
                // End Custom color
                // Display & Style tab
                array(
                    'id'        => 'page_layout',
                    'type'      => 'tab',
                    'label'     => esc_html__('Display & Style','bw-kidxtore')
                ),
                array(
                    'id'          => 'bzotech_page_style',
                    'label'       => esc_html__('Page Style','bw-kidxtore'),
                    'type'        => 'select',
                    'std'         => '',
                    'choices'     => array(
                        array(
                            'label' =>  esc_html__('Default','bw-kidxtore'),
                            'value' =>  'page-content-df',
                        ),
                        array(
                            'label' =>  esc_html__('Page boxed','bw-kidxtore'),
                            'value' =>  'page-content-box'
                        ),
                    ),
                    'desc'        => esc_html__( 'Choose default style for page.', 'bw-kidxtore' ),
                ),
                array(
                    'id'          => 'container_width',
                    'label'       => esc_html__('Custom container width(px)','bw-kidxtore'),
                    'type'        => 'text',
                    'desc'        => esc_html__( 'You can custom width of page container. Default is 1200px.', 'bw-kidxtore' ),
                ),  
                array(
                    'id'          => 'add_class_body_page',
                    'label'       => esc_html__('Add class body','bw-kidxtore'),
                    'type'        => 'text',
                    'desc'        => esc_html__( 'CSS classes', 'bw-kidxtore' ),
                ),                
                
                // End Display & Style tab               
            )
        );
        
        $product_settings = array(
            'id' => 'block_product_settings',
            'title' => esc_html__('Product Settings', 'bw-kidxtore'),
            'desc' => '',
            'pages' => array('product'),
            'context' => 'normal',
            'priority' => 'low',
            'fields' => array(    
                // Begin Product Settings
                array(
                    'id'        => 'block_product_custom_tab',
                    'type'      => 'tab',
                    'label'     => esc_html__('General Settings','bw-kidxtore')
                ),
                array(
                    'id'          => 'sv_style_woo_single',
                    'label'       => esc_html__('Product detail style','bw-kidxtore'),
                    'type'        => 'select',
                    'desc'        => esc_html__('Select style of product detail','bw-kidxtore'),
                    'default'         => '',
                    'options'     => array(
                        'style-gallery-horizontal'=> esc_html__('Style 1 (Gallery horizontal )','bw-kidxtore'),
                        'style-gallery-vertical' => esc_html__('Style 2 (Gallery vertical)','bw-kidxtore'),
                        'sticky-style1' => esc_html__('Style 3 (Gallery sticky)','bw-kidxtore'),
                        'sticky-style2' => esc_html__('Style 4 (Gallery sticky)','bw-kidxtore'),
                        'sticky-style3' => esc_html__('Style 5 (Gallery sticky)','bw-kidxtore'),
                        'style-gallery-horizontal2' => esc_html__('Style 6 (Gallery horizontal 2)','bw-kidxtore'),
                        'style-gallery-vertical2' => esc_html__('Style 7 (Gallery vertical 2)','bw-kidxtore'),
                    )
                ),
                array(
                    'id'    => 'trending_product',
                    'label' => esc_html__('Product Trending', 'bw-kidxtore'),
                    'type'        => 'on-off',
                    'default'         => '0',
                    'desc'        => esc_html__( 'Set trending for current product.', 'bw-kidxtore' ),
                ),
                array(
                    'id'          => 'bzotech_product_sticky_addcart',
                    'label'       => esc_html__('Sticky add to cart','bw-kidxtore'),
                    'type'        => 'select',
                    'section'     => 'option_product',
                    'options'     => array(
                        'off'=> esc_html__('Off','bw-kidxtore'),
                        'on' => esc_html__('On','bw-kidxtore'),
                    ),
                    'default'         => ''
                ),
                array(
                    'id'          => 'product_image_zoom',
                    'label'       => esc_html__('Image zoom','bw-kidxtore'),
                    'type'        => 'select',
                    'section'     => 'option_product',
                    'desc'        => esc_html__('Choose a style to display','bw-kidxtore'),
                    'options'     => array(
                        ''    => esc_html__('Theme option','bw-kidxtore'),
                        'none-zoom'  => esc_html__('None','bw-kidxtore'),
                        'zoom-style1' => esc_html__('Zoom 1','bw-kidxtore'),
                        'zoom-style2' => esc_html__('Zoom 2','bw-kidxtore'),
                        'zoom-style3' => esc_html__('Zoom 3','bw-kidxtore'),
                        'zoom-style4' => esc_html__('Zoom 4','bw-kidxtore'),
                    ),
                    'default'         => ''
                ),
                array(
                    'id'          => 'bzotech_video_product',
                    'label'       => esc_html__('Link/URL video','bw-kidxtore'),
                    'type'        => 'text',
                    'section'     => 'option_woo',
                    'desc' => esc_html__('Get link video(audio) in youtube, vimeo, soundclound, share host,... then input a link media. Note: Share host: there are 3 supported video formats mp4, ogg, webm ','bw-kidxtore')
                ),
                array(
                    'id' => 'bzotech_product_attribute_data',
                    'label' => esc_html__('Add attribute by color (Show on list item product.)', 'bw-kidxtore'),
                    'type' => 'list-item',
                    'settings' => array(
                        array(
                            'id' => 'color_att',
                            'label' => esc_html__('Color', 'bw-kidxtore'),
                            'type' => 'colorpicker-opacity',
                        ),
                        array(
                            'id' => 'image_att',
                            'label' => esc_html__('Image', 'bw-kidxtore'),
                            'type' => 'upload',
                            'desc' => esc_html__('Choose image from media', 'bw-kidxtore'),
                        ),
                        array(
                            'id' => 'image_att2',
                            'label' => esc_html__('Image hover', 'bw-kidxtore'),
                            'type' => 'upload',
                            'desc' => esc_html__('Choose image from media (Active in animation rotate thumbnail, zoomout thumbnail, translate thumbnail)', 'bw-kidxtore'),
                        ),
                    )
                ),
                
                
                array(
                    'id' => 'block_product_custom_tab_advanced',
                    'type' => 'tab',
                    'label' => esc_html__('Advanced', 'bw-kidxtore')
                ),
                array(
                    'id'          => 'show_single_itemres',
                    'label'       => esc_html__('Custom item devices (Show the number product item of related products, latest products and upsell products) ','bw-kidxtore'),
                    'type'        => 'text',
                    'section'     => 'option_product',
                    'desc'        => esc_html__('Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:1,375:2,991:3,1170:4. Default in theme option.','bw-kidxtore'),
                ),
                array(
                    'id' => 'before_append_tab',
                    'label' => esc_html__('Append content before product tab', 'bw-kidxtore'),
                    'type' => 'select',
                    'options'     => bzotech_list_post_type('bzotech_mega_item'),
                    'desc' => esc_html__('Choose a mega page content append to before product tab.', 'bw-kidxtore'),
                ),
                array(
                    'id' => 'after_append_tab',
                    'label' => esc_html__('Append content after product tab', 'bw-kidxtore'),
                    'type' => 'select',
                    'options'     => bzotech_list_post_type('bzotech_mega_item'),
                    'desc' => esc_html__('Choose a mega page content append to before product tab.', 'bw-kidxtore'),
                ),
                array(
                    'id'          => 'product_tab_detail',
                    'label'       => esc_html__('Product tab style','bw-kidxtore'),
                    'type'        => 'select',
                    'options'     => array(
                        'tab-product-horizontal'=> esc_html__("Tab style horizontal", 'bw-kidxtore'),
                        'tab-product-vertical'=> esc_html__("Tab style vertical", 'bw-kidxtore'),
                        'tab-product-accordion'=> esc_html__("Tab style accordion", 'bw-kidxtore'),

                    ),
                    'default' => '',
                ),
                array(
                    'id' => 'bzotech_product_tab_data',
                    'label' => esc_html__('Add Custom Tab', 'bw-kidxtore'),
                    'type' => 'list-item',
                    'settings' => array(
                        array(
                            'id' => 'tab_content',
                            'label' => esc_html__('Content', 'bw-kidxtore'),
                            'type' => 'textarea',
                            'default' => '',
                        ),
                        array(
                            'id' => 'priority',
                            'label' => esc_html__('Priority (Default 40)', 'bw-kidxtore'),
                            'type' => 'numeric-slider',
                            'min_max_step' => '1,50,1',
                            'default' => '40',
                            'desc' => esc_html__('Choose priority value to re-order custom tab position.', 'bw-kidxtore'),
                        ),
                    )
                ),
            ),
        );
        $courses_meta_box = array(
                'id'        => 'courses_option',
                'title'     => esc_html__(  'Courses Option' , 'bw-kidxtore' ),
                'desc'      => '',
                'pages'     => array( 'bzotech_courses' ),
                'context'   => 'normal',
                'priority'  => 'high',
                'fields'    => array(
                    array(
                        'id'        => 'courses_general_tab',
                        'type'      => 'tab',
                        'label'     => esc_html__('General information','bw-kidxtore')
                    ),  
                    array(
                        'id'                => 'opening_date',
                        'label'             => esc_html__('Course opening date', 'bw-kidxtore'),
                        'type'              => 'date'
                    ),
                    array(
                        'id'                => 'end_date',
                        'label'             => esc_html__('Course end date', 'bw-kidxtore'),
                        'type'              => 'date'
                    ),
                    array(
                        'id'                => 'study_time',
                        'label'             => esc_html__('Study time', 'bw-kidxtore'),
                        'type'              => 'text'
                    ),
                    array(
                        'id'                => 'price_course',
                        'label'             => esc_html__('Price', 'bw-kidxtore'),
                        'type'              => 'text',
                        'validate' => 'number',
                    ),
                    array(
                        'id'                => 'address',
                        'label'             => esc_html__('Address', 'bw-kidxtore'),
                        'desc'              => esc_html__('Course address','bw-kidxtore'),
                        'type'              => 'text',
                    ),
                    
                )
            );
        if(class_exists('Redux')){      
            $metaboxes = bzotech_register_metabox([$format_metabox,$page_settings,$product_settings,$courses_meta_box]);
            
            return $metaboxes;

        }
    }
}