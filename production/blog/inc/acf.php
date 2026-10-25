<?php
defined( 'ABSPATH' ) || exit;

function blog_acf_field( $group, $name, $label, $type = 'text', $args = array() ) {
    return array_merge( array(
        'key'   => 'field_blog_' . $group . '_' . $name,
        'name'  => $name,
        'label' => $label,
        'type'  => $type,
    ), $args );
}

function blog_acf_tab( $group, $label ) {
    return blog_acf_field( $group, sanitize_title( $label ), $label, 'tab', array( 'name' => '' ) );
}

function blog_register_acf_fields() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    $image = array( 'return_format' => 'array', 'preview_size' => 'medium' );

    $home_fields = array(
        blog_acf_tab( 'home', 'Hero' ),
        blog_acf_field( 'home', 'hero_image', 'Hero background (1440×720)', 'image', array_merge( $image, array(
            'instructions' => 'Optional. If empty, the featured image of the sticky post is used with a dark overlay.',
        ) ) ),

        blog_acf_tab( 'home', 'About Us' ),
        blog_acf_field( 'home', 'about_label', 'Label' ),
        blog_acf_field( 'home', 'about_title', 'Title', 'textarea', array( 'rows' => 2 ) ),
        blog_acf_field( 'home', 'about_text', 'Text', 'textarea', array( 'rows' => 3 ) ),
        blog_acf_field( 'home', 'about_link', 'Link', 'link' ),
        blog_acf_field( 'home', 'mission_label', 'Label (mission)' ),
        blog_acf_field( 'home', 'mission_title', 'Title (mission)', 'textarea', array( 'rows' => 2 ) ),
        blog_acf_field( 'home', 'mission_text', 'Text (mission)', 'textarea', array( 'rows' => 4 ) ),

        blog_acf_tab( 'home', 'Categories' ),
        blog_acf_field( 'home', 'categories_title', 'Title' ),

        blog_acf_tab( 'home', 'Why we started' ),
        blog_acf_field( 'home', 'why_image', 'Image (949×705)', 'image', $image ),
        blog_acf_field( 'home', 'why_image_mobile', 'Image for tablet and mobile', 'image', array_merge( $image, array(
            'instructions' => 'Optional. Alternative crop for screens up to 991px.',
        ) ) ),
        blog_acf_field( 'home', 'why_label', 'Label' ),
        blog_acf_field( 'home', 'why_title', 'Title', 'textarea', array( 'rows' => 2 ) ),
        blog_acf_field( 'home', 'why_text', 'Text', 'textarea', array( 'rows' => 3 ) ),
        blog_acf_field( 'home', 'why_link', 'Button', 'link' ),

        blog_acf_tab( 'home', 'Authors' ),
        blog_acf_field( 'home', 'authors_title', 'Title' ),

        blog_acf_tab( 'home', 'Featured in' ),
        blog_acf_field( 'home', 'logos_label_top', 'Caption (line 1)' ),
        blog_acf_field( 'home', 'logos_label', 'Caption (line 2)' ),
    );

    for ( $i = 1; $i <= 5; $i++ ) {
        $home_fields[] = blog_acf_field( 'home', 'logo_' . $i, 'Logo ' . $i, 'image', $image );
    }

    $home_fields = array_merge( $home_fields, array(
        blog_acf_tab( 'home', 'Testimonials' ),
        blog_acf_field( 'home', 'testimonials_label', 'Label' ),
        blog_acf_field( 'home', 'testimonials_title', 'Title', 'textarea', array( 'rows' => 2 ) ),
        blog_acf_field( 'home', 'testimonials_text', 'Text', 'textarea', array( 'rows' => 2 ) ),

        blog_acf_tab( 'home', 'Join' ),
        blog_acf_field( 'home', 'join_title', 'Title', 'textarea', array( 'rows' => 2 ) ),
        blog_acf_field( 'home', 'join_text', 'Text', 'textarea', array( 'rows' => 2 ) ),
        blog_acf_field( 'home', 'join_link', 'Button', 'link' ),
    ) );

    acf_add_local_field_group( array(
        'key'            => 'group_blog_home',
        'title'          => 'Home Page',
        'fields'         => $home_fields,
        'location'       => array( array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ) ),
        'hide_on_screen' => array( 'the_content' ),
    ) );

    $about_fields = array(
        blog_acf_tab( 'about', 'Intro' ),
        blog_acf_field( 'about', 'intro_label', 'Label' ),
        blog_acf_field( 'about', 'intro_title', 'Title', 'textarea', array( 'rows' => 2 ) ),
        blog_acf_field( 'about', 'intro_text', 'Text', 'textarea', array( 'rows' => 3 ) ),
        blog_acf_field( 'about', 'intro_image', 'Image (1280×444)', 'image', $image ),
        blog_acf_field( 'about', 'intro_image_mobile', 'Image for tablet and mobile', 'image', array_merge( $image, array(
            'instructions' => 'Optional. Alternative crop for screens up to 991px.',
        ) ) ),
    );
    for ( $i = 1; $i <= 3; $i++ ) {
        $about_fields[] = blog_acf_field( 'about', 'stat_' . $i . '_number', 'Number ' . $i, 'text', array( 'wrapper' => array( 'width' => 30 ) ) );
        $about_fields[] = blog_acf_field( 'about', 'stat_' . $i . '_label', 'Caption ' . $i, 'text', array( 'wrapper' => array( 'width' => 70 ) ) );
    }
    foreach ( array( 'mission' => 'Mission', 'vision' => 'Vision' ) as $key => $label ) {
        $about_fields[] = blog_acf_tab( 'about', $label );
        $about_fields[] = blog_acf_field( 'about', $key . '_label', 'Label' );
        $about_fields[] = blog_acf_field( 'about', $key . '_title', 'Title', 'textarea', array( 'rows' => 2 ) );
        $about_fields[] = blog_acf_field( 'about', $key . '_text', 'Text', 'textarea', array( 'rows' => 3 ) );
    }
    foreach ( array( 'team' => 'Our team', 'story' => 'Why we started' ) as $key => $label ) {
        $about_fields[] = blog_acf_tab( 'about', $label );
        $about_fields[] = blog_acf_field( 'about', $key . '_title', 'Title' );
        $about_fields[] = blog_acf_field( 'about', $key . '_subtitle', 'Subtitle', 'textarea', array( 'rows' => 2 ) );
        $about_fields[] = blog_acf_field( 'about', $key . '_text', 'Text', 'textarea', array( 'rows' => 4 ) );
        $about_fields[] = blog_acf_field( 'about', $key . '_image', 'Image (624×480)', 'image', $image );
    }

    acf_add_local_field_group( array(
        'key'            => 'group_blog_about',
        'title'          => 'About Us Page',
        'fields'         => $about_fields,
        'location'       => array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-about-us.php' ) ) ),
        'hide_on_screen' => array( 'the_content' ),
    ) );

    $is_contacts = array( array( array( 'field' => 'field_blog_page_page_layout', 'operator' => '==', 'value' => 'contacts' ) ) );
    $contacts    = array( 'conditional_logic' => $is_contacts );

    acf_add_local_field_group( array(
        'key'      => 'group_blog_page',
        'title'    => 'Page Settings',
        'fields'   => array(
            blog_acf_field( 'page', 'page_layout', 'Page layout', 'select', array(
                'choices'       => array(
                    'default'  => 'Default (title and last updated date)',
                    'contacts' => 'Contacts (header, working hours, form from content)',
                ),
                'default_value' => 'default',
            ) ),
            blog_acf_field( 'page', 'contacts_label', 'Label', 'text', $contacts ),
            blog_acf_field( 'page', 'contacts_title', 'Title', 'text', $contacts ),
            blog_acf_field( 'page', 'contacts_text', 'Text', 'textarea', array_merge( $contacts, array( 'rows' => 2 ) ) ),
            blog_acf_field( 'page', 'hours_label', 'Working hours: label', 'text', $contacts ),
            blog_acf_field( 'page', 'hours_title', 'Working hours', 'textarea', array_merge( $contacts, array( 'rows' => 2 ) ) ),
            blog_acf_field( 'page', 'hours_text', 'Working hours: note', 'text', $contacts ),
            blog_acf_field( 'page', 'phone_label', 'Contacts: label', 'text', $contacts ),
        ),
        'location' => array( array(
            array( 'param' => 'post_type', 'operator' => '==', 'value' => 'page' ),
            array( 'param' => 'page_template', 'operator' => '==', 'value' => 'default' ),
        ) ),
        'position' => 'side',
    ) );

    acf_add_local_field_group( array(
        'key'      => 'group_blog_post',
        'title'    => 'Post Cover',
        'fields'   => array(
            blog_acf_field( 'post', 'post_cover', 'Cover image (1280×582)', 'image', array_merge( $image, array(
                'instructions' => 'Optional. Wide image on the post page. If empty, the featured image is used.',
            ) ) ),
        ),
        'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'post' ) ) ),
        'position' => 'side',
    ) );

    acf_add_local_field_group( array(
        'key'      => 'group_blog_category',
        'title'    => 'Category',
        'fields'   => array(
            blog_acf_field( 'category', 'category_icon', 'Icon (48×48)', 'image', $image ),
        ),
        'location' => array( array( array( 'param' => 'taxonomy', 'operator' => '==', 'value' => 'category' ) ) ),
    ) );

    $user_fields = array(
        blog_acf_field( 'user', 'author_photo', 'Photo', 'image', $image ),
        blog_acf_field( 'user', 'author_position', 'Position', 'text', array(
            'instructions' => 'The author is shown on the Home page only if the position is filled in.',
        ) ),
    );
    foreach ( blog_social_networks() as $key => $label ) {
        $user_fields[] = blog_acf_field( 'user', 'author_' . $key, $label, 'url' );
    }

    acf_add_local_field_group( array(
        'key'      => 'group_blog_user',
        'title'    => 'Author Profile',
        'fields'   => $user_fields,
        'location' => array( array( array( 'param' => 'user_form', 'operator' => '==', 'value' => 'all' ) ) ),
    ) );

    acf_add_local_field_group( array(
        'key'      => 'group_blog_testimonial',
        'title'    => 'Testimonial',
        'fields'   => array(
            blog_acf_field( 'testimonial', 'testimonial_location', 'Location' ),
        ),
        'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'testimonial' ) ) ),
    ) );
}
add_action( 'acf/init', 'blog_register_acf_fields' );
