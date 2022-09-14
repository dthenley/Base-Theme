<?php
/**
 * Template part for displaying the header branding
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<div class="site-branding">
	<a href="/" class="custom-logo-link" rel="home" aria-current="<?php echo get_post_type( get_the_id() ); ?>">

		<?php
		global $template;
		if ( ( 'lite-transparent-nav.php' === basename( $template ) ) && get_field( 'lite_logo', 'options' ) ) {
			echo '<img src="' . esc_url( wp_get_attachment_image_url( get_field( 'lite_logo', 'options' ), 'header-logo' )  ) . '" alt="' . get_bloginfo( 'name' ) . '" width="270" height="80" class="lite-logo">';

		} elseif ( get_field( 'lite_logo', 'options' ) ) {
			echo '<img src="' . esc_url( wp_get_attachment_image_url( get_field( 'dark_logo', 'options' ), 'header-logo' )  ) . '" alt="' . get_bloginfo( 'name' ) . '" width="270" height="80">';
		} elseif ( has_custom_logo() ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" width="200" height="80">';
		} else {
			echo '<p class="text-logo">' . get_bloginfo('name') . '</p>';
		}
		?>
	</a>
</div><!-- .site-branding -->
