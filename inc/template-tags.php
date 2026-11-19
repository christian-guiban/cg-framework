<?php
/**
 * Template helpers.
 *
 * @package CGFramework
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function gcf_posted_on() {
	printf(
		'<time class="entry-date" datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() )
	);
}

function gcf_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) { return; }
	the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) );
}
