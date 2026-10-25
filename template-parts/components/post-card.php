<?php
defined( 'ABSPATH' ) || exit;

$title    = isset( $args['title'] ) ? $args['title'] : '';
$url      = isset( $args['url'] ) ? $args['url'] : '#';
$modifier = ! empty( $args['modifier'] ) ? ' post-card--' . $args['modifier'] : '';
?>
<article class="post-card<?php echo esc_attr( $modifier ); ?>">
    <a class="post-card__media" href="<?php echo esc_url( $url ); ?>" tabindex="-1">
        <?php
        if ( ! empty( $args['thumbnail_id'] ) ) {
            echo wp_get_attachment_image( $args['thumbnail_id'], 'blog-list', false, array(
                'class'   => 'post-card__img',
                'alt'     => blog_image_alt( $args['thumbnail_id'], $title ),
                'loading' => 'lazy',
                'sizes'   => '(max-width: 767px) 100vw, 490px',
            ) );
        }
        ?>
    </a>

    <div class="post-card__body">
        <?php if ( ! empty( $args['category'] ) ) : ?>
            <a class="label post-card__category" href="<?php echo esc_url( $args['category_url'] ); ?>"><?php echo esc_html( $args['category'] ); ?></a>
        <?php endif; ?>

        <h2 class="post-card__title"><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $title ); ?></a></h2>

        <?php if ( ! empty( $args['excerpt'] ) ) : ?>
            <p class="text post-card__text"><?php echo esc_html( $args['excerpt'] ); ?></p>
        <?php endif; ?>
    </div>
</article>
