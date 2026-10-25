<?php
defined( 'ABSPATH' ) || exit;

$link = blog_link( blog_front_field( 'join_link' ), 'Join Now', blog_page_url( 'contact-us' ) );
?>
<section class="join">
    <div class="container join__inner">
        <h2 class="join__title"><?php echo esc_html( blog_front_field( 'join_title', 'Join our team to be a part of our story' ) ); ?></h2>
        <p class="text join__text"><?php echo esc_html( blog_front_field( 'join_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.' ) ); ?></p>
        <?php if ( $link['url'] ) : ?>
            <a class="btn join__btn" href="<?php echo esc_url( $link['url'] ); ?>"<?php echo blog_link_target( $link ); ?>><?php echo esc_html( $link['title'] ); ?></a>
        <?php endif; ?>
    </div>
</section>
