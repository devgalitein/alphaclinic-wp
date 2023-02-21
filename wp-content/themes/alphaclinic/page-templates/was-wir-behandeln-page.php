<?php
/**
 * Template Name: Was wir behandeln template
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
                $header_img = image_details(CFS()->get( 'header_image' ));
                $joint_title_1 = CFS()->get( 'joint_title_1' );
                $joint_description_1 = CFS()->get( 'joint_description_1' );
                $joint_title_2 = CFS()->get( 'joint_title_2' );
                $joint_description_2 = CFS()->get( 'joint_description_2' );
                $joint_title_3 = CFS()->get( 'joint_title_3' );
                $joint_description_3 = CFS()->get( 'joint_description_3' );
                $joint_title_4 = CFS()->get( 'joint_title_4' );
                $joint_description_4 = CFS()->get( 'joint_description_4' );
                $joint_title_5 = CFS()->get( 'joint_title_5' );
                $joint_description_5 = CFS()->get( 'joint_description_5' );
                $joint_title_6 = CFS()->get( 'joint_title_6' );
                $joint_description_6 = CFS()->get( 'joint_description_6' );
            ?>
                <div class="top" style="position: relative">
                    <img src="<?php echo $header_img['url'][0]; ?>" width="100%" />
                    <?php
                    echo '<div class="main-hotspot-part"
                         style="top: 22%; left: 50%" data-hotspot="joint1">
                        <div class="lg-hotspot__button">
                            <div class="lg-hotspot__button-text">
                                <h3>'.$joint_title_2.'</h3>
                                <p>'.$joint_description_2.'<p>
                            </div>
                        </div>
                    </div>
                    <div class="main-hotspot-part"
                       style="top: 27%; left: 60%" data-hotspot="joint2">
                        <div class="lg-hotspot__button">
                            <div class="lg-hotspot__button-text">
                                <h3>'.$joint_title_1.'</h3>
                                <p>'.$joint_description_1.'<p>
                            </div>
                        </div>
                    </div>
                    <div class="main-hotspot-part"
                         style="top: 40.2%; left: 50.8%" data-hotspot="joint3">
                        <div class="lg-hotspot__button">
                            <div class="lg-hotspot__button-text">
                                <h3>'.$joint_title_3.'</h3>
                                <p>'.$joint_description_3.'<p>
                            </div>
                        </div>
                    </div>
                    <div class="main-hotspot-part"
                         style="top: 47.2%; left: 47.2%" data-hotspot="joint4">
                        <div class="lg-hotspot__button right-side-open">
                            <div class="lg-hotspot__button-text">
                                <h3>'.$joint_title_4.'</h3>
                                <p>'.$joint_description_4.'<p>
                            </div>
                        </div>
                    </div>
                    <div class="main-hotspot-part"
                         style="top: 62%; left: 36.5%" data-hotspot="joint5">
                        <div class="lg-hotspot__button right-side-open">
                            <div class="lg-hotspot__button-text">
                                <h3>'.$joint_title_5.'</h3>
                                <p>'.$joint_description_5.'<p>
                            </div>
                        </div>
                    </div>
                    <div class="main-hotspot-part"
                         style="top: 89%; left: 29.5%" data-hotspot="joint6">
                        <div class="lg-hotspot__button right-side-open">
                            <div class="lg-hotspot__button-text">
                                <h3>'.$joint_title_6.'</h3>
                                <p>'.$joint_description_6.'<p>
                            </div>
                        </div>
                    </div>
                    <div class="popup" id="joint1">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>'.$joint_title_2.'</h3>
                            </div>
                            <div class="modal-body">
                                <p>'.$joint_description_2.'</p>
                            </div>
                            <div class="modal-footer close-joint" data-hotspot="joint1"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
                        </div>
                    </div>
                    <div class="popup" id="joint2">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>'.$joint_title_1.'</h3>
                            </div>
                            <div class="modal-body">
                                <p>'.$joint_description_1.'</p>
                            </div>
                            <div class="modal-footer close-joint" data-hotspot="joint2"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
                        </div>
                    </div>
                    <div class="popup" id="joint3">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>'.$joint_title_3.'</h3>
                            </div>
                            <div class="modal-body">
                                <p>'.$joint_description_3.'</p>
                            </div>
                            <div class="modal-footer close-joint" data-hotspot="joint3"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
                        </div>
                    </div>
                     <div class="popup" id="joint4">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>'.$joint_title_4.'</h3>
                            </div>
                            <div class="modal-body">
                                <p>'.$joint_description_4.'</p>
                            </div>
                            <div class="modal-footer close-joint" data-hotspot="joint4"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
                        </div>
                    </div>                   
                    <div class="popup" id="joint5">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>'.$joint_title_5.'</h3>
                            </div>
                            <div class="modal-body">
                                <p>'.$joint_description_5.'</p>
                            </div>
                            <div class="modal-footer close-joint" data-hotspot="joint5"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
                        </div>
                    </div>
                    <div class="popup" id="joint6">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>'.$joint_title_6.'</h3>
                            </div>
                            <div class="modal-body">
                                <p>'.$joint_description_6.'</p>
                            </div>
                            <div class="modal-footer close-joint" data-hotspot="joint6"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
                        </div>
                    </div>';
                    ?>
                </div>
                <?php
                $joint_boxes = [];
                for($i=1;$i<=6;$i++){
                    $joint_box_title = 'joint_box_title_'.$i;
                    $joint_box_description = 'joint_box_description_'.$i;
                    $joint_box_url = 'joint_box_'.$i.'_url';
                    $joint_boxes[] = [
                        'joint_box_title' => CFS()->get( $joint_box_title),
                        'joint_box_description' => CFS()->get( $joint_box_description ),
                        'joint_box_url' => CFS()->get( $joint_box_url ),
                    ];
                }
                ?>
                <div class="wir-box-min p-tb-90">
                    <div class="container">
                        <div class="row g-4">
                            <?php
                            foreach ($joint_boxes as $joint_box) {
                            ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="wir-box-part">
                                    <h3><?php echo $joint_box['joint_box_title']; ?></h3>
                                    <p><?php echo $joint_box['joint_box_description']; ?></p>
                                    <a href="<?php echo $joint_box['joint_box_url']['url']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/arrow.svg" class="team-box-img-arrow"/></a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
<!--                <div class="container">-->
<!--                    --><?php //get_template_part( 'template-parts/content', 'page' ); ?>
<!--                </div>-->

            <?php endwhile; ?>

        <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #content-full -->

<?php get_footer(); ?>
