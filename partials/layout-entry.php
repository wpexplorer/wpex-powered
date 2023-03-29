<?php
/**
 * The default template for displaying post entries.
 *
 * @package   Powered WordPress Theme
 * @author    WPExplorer.com
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Base classes for entry
$classes = array( 'pwd-loop-entry', 'pwd-col' );

// Check if embeds are allowed
$allow_embeds = pwd_get_theme_mod( 'entry_embeds', false );

// Check for media
$has_video = pwd_has_post_video();
$has_audio = pwd_has_post_audio();

// Classes
$classes = array( 'pwd-loop-entry', 'pwd-col', 'pwd-masonry-item' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<div class="pwd-loop-entry-inner"><?php

		// Video embed
		if ( $allow_embeds && $has_video ) :

			get_template_part( 'partials/entry/video' );

		// Post Thumbnail
		elseif ( pwd_get_theme_mod( 'entry_thumbnail', true ) && has_post_thumbnail() ) :

			// Display thumbnail
			get_template_part( 'partials/entry/thumbnail' );

		endif;

		// Audio embed
		if ( $allow_embeds && $has_audio ) :

			get_template_part( 'partials/entry/audio' );

		endif;

	?><div class="pwd-loop-entry-content"><?php

			// Entry category
			if ( 'post' == get_post_type() && ! is_category() ) {

				get_template_part( 'partials/entry/category' );

			}

			// Display title
			get_template_part( 'partials/entry/title' );

			// Display entry excerpt/content
			get_template_part( 'partials/entry/content' );

		?></div><!-- .pwd-loop-entry-content -->

	</div><!-- .pwd-boxed-container -->

</article><!-- .pwd-loop-entry -->