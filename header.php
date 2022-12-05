<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wp-rig' ); ?></a>

	<div class="site-header--top-nav">
		<div class="site-header--top-nav--inner">
			<?php get_template_part( 'template-parts/header/navigation-top' ); ?>
		</div><!-- .site-header--top-nav--inner -->
	</div><!-- .site-header--top-nav -->
	<header id="masthead" class="site-header">
		<div class="site-header--inner">

			<button class="menu-toggle" aria-label="<?php esc_attr_e( 'Open menu', 'wp-rig' ); ?>" aria-controls="primary-menu" aria-expanded="false">
				<?php esc_html_e( 'Menu', 'wp-rig' ); ?>
				<span></span>
				<span></span>
				<span></span>
			</button>

			<?php get_template_part( 'template-parts/header/branding' ); ?>

			<?php
			/**
			 * Check to see if user is logged in and show either login or
			 */
			?>

			<?php get_template_part( 'template-parts/header/navigation' ); ?>

			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<div class="primary-nav-cart hide-desktop">
					<?php
					$cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
					$cart_url = wc_get_cart_url();  // Set Cart URL

					?>
					<a class="menu-item cart-contents" href="<?php echo $cart_url; ?>" title="cart">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
						<?php if ( $cart_count > 0 ) : ?>
							<span class="cart-contents-count"><?php echo $cart_count; ?></span>
						<?php endif; ?>
					</a>
				</div>

			<?php endif; ?>

		</div><!-- .site-header--inner -->
	</header><!-- #masthead -->
