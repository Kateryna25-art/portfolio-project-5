<?php
defined( 'ABSPATH' ) || exit;

$hero_id = (int) get_query_var( 'blog_hero_id' );
$query   = new WP_Query( array(
    'posts_per_page'      => 5,
    'post__not_in'        => $hero_id ? array( $hero_id ) : array(),
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
) );

$posts = array();

while ( $query->have_posts() ) {
    $query->the_post();
    $posts[] = array(
        'title'   => get_the_title(),
        'excerpt' => get_the_excerpt(),
        'url'     => get_permalink(),
        'image'   => get_the_post_thumbnail( null, 'blog-card', array( 'class' => 'featured-post__img' ) ),
        'meta'    => array(
            'author'     => get_the_author(),
            'author_url' => get_author_posts_url( get_the_author_meta( 'ID' ) ),
            'date'       => get_the_date(),
        ),
    );
}
wp_reset_postdata();

if ( ! $posts ) {
    return;
}

$featured = array_shift( $posts );
$blog_url = blog_page_url( 'blog' );
?>
<section class="posts">
    <div class="container posts__grid">
        <div class="posts__col">
            <h2 class="posts__title"><?php esc_html_e( 'Featured Post', 'blog' ); ?></h2>

            <article class="featured-post">
                <?php if ( $featured['image'] ) : ?>
                    <a class="featured-post__media" href="<?php echo esc_url( $featured['url'] ); ?>" tabindex="-1">
                        <?php echo $featured['image']; ?>
                    </a>
                <?php endif; ?>

                <?php get_template_part( 'template-parts/components/post-meta', null, $featured['meta'] ); ?>

                <h3 class="featured-post__title">
                    <a href="<?php echo esc_url( $featured['url'] ); ?>"><?php echo esc_html( $featured['title'] ); ?></a>
                </h3>

                <p class="text featured-post__text"><?php echo esc_html( $featured['excerpt'] ); ?></p>

                <a class="btn featured-post__btn" href="<?php echo esc_url( $featured['url'] ); ?>"><?php esc_html_e( 'Read More >', 'blog' ); ?></a>
            </article>
        </div>

        <div class="posts__col">
            <div class="posts__head">
                <h2 class="posts__title"><?php esc_html_e( 'All Posts', 'blog' ); ?></h2>
                <?php if ( $blog_url ) : ?>
                    <a class="posts__all" href="<?php echo esc_url( $blog_url ); ?>"><?php esc_html_e( 'View All', 'blog' ); ?></a>
                <?php endif; ?>
            </div>

            <ul class="posts__list">
                <?php foreach ( $posts as $item ) : ?>
                    <li class="post-item">
                        <?php get_template_part( 'template-parts/components/post-meta', null, $item['meta'] ); ?>
                        <h3 class="post-item__title">
                            <a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
                        </h3>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
