<?php
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main class="main">
    <?php
    if ( ! is_paged() ) {
        get_template_part( 'template-parts/sections/blog-featured' );
    }
    ?>

    <section class="post-list">
        <div class="container">
            <h1 class="post-list__title"><?php esc_html_e( 'All posts', 'blog' ); ?></h1>

            <div class="post-list__items">
                <?php
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        get_template_part( 'template-parts/components/post-card', null, blog_post_data( get_post() ) );
                    }
                } else {
                    get_template_part( 'template-parts/components/empty-state' );
                }
                ?>
            </div>

            <?php get_template_part( 'template-parts/components/pagination' ); ?>
        </div>
    </section>

    <?php
    get_template_part( 'template-parts/sections/categories', null, array(
        'title'    => __( 'All Categories', 'blog' ),
        'modifier' => 'list',
    ) );
    get_template_part( 'template-parts/sections/join' );
    ?>
</main>

<?php get_footer(); ?>
