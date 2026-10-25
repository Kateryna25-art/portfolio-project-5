<?php defined( 'ABSPATH' ) || exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container site-header__inner">
        <?php get_template_part( 'template-parts/components/logo' ); ?>

        <button class="site-header__burger" type="button" aria-label="<?php esc_attr_e( 'Menu', 'blog' ); ?>" aria-expanded="false" aria-controls="site-nav">
            <span></span>
        </button>

        <div class="site-header__nav" id="site-nav">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => 'nav',
                'container_class' => 'nav',
                'menu_class'     => 'nav__list',
                'depth'          => 1,
                'fallback_cb'    => 'blog_nav_fallback',
            ) );
            ?>
            <a class="btn btn--white site-header__btn" href="<?php echo esc_url( blog_option( 'subscribe_url' ) ); ?>"><?php esc_html_e( 'Subscribe', 'blog' ); ?></a>
        </div>
    </div>
</header>
