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

<div id="page">
    <a class="skip-link sr-only" href="#content"><?php esc_html_e('Skip to content', 'camel-framework'); ?></a>

    <header class="header mb-4" style="background-image: url(<?php header_image(); ?>);"> 
        <?php if (has_nav_menu('menu-top') || has_nav_menu('menu-social')) : ?>
            <div class="top-navigation border-bottom">
                <div class="container">
                    <div class="row">
                        <?php if (has_nav_menu('menu-top')) : ?>
                            <div class="col-sm-6">
                                <?php get_template_part('template-parts/navigation/navigation', 'top'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (has_nav_menu('menu-social')) : ?>
                            <?php if (! has_nav_menu('menu-top')) : ?>
                                <div class="col-sm-12">
                            <?php else: ?>
                                <div class="col-sm-6">
                            <?php endif; ?>
                                <?php get_template_part('template-parts/navigation/navigation', 'social'); ?>
                            </div>
                        <?php endif; ?>
                    </div><!-- .row -->
                </div><!-- .container -->
            </div><!-- .top-navigation -->
        <?php endif; ?>

        <div class="site-branding my-4 d-flex justify-content-center justify-content-md-start">
            <div class="container">                    
                <div class="text-center text-md-left">
                    <?php the_custom_logo(); ?>

                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                    </h1>

                    <?php $bloginfo = get_bloginfo('description', 'display'); ?>

                    <?php if ( $bloginfo || is_customize_preview()) : ?>
                        <p class="site-description mt-1"><?php echo $bloginfo; ?></p>
                    <?php endif; ?>
                </div><!-- .text-center -->
            </div><!-- .container -->
        </div><!-- .site-branding -->
    

        <?php if (has_nav_menu('menu-main')) : ?>                 
            <?php get_template_part('template-parts/navigation/navigation', 'main'); ?>
        <?php endif; ?>
    </header><!-- #masthead -->

    <div id="content" class="container">

