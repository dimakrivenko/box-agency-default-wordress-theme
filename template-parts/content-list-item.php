<?php
/**
 * content-list-item.php
 *
 * List item content
 */

$tags = get_the_tags();

if ( ! is_array( $tags ) ) {
	$tags = array();
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-list-single'); ?>>
	<?php if (has_post_thumbnail()) : ?>
		<div class="image">
			<a href="<?php esc_attr_e(get_the_permalink()); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
	<?php endif; ?>
	<div class="text">
		<div class="top">
			<time class="date"><?php print( esc_html( get_the_date( 'd.m.Y' ) ) ); ?></time>
			<?php if (has_category()) : ?>
				<div class="devider"></div>
				<?php the_category(); ?>
			<?php endif; ?>
		</div>
		<div class="title">
			<a href="<?php esc_attr_e(get_the_permalink()); ?>">
				<?php esc_html_e(get_the_title()); ?>
			</a>
		</div>
		<div class="description">
			<?php _e(content(get_the_ID(), 40)); ?>
		</div>
		<div class="bottom <?php echo count($tags) > 0 ? 'has-tags' : ''; ?>">
			<?php if(count($tags) > 0) : ?>
				<div class="tags">
					<span><?php _e('Теги:', 'ul'); ?></span>
					<?php foreach ( $tags as $key => $value ) : ?>
		                <a href="<?php print( esc_url( get_term_link( $value ) ) ); ?>"><?php print( esc_html( $value->name ) ); ?></a>
					<?php endforeach; ?>
		        </div>
		    <?php endif; ?>
		    <a href="<?php esc_attr_e(get_the_permalink()); ?>"class="btn btn-primary more button_<?php esc_attr_e(fw_get_db_settings_option('ul_styling_button_style')); ?>"><?php _e('Подробнее', 'ul'); ?> </a>
	    </div>
	</div>
</article><!-- #post-## -->
