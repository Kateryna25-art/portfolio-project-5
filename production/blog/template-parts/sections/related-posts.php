<?php
defined( 'ABSPATH' ) || exit;

$post_id = isset( $args['post_id'] ) ? (int) $args['post_id'] : 0;
$exclude = array( $post_id );
$related = array();

if ( ! empty( $args['category'] ) ) {
    $related = get_posts( array(
        'posts_per_page' => 3,
        'post__not_in'   => $exclude,
        'cat'            => $args['category']->term_id,
    ) );
}

if ( count( $related ) < 3 ) {
    $more    = get_posts( array(
        'posts_per_page' => 3 - count( $related ),
        'post__not_in'   => array_merge( $exclude, wp_list_pluck( $related, 'ID' ) ),
    ) );
    $related = array_merge( $related, $more );
}

$items = array();
foreach ( $related as $post_item ) {
    $items[] = blog_post_data( $post_item );
}

if ( ! $items ) {
    return;
}
?>
<section class="related">
    <div class="container">
        <div class="related__inner">
            <h2 class="related__title"><?php esc_html_e( 'What to read next', 'blog' ); ?></h2>

            <div class="related__grid">
                <?php foreach ( $items as $item ) : ?>
                    <?php get_template_part( 'template-parts/components/post-tile', null, $item ); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
