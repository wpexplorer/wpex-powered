<?php
/**
 * Used to display post author info
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

// Not needed here
if ( is_attachment() ) {
	return;
}

// Return if disabled
if ( ! get_theme_mod( 'post_author_bio', true ) ) {
	return;
}

// Vars
$author				= get_the_author();
$author_description	= get_the_author_meta( 'description' );
$author_url			= esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
$author_avatar		= get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'pwd_author_bio_avatar_size', 75 ) );

// Only display if author has a description
if ( ! $author_description ) {
	return;
} ?>

<div class="author-info pwd-clr">
	<h4 class="heading"><span><?php printf( esc_html__( 'Written by %s', 'wpex-powered' ), $author ); ?></span></h4>
	<div class="author-info-inner pwd-clr">
		<?php if ( $author_avatar ) { ?>
			<div class="author-avatar pwd-clr">
				<a href="<?php echo esc_url( $author_url ); ?>" rel="author" title="<?php esc_attr( $author ); ?>">
					<?php echo pwd_sanitize( $author_avatar, 'image' ); ?>
				</a>
			</div><!-- .author-avatar -->
		<?php } ?>
		<div class="author-description">
			<p><?php echo pwd_sanitize( $author_description, 'html' ); ?></p>
		</div><!-- .author-description -->
		<?php if ( pwd_author_has_social() ) : ?>
			<div class="author-social pwd-clr">
				<?php
				// Display twitter url
				if ( $url = get_the_author_meta( 'pwd_twitter', $post->post_author ) ) { ?>
					<a href="<?php echo esc_url( $url ); ?>" title="Twitter" class="twitter" target="_blank"><span class="fa fa-twitter" aria-hidden="true"></span></a>
				<?php }
				// Display facebook url
				if ( $url = get_the_author_meta( 'pwd_facebook', $post->post_author ) ) { ?>
					<a href="<?php echo esc_url( $url ); ?>" title="Facebook" class="facebook" target="_blank"><span class="fa fa-facebook" aria-hidden="true"></span></a>
				<?php }
				// Display Linkedin url
				if ( $url = get_the_author_meta( 'pwd_linkedin', $post->post_author ) ) { ?>
					<a href="<?php echo esc_url( $url ); ?>" title="LinkedIn" class="linkedin" target="_blank"><span class="fa fa-linkedin" aria-hidden="true"></span></a>
				<?php }
				// Display pinterest plus url
				if ( $url = get_the_author_meta( 'pwd_pinterest', $post->post_author ) ) { ?>
					<a href="<?php echo esc_url( $url ); ?>" title="Pinterest" class="pinterest" target="_blank"><span class="fa fa-pinterest" aria-hidden="true"></span></a>
				<?php }
				// Display instagram plus url
				if ( $url = get_the_author_meta( 'pwd_instagram', $post->post_author ) ) { ?>
					<a href="<?php echo esc_url( $url ); ?>" title="Instagram" class="instagram" target="_blank"><span class="fa fa-instagram" aria-hidden="true"></span></a>
				<?php } ?>
			</div><!-- .author-bio-social -->
		<?php endif; ?>
	</div><!-- .author-info-inner -->
</div><!-- .author-info -->