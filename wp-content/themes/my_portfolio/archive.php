<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package my_portfolio
 */

get_header('min');
?>

    <div class="archive_page">
        <div class="container clearfix">
            <div id="primary" class="content-area">
                <main id="main" class="site-main clearfix">
                    <header class="page-header">
                        <?php
                        the_archive_title('<h1 class="page-title">', '</h1>');
                        the_archive_description('<div class="archive-description">', '</div>');
                        ?>
                    </header><!-- .page-header -->

                    <?php
                    if (have_posts()) :

                    if (is_home() && !is_front_page()) :
                    ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>

                    <div class="blog_list clearfix">
                        <?php
                        endif;

                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();

                            /*
                             * Include the Post-Type-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                             */
                            get_template_part('template-parts/content-blog', get_post_type());

                        endwhile;

                        endif;
                        ?>
                    </div>
                </main><!-- #main -->
                <?php get_sidebar(); ?>
                <div class="page_navigation">
                    <?php if (function_exists('wp_pagenavi')) {
                        wp_pagenavi();
                    } ?>
                </div>
            </div><!-- #primary -->
        </div>
    </div>



<?php
get_footer();
