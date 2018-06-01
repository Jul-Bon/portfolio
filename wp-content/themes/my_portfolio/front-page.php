<?php
/**
 * The template for front page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package my_portfolio
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php if (is_front_page()) : ?>
                <section class="about_me">
                    <div class="container clearfix">
                        <div class="headline">
                            <h2><?php the_field('title_about_me'); ?></h2>
                        </div>
                        <div class="text_part">
                            <?php the_field('text_about_me'); ?>
                        </div>
                        <div class="img_part">
                            <?php if (get_field('my_photo')): ?>
                                <img src="<?php the_field('my_photo'); ?>"/>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>

                <section class="skills_section">
                    <div class="container">
                        <div class="headline">
                            <h2><?php the_field('title_my_skiils'); ?></h2>
                        </div>
                        <?php
                        //The query
                        $args = array(
                            'post_type' => 'my_skills',
                            'order' => 'ASC',
                            'posts_per_page' => 10
                        );
                        $skills = new WP_Query($args); ?>

                        <?php if ($skills->have_posts()): ?>
                            <ul class="skills_list clearfix">
                                <!-- The loop -->
                                <?php while ($skills->have_posts()) : $skills->the_post(); ?>
                                    <li class="skill">
                                        <?php the_title(); ?>
                                        <div class="value">
                                            <div class="progress wow fadeInLeft" data-wow-delay="1s" style="width:<?php the_field('progress_value'); ?>%"></div>
                                        </div>
                                    </li>
                                <?php endwhile; ?>
                                <!-- End of the loop -->
                            </ul>
                            <?php wp_reset_query(); ?>
                        <?php endif; ?>
                    </div>
                </section>


                <section class="last_work">
                    <div class="container">
                        <div class="headline">
                            <h2><?php the_field('title_portfolio'); ?></h2>
                        </div>
                        <div class="clearfix">
                            <?php
                            //The query
                            $args = array(
                                'post_type' => 'works',
                                'order' => 'DESC',
                                'posts_per_page' => 4
                            );
                            $works = new WP_Query($args); ?>

                            <?php if ($works->have_posts()): ?>

                                <!-- The loop -->
                                <?php while ($works->have_posts()) : $works->the_post(); ?>
                                    <div class="my_work wow zoomIn" data-wow-delay="1s">
                                        <?php if (get_field('image_for_project')): ?>
                                            <img src="<?php the_field('image_for_project'); ?>"/>
                                        <?php endif; ?>
                                    </div>
                                <?php endwhile; ?>
                                <!-- End of the loop -->

                                <?php wp_reset_query(); ?>
                            <?php endif; ?>
                        </div>
                        <a class="button" href="<?php echo get_theme_mod('url_button'); ?>">
                            <?php echo get_theme_mod('text_button'); ?>
                        </a>
                    </div>
                </section>

                <section class="contacts"
                         style="background: url('<?php echo get_theme_mod('contact_background'); ?>') no-repeat center/cover">
                    <div class="container clearfix">
                        <div class="headline">
                            <h2><?php the_field('title_contact_section'); ?></h2>
                        </div>

                        <div class="info_block">
                            <div class="info">
                                <ul class="contuct_list">
                                    <li><?php the_field('city'); ?></li>
                                    <li><?php the_field('phone_number'); ?></li>
                                    <li><a href="mailto:<?php the_field('e-mail'); ?>"><?php the_field('e-mail'); ?></a>
                                    </li>
                                </ul>
                                <ul class="social_networks">
                                    <?php if (get_theme_mod('facebook_social') != ''): ?>
                                        <li>
                                            <a href="<?php echo get_theme_mod('facebook_social'); ?>" target="_blank">
                                                <i class="fa fa-facebook" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (get_theme_mod('instagram_social') != ''): ?>
                                        <li>
                                            <a href="<?php echo get_theme_mod('instagram_social'); ?>" target="_blank">
                                                <i class="fa fa-instagram" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (get_theme_mod('pinterest_social') != ''): ?>
                                        <li>
                                            <a href="<?php echo get_theme_mod('pinterest_social'); ?>" target="_blank">
                                                <i class="fa fa-pinterest" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (get_theme_mod('github_social') != ''): ?>
                                        <li><a href="<?php echo get_theme_mod('github_social'); ?>" target="_blank">
                                                <i class="fa fa-github" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>

                            <div class="contact_form">
                                <?php echo do_shortcode('[contact-form-7 id="78" title="Contact form 1"]'); ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php

get_footer();
