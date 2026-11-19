<?php
/**
 * Theme bootstrap.
 *
 * @package CGFramework
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GCF_VERSION', '1.1.0' );
define( 'GCF_DIR', get_template_directory() );
define( 'GCF_URI', get_template_directory_uri() );

$gcf_modules = array(
	'/inc/setup.php',
	'/inc/customizer.php',
	'/inc/enqueue.php',
	'/inc/template-tags.php',
	'/inc/elementor/compatibility.php',
	'/inc/woocommerce/compatibility.php',
	'/inc/shortcodes/shortcodes.php',
	'/inc/shortcodes/generator.php',
	'/inc/post-types/manager.php',
	'/inc/admin/dashboard.php',
);

foreach ( $gcf_modules as $gcf_module ) {
	$gcf_path = GCF_DIR . $gcf_module;
	if ( file_exists( $gcf_path ) ) {
		require_once $gcf_path;
	}
}
