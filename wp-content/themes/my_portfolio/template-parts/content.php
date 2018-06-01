<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package my_portfolio
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php setPostViews(get_the_ID()); ?>
    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;
        if ('post' === get_post_type()) :
            ?>
            <div class="entry-meta">
                <?php
                my_portfolio_posted_on();
                my_portfolio_posted_by();
                ?>
                <span class="in_category">/<?php the_category(); ?></span>
                <span class="part view">/
                    <?php echo getPostViews(get_the_ID()); ?>
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                </span>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php my_portfolio_post_thumbnail(); ?>

    <div class="entry-content">
        <?php
        the_content(sprintf(
            wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'my_portfolio'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ));

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'my_portfolio'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
