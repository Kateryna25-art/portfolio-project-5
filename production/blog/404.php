<?php
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main class="main">
    <section class="not-found">
        <div class="container not-found__inner">
            <p class="label not-found__label"><?php esc_html_e( 'Error 404', 'blog' ); ?></p>
            <h1 class="not-found__title"><?php esc_html_e( 'Page not found', 'blog' ); ?></h1>
            <p class="text not-found__text"><?php esc_html_e( 'The page you are looking for does not exist or has been moved. Try searching or go back to the home page.', 'blog' ); ?></p>
            <div class="not-found__search"><?php get_search_form(); ?></div>
            <a class="btn not-found__btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'blog' ); ?></a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
