<?php
/**
 * nopasera Theme Customizer
 *
 * @package nopasera
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function nopasera_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	// Add settings
	$wp_customize->add_setting( 'no_meta_data', array(
		'default' => true,
		'sanitize_callback' => 'sani_callback'
		)
    );
}
add_action( 'customize_register', 'nopasera_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function nopasera_customize_preview_js() {
	wp_enqueue_script( 'nopasera_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'nopasera_customize_preview_js' );


function sani_callback( $input ){
	switch( $input ){
		case '':
		default:
			break;
	}
}