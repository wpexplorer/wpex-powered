 <?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments and the comment
 * form. The actual display of comments is handled by a callback to
 * pwd_comment() which is located at functions/comments-callback.php
 *
 * @package Powered WordPress Theme
 * @author  WPExplorer.com
 * @link    https://www.wpexplorer.com/
 * @since   1.0.0
 */

// Return if not needed
if ( post_password_required() || ( ! comments_open() && get_comment_pages_count() == 0 ) ) {
	return;
}

// Return if comments disabled
if ( ! pwd_has_comments() ) {
	return;
}

// Check if there are comments
$have_comments = have_comments(); ?>

<div id="comments" class="comments-area pwd-boxed-content">

	<?php
	// Get comments title
	if ( $have_comments ) {

		$comments_number = number_format_i18n( get_comments_number() );
		if ( '1' == $comments_number ) {
			$comments_title = esc_html__( 'This Article Has 1 Comment', 'wpex-powered' );
		} else {
			$comments_title = sprintf( esc_html__( 'This Article Has %s Comments', 'wpex-powered' ), $comments_number );
		}

	} else {
		$comments_title = esc_html__( 'Be the first to comment', 'wpex-powered' );
	}

	// Apply filter to title
	$comments_title = apply_filters( 'pwd_comments_title', $comments_title ); ?>

	<h5 class="pwd-comments-title pwd-heading"><?php echo esc_html( $comments_title ); ?></h5>

	<div class="pwd-comments-wrap">

		<?php
		// Display comments if we have some
		if ( $have_comments ) : ?>

			<ol class="commentlist"><?php

				// Display comments
				wp_list_comments( array(
					'callback'	=> 'pwd_comment',
				) );

			?></ol><!-- .commentlist -->

			<?php
			// Display comment pagination
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

				<nav class="navigation comment-navigation row" role="navigation">
					<h3 class="assistive-text pwd-heading"><span><?php esc_html_e( 'Comment navigation', 'wpex-powered' ); ?></span></h3>
					<div class="pwd-clr">
						<div class="pwd-nav-previous"><?php
							previous_comments_link( esc_html__( '&larr; Older Comments', 'wpex-powered' ) );
						?></div>
						<div class="pwd-nav-next"><?php
							next_comments_link( esc_html__( 'Newer Comments &rarr;', 'wpex-powered' ) );
						?></div>
					</div><!-- .pwd-clr -->
				</nav>

			<?php endif; ?>

			<?php
			// Display comments closed notice
			if ( ! comments_open() ) : ?>

				<div class="comments-closed-notice"><?php

					esc_html_e( 'Comments are now closed.', 'wpex-powered' );

				?></div><!-- .comments-closed-notice -->

			<?php endif; ?>

		<?php endif; // have_comments() ?>

		<?php
		// Display comment submission form
		comment_form(); ?>

	</div><!-- .pwd-comments-wrap -->

</div><!-- #comments -->