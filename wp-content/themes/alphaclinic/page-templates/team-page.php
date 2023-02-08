<?php
/**
 * Template Name: Team template
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
                $header_title = CFS()->get( 'header_title' );
                ?>
                <div class="page-banner">
                    <div class="page-banner-inner">
                        <?php echo '<img src="' . $header_img['url'][0] . '" alt="' . $header_img['alt'] . '" class="img-fluid"/>'; ?>
                        <div class="container banner-text">
                            <?php
                            if ($header_title) {
                                echo '<h4>'.$header_title.'</h4>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <?php get_template_part( 'template-parts/content', 'page' ); ?>
                </div>
            <?php endwhile; ?>

        <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #content-full -->

<?php get_footer(); ?>
