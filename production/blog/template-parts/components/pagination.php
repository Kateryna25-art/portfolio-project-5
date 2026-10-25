<?php
defined( 'ABSPATH' ) || exit;

global $wp_query;

$paged     = max( 1, get_query_var( 'paged' ) );
$max_pages = (int) $wp_query->max_num_pages;

if ( ! empty( $args['hide_single'] ) && $max_pages <= 1 ) {
    return;
}
?>
<nav class="pagination" aria-label="<?php esc_attr_e( 'Posts navigation', 'blog' ); ?>">
    <?php if ( $paged > 1 ) : ?>
        <a class="pagination__link" href="<?php echo esc_url( get_pagenum_link( $paged - 1 ) ); ?>">&lt; <?php esc_html_e( 'Prev', 'blog' ); ?></a>
    <?php else : ?>
        <span class="pagination__link is-disabled">&lt; <?php esc_html_e( 'Prev', 'blog' ); ?></span>
    <?php endif; ?>

    <?php if ( $paged < $max_pages ) : ?>
        <a class="pagination__link" href="<?php echo esc_url( get_pagenum_link( $paged + 1 ) ); ?>"><?php esc_html_e( 'Next', 'blog' ); ?> &gt;</a>
    <?php else : ?>
        <span class="pagination__link is-disabled"><?php esc_html_e( 'Next', 'blog' ); ?> &gt;</span>
    <?php endif; ?>
</nav>
