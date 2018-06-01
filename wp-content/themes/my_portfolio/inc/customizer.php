<?php
/**
 * my_portfolio Theme Customizer
 *
 * @package my_portfolio
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function my_portfolio_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector' => '.site-title a',
            'render_callback' => 'my_portfolio_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector' => '.site-description',
            'render_callback' => 'my_portfolio_customize_partial_blogdescription',
        ));
    }

    //Header settings
    $wp_customize->add_section('header_settings', array(
        'title' => __('Settings for Header ', 'my_portfolio'),
        'priority' => 20,
    ));

    //Add settings for the banner background
    $wp_customize->add_setting('banner_background', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'default' => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'banner_background', array(
        'label' => __('Section Background Image', 'my_portfolio'),
        'section' => 'header_settings',
        'type' => 'background',
    )));

    //Section settings
    $wp_customize->add_section('section_settings', array(
        'title' => __('Settings for Sections', 'my_portfolio'),
        'priority' => 21,
    ));

    //Section My WORKS
    //Add settings for More button
    $wp_customize->add_setting('text_button', array(
        'default' => __('Button Title', 'my_portfolio'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('text_button', array(
        'label' => __('Button settings', 'my_portfolio'),
        'section' => 'section_settings',
        'settings' => 'text_button',
        'type' => 'text',
    ));

    $wp_customize->add_setting('url_button', array(
        'default' => __('URL for button', 'my_portfolio'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('url_button', array(
        'label' => __('Button URL', 'my_portfolio'),
        'section' => 'section_settings',
        'settings' => 'url_button',
        'type' => 'url',
    ));

    //Add settings to contact secrion
    $wp_customize->add_setting('contact_background', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'default' => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'contact_background', array(
        'label' => __('Contact Section Background Image', 'my_portfolio'),
        'section' => 'section_settings',
        'type' => 'background',
    )));


    //Add the settings of social networking icons
    $wp_customize->add_section('social_section', array(
        'title' => __('Social settings', 'my_portfolio'),
        'priority' => 36,
    ));

    $wp_customize->add_control('social_menu', array(
        'label' => __('Social menu in footer', 'my_portfolio'),
        'section' => 'social_section',
        'settings' => 'social_menu',
        'type' => 'text',
    ));

    $wp_customize->add_setting('facebook_social', array(
        'default' => __('Url facebook', 'my_portfolio'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('facebook_social', array(
        'label' => __('Facebook profile url', 'my_portfolio'),
        'section' => 'social_section',
        'settings' => 'facebook_social',
        'type' => 'text',
    ));

    $wp_customize->add_setting('instagram_social', array(
        'default' => __('Url Instagram', 'my_portfolio'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('instagram_social', array(
        'label' => __('Instagram profile url', 'my_portfolio'),
        'section' => 'social_section',
        'settings' => 'instagram_social',
        'type' => 'text',
    ));

    $wp_customize->add_setting('pinterest_social', array(
        'default' => __('Url Pinterest', 'my_portfolio'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('pinterest_social', array(
        'label' => __('Pinterest profile url', 'my_portfolio'),
        'section' => 'social_section',
        'settings' => 'pinterest_social',
        'type' => 'text',
    ));

    $wp_customize->add_setting('github_social', array(
        'default' => __('Url GitHub social', 'my_portfolio'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('github_social', array(
        'label' => __('GitHub in profile url', 'my_portfolio'),
        'section' => 'social_section',
        'settings' => 'github_social',
        'type' => 'text',
    ));


    //Add settings for the copyright field
    $wp_customize->add_section('footer_setting', array(
        'title' => __('Footer settings', 'my_portfolio'),
        'priority' => 37,
    ));

    $wp_customize->add_setting('footer_copy', array(
        'default' => __('Copyright text', 'my_portfolio'),
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('footer_copy', array(
        'label' => __('Footer settings', 'my_portfolio'),
        'section' => 'footer_setting',
        'settings' => 'footer_copy',
        'type' => 'textarea',
    ));


    //Blog page settings
    $wp_customize->add_section('blog_settings', array(
        'title' => __('Settings for Blog Page', 'my_portfolio'),
        'priority' => 38,
    ));

    //Add settings for the banner background
    $wp_customize->add_setting('blog_banner_background', array(
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'default' => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'blog_banner_background', array(
        'label' => __('Section Background Image', 'my_portfolio'),
        'section' => 'blog_settings',
        'type' => 'background',
    )));


}

add_action('customize_register', 'my_portfolio_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function my_portfolio_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function my_portfolio_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function my_portfolio_customize_preview_js()
{
    wp_enqueue_script('my_portfolio-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}

add_action('customize_preview_init', 'my_portfolio_customize_preview_js');
