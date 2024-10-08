<?php
/**
 * Single related posts
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

// Make sure we should display related items
if ( 'post' !== get_post_type() ) {
	return;
}

// Get count
$posts_per_page = pwd_get_theme_mod( 'post_related_count', 4 );
if ( ! $posts_per_page || 0 == $posts_per_page ) {
	return;
}

// Get Current post
$post_id = get_the_ID();

// What should be displayed?
$display = pwd_get_theme_mod( 'post_related_displays', 'related_category' );

// Related query arguments
$args = array(
	'posts_per_page' => $posts_per_page,
	'post__not_in'   => array( $post_id ),
);
if ( 'related_tags' == $display ) {
	$tags = wp_get_post_terms( $post_id, 'post_tag' );
	$tag_ids = array();
	foreach( $tags as $tag ) {
		$tag_ids[] = $tag->term_id;
	}
	if ( ! empty( $tag_ids ) ) {
		$args['tag__in'] = $tag_ids;
	}
} elseif ( 'related_category' == $display ) {
	$cats = wp_get_post_terms( $post_id, 'category' );
	$cats_ids = array();
	foreach( $cats as $cat ) {
		$cats_ids[] = $cat->term_id;
	}
	if ( ! empty( $cats_ids ) ) {
		$args['category__in'] = $cats_ids;
	}

} elseif ( 'random' == $display ) {
	$args['orderby'] = 'rand';
}

// Apply filters to the related query for child theming
$args = apply_filters( 'pwd_related_posts_args', $args );

// Run Query
global $pwd_query;
$pwd_query = new wp_query( $args );

// Display related items
if ( $pwd_query->have_posts() ) {

$cols = pwd_get_loop_columns( 'related' ) ?: '2';

?>

	<section class="pwd-related-posts">

		<?php
		// Display heading
		$heading = pwd_get_theme_mod( 'post_related_heading' );
		$heading = $heading ? $heading : esc_html__( 'Related Articles', 'wpex-powered' );
		if ( $heading ) : ?>
			<h4 class="pwd-heading"><?php echo pwd_sanitize( $heading, 'html' ); ?></h4>
		<?php endif; ?>

		<div class="pwd-entries pwd-row pwd-row-cols-<?php echo absint( $cols ); ?>"><?php

			// Loop through related posts
			foreach ( $pwd_query->posts as $post ) : setup_postdata( $post );

				// Display post entry
				get_template_part( 'partials/layout-entry' );

			endforeach;

		?></div><!-- .pwd-entries -->

	</section><!-- .pwd-related-posts -->

<?php } // End related items

// Reset post data
wp_reset_postdata(); $pwd_query = '';