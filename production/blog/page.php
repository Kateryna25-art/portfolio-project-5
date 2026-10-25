<?php
defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
    the_post();

    $layout = blog_field( 'page_layout', 'default' );
    ?>

    <main class="main">
        <?php if ( 'contacts' === $layout ) : ?>
            <?php
            $phone = blog_option( 'phone' );
            $email = blog_option( 'email' );
            ?>
            <section class="contact-page">
                <div class="container contact-page__inner">
                    <header class="contact-page__head">
                        <p class="label contact-page__label"><?php echo esc_html( blog_field( 'contacts_label', 'Contact us' ) ); ?></p>
                        <h1 class="contact-page__title"><?php echo esc_html( blog_field( 'contacts_title', get_the_title() ) ); ?></h1>
                        <p class="text contact-page__text"><?php echo esc_html( blog_field( 'contacts_text', '' ) ); ?></p>
                    </header>

                    <div class="contact-page__info">
                        <div>
                            <p class="contact-page__info-label"><?php echo esc_html( blog_field( 'hours_label', 'Working hours' ) ); ?></p>
                            <p class="contact-page__info-value"><?php echo nl2br( esc_html( blog_field( 'hours_title', '' ) ) ); ?></p>
                            <p class="contact-page__info-note"><?php echo esc_html( blog_field( 'hours_text', '' ) ); ?></p>
                        </div>
                        <div>
                            <p class="contact-page__info-label"><?php echo esc_html( blog_field( 'phone_label', 'Contact Us' ) ); ?></p>
                            <?php if ( $phone ) : ?>
                                <a class="contact-page__info-value" href="<?php echo esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
                            <?php endif; ?>
                            <?php if ( $email ) : ?>
                                <a class="contact-page__info-note" href="<?php echo esc_url( 'mailto:' . $email ); ?>"><?php echo esc_html( strtolower( $email ) ); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="contact-page__form">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
        <?php else : ?>
            <section class="page-banner">
                <div class="container">
                    <h1 class="page-banner__title"><?php the_title(); ?></h1>
                    <p class="page-banner__date">
                        <?php esc_html_e( 'Last Updated', 'blog' ); ?>&nbsp; <?php esc_html_e( 'on', 'blog' ); ?>
                        <time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date() ); ?></time>
                    </p>
                </div>
            </section>

            <div class="container">
                <div class="entry-content entry-content--page page-content">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <?php
endwhile;

get_footer();
