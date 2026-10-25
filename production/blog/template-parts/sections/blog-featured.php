<?php
defined( 'ABSPATH' ) || exit;

$featured = blog_get_featured_post();

if ( ! $featured ) {
    return;
}

$post_data = blog_post_data( $featured );
?>
<section class="blog-featured">
    <div class="container blog-featured__inner">
        <div class="blog-featured__content">
            <p class="label"><?php esc_html_e( 'Featured post', 'blog' ); ?></p>
            <h2 class="blog-featured__title"><a href="<?php echo esc_url( $post_data['url'] ); ?>"><?php echo esc_html( $post_data['title'] ); ?></a></h2>
            <?php get_template_part( 'template-parts/components/post-meta', null, $post_data['meta'] ); ?>
            <p class="text blog-featured__text"><?php echo esc_html( $post_data['excerpt'] ); ?></p>
            <a class="btn blog-featured__btn" href="<?php echo esc_url( $post_data['url'] ); ?>"><?php esc_html_e( 'Read More >', 'blog' ); ?></a>
        </div>

        <?php if ( $post_data['thumbnail_id'] ) : ?>
            <a class="blog-featured__media" href="<?php echo esc_url( $post_data['url'] ); ?>" tabindex="-1">
                <?php
                echo wp_get_attachment_image( $post_data['thumbnail_id'], 'blog-featured', false, array(
                    'class' => 'blog-featured__img',
                    'alt'   => blog_image_alt( $post_data['thumbnail_id'], $post_data['title'] ),
                    'sizes' => '(max-width: 991px) 100vw, 515px',
                ) );
                ?>
            </a>
        <?php endif; ?>
    </div>
</section>
