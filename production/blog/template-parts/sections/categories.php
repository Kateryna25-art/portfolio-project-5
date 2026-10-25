<?php
defined( 'ABSPATH' ) || exit;

$section_title = ! empty( $args['title'] ) ? $args['title'] : blog_front_field( 'categories_title', 'Choose A Catagory' );
$modifier      = ! empty( $args['modifier'] ) ? ' categories--' . $args['modifier'] : '';

$terms = get_terms( array(
    'taxonomy'   => 'category',
    'hide_empty' => false,
    'orderby'    => 'term_id',
    'exclude'    => array( (int) get_option( 'default_category' ) ),
    'number'     => 4,
) );

if ( is_wp_error( $terms ) || ! $terms ) {
    return;
}

$categories = array();
foreach ( $terms as $term ) {
    $categories[] = array(
        'name'        => $term->name,
        'url'         => get_term_link( $term ),
        'description' => $term->description,
        'icon'        => blog_field( 'category_icon', null, $term ),
    );
}
?>
<section class="categories<?php echo esc_attr( $modifier ); ?>">
    <div class="container">
        <h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>

        <ul class="categories__grid">
            <?php foreach ( $categories as $cat ) : ?>
                <li>
                    <a class="category-card" href="<?php echo esc_url( $cat['url'] ); ?>">
                        <?php if ( ! empty( $cat['icon']['ID'] ) ) : ?>
                            <span class="category-card__icon">
                                <?php echo wp_get_attachment_image( $cat['icon']['ID'], 'thumbnail', false, array( 'width' => 48, 'height' => 48, 'alt' => '' ) ); ?>
                            </span>
                        <?php endif; ?>
                        <h3 class="category-card__title"><?php echo esc_html( $cat['name'] ); ?></h3>
                        <?php if ( $cat['description'] ) : ?>
                            <p class="category-card__text"><?php echo esc_html( $cat['description'] ); ?></p>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
