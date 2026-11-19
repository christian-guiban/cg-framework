<?php
/**
 * Footer template.
 *
 * @package CGFramework
 */
?>
<footer class="site-footer">
	<div class="gcf-container">
		<nav aria-label="<?php esc_attr_e( 'Footer navigation', 'cg-framework' ); ?>"><?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => false ) ); ?></nav>
		<p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'cg-framework' ); ?></p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
