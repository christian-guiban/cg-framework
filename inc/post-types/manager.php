<?php
/**
 * Lightweight CPT and taxonomy manager.
 *
 * Definitions are stored in the database, not hard-coded into theme files.
 * For mission-critical content portability, consider moving registrations
 * into a site-specific plugin before changing themes.
 *
 * @package CGFramework
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function gcf_register_saved_content_types() {
	$types = get_option( 'gcf_content_types', array() );
	if ( ! is_array( $types ) ) { return; }

	foreach ( $types as $type ) {
		if ( empty( $type['slug'] ) || ! preg_match( '/^[a-z0-9_-]{2,20}$/', $type['slug'] ) ) { continue; }
		$slug = sanitize_key( $type['slug'] );
		$label = ! empty( $type['label'] ) ? sanitize_text_field( $type['label'] ) : ucfirst( $slug );
		register_post_type( $slug, array(
			'labels' => array( 'name' => $label, 'singular_name' => $label ),
			'public' => true,
			'has_archive' => ! empty( $type['archive'] ),
			'show_in_rest' => true,
			'menu_icon' => 'dashicons-admin-post',
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
			'rewrite' => array( 'slug' => $slug ),
		) );
		if ( ! empty( $type['taxonomy'] ) && preg_match( '/^[a-z0-9_-]{2,32}$/', $type['taxonomy'] ) ) {
			$tax = sanitize_key( $type['taxonomy'] );
			register_taxonomy( $tax, array( $slug ), array(
				'labels' => array( 'name' => ucfirst( str_replace( '_', ' ', $tax ) ) ),
				'public' => true,
				'hierarchical' => true,
				'show_in_rest' => true,
				'rewrite' => array( 'slug' => $tax ),
			) );
		}
	}
}
add_action( 'init', 'gcf_register_saved_content_types', 5 );

function gcf_content_types_menu() {
	add_submenu_page( 'themes.php', __( 'Content Types', 'cg-framework' ), __( 'Content Types', 'cg-framework' ), 'manage_options', 'gcf-content-types', 'gcf_content_types_page' );
}
add_action( 'admin_menu', 'gcf_content_types_menu' );

function gcf_content_types_page() {
	if ( ! current_user_can( 'manage_options' ) ) { return; }
	$types = get_option( 'gcf_content_types', array() );
	if ( isset( $_POST['gcf_add_content_type'] ) ) {
		check_admin_referer( 'gcf_add_content_type_action', 'gcf_content_type_nonce' );
		$slug = isset( $_POST['gcf_slug'] ) ? sanitize_key( wp_unslash( $_POST['gcf_slug'] ) ) : '';
		$label = isset( $_POST['gcf_label'] ) ? sanitize_text_field( wp_unslash( $_POST['gcf_label'] ) ) : '';
		$taxonomy = isset( $_POST['gcf_taxonomy'] ) ? sanitize_key( wp_unslash( $_POST['gcf_taxonomy'] ) ) : '';
		$archive = isset( $_POST['gcf_archive'] ) ? 1 : 0;
		if ( preg_match( '/^[a-z0-9_-]{2,20}$/', $slug ) && $label ) {
			$types[] = array( 'slug' => $slug, 'label' => $label, 'taxonomy' => $taxonomy, 'archive' => $archive );
			update_option( 'gcf_content_types', $types );
			echo '<div class="notice notice-success"><p>' . esc_html__( 'Content type saved. Refresh permalinks if needed.', 'cg-framework' ) . '</p></div>';
		} else {
			echo '<div class="notice notice-error"><p>' . esc_html__( 'Use a 2–20 character slug (letters, numbers, underscores or hyphens) and provide a label.', 'cg-framework' ) . '</p></div>';
		}
	}
	if ( isset( $_GET['delete'] ) ) {
		$index = absint( $_GET['delete'] );
		check_admin_referer( 'gcf_delete_type_' . $index );
		if ( isset( $types[ $index ] ) ) {
			unset( $types[ $index ] );
			update_option( 'gcf_content_types', array_values( $types ) );
			$types = array_values( $types );
			echo '<div class="notice notice-success"><p>' . esc_html__( 'Definition removed. Existing content is not deleted.', 'cg-framework' ) . '</p></div>';
		}
	}
	?>
	<div class="wrap gcf-admin-wrap">
		<h1>Custom Post Types &amp; Taxonomies</h1>
		<p>Register simple content types from the dashboard. For advanced capabilities, use a dedicated plugin or site-specific code.</p>
		<div class="gcf-admin-card">
			<h2>Add content type</h2>
			<form method="post">
				<?php wp_nonce_field( 'gcf_add_content_type_action', 'gcf_content_type_nonce' ); ?>
				<label for="gcf-label">Plural label</label><input id="gcf-label" name="gcf_label" required placeholder="Projects">
				<label for="gcf-slug">Post type slug</label><input id="gcf-slug" name="gcf_slug" required maxlength="20" placeholder="project">
				<label for="gcf-taxonomy">Optional taxonomy slug</label><input id="gcf-taxonomy" name="gcf_taxonomy" maxlength="32" placeholder="project_category">
				<label><input type="checkbox" name="gcf_archive" value="1" checked> Enable archive</label>
				<p><button class="button button-primary" name="gcf_add_content_type" value="1">Save content type</button></p>
			</form>
		</div>
		<div class="gcf-admin-card">
			<h2>Registered framework definitions</h2>
			<?php if ( empty( $types ) ) : ?><p>No custom types added yet.</p><?php else : ?>
				<table class="widefat striped"><thead><tr><th>Label</th><th>Post type</th><th>Taxonomy</th><th>Archive</th><th></th></tr></thead><tbody>
				<?php foreach ( $types as $i => $type ) : ?><tr>
					<td><?php echo esc_html( $type['label'] ); ?></td><td><code><?php echo esc_html( $type['slug'] ); ?></code></td><td><?php echo esc_html( $type['taxonomy'] ); ?></td><td><?php echo ! empty( $type['archive'] ) ? 'Yes' : 'No'; ?></td>
					<td><a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'delete', $i ), 'gcf_delete_type_' . $i ) ); ?>" onclick="return confirm('Remove this registration? Existing posts will remain.');">Remove</a></td>
				</tr><?php endforeach; ?>
				</tbody></table>
			<?php endif; ?>
		</div>
		<p><strong>Important:</strong> Post type registrations are stored in theme options. For long-term content portability, migrate these registrations to a site-specific plugin before switching themes.</p>
	</div>
	<?php
}
