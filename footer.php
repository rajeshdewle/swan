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

    <footer class="footer bg-light border-top mt-4">
        <div class="container">

            <?php if (has_nav_menu('menu-footer')) :  ?>
                <div class="footer-menu my-4">
                    <?php get_template_part('template-parts/navigation/navigation', 'footer'); ?>
                </div>
            <?php endif; ?>

            <div class="copyright text-center mb-4">
                <a href="<?php echo esc_url(__('https://wordpress.org/', 'camel')); ?>">
                    <?php printf(esc_html__('Proudly powered by %s', 'camel'), 'WordPress'); ?>
                </a>
                <span class="sep"> | </span>
                <?php printf(esc_html__('Theme: %1$s by %2$s.', 'camel'), 'camel', '<a href="https://camelthemes.com">CamelThemes</a>'); ?>
            </div><!-- .copyright -->

        </div><!-- .container -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
