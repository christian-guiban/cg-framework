<?php
/**
 * Front-end assets.
 *
 * @package CGFramework
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function gcf_enqueue_assets() {
	wp_enqueue_style( 'gcf-theme', get_stylesheet_uri(), array(), GCF_VERSION );
	wp_enqueue_style( 'gcf-main', GCF_URI . '/assets/css/main.css', array( 'gcf-theme' ), GCF_VERSION );
	wp_enqueue_script( 'gcf-main', GCF_URI . '/assets/js/main.js', array(), GCF_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'gcf_enqueue_assets' );

function gcf_admin_assets( $hook ) {
	if ( false !== strpos( $hook, 'gcf-' ) ) {
		wp_enqueue_style( 'gcf-admin', GCF_URI . '/assets/css/admin.css', array(), GCF_VERSION );
		wp_enqueue_script( 'gcf-admin', GCF_URI . '/assets/js/admin.js', array(), GCF_VERSION, true );
	}
}
add_action( 'admin_enqueue_scripts', 'gcf_admin_assets' );
