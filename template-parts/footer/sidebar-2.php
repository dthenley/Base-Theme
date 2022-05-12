<?php
/**
 * Template part for displaying the main footer section.
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

if ( ! wp_rig()->is_footer_nav_menu_active() ) {
	return;
}
?>
<div class="main-footer">
	<?php the_custom_logo(); ?>
	<nav>
		<?php wp_rig()->display_footer_nav_menu( array( 'menu_id' => 'footer-menu' ) ); ?>
	</nav>
	<?php echo do_shortcode('[yoast-social-media]'); ?>

</div>
