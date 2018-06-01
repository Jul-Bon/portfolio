<?php
/**
 * Created by PhpStorm.
 * User: Hi-Tech
 */
?>

<div class="post_description">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="post_part">

            <div class="post-img">
                <div class="overlay">
                    <a href="<?php the_permalink(); ?>" class="over_button">Читати далі</a>
                </div>
                <?php my_portfolio_post_thumbnail(); ?>
            </div>

            <div class="content_part">
                <span class="category"><?php the_category(); ?></span>

                <header class="entry-header blog-title clearfix">
                    <?php
                    if (is_singular()) :
                        the_title('<h1 class="entry-title">', '</h1>');
                    else :
                        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                    endif; ?>
                </header><!-- .entry-header -->

                <div class="entry-content blog-content">
                    <?php
                    the_excerpt();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'my_portfolio'),
                        'after' => '</div>',
                    ));
                    ?>

                </div>
            </div><!-- .entry-content -->
        </div>
    </article><!-- #post-<?php the_ID(); ?> -->
</div>

