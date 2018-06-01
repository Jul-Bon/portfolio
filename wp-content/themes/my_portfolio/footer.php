<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package my_portfolio
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <div class="site-info container clearfix">
        <div class="footer-menu clearfix">
            <?php wp_nav_menu('menu=Footer menu'); ?>
        </div>
        <span class="copyright"><?php echo get_theme_mod('footer_copy'); ?></span>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
