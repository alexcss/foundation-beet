<?php
/**
 * Register theme support for languages, menus, post-thumbnails, post-formats etc.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

if ( ! function_exists( 'foundationpress_theme_support' ) ) :
function foundationpress_theme_support() {
	// Add language support
	load_theme_textdomain( 'foundationpress', get_template_directory() . '/languages' );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add menu support
	add_theme_support( 'menus' );

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Add post thumbnail support: http://codex.wordpress.org/Post_Thumbnails
	add_theme_support( 'post-thumbnails' );

	// RSS thingy
	add_theme_support( 'automatic-feed-links' );

	// Add post formats support: http://codex.wordpress.org/Post_Formats
	// add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat') );

	// Declare WooCommerce support per http://docs.woothemes.com/document/third-party-custom-theme-compatibility/
	//add_theme_support( 'woocommerce' );

	// Custom Header
	// add_theme_support( 'custom-header', array(
	// 		'height'        => '100',
	// 		'width'        => '200',
	// 		'flex-height'    => true,
	// 		'flex-width'    => true,
	// 		'uploads'       => true,
	// 		'header-text'   => false
	// 	)
	// );
	$defaults = array(
	        'height'      => 50,
	        'width'       => 50,
	        'flex-height' => true,
	        'flex-width'  => true
	    );
    add_theme_support( 'custom-logo', $defaults );
    add_theme_support( 'custom-background');

	// Add foundation.css as editor style https://codex.wordpress.org/Editor_Style
	add_editor_style( 'assets/css/app.css' );
}

add_action( 'after_setup_theme', 'foundationpress_theme_support' );
endif;

if ( ! function_exists( 'foundationpress_customizeer' ) ) :
/**
 * Remove the additional CSS and Background image section from the Customizer.
 * @param $wp_customize WP_Customize_Manager
 */
function foundationpress_customizeer( $wp_customize ) {
	$wp_customize->remove_section( 'custom_css' );
	$wp_customize->remove_section( 'background_image' );
}
add_action( 'customize_register', 'foundationpress_customizeer', 15 );
endif;
