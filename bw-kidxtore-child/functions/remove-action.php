<?php

function juniors_frontpage_lcp_images( $content ) {
    if ( is_front_page() ) {
        // Target banner-slide-1.webp
        $content = str_replace(
            '/wp-content/uploads/2025/10/banner-slide-1.webp',
            '/wp-content/uploads/2025/10/banner-slide-1.webp" fetchpriority="high" loading="eager',
            $content
        );

        // Target banner-slide-2.webp
        $content = str_replace(
            '/wp-content/uploads/2025/10/banner-slide-2.webp',
            '/wp-content/uploads/2025/10/banner-slide-2.webp" fetchpriority="high" loading="eager',
            $content
        );
    }
    return $content;
}
add_filter( 'the_content', 'juniors_frontpage_lcp_images' );



// https://juniors.com.mt/wp-content/uploads/elementor/google-fonts/css/robotoslab.css
function juniors_disable_elementor_fonts_on_home( $print ) {
    if ( is_front_page() ) {
        return false;  
    }
    return $print;
}
add_filter( 'elementor/frontend/print_google_fonts', 'juniors_disable_elementor_fonts_on_home' );

// https://juniors.com.mt/wp-content/themes/bw-kidxtore/assets/global/css/line-awesome.css
function juniors_remove_theme_iconpacks( $tabs ) {
    if ( is_front_page() ) {
        // Kill off Lineicons completely
        // unset( $tabs['lineicons'] );

        // // Optional: also remove ekiticons and bzotechicon if not needed
        unset( $tabs['ekiticons'] );
        unset( $tabs['bzoicon'] );
    }

    return $tabs;
}
add_filter( 'elementor/icons_manager/additional_tabs', 'juniors_remove_theme_iconpacks', 20 );

// https://juniors.com.mt/wp-content/plugins/woocommerce/assets/css/woocommerce.css
function mytheme_remove_woocommerce_styles() {
    if ( is_front_page() ) {
        wp_dequeue_style('woocommerce-general'); 
        wp_deregister_style('woocommerce-general');

        
        wp_dequeue_style('brands-styles-css'); 
        wp_deregister_style('brands-styles-css');

        wp_dequeue_style('brands-styles'); 
        wp_deregister_style('brands-styles');
    }
}
add_action('wp_enqueue_scripts', 'mytheme_remove_woocommerce_styles', 20);


// 1) Proper dequeue (use handle WITHOUT the "-css" suffix). Run late (priority 100).
function my_remove_side_wide_css_frontpage() {
    if ( is_admin() ) return;
    if ( ! ( is_front_page() || is_home() ) ) return;

    // Correct handles (these are what the theme used when enqueuing)
    wp_dequeue_style( 'bzotech-side-wide-global-siderbar-widget' );
    wp_deregister_style( 'bzotech-side-wide-global-siderbar-widget' );

    wp_dequeue_style( 'bzotech-side-wide-global-product-items' );
    wp_deregister_style( 'bzotech-side-wide-global-product-items' );

    wp_dequeue_style( 'bzotech-side-wide-global-preload' );
    wp_deregister_style( 'bzotech-side-wide-global-preload' );

    wp_dequeue_style( 'bzotech-el-mailchimp' );
    wp_deregister_style( 'bzotech-el-mailchimp' );
    
}
add_action( 'wp_enqueue_scripts', 'my_remove_side_wide_css_frontpage', 100 );




// 2) Fallback: strip any remaining <link> tags that still made it into the HTML
function my_start_buffer_strip_side_wide_css() {
    if ( is_admin() ) return;
    if ( ! ( is_front_page() || is_home() ) ) return;
    ob_start( 'my_strip_side_wide_css_from_buffer' );
}
add_action( 'template_redirect', 'my_start_buffer_strip_side_wide_css', 1 );

function my_strip_side_wide_css_from_buffer( $buffer ) {
    // Remove by id attribute (WP prints handle + '-css' as id)
    $buffer = preg_replace(
        '#<link[^>]+id=["\']bzotech-side-wide-global-siderbar-widget-css["\'][^>]*>#i',
        '',
        $buffer
    );
    $buffer = preg_replace(
        '#<link[^>]+id=["\']bzotech-side-wide-global-product-items-css["\'][^>]*>#i',
        '',
        $buffer
    );

    // Extra fallback: remove by href path (in case id/handle is different)
    $buffer = preg_replace(
        '#<link[^>]+href=["\'][^"\']*/side-wide/siderbar-widget\.css["\'][^>]*>#i',
        '',
        $buffer
    );
    $buffer = preg_replace(
        '#<link[^>]+href=["\'][^"\']*/side-wide/product-items\.css["\'][^>]*>#i',
        '',
        $buffer
    );

    return $buffer;
}

function mytheme_remove_all_loyale_scripts() {
    if ( is_front_page() ) {
        // Try normal dequeue 
    
        wp_dequeue_script('loyale-sso-web-js');
        wp_deregister_script('loyale-sso-web-js');

        wp_dequeue_script('loyale-sso-script-js');
        wp_deregister_script('loyale-sso-script-js');

        // Force removal of hardcoded scripts via output buffering
        add_action('template_redirect', function () {
            ob_start(function($buffer) {
                // Remove external script
                $buffer = preg_replace(
                    '#<script[^>]+id=["\']loyale-sso-web-js["\'][^>]*></script>#i',
                    '',
                    $buffer
                );
                // Remove local plugin script
                $buffer = preg_replace(
                    '#<script[^>]+id=["\']loyale-sso-script-js["\'][^>]*></script>#i',
                    '',
                    $buffer
                );
                // Remove inline settings script
                $buffer = preg_replace(
                    '#<script[^>]+id=["\']loyale-sso-script-js-before["\'][^>]*>.*?</script>#is',
                    '',
                    $buffer
                );
                return $buffer;
            });
        });
    }
}
add_action('wp_enqueue_scripts', 'mytheme_remove_all_loyale_scripts', 20);

// Remove all Loyale SSO scripts and dns-prefetch from homepage
add_action('template_redirect', function () {
    if ( is_front_page() ) {
        ob_start(function($buffer) {
            // Remove external script with id="loyale-sso-web-js"
            $buffer = preg_replace(
                '#<script[^>]+id=["\']loyale-sso-web-js["\'][^>]*></script>#i',
                '',
                $buffer
            );

            // Remove local script with id="loyale-sso-script-js"
            $buffer = preg_replace(
                '#<script[^>]+id=["\']loyale-sso-script-js["\'][^>]*></script>#i',
                '',
                $buffer
            );

            // Remove inline settings with id="loyale-sso-script-js-before"
            $buffer = preg_replace(
                '#<script[^>]+id=["\']loyale-sso-script-js-before["\'][^>]*>.*?</script>#is',
                '',
                $buffer
            );

            // Remove <link rel="dns-prefetch" href="//sso.loyale.io">
            $buffer = preg_replace(
                '#<link[^>]+href=["\']\/\/sso\.loyale\.io["\'][^>]*>#i',
                '',
                $buffer
            );

            return $buffer;
        });
    }
});



add_filter( 'style_loader_tag', function( $html, $handle ) {
    // Run only on front page
    if ( ! is_front_page() ) {
        return $html;
    }

    // Exact handles to defer (add any others you know)
    $defer_handles = [
        'xoo-wsc-fonts',
        'xoo-wsc-style',
        'bw-kidxtore-style',
        'bw-kidxtore-style-css',
        'homepage-style-css',
        'homepage-style',
        // include both possible variants just in case:
        'elementor-icons-shared-0',
        'elementor-icons-shared-0-css',
        'elementor-icons-lineicons-css',
        'elementor-icons-lineicons',
        'bzotech-theme-custom-style-css',
        'bzotech-theme-custom-style',
        'elementskit-css-icon-control-css',
        'elementskit-css-icon-control',
        'bzotech-el-slider-css',
        'bzotech-el-slider',
        'e-animation-fadeInUp-css',
        'e-animation-fadeInUp',
        'e-animation-fadeInDown-css',
        'e-animation-fadeInDown',
        'bzotech-theme-style',
        'bzotech-theme-style-css',
        'gravity_forms_theme_framework-css',
        'gravity_forms_theme_framework',
        'gravity_forms_theme_foundation-css',
        'gravity_forms_theme_foundation',
        'gravity_forms_theme_reset',
        'gravity_forms_theme_reset-css',

    ];

    // Also defer any handle that *starts with* elementor-icons-shared
    $should_defer = in_array( $handle, $defer_handles, true )
                    || preg_match( '/^elementor-icons-shared/i', $handle );

    if ( $should_defer ) {
        // Replace media="all" or media='all' robustly
        if ( preg_match( '/\bmedia=(["\'])all\1/i', $html ) ) {
            $html = preg_replace(
                '/\bmedia=(["\'])all\1/i',
                'media="print" onload="this.media=\'all\'"',
                $html
            );
        } else {
            // If no media attribute present, insert the print/onload before the tag closes
            $html = preg_replace(
                '/(\/?>)$/',
                ' media="print" onload="this.media=\'all\'"$1',
                $html
            );
        }
    }

    return $html;
}, 10, 2 ); 


add_action('wp_head', function () {
    if ( !is_front_page() && !is_shop() ) { 

    if ( ! defined( 'JR_MAP_API_KEY' ) ) {
        error_log( 'Brevo API Key is not defined.' );
        return; 
    }
    
    $map_api_key = JR_MAP_API_KEY;

    ?>
    <script>
        window.mapsToInit = [];
        function initMap() {
            if (Array.isArray(window.mapsToInit)) {
                window.mapsToInit.forEach(fn => {
                    try { fn(); } catch (e) { console.error("Map init error", e); }
                });
            }
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo $map_api_key; ?>&callback=initMap">
    </script>
    <?php
    }
});