<?php
defined( 'ABSPATH' ) || exit;

$author     = isset( $args['author'] ) ? $args['author'] : get_the_author();
$author_url = isset( $args['author_url'] ) ? $args['author_url'] : get_author_posts_url( get_the_author_meta( 'ID' ) );
$date       = isset( $args['date'] ) ? $args['date'] : get_the_date();
$modifier   = ! empty( $args['modifier'] ) ? ' post-meta--' . $args['modifier'] : '';
?>
<p class="post-meta<?php echo esc_attr( $modifier ); ?>">
    <span><?php esc_html_e( 'By', 'blog' ); ?> <a class="post-meta__author" href="<?php echo esc_url( $author_url ); ?>"><?php echo esc_html( $author ); ?></a></span>
    <span class="post-meta__sep" aria-hidden="true">|</span>
    <time><?php echo esc_html( $date ); ?></time>
</p>
