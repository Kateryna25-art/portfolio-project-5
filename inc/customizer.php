<?php
defined( 'ABSPATH' ) || exit;

function blog_customizer_defaults() {
    return array(
        'subscribe_url' => '#subscribe',
        'subscribe_form' => '',
        'address'       => 'Finstreet 118 2561 Fintown',
        'email'         => 'Hello@finsweet.com',
        'phone'         => '020 7993 2905',
        'facebook'      => '#',
        'twitter'       => '#',
        'instagram'     => '#',
        'linkedin'      => '#',
    );
}

function blog_option( $name ) {
    $defaults = blog_customizer_defaults();
    return get_theme_mod( 'blog_' . $name, isset( $defaults[ $name ] ) ? $defaults[ $name ] : '' );
}

function blog_customize_register( $wp_customize ) {

    $wp_customize->add_section( 'blog_contacts', array(
        'title'    => __( 'Contacts & Social Links', 'blog' ),
        'priority' => 30,
    ) );

    $fields = array(
        'subscribe_url' => array( __( 'Header "Subscribe" button link', 'blog' ), 'esc_url_raw' ),
        'subscribe_form' => array( __( 'Footer subscribe form shortcode (Contact Form 7)', 'blog' ), 'sanitize_text_field' ),
        'address'       => array( __( 'Address', 'blog' ), 'sanitize_text_field' ),
        'email'         => array( __( 'Email', 'blog' ), 'sanitize_email' ),
        'phone'         => array( __( 'Phone', 'blog' ), 'sanitize_text_field' ),
    );

    foreach ( blog_social_networks() as $key => $label ) {
        $fields[ $key ] = array( $label, 'esc_url_raw' );
    }

    $defaults = blog_customizer_defaults();

    foreach ( $fields as $key => $field ) {
        $wp_customize->add_setting( 'blog_' . $key, array(
            'default'           => $defaults[ $key ],
            'sanitize_callback' => $field[1],
        ) );

        $wp_customize->add_control( 'blog_' . $key, array(
            'label'   => $field[0],
            'section' => 'blog_contacts',
            'type'    => 'text',
        ) );
    }
}
add_action( 'customize_register', 'blog_customize_register' );
