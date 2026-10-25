<?php
defined( 'ABSPATH' ) || exit;

$number = ! empty( $args['number'] ) ? (int) $args['number'] : 4;
$users  = get_users( array(
    'number'     => $number,
    'orderby'    => 'ID',
    'meta_key'   => 'author_position',
    'meta_value' => '',
    'meta_compare' => '!=',
) );

$authors = array();

foreach ( $users as $user ) {
    $acf_id = 'user_' . $user->ID;
    $links  = array();
    foreach ( blog_social_networks() as $key => $label ) {
        $links[ $key ] = blog_field( 'author_' . $key, '', $acf_id );
    }
    $authors[] = array(
        'name'     => $user->display_name,
        'url'      => get_author_posts_url( $user->ID ),
        'position' => blog_field( 'author_position', '', $acf_id ),
        'photo'    => blog_field( 'author_photo', null, $acf_id ),
        'avatar'   => get_avatar_url( $user->ID, array( 'size' => 256 ) ),
        'links'    => $links,
    );
}

if ( ! $authors ) {
    return;
}
?>
<section class="authors">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html( blog_front_field( 'authors_title', 'List of Authors' ) ); ?></h2>

        <ul class="authors__grid">
            <?php foreach ( $authors as $author ) : ?>
                <li class="author-card">
                    <a class="author-card__photo" href="<?php echo esc_url( $author['url'] ); ?>" tabindex="-1">
                        <?php
                        $img_attr = array( 'alt' => $author['name'], 'width' => 128, 'height' => 128 );
                        if ( $author['photo'] ) {
                            echo blog_image( $author['photo'], 'blog-avatar', $img_attr );
                        } else {
                            echo '<img src="' . esc_url( $author['avatar'] ) . '" alt="' . esc_attr( $author['name'] ) . '" width="128" height="128" loading="lazy">';
                        }
                        ?>
                    </a>
                    <h3 class="author-card__name"><a href="<?php echo esc_url( $author['url'] ); ?>"><?php echo esc_html( $author['name'] ); ?></a></h3>
                    <p class="author-card__position"><?php echo esc_html( $author['position'] ); ?></p>
                    <?php get_template_part( 'template-parts/components/social-links', null, array( 'links' => $author['links'] ) ); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
