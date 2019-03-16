<?php
/**
 * Displays the entry thumbnail.
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

// Check if singular post
global $pwd_is_singular;
$pwd_is_singular = isset( $pwd_is_singular ) ? $pwd_is_singular : is_singular();

// Current query
if ( $pwd_is_singular ) {
	$pwd_query = 'related';
} else {
	$pwd_query = 'archive';
}

// Display thumbnail
if ( has_post_thumbnail() ) : ?>

	<div class="pwd-loop-entry-thumbnail pwd-loop-entry-media pwd-clr">

		<a href="<?php the_permalink(); ?>" title="<?php pwd_esc_title(); ?>" class="pwd-loop-entry-media-link"><?php

			// Display thumbnail
			the_post_thumbnail( pwd_get_entry_image_size( $pwd_query ) );

		?></a>

	</div><!-- .pwd-loop-entry-thumbnail -->

<?php endif; ?>