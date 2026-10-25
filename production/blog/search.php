<?php
defined( 'ABSPATH' ) || exit;

get_header();

global $wp_query;
?>

<main class="main">
    <section class="archive-banner">
        <div class="container archive-banner__inner">
            <h1 class="archive-banner__title"><?php esc_html_e( 'Search', 'blog' ); ?></h1>
            <p class="text archive-banner__text">
                <?php
                printf(
                    /* translators: 1: number of results, 2: search query */
                    esc_html( _n( '%1$s result for “%2$s”', '%1$s results for “%2$s”', (int) $wp_query->found_posts, 'blog' ) ),
                    esc_html( number_format_i18n( (int) $wp_query->found_posts ) ),
                    esc_html( get_search_query() )
                );
                ?>
            </p>
            <div class="archive-banner__search"><?php get_search_form(); ?></div>
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
                <?php
                get_template_part( 'template-parts/components/empty-state', null, array(
                    'title' => __( 'Nothing found', 'blog' ),
                    'text'  => __( 'Try another search query or browse the categories.', 'blog' ),
                ) );
                ?>
            <?php endif; ?>
        </div>

        <aside class="archive-layout__sidebar">
            <?php get_template_part( 'template-parts/components/sidebar' ); ?>
        </aside>
    </div>
</main>

<?php get_footer(); ?>
