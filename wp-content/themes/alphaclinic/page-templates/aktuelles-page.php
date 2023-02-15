<?php
/**
 * Template Name: Aktuelles template
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

get_header(); ?>

<div id="content-full" class="content-area">
    <main id="main" class="site-main full-width" role="main">

        <?php if ( have_posts() ) : ?>

            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post();
                $header_img = image_details(CFS()->get( 'header_background_image' ));
                $header_icon = image_details(CFS()->get( 'header_icon' ));
                $header_logo_display = CFS()->get( 'header_logo_display');
                $header_title = CFS()->get( 'header_title' );
                ?>
                <div class="page-banner">
                    <div class="page-banner-inner">
                        <?php echo '<img src="' . $header_img['url'][0] . '" alt="' . $header_img['alt'] . '" />'; ?>
                        <div class="banner-inner-logo">
                            <?php if ($header_logo_display == 1 && $header_icon) {
                                    echo '<img src="'.$header_icon['url'][0].'" class="img-fluid"/>';
                            } ?>
                        </div>
                        <div class="container banner-text">
                            <?php
                            if ($header_title) {
                                echo '<h4>'.$header_title.'</h4>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <main>
                    <div class="aktuelles-main-section p-tb-90">
                        <div class="container">
                            <?php
                            $arguments = array(
                            'post_type' => 'post',
                            'posts_per_page' => 1,
                            'orderby' => 'DESC',
                            'tax_query' => array(
                                    array(
                                    'taxonomy' => 'category',
                                    'field' => 'slug',
                                    'terms' => 'aktuelles',
                                    )
                                )
                            );

                            $query = new WP_Query($arguments);
                            $html = '';
                            while ($query->have_posts()) : $query->the_post();
                            $aktuelles_title = get_the_title();
                            $aktuelles_content = get_the_content();
                            $date = strtotime(get_the_date('Y-m-d'));
                            $html .= '<div class="aktuelles-detials-title">
                                        <h3><span>'.date_i18n("l, d. F Y", $date).'</span>' . $aktuelles_title . '</h3>
                                        <p>' . $aktuelles_content . '</p>
                                      </div>';
                            endwhile;
                            wp_reset_postdata();
                            echo $html;
                            ?>
                            <div class="aktuelles-detials-box">
                                <div class="row">
                                    <?php
                                    $arguments = array(
                                    'post_type' => 'post',
                                    'posts_per_page' => 50,
                                    'orderby'        => 'date',
                                    'order'          => 'DESC',
                                    'offset'         => 1,
                                    'tax_query' => array(
                                            array(
                                            'taxonomy' => 'category',
                                            'field' => 'slug',
                                            'terms' => 'aktuelles',
                                            )
                                        )
                                    );

                                    $query = new WP_Query($arguments);
                                    while ($query->have_posts()) : $query->the_post();
                                        $date = strtotime(get_the_date('Y-m-d'));
                                        ?>
                                        <div class="col-md-4 news-sub-section" data-post-id="<?php echo get_the_ID(); ?>">
                                            <h3>
                                                <span><?php echo date_i18n("l, d. F Y", $date); ?></span><?php echo get_the_title(); ?>
                                            </h3>
                                            <p><?php echo get_the_content(); ?></p>
                                        </div>
                                    <?php
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

            <?php endwhile; ?>

        <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #content-full -->

<?php get_footer(); ?>
