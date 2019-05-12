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

$categories = get_the_category();

// Has sidebar
$has_sidebar = false;
if (function_exists('dynamic_sidebar') && is_active_sidebar( 'sidebar-blog' )) {
    $has_sidebar = true;
} else {
    $has_sidebar = false;
}

get_header(); ?>

<section class="l-page page-archive">
    <div class="container">
        <div class="row" style="margin-bottom: 100px;">
            <div class="col-md-12">
                <div class="page-header">
                    <h1 class="page-title"><?php esc_html_e(get_cat_name($categories[0]->cat_ID)); ?></h1>
                </div>
                <div class="page-content">
                    <div class="post-list">
                        <div class="list">
                            <?php if ( have_posts() ) : ?>
                                <?php
                                    while ( have_posts() ) : the_post();
                                        get_template_part( 'template-parts/content-list-item' );
                                    endwhile;
                                ?>
                            <?php
                                else :
                                    get_template_part( 'template-parts/content', 'none' );
                                endif;
                            ?>
                        </div>

                        <?php the_posts_pagination(); ?>
                    </div>

                    <?php if ( $has_sidebar ) : ?>
                        <div class="blog-sidebar">
                            <?php get_sidebar(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>


