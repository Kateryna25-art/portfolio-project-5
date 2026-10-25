<?php
/**
 * Template Name: About Us
 */

defined( 'ABSPATH' ) || exit;

get_header();

$stats = array(
    array( '12+', 'Blogs Published' ),
    array( '18K+', 'Views on Finsweet' ),
    array( '30K+', 'Total active Users' ),
);
?>

<main class="main">
    <section class="about-intro">
        <div class="container">
            <div class="about-intro__head">
                <div class="about-intro__card">
                    <p class="label"><?php echo esc_html( blog_field( 'intro_label', 'About us' ) ); ?></p>
                    <h1 class="about-intro__title"><?php echo esc_html( blog_field( 'intro_title', 'We are a team of content writers who share their learnings' ) ); ?></h1>
                </div>
                <p class="text about-intro__text"><?php echo esc_html( blog_field( 'intro_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.' ) ); ?></p>
            </div>

            <?php
            $intro_image  = blog_field( 'intro_image' );
            $intro_mobile = blog_field( 'intro_image_mobile' );
            $has_intro    = ! empty( $intro_image['ID'] );
            ?>
            <div class="about-intro__media<?php echo $has_intro ? '' : ' about-intro__media--no-image'; ?>">
                <?php if ( $has_intro ) : ?>
                    <picture>
                        <?php if ( ! empty( $intro_mobile['ID'] ) ) : ?>
                            <source media="(max-width: 991px)" srcset="<?php echo esc_url( wp_get_attachment_image_url( $intro_mobile['ID'], 'large' ) ); ?>">
                        <?php endif; ?>
                        <?php echo wp_get_attachment_image( $intro_image['ID'], 'full', false, array( 'class' => 'about-intro__img' ) ); ?>
                    </picture>
                <?php endif; ?>

                <div class="about-intro__stats">
                    <?php foreach ( $stats as $i => $stat ) : ?>
                        <div class="about-intro__stat">
                            <span class="about-intro__number"><?php echo esc_html( blog_field( 'stat_' . ( $i + 1 ) . '_number', $stat[0] ) ); ?></span>
                            <span class="about-intro__stat-label"><?php echo esc_html( blog_field( 'stat_' . ( $i + 1 ) . '_label', $stat[1] ) ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="mission">
        <div class="container">
            <div class="mission__box">
                <div>
                    <p class="label"><?php echo esc_html( blog_field( 'mission_label', 'Our mision' ) ); ?></p>
                    <h2 class="mission__title"><?php echo esc_html( blog_field( 'mission_title', 'Creating valuable content for creatives all around the world' ) ); ?></h2>
                    <p class="text mission__text"><?php echo esc_html( blog_field( 'mission_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Non blandit massa enim nec. Scelerisque viverra mauris in aliquam sem. At risus viverra adipiscing at in tellus.' ) ); ?></p>
                </div>
                <div>
                    <p class="label"><?php echo esc_html( blog_field( 'vision_label', 'Our vision' ) ); ?></p>
                    <h2 class="mission__title"><?php echo esc_html( blog_field( 'vision_title', 'A platform that empowers individuals to improve' ) ); ?></h2>
                    <p class="text mission__text"><?php echo esc_html( blog_field( 'vision_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Non blandit massa enim nec. Scelerisque viverra mauris in aliquam sem. At risus viverra adipiscing at in tellus.' ) ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <?php
    $subtitle = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.';
    $text     = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.';

    get_template_part( 'template-parts/components/media-text', null, array(
        'title'    => blog_field( 'team_title', 'Our team of creatives' ),
        'subtitle' => blog_field( 'team_subtitle', $subtitle ),
        'text'     => blog_field( 'team_text', $text ),
        'image'    => blog_field( 'team_image' ),
        'decor'    => 'square',
    ) );

    get_template_part( 'template-parts/components/media-text', null, array(
        'title'    => blog_field( 'story_title', 'Why we started this Blog' ),
        'subtitle' => blog_field( 'story_subtitle', $subtitle ),
        'text'     => blog_field( 'story_text', $text ),
        'image'    => blog_field( 'story_image' ),
        'decor'    => 'circle',
        'reverse'  => true,
    ) );

    get_template_part( 'template-parts/sections/authors', null, array( 'number' => 8 ) );
    get_template_part( 'template-parts/sections/join' );
    ?>
</main>

<?php get_footer(); ?>
