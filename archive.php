<?php
defined( 'ABSPATH' ) || exit;

get_header();

$term_title = single_term_title( '', false );
if ( ! $term_title ) {
    $term_title = wp_strip_all_tags( get_the_archive_title() );
}
$description = term_description();
?>

<main class="main">
    <section class="archive-banner">
        <div class="container archive-banner__inner">
            <h1 class="archive-banner__title"><?php echo esc_html( $term_title ); ?></h1>

            <?php if ( $description ) : ?>
                <div class="text archive-banner__text"><?php echo wp_kses_post( $description ); ?></div>
            <?php endif; ?>

            <nav class="label archive-banner__breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumbs', 'blog' ); ?>">
                <?php $blog_url = blog_page_url( 'blog' ); ?>
                <?php if ( $blog_url ) : ?>
                    <a href="<?php echo esc_url( $blog_url ); ?>"><?php esc_html_e( 'Blog', 'blog' ); ?></a>
                <?php else : ?>
                    <span><?php esc_html_e( 'Blog', 'blog' ); ?></span>
                <?php endif; ?>
                <span aria-hidden="true">&gt;</span>
                <span aria-current="page"><?php echo esc_html( $term_title ); ?></span>
            </nav>
        </div>
    </section>

    <div class="container archive-layout">
        <div class="archive-layout__main">
            <?php if ( have_posts() ) : ?>
                <div class="archive-layout__posts">
                    <?php
                    while ( have_posts() ) {
                        the_post();
                        $item             = blog_post_data( get_post() );
                        $item['modifier'] = 'compact';
                        get_template_part( 'template-parts/components/post-card', null, $item );
                    }
                    ?>
                </div>

                <?php get_template_part( 'template-parts/components/pagination', null, array( 'hide_single' => true ) ); ?>
            <?php else : ?>
                <?php get_template_part( 'template-parts/components/empty-state' ); ?>
            <?php endif; ?>
        </div>

        <aside class="archive-layout__sidebar">
            <?php get_template_part( 'template-parts/components/sidebar' ); ?>
        </aside>
    </div>
</main>

<?php get_footer(); ?>
