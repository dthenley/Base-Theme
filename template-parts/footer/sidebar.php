<?php
/**
 * Template part for displaying the main footer section.
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;


?>
<div class="main-footer">
	<?php
	if ( is_active_sidebar( 'footer-sidebar' ) ) {
		dynamic_sidebar( 'footer-sidebar' );
	}
	?>
</div>
