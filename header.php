<?php
/**
 * -----------------------------------------------------------------------------
 * The header for our theme
 * -----------------------------------------------------------------------------
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Camel_Framework
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'camel'); ?></a>

    <div class="container">
        <header>
            <?php if (has_nav_menu('menu-top') || has_nav_menu('menu-social')) : ?>
                <div class="row">
                    <?php if (has_nav_menu('menu-top')) : ?>
                        <div class="col-6 top-menu">
                            <?php get_template_part('template-parts/navigation/navigation', 'top'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (has_nav_menu('menu-social')) : ?>
                        <div class="col-6 social-menu text-right">
                            <?php get_template_part('template-parts/navigation/navigation', 'social'); ?>
                        </div>
                    <?php endif; ?>
                </div><!-- .row -->
            <?php endif; ?>

            <div class="site-branding">
                <?php if ( has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <h1>
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                    </h1>
                <?php endif; ?>
                
                <?php $bloginfo = get_bloginfo('description', 'display'); ?>

                <?php if ($bloginfo || is_customize_preview()) : ?>
                    <p class="site-description"><?php echo $bloginfo; ?></p>
                <?php endif; ?>
            </div><!-- .site-branding -->

            <?php if (has_nav_menu('menu-main')) : ?>
                <div class="main-menu">
                    <?php get_template_part('template-parts/navigation/navigation', 'main'); ?>
                </div><!-- .navigation-main -->
            <?php endif; ?>
        </header><!-- #masthead -->
    </div><!-- .container -->

    <div id="content" class="container">
