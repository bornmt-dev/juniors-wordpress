<?php
if(!class_exists('Bzotech_FooterController'))
{
    class Bzotech_FooterController{

        static function _init()
        {
            if(function_exists('bzotech_reg_post_type'))
            {
                add_action('init',array(__CLASS__,'_add_post_type'));
            }
        }

        static function _add_post_type()
        {
            $labels = array(
                'name'               => esc_html__('Footer Page','bw-kidxtore'),
                'singular_name'      => esc_html__('Footer Page','bw-kidxtore'),
                'menu_name'          => esc_html__('Footer Page','bw-kidxtore'),
                'name_admin_bar'     => esc_html__('Footer Page','bw-kidxtore'),
                'add_new'            => esc_html__('Add New','bw-kidxtore'),
                'add_new_item'       => esc_html__( 'Add New Footer','bw-kidxtore' ),
                'new_item'           => esc_html__( 'New Footer', 'bw-kidxtore' ),
                'edit_item'          => esc_html__( 'Edit Footer', 'bw-kidxtore' ),
                'view_item'          => esc_html__( 'View Footer', 'bw-kidxtore' ),
                'all_items'          => esc_html__( 'All Footer', 'bw-kidxtore' ),
                'search_items'       => esc_html__( 'Search Footer', 'bw-kidxtore' ),
                'parent_item_colon'  => esc_html__( 'Parent Footer:', 'bw-kidxtore' ),
                'not_found'          => esc_html__( 'No Footer found.', 'bw-kidxtore' ),
                'not_found_in_trash' => esc_html__( 'No Footer found in Trash.', 'bw-kidxtore' )
            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'bzotech_footer' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => null,                
                'menu_icon'          => get_template_directory_uri() . "/assets/admin/image/footer-icon.png",
                'supports'           => array( 'title', 'editor', 'revisions' )
            );

            bzotech_reg_post_type('bzotech_footer',$args);
        }
    }

    Bzotech_FooterController::_init();

}