<?php
/**
 * Built-in framework shortcodes.
 *
 * @package CGFramework
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function gcf_button_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'url'    => '#',
		'target' => '_self',
		'class'  => '',
	), $atts, 'gcf_button' );

	$target = in_array( $atts['target'], array( '_self', '_blank' ), true ) ? $atts['target'] : '_self';
	$rel    = '_blank' === $target ? ' rel="noopener noreferrer"' : '';
	$class  = sanitize_html_class( $atts['class'] );
	return sprintf(
		'<a class="gcf-button %1$s" href="%2$s" target="%3$s"%4$s>%5$s</a>',
		esc_attr( $class ),
		esc_url( $atts['url'] ),
		esc_attr( $target ),
		$rel,
		wp_kses_post( do_shortcode( $content ) )
	);
}
add_shortcode( 'gcf_button', 'gcf_button_shortcode' );

function gcf_alert_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array( 'type' => 'info', 'title' => '' ), $atts, 'gcf_alert' );
	$type = in_array( $atts['type'], array( 'info', 'success', 'warning', 'error' ), true ) ? $atts['type'] : 'info';
	$title = $atts['title'] ? '<strong class="gcf-alert__title">' . esc_html( $atts['title'] ) . '</strong>' : '';
	return '<div class="gcf-alert gcf-alert--' . esc_attr( $type ) . '">' . $title . '<div>' . wp_kses_post( do_shortcode( $content ) ) . '</div></div>';
}
add_shortcode( 'gcf_alert', 'gcf_alert_shortcode' );


/**
 * Output a Website Information theme_mod as text or a semantic link.
 *
 * Usage:
 * [gcf_option field="phone" type="text"]
 * [gcf_option field="phone" type="link"]
 * [gcf_option field="email" type="link"]
 * [gcf_option field="address" type="link"]
 *
 * @param array       $atts    Shortcode attributes.
 * @param string|null $content Optional enclosed content (unused).
 * @return string
 */
function gcf_option_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'field' => 'phone',
			'type'  => 'text',
		),
		$atts,
		'gcf_option'
	);

	$field = sanitize_key( $atts['field'] );
	$type  = sanitize_key( $atts['type'] );

	$allowed_fields = array( 'phone', 'email', 'address' );
	if ( ! in_array( $field, $allowed_fields, true ) ) {
		return '';
	}

	$value = get_theme_mod( 'gcf_' . $field, '' );
	if ( ! is_string( $value ) || '' === trim( $value ) ) {
		return '';
	}

	switch ( $field ) {
		case 'email':
			$value = sanitize_email( $value );
			break;
		case 'address':
			$value = sanitize_textarea_field( $value );
			break;
		case 'phone':
		default:
			$value = sanitize_text_field( $value );
			break;
	}

	if ( '' === $value ) {
		return '';
	}

	if ( 'link' !== $type ) {
		return esc_html( $value );
	}

	switch ( $field ) {
		case 'phone':
			$phone_href = preg_replace( '/[^0-9+]/', '', $value );
			$has_leading_plus = ( 0 === strpos( $phone_href, '+' ) );
			$phone_href = str_replace( '+', '', $phone_href );
			if ( $has_leading_plus ) {
				$phone_href = '+' . $phone_href;
			}
			if ( '' === $phone_href || '+' === $phone_href ) {
				return esc_html( $value );
			}
			return sprintf(
				'<a href="%1$s">%2$s</a>',
				esc_url( 'tel:' . $phone_href ),
				esc_html( $value )
			);

		case 'email':
			if ( ! is_email( $value ) ) {
				return esc_html( $value );
			}
			return sprintf(
				'<a href="%1$s">%2$s</a>',
				esc_url( 'mailto:' . $value ),
				antispambot( esc_html( $value ) )
			);

		case 'address':
			$maps_url = add_query_arg(
				'q',
				$value,
				'https://maps.google.com/'
			);
			return sprintf(
				'<a href="%1$s" target="_blank" rel="noopener noreferrer">%2$s</a>',
				esc_url( $maps_url ),
				esc_html( $value )
			);
	}

	return esc_html( $value );
}
add_shortcode( 'gcf_option', 'gcf_option_shortcode' );
