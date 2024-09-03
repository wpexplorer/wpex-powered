<?php
/**
 * The default template for displaying post entries.
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

// Base classes for entry
$classes = array( 'pwd-loop-entry', 'pwd-col' );

// Classes
$classes = array( 'pwd-loop-entry', 'pwd-col', 'pwd-masonry-item' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<div class="pwd-loop-entry-inner"><?php

		if ( ! post_password_required() && pwd_get_theme_mod( 'entry_thumbnail', true ) && has_post_thumbnail() ) :

			// Display thumbnail
			get_template_part( 'partials/entry/thumbnail' );

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