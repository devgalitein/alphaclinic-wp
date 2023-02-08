<?php
/**
 * Header
 *
 * Displays all information in head, starts the body tag, contains theme header
 * and nav and starts the main content wrapper
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
<!DOCTYPE html>
<!--[if IE 8 ]>
	<html class="no-js ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9 ]>
	<html class="no-js ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if gt IE 9]><!-->
<html <?php language_attributes(); ?>><!--<![endif]-->
	<head>
		<?php responsive_mobile_head_top(); ?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" /> 

		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php responsive_mobile_head_bottom(); ?>

		<?php wp_head(); ?>
	</head>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<?php responsive_mobile_body_top(); ?>
<div id="container" class="site">
	<!-- <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'responsive-mobile' ); ?></a>
	<a class="skip-link screen-reader-text" href="#main-navigation"><?php _e( 'Skip to main menu', 'responsive-mobile' ); ?></a> -->
    <!-- menu dropdown start - for mobile-->
    <div class="mobile-menu-container">
        <div class="menu-dropdown" style="background-color: #fff;">
            <div class="menu-dropdown__inner" data-value="start">
                <div class="screen screen--start">
                    <div class="close-mobile-menu"  aria-label="Close">
                        <span aria-hidden="true"></span>
                    </div>
                    <?php wp_nav_menu(
                        array(
                            'container'      => 'ul',
                            'fallback_cb'    => false,
                            'menu_class'     => 'main-menu',
                            'list_item_class'  => 'main-menu__item',
                            'link_class'   => 'main-menu__link',
                            'theme_location' => 'header-menu',
                            'depth'          => 2
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>

    <?php responsive_mobile_header_before(); ?>
    <div id="header_section">
        <div id="main-menu">
            <header>
                <div class="top-header">
                    <div class="custom-container-1352">
                        <?php if ( is_active_sidebar( 'top-header-widget' ) ) :?>
                            <?php dynamic_sidebar( 'top-header-widget' ); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="custom-container-1352">
                    <div class="second-header">
                        <div class="logo-part">
                            <?php
                            if ( function_exists( 'the_custom_logo' ) ) {
                            the_custom_logo();
                            }
                            ?>
                        </div>
                        <?php if ( is_active_sidebar( 'last-menu-item-widget' ) ) :?>
                            <div class="mobile-last-menu">
                                <?php dynamic_sidebar( 'last-menu-item-widget' ); ?>
                            </div>
                        <?php endif; ?>
                        <!-- menu-trigger start-->
                        <div class="hamburger">
                            <div class="hamburger-box">
                                <!--                            <div class="hamburger-inner"></div>-->
                                <img class="menu-open" src="<?php echo get_theme_file_uri().'/images/hamburger.svg'?>">
                                <i class="fa fa-times menu-close" aria-hidden="true"></i>
                            </div>
                        </div>
                        <!-- menu-trigger end-->

                        <div class="desktop-main-menu">
                            <div class="header-menu-part">
                                <!-- main menu start-->
                                <?php wp_nav_menu(
                                    array(
                                        'container'      => 'ul',
                                        'fallback_cb'    => false,
                                        'menu_class'     => 'main-menu',
                                        'list_item_class'  => 'main-menu__item',
                                        'link_class'   => 'main-menu__link',
                                        'theme_location' => 'header-menu',
                                        'depth'          => 2
                                    )
                                ); ?>
                                <!-- main menu end-->
                                <?php if ( is_active_sidebar( 'last-menu-item-widget' ) ) :?>
                                    <?php dynamic_sidebar( 'last-menu-item-widget' ); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div>
		<?php responsive_mobile_header_bottom(); ?>
	</header><!-- #header -->
    </div>
<?php responsive_mobile_header_end(); ?>


<?php responsive_mobile_wrapper(); // before wrapper container hook ?>
	<div id="wrapper" class="site-content container-full-width">
<?php responsive_mobile_wrapper_top(); // before wrapper content hook ?>
<?php responsive_mobile_in_wrapper(); // wrapper hook ?>
