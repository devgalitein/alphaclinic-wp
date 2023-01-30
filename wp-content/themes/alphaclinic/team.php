<?php
/**
 * Template Name: Team template
 * Template Post Type: post
 *
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
die;
}

get_header();
?>
<div id="content" class="content-area">
     <main id="main" class="site-main" role="main">

      <?php get_template_part( 'template-parts/loop-header' ); ?>

      <?php while ( have_posts() ) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
               <div class="post-entry">
                   <div class="team-detail-header-section">
                        <?php $header_img = image_details(CFS()->get( 'header_image' ));?>
                        <?php echo '<img class ="team-detail-header-img" src="' . $header_img['url'][0] . '" alt="' . $header_img['alt'] . '" />';
                        echo '<div class="container"><div class="team-detail-header-title">'.get_the_title().'</div></div>';

                        /**
                        *  Infinite next and previous post looping in WordPress
                        */
                        echo '<div class="team-navigation">';
                           if( get_adjacent_post(true, '', true) ) {
                               previous_post_link('%link', '<img class="team-previous-icon" src="'.get_template_directory_uri().'/images/Previous.svg">');
                           } else {
                               $first = new WP_Query('posts_per_page=1&order=DESC&category_name=team'); $first->the_post();
                               echo '<a href="' . get_permalink() . '"><img class="team-previous-icon" src="'.get_template_directory_uri().'/images/Previous.svg"></a>';
                               wp_reset_query();
                           };

                           if( get_adjacent_post(true, '', false) ) {
                               next_post_link('%link', '<img class="team-next-icon" src="'.get_template_directory_uri().'/images/Next.svg">');
                           } else {
                               $last = new WP_Query('posts_per_page=1&order=ASC&category_name=team'); $last->the_post();
                               echo '<a href="' . get_permalink() . '"><img class="team-next-icon" src="'.get_template_directory_uri().'/images/Next.svg"></a>';
                               wp_reset_query();
                           }
                           ?>
                        </div>
                   </div>
                   <div class="container">
                       <div class="team-detail-content">
                            <?php the_content(); ?>
                       </div>
                   </div>
               </div>
          </article>
      <?php endwhile; // end of the loop. ?>

     </main><!-- #main -->

 <?php get_sidebar(); ?>
</div><!-- #content -->
<?php get_footer(); ?>
