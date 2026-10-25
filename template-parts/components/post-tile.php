<?php
defined( 'ABSPATH' ) || exit;

$title = isset( $args['title'] ) ? $args['title'] : '';
$url   = isset( $args['url'] ) ? $args['url'] : '#';
?>
<article class="post-tile">
    <a class="post-tile__media" href="<?php echo esc_url( $url ); ?>" tabindex="-1">
        <?php
        if ( ! empty( $args['thumbnail_id'] ) ) {
            echo wp_get_attachment_image( $args['thumbnail_id'], 'blog-list', false, array(
                'class'   => 'post-tile__img',
                'alt'     => blog_image_alt( $args['thumbnail_id'], $title ),
                'loading' => 'lazy',
                'sizes'   => '(max-width: 767px) 100vw, (max-width: 991px) 50vw, 405px',
            ) );
        }
        ?>
    </a>

    <?php
    if ( ! empty( $args['meta'] ) ) {
        get_template_part( 'template-parts/components/post-meta', null, $args['meta'] );
    }
    ?>

    <h3 class="post-tile__title"><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $title ); ?></a></h3>

    <?php if ( ! empty( $args['excerpt'] ) ) : ?>
        <p class="text post-tile__text"><?php echo esc_html( $args['excerpt'] ); ?></p>
    <?php endif; ?>
</article>
