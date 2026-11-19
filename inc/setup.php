<?php
/**
 * Theme setup.
 *
 * @package CGFramework
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function gcf_theme_setup() {
	load_theme_textdomain( 'cg-framework', GCF_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.css' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 260, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 480,
		'single_image_width'    => 900,
		'product_grid'          => array( 'default_rows' => 3, 'min_rows' => 1, 'max_rows' => 8, 'default_columns' => 3, 'min_columns' => 1, 'max_columns' => 6 ),
	) );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'cg-framework' ),
		'footer'  => __( 'Footer Menu', 'cg-framework' ),
	) );
}
add_action( 'after_setup_theme', 'gcf_theme_setup' );

function gcf_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gcf_content_width', 1200 );
}
add_action( 'after_setup_theme', 'gcf_content_width', 0 );
