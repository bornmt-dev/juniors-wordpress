<?php
    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }
    // Redux help function    
    if(!function_exists('bzotech_switch_redux_option')){
        function bzotech_switch_redux_option(){
            $bzotech_option_name = bzotech_get_option_name();
            // Basic Settings
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'Basic Settings', 'bw-kidxtore' ),
                'id'               => 'basic',
                'icon'             => 'el el-home'
            ) );
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'General', 'bw-kidxtore' ),
                'id'               => 'basic-general',
                'subsection'       => true,
                'fields'           => array(
                    
                    array(
                        'id'       => 'bzotech_header_page',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Header Page', 'bw-kidxtore' ),
                        'desc'     => esc_html__( 'Select the header style. To edit/create header content, go to "Header Page" in Admin Dashboard. Note: this setting is applied for all pages; for single page setting, please go to each page to config.', 'bw-kidxtore' ),
                        //Must provide key => value pairs for select options
                        'options'  => bzotech_list_post_type('bzotech_header'),
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'bzotech_footer_page',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Footer Page', 'bw-kidxtore' ),
                        'desc'     => esc_html__( 'Select the footer style. To edit/create footer content, go to "Footer Page" in Admin Dashboard. Note: this setting is applied for all pages; for single page setting, please go to each page to config."', 'bw-kidxtore' ),
                        //Must provide key => value pairs for select options
                        'options'  => bzotech_list_post_type('bzotech_footer'),
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'bzotech_show_breadrumb',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Breadcrumb', 'bw-kidxtore' ),
                        'desc' => esc_html__( 'Show or hide the breadcrumb.', 'bw-kidxtore' ),
                        'default'  => false,
                    ),
                    array(
                        'id'          => 'bzotech_bg_breadcrumb',
                        'type'        => 'media',
                        'title'       => esc_html__('Breadcrumb background image','bw-kidxtore'),
                        'desc'        => 'Select image.',
                        'url'          => false,
                        'required'   =>  array(
                            array('bzotech_show_breadrumb','=','1'),
                            array('breadcrumb_page','=',''),
                        ), 
                    ),

                    array(
                        'id'       => 'breadcrumb_page',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Custom breadcrumb page', 'bw-kidxtore' ),
                        'desc'     => esc_html__( 'Select the custom breadcrumb page.', 'bw-kidxtore' ),
                        //Must provide key => value pairs for select options
                        'options'  => bzotech_list_post_type('bzotech_mega_item'),
                        'default'  => '',
                        'required'   =>  array('bzotech_show_breadrumb','=','1'),
                    ),

                    array(
                        'id'       => 'bzotech_404_page',
                        'type'     => 'select',
                        'title'    => esc_html__( '404 Page', 'bw-kidxtore' ),
                        'desc'     => esc_html__( 'Select Mega Page inserts to the 404 page.', 'bw-kidxtore' ),
                        //Must provide key => value pairs for select options
                        'options'  => bzotech_list_post_type('bzotech_mega_item'),
                        'default'  => ''
                    ),
                    array( 
                        'id'       => 'bzotech_404_page_style',
                        'type'     => 'select',
                        'title'    => esc_html__( '404 Style', 'bw-kidxtore' ),
                        'desc'     => esc_html__( 'Choose a style to display.', 'bw-kidxtore' ),
                        //Must provide key => value pairs for select options
                        'options'  => array(
                            ''           => esc_html__('Default','bw-kidxtore'),
                            'full-width' => esc_html__('FullWidth','bw-kidxtore'),
                        ),
                        'default'  => '',
                        'required' => array('bzotech_404_page','not','')
                    ),

                    array(
                        'id'       => 'bzotech_courses',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Turn on the course', 'bw-kidxtore' ),
                        'desc' => esc_html__( 'Open the course feature', 'bw-kidxtore' ),
                        'default'  => false,
                    ),

                )
            ) );
            
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'Preload', 'bw-kidxtore' ),
                'id'               => 'preload-general',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'       => 'show_preload',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Preload', 'bw-kidxtore' ),
                        'desc'     => esc_html__( 'Turn on or off the preload option.', 'bw-kidxtore' ),
                        'default'  => false,
                    ),
                    array(
                        'id'          => 'preload_bg',
                        'type'        => 'color_rgba',
                        'title'       => esc_html__('Background color','bw-kidxtore'),
                        'desc'        => esc_html__( 'Select the default preload background color.', 'bw-kidxtore' ),
                        'required'    => array('show_preload','=',true),
                    ),
                    array(
                        'id'          => 'preload_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Preload style','bw-kidxtore'),
                        'default'     => 'style2',
                        'options'     => array(
                            '' =>  esc_html__('Style 1','bw-kidxtore'),
                            'style2' =>  esc_html__('Style 2','bw-kidxtore'),
                            'style3' =>  esc_html__('Style 3','bw-kidxtore'),
                            'style4' =>  esc_html__('Style 4','bw-kidxtore'),
                            'style5' =>  esc_html__('Style 5','bw-kidxtore'),
                            'style6' =>  esc_html__('Style 6','bw-kidxtore'),
                            'style7' =>  esc_html__('Style 7','bw-kidxtore'),
                            'custom-image' =>  esc_html__('Custom image','bw-kidxtore'),
                        ),
                        'desc'        => esc_html__( 'Select the preload style.', 'bw-kidxtore' ),
                        'required'    => array('show_preload','=',true),
                    ),
                    array(
                        'id'          => 'preload_image',
                        'type'        => 'media',
                        'title'       => esc_html__('Preload image','bw-kidxtore'),
                        'desc'        => 'Select image.',
                        'url'          => false,
                        'required'   =>  array('preload_style','=','custom-image'),
                    ),
                )
            ) );
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'Other', 'bw-kidxtore' ),
                'id'               => 'other-general',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'        => 'show_scroll_top',
                        'type'      => 'switch',
                        'title'     => esc_html__('Scroll to Top button', 'bw-kidxtore'),
                        'desc'      => esc_html__('Show or hide scroll to top button.', 'bw-kidxtore'),
                        'default'   => false
                    ),
                    array(
                        'id'        => 'show_wishlist_notification',
                        'type'      => 'switch',
                        'title'     => esc_html__('Wislist notififcation', 'bw-kidxtore'),
                        'desc'      => esc_html__('Show or hide notification after adding product to wishlist.', 'bw-kidxtore'),
                        'default'   => false
                    ),
                    array(
                        'id'        => 'show_too_panel',
                        'type'      => 'switch',
                        'title'     => esc_html__('Tool panel', 'bw-kidxtore'),
                        'desc'      => esc_html__('Show or hide sidebar tool panels.', 'bw-kidxtore'),
                        'default'   => false
                    ),
                    array(
                        'id'          => 'tool_panel_page',
                        'type'        => 'select',
                        'title'       => esc_html__( 'Choose tool panel page', 'bw-kidxtore' ),
                        'desc'        => esc_html__( 'Choose a mega page to display.', 'bw-kidxtore' ),
                        'options'     => bzotech_list_post_type('bzotech_mega_item'),
                        'required'   =>  array('show_too_panel','=',true),
                    ),
                    array(
                        'id'          => 'after_append_footer',
                        'type'        => 'select',
                        'title'       => esc_html__( 'Append content after footer', 'bw-kidxtore' ),
                        'desc'        => esc_html__( 'Choose a mega page content append to after main content of footer', 'bw-kidxtore' ),
                        'options'     => bzotech_list_post_type('bzotech_mega_item'),
                    ),
                    array(
                        'id'          => 'body_bg',
                        'type'        => 'color_rgba',
                        'title'       => esc_html__('Body background color','bw-kidxtore'),
                        'desc'        => esc_html__( 'Change the default body background color.', 'bw-kidxtore' ),
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
                    array(
                        'id'          => 'main_color',
                        'type'        => 'color_rgba',
                        'title'       => esc_html__('Main color','bw-kidxtore'),
                        'desc'        => esc_html__( 'Change the website main color.', 'bw-kidxtore' ),
                    ),
                    array(
                        'id'          => 'main_color2',
                        'type'        => 'color_rgba',
                        'title'       => esc_html__('Main color 2','bw-kidxtore'),
                        'desc'        => esc_html__( 'Change main color 2 of your site.', 'bw-kidxtore' ),
                    ),
                    array(
                        'id'          => 'bzotech_page_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Page Style','bw-kidxtore'),
                        'default'     => '',
                        'options'     => array(
                            'page-content-df' =>  esc_html__('Default','bw-kidxtore'),
                            'page-content-box' =>  esc_html__('Page boxed','bw-kidxtore'),
                        ),
                        'desc'        => esc_html__( 'Select the default style for pages.', 'bw-kidxtore' ),
                    ),
                    array(
                        'id'          => 'container_width',
                        'type'        => 'text',
                        'title'       => esc_html__('Custom container width (px)','bw-kidxtore'),
                        'desc'        => esc_html__( 'Set width for the website container. Default is 1650px.', 'bw-kidxtore' ),
                    ),
                     array(
                        'id'          => 'post_single_share',
                        'title'       => esc_html__('Show social share box','bw-kidxtore'),
                        'type'        => 'checkbox',
                        'options'  => array(
                            'post' => esc_html__('Post','bw-kidxtore'),
                            'page' => esc_html__('Page','bw-kidxtore'),
                            'product' => esc_html__('Product','bw-kidxtore'),
                        ),
                        'desc'        => esc_html__( 'Select to show social share box for post, page or product pages.', 'bw-kidxtore' ),
                    ),
                    array(
                        'id'          => 'post_single_share_list',
                        'title'       => esc_html__('Custom social share box','bw-kidxtore'),
                        'type'        => 'repeater',
                        'fields'    => array( 
                            array(
                                'id'       => 'title',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Title', 'bw-kidxtore' ),
                            ),
                            array(
                                'id'          => 'social',
                                'title'       => esc_html__('Social','bw-kidxtore'),
                                'type'        => 'select',
                                'options'     => array(
                                    'total'    => esc_html__('Total share','bw-kidxtore'),
                                    'facebook'  => esc_html__('Facebook','bw-kidxtore'),
                                    'twitter' => esc_html__('Twitter','bw-kidxtore'),
                                    'pinterest' => esc_html__('Pinterest','bw-kidxtore'),
                                    'linkedin' => esc_html__('Linkedin','bw-kidxtore'),
                                    'tumblr' => esc_html__('Tumblr','bw-kidxtore'),
                                    'envelope' => esc_html__('Mail','bw-kidxtore'),
                                ),
                                
                            ),
                            array(
                                'id'          => 'number',
                                'title'       => esc_html__('Show number','bw-kidxtore'),
                                'type'        => 'switch',
                                'default'         => '0',
                            ),
                        ),
                    ),
                    
                    array(
                        'id'        => 'session_page',
                        'type'      => 'switch',
                        'title'     => esc_html__('Session option', 'bw-kidxtore'),
                        'default'   => false
                    ),
                    array(
                        'id'        => 'ajax_security',
                        'type'      => 'switch',
                        'title'     => esc_html__('Ajax security', 'bw-kidxtore'),
                        'default'   => true,
                        'desc'        => esc_html__( 'Check ajax referer for security. If you are using caching, enabling this function may cause ajax to not work', 'bw-kidxtore' ),
                    ),
                    array(
                        'id'       => 'bzotech_demo',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Select Demo', 'bw-kidxtore' ),
                        'desc'     => esc_html__( 'Select demo version','bw-kidxtore' ),
                        //Must provide key => value pairs for select options
                        'options'     => bzotech_list_demo(),
                        'default'  => '1'
                    ),
                    array(
                        'id'        => 'image_down_size',
                        'type'      => 'switch',
                        'title'     => esc_html__('Image down size', 'bw-kidxtore'),
                        'default'   => true,
                        'desc'        => esc_html__( 'Enable this feature to crop images to the parameters you set everywhere. Note that after croppeing the images, you should turn it off to increase web speed', 'bw-kidxtore' ),
                    ),
                )
            ) );
            // End Basic Settings
            // Layout Settings
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'Layout Settings', 'bw-kidxtore' ),
                'id'               => 'layout',
                'icon'             => 'el el-indent-left',
                'fields'           => array(
                    array(
                        'id'          => 'bzotech_sidebar_position_page',
                        'type'        => 'select',
                        'title'       => esc_html__('Page sidebar position','bw-kidxtore'),
                        'desc'        => esc_html__('Set the sidebar position for the website  pages.','bw-kidxtore'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','bw-kidxtore'),
                            'left'  => esc_html__('Left','bw-kidxtore'),
                            'right' => esc_html__('Right','bw-kidxtore'),
                        ),
                        'default'     => ''
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_page',
                        'type'        => 'select',
                        'title'       => esc_html__('Select Sidebar','bw-kidxtore'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('bzotech_sidebar_position_page','not','no'),
                            array('bzotech_sidebar_position_page','not',''),
                        ),
                        'desc'        => esc_html__('Select the sidebar to display for the website page.','bw-kidxtore'),
                        'default'     => ''
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_style_page',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar style','bw-kidxtore'),
                        'desc'        => esc_html__('Select the sidebar style for the website page.','bw-kidxtore'),
                        'options'     => array(
                            'default'    => esc_html__('Default','bw-kidxtore'),
                            'style2'  => esc_html__('Style2','bw-kidxtore'),
                        ),
                        'required'    => array(
                            array('bzotech_sidebar_position_page','not','no'),
                            array('bzotech_sidebar_position_page','not',''),
                        ), 
                        'default'     => 'default'
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_position_page_archive',
                        'type'        => 'select',
                        'title'       => esc_html__('Select archives page sidebar','bw-kidxtore'),
                        'desc'        => esc_html__('Select the sidebar to display for the archives page.','bw-kidxtore'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','bw-kidxtore'),
                            'left'  => esc_html__('Left','bw-kidxtore'),
                            'right' => esc_html__('Right','bw-kidxtore'),
                        ),
                        'default'     => 'right'
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_page_archive',
                        'type'        => 'select',
                        'title'       => esc_html__('Select sidebar','bw-kidxtore'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('bzotech_sidebar_position_page_archive','not','no'),
                            array('bzotech_sidebar_position_page_archive','not',''),
                        ),
                        'desc'        => esc_html__('Select the sidebar to display for the archive page.','bw-kidxtore'),
                        'default'     => 'blog-sidebar'
                    ),
                     array(
                        'id'          => 'bzotech_sidebar_style_archive',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar style','bw-kidxtore'),
                        'desc'        => esc_html__('Select the sidebar style for the archive page.','bw-kidxtore'),
                        'options'     => array(
                            'default'    => esc_html__('Default','bw-kidxtore'),
                            'style2'  => esc_html__('Style2','bw-kidxtore'),
                        ),
                        'required'    => array(
                            array('bzotech_sidebar_position_page_archive','not','no'),
                            array('bzotech_sidebar_position_page_archive','not',''),
                        ), 
                        'default'     => 'default'
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_position_page_search',
                        'type'        => 'select',
                        'title'       => esc_html__('Search page sidebar position','bw-kidxtore'),
                        'desc'        => esc_html__('Set the sidebar position for the search page.','bw-kidxtore'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','bw-kidxtore'),
                            'left'  => esc_html__('Left','bw-kidxtore'),
                            'right' => esc_html__('Right','bw-kidxtore'),
                        )
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_page_search',
                        'type'        => 'select',
                        'title'       => esc_html__('Select sidebar','bw-kidxtore'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('bzotech_sidebar_position_page_search','not','no'),
                            array('bzotech_sidebar_position_page_search','not',''),
                        ),
                        'desc'        => esc_html__('Select the sidebar to display for the search page.','bw-kidxtore'),
                    ),    
                    array(
                        'id'          => 'bzotech_sidebar_style_search',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar style','bw-kidxtore'),
                        'desc'        => esc_html__('Select the sidebar style for the search page','bw-kidxtore'),
                        'options'     => array(
                            'default'    => esc_html__('Default','bw-kidxtore'),
                            'style2'  => esc_html__('Style2','bw-kidxtore'),
                        ),
                        'required'    => array(
                            array('bzotech_sidebar_position_page_search','not','no'),
                            array('bzotech_sidebar_position_page_search','not',''),
                        ), 
                        'default'     => 'default'
                    ),          
                    array(
                        'id'          => 'bzotech_add_sidebar',
                        'title'       => esc_html__('Add SideBar','bw-kidxtore'),
                        'type'        => 'repeater',
                        'default'     => '',
                        'fields'    => array( 
                            array(
                                'id'       => 'title',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Title', 'bw-kidxtore' ),
                            ),
                            array(
                                'id'          => 'widget_title_heading',
                                'type'        => 'select',
                                'title'       => esc_html__('Set widget heading style','bw-kidxtore'),
                                'default'     => 'h3',
                                'options'     => array(
                                    'h1' => esc_html__('H1','bw-kidxtore'),
                                    'h2' => esc_html__('H2','bw-kidxtore'),
                                    'h3' => esc_html__('H3','bw-kidxtore'),
                                    'h4' => esc_html__('H4','bw-kidxtore'),
                                    'h5' => esc_html__('H5','bw-kidxtore'),
                                    'h6' => esc_html__('H6','bw-kidxtore'),
                                )
                            )
                            
                        ),
                    ),
                )
            ) );
            // End Layout Settings
            if ( class_exists('Bzotech_CoursesController') ){
                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'Course', 'bw-kidxtore' ),
                    'id'               => 'course',
                    'icon'             => 'el el-briefcase'
                ) );
                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'General', 'bw-kidxtore' ),
                    'id'               => 'general-course',
                    'subsection'       => true,
                    'fields'           => array(
                        array(
                            'id'          => 'before_append_course_single',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content before course detail page','bw-kidxtore'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to before main content of post.','bw-kidxtore'),
                        ),

                        array(
                            'id'          => 'after_append_course_single',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content after course detail page','bw-kidxtore'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to after main content of post.','bw-kidxtore'),
                        ),
                        
                        array(
                            'id'          => 'course_single_related',
                            'type'        => 'switch',
                            'title'       => esc_html__('Related course','bw-kidxtore'),
                            'desc'        => esc_html__('Show or hide related post in the course detail.','bw-kidxtore' ),
                            'default'     => false,
                        ),
                        array(
                            'id'          => 'course_single_related_title',
                            'type'        => 'text',
                            'title'       => esc_html__('Related title','bw-kidxtore'),
                            'desc'        => esc_html__('Enter title of related section.','bw-kidxtore'),
                            'required'    => array('course_single_related','=',true),
                        ),
                        array(
                            'id'          => 'course_single_related_number',
                            'type'        => 'text',
                            'title'       => esc_html__('Related number post','bw-kidxtore'),
                            'desc'        => esc_html__('Enter number of related post to display.','bw-kidxtore'),
                            'required'    => array('course_single_related','=',true),
                        ),
                        array(
                            'id'          => 'course_single_related_item',
                            'type'        => 'text',
                            'title'       => esc_html__('Related custom number item responsive','bw-kidxtore'),
                            'desc'        => esc_html__('Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.','bw-kidxtore'),
                            'required'    => array('course_single_related','=',true),
                        ),
                        array(
                            'id'          => 'course_single_related_item_style',
                            'type'        => 'select',
                            'title'       => esc_html__('Related item style','bw-kidxtore'),
                            'desc'        =>esc_html__('Choose a style to active display','bw-kidxtore'),
                            'options'     => bzotech_get_post_style(),
                            'required'    => array('course_single_related','=',true),
                        ),
                    )
                ) );
            }
            if(class_exists("woocommerce")){
                // Shop
                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'Shop', 'bw-kidxtore' ),
                    'id'               => 'shop',
                    'icon'             => 'el el-shopping-cart'
                ) );
                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'General', 'bw-kidxtore' ),
                    'id'               => 'general-shop',
                    'subsection'       => true,
                    'fields'           => array(
                       
                        array(
                            'id'          => 'bzotech_sidebar_position_woo',
                            'type'        => 'select',
                            'title'       => esc_html__('Sidebar position','bw-kidxtore'),
                            'desc'        => esc_html__('Select the sidebar position for the WooCommerce pages (Shop, Checkout, Cart, My Account, Product category/tag/taxonomy page...). Left, Right, or No sidebar.','bw-kidxtore'),
                            'options'     => array(
                                'no'    => esc_html__('No Sidebar','bw-kidxtore'),
                                'left'  => esc_html__('Left','bw-kidxtore'),
                                'right' => esc_html__('Right','bw-kidxtore'),
                            ),
                            'default'  => 'right'
                        ),
                        array(
                            'id'          => 'bzotech_sidebar_woo',
                            'type'        => 'select',
                            'title'       => esc_html__('Select sidebar','bw-kidxtore'),
                            'data'        => 'sidebars',
                            'required'    => array(
                                array('bzotech_sidebar_position_woo','not','no'),
                                array('bzotech_sidebar_position_woo','not',''),
                            ),
                            'desc'        => esc_html__('Select the sidebar to display for WooCommerce pages','bw-kidxtore'),
                            'default'  => 'blog-sidebar'
                        ),
                        array(
                            'id'          => 'bzotech_sidebar_style_woo',
                            'type'        => 'select',
                            'title'       => esc_html__('Sidebar style','bw-kidxtore'),
                            'desc'        => esc_html__('Select the sidebar style for the shop page','bw-kidxtore'),
                            'options'     => array(
                                'default'    => esc_html__('Default','bw-kidxtore'),
                                'style2'  => esc_html__('Style2','bw-kidxtore'),
                            ),
                            'required'    => array(
                                array('bzotech_sidebar_position_woo','not','no'),
                                array('bzotech_sidebar_position_woo','not',''),
                            ), 
                            'default'     => 'default'
                        ),   
                        array(
                            'id'          => 'shop_default_style',
                            'type'        => 'select',
                            'title'       => esc_html__('Default style','bw-kidxtore'),
                            'desc'=>esc_html__('Set the default style for the shop page: list view or grid view.','bw-kidxtore'),
                            'options'     => array(                        
                                'grid'  => esc_html__('Grid','bw-kidxtore'),
                                'list'  => esc_html__('List','bw-kidxtore'),
                            ),
                            'default'  => 'grid'
                        ),
                        array(
                            'id'          => 'shop_gap_product',
                            'type'        => 'select',
                            'title'       => esc_html__('Gap products','bw-kidxtore'),
                            'desc'=>esc_html__('Set the space between the items on the shop page.','bw-kidxtore'),
                            'options'     => array(                        
                                ''          => esc_html__('Default','bw-kidxtore'),
                                'gap-0'     => esc_html__('0','bw-kidxtore'),
                                'gap-5'     => esc_html__('5px','bw-kidxtore'),
                                'gap-10'    => esc_html__('10px','bw-kidxtore'),
                                'gap-15'    => esc_html__('15px','bw-kidxtore'),
                                'gap-20'    => esc_html__('20px','bw-kidxtore'),
                                'gap-30'    => esc_html__('30px','bw-kidxtore'),
                                'gap-40'    => esc_html__('40px','bw-kidxtore'),
                                'gap-50'    => esc_html__('50px','bw-kidxtore'),
                            ),
                        ),
                        array(
                            'id'          => 'woo_shop_number',
                            'type'        => 'slider',
                            'title'       => esc_html__('Product number','bw-kidxtore'),
                            'min'         => 0,
                            'max'         => 999,
                            'step'        => 1,
                            'default'     => 12,
                            'desc'        => esc_html__('Set the number of product to display per page. Default is 12.','bw-kidxtore')
                        ),
                        array(
                            'id'          => 'sv_set_time_woo',
                            'type'        => 'slider',
                            'title'       => esc_html__('New product','bw-kidxtore'),
                            'min'         => 0,
                            'max'         => 999,
                            'step'        => 1,
                            'default'     => 0,
                            'desc'        => esc_html__('Set time for new products. Unit is day. Default is 0.','bw-kidxtore')
                        ),
                        array(
                            'id'          => 'shop_style',
                            'type'        => 'select',
                            'title'       => esc_html__('Shop pagination','bw-kidxtore'),
                            'desc'=>esc_html__('Select the pagination style for the shop page.','bw-kidxtore'),
                            'options'     => array(
                                ''          => esc_html__('Default','bw-kidxtore'),
                                'load-more' => esc_html__('Load more','bw-kidxtore'),
                            )
                        ),
                        array(
                            'id'          => 'shop_ajax',
                            'type'        => 'switch',
                            'title'       => esc_html__('Shop ajax','bw-kidxtore'),
                            'default'     => false,
                            'desc'        => esc_html__('Enable or disable ajax process for the shop page.','bw-kidxtore'),
                            'default'     => false
                        ),
                        array(
                            'id'          => 'shop_thumb_animation',
                            'type'        => 'select',
                            'title'       => esc_html__('Thumbnail animation','bw-kidxtore'),
                            'desc'        => esc_html__('Set the animation for product thumnail.','bw-kidxtore'),
                            'options'     => bzotech_get_product_thumb_animation()
                        ),
                        array(
                            'id'          => 'shop_number_filter',
                            'type'        => 'switch',
                            'title'       => esc_html__('Show number filter','bw-kidxtore'),
                            'desc'        => esc_html__('Show or hide number filter on shop page.','bw-kidxtore'),
                            'default'     => false,
                        ),
                        array(
                            'id'          => 'shop_number_filter_list',
                            'type'        => 'repeater',
                            'title'       => esc_html__('Add number list for filter','bw-kidxtore'),
                            'desc'        => esc_html__('Add the number list to filter on the shop page.','bw-kidxtore'),
                            'fields'      => array(
                                array(
                                    'id'          => 'number',
                                    'type'        => 'text',
                                    'title'       => esc_html__('Number','bw-kidxtore'),
                                ),
                            ),
                            'required'   => array('shop_number_filter','not',false),
                            'default'  => ''
                        ),
                        array(
                            'id'          => 'shop_type_filter',
                            'type'        => 'switch',
                            'title'       => esc_html__('Show type filter','bw-kidxtore'),
                            'desc'        => esc_html__('Show or hide type filter (list/grid) on the shop page.','bw-kidxtore'),
                            'default'     => false,
                        ),
                        array(
                            'id'          => 'shop_order_filter',
                            'type'        => 'switch',
                            'title'       => esc_html__('Show order filter','bw-kidxtore'),
                            'desc'        => esc_html__('Show or hide order filter on the shop page.','bw-kidxtore'),
                            'default'     => false,
                        ),

                        array(
                            'id'          => 'shop_attribute_color',
                            'title'       => esc_html__('Show color attribute','bw-kidxtore'),
                            'desc'        => esc_html__('Show or hide color attribute on the product list.','bw-kidxtore'),
                            'type'        => 'switch',
                            'section'     => 'option_woo',
                            'default'     => false,
                        ),
                        array(
                            'id'          => 'show_quick_view',
                            'title'       => esc_html__('Quick view button','bw-kidxtore'),
                            'type'        => 'switch',
                            'section'     => 'option_woo',
                            'default'     => false,
                        ),
                        array(
                            'id'          => 'quick_view_style',
                            'title'       => esc_html__('Quick view style','bw-kidxtore'),
                            'type'        => 'select',
                            'section'     => 'option_woo',
                            'desc'        => esc_html__('Select the style for quickview.','bw-kidxtore'),
                            'default'         => '',
                            'condition'   => 'show_quick_view:is(1)',
                            'options'     => array(
                                ''          => esc_html__('Default','bw-kidxtore'),
                                'load-more' => esc_html__('Style 1 (default)','bw-kidxtore'),
                            )
                        ),
                    )
                ) );
                
                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'List View Settings', 'bw-kidxtore' ),
                    'id'               => 'list-shop',
                    'subsection'       => true,
                    'fields'           => array(
                        array(
                            'id'          => 'shop_list_size',
                            'type'        => 'text',
                            'title'       => esc_html__('Custom thumbnail size','bw-kidxtore'),
                            'desc'        => esc_html__('Set the thumbnail size to crop in px. Format: [width]x[height]. For example 300x300.','bw-kidxtore')
                        ),
                        array(
                            'id'          => 'shop_list_item_style',
                            'type'        => 'select',
                            'title'       => esc_html__('Item style','bw-kidxtore'),
                            'desc'        => esc_html__('Select the item style.','bw-kidxtore'),
                            'options'     => bzotech_get_product_list_style()
                        ),
                    )
                ) );

                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'Grid View Settings', 'bw-kidxtore' ),
                    'id'               => 'grid-shop',
                    'subsection'       => true,
                    'fields'           => array(
                        array(
                            'id'          => 'shop_grid_column',
                            'type'        => 'select',
                            'title'       => esc_html__('Grid column','bw-kidxtore'),
                            'default'     => '3',
                            'desc'        => esc_html__('Select the number of column to show.','bw-kidxtore'),
                            'options'     => array(
                                '2'     => esc_html__('2 column','bw-kidxtore'),
                                '3'     => esc_html__('3 column','bw-kidxtore'),
                                '4'     => esc_html__('4 column','bw-kidxtore'),
                                '5'     => esc_html__('5 column','bw-kidxtore'),
                                '6'     => esc_html__('6 column','bw-kidxtore'),
                                '7'     => esc_html__('7 column','bw-kidxtore'),
                                '8'     => esc_html__('8 column','bw-kidxtore'),
                                '9'     => esc_html__('9 column','bw-kidxtore'),
                                '10'    => esc_html__('10 column','bw-kidxtore'),
                            )
                        ),
                        array(
                            'id'          => 'shop_grid_size',
                            'type'        => 'text',
                            'title'       => esc_html__('Custom thumbnail size','bw-kidxtore'),
                            'desc'        => esc_html__('Set the thumbnail size to crop in px. Format: [width]x[height]. For example 300x300.','bw-kidxtore')
                        ),
                        array(
                            'id'          => 'shop_grid_item_style',
                            'type'        => 'select',
                            'title'       => esc_html__('Item style','bw-kidxtore'),
                            'desc'        => esc_html__('Select the item style.','bw-kidxtore'),
                            'options'     => bzotech_get_product_style()
                        ),
                        array(
                            'id'       => 'item_thumbnail',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Thumbnail', 'bw-kidxtore' ),
                            'desc' => esc_html__( 'Show or hide the thumbnail.', 'bw-kidxtore' ),
                            'default'  => '',
                            'options'     => array(
                                ''              => esc_html__('Default','bw-kidxtore'),
                                'yes'  => esc_html__('Show','bw-kidxtore'),
                                'no'  => esc_html__('Hide','bw-kidxtore'),
                            )
                        ),
                        array(
                            'id'       => 'item_quickview',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Quickview', 'bw-kidxtore' ),
                            'desc' => esc_html__( 'Show or hide the quickview.', 'bw-kidxtore' ),
                            'default'  => '',
                            'options'     => array(
                                ''              => esc_html__('Default','bw-kidxtore'),
                                'yes'  => esc_html__('Show','bw-kidxtore'),
                                'no'  => esc_html__('Hide','bw-kidxtore'),
                            )
                        ),
                        array(
                            'id'       => 'item_title',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Title', 'bw-kidxtore' ),
                            'desc' => esc_html__( 'Show or hide the title.', 'bw-kidxtore' ),
                            'default'  => '',
                            'options'     => array(
                                ''              => esc_html__('Default','bw-kidxtore'),
                                'yes'  => esc_html__('Show','bw-kidxtore'),
                                'no'  => esc_html__('Hide','bw-kidxtore'),
                            )
                        ),
                        array(
                            'id'       => 'item_rate',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Rate', 'bw-kidxtore' ),
                            'desc' => esc_html__( 'Show or hide the rate.', 'bw-kidxtore' ),
                            'default'  => '',
                            'options'     => array(
                                ''              => esc_html__('Default','bw-kidxtore'),
                                'yes'  => esc_html__('Show','bw-kidxtore'),
                                'no'  => esc_html__('Hide','bw-kidxtore'),
                            )
                        ),
                        array(
                            'id'       => 'item_button',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Button add to cart', 'bw-kidxtore' ),
                            'desc' => esc_html__( 'Show or hide the button add to cart .', 'bw-kidxtore' ),
                            'default'  => '',
                            'options'     => array(
                                ''              => esc_html__('Default','bw-kidxtore'),
                                'yes'  => esc_html__('Show','bw-kidxtore'),
                                'no'  => esc_html__('Hide','bw-kidxtore'),
                            )
                        ),
                        array(
                            'id'       => 'item_label',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Label', 'bw-kidxtore' ),
                            'desc' => esc_html__( 'Show or hide the label (Label sale, label new...).', 'bw-kidxtore' ),
                            'default'  => '',
                            'options'     => array(
                                ''              => esc_html__('Default','bw-kidxtore'),
                                'yes'  => esc_html__('Show','bw-kidxtore'),
                                'no'  => esc_html__('Hide','bw-kidxtore'),
                            )
                        ),
                        array(
                            'id'       => 'item_countdown',
                            'type'     => 'select',
                            'title'    => esc_html__( 'Countdown price', 'bw-kidxtore' ),
                            'desc' => esc_html__( 'Show or hide the countdown by reduced price.', 'bw-kidxtore' ),
                            'default'  => '',
                            'options'     => array(
                                ''              => esc_html__('Default','bw-kidxtore'),
                                'yes'  => esc_html__('Show','bw-kidxtore'),
                                'no'  => esc_html__('Hide','bw-kidxtore'),
                            )
                        ),
                        array(
                            'id'          => 'shop_grid_type',
                            'type'        => 'select',
                            'title'       => esc_html__('Grid display','bw-kidxtore'),
                            'desc'        => esc_html__('Select the grid style.','bw-kidxtore'),
                            'options'     => array(
                                ''              => esc_html__('Default','bw-kidxtore'),
                                'grid-masonry'  => esc_html__('Masonry','bw-kidxtore'),
                            )
                        ),
                    )
                ) );

                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'Advanced', 'bw-kidxtore' ),
                    'id'               => 'advanced-shop',
                    'subsection'       => true,
                    'fields'           => array(
                        array(
                            'id'          => 'cart_page_style',
                            'type'        => 'select',
                            'title'       => esc_html__('Cart display','bw-kidxtore'),
                            'desc'        => esc_html__('Select the cart style.','bw-kidxtore'),
                            'options'     => array(
                                ''          => esc_html__('Default','bw-kidxtore'),
                                'style2'    => esc_html__('Style 2','bw-kidxtore'),
                            )
                        ),
                        array(
                            'id'          => 'checkout_page_style',
                            'type'        => 'select',
                            'title'       => esc_html__('Checkout display','bw-kidxtore'),
                            'desc'        => esc_html__('Select the checkout style.','bw-kidxtore'),
                            'options'     => array(
                                ''          => esc_html__('Default','bw-kidxtore'),
                                'style2'    => esc_html__('Style 2','bw-kidxtore'),
                            )
                        ),
                        array(
                            'id'          => 'bzotech_header_page_woo',
                            'type'        => 'select',
                            'title'       => esc_html__( 'WooCommerce page header', 'bw-kidxtore' ),
                            'desc'        => esc_html__( 'Select the header style. To edit/create header content, go to Header Page in Admin Dashboard.
                        Note: this setting is applied for all pages; for single page setting, please go to each page to config.', 'bw-kidxtore' ),
                            'options'     => bzotech_list_post_type('bzotech_header')
                        ),
                        array(
                            'id'          => 'bzotech_footer_page_woo',
                            'type'        => 'select',
                            'title'       => esc_html__( 'WooCommerce page footer', 'bw-kidxtore' ),
                            'desc'        => esc_html__( 'Select the footer style. To edit/create footer content, go to Footer Page in Admin Dashboard.
                                Note: this setting is applied for all pages; for single page setting, please go to each page to config.', 'bw-kidxtore' ),
                            'options'     => bzotech_list_post_type('bzotech_footer')
                        ),
                        array(
                            'id'          => 'before_append_woo',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content before WooCommerce page','bw-kidxtore'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to before main content of page/post.','bw-kidxtore'),
                        ),
                        array(
                            'id'          => 'after_append_woo',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content after WooCommerce page','bw-kidxtore'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to after main content of page/post.','bw-kidxtore'),
                        ),
                    )
                ) );
                // End Shop

                // Product
                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'Product', 'bw-kidxtore' ),
                    'id'               => 'product',
                    'icon'             => 'el el-shopping-cart'
                ) );
                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'General', 'bw-kidxtore' ),
                    'id'               => 'general-product',
                    'subsection'       => true,
                    'fields'           => array(
                    array(
                        'id'          => 'sv_style_woo_single',
                        'title'       => esc_html__('Product detail style','bw-kidxtore'),
                        'type'        => 'select',
                        'section'     => 'option_product',
                        'default'         => 'style-gallery-horizontal',
                        'desc'        => esc_html__('Select style for the product detail.','bw-kidxtore'),
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
                            'id'          => 'sv_sidebar_position_woo_single',
                            'type'        => 'select',
                            'title'       => esc_html__('Sidebar position','bw-kidxtore'),
                            'desc'        => esc_html__('Select the sidebar position for the single product page.','bw-kidxtore'),
                            'default'         => 'no',
                            'options'     => array(
                                'no'    => esc_html__('No Sidebar','bw-kidxtore'),
                                'left'  => esc_html__('Left','bw-kidxtore'),
                                'right' => esc_html__('Right','bw-kidxtore'),
                            ),
                        ),
                        array(
                            'id'          => 'sv_sidebar_woo_single',
                            'type'        => 'select',
                            'title'       => esc_html__('Select sidebar','bw-kidxtore'),
                            'data'        => 'sidebars',
                            'required'    => array(
                                array('sv_sidebar_position_woo_single','not','no'),
                                array('sv_sidebar_position_woo_single','not',''),
                            ),
                            'desc'        => esc_html__('Select the sidebar for single product page.','bw-kidxtore'),
                        ),
                        array(
                            'id'          => 'bzotech_sidebar_style_woo_single',
                            'type'        => 'select',
                            'title'       => esc_html__('Sidebar style','bw-kidxtore'),
                            'desc'        => esc_html__('Select the sidebar style for the single product page.','bw-kidxtore'),
                            'options'     => array(
                                'default'    => esc_html__('Default','bw-kidxtore'),
                                'style2'  => esc_html__('Style2','bw-kidxtore'),
                            ),
                            'required'    => array(
                                array('sv_sidebar_position_woo_single','not','no'),
                                array('sv_sidebar_position_woo_single','not',''),
                            ), 
                            'default'     => 'default'
                        ),  
                        array(
                            'id'          => 'product_image_zoom',
                            'type'        => 'select',
                            'title'       => esc_html__('Image zoom','bw-kidxtore'),
                            'desc'        => esc_html__('Select the image zoom style.','bw-kidxtore'),
                            'options'     => array(
                                ''              => esc_html__('None','bw-kidxtore'),
                                'zoom-style1'   => esc_html__('Zoom 1','bw-kidxtore'),
                                'zoom-style2'   => esc_html__('Zoom 2','bw-kidxtore'),
                                'zoom-style3'   => esc_html__('Zoom 3','bw-kidxtore'),
                                'zoom-style4'   => esc_html__('Zoom 4','bw-kidxtore'),
                            )
                        ),
                        array(
                            'id'          => 'product_tab_detail',
                            'type'        => 'select',
                            'title'       => esc_html__('Product tab style','bw-kidxtore'),
                            'desc'        => esc_html__('Select the product tab style.','bw-kidxtore'),
                            'default'         => 'tab-product-accordion',
                            'options'     => array(
                                'tab-product-horizontal'=> esc_html__("Tab style horizontal", 'bw-kidxtore'),
                                'tab-product-vertical'=> esc_html__("Tab style vertical", 'bw-kidxtore'),
                                'tab-product-accordion'=> esc_html__("Tab style accordion", 'bw-kidxtore'),
                            )
                        ),
                        array(
                            'id'          => 'show_excerpt',
                            'type'        => 'switch',
                            'title'       => esc_html__('Show excerpt','bw-kidxtore'),
                            'default'     => true
                        ),
                    )
                ) );

                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'Extra Display', 'bw-kidxtore' ),
                    'id'               => 'display-product',
                    'subsection'       => true,
                    'fields'           => array(
                       array(
                            'id'          => 'show_latest',
                            'type'        => 'switch',
                            'title'       => esc_html__('Show latest products','bw-kidxtore'),
                            'default'     => false
                        ),
                        array(
                            'id'          => 'show_upsell',
                            'type'        => 'switch',
                            'title'       => esc_html__('Show upsell products','bw-kidxtore'),
                            'default'     => false
                        ),
                        array(
                            'id'          => 'show_related',
                            'type'        => 'switch',
                            'title'       => esc_html__('Show related products','bw-kidxtore'),
                            'section'     => 'option_product',
                            'default'     => false
                        ),
                        array(
                            'id'          => 'show_single_number',
                            'type'        => 'slider',
                            'title'       => esc_html__('Show single number','bw-kidxtore'),
                            'min'         => '1',
                            'max'         => '100',
                            'step'        => '1',
                            'default'     => '6'
                        ),
                        array(
                            'id'          => 'show_single_size',
                            'type'        => 'text',
                            'title'       => esc_html__('Show single size','bw-kidxtore'),
                            'desc'        => esc_html__('Set the size for related, upsell products thumbnail. Format: [width]x[height]. For example 300x300.','bw-kidxtore'),
                        ),
                        array(
                            'id'          => 'show_single_itemres',
                            'type'        => 'text',
                            'title'       => esc_html__('Custom item devices','bw-kidxtore'),
                            'desc'        => esc_html__('Set the number of related, upsell products for different screen size in px. Format is width:value and separate by ",". Example is 0:2,600:3,1000:4. Default is auto.','bw-kidxtore'),
                        ),
                        array(
                            'id'          => 'show_single_item_style',
                            'type'        => 'select',
                            'title'       => esc_html__('Single item style','bw-kidxtore'),
                            'desc'        => esc_html__('Select the item style.','bw-kidxtore'),
                            'options'     => bzotech_get_product_style()
                        ),
                    )
                ) );

                Redux::setSection( $bzotech_option_name, array(
                    'title'            => esc_html__( 'Advanced', 'bw-kidxtore' ),
                    'id'               => 'advanced-product',
                    'subsection'       => true,
                    'fields'           => array(
                       array(
                            'id'          => 'before_append_woo_single',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content before product page','bw-kidxtore'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to before main content of page/post.','bw-kidxtore'),
                        ),
                        array(
                            'id'          => 'before_append_tab',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content before product tab','bw-kidxtore'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to before product tab.','bw-kidxtore'),
                        ),
                        array(
                            'id'          => 'after_append_tab',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content after product tab','bw-kidxtore'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to before product tab.','bw-kidxtore'),
                        ),
                        array(
                            'id'          => 'after_append_woo_single',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content after product page','bw-kidxtore'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to after main content of page/post.','bw-kidxtore'),
                        ),
                        array(
                            'id'          => 'append_content_summary',
                            'type'        => 'select',
                            'title'       => esc_html__('Append content in summary','bw-kidxtore'),
                            'options'     => bzotech_list_post_type('bzotech_mega_item'),
                            'desc'        => esc_html__('Choose a mega page content append to after main content of product summary.','bw-kidxtore'),
                        ),

                        array(
                            'id'          => 'content_summary_pos',
                            'type'        => 'slider',
                            'desc'        => esc_html__('Set a position for the content to be added to the product summary','bw-kidxtore'),
                            'title'       => esc_html__('Set a position for the content to be added','bw-kidxtore'),
                            'min'         => '1',
                            'max'         => '100',
                            'step'        => '1',
                            'default'     => '60',
                            'required'    => array(
                                array('append_content_summary','not','')
                            ), 
                        ),
                    )
                ) );
                // End Product
            };
            // Blog & Post
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'Blog & Post', 'bw-kidxtore' ),
                'id'               => 'blog-post',
                'icon'             => 'el el-website'
            ) );
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'General', 'bw-kidxtore' ),
                'id'               => 'blog-general',
                'subsection'       => true,
                'fields'           => array(
                                 
                    array(
                        'id'          => 'before_append_post',
                        'type'        => 'select',
                        'title'       => esc_html__('Append content before post/blog/archive page','bw-kidxtore'),
                        'options'     => bzotech_list_post_type('bzotech_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to before main content of post/blog/archive page.','bw-kidxtore'),
                    ),
                    array(
                        'id'          => 'after_append_post',
                        'type'        => 'select',
                        'title'       => esc_html__('Append content after post/blog/archive page','bw-kidxtore'),
                        'options'     => bzotech_list_post_type('bzotech_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to after main content of post/blog/archive page.','bw-kidxtore'),
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_position_blog',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar position','bw-kidxtore'),
                        'desc'        => esc_html__('Select the sidebar position for the blog page.','bw-kidxtore'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','bw-kidxtore'),
                            'left'  => esc_html__('Left','bw-kidxtore'),
                            'right' => esc_html__('Right','bw-kidxtore'),
                        ),
                        'default'     => 'right'
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_blog',
                        'type'        => 'select',
                        'title'       => esc_html__('Select sidebar','bw-kidxtore'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('bzotech_sidebar_position_blog','not','no'),
                            array('bzotech_sidebar_position_blog','not',''),
                        ), 
                        'desc'        => esc_html__('Select the sidebar to display for the blog pages.','bw-kidxtore'),
                    ),
                     array(
                        'id'          => 'bzotech_sidebar_style_blog',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar style','bw-kidxtore'),
                        'desc'        => esc_html__('Select the sidebar style for the blog page.','bw-kidxtore'),
                        'options'     => array(
                            'default'    => esc_html__('Default','bw-kidxtore'),
                            'style2'  => esc_html__('Style2','bw-kidxtore'),
                        ),
                        'required'    => array(
                            array('bzotech_sidebar_position_blog','not','no'),
                            array('bzotech_sidebar_position_blog','not',''),
                        ), 
                        'default'     => 'default'
                    ),
                    array(
                        'id'          => 'blog_default_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Default blog view style','bw-kidxtore'),
                        'desc'        =>esc_html__('Select the default blog view style: list view or grid view.','bw-kidxtore'),
                        'options'     => array(
                            'list'  => esc_html__('List','bw-kidxtore'),
                            'grid'  => esc_html__('Grid','bw-kidxtore'),
                        ),
                        'default'     => 'list',
                    ),
                    array(
                        'id'          => 'blog_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Pagination','bw-kidxtore'),
                        'desc'        => esc_html__('Select the blog pagination style.','bw-kidxtore'),
                        'options'     => array(
                            ''          => esc_html__('Default','bw-kidxtore'),
                            'load-more' =>esc_html__('Load more','bw-kidxtore'),
                        )
                    ),
                    array(
                        'id'          => 'blog_number_filter',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show number filter','bw-kidxtore'),
                        'desc'        => esc_html__('Show/hide number filter on blog page.','bw-kidxtore'),
                        'default'     => false,
                    ),
                    array(
                        'id'          => 'blog_number_filter_list',
                        'title'       => esc_html__('Add list number filter','bw-kidxtore'),
                        'type'        => 'repeater',
                        'desc'        => esc_html__('Add custom list number to filter on the blog page.','bw-kidxtore'),
                        'fields'    => array( 
                            array(
                                'id'       => 'title',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Title', 'bw-kidxtore' ),
                            ),
                            array(
                                'id'          => 'number',
                                'type'        => 'text',
                                'title'       => esc_html__('Number','bw-kidxtore'),
                            ),
                        ),
                        'required'   => array('blog_number_filter','not', false),
                    ),
                    array(
                        'id'          => 'blog_type_filter',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show type filter','bw-kidxtore'),
                        'desc'        => esc_html__('Show or hide type filter (list/grid) on blog page.','bw-kidxtore'),
                        'default'     => false,
                    ),
                    array(
                        'id'          => 'blog_order_filter',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show order filter','bw-kidxtore'),
                        'desc'        => esc_html__('Show or hide order filter on blog page.','bw-kidxtore'),
                        'default'     => false,
                    ),
                    array(
                        'id'          => 'post_list_meta',
                        'type'        => 'select',
                        'options'     => array(
                           ''     => esc_html__( 'Default', 'bw-kidxtore' ),
                            'yes'      => esc_html__( 'yes', 'bw-kidxtore' ),
                            'no'      => esc_html__( 'No', 'bw-kidxtore' ),
                        ),
                        'title'       => esc_html__('Show meta data','bw-kidxtore'),
                        'desc'        => esc_html__('Show or hide meta data (author, date, comments, categories, tags) on blog page.','bw-kidxtore'),
                        'default'     => '',
                    ),
                    array(
                        'id'          => 'item_meta_select',
                        'type'        => 'select',
                         'multi'=>  true,
                        'title'       => esc_html__('Meta list','bw-kidxtore'),
                        'options'     => array(
                           'author'     => esc_html__( 'Author', 'bw-kidxtore' ),
                            'date'      => esc_html__( 'Date', 'bw-kidxtore' ),
                            'cats'      => esc_html__( 'Categories', 'bw-kidxtore' ),
                            'tags'      => esc_html__( 'Tags', 'bw-kidxtore' ),
                            'comments'  => esc_html__( 'Comments', 'bw-kidxtore' ),
                            'views'     => esc_html__( 'Total views', 'bw-kidxtore' ),
                        ),
                        'required'    => array('post_list_meta','=','yes'),
                    ),

                )
            ) );
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'List View Settings', 'bw-kidxtore' ),
                'id'               => 'blog-list',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'          => 'post_list_size',
                        'type'        => 'text',
                        'title'       => esc_html__('Custom list thumbnail size','bw-kidxtore'),
                        'desc'        => esc_html__('Set the thumbnail size to crop in px. Format: [width]x[height]. For example 300x300.','bw-kidxtore')
                    ),
                    array(
                        'id'          => 'post_list_excerpt',
                        'type'        => 'slider',
                        'title'       => esc_html__('Substring excerpt','bw-kidxtore'),
                        'min'         => 0,
                        'max'         => 999,
                        'step'        => 1,
                        'default'     => 999,
                        'desc'        => esc_html__('Set the number of character to get from excerpt content. Default is 999. Note: This value only applies on items that supports to show excerpt.','bw-kidxtore')
                    ),
                    array(
                        'id'          => 'post_list_item_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Item style','bw-kidxtore'),
                        'desc'        => esc_html__('Select the item style.','bw-kidxtore'),
                        'options'     => bzotech_get_post_list_style()
                    ),
                )
            ) );
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'Grid View Settings', 'bw-kidxtore' ),
                'id'               => 'blog-grid',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'          => 'post_grid_column',
                        'type'        => 'select',
                        'title'       => esc_html__('Grid column','bw-kidxtore'),
                        'default'     => '3',
                        'desc'=>esc_html__('Choose a style to active display','bw-kidxtore'),
                        'options'     => array(
                            '2' => esc_html__('2 column','bw-kidxtore'),
                            '3' =>esc_html__('3 column','bw-kidxtore'),
                            '4' =>esc_html__('4 column','bw-kidxtore'),
                            '5' =>esc_html__('5 column','bw-kidxtore'),
                            '6' =>esc_html__('6 column','bw-kidxtore'),
                        )
                    ),
                    array(
                        'id'          => 'post_grid_size',
                        'type'        => 'text',
                        'title'       => esc_html__('Custom thumbnail size','bw-kidxtore'),
                        'desc'        => esc_html__('Set the thumbnail size to crop in px. Format: [width]x[height]. For example 300x300.','bw-kidxtore')
                    ),
                    array(
                        'id'          => 'post_grid_excerpt',
                        'type'        => 'slider',
                        'title'       => esc_html__('Substring excerpt','bw-kidxtore'),
                        'min'         => 0,
                        'max'         => 999,
                        'step'        => 1,
                        'default'     => 999,
                        'desc'        => esc_html__('Set the number of character to get from excerpt content. Default is 999. Note: This value only applies on items that supports to show excerpt.','bw-kidxtore')
                    ),
                    array(
                        'id'          => 'post_grid_item_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Item style','bw-kidxtore'),
                        'desc'        =>esc_html__('Select the item style.','bw-kidxtore'),
                        'options'     => bzotech_get_post_style()
                    ),
                    array(
                        'id'          => 'post_grid_type',
                        'type'        => 'select',
                        'title'       => esc_html__('Display style','bw-kidxtore'),
                        'desc'        =>esc_html__('Select the grid display style.','bw-kidxtore'),
                        'options'     => array(
                            ''  => esc_html__('Default','bw-kidxtore'),
                            'grid-masonry'  => esc_html__('Masonry','bw-kidxtore'),
                            )
                    ),
                )
            ) );
            Redux::setSection( $bzotech_option_name, array(
                'title'            => esc_html__( 'Post Detail Settings', 'bw-kidxtore' ),
                'id'               => 'blog-post-detail',
                'subsection'       => true,
                'fields'           => array(                    
                    array(
                        'id'          => 'bzotech_style_post_detail',
                        'type'        => 'select',
                        'title'       => esc_html__('Single post style','bw-kidxtore'),
                        'options'     => array(
                            'style1'    => esc_html__('Default','bw-kidxtore'),
                            'style2'    => esc_html__('Style 2','bw-kidxtore'),
                        ),
                        'default'  => 'style1'
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_position_post',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar position','bw-kidxtore'),
                        'desc'        => esc_html__('Select the sidebar position for the single post page.','bw-kidxtore'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','bw-kidxtore'),
                            'left'  => esc_html__('Left','bw-kidxtore'),
                            'right' => esc_html__('Right','bw-kidxtore'),
                        ),
                        'default'  => 'right'
                    ),
                    array(
                        'id'          => 'bzotech_sidebar_post',
                        'type'        => 'select',
                        'title'       => esc_html__('Select sidebar','bw-kidxtore'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('bzotech_sidebar_position_post','not','no'),
                            array('bzotech_sidebar_position_post','not',''),
                        ),                   
                        'desc'        => esc_html__('Select the sidebar to display for the single post page.','bw-kidxtore'),
                        'default'     => 'blog-sidebar'
                    ),

                    array(
                        'id'          => 'bzotech_sidebar_style_post',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar style','bw-kidxtore'),
                        'desc'        => esc_html__('Select the sidebar style for the post page.','bw-kidxtore'),
                        'options'     => array(
                            'default'    => esc_html__('Default','bw-kidxtore'),
                            'style2'  => esc_html__('Style2','bw-kidxtore'),
                        ),
                        'required'    => array(
                            array('bzotech_sidebar_position_post','not','no'),
                            array('bzotech_sidebar_position_post','not',''),
                        ), 
                        'default'     => 'default'
                    ),
                    array(
                        'id'          => 'before_append_post_detail',
                        'title'       => esc_html__('Append content before post detail','bw-kidxtore'),
                        'type'        => 'select',
                        'options'     => bzotech_list_post_type('bzotech_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to before main content of post detail.','bw-kidxtore'),
                    ),
                    array(
                        'id'          => 'after_append_post_detail',
                        'title'       => esc_html__('Append content after post detail','bw-kidxtore'),
                        'type'        => 'select',
                        'options'     => bzotech_list_post_type('bzotech_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to after main content of post detail.','bw-kidxtore'),
                    ),
                    array(
                        'id'          => 'post_single_thumbnail',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show thumbnail/media','bw-kidxtore'),
                        'desc'        => 'Show/hide thumbnail image, gallery, media on post detail.',
                        'default'     => true,
                    ),                
                    array(
                        'id'          => 'post_single_size',
                        'title'       => esc_html__('Custom single image size','bw-kidxtore'),
                        'type'        => 'text',
                        'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','bw-kidxtore'),
                        'required'    => array('post_single_thumbnail','=',true),
                    ),
                    array(
                        'id'          => 'post_single_meta',
                        'type'        => 'select',
                        'options'     => array(
                           ''     => esc_html__( 'Default', 'bw-kidxtore' ),
                            'yes'      => esc_html__( 'yes', 'bw-kidxtore' ),
                            'no'      => esc_html__( 'No', 'bw-kidxtore' ),
                        ),
                        'title'       => esc_html__('Show meta data','bw-kidxtore'),
                        'desc'        => esc_html__('Show or hide meta data (author, date, comments, categories, tags) on post detail.','bw-kidxtore'),
                        'default'     => '',

                    ),
                     array(
                        'id'          => 'single_item_meta_select',
                        'type'        => 'select',
                        'multi'=>  true,
                        'title'       => esc_html__('Meta list','bw-kidxtore'),
                        'options'     => array(
                           'author'     => esc_html__( 'Author', 'bw-kidxtore' ),
                            'date'      => esc_html__( 'Date', 'bw-kidxtore' ),
                            'cats'      => esc_html__( 'Categories', 'bw-kidxtore' ),
                            'tags'      => esc_html__( 'Tags', 'bw-kidxtore' ),
                            'comments'  => esc_html__( 'Comments', 'bw-kidxtore' ),
                            'views'     => esc_html__( 'Total views', 'bw-kidxtore' ),
                        ),
                        'required'    => array('post_single_meta','=','yes'),
                    ),
                    array(
                        'id'          => 'post_single_author',
                        'type'        => 'switch',
                        'title'       => esc_html__('Author','bw-kidxtore'),
                        'desc'        => esc_html__('Show or hide author information in the post detail.','bw-kidxtore' ),
                        'default'     => false,
                    ),
                    array(
                        'id'          => 'post_single_navigation',
                        'type'        => 'switch',
                        'title'       => esc_html__('Post navigation','bw-kidxtore'),
                        'desc'        => esc_html__('Show or hide navigation to next or previous post in the post detail.','bw-kidxtore' ),
                        'default'     => false,
                    ),
                    // Related section
                    array(
                        'id'          => 'post_single_related',
                        'type'        => 'switch',
                        'title'       => esc_html__('Related post','bw-kidxtore'),
                        'desc'        => esc_html__('Show or hide related post in the post detail.','bw-kidxtore' ),
                        'default'     => false,
                    ),
                    array(
                        'id'          => 'post_single_related_title',
                        'type'        => 'text',
                        'title'       => esc_html__('Related title','bw-kidxtore'),
                        'desc'        => esc_html__('Enter title of related section.','bw-kidxtore'),
                        'required'    => array('post_single_related','=',true),
                    ),
                    array(
                        'id'          => 'post_single_related_number',
                        'type'        => 'text',
                        'title'       => esc_html__('Related number post','bw-kidxtore'),
                        'desc'        => esc_html__('Enter number of related post to display.','bw-kidxtore'),
                        'required'    => array('post_single_related','=',true),
                    ),
                    array(
                        'id'          => 'post_single_related_item',
                        'type'        => 'text',
                        'title'       => esc_html__('Related custom number item responsive','bw-kidxtore'),
                        'desc'        => esc_html__('Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.','bw-kidxtore'),
                        'required'    => array('post_single_related','=',true),
                    ),
                    array(
                        'id'          => 'post_single_related_item_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Related item style','bw-kidxtore'),
                        'desc'        =>esc_html__('Choose a style to active display','bw-kidxtore'),
                        'options'     => bzotech_get_post_style(),
                        'required'    => array('post_single_related','=',true),
                    ),
                )
            ) );
            // Blog & Post

            

           
        }
    }
    // End Redux help function
    // This is your option name where all the Redux data is stored.

    $bzotech_option_name = bzotech_get_option_name();

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $bzotech_option_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'bw-kidxtore' ),
        'page_title'           => esc_html__( 'Theme Options', 'bw-kidxtore' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyBFxhycc63fWy_uk126zW8KPtkD3Bay0jI',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => true,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        

        // OPTIONAL -> Give you extra features
        'page_priority'        => 59,//29
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        'menu_icon'            => get_template_directory_uri().'/assets/admin/image/logo.png',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_options_object' => false,
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

      

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/BZOTech',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://twitter.com/BzoTech',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.youtube.com/@bzotech9150',
        'title' => 'Find us on Youtube',
        'icon'  => 'el el-youtube'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.linkedin.com/in/bzotech/',
        'title' => 'Follow us on Linkedin',
        'icon'  => 'el el-linkedin'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.pinterest.com/Bzo_Tech',
        'title' => 'Follow us on Pinterest',
        'icon'  => 'el el-pinterest'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.instagram.com/bzotech/',
        'title' => 'Follow us on Instagram',
        'icon'  => 'el el-instagram'
    );
    Redux::setArgs( $bzotech_option_name, $args );

    /*
     * ---> END ARGUMENTS
     */    
    
    bzotech_switch_redux_option();


