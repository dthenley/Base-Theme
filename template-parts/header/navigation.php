<?php
/**
 * Template part for displaying the header navigation menu
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( ! wp_rig()->is_primary_nav_menu_active() ) {
	return;
}

?>

<button class="menu-toggle" aria-label="<?php esc_attr_e( 'Open menu', 'wp-rig' ); ?>" aria-controls="primary-menu" aria-expanded="false">
	<?php esc_html_e( 'Menu', 'wp-rig' ); ?>
	<span></span>
	<span></span>
	<span></span>
</button>

<nav id="site-navigation" class="main-navigation nav--toggle-sub nav--toggle-small" aria-label="<?php esc_attr_e( 'Main menu', 'wp-rig' ); ?>">

	<?php
	wp_rig()->display_primary_nav_menu(
		array(
			'menu_id' => 'primary-menu',
			'items_wrap' => '
			<ul id="%1$s" class="%2$s">
			%3$s
			<li class="social-media-main-nav hide-desktop">' . do_shortcode( "[social-media]" ) . '</li>
			</ul>',
		)
	);
	?>

</nav><!-- #site-navigation -->
