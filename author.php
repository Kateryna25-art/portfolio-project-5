<?php
defined( 'ABSPATH' ) || exit;

get_header();

$author = get_queried_object();
$acf_id = 'user_' . $author->ID;
$photo  = blog_field( 'author_photo', null, $acf_id );
$links  = array();
foreach ( blog_social_networks() as $key => $label ) {
    $links[ $key ] = blog_field( 'author_' . $key, '', $acf_id );
}
?>

<main class="main">
    <section class="author-hero">
        <div class="container author-hero__inner">
            <div class="author-hero__photo">
                <?php
                echo $photo
                    ? blog_image( $photo, 'medium_large', array( 'alt' => $author->display_name ) )
                    : get_avatar( $author->ID, 251, '', $author->display_name );
                ?>
            </div>

            <div class="author-hero__content">
                <h1 class="author-hero__title">
                    <?php
                    /* translators: %s: author name */
                    printf( esc_html__( 'Hey there, I’m %s and welcome to my Blog', 'blog' ), esc_html( $author->display_name ) );
                    ?>
                </h1>

                <?php if ( $author->description ) : ?>
                    <p class="text author-hero__text"><?php echo esc_html( $author->description ); ?></p>
                <?php endif; ?>

                <?php get_template_part( 'template-parts/components/social-links', null, array( 'links' => $links ) ); ?>
            </div>
        </div>
    </section>

    <section class="author-posts">
        <div class="container author-posts__inner">
            <h2 class="author-posts__title"><?php esc_html_e( 'My Posts', 'blog' ); ?></h2>

            <?php if ( have_posts() ) : ?>
                <div class="author-posts__list">
                    <?php
                    while ( have_posts() ) {
                        the_post();
                        $item             = blog_post_data( get_post() );
                        $item['modifier'] = 'author';
                        get_template_part( 'template-parts/components/post-card', null, $item );
                    }
                    ?>
                </div>

                <?php get_template_part( 'template-parts/components/pagination', null, array( 'hide_single' => true ) ); ?>
            <?php else : ?>
                <div class="author-posts__empty"><?php get_template_part( 'template-parts/components/empty-state' ); ?></div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
