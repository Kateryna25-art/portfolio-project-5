<?php
defined( 'ABSPATH' ) || exit;
?>
<?php if ( has_custom_logo() ) : ?>
    <?php the_custom_logo(); ?>
<?php else : ?>
    <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <img class="logo__img" src="<?php echo esc_url( blog_image_uri( 'logo.png' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="140" height="29">
    </a>
<?php endif; ?>
