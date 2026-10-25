<?php
defined( 'ABSPATH' ) || exit;

$categories = get_terms( array(
    'taxonomy'   => 'category',
    'hide_empty' => false,
    'orderby'    => 'term_id',
    'exclude'    => array( (int) get_option( 'default_category' ) ),
) );
$tags       = get_tags( array( 'hide_empty' => false ) );
$current_id = get_queried_object_id();
?>
<?php if ( ! is_wp_error( $categories ) && $categories ) : ?>
    <div class="sidebar-block">
        <h2 class="sidebar-block__title"><?php esc_html_e( 'Categories', 'blog' ); ?></h2>
        <ul class="sidebar-cats">
            <?php foreach ( $categories as $cat ) : ?>
                <li>
                    <a class="sidebar-cats__link" href="<?php echo esc_url( get_term_link( $cat ) ); ?>"<?php echo $cat->term_id === $current_id ? ' aria-current="page"' : ''; ?>>
                        <?php $icon = blog_field( 'category_icon', null, $cat ); ?>
                        <?php if ( ! empty( $icon['ID'] ) ) : ?>
                            <span class="category-card__icon">
                                <?php echo wp_get_attachment_image( $icon['ID'], 'thumbnail', false, array( 'width' => 48, 'height' => 48, 'alt' => '' ) ); ?>
                            </span>
                        <?php endif; ?>
                        <?php echo esc_html( $cat->name ); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if ( $tags ) : ?>
    <div class="sidebar-block">
        <h2 class="sidebar-block__title"><?php esc_html_e( 'All Tags', 'blog' ); ?></h2>
        <ul class="tags">
            <?php foreach ( $tags as $tag_item ) : ?>
                <li><a class="tags__link" href="<?php echo esc_url( get_tag_link( $tag_item ) ); ?>"<?php echo $tag_item->term_id === $current_id ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $tag_item->name ); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
