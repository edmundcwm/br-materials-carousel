<?php
/**
 * Core plugin class
 *
 * Class for defining public-facing hooks and shortcodes
 *
 * @package BR Materials Carousel
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * BR_Materials_Carousel class
 */
class BR_Materials_Carousel {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string  The string used to uniquely identify this plugin.
	 */
	private $plugin_name;

	/**
	 * Collection of Action hooks
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array The collection of action hooks
	 */
	private $actions;

	/**
	 * Collection of Shortcodes
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array The collection of shortcodes
	 */
	private $shortcodes;

	/**
	 * Constructor method
	 *
	 * @since 1.0.0
	 * @access public
	 * @param string $plugin_name The string used to uniquely identify this plugin.
	 */
	public function __construct( $plugin_name ) {
		$this->plugin_name = $plugin_name;
	}

	/**
	 * Initiate plugin
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function run() {
		$this->load_classes();
		$dependencies = new BR_Materials_Carousel_Dependencies( $this->plugin_name );
		if ( $dependencies->check() ) {
			// run core plugin functions after clearing dependencies check.
			$plugin_public      = new BR_Materials_Carousel_Public();
			$plugin_shortcodes  = new BR_Materials_Carousel_Shortcodes();
			$this->actions[]    = $this->add_hook_to_collection( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
			$this->actions[]    = $this->add_hook_to_collection( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
			$this->shortcodes[] = $this->add_shortcode_to_collection( 'br_materials_carousel', $plugin_shortcodes, 'br_materials_carousel' );
			$this->register_hooks();
			$this->register_shortcodes();
		}
	}

	/**
	 * Load necessary classes
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function load_classes() {
		require plugin_dir_path( __FILE__ ) . 'class-br-materials-carousel-dependencies.php';
		require plugin_dir_path( __FILE__ ) . '/public/class-br-materials-carousel-public.php';
		require plugin_dir_path( __FILE__ ) . '/public/class-br-materials-carousel-shortcodes.php';
	}

	/**
	 * Add all hooks that are to be registered to a collection
	 *
	 * @since 1.0.0
	 * @access private
	 * @param string $wp_hook Name of the WP Hook.
	 * @param object $component Instance of the class.
	 * @param string $callback Name of the Callback function.
	 * @param int    $priority Callback priority.
	 * @param int    $args Number of Callback arguments.
	 */
	private function add_hook_to_collection( $wp_hook, $component, $callback, $priority = 10, $args = 1 ) {
		return array(
			'hook'      => $wp_hook,
			'component' => $component,
			'callback'  => $callback,
			'priority'  => $priority,
			'args'      => $args,
		);
	}

	/**
	 * Add all shortcodes that are to be registered to a collection
	 *
	 * @since 1.0.0
	 * @access private
	 * @param string $tag Shortcode tag.
	 * @param object $component Instance of the class containing the Shortcode Callback.
	 * @param string $callback Name of the Callback function.
	 */
	private function add_shortcode_to_collection( $tag, $component, $callback ) {
		return array(
			'tag'       => $tag,
			'component' => $component,
			'callback'  => $callback,
		);
	}

	/**
	 * Register all hooks
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function register_hooks() {
		foreach ( $this->actions as $params ) {
			add_action( $params['hook'], array( $params['component'], $params['callback'] ), $params['priority'], $params['args'] );
		}
	}

	/**
	 * Register all shortcodes
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function register_shortcodes() {
		foreach ( $this->shortcodes as $shortcode ) {
			add_shortcode( $shortcode['tag'], array( $shortcode['component'], $shortcode['callback'] ) );
		}
	}
}
