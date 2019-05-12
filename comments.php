<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */


if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				print(__('Комментариев', 'ul') . ': ' . get_comments_number());
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<div class="comment-list">
			<?php
				function single_comment_template( $comment, $args, $depth ) {
					if ( 'div' === $args['style'] ) {
						$tag       = 'div';
						$add_below = 'comment';
					} else {
						$tag       = 'li';
						$add_below = 'div-comment';
					}

					$classes = ' ' . comment_class( empty( $args['has_children'] ) ? '' : 'parent', null, null, false ); ?>

					<<?php echo $tag, $classes; ?> id="comment-<?php comment_ID() ?>">
					<?php if ( 'div' != $args['style'] ) { ?>
						<div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
					} ?>
					<div class="comment-top">
						<div class="comment-author vcard">
							<?php
								if ( $args['avatar_size'] != 0 ) {
									echo get_avatar( $comment, $args['avatar_size'] );
								}
							?>
							
						</div>
						<div class="comment-meta commentmetadata">
							<div class="name">
								<?php printf(get_comment_author_link()); ?>
							</div>
							<div class="props">
								<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-link">
									<?php
									printf(
										__( '%1$s at %2$s' , 'ul'),
										get_comment_date(),
										get_comment_time()
									); ?>
								</a>

								 <?php edit_comment_link( __( 'Edit' , 'ul'), '  ', '' ); ?>
							</div>
						</div>

					</div>

					<div class="comment-text">
						<?php comment_text(); ?>
					</div>

					<div class="reply">
						<?php
						comment_reply_link(
							array_merge(
								$args,
								array(
									'add_below' => $add_below,
									'depth'     => $depth,
									'max_depth' => $args['max_depth']
								)
							)
						); ?>
					</div>

					<?php if ( $comment->comment_approved == '0' ) { ?>
						<div class="comment-awaiting-moderation">
							<?php _e( 'Ваш комментарий ожидает модерации', 'ul' ); ?>
						</div>
					<?php } ?>

					<?php if ( 'div' != $args['style'] ) { ?>
						</div>
					<?php }
				}

				wp_list_comments( array(
					'style'       => 'div',
					'short_ping'  => true,
					'avatar_size' => 50,
					'callback' => 'single_comment_template'
				) );

				
			?>
		</div><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<div class="no-comments"><?php _e( 'Новый комментарий оставить нельзя', 'ul' ); ?></div>
	<?php endif; ?>

	<?php
		$commenter = wp_get_current_commenter();

		comment_form( array(
			'class_form' => 'comment-form',
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
			'fields' => array(
				'author' => '<div class="form-group comment-form-author">'.
							'<input type="text" name="author" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . __('Имя *', 'ul') . '" required /></div>',
				'email' => '<div class="form-group comment-form-email">'.
							'<input type="email" name="email" class="form-control" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="E-mail *" required /></div>'
			),
			'comment_field' => '<div class="form-group comment-form-comment"><textarea class="form-control" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __('Комментарий *', 'ul') . '"></textarea></div>',
			
			'class_submit' => 'submit btn btn-primary'
		) );
	?>

</div><!-- .comments-area -->
