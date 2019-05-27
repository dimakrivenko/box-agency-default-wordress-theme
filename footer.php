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

    <?php
    	// Yandex metrika code
    	if (fw_get_db_settings_option('ul_general_yandex_metrika_id') != '') :

    	$ya_metrika_id = fw_get_db_settings_option('ul_general_yandex_metrika_id');
    ?>
    	<!-- Yandex.Metrika counter -->
		<script type="text/javascript" >
		   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
		   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
		   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

		   ym(<?php esc_attr_e($ya_metrika_id); ?>, "init", {
		        id:<?php esc_attr_e($ya_metrika_id); ?>,
		        clickmap:true,
		        trackLinks:true,
		        accurateTrackBounce:true,
		        webvisor:true
		   });
		</script>
		<noscript><div><img src="https://mc.yandex.ru/watch/<?php esc_attr_e($ya_matrika_id); ?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		<!-- /Yandex.Metrika counter -->
	<?php endif; ?>

	
	<?php if (fw_get_db_settings_option('ul_general_custom_js_code')) : ?>
		<!-- Custom JS code - BEGIN -->
		<?php echo fw_get_db_settings_option('ul_general_custom_js_code'); ?>
		<!-- Custom JS code - END -->
	<?php endif; ?>
   
</body>
<html>
