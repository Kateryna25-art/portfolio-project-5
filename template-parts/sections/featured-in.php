<?php
defined( 'ABSPATH' ) || exit;

$logos = array();
for ( $i = 1; $i <= 5; $i++ ) {
    $logo = blog_front_field( 'logo_' . $i );
    if ( ! empty( $logo['ID'] ) ) {
        $logos[] = $logo;
    }
}

if ( ! $logos ) {
    return;
}
?>
<section class="featured-in">
    <div class="container featured-in__inner">
        <p class="featured-in__label">
            <span><?php echo esc_html( blog_front_field( 'logos_label_top', 'We are' ) ); ?></span>
            <?php echo esc_html( blog_front_field( 'logos_label', 'Featured in' ) ); ?>
        </p>

        <ul class="featured-in__logos">
            <?php foreach ( $logos as $logo ) : ?>
                <li>
                    <?php echo wp_get_attachment_image( $logo['ID'], 'medium', false, array( 'alt' => blog_image_alt( $logo['ID'], $logo['title'] ), 'loading' => 'lazy' ) ); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
