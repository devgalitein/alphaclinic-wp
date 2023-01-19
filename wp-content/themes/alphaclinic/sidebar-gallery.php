<?php
/**
 * Gallery Sidebar
 *
 * Displays on the image page after clicking on a gallery image
 *
 * @package      responsive_mobile
 * @license      license.txt
 * @copyright    2014 CyberChimps Inc
 * @since        0.0.1
 *
 * Please do not edit this file. This file is part of the responsive_mobile Framework and all modifications
 * should be made in a child theme.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

responsive_mobile_widgets_before(); // above widgets container hook
?>

	<div id="widgets" class="widget-area gallery-sidebar" role="complementary" itemscope="itemscope"
	     itemtype="http://schema.org/WPSideBar">
		<?php responsive_mobile_widgets(); // above widgets hook ?>
		<aside class="widget-wrapper">

			<h3 class="widget-title"><?php _e( 'Image Information', 'responsive-mobile' ); ?></h3>
			<ul>
				<?php $responsive_mobile_data = get_post_meta( $post->ID, '_wp_attachment_metadata', true ); ?>
				<?php if ( is_array( $responsive_mobile_data ) ) : ?>
					<span class="full-size"><?php _e( 'Full Size:', 'responsive-mobile' ); ?> <a href="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>"><?php echo absint( $responsive_mobile_data['width'] ) . '&#215;' . absint( $responsive_mobile_data['height'] ); ?></a>px</span>

					<?php if ( is_array( $responsive_mobile_data['image_meta'] ) ) : ?>
						<?php if ( $responsive_mobile_data['image_meta']['aperture'] ) : ?>
							<span class="aperture"><?php _e( 'Aperture: f&#47;', 'responsive-mobile' ); ?><?php echo esc_html( $responsive_mobile_data['image_meta']['aperture'] ); ?></span>
						<?php endif; ?>

						<?php if ( $responsive_mobile_data['image_meta']['focal_length'] ) : ?>
							<span
								class="focal-length"><?php _e( 'Focal Length:', 'responsive-mobile' ); ?> <?php echo esc_html( $responsive_mobile_data['image_meta']['focal_length'] ); ?><?php _e( 'mm', 'responsive-mobile' ); ?></span>
						<?php endif; ?>

						<?php if ( $responsive_mobile_data['image_meta']['iso'] ) : ?>
							<span class="iso"><?php _e( 'ISO:', 'responsive-mobile' ); ?> <?php echo esc_html( $responsive_mobile_data['image_meta']['iso'] ); ?></span>
						<?php endif; ?>

						<?php if ( $responsive_mobile_data['image_meta']['shutter_speed'] ) : ?>
							<span class="shutter"><?php _e( 'Shutter:', 'responsive-mobile' ); ?>
								<?php if ( ( 1 / $responsive_mobile_data['image_meta']['shutter_speed'] ) > 1 ) {
									echo "1/";
									if ( number_format( ( 1 / $responsive_mobile_data['image_meta']['shutter_speed'] ), 1 ) == number_format( ( 1 / $responsive_mobile_data['image_meta']['shutter_speed'] ), 0 ) ) {
										echo number_format( ( 1 / $responsive_mobile_data['image_meta']['shutter_speed'] ), 0, '.', '' ) . ' sec';
									} else {
										echo number_format( ( 1 / $responsive_mobile_data['image_meta']['shutter_speed'] ), 1, '.', '' ) . ' sec';
									}
								} else {
									echo esc_html( $responsive_mobile_data['image_meta']['shutter_speed'] ) . ' sec';
								} ?>
							</span>
						<?php endif; ?>

						<?php if ( $responsive_mobile_data['image_meta']['camera'] ) : ?>
							<span class="camera"><?php _e( 'Camera:', 'responsive-mobile' ); ?> <?php echo esc_html( $responsive_mobile_data['image_meta']['camera'] ); ?></span>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			</ul>

		</aside>
		<!-- .widget-wrapper -->
	</div>
	<!-- #widgets -->

<?php if ( ! is_active_sidebar( 'gallery-widget' ) ) {
	return;
} ?>

<?php if ( is_active_sidebar( 'gallery-widget' ) ) : ?>

	<div id="widgets" class="widget-area" role="complementary">

		<?php responsive_mobile_widgets(); // above widgets hook ?>

		<?php dynamic_sidebar( 'gallery-widget' ); ?>

		<?php responsive_mobile_widgets_end(); // after widgets hook ?>
	</div>
	<!-- end of #widgets -->
	<?php responsive_mobile_widgets_after(); // after widgets container hook ?>

<?php endif; ?>