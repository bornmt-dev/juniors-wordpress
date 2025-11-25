<?php
if(!class_exists('Bzotech_CoursesController'))
{
    class Bzotech_CoursesController{

        static function _init()
        {
            if(function_exists('bzotech_reg_post_type'))
            {
                add_action('init',array(__CLASS__,'_add_post_type'));
            }
        }

        static function _add_post_type(){
            $labels = array(
                'name'               => esc_html__('Courses','bw-kidxtore'),
                'singular_name'      => esc_html__('Courses','bw-kidxtore'),
                'menu_name'          => esc_html__('Courses','bw-kidxtore'),
                'name_admin_bar'     => esc_html__('Courses','bw-kidxtore'),
                'add_new'            => esc_html__('Add New','bw-kidxtore'),
                'add_new_item'       => esc_html__( 'Add New Courses','bw-kidxtore' ),
                'new_item'           => esc_html__( 'New Courses', 'bw-kidxtore' ),
                'edit_item'          => esc_html__( 'Edit Courses', 'bw-kidxtore' ),
                'view_item'          => esc_html__( 'View Courses', 'bw-kidxtore' ),
                'all_items'          => esc_html__( 'All Courses', 'bw-kidxtore' ),
                'search_items'       => esc_html__( 'Search Courses', 'bw-kidxtore' ),
                'parent_item_colon'  => esc_html__( 'Parent Courses:', 'bw-kidxtore' ),
                'not_found'          => esc_html__( 'No Courses found.', 'bw-kidxtore' ),
                'not_found_in_trash' => esc_html__( 'No Courses found in Trash.', 'bw-kidxtore' )
            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'courses'),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => null,
                'menu_icon'          => get_template_directory_uri() . "/assets/admin/image/footer-icon.png",
                'supports'           => array( 'title', 'editor', 'revisions','thumbnail' )
            );

            bzotech_reg_post_type('bzotech_courses',$args);
            self::_add_custom_taxonomy();
        }
        static function _add_custom_taxonomy (){
            bzotech_reg_taxonomy(
                'courses_category',
                'bzotech_courses',
                array(
                    'label' => esc_html__( 'Courses Category', 'bw-kidxtore' ),
                    'rewrite' => array( 'slug' => 'courses-category', 'bw-kidxtore' ),
                    'hierarchical' => true,
                    'query_var'  => true
                )
            );
            bzotech_reg_taxonomy(
                'bzotech_courses_teacher',
                'bzotech_courses',
                array(
                    'label' => esc_html__( 'Teacher', 'bw-kidxtore' ),
                    'rewrite' => array( 'slug' => 'teacher', 'bw-kidxtore' ),
                    'hierarchical' => true,
                    'query_var'  => true
                )
            );
            bzotech_reg_taxonomy(
                'bzotech_courses_attribute',
                'bzotech_courses',
                array(
                    'label' => esc_html__( 'Attribute', 'bw-kidxtore' ),
                    'rewrite' => array( 'slug' => 'attribute', 'bw-kidxtore' ),
                    'hierarchical' => true,
                    'query_var'  => true
                )
            );
        }
        
    }

    Bzotech_CoursesController::_init();

}