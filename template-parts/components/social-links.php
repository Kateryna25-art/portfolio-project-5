<?php
defined( 'ABSPATH' ) || exit;

$links    = isset( $args['links'] ) ? array_filter( $args['links'] ) : array();
$modifier = ! empty( $args['modifier'] ) ? ' social--' . $args['modifier'] : '';

if ( ! $links ) {
    return;
}
?>
<ul class="social<?php echo esc_attr( $modifier ); ?>">
    <?php foreach ( blog_social_networks() as $key => $label ) : ?>
        <?php if ( ! empty( $links[ $key ] ) ) : ?>
            <li>
                <a class="social__link" href="<?php echo esc_url( $links[ $key ] ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $label ); ?>">
                    <?php echo blog_icon( $key ); ?>
                </a>
            </li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>
