<?php
defined( 'ABSPATH' ) || exit;

$link         = blog_link( blog_front_field( 'why_link' ), 'Discover our story >', blog_page_url( 'about-us' ) );
$why_image    = blog_front_field( 'why_image' );
$why_mobile   = blog_front_field( 'why_image_mobile' );
$has_image    = ! empty( $why_image['ID'] );
$section_class = $has_image ? 'why' : 'why why--text';
?>
<section class="<?php echo esc_attr( $section_class ); ?>">
    <div class="container why__inner">
        <?php if ( $has_image ) : ?>
            <div class="why__media">
                <picture>
                    <?php if ( ! empty( $why_mobile['ID'] ) ) : ?>
                        <source media="(max-width: 991px)" srcset="<?php echo esc_url( wp_get_attachment_image_url( $why_mobile['ID'], 'large' ) ); ?>">
                    <?php endif; ?>
                    <?php echo wp_get_attachment_image( $why_image['ID'], 'large', false, array( 'class' => 'why__img', 'loading' => 'lazy' ) ); ?>
                </picture>
            </div>
        <?php endif; ?>

        <div class="why__card">
            <p class="label"><?php echo esc_html( blog_front_field( 'why_label', 'Why we started' ) ); ?></p>
            <h2 class="why__title"><?php echo esc_html( blog_front_field( 'why_title', 'It started out as a simple idea and evolved into our passion' ) ); ?></h2>
            <p class="text why__text"><?php echo esc_html( blog_front_field( 'why_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.' ) ); ?></p>
            <?php if ( $link['url'] ) : ?>
                <a class="btn why__btn" href="<?php echo esc_url( $link['url'] ); ?>"<?php echo blog_link_target( $link ); ?>><?php echo esc_html( $link['title'] ); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>
