<?php

/**
 * Main Function
 *
 * Load functions and classes
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
if (!defined('WPINC')) {
    die;
}

$template_directory = get_template_directory();

/**
 * Basic theme functionality
 */
require $template_directory . '/includes/functions.php';

/**
 * Theme Options
 */
require $template_directory . '/libraries/class-responsive-options.php';
require $template_directory . '/includes/functions-theme-options.php';
require $template_directory . '/includes/functions-theme-options-page.php';
require($template_directory . '/includes/customizer.php');
require($template_directory . '/includes/admin-about.php');

/**
 * Meta Box Options
 */
require $template_directory . '/libraries/class-meta-box.php';
require $template_directory . '/includes/functions-meta-box.php';

/**
 * Custom template tags for this theme.
 */
require $template_directory . '/includes/functions-template-tags.php';

/**
 * Support THA Theme hooks through Responsives own functions.
 */
require $template_directory . '/core/tha-theme-hooks.php';
//require $template_directory . '/core/functions-demodata.php';
require $template_directory . '/includes/responsive-hooks.php';

/**
 * Theme Upsell
 */
//require $template_directory . '/core/functions-theme-upsell.php';

/**
 * Create header items that hook into header.php
 */
require $template_directory . '/includes/functions-header.php';

/**
 * Implement the Custom Header feature.
 */
require $template_directory . '/includes/functions-custom-header.php';

/**
 * Custom functions that act independently to the theme templates.
 */
require $template_directory . '/includes/functions-extras.php';
require $template_directory . '/includes/functions-extentions.php';
require $template_directory . '/includes/functions-layout.php';
require $template_directory . '/includes/functions-front.php';

/**
 * Register Menus
 */
require $template_directory . '/includes/functions-menu.php';

/**
 * Register Sidebars
 */
require $template_directory . '/includes/functions-sidebar.php';

/**
 * Plugin compatibility
 */
require $template_directory . '/includes/functions-plugins.php';

/**
 * Theme Update
 */
require $template_directory . '/includes/functions-update.php';

/**
 * Plugin dependency
 */
require $template_directory . '/core/functions-install.php';

/**
 * Admin functionality
 */
require $template_directory . '/core/functions-admin.php';

if (!defined('ELEMENTOR_PARTNER_ID')) {
    define('ELEMENTOR_PARTNER_ID', 2126);
}

// enabling theme support for title tag
function responsivemobile_title_setup()
{
    add_theme_support('title-tag');

    // Add support for full and wide align images.
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'responsivemobile_title_setup');

function responsive_mobile_customize_register($wp_customize)
{

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    $wp_customize->selective_refresh->add_partial('blogname', array(
        'selector' => '.site-name a',
    ));

    $wp_customize->selective_refresh->add_partial('blogdescription', array(
        'selector' => '.site-description',
    ));


    $wp_customize->selective_refresh->add_partial('responsive_mobile_theme_options[copyright_textbox]', array(
        'selector' => '.copyright',
    ));

    $wp_customize->selective_refresh->add_partial('nav_menu_locations[top-menu]', array(
        'selector' => '.main-nav',
    ));

    $wp_customize->selective_refresh->add_partial('responsive_mobile_theme_options[home_headline]', array(
        'selector' => '.featured-title',
    ));

    $wp_customize->selective_refresh->add_partial('responsive_mobile_theme_options[home_subheadline]', array(
        'selector' => '.featured-subtitle',
    ));

    $wp_customize->selective_refresh->add_partial('responsive_mobile_theme_options[home_content_area]', array(
        'selector' => '.featured-text',
    ));

    $wp_customize->selective_refresh->add_partial('responsive_mobile_theme_options[cta_text]', array(
        'selector' => '#call-to-action',
    ));

    $wp_customize->selective_refresh->add_partial('responsive_mobile_theme_options[featured_content]', array(
        'selector' => '.featured-image',
    ));

    $wp_customize->selective_refresh->add_partial('responsive_mobile_theme_options[callout_headline]', array(
        'selector' => '.callout-title',
    ));

    $wp_customize->selective_refresh->add_partial('responsive_mobile_theme_options[callout_content_area]', array(
        'selector' => '.callout-text',
    ));

    $wp_customize->selective_refresh->add_partial('responsive_mobile_theme_options[callout_cta_text]', array(
        'selector' => '#callout-cta',
    ));
    $wp_customize->selective_refresh->add_partial('responsive_mobile_theme_options[poweredby_link]', array(
        'selector' => '.powered',
    ));

    $wp_customize->selective_refresh->add_partial('sidebars_widgets[home-widget-1]', array(
        'selector' => '#home_widget_1',
    ));

    $wp_customize->selective_refresh->add_partial('sidebars_widgets[home-widget-2]', array(
        'selector' => '#home_widget_2',
    ));

    $wp_customize->selective_refresh->add_partial('sidebars_widgets[home-widget-3]', array(
        'selector' => '#home_widget_3',
    ));

    $wp_customize->selective_refresh->add_partial('responsive_mobile_theme_options[team_title]', array(
        'selector' => '.section_title span',
    ));

    $wp_customize->selective_refresh->add_partial('responsive_mobile_theme_options[team_val]', array(
        'selector' => '.team_first_row',
    ));

    $wp_customize->selective_refresh->add_partial('responsive_mobile_theme_options[team]', array(
        'selector' => '#team_inner_div',
    ));
}

add_action('customize_register', 'responsive_mobile_customize_register');
add_theme_support('customize-selective-refresh-widgets');

include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (!is_plugin_active('cyberchimpsoptions/cc-pro-features.php'))
    add_action('customize_controls_print_footer_scripts', 'responsive_mobile_add_upgrade_button');

function responsive_mobile_add_upgrade_button()
{

    // Get the upgrade link.
    $upgrade_link = esc_url_raw('https://cyberchimps.com/store/pro-features/');
?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery('#customize-info .accordion-section-title').append('<a target="_blank" class="button btn-upgrade" href="<?php echo esc_url($upgrade_link); ?>"><?php esc_html_e('Upgrade To Pro', 'responsive-mobile'); ?></a>');
            jQuery('#customize-info .btn-upgrade').click(function(event) {
                event.stopPropagation();
            });
        });
    </script>
    <style>
        .wp-core-ui .btn-upgrade {
            color: #fff;
            background: none repeat scroll 0 0 #5BC0DE;
            border-color: #CCCCCC;
            box-shadow: 0 1px 0 #5BC0DE inset, 0 1px 0 rgba(0, 0, 0, 0.08);
            float: right;
            //margin-top: -23px;
            margin-top: 15px;
            font-size: 14px;
            height: 30px;
            margin-bottom: 15px;
        }

        .wp-core-ui .btn-upgrade:hover {
            color: #fff;
            background: none repeat scroll 0 0 #39B3D7;
            box-shadow: 0 1px 0 #39B3D7 inset, 0 1px 0 rgba(0, 0, 0, 0.08);
        }

        .wp-core-ui #customize-info .theme-name {
            word-break: break-all;
            padding-right: 120px;
        }

        .wp-full-overlay-sidebar-content #customize-info {
            background-color: #fff;
        }
    </style>
    <?php
}

add_action('admin_notices', 'responsive_mobile_rating_notice');
function responsive_mobile_rating_notice()
{
    $check_screen = get_admin_page_title();

    if ($check_screen == 'Theme Options') {
    ?>

        <div class="notice notice-success is-dismissible">
            <b>
                <p>Liked this theme? <a href="https://wordpress.org/support/theme/responsive-mobile/reviews/#new-post" target="_blank">Leave us</a> a ***** rating. Thank you! </p>
            </b>
        </div>
    <?php
    }
}


if (!function_exists('responsive_get_attachment_id_from_url')) :
    function responsive_get_attachment_id_from_url($attachment_url = '')
    {
        global $wpdb;
        $attachment_id = false;
        // If there is no url, return.
        if ('' == $attachment_url)
            return;
        // Get the upload directory paths
        $upload_dir_paths = wp_upload_dir();
        // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
        if (false !== strpos($attachment_url, $upload_dir_paths['baseurl'])) {
            // If this is the URL of an auto-generated thumbnail, get the URL of the original image
            $attachment_url = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url);
            // Remove the upload path base directory from the attachment URL
            $attachment_url = str_replace($upload_dir_paths['baseurl'] . '/', '', $attachment_url);
            // Finally, run a custom database query to get the attachment ID from the modified attachment URL
            $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url));
        }
        return $attachment_id;
    }
endif;
/* ================= Sticky Header Setting  ===========================  */

add_action('wp_footer', 'cyberchimps_fixed_menu_onscroll');
function cyberchimps_fixed_menu_onscroll()
{
    $responsive_options = responsive_mobile_get_options();
    if (isset($responsive_options['sticky_header']) && $responsive_options['sticky_header'] == '1') {


    ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 0) {
                        $('#header_section').addClass("sticky-header");

                    } else {
                        $('#header_section').removeClass("sticky-header");

                    }
                });
            });
        </script>
<?php
    }
}
if (!function_exists('responsive_exclude_post_cat')) :
    function responsive_exclude_post_cat($query)
    {
        $cat = get_theme_mod('responsive_mobile_exclude_post_cat');

        if ($cat && !is_admin() && $query->is_main_query()) {
            $cat = array_diff(array_unique($cat), array(''));
            if ($query->is_home() || $query->is_archive()) {
                $query->set('category__not_in', $cat);
                //$query->set( 'cat', '-5,-6,-65,-66' );
            }
        }
    }
endif;
add_filter('pre_get_posts', 'responsive_exclude_post_cat');
function responsive_custom_category_widget($arg)
{
    $cat = get_theme_mod('exclude_post_cat');

    if ($cat) {
        $cat = array_diff(array_unique($cat), array(''));
        $arg["exclude"] = $cat;
    }
    return $arg;
}
add_filter("widget_categories_args", "responsive_custom_category_widget");
add_filter("widget_categories_dropdown_args", "responsive_custom_category_widget");

function responsive_exclude_post_cat_recentpost_widget($array)
{
    $s = '';
    $i = 1;
    $cat = get_theme_mod('exclude_post_cat');

    if ($cat) {
        $cat = array_diff(array_unique($cat), array(''));
        foreach ($cat as $c) {
            $i++;
            $s .= '-' . $c;
            if (count($cat) >= $i)
                $s .= ', ';
        }
    }
    $array['cat'] = array($s);
    //$exclude = array( 'cat' => $s );

    return $array;
}
add_filter("widget_posts_args", "responsive_exclude_post_cat_recentpost_widget");

function responsive_pro_categorylist_validate()
{
    // An array of valid results
    $args = array(
        'type'         => 'post',
        'orderby'      => 'name',
        'order'        => 'ASC',
        'hide_empty'   => 1,
        'hierarchical' => 1,
        'taxonomy'     => 'category'
    );
    $option_categories = array();
    $category_lists = get_categories($args);
    $option_categories[''] = esc_html(__('Choose Category', 'responsive-mobile'));
    foreach ($category_lists as $category) {
        $option_categories[$category->term_id] = $category->name;
    }
    return $option_categories;
}
/**
 *  Enqueue block styles  in editor
 */
function responsive_mobile_block_styles()
{
    wp_enqueue_style('rm-gutenberg-blocks', get_stylesheet_directory_uri() . '/css/gutenberg-blocks.css', array(), '1.0');
}
add_action('enqueue_block_editor_assets', 'responsive_mobile_block_styles');

/**
 * Custom Changes
 */

// Include css and js
add_action('wp_enqueue_scripts', 'include_css_js');
function include_css_js()
{
    $template_directory_uri = get_template_directory_uri();
    wp_enqueue_style('bootstrap-css', $template_directory_uri . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('custom-css', $template_directory_uri . '/assets/css/custom.css', '', '180423');
    wp_enqueue_style('slick-css', $template_directory_uri . '/assets/css/slick.css');
    wp_enqueue_style('slick-theme-css', $template_directory_uri . '/assets/css/slick-theme.css');
    wp_enqueue_style('font-awesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');

    wp_enqueue_script('custom-js', $template_directory_uri . '/assets/js/custom.js', array('jquery'), '230223', true);
    wp_enqueue_script('bootstrap-js', $template_directory_uri . '/assets/js/bootstrap.bundle.min.js', array('jquery'), '', true);
    wp_enqueue_script('slick-js', $template_directory_uri . '/assets/js/slick.min.js', array('jquery'), '', true);
}

function image_details($thumb_id)
{
    $image_data = [];
    $image_data['alt'] = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
    $image_data['url'] = wp_get_attachment_image_src($thumb_id, 'full');

    return $image_data;
}

add_shortcode('home-team-shortcode', 'home_team_shortcode');
function home_team_shortcode()
{
    $arguments = array(
        'post_type' => 'post',
        'posts_per_page' => 1,
        'orderby' => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => 'team',
            )
        )
    );

    $query = new WP_Query($arguments);
    $html = "";
    while ($query->have_posts()) : $query->the_post();
        $thumbnail_id = get_post_thumbnail_id(get_the_ID());
        $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        $thumb = get_the_post_thumbnail_url(get_the_ID());
        $team_title = get_the_title();
        $team_content = get_the_content();
        $trimmed_content = wp_trim_words($team_content, 50, '');
        $description = CFS()->get( 'description' );
        $team_link = get_the_permalink();
        if ($description == "Arztsekretärin") {
            $link = home_url().'/team/';
        } else {
            $link = $team_link;
        }
        $html .= '<div class="team-box-img">
                <a href="' . $link . '">
                  <img src="' . $thumb . '" alt="' . $alt . '" />
                  <img src="' . get_template_directory_uri() . '/images/arrow.svg" class="team-box-img-arrow"/>
                </a>
              </div>
              <a href="' . $link . '"><h3>' . $team_title . '</h3></a>
              <p>' . $description . '</p>';
    endwhile;
    wp_reset_postdata();
    return $html;
}

add_shortcode('home-treatment-shortcode', 'home_treatment_shortcode');
function home_treatment_shortcode()
{
    $arguments = array(
        'post_type' => 'post',
        'posts_per_page' => 1,
        'orderby' => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => 'was-wir-behandeln',
            )
        )
    );

    $query = new WP_Query($arguments);
    $html = "";
    while ($query->have_posts()) : $query->the_post();
        $thumb = get_template_directory_uri() . '/images/was-wir-behandeln-home.webp';
        $treatment_title = get_the_title();
        $slug = basename(get_permalink(get_the_ID()));
        $treatment_content = get_the_content();
        $trimmed_content = wp_trim_words($treatment_content, 50, '');
        $treatment_link = get_the_permalink();
        if ($treatment_title == 'Schulter') {
            $style = "top: 20%; left: 48%";
        } elseif ($treatment_title == 'Ellbogen') {
            $style = "top: 27%; left: 60%";
        } elseif ($treatment_title == 'Wirbelsäule') {
            $style = "top: 35.2%; left: 50.8%";
        } elseif ($treatment_title == 'Hüfte') {
            $style = "top: 48.2%; left: 48.2%";
        } elseif ($treatment_title == 'Knie') {
            $style = "top: 59%; left: 27.5%";
        } elseif ($treatment_title == 'Fuss') {
            $style = "top: 82%; left: 16.5%";
        }
        $html .= '<div class="team-box-img">
                    <a href="' . $treatment_link . '">
                        <img src="' . $thumb . '" />
                        <div class="main-hotspot-part '.$slug.'-joint"
                           style="' . $style . '">
                            <div class="lg-hotspot__button">
                                <div class="lg-hotspot__button-text">
                                </div>
                            </div>
                        </div>
                        <img src="' . get_template_directory_uri() . '/images/arrow.svg" class="team-box-img-arrow"/>
                    </a>
                  </div>
                  <a href="' . $treatment_link . '"><h3>' . $treatment_title . '</h3></a>
                  <p>' . $trimmed_content . '</p>';
    endwhile;
    wp_reset_postdata();
    return $html;
}

add_shortcode('home-aktuelles-shortcode', 'home_aktuelles_shortcode');
function home_aktuelles_shortcode()
{
    $arguments = array(
        'post_type' => 'post',
        'posts_per_page' => 1,
        'orderby' => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => 'aktuelles',
            )
        )
    );

    $query = new WP_Query($arguments);
    $html = "";
    while ($query->have_posts()) : $query->the_post();
        $thumbnail_id = get_post_thumbnail_id(get_the_ID());
        $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        $thumb = get_the_post_thumbnail_url(get_the_ID());
        $aktuelles_title = get_the_title();
        $aktuelles_content = get_the_content();
        $trimmed_content = wp_trim_words($aktuelles_content, 50, '');
        $aktuelles_link = home_url() . '/aktuelles?pid='.get_the_ID();
        $html .= '<div class="team-box-img">
                <a href="' . $aktuelles_link . '">
                  <img src="' . $thumb . '" alt="' . $alt . '" />
                  <img src="' . get_template_directory_uri() . '/images/arrow.svg" class="team-box-img-arrow"/>
                </a>
              </div>
              <a href="' . $aktuelles_link . '"><h3>' . $aktuelles_title . '</h3></a>
              <p>' . $trimmed_content . '</p>';
    endwhile;
    wp_reset_postdata();
    return $html;
}

// Enable logo field in customise settings.
add_theme_support('custom-logo');
add_theme_support('block-templates');

add_shortcode('team-shortcode', 'team_shortcode');
function team_shortcode()
{
    $counter_team_member = CFS()->get('counter_team_member');
    if ($counter_team_member) {
        $count = $counter_team_member;
    } else {
        $count = -1;
    }
    $arguments = array(
        'post_type' => 'post',
        'posts_per_page' => $count,
        'orderby'   => 'menu_order',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => 'team',
            )
        )
    );

    $query = new WP_Query($arguments);
    $teams = [];
    $html = "";
    $numOfCols = 3;
    $rowCount = 0;
    while ($query->have_posts()) : $query->the_post();
        $thumbnail_id = get_post_thumbnail_id(get_the_ID());
        $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        $thumb = get_the_post_thumbnail_url(get_the_ID());
        $team_title = get_the_title();
        $team_content = get_the_content();
        $trimmed_content = wp_trim_words($team_content, 12, '');
        $description = CFS()->get( 'description' );
        $team_link = get_the_permalink();
        $teams[] = [
            'team_title' => $team_title,
            'team_content' => $description,
            'team_link' => $team_link,
            'thumb' => $thumb,
            'alt' => $alt,
        ];
    endwhile;
    wp_reset_postdata();

    $html .= '<div class="team-section">';
    foreach ($teams as $team) {
        if ($rowCount % $numOfCols == 0) {
            $html .= '<div class="grid-container">';
            $i = 1;
        }
        $rowCount++;
        if ($team['team_content'] == "Arztsekretärin") {
            $link = 'javascript:void(0)';
        } else {
            $link = $team['team_link'];
        }
        $html .= '<div class="box-img' . $i . ' box-img">
                      <a href="' . $link . '">
                          <img src="' . $team['thumb'] . '" alt="' . $team['alt'] . '">
                          <img src="'.get_template_directory_uri().'/images/arrow.svg" class="team-box-img-arrow"/>
                      </a>
                  </div>
                  <div class="box-content' . $i . ' box-content">
                    <a href="' . $link . '">
                        <h3>' . $team['team_title'] . '</h3>
                        <p>' . $team['team_content'] . '</p>
                    </a>
                  </div>
                        ';
        if ($rowCount % $numOfCols == 0) {
            $html .= '</div>';
        }
        $i++;
    }
    $html .= '</div>';

    return $html;
}

register_sidebar(
    array(
        'name' => 'Last header menu item',
        'id' => 'last-menu-item-widget',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    )
);

add_action('wp_ajax_load_first_news', 'ajax_load_first_news');
add_action('wp_ajax_nopriv_load_first_news', 'ajax_load_first_news');
function ajax_load_first_news() {
    $newsID = $_POST['newsID'];
    $aktuelles_title = get_the_title($newsID);
    $aktuelles_content = get_the_content(null, false, $newsID);
    $date = strtotime(get_the_date('Y-m-d', $newsID));
    $html = '<div class="aktuelles-detials-title">
                 <h3><span>'.date_i18n("l, d. F Y", $date).'</span>' . $aktuelles_title . '</h3>
                 <p>' . $aktuelles_content . '</p>
            </div>';
    echo json_encode(array('success' => true, 'html' => $html)); die;
}

add_action('wp_ajax_load_other_news', 'ajax_load_other_news');
add_action('wp_ajax_nopriv_load_other_news', 'ajax_load_other_news');
function ajax_load_other_news() {
    $newsID = $_POST['newsID'];
    $arguments = array(
        'post_type' => 'post',
        'posts_per_page' => 50,
        'orderby' => 'DESC',
        'post__not_in'  => array($newsID),
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => 'aktuelles',
            )
        )
    );

    $query = new WP_Query($arguments);
    $html = '<div class="row">';
    while ($query->have_posts()) : $query->the_post();
        $date = strtotime(get_the_date('Y-m-d'));
        $html .= '<div class="col-md-4 news-sub-section" data-post-id="'.get_the_ID().'">
                       <h3><span>'.date_i18n("l, d. F Y", $date).'</span>'.get_the_title().'</h3>
                       <p>'.get_the_content().'</p>
                  </div>';
    endwhile;
    wp_reset_postdata();
    $html .='</div>';
    echo json_encode(array('success' => true, 'html' => $html)); die;
}

/**
 * backend login page css
 */
add_action( 'login_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
    wp_enqueue_style( 'admin_css', get_template_directory_uri(). '/assets/admin/admin-backend-style.css', false, '' );
}

/**
 * admin side logo site url
 */
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

//Remove unneccessary css/js
function remove_front_css_js(){
    if (!is_admin()) {
        if (is_front_page()) {
            wp_dequeue_style('contact-form-7');
            wp_dequeue_script('contact-form-7');
        }
    }
}
add_action('wp_enqueue_scripts', 'remove_front_css_js', 9999);

// Remove All Yoast HTML Comments
add_filter( 'wpseo_debug_markers', '__return_false' );

/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
//    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

function remove_unused_css_js()
{
    if (!is_admin()) {
        wp_dequeue_style('classic-theme-styles');
        if (is_page('philosophie') || is_page('was-wir-behandeln') || is_page('team') || is_page('online-termin') || is_page('impressum') || is_page('aktuelles')) {
            wp_dequeue_script('contact-form-7');
            wp_dequeue_script('wpcf7-recaptcha');
            wp_dequeue_script('google-recaptcha');
            wp_dequeue_style('contact-form-7');
        }
    }
}
add_action('wp_enqueue_scripts', 'remove_unused_css_js', 9999);

//add_action( 'pre_get_posts', 'wpsites_remove_posts_from_team_page' );
//function wpsites_remove_posts_from_team_page( $query ) {
//
//    if( $query->is_main_query()) {
//        $query->set( 'post__not_in', array( 283,106,108 ) );
//    }
//}