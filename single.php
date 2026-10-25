<?php
defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
    the_post();

    $author_id = (int) get_the_author_meta( 'ID' );
    $category  = get_the_category();
    $category  = $category ? $category[0] : null;
    ?>

    <main class="main">
        <article class="post-page">
            <header class="container post-page__header">
                <div class="post-page__author">
                    <a class="post-page__avatar" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" tabindex="-1">
                        <?php
                        $photo = blog_field( 'author_photo', null, 'user_' . $author_id );
                        echo $photo
                            ? blog_image( $photo, 'blog-avatar', array( 'alt' => get_the_author() ) )
                            : get_avatar( $author_id, 48 );
                        ?>
                    </a>
                    <div>
                        <a class="post-page__author-name" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"><?php the_author(); ?></a>
                        <p class="post-page__date"><?php esc_html_e( 'Posted on', 'blog' ); ?> <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></p>
                    </div>
                </div>

                <h1 class="post-page__title"><?php the_title(); ?></h1>

                <?php if ( $category ) : ?>
                    <a class="post-page__category" href="<?php echo esc_url( get_category_link( $category ) ); ?>">
                        <?php
                        $icon = blog_field( 'category_icon', null, $category );
                        if ( ! empty( $icon['ID'] ) ) {
                            echo '<span class="post-page__category-icon">' . wp_get_attachment_image( $icon['ID'], 'thumbnail', false, array( 'width' => 48, 'height' => 48, 'alt' => '' ) ) . '</span>';
                        }
                        echo esc_html( $category->name );
                        ?>
                    </a>
                <?php endif; ?>
            </header>

            <?php
            $cover    = blog_field( 'post_cover' );
            $cover_id = ! empty( $cover['ID'] ) ? $cover['ID'] : get_post_thumbnail_id();
            ?>
            <?php if ( $cover_id ) : ?>
                <div class="container post-page__media">
                    <?php
                    echo wp_get_attachment_image( $cover_id, 'blog-cover', false, array(
                        'class'         => 'post-page__img',
                        'alt'           => blog_image_alt( $cover_id, get_the_title() ),
                        'sizes'         => '(max-width: 1440px) calc(100vw - 2 * 5rem), 1280px',
                        'fetchpriority' => 'high',
                        'loading'       => 'eager',
                    ) );
                    ?>
                </div>
            <?php endif; ?>

            <div class="container">
                <div class="entry-content post-page__content">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>

        <?php
        get_template_part( 'template-parts/sections/related-posts', null, array(
            'post_id'  => get_the_ID(),
            'category' => $category,
        ) );
        get_template_part( 'template-parts/sections/join' );
        ?>
    </main>

    <?php
endwhile;

get_footer();
