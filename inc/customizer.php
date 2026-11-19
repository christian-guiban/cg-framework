<?php
/**
 * Theme Customizer settings.
 *
 * @package CGFramework
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Website Information and compatibility controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function gcf_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'gcf_website_information',
		array(
			'title'       => __( 'Website Information', 'cg-framework' ),
			'description' => __( 'Manage the contact information used by your website.', 'cg-framework' ),
			'priority'    => 30,
		)
	);

	$contact_fields = array(
		'phone' => array(
			'label'             => __( 'Phone Number', 'cg-framework' ),
			'type'              => 'text',
			'sanitize_callback' => 'sanitize_text_field',
		),
		'email' => array(
			'label'             => __( 'Email Address', 'cg-framework' ),
			'type'              => 'email',
			'sanitize_callback' => 'sanitize_email',
		),
		'address' => array(
			'label'             => __( 'Physical Address', 'cg-framework' ),
			'type'              => 'textarea',
			'sanitize_callback' => 'sanitize_textarea_field',
		),
	);

	foreach ( $contact_fields as $key => $field ) {
		$setting_id = 'gcf_' . $key;

		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => $field['sanitize_callback'],
			)
		);

		$wp_customize->add_control(
			$setting_id,
			array(
				'label'   => $field['label'],
				'section' => 'gcf_website_information',
				'type'    => $field['type'],
			)
		);
	}

	$wp_customize->add_section(
		'gcf_elementor_compatibility',
		array(
			'title'       => __( 'Elementor Compatibility', 'cg-framework' ),
			'description' => __( 'Optional compatibility adjustments for Elementor 3 layouts.', 'cg-framework' ),
			'priority'    => 31,
		)
	);

	$wp_customize->add_setting(
		'gcf_elementor_v3_compatibility',
		array(
			'default'           => false,
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'gcf_elementor_v3_compatibility',
		array(
			'label'       => __( 'Enable Elementor v3 Compatibility', 'cg-framework' ),
			'description' => __( 'Load the theme compatibility layer for Elementor 3 Flexbox Containers and legacy widget layouts.', 'cg-framework' ),
			'section'     => 'gcf_elementor_compatibility',
			'type'        => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'gcf_customize_register' );
