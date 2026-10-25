<?php
defined( 'ABSPATH' ) || exit;

$link = blog_link( blog_front_field( 'about_link' ), 'Read More >', blog_page_url( 'about-us' ) );
?>
<section class="about">
    <div class="container">
        <div class="about__box">
            <div class="about__col">
                <p class="label"><?php echo esc_html( blog_front_field( 'about_label', 'About us' ) ); ?></p>
                <h2 class="about__title"><?php echo esc_html( blog_front_field( 'about_title', 'We are a community of content writers who share their learnings' ) ); ?></h2>
                <p class="text about__text"><?php echo esc_html( blog_front_field( 'about_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' ) ); ?></p>
                <?php if ( $link['url'] ) : ?>
                    <a class="link-more about__link" href="<?php echo esc_url( $link['url'] ); ?>"<?php echo blog_link_target( $link ); ?>><?php echo esc_html( $link['title'] ); ?></a>
                <?php endif; ?>
            </div>

            <div class="about__col">
                <p class="label"><?php echo esc_html( blog_front_field( 'mission_label', 'Our mision' ) ); ?></p>
                <h3 class="about__subtitle"><?php echo esc_html( blog_front_field( 'mission_title', 'Creating valuable content for creatives all around the world' ) ); ?></h3>
                <p class="text about__text"><?php echo esc_html( blog_front_field( 'mission_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.' ) ); ?></p>
            </div>
        </div>
    </div>
</section>
