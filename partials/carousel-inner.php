<div class="image-carousel__inner">

	<div class="image-carousel__image" style="background-image: url('<?php the_sub_field( 'material_carousel_image' ); ?>')" ></div>

	<div class="image-carousel__info">

		<!-- TITLE -->

		<h3 class="image-carousel__title"><?php the_sub_field( 'material_carousel_title' ); ?></h3>

		<!-- DESCRIPTION -->

		<p class="image-carousel__description"><?php the_sub_field( 'material_carousel_description' ); ?></p>

		<!--LINK -->

		<a href="<?php the_sub_field( 'material_carousel_link' ); ?>" class="image-carousel__link" target="_blank"><?php esc_html_e( 'READ MORE', 'brm' ); ?><i class="fa fa-arrow-right" aria-hidden="true"></i></a>

	</div>

</div>
