<?php
/**
 * content-none.php
 *
 * None content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-list-single no-results'); ?>>
	<div class="text">
		<?php
		if ( is_search() ) : ?>

			<p><?php _e( 'Извините, но ничего не соответствует вашим условиям поиска.<br> Пожалуйста, попытайтесь снова с другими ключевыми словами.', 'ul' ); ?></p>
			<?php
				get_search_form();

		else : ?>

			<p><?php esc_html_e( 'Кажется, мы не можем найти то, что вы ищете. Возможно, поиск может помочь.', 'ul' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div>
</article>