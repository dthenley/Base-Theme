<?php
/**
 * Template part for displaying the header navigation menu
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( ! wp_rig()->is_top_left_nav_menu_active() || ! wp_rig()->is_top_right_nav_menu_active() ) {
	return;
}

?>

<nav id="top-navigation" class="top-navigation" aria-label="<?php esc_attr_e( 'Top Navigation', 'wp-rig' ); ?>">

	<div class="top-left-nav-menu">
		<?php wp_rig()->display_top_left_nav_menu(); ?>
	</div>

	<div class="top-right-nav-menu">
		<?php wp_rig()->display_top_right_nav_menu(); ?>
	</div>

</nav><!-- #top-navigation -->
