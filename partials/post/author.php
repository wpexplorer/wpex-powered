<?php
/**
 * The template for displaying Author bios.
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check display
$display = apply_filters( 'pwd_post_author_info', pwd_get_theme_mod( 'post_author_info', true ) );

// Author description required
if ( $display && $description = get_the_author_meta( 'description' ) ) : ?>

	<section class="pwd-author-info pwd-clr">

		<div class="pwd-author-info-inner pwd-clr">

			<div class="pwd-author-info-avatar">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php esc_attr( esc_html_e( 'Visit Author Page', 'wpex-powered' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'pwd_author_bio_avatar_size', 130 ) ); ?></a>
			</div><!-- .pwd-author-info-avatar -->

			<div class="pwd-author-info-content pwd-entry pwd-clr">
				<h4 class="pwd-author-info-heading"><?php esc_html_e( 'Article written by', 'wpex-powered' ); ?> <?php echo strip_tags( get_the_author() ); ?></h4>
				<p><?php echo pwd_sanitize( $description, 'html' ); ?></p>
				<div class="pwd-author-info-social pwd-clr">
					<?php
					// Display twitter url
					if ( $url = get_the_author_meta( 'wpex_twitter', $post->post_author ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="Twitter" class="pwd-social-bg pwd-twitter" target="_blank"><span class="fa fa-twitter" aria-hidden="true"></span></a>
					<?php }
					// Display facebook url
					if ( $url = get_the_author_meta( 'wpex_facebook', $post->post_author ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="Facebook" class="pwd-social-bg pwd-facebook" target="_blank"><span class="fa fa-facebook" aria-hidden="true"></span></a>
					<?php }
					// Display Linkedin url
					if ( $url = get_the_author_meta( 'wpex_linkedin', $post->post_author ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="LinkedIn" class="pwd-social-bg pwd-linkedin" target="_blank"><span class="fa fa-linkedin" aria-hidden="true"></span></a>
					<?php }
					// Display pinterest plus url
					if ( $url = get_the_author_meta( 'wpex_pinterest', $post->post_author ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="Pinterest" class="pwd-social-bg pwd-pinterest" target="_blank"><span class="fa fa-pinterest" aria-hidden="true"></span></a>
					<?php }
					// Display instagram plus url
					if ( $url = get_the_author_meta( 'wpex_instagram', $post->post_author ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="Instagram" class="pwd-social-bg pwd-instagram" target="_blank"><span class="fa fa-instagram" aria-hidden="true"></span></a>
					<?php }
					// Website URL
					if ( $url = get_the_author_meta( 'url', $post->post_author ) ) { ?>
						<a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>" target="_blank"><span class="fa fa-link" aria-hidden="true"></span></a>
					<?php } ?>
				</div><!-- .pwd-author-info-social -->
			</div><!-- .pwd-author-info-content -->

		</div><!-- .pwd-author-info-inner -->

	</section><!-- .pwd-author-info -->

<?php endif; ?>