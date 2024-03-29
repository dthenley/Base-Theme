<?php
/**
 * WP_Rig\WP_Rig\ACF\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\ACF;

use WP_Rig\WP_Rig\Component_Interface;
use function WP_Rig\WP_Rig\wp_rig;
use function add_action;
use function add_shortcode;

/**
 * Class for implementing ACF theme options support.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'acf';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', array( $this, 'add_acf_theme_options' ), 10, 2 );
		add_shortcode( 'phone', array( $this, 'phone' ) );
		add_shortcode( 'street-address', array( $this, 'street_address' ) );
		add_shortcode( 'social-media', array( $this, 'social_media' ) );
	}



	/**
	 *  Adds ACF Options Menu
	 *
	 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
	 * */
	public function add_acf_theme_options() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page(
				array(
					'page_title' => __( 'Theme Options', 'wp-rig' ),
					'position'   => 2,
				)
			);
		}

		add_image_size('header-logo',200,80,true );

	}

	/**
	 *  Add [phone] shortcode. pulls from theme settings.
	 **/
	public function phone() {
		$phone_number = get_field( 'phone_number', 'options' );
		$content      = '';
		if ( isset( $phone_number ) ) {
			$content = "<p><a href='tel:$phone_number' class='phone-shortcode'>$phone_number</a></p>";
		} else {
			$content = 'Add phone number from theme options';
		}
		return $content;
	}

	/**
	 *  Add [street-address] shortcode. pulls from theme settings.
	 **/
	public function street_address() {

		$content               = '';
		$street_address__block = '';

		$content = "<span class='street-address-shortcode'>";

		if ( get_field( 'address_link', 'options' ) ) {
			$street_address__block .= "<a href='". get_field( 'address_link', 'options' )."' class='street-address-shortcode-link' target='_blank' >";
		}

		if ( get_field( 'street_address', 'options' ) ) {
			$street_address__block .= '<span class="line-1">' . get_field( 'street_address', 'options' ) . '</span>';
		}
		if ( get_field( 'street_address_line_2', 'options' ) ) {
			$street_address__block .= '<span class="line-2">' . get_field( 'street_address_line_2', 'options' ) . '</span>';

		}

		$street_address__block .= '<span class="line-3">';
		if ( get_field( 'city', 'options' ) ) {
			$street_address__block .= get_field( 'city', 'options' );
		}
		if ( get_field( 'state', 'options' ) ) {
			if ( get_field( 'city', 'options' ) ) {
				$street_address__block .= ', ';

			}

			$street_address__block .= get_field( 'state', 'options' ) ;

		}
		if ( get_field( 'zip_code', 'options' ) ) {
			$street_address__block .= ' ' . get_field( 'zip_code', 'options' );

		}
		$street_address__block .= '</span">';

		if ( get_field( 'address_link', 'options' ) ) {
			$street_address__block .= "</a>";
		}

		if ( isset( $street_address__block ) ) {
			$content .= $street_address__block;

		} else {
			$content .= 'Add street address from theme options';
		}

		$content .= '</span><!-- street-address-shortcode-->';


		return $content;
	}

	/**
	 *  Add [social-media] shortcode. pulls from theme settings.
	 **/
	public function social_media() {

		$content = '';

		if ( have_rows( 'social_accounts', 'options' ) ) {
			$content = '<ul class="social-media-shortcode">';

			while ( have_rows( 'social_accounts', 'options' ) ) {
				the_row();
				$link = get_sub_field( 'link' );
				$icon = get_sub_field( 'icon' );
				$site_name = get_bloginfo( 'name' );

				if ( get_sub_field( 'social_name' ) ) {
					$social_name = get_sub_field( 'social_name' );
					$content .= "<li><a href='$link' alt='Follow $site_name on $social_name'>$icon</a></li>";
				} else {
					$content .= "<li><a href='$link' >$icon</a></li>";
				}

				/*
				$content .= '<li>';
				$content .= '<a href="';
				$content .= get_sub_field( 'link' );
				$content .= '" target="_blank">';
				$content .= get_sub_field( 'icon' );
				$content .= '</a>';
				$content .= '</li>';
				*/

			}

			$content .= '</ul>';
		} else {
			$content = 'Add social media in theme options';
		}

		return $content;
	}

}
