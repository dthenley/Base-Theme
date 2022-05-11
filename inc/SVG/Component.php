<?php
/**
 * WP_Rig\WP_Rig\SVG\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\SVG;

use WP_Rig\WP_Rig\Component_Interface;
use add_filter;
use wp_check_filetype;

/**
 * Class for enable SVG's on the site.
 *
 */

class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the SVG component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'svg';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {

		// Allow SVG
		add_filter( 'wp_check_filetype_and_ext', array( $this, 'check_site' ), 10, 4 );
		add_filter( 'upload_mimes', array($this, 'cc_mime_types') );
		add_action( 'admin_head', array($this, 'fix_svg') );


	}

	public function check_site($data, $file, $filename, $mimes) {

		global $wp_version;
		if ( $wp_version !== '4.7.1' ) {
		   return $data;
		}

		$filetype = wp_check_filetype( $filename, $mimes );

		return [
			'ext'             => $filetype['ext'],
			'type'            => $filetype['type'],
			'proper_filename' => $data['proper_filename']
		];
	}


	public function cc_mime_types( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	public function fix_svg() {

		echo '<style type="text/css">
		.attachment-266x266, .thumbnail img {
		width: 100% !important;
		height: auto !important;
		}
		</style>';
	}
}
