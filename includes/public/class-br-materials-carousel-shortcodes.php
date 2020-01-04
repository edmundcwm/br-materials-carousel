<?php
/**
 * Shortcode callback handler
 *
 * Class for handling shortcodes callback.
 *
 * @package BR Materials Carousel
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * BR_Materials_Carousel_Shortcodes class
 */
class BR_Materials_Carousel_Shortcodes {

	/**
	 * Callback for [br_materials_carousel]
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function br_materials_carousel() {

		if ( have_rows( 'material_carousel' ) ) {

			ob_start();

			?>

			<div class="image-carousel">

			<!-- start loop -->

			<?php

			while ( have_rows( 'material_carousel' ) ) :

				the_row();

				?>

				<?php include plugin_dir_path( dirname( __FILE__, 2 ) ) . 'partials/carousel-inner.php'; ?>

			<?php endwhile; ?>

			<!-- end loop -->

			</div>

			<?php

			wp_reset_postdata();

			$content = ob_get_clean();

			return $content;

		} else {

			?>

			<p><?php esc_html_e( 'No materials found', 'brm' ); ?></p>

			<?php
		}

	}

}
