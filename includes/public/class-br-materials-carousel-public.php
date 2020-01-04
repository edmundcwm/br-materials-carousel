<?php
/**
 * Public-facing functionality
 *
 * Class for handling the public-facing functionality of the plugin.
 *
 * @package BR Materials Carousel
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * BR_Materials_Carousel_Public class
 */
class BR_Materials_Carousel_Public {

	/**
	 * Enqueue public facing scripts
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'slick-js', plugin_dir_url( dirname( __FILE__, 2 ) ) . '/assets/js/slick.min.js', array( 'jquery' ), '1.8.1', false );
		wp_enqueue_script( 'index-js', plugin_dir_url( dirname( __FILE__, 2 ) ) . '/assets/js/index.js', array( 'jquery', 'slick-js' ), '1.0.0', true );
	}

	/**
	 * Enqueue public facing styles
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'slick-css', plugin_dir_url( dirname( __FILE__, 2 ) ) . '/assets/css/slick-theme.css', array(), '1.8.1' );
		wp_enqueue_style( 'style-css', plugin_dir_url( dirname( __FILE__, 2 ) ) . '/assets/css/style.css', array(), '1.0.0' );
	}
}
