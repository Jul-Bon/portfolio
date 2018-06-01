<?php
/**
 * Template Name: Page Portfolio
 *
 *
 */

get_header(min); ?>

    <div id="primary" class="content-area portfolio">
        <main id="main" class="site-main about-page container">

            <div class="clearfix">
                <?php
                //The query
                $page_number = (get_query_var('paged')) ? get_query_var('paged') : 1;

                $args = [
                    'post_type' => 'works',
                    'paged' => $paged,
                    'order' => 'DESC',
                    'posts_per_page' => 4
                ];

                query_posts($args);

                while (have_posts()) : the_post(); ?>

                    <?php get_template_part('template-parts/content-portfolio', 'page'); ?>
                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>
            </div>
            <div class="page_pagination">
                <?php the_posts_pagination(
                    $args = array(
                        'show_all' => false,
                        'end_size' => 1,
                        'mid_size' => 1,
                        'prev_next' => true,
                        'prev_text' => '«',
                        'next_text' => '»',
                        'add_args' => false,
                        'add_fragment' => '',
                        'before_page_number' => '',
                        'after_page_number' => '',
                    )); ?>
            </div>


        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();