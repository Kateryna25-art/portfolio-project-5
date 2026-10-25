<?php
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main class="main">
    <?php
    $sections = array( 'hero', 'posts', 'about', 'categories', 'why-started', 'authors', 'featured-in', 'testimonials', 'join' );

    foreach ( $sections as $section ) {
        get_template_part( 'template-parts/sections/' . $section );
    }
    ?>
</main>

<?php get_footer(); ?>
