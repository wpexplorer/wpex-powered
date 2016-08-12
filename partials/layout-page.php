<?php
/**
 * Returns the page layout components
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.stplorer.com
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article class="pwd-page-article pwd-clr"><?php

	// Open boxed layout
	echo '<div class="pwd-boxed-content pwd-clr">';

		// Page Header
		if ( ! get_post_meta( get_the_ID(), 'pwd_hide_title', true ) ) :
			get_template_part( 'partials/page/header' );
		endif;

		// Page content
		get_template_part( 'partials/page/content' );

		// Post Edit link
		get_template_part( 'partials/global/edit' );

	// Close boxed layout
	echo '</div><!-- .pwd-boxed-content -->';

	// Page comments
	if ( get_theme_mod( 'comments_on_pages', true ) ) :
		comments_template();
	endif;

?></article><!-- .pwd-page-article -->