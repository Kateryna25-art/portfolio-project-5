<?php
defined( 'ABSPATH' ) || exit;

define( 'BLOG_THEME_DIR', get_template_directory() );
define( 'BLOG_THEME_URI', get_template_directory_uri() );

require BLOG_THEME_DIR . '/inc/helpers.php';
require BLOG_THEME_DIR . '/inc/customizer.php';
require BLOG_THEME_DIR . '/inc/post-types.php';
require BLOG_THEME_DIR . '/inc/acf.php';

add_filter( 'wpcf7_load_css', '__return_false' );
add_filter( 'wpcf7_autop_or_not', '__return_false' );

function blog_hide_inactive_cf7_shortcode( $content ) {
    if ( ! shortcode_exists( 'contact-form-7' ) && false !== strpos( $content, '[contact-form-7' ) ) {
        $content = preg_replace( '/\[contact-form-7[^\]]*\]/', '', $content );
    }
    return $content;
}
add_filter( 'the_content', 'blog_hide_inactive_cf7_shortcode', 9 );

function blog_asset_version( $path ) {
    $file = BLOG_THEME_DIR . $path;
    return file_exists( $file ) ? filemtime( $file ) : null;
}

function blog_theme_scripts() {
    wp_enqueue_style( 'blog-main', BLOG_THEME_URI . '/assets/css/main.css', array(), blog_asset_version( '/assets/css/main.css' ) );

    wp_enqueue_script( 'blog-main', BLOG_THEME_URI . '/assets/js/main.js', array(), blog_asset_version( '/assets/js/main.js' ), array(
        'in_footer' => true,
        'strategy'  => 'defer',
    ) );
}
add_action( 'wp_enqueue_scripts', 'blog_theme_scripts' );

function blog_preload_fonts() {
    foreach ( array( 'sen-latin', 'inter-latin' ) as $font ) {
        printf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url( BLOG_THEME_URI . '/assets/fonts/' . $font . '.woff2' ) );
    }
}
add_action( 'wp_head', 'blog_preload_fonts', 1 );

function blog_preload_hero() {
    if ( ! is_front_page() ) {
        return;
    }
    $background = blog_hero_background();
    if ( $background['url'] ) {
        printf( '<link rel="preload" href="%s" as="image" fetchpriority="high">' . "\n", esc_url( $background['url'] ) );
    }
}
add_action( 'wp_head', 'blog_preload_hero', 2 );

function blog_theme_setup() {
    load_theme_textdomain( 'blog', BLOG_THEME_DIR . '/languages' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo', array(
        'height'      => 32,
        'width'       => 160,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
    add_theme_support( 'responsive-embeds' );

    add_image_size( 'blog-hero', 1440, 720, true );
    add_image_size( 'blog-cover', 1280, 582, true );
    add_image_size( 'blog-card', 669, 352, true );
    add_image_size( 'blog-avatar', 128, 128, true );
    add_image_size( 'blog-list', 490, 318, true );
    add_image_size( 'blog-featured', 515, 359, true );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'blog' ),
        'footer'  => __( 'Footer Menu', 'blog' ),
    ) );
}
add_action( 'after_setup_theme', 'blog_theme_setup' );

function blog_posts_query( $query ) {
    if ( is_admin() || ! $query->is_main_query() || ! $query->is_home() ) {
        return;
    }

    $query->set( 'posts_per_page', 5 );
    $query->set( 'ignore_sticky_posts', true );

    $featured = blog_get_featured_post();
    if ( $featured ) {
        $query->set( 'post__not_in', array( $featured->ID ) );
    }
}
add_action( 'pre_get_posts', 'blog_posts_query' );
