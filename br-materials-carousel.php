<?php
/**
 * Plugin Name: BR Materials Carousel
 * Plugin URI: https://www.nerb.com.sg
 * Description: A carousel for showcasing types of scrap materials
 * Version: 1.0.0
 * Author: Edmundcwm
 * Author URI: https://www.edmundcwm.com
 * License: GPL2 or later
 * Text Domain: brm
 *
 * @package BR_Materials_Carousel
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

require plugin_dir_path( __FILE__ ) . 'includes/class-br-materials-carousel.php';
$brm_plugin = new BR_Materials_Carousel( 'BR Materials Carousel' );
$brm_plugin->run();
