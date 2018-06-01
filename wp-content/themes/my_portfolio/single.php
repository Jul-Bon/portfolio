<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package my_portfolio
 */

get_header('min');
?>

    <div class="single_post">
        <div class="container clearfix">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">

                    <?php
                    while (have_posts()) :
                        the_post();

                        get_template_part('template-parts/content', get_post_type());

                        the_post_navigation(array(
                            'next_text' =>
                                '<span class="meta-nav " aria-hidden="true"><i class="fa fa-angle-right fa-2x" aria-hidden="true"></i></span> ',
                            'prev_text' =>
                                '<span class="meta-nav" aria-hidden="true"><i class="fa fa-angle-left fa-2x" aria-hidden="true"></i></span> '

                        ));

                        // If comments are open or we have at least one comment, load up the comment template.
                        //if (comments_open() || get_comments_number()) :
                        //    comments_template();
                        //endif;

                    endwhile; // End of the loop.
                    ?>

                </main><!-- #main -->
            </div><!-- #primary -->

            <?php get_sidebar(); ?>

        </div>
    </div>


<?php
get_footer();
