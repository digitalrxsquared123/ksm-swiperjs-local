<?php
function ollie_child_enqueue_styles() {
    wp_enqueue_style(
        'ollie-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array(),
        '1.0.2'
    );
}
add_action('wp_enqueue_scripts', 'ollie_child_enqueue_styles');


function ollie_child_enqueue_fonts() {
    wp_enqueue_style(
        'ksm-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@600;700;800&display=swap',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'ollie_child_enqueue_fonts');
add_action('enqueue_block_editor_assets', 'ollie_child_enqueue_fonts');

/* Preconnect to Google Fonts servers */
function ksm_google_fonts_preconnect() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action('wp_head', 'ksm_google_fonts_preconnect', 1);

/************************************************************Enqueue Swiper JS********************************/
function ksm_enqueue_swiper() {
    if ( is_page( '67' ) ) {
        wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.css', array(), '14.0.1' );
        wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.js', array(), '14.0.1', true );

        // Your own settings file, loaded after Swiper
        wp_enqueue_script(
            'ksm-swiper-init',
            get_stylesheet_directory_uri() . '/js/swiper-init.js',
            array( 'swiper-js' ),   // waits for Swiper to load first
            '1.0',
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'ksm_enqueue_swiper' );




/******************Change  mobile hamburger menu breakpoint**********************/

function ksm_navigation_breakpoint() {
    $handle = 'wp-block-navigation';
    $breakpoint_css = '@media (max-width: 900px) {
        .wp-block-navigation__responsive-container:not(.is-menu-open.is-menu-open) {
            display: none !important;
        }
        .wp-block-navigation__responsive-container-open:not(.always-shown) {
            display: flex !important;
        }
    }
    @media (min-width: 901px) {
        .wp-block-navigation__responsive-container-open {
            display: none !important;
        }
        .wp-block-navigation__responsive-container:not(.is-menu-open) {
            display: flex !important;
            position: relative;
            background-color: unset;
        }
    }';
    wp_add_inline_style($handle, $breakpoint_css);
}
add_action('wp_enqueue_scripts', 'ksm_navigation_breakpoint');


/*************************************For the header scroll script***********************************************************/

function ksm_enqueue_scripts() {
    wp_enqueue_script(
        'ksm-scripts',
        get_stylesheet_directory_uri() . '/js/ksm-scripts.js',
        array(),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'ksm_enqueue_scripts');


/* Add ksm-header-ready class to body server-side */
function ksm_header_body_class($classes) {
    $classes[] = 'ksm-header-ready';
    return $classes;
}
add_filter('body_class', 'ksm_header_body_class');


/************************************Fixing delay in logo loading versus rest of header ****************************************************/

/* Prioritize logo image loading */
function ksm_logo_fetchpriority($html) {
    $html = str_replace('decoding="async"', 'decoding="sync"', $html);
    $html = str_replace('<img ', '<img fetchpriority="high" ', $html);
    return $html;
}
add_filter('get_custom_logo', 'ksm_logo_fetchpriority');

/* Force load WordPress Interactivity API */
function ksm_force_interactivity() {
    wp_enqueue_script( 'wp-interactivity' );
}
add_action( 'wp_enqueue_scripts', 'ksm_force_interactivity' );


/************************************* Load Contact Form 7 scripts only on contact page ***********************************/
// function ksm_dequeue_cf7_scripts() {
//     if (!is_page('contact-us')) {
//         wp_dequeue_script('contact-form-7');
//         wp_dequeue_style('contact-form-7');
//         wp_dequeue_script('wpcf7-recaptcha');
//         wp_dequeue_script('google-recaptcha');
//     }
// }
// add_action('wp_enqueue_scripts', 'ksm_dequeue_cf7_scripts', 100);