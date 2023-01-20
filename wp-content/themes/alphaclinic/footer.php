<?php
/**
 * Footer Template
 *
 * The template for displaying the footer
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
?>

<?php responsive_mobile_wrapper_bottom(); // after wrapper content hook ?>
</div><!-- end of #wrapper -->
<?php responsive_mobile_wrapper_end(); // after wrapper hook ?>
</div><!-- end of #container -->
<?php responsive_mobile_container_bottom();?>


<footer id="footer" class="site-footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<?php responsive_mobile_footer_top(); ?>
	<div id="footer-wrapper">

		<div id="footer-widgets-container">
			<?php get_sidebar( 'footer' ); ?>
		</div><!-- #footer-widgets-container-->

		<div id="menu-social-container">
			<nav id="footer-menu-container">
				<?php if ( has_nav_menu( 'footer-menu', 'responsive-mobile' ) ) {
					wp_nav_menu(
						array(
							'container'      => '',
							'fallback_cb'    => false,
							'menu_class'     => 'footer-menu',
							'theme_location' => 'footer-menu',
							'depth'          => 1
						)
					);
				} ?>
			</nav><!-- #footer-menu -->
			<div id="social-icons-container">
				<?php echo responsive_mobile_get_social_icons() ?>
			</div><!-- #social-icons-container-->
		</div><!-- #menu-social-container -->

		<?php get_sidebar( 'colophon' ); ?>

	</div><!-- #footer-wrapper -->
	<?php responsive_mobile_footer_bottom(); ?>
</footer><!-- #footer -->
<?php responsive_mobile_footer_after(); ?>
<?php responsive_mobile_body_bottom(); ?>
<?php wp_footer(); ?>
</body>
</html>
