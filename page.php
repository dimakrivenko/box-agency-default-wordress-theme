<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package default-theme
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
?>

<section class="l-page page-single">
    <div class="container">
        <div class="row" style="margin-bottom: 100px;">
            <div class="col-md-12">
                <div class="page-header">
                    <h1 class="page-title">
                        <?php the_title(); ?>
                    </h1>
                </div>
                <div class="page-content">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="content-area">
                        <?php the_content(); ?>

                        <?php wp_link_pages(); ?>
                    </div>

                    <?php if ( comments_open() || get_comments_number() ) : ?>
                        <div class="comment-area">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php
    endwhile; endif;
    get_footer();
?>
