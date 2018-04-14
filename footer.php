<?php
/**
 * -----------------------------------------------------------------------------
 * The template for displaying the footer
 * -----------------------------------------------------------------------------
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Camel_Framework
 */

?>      

    </div><!-- .container -->
    
    <div class="container">
        <footer id="colophon" class="site-footer">
            <?php if (has_nav_menu('menu-footer')) :  ?>
                <div class="footer-menu">
                    <?php get_template_part('template-parts/navigation/navigation', 'footer'); ?>
                </div>
            <?php endif; ?>
            <div class="site-info">
                <a href="<?php echo esc_url(__('https://wordpress.org/', 'camel')); ?>">
                    <?php
                    /* translators: %s: CMS name, i.e. WordPress. */
                    printf(esc_html__('Proudly powered by %s', 'camel'), 'WordPress');
                    ?>
                </a>
                <span class="sep"> | </span>
                    <?php
                    /* translators: 1: Theme name, 2: Theme author. */
                    printf(esc_html__('Theme: %1$s by %2$s.', 'camel'), 'camel', '<a href="https://camelthemes.com">CamelThemes</a>');
                    ?>
            </div><!-- .site-info -->
        </footer><!-- #colophon -->
    </div><!-- .container -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
