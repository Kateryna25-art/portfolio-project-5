<?php
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main class="main">
    <section class="archive-banner">
        <div class="container archive-banner__inner">
            <h1 class="archive-banner__title">
                <?php echo esc_html( is_singular() ? get_the_title() : wp_strip_all_tags( get_the_archive_title() ) ); ?>
            </h1>
        </div>
    </section>

    <div class="container archive-layout archive-layout--single">
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
    </div>
</main>

<?php get_footer(); ?>
