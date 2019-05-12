<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package default-theme
 */
?>
		</section><!-- end .l-main -->
		<?php
			// Footer template
		    get_template_part( 'template-parts/footer' );
	    ?>
    
    </section><!-- end .l-main-wrapper -->

    <?php
    	// Modals template
		get_template_part( 'template-parts/modals' );
    ?>

    <?php wp_footer(); ?>
   
</body>
<html>
