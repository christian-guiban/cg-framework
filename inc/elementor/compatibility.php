<?php
/**
 * Elementor compatibility.
 *
 * The theme intentionally avoids styling Elementor's internal markup.
 * Elementor V4 Atomic Elements are rendered and styled by Elementor itself.
 *
 * @package CGFramework
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function gcf_elementor_theme_support() {
	add_theme_support( 'elementor' );
}
add_action( 'after_setup_theme', 'gcf_elementor_theme_support' );

function gcf_register_elementor_locations( $elementor_theme_manager ) {
	if ( method_exists( $elementor_theme_manager, 'register_all_core_location' ) ) {
		$elementor_theme_manager->register_all_core_location();
	}
}
add_action( 'elementor/theme/register_locations', 'gcf_register_elementor_locations' );

function gcf_elementor_body_class( $classes ) {
	if ( did_action( 'elementor/loaded' ) ) {
		$classes[] = 'gcf-elementor-active';
	}
	return $classes;
}
add_filter( 'body_class', 'gcf_elementor_body_class' );


/**
 * Load optional Elementor 3 compatibility styles.
 *
 * This is deliberately opt-in and only loads when Elementor is active.
 * Developers can extend the stylesheet or use the filter below for
 * project-specific adjustments.
 */
function gcf_enqueue_elementor_v3_compatibility() {
	if ( ! gcf_is_elementor_v3_compatibility_enabled() ) {
		return;
	}

	if ( ! did_action( 'elementor/loaded' ) ) {
		return;
	}

	wp_enqueue_style(
		'gcf-elementor-v3-compatibility',
		GCF_URI . '/assets/css/elementor-v3-compatibility.css',
		array( 'gcf-main' ),
		GCF_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'gcf_enqueue_elementor_v3_compatibility', 30 );

/**
 * Filter whether the optional Elementor compatibility layer is enabled.
 *
 * @param bool $enabled Current setting.
 * @return bool
 */
function gcf_is_elementor_v3_compatibility_enabled() {
	$enabled = (bool) get_theme_mod( 'gcf_elementor_v3_compatibility', false );
	return (bool) apply_filters( 'gcf_elementor_v3_compatibility_enabled', $enabled );
}

/**
 * Action hook for project-specific Elementor 3 PHP adjustments.
 */
function gcf_elementor_v3_compatibility_init() {
	if ( gcf_is_elementor_v3_compatibility_enabled() && did_action( 'elementor/loaded' ) ) {
		do_action( 'gcf_elementor_v3_compatibility_init' );
	}
}
add_action( 'after_setup_theme', 'gcf_elementor_v3_compatibility_init', 20 );
