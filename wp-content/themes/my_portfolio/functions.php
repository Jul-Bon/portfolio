<?php
/**
 * my_portfolio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package my_portfolio
 */

if (!function_exists('my_portfolio_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function my_portfolio_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on my_portfolio, use a find and replace
         * to change 'my_portfolio' to the name of your theme in all the template files.
         */
        load_theme_textdomain('my_portfolio', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'my_portfolio'),
            'menu-2' => esc_html__('Social', 'my_portfolio')
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('my_portfolio_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 113,
            'width' => 59,
            'flex-width' => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'my_portfolio_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function my_portfolio_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('my_portfolio_content_width', 640);
}

add_action('after_setup_theme', 'my_portfolio_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function my_portfolio_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'my_portfolio'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'my_portfolio'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'my_portfolio_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function my_portfolio_scripts()
{
    wp_enqueue_style('my_portfolio-style', get_stylesheet_uri());

    wp_enqueue_script('my_portfolio-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);

    wp_enqueue_script('my_portfolio-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'my_portfolio_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}


// Add template unique style sheet.
function add_my_portfolio_scripts()
{
    //Font-awesome
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css');
    //My styles
    wp_enqueue_style('main-css', get_template_directory_uri() . '/css/main.css');
    //Animate styles
    wp_enqueue_style('animate-css', get_template_directory_uri() . '/css/animate.css');
    //WOW JS
    //wp_enqueue_script('main_js', get_template_directory_uri() . '/js/wow.min.js');
    wp_enqueue_script( 'wow', get_stylesheet_directory_uri() . '/js/wow.min.js', array(), '', true );

    //Theme JS
    wp_enqueue_script('main_js', get_template_directory_uri() . '/js/main.js');

}

add_action('wp_enqueue_scripts', 'add_my_portfolio_scripts');

function jquery_init() {
    if (!is_admin()) {
        wp_enqueue_script('jquery');
    }
}


//* Enqueue script to activate WOW.js
add_action('wp_enqueue_scripts', 'sk_wow_init_in_footer');
function sk_wow_init_in_footer() {
    add_action( 'print_footer_scripts', 'wow_init' );
}

//* Add JavaScript before </body>
function wow_init() { ?>
    <script type="text/javascript">
      new WOW().init();
    </script>
<?php }






//Add a filter to remove the structure [...]
add_filter('excerpt_more', function ($more) {
    return '...';
});

function new_excerpt_length($length)
{
    return 28;
}

add_filter('excerpt_length', 'new_excerpt_length');


//Function to replace the parameters of the tag cloud
function cottage_tag_cloud($args) {
    $args['smallest'] = '14';
    $args['largest'] = '14';
    $args['unit'] = 'px';
    return $args;
}

add_filter('widget_tag_cloud_args', 'cottage_tag_cloud');


//Function for post views count
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}





