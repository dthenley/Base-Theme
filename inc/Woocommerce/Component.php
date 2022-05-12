<?php
/**
 * WP_Rig\WP_Rig\Woocommerce\Component class
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig\Woocommerce;

use WP_Rig\WP_Rig\Component_Interface;
use function add_action;
use function add_theme_support;
use function remove_action;
use function after_setup_theme;

/**
 * Class for managing woocommerce support.
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'woocommerce';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', array( $this, 'action_add_woocommerce_support' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'load_woo_styles' ) );

		// Remove blog sidebar.
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

		// Add woocommerce sidebar.
		add_action( 'widgets_init', array( $this, 'wp_rig_woocommerce_sidebar' ) );
		add_action( 'woocommerce_sidebar', array( $this, 'add_woocommerce_sidebar' ), 5 );

	}

	/**
	 * Adds support for Woocommerce.
	 *
	 * @link https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/
	 */
	public function action_add_woocommerce_support() {
		add_theme_support(
			'woocommerce',
			array(
				'thumbnail_image_width' => 150,
				'single_image_width'    => 300,
				'product_grid'          => array(
					'default_rows'    => 3,
					'min_rows'        => 2,
					'max_rows'        => 8,
					'default_columns' => 4,
					'min_columns'     => 2,
					'max_columns'     => 5,
				),
			)
		);
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Remove Sidebar on product page.
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

	}

	/**
	 * Load Woocommerce CSS and Javascript
	 */
	public function load_woo_styles() {
			wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/assets/css/woocommerce/woocommerce.min.css', array(), filemtime( get_template_directory() . '/assets/css/woocommerce/woocommerce.min.css' ), false );
	}

	/**
	 * Create woocommerce sidebar.
	 */
	public function wp_rig_woocommerce_sidebar() {
		register_sidebar(
			array(
				'name'          => __( 'Woocommerce Sidebar', 'wp-rig' ),
				'id'            => 'woocommerce-sidebar',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}

	/**
	 * Add woocommerce sidebar to archive page
	 */
	public function add_woocommerce_sidebar() {
		?>

		<aside id="woocommerce-sidebar" class="sidebar primary-sidebar">
			<?php if ( is_active_sidebar( 'woocommerce-sidebar' ) ) : ?>
				<?php dynamic_sidebar( 'woocommerce-sidebar' ); ?>
			<?php else : ?>
				<!-- Time to add some widgets! -->
			<?php endif; ?>
		</aside>

		<?php
	}

}

