<?php defined( 'ABSPATH' ) || exit; ?>
<footer class="site-footer">
    <div class="container">
        <div class="site-footer__top">
            <?php get_template_part( 'template-parts/components/logo' ); ?>

            <?php
            wp_nav_menu( array(
                'theme_location'  => 'footer',
                'container'       => 'nav',
                'container_class' => 'nav nav--footer',
                'menu_class'      => 'nav__list',
                'depth'           => 1,
                'fallback_cb'     => 'blog_nav_fallback',
            ) );
            ?>
        </div>

        <?php
        $subscribe_form = blog_option( 'subscribe_form' );
        ?>
        <?php if ( $subscribe_form && blog_shortcode_available( $subscribe_form ) ) : ?>
            <div class="subscribe" id="subscribe">
                <h2 class="subscribe__title"><?php esc_html_e( 'Subscribe to our news letter to get latest updates and news', 'blog' ); ?></h2>

                <div class="subscribe__form">
                    <?php echo do_shortcode( $subscribe_form ); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="site-footer__bottom">
            <address class="site-footer__contacts">
                <?php echo esc_html( blog_option( 'address' ) ); ?><br>
                <a href="mailto:<?php echo esc_attr( blog_option( 'email' ) ); ?>"><?php echo esc_html( blog_option( 'email' ) ); ?></a>
                <a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', blog_option( 'phone' ) ) ); ?>"><?php echo esc_html( blog_option( 'phone' ) ); ?></a>
            </address>

            <?php
            $links = array();
            foreach ( blog_social_networks() as $key => $label ) {
                $links[ $key ] = blog_option( $key );
            }
            get_template_part( 'template-parts/components/social-links', null, array(
                'links'    => $links,
                'modifier' => 'footer',
            ) );
            ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
