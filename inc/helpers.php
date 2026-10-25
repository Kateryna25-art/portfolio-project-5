<?php
defined( 'ABSPATH' ) || exit;

function blog_field( $name, $default = '', $post_id = false ) {
    if ( function_exists( 'get_field' ) ) {
        $value = get_field( $name, $post_id );
        if ( ! empty( $value ) ) {
            return $value;
        }
    }
    return $default;
}

function blog_front_field( $name, $default = '' ) {
    $front_id = (int) get_option( 'page_on_front' );
    return $front_id ? blog_field( $name, $default, $front_id ) : $default;
}

function blog_image_uri( $file ) {
    return BLOG_THEME_URI . '/assets/images/' . ltrim( $file, '/' );
}

function blog_image( $image, $size = 'large', $attr = array() ) {
    if ( is_array( $image ) && ! empty( $image['ID'] ) ) {
        return wp_get_attachment_image( $image['ID'], $size, false, $attr );
    }
    return '';
}

function blog_link( $link, $default_title, $default_url = '#' ) {
    return array(
        'title'  => ! empty( $link['title'] ) ? $link['title'] : $default_title,
        'url'    => ! empty( $link['url'] ) ? $link['url'] : $default_url,
        'target' => ! empty( $link['target'] ) ? $link['target'] : '',
    );
}

function blog_link_target( $link ) {
    return ! empty( $link['target'] ) ? ' target="' . esc_attr( $link['target'] ) . '" rel="noopener"' : '';
}

function blog_icon( $name, $size = 16 ) {
    static $cache = array();

    if ( ! isset( $cache[ $name ] ) ) {
        $file           = BLOG_THEME_DIR . '/assets/images/icons/' . sanitize_file_name( $name ) . '.svg';
        $cache[ $name ] = file_exists( $file ) ? (string) file_get_contents( $file ) : '';
    }

    if ( ! preg_match( '/<svg[^>]*viewBox="([^"]+)"[^>]*>(.*)<\/svg>/s', $cache[ $name ], $svg ) ) {
        return '';
    }

    $box    = array_map( 'floatval', preg_split( '/[\s,]+/', trim( $svg[1] ) ) );
    $height = ( count( $box ) === 4 && $box[2] > 0 ) ? round( $size * $box[3] / $box[2] ) : $size;

    return sprintf(
        '<svg class="icon icon--%1$s" width="%2$d" height="%3$d" viewBox="%4$s" fill="none" aria-hidden="true" focusable="false">%5$s</svg>',
        esc_attr( $name ),
        (int) $size,
        (int) $height,
        esc_attr( $svg[1] ),
        trim( $svg[2] )
    );
}

function blog_get_featured_post() {
    static $post = false;

    if ( false === $post ) {
        $sticky = get_option( 'sticky_posts' );
        $posts  = get_posts( array(
            'posts_per_page'      => 1,
            'post__in'            => $sticky ? $sticky : null,
            'ignore_sticky_posts' => true,
        ) );
        $post   = $posts ? $posts[0] : null;
    }

    return $post;
}

function blog_hero_background() {
    $custom = blog_front_field( 'hero_image' );
    if ( ! empty( $custom['ID'] ) ) {
        return array( 'url' => (string) wp_get_attachment_image_url( $custom['ID'], 'full' ), 'overlay' => false );
    }

    $featured = blog_get_featured_post();
    $url      = $featured ? (string) get_the_post_thumbnail_url( $featured, 'blog-hero' ) : '';
    return array( 'url' => $url, 'overlay' => (bool) $url );
}

function blog_post_data( $post ) {
    $category = get_the_category( $post->ID );

    return array(
        'title'        => get_the_title( $post ),
        'excerpt'      => get_the_excerpt( $post ),
        'url'          => get_permalink( $post ),
        'thumbnail_id' => get_post_thumbnail_id( $post ),
        'category'     => $category ? $category[0]->name : '',
        'category_url' => $category ? get_category_link( $category[0] ) : '',
        'meta'         => array(
            'author'     => get_the_author_meta( 'display_name', $post->post_author ),
            'author_url' => get_author_posts_url( $post->post_author ),
            'date'       => get_the_date( '', $post ),
        ),
    );
}

function blog_image_alt( $attachment_id, $fallback = '' ) {
    $alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
    return $alt ? $alt : $fallback;
}

function blog_shortcode_available( $shortcode ) {
    return preg_match( '/\[([\w-]+)/', $shortcode, $match ) && shortcode_exists( $match[1] );
}

function blog_page_url( $slug ) {
    if ( 'blog' === $slug && get_option( 'page_for_posts' ) ) {
        $page = get_post( (int) get_option( 'page_for_posts' ) );
    } else {
        $page = get_page_by_path( $slug );
    }

    return $page && 'publish' === get_post_status( $page ) ? get_permalink( $page ) : '';
}

function blog_nav_fallback( $args ) {
    $items = array(
        'Home'       => home_url( '/' ),
        'Blog'       => blog_page_url( 'blog' ),
        'About Us'   => blog_page_url( 'about-us' ),
        'Contact us' => blog_page_url( 'contact-us' ),
    );

    if ( 'footer' === $args['theme_location'] ) {
        $items['Privacy Policy'] = get_privacy_policy_url() ? get_privacy_policy_url() : blog_page_url( 'privacy-policy' );
    }

    echo '<nav class="' . esc_attr( $args['container_class'] ) . '"><ul class="' . esc_attr( $args['menu_class'] ) . '">';
    foreach ( array_filter( $items ) as $title => $url ) {
        echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $title ) . '</a></li>';
    }
    echo '</ul></nav>';
}

function blog_social_networks() {
    return array(
        'facebook'  => 'Facebook',
        'twitter'   => 'Twitter',
        'instagram' => 'Instagram',
        'linkedin'  => 'LinkedIn',
    );
}
