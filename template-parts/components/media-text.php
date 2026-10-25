<?php
defined( 'ABSPATH' ) || exit;

$image     = isset( $args['image'] ) ? $args['image'] : null;
$has_image = ! empty( $image['ID'] );

$classes = 'media-text';
if ( ! $has_image ) {
    $classes .= ' media-text--no-image';
}
if ( ! empty( $args['reverse'] ) ) {
    $classes .= ' media-text--reverse';
}
if ( ! empty( $args['decor'] ) ) {
    $classes .= ' media-text--' . $args['decor'];
}
?>
<section class="<?php echo esc_attr( $classes ); ?>">
    <div class="container media-text__inner">
        <div class="media-text__content">
            <h2 class="media-text__title"><?php echo esc_html( $args['title'] ); ?></h2>
            <?php if ( ! empty( $args['subtitle'] ) ) : ?>
                <p class="media-text__subtitle"><?php echo esc_html( $args['subtitle'] ); ?></p>
            <?php endif; ?>
            <?php if ( ! empty( $args['text'] ) ) : ?>
                <p class="media-text__text"><?php echo esc_html( $args['text'] ); ?></p>
            <?php endif; ?>
        </div>

        <?php if ( $has_image ) : ?>
            <div class="media-text__media">
                <?php echo wp_get_attachment_image( $image['ID'], 'large', false, array( 'class' => 'media-text__img', 'alt' => blog_image_alt( $image['ID'], $args['title'] ), 'loading' => 'lazy' ) ); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
