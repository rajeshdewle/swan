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
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'camel' ); ?></a>
    <header id="masthead" class="site-header">
        <div class="site-branding">
            <?php the_custom_logo(); ?>

            <?php if ( is_front_page() && is_home() ) : ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                </h1>
            <?php else : ?>
                <p class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                </p>
            <?php endif; ?>

            <?php $bloginfo = get_bloginfo( 'description', 'display' ); ?>

            <?php if ( $bloginfo || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo $bloginfo; ?></p>
            <?php endif; ?>
        </div><!-- .site-branding -->

        <?php if ( has_nav_menu( 'menu-main' ) ) : ?>
            <div class="navigation-main">
                <?php get_template_part( 'template-parts/navigation/navigation', 'main' ); ?>
            </div><!-- .navigation-main -->
        <?php endif; ?>

</header><!-- #masthead -->

<div id="content" class="site-content">
