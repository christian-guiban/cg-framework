<?php
/**
 * WooCommerce integration.
 *
 * @package CGFramework
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function gcf_woocommerce_setup() {
	if ( class_exists( 'WooCommerce' ) ) {
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
}
add_action( 'after_setup_theme', 'gcf_woocommerce_setup', 20 );

function gcf_woocommerce_wrapper_start() {
	echo '<main id="primary" class="site-main gcf-shop"><div class="gcf-container">';
}
function gcf_woocommerce_wrapper_end() {
	echo '</div></main>';
}
function gcf_woocommerce_wrappers() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	add_action( 'woocommerce_before_main_content', 'gcf_woocommerce_wrapper_start', 10 );
	add_action( 'woocommerce_after_main_content', 'gcf_woocommerce_wrapper_end', 10 );
}
add_action( 'init', 'gcf_woocommerce_wrappers' );

function gcf_woocommerce_sidebar() {
	return is_active_sidebar( 'sidebar-woocommerce' );
}
add_filter( 'is_active_sidebar', function( $active, $index ) {
	if ( 'sidebar-woocommerce' === $index && ! is_active_sidebar( 'sidebar-1' ) ) {
		return false;
	}
	return $active;
}, 10, 2 );
