<?php
/**
 * Template part for displaying the footer info
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<div class="site-info">
	&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
	<?php
	if ( function_exists( 'the_privacy_policy_link' ) ) {
		the_privacy_policy_link( '', '<span class="sep"> | </span>' );
	}
	?>
	<span class="sep"> | </span>

	<?php printf( esc_html__( 'Site by %s ', 'wp-rig' ), '<a href="' . esc_url( 'https://hexcodedesigns.com/' ) . '" target="_blank">Hexcode Designs, LLC</a>' ); ?>
</div><!-- .site-info -->
