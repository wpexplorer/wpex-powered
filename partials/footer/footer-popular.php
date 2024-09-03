<?php
/**
 * Footer popular Posts
 *
 * @package   Powered WordPress Theme
 * @author    WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if enabled
$enabled = ( is_search() || is_page() ) ?  false : pwd_get_theme_mod( 'footer_popular_posts', true );
if ( ! apply_filters( 'pwd_footer_popular_posts', $enabled ) ) {
	return;
}

// Query arguments
$args = array(
	'posts_per_page'      => 5,
	'ignore_sticky_posts' => true,
);

// Exclude current post on singular posts
if ( is_singular() ) {
	$args['post__not_in'] = array( get_the_ID() );
}

// Orderby ?
if ( class_exists( 'Post_Views_Counter' ) ) {
	$args['orderby'] = 'post_views';
} else {
	$args['orderby'] = 'comment_count';
}

// Apply filters to args
$args = apply_filters( 'pwd_footer_popular_posts_args', $args );

// Run Query
$pwd_query = new wp_query( $args );

// Display popular items
if ( $pwd_query->have_posts() ) { ?>

	<section class="pwd-footer-pp">

		<div class="pwd-container">

			<?php
			// Display heading
			$heading = pwd_get_theme_mod( 'footer_popular_posts_heading' );
			$heading = $heading ? $heading : esc_html__( 'Popular Posts', 'wpex-powered' );

			if ( $heading ) : ?>

				<h4 class="pwd-footer-pp-heading"><?php echo esc_html( $heading ); ?></h4>

			<?php endif; ?>

			<div class="pwd-row pwd-row-cols-5"><?php

				// Loop through related posts
				foreach ( $pwd_query->posts as $post ) : setup_postdata( $post ); ?>

					<div class="pwd-col">
						<a href="<?php the_permalink(); ?>" title="<?php pwd_esc_title(); ?>">
							<?php the_post_thumbnail( 'pwd_footer_popular' ); ?>
							<div class="pwd-footer-pp-entry-title"><?php the_title(); ?></div>
						</a>
					</div>

				<?php endforeach;

			?></div><!-- .pwd-row -->

		</div><!-- .pwd-container -->

	</section><!-- .pwd-footer-pp -->

<?php } // End related items

// Reset post data
wp_reset_postdata(); $pwd_query = '';