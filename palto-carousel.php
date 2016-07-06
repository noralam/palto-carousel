<?php
/*
 * @link              http://digitalkroy.com/palto-carousel
 * @since             1.0.0
 * @package           Palto Carousel
 *
 * @wordpress-plugin
 * Plugin Name:       Palto Carousel
 * Plugin URI:        http://digitalkroy.com/palto-carousel
 * Description:       A simple carousel plugin.You can create lots of carousel by this plugin.
 * Version:           1.0.0
 * Author:            expert-wp
 * Author URI:        http://codecanyon.net/user/Noor-alam
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       palto
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'PCAROUSEL__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
 if ( is_admin() ) {
     // We are in admin mode
require_once( PCAROUSEL__PLUGIN_DIR .'admin/pcarousel-post-type.php' );
require_once( PCAROUSEL__PLUGIN_DIR .'admin/src/pcarousel-meta.php' );
require_once( PCAROUSEL__PLUGIN_DIR .'admin/add-button-tinymce.php' );
require_once ( PCAROUSEL__PLUGIN_DIR .'admin/src/CMB2/cmb2-conditionals.php' );
require_once ( PCAROUSEL__PLUGIN_DIR .'admin/src/cmb-field-select2/cmb-field-select2.php' );
require_once ( PCAROUSEL__PLUGIN_DIR .'admin/src/cmb2-field-slider/cmb2_field_slider.php' );

}
require_once( PCAROUSEL__PLUGIN_DIR .'includes/pcarousel-shortcode.php' );
require_once( PCAROUSEL__PLUGIN_DIR .'includes/pcarousel-options-set.php' );

	/**
	 * Load the plugin all style and script.
	 *
	 * @since    1.0.0
	 */

 if ( ! function_exists( 'palto_carousel_style_script' ) ) :
function palto_carousel_style_script() {
wp_enqueue_style( 'pcarousel-slick', plugins_url( '/assets/css/slick.css', __FILE__ ), array(), '1.0', 'all');
wp_enqueue_style( 'pcarousel-fontello', plugins_url( '/assets/css/fontello.css', __FILE__ ), array(), '1.0', 'all');
wp_enqueue_style( 'pcarousel-slick-theme', plugins_url( '/assets/css/slick-theme.css', __FILE__ ), array(), '1.0', 'all');
wp_enqueue_style( 'pcarousel-nivo-lightbox', plugins_url( '/assets/css/nivo-lightbox.css', __FILE__ ), array(), '1.0', 'all');
wp_enqueue_style( 'pcarousel-nivo-theme', plugins_url( '/assets/css/themes/default.css', __FILE__ ), array(), '1.0', 'all');
wp_enqueue_style( 'pcarousel-hover-min', plugins_url( '/assets/css/hover-min.css', __FILE__ ), array(), '1.0', 'all');

wp_enqueue_script('jquery');
wp_enqueue_script( 'pcarousel-simple-lightbox.min', plugins_url( '/assets/js/nivo-lightbox.min.js', __FILE__ ), array( 'jquery' ), '1.0', true);
wp_enqueue_script( 'pcarousel-slick.min', plugins_url( '/assets/js/slick.min.js', __FILE__ ), array( 'jquery' ), '1.0', true);
}
add_action( 'wp_enqueue_scripts', 'palto_carousel_style_script' );
endif;

	/**
	 * Load admin all style and script.
	 *
	 * @since    1.0.0
	 */

 if ( ! function_exists( 'palto_carousel_admin_style_script' ) ) :
function palto_carousel_admin_style_script() {
	global $pagenow;

    if(!in_array($pagenow, array('post-new.php', 'post.php'))) {
    	return;
    }
wp_enqueue_style( 'pcarousel-jquery-labelauty', plugins_url( '/assets/css/jquery-labelauty.css', __FILE__ ), array(), '1.0', 'all');
wp_enqueue_style( 'pcarousel--admin-fontello', plugins_url( '/assets/css/fontello.css', __FILE__ ), array(), '1.0', 'all');
wp_enqueue_style( 'pcarousel-admin', plugins_url( '/assets/css/palto-admin.css', __FILE__ ), array(), '1.0', 'all');


wp_enqueue_script( 'pcarousel-labelauty', plugins_url( '/assets/js/jquery-labelauty.js', __FILE__ ), array( 'jquery' ), '1.0', true);
wp_enqueue_script( 'pcarousel-admin', plugins_url( '/assets/js/admin.js', __FILE__ ), array( 'jquery' ), '1.0', true);
}
add_action( 'admin_enqueue_scripts', 'palto_carousel_admin_style_script' );
endif;

/**
 * palto carousel activation hook.
 *
 */ 
 if ( ! function_exists( 'palto_carousel_activation_setup' ) ) :
function palto_carousel_activation_setup() {
    // Trigger our function that registers the custom post type
    palto_carousel_post_type();
 
    // Clear the permalinks after the post type has been registered
    flush_rewrite_rules();
    // Add new administrator role
	palto_carousel_admin_role();
}
register_activation_hook( __FILE__, 'palto_carousel_activation_setup' ); 
endif; 
/**
 * palto carousel deactivation hook.
 *
 */ 
 if ( ! function_exists( 'palto_carousel_deactivation_setup' ) ) :
function palto_carousel_deactivation_setup() {
 
    // Clear the permalinks to remove our post type's rules
    flush_rewrite_rules();
	
	// gets the administrator role remove
	palto_carousel_admin_role_remove();
 
}
register_deactivation_hook( __FILE__, 'palto_carousel_deactivation_setup' );
endif;

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
if ( ! function_exists( 'palto_carousel_textdomain' ) ) :
	function palto_carousel_textdomain() {

		load_plugin_textdomain(
			'palto',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages'
		);

	}
add_action( 'plugins_loaded', 'palto_carousel_textdomain' );
endif;

//new image size added
add_image_size( 'xmedium', 450, 450, true );