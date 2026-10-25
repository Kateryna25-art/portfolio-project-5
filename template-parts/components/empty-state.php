<?php
defined( 'ABSPATH' ) || exit;

$title = ! empty( $args['title'] ) ? $args['title'] : __( 'No posts yet', 'blog' );
$text  = ! empty( $args['text'] ) ? $args['text'] : __( 'New posts will appear here soon.', 'blog' );
?>
<div class="empty-state">
    <h2 class="empty-state__title"><?php echo esc_html( $title ); ?></h2>
    <p class="text empty-state__text"><?php echo esc_html( $text ); ?></p>
</div>
