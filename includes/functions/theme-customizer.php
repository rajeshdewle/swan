<?php
/**
 * -----------------------------------------------------------------------------
 * Camel Framework Theme Customizer
 * -----------------------------------------------------------------------------
 *
 * @package Camel_Framework
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function camel_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    // Custom option
    $wp_customize->add_section( 'camel_footer_section' , array(
        'title'      => __( 'Footer', 'camel-framework' ),
        'priority'   => 30,
    ) );

    $wp_customize->add_setting( 'camel_copyright_text' , array(
        'default'   => 'CamelThemes',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'copyright_text', array(
        'label'      => __( 'Copyright Text', 'camel-framework' ),
        'section'    => 'camel_footer_section',
        'settings'   => 'camel_copyright_text',
    ) ) );

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => function () {
                bloginfo( 'name' );
            },
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => function() {
                bloginfo( 'description' );
            },
        ) );
    }
}
add_action( 'customize_register', 'camel_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function camel_customize_preview_js() {
    wp_enqueue_script( 'camel-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'camel_customize_preview_js' );

