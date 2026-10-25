<?php
defined( 'ABSPATH' ) || exit;

function blog_register_post_types() {

    register_post_type( 'testimonial', array(
        'labels'        => array(
            'name'          => __( 'Testimonials', 'blog' ),
            'singular_name' => __( 'Testimonial', 'blog' ),
            'add_new_item'  => __( 'Add New Testimonial', 'blog' ),
            'edit_item'     => __( 'Edit Testimonial', 'blog' ),
        ),
        'public'        => false,
        'show_ui'       => true,
        'menu_icon'     => 'dashicons-format-quote',
        'menu_position' => 20,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
    ) );
}
add_action( 'init', 'blog_register_post_types' );
