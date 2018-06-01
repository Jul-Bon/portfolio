<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package my_portfolio
 */

get_header('min');
?>

    <div class="blog_banner" style="background: url('<?php echo get_theme_mod('blog_banner_background'); ?>') no-repeat center/cover">

    </div>

    <div id="primary" class="content-area content_blog">
        <main id="main" class="site-main container">

            <?php
            if ( have_posts() ) :

                if ( is_home() && ! is_front_page() ) :
                    ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>

                <div class="blog_list clearfix">
                    <?php
                    endif;

                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();

                        /*
                         * Include the Post-Type-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content-blog', get_post_type() );

                    endwhile;

                    endif;
                    ?>
                </div>

            <div class="page_navigation">
                <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
            </div>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
