<?php
defined( 'ABSPATH' ) || exit;

$query = new WP_Query( array(
    'post_type'      => 'testimonial',
    'posts_per_page' => 10,
    'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
    'no_found_rows'  => true,
) );

$slides = array();

while ( $query->have_posts() ) {
    $query->the_post();
    $slides[] = array(
        'quote'    => wp_strip_all_tags( get_the_content() ),
        'name'     => get_the_title(),
        'location' => blog_field( 'testimonial_location' ),
        'photo'    => get_the_post_thumbnail( null, 'thumbnail', array( 'class' => 'testimonial__photo', 'alt' => get_the_title() ) ),
    );
}
wp_reset_postdata();

if ( ! $slides ) {
    return;
}
?>
<section class="testimonials">
    <div class="container">
        <div class="testimonials__box">
            <div class="testimonials__intro">
                <p class="label"><?php echo esc_html( blog_front_field( 'testimonials_label', 'Testimonials' ) ); ?></p>
                <h2 class="testimonials__title"><?php echo esc_html( blog_front_field( 'testimonials_title', 'What people say about our blog' ) ); ?></h2>
                <p class="testimonials__text"><?php echo esc_html( blog_front_field( 'testimonials_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.' ) ); ?></p>
            </div>

            <div class="testimonials__slider" data-slider>
                <div class="testimonials__track">
                    <?php foreach ( $slides as $i => $slide ) : ?>
                        <figure class="testimonial<?php echo 0 === $i ? ' is-active' : ''; ?>" data-slide<?php echo 0 === $i ? '' : ' hidden'; ?>>
                            <blockquote class="testimonial__quote"><?php echo esc_html( $slide['quote'] ); ?></blockquote>
                            <figcaption class="testimonial__author">
                                <?php echo $slide['photo']; ?>
                                <span>
                                    <span class="testimonial__name"><?php echo esc_html( $slide['name'] ); ?></span>
                                    <?php if ( $slide['location'] ) : ?>
                                        <span class="testimonial__location"><?php echo esc_html( $slide['location'] ); ?></span>
                                    <?php endif; ?>
                                </span>
                            </figcaption>
                        </figure>
                    <?php endforeach; ?>
                </div>

                <?php if ( count( $slides ) > 1 ) : ?>
                    <div class="testimonials__nav">
                        <button class="slider-btn slider-btn--prev" type="button" data-prev aria-label="<?php esc_attr_e( 'Previous testimonial', 'blog' ); ?>"><?php echo blog_icon( 'arrow-left', 16 ); ?></button>
                        <button class="slider-btn slider-btn--next" type="button" data-next aria-label="<?php esc_attr_e( 'Next testimonial', 'blog' ); ?>"><?php echo blog_icon( 'arrow-right', 28 ); ?></button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
