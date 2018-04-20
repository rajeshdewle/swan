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
                </div><!-- .footer-menu -->
            <?php endif; ?>

            <div class="copyright text-center pb-3">
                <a href="<?php echo esc_url(__('https://wordpress.org/', 'camel-framework')); ?>">
                    <?php printf(esc_html__('Proudly powered by %s', 'camel-framework'), 'WordPress'); ?>
                </a>
                <span class="sep d-sm-inline-block d-none"> | </span>
                    <div class="d-inline-block">
                    <?php printf(esc_html__('Theme: %1$s by %2$s.', 'camel-framework'), 'camel-framework', '<a href="#">CamelThemes</a>'); ?>
                    </div>
            </div><!-- .copyright -->

        </div><!-- .container -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
