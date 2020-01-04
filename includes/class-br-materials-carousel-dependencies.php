<?php
/**
 * Plugin dependency check functionality
 *
 * Class for checking dependencies that are required for this plugin to run properly.
 *
 * @package BR Materials Carousel
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * BR_Materials_Carousel_Dependencies class
 */
class BR_Materials_Carousel_Dependencies {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string The string used to uniquely identify this plugin.
	 */
	private $plugin_name;

	/**
	 * List of dependencies
	 *
	 * @since 1.0.0
	 * @var array Array of dependencies
	 */
	const REQUIRED_PLUGINS = array(
		'Advanced Custom Fields' => 'advanced-custom-fields-pro/acf.php',
	);

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
	 * Method to check if dependencies are present
	 *
	 * @since 1.0.0
	 * @access public
	 * @return boolean True if all dependencies are present. False if at least one is missing.
	 */
	public function check() {
		$missing_plugins = $this->get_missing_plugins_list();

		if ( ! empty( $missing_plugins ) ) {
			$plugins_title = implode( ', ', $missing_plugins );
			add_action( 'admin_notices', $this->display_notice( $plugins_title ) );
			return false;
		}
		return true;
	}

	/**
	 * Method to display admin notice message
	 *
	 * @since 1.0.0
	 * @access private
	 * @param string $plugins_title Title of missing plugins.
	 */
	private function display_notice( $plugins_title ) {
		?>
		<div class="notice error my-acf-notice is-dismissible" >
			<p>
				<?php
				echo wp_kses(
					__( '<strong>' . $this->plugin_name . '</strong> requires the following plugins to be activated: <strong>' . $plugins_title . '</strong>', 'brm' ),
					array( 'strong' => array() )
				);
				?>
			</p>
		</div>
		<?php
	}

	/**
	 * Method to retrieve list of missing plugins
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function get_missing_plugins_list() {
		$missing_plugins = array();
		foreach ( self::REQUIRED_PLUGINS as $plugin => $plugin_path ) {
			if ( ! $this->check_is_active( $plugin_path ) ) {
				$missing_plugins[] = $plugin;
			}
		}

		return $missing_plugins;
	}

	/**
	 * Method to retrieve list of active plugins
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function get_active_plugins() {
		return get_option( 'active_plugins' );
	}

	/**
	 * Method to check active status of plugin
	 *
	 * @since 1.0.0
	 * @access private
	 * @param string $plugin_path Path of plugin.
	 */
	private function check_is_active( $plugin_path ) {
		return in_array( $plugin_path, $this->get_active_plugins(), true );
	}
}
