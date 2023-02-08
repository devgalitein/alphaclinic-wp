<?php
/**
 * Template Name: Was wir behandeln template
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

        <?php while ( have_posts() ) : the_post();
        $counter_chapters = CFS()->get('counter_chapters');
        $chapters = CFS()->get('chapters');
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="post-entry">
                <div class="joint-details-page-section">
                    <div class="container">
                        <div class="joint-details-page-header">
                            <h3><?php echo get_the_title();?></h3>
                            <div class="header-right-text">
                                <ul>
                                    <?php
                                    $i = 1;
                                    foreach ($chapters as $chapter) {
                                        echo '<li><a href="#chapter'.$i.'">'.$i.'. '.$chapter['title'].'</a></li>';
                                        $i++;
                                        if ($counter_chapters){
                                            if($i==($counter_chapters+1)) break;
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="behandeln-detials-main">
                    <?php
                    $i = 1;
                    foreach ($chapters as $chapter) {
                     echo '<div class="behandeln-detials-content">
                                <div class="container">
                                    <div class="behandeln-detials-title">
                                        <h3 id="chapter'.$i.'"><span>'.$i.'</span>'.$chapter['title'].'</h3>
                                        <p>'.$chapter['description'].'</p>
                                    </div>';

                                    $layout = '';
                                    foreach ($chapter['layout'] as $grid) {
                                        if ($grid == '1 columns') {
                                            $layout = "col-md-12";
                                        } elseif ($grid == '2 columns') {
                                            $layout = "col-md-6";
                                        } elseif ($grid == '3 columns') {
                                            $layout = "col-md-4";
                                        } elseif ($grid == '4 columns') {
                                            $layout = "col-md-3";
                                        }
                                    }
                                    $column_boxes = [];
                                    for($j=1;$j<=4;$j++){
                                        $column_boxes[] = [
                                            'column_title' => $chapter['column_'.$j.'_title'],
                                            'column_description' => $chapter['column_'.$j.'_description'],
                                        ];
                                    }
                                    echo '<div class="behandeln-detials-box">
                                            <div class="row">';
                                            foreach ($column_boxes as $column_box){
                                            echo '<div class="'.$layout.'">
                                                        <h3 class="chapter-sub-title">'.$column_box['column_title'].'</h3>
                                                        <p class="chapter-sub-desc">'.$column_box['column_description'].'</p>
                                                    </div>';
                                        }
                                    echo '</div>
                                    </div>';

                                $i++;
                                if ($counter_chapters){
                                    if($i==($counter_chapters+1)) break;
                                }
                                echo '</div>
                     </div>';
                    }
                    ?>
                </div>
            </div>
        </article>
<?php endwhile; // end of the loop. ?>

</main><!-- #main -->

<?php get_sidebar(); ?>
</div><!-- #content -->
<?php get_footer(); ?>
