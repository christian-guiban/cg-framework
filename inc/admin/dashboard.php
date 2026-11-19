<?php
/**
 * Theme admin information.
 *
 * @package CGFramework
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function gcf_admin_welcome_menu() {
	add_theme_page( __( 'CG Framework', 'cg-framework' ), __( 'Theme Guide', 'cg-framework' ), 'edit_theme_options', 'gcf-theme-guide', 'gcf_admin_welcome_page' );
}
add_action( 'admin_menu', 'gcf_admin_welcome_menu' );

function gcf_admin_welcome_page() {
	?>
	<div class="wrap gcf-admin-wrap">
		<h1>CG Framework</h1>
		<p class="gcf-admin-lead">A modular foundation for custom WordPress websites.</p>
		<div class="gcf-admin-card">
			<h2>Quick setup</h2>
			<ol>
				<li>Set your logo and site identity in <strong>Appearance → Customize</strong> or the Site Editor where available.</li>
				<li>Assign your Primary and Footer menus under <strong>Appearance → Menus</strong>.</li>
				<li>Install and activate WooCommerce or Elementor as required.</li>
				<li>Use <strong>Appearance → Shortcode Generator</strong> to create framework shortcodes.</li>
				<li>Use <strong>Appearance → Content Types</strong> to register custom content types.</li>
			</ol>
		</div>
		<div class="gcf-admin-card">
			<h2>Compatibility notes</h2>
			<p>Elementor controls layouts when its Theme Builder templates are assigned. Elementor V4 Atomic Elements are styled by Elementor; this theme avoids overriding their internal component styles.</p>
			<p>WooCommerce templates use native hooks and the theme does not ship copied WooCommerce template overrides, reducing update maintenance.</p>
			<p>After adding or changing post type rewrite settings, visit <strong>Settings → Permalinks</strong> and click Save Changes.</p>
		</div>
		<p>Version <?php echo esc_html( GCF_VERSION ); ?> · <a href="<?php echo esc_url( get_template_directory_uri() . '/CHANGELOG.md' ); ?>">Changelog</a></p>
	</div>
	<?php
}
