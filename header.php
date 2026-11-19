<?php
/**
 * Header template.
 *
 * @package CGFramework
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'cg-framework' ); ?></a>
<header class="site-header">
	<div class="gcf-container site-header__inner">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) { the_custom_logo(); } else { ?>
				<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			<?php } ?>
		</div>
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'cg-framework' ); ?></button>
		<nav class="primary-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'cg-framework' ); ?>">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => false, 'fallback_cb' => false ) ); ?>
		</nav>
	</div>
</header>
