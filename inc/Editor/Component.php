<?php
/**
 * WP_Rig\WP_Rig\Editor\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Editor;

use WP_Rig\WP_Rig\Component_Interface;
use function add_action;
use function add_theme_support;

/**
 * Class for integrating with the block editor.
 *
 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'editor';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', array( $this, 'action_add_editor_support' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_block_styles' ) );
	}

	/**
	 * Adds support for various editor features.
	 */
	public function action_add_editor_support() {
		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for wide-aligned images.
		add_theme_support( 'align-wide' );

		// Add Custom Spacing.
		add_theme_support( 'custom-spacing' );

		/**
		 * Add support for color palettes.
		 *
		 * To preserve color behavior across themes, use these naming conventions:
		 * - Use primary and secondary color for main variations.
		 * - Use `theme-[color-name]` naming standard for standard colors (red, blue, etc).
		 * - Use `custom-[color-name]` for non-standard colors.
		 *
		 * Add the line below to disable the custom color picker in the editor.
		 * add_theme_support( 'disable-custom-colors' );
		 */

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Salmon', 'wp-rig' ),
					'slug'  => 'theme-salmon',
					'color' => '#b9273a',
				),
				array(
					'name'  => __( 'Black', 'wp-rig' ),
					'slug'  => 'theme-black',
					'color' => '#000',
				),
				array(
					'name'  => __( 'White', 'wp-rig' ),
					'slug'  => 'theme-white',
					'color' => '#fff',
				),
				array(
					'name'  => __( 'Gray', 'wp-rig' ),
					'slug'  => 'theme-gray',
					'color' => '#f5f5f5',
				),
			)
		);

		/*
		 * Add support custom font sizes.
		 *
		 * Add the line below to disable the custom color picker in the editor.
		 * add_theme_support( 'disable-custom-font-sizes' );
		 */
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Regular', 'wp-rig' ),
					'shortName' => __( 'R', 'wp-rig' ),
					'size'      => 20,
					'slug'      => 'regular',
				),
				array(
					'name'      => __( 'Heading 3', 'wp-rig' ),
					'shortName' => __( 'h3', 'wp-rig' ),
					'size'      => 28,
					'slug'      => 'heading-three',
				),
				array(
					'name'      => __( 'Heading 2', 'wp-rig' ),
					'shortName' => __( 'h2', 'wp-rig' ),
					'size'      => 36,
					'slug'      => 'heading-two',
				),
				array(
					'name'      => __( 'Heading 1', 'wp-rig' ),
					'shortName' => __( 'h1', 'wp-rig' ),
					'size'      => 48,
					'slug'      => 'heading-one',
				),
			)
		);
	}

	/**
	 * Removes Default Gutenberg Block Styles.
	 */
	public function dequeue_block_styles() {
		// wp_dequeue_style( 'wp-block-library' );
		// wp_dequeue_style( 'wp-block-library-theme' );
	}
}
