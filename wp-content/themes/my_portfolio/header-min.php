<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package my_portfolio
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">


    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'my_portfolio'); ?></a>

    <header id="masthead" class="site-header">
        <div class="top_navigation">
            <div class="container">
                <nav id="site-navigation" class="main_navigation clearfix">
                    <div class="site-branding">
                        <?php the_custom_logo(); ?>
                    </div><!-- .site-branding -->

                    <div class="main_menu">
                        <a class="menu_toggle" href="#" aria-controls="primary-menu"
                           aria-expanded="false"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'menu-1',
                            'menu_id' => 'primary-menu',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'menu_class' => 'menu clearfix',
                        ));
                        ?>
                    </div>
                </nav><!-- #site-navigation -->
            </div>

    </header><!-- #masthead -->

    <div id="content" class="site-content">
