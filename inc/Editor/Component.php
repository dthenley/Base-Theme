<?php
/**
 * WP_Rig\WP_Rig\Editor\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Editor;

use function WP_Rig\WP_Rig\wp_rig;
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
		add_action( 'enqueue_block_editor_assets', array( $this, 'editor_assets' ) );
		add_action( 'after_setup_theme', array( $this, 'my_remove_patterns' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'call_custom_attributes_script' ) );

	}

	/**
	 * Adds support for various editor features.
	 */
	public function action_add_editor_support() {
		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for default block styles.
		add_theme_support( 'wp-block-styles' );
	}

	/**
	 * Removes Default Gutenberg Block Styles.
	 */
	public function dequeue_block_styles() {
		// wp_dequeue_style( 'wp-block-library' );
		// wp_dequeue_style( 'wp-block-library-theme' );
	}

	/**
	 * Remove and Add Gutenberg Styles
	 */
	public function editor_assets() {
		wp_enqueue_script(
			'remove-block-styles',
			get_template_directory_uri() . '/assets/js/blocks/block-styles.min.js',
			array ( 'wp-blocks', 'wp-edit-post' ),
			wp_rig()->get_asset_version( get_theme_file_path(get_template_directory_uri() . '/assets/js/blocks/block-styles.min.js'))
		);
	}

	/**
	 * Remove Core Block Patterns
	 */
	public function my_remove_patterns() {
		remove_theme_support( 'core-block-patterns' );
	}

	/**
	 * Call Custom Attributes JS
	 */
	public function call_custom_attributes_script() {
		wp_register_script(
			'custom-attributes',
			get_template_directory_uri() . '/build/index.js',
			[ 'wp-blocks', 'wp-dom', 'wp-dom-ready', 'wp-edit-post' ],
			wp_rig()->get_asset_version( get_theme_file_path(get_template_directory_uri() . '/build/index.js'))
		);
		wp_enqueue_script( 'custom-attributes' );
	}


}
