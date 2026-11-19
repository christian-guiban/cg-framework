<?php
/**
 * Shortcode generator admin page.
 *
 * @package CGFramework
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function gcf_shortcode_generator_menu() {
	add_submenu_page( 'themes.php', __( 'Shortcode Generator', 'cg-framework' ), __( 'Shortcode Generator', 'cg-framework' ), 'edit_posts', 'gcf-shortcodes', 'gcf_shortcode_generator_page' );
}
add_action( 'admin_menu', 'gcf_shortcode_generator_menu' );

function gcf_shortcode_generator_page() {
	if ( ! current_user_can( 'edit_posts' ) ) { return; }
	?>
	<div class="wrap gcf-admin-wrap">
		<h1><?php esc_html_e( 'Shortcode Generator', 'cg-framework' ); ?></h1>
		<p><?php esc_html_e( 'Build a reusable shortcode and copy it into the Block Editor, Elementor Shortcode widget, or any shortcode-enabled field.', 'cg-framework' ); ?></p>
		<div class="gcf-admin-card">
			<label for="gcf-shortcode-type"><?php esc_html_e( 'Shortcode', 'cg-framework' ); ?></label>
			<select id="gcf-shortcode-type">
				<option value="gcf_button">Button</option>
				<option value="gcf_alert">Alert</option>
				<option value="gcf_option">Website Information</option>
			</select>
			<div id="gcf-button-fields">
				<label for="gcf-button-text">Button text</label><input id="gcf-button-text" type="text" value="Learn more">
				<label for="gcf-button-url">URL</label><input id="gcf-button-url" type="url" value="https://example.com">
				<label for="gcf-button-target">Open link</label><select id="gcf-button-target"><option value="_self">Same tab</option><option value="_blank">New tab</option></select>
			</div>
			<div id="gcf-option-fields" hidden>
				<label for="gcf-option-field">Website information field</label>
				<select id="gcf-option-field"><option value="phone">Phone</option><option value="email">Email</option><option value="address">Address</option></select>
				<label for="gcf-option-type">Output format</label>
				<select id="gcf-option-type"><option value="text">Text</option><option value="link">Link</option></select>
				<p class="description">Values are managed under Appearance → Customize → Website Information.</p>
			</div>
			<div id="gcf-alert-fields" hidden>
				<label for="gcf-alert-title">Alert title</label><input id="gcf-alert-title" type="text" value="Notice">
				<label for="gcf-alert-type">Alert type</label><select id="gcf-alert-type"><option>info</option><option>success</option><option>warning</option><option>error</option></select>
				<label for="gcf-alert-text">Alert message</label><textarea id="gcf-alert-text">Your message goes here.</textarea>
			</div>
			<label for="gcf-shortcode-output">Generated shortcode</label>
			<textarea id="gcf-shortcode-output" readonly>[gcf_button url="https://example.com"]Learn more[/gcf_button]</textarea>
			<button type="button" class="button button-primary" id="gcf-copy-shortcode">Copy shortcode</button>
			<p class="description" id="gcf-copy-status" aria-live="polite"></p>
		</div>
		<div class="gcf-admin-card">
			<h2>Available shortcodes</h2>
			<p><code>[gcf_button url="https://example.com" target="_blank"]Button text[/gcf_button]</code></p>
			<p><code>[gcf_alert type="success" title="Success"]Your message[/gcf_alert]</code></p>
			<p><code>[gcf_option field="phone" type="link"]</code> · Website Information shortcode.</p>
		</div>
	</div>
	<?php
}
