<?php
/**
 * Created by PhpStorm.
 * User: Hi-Tech
 */
?>

<div class="archive_description">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="archive_post_part">

            <div class="post-img">
                <?php my_portfolio_post_thumbnail(); ?>
            </div>

            <div class="archive_content_part">
                <span class="category"><?php the_category(); ?></span>

                <header class="entry-header blog-title clearfix">
                    <?php
                    if (is_singular()) :
                        the_title('<h1 class="entry-title">', '</h1>');
                    else :
                        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    endif; ?>
                </header><!-- .entry-header -->

                <div class="entry-content archive_blog_content">
                    <?php
                    the_excerpt();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'my_portfolio'),
                        'after' => '</div>',
                    ));
                    ?>

                </div>
                <a href="<?php the_permalink(); ?>" class="more_button">Читати далі</a>
            </div><!-- .entry-content -->
        </div>
    </article><!-- #post-<?php the_ID(); ?> -->
</div>

