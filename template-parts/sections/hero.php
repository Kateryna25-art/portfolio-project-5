<?php
defined( 'ABSPATH' ) || exit;

$featured = blog_get_featured_post();

if ( ! $featured ) {
    return;
}

set_query_var( 'blog_hero_id', $featured->ID );
$hero = blog_post_data( $featured );

$hero['meta']['modifier'] = 'hero';

$background = blog_hero_background();
$hero_class = $background['overlay'] ? 'hero hero--overlay' : 'hero';
?>
<section class="<?php echo esc_attr( $hero_class ); ?>" style="--hero-image: url('<?php echo esc_url( $background['url'] ); ?>')">
    <div class="container hero__inner">
        <?php if ( $hero['category'] ) : ?>
            <p class="label hero__label"><?php esc_html_e( 'Posted on', 'blog' ); ?> <strong><?php echo esc_html( $hero['category'] ); ?></strong></p>
        <?php endif; ?>

        <h1 class="hero__title"><?php echo esc_html( $hero['title'] ); ?></h1>

        <?php get_template_part( 'template-parts/components/post-meta', null, $hero['meta'] ); ?>

        <p class="hero__text"><?php echo esc_html( $hero['excerpt'] ); ?></p>

        <a class="btn hero__btn" href="<?php echo esc_url( $hero['url'] ); ?>"><?php esc_html_e( 'Read More >', 'blog' ); ?></a>
    </div>
</section>
