<?php
/**
 * Returns the page layout components
 *
 * @package   Powered WordPress Theme
 * @author    WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article class="pwd-page-article"><?php

	// Featured image
	if ( has_post_thumbnail() ) :

		get_template_part( 'partials/page/thumbnail' );

	endif;

	// Page Header
	$page_template = get_page_template_slug();
	if ( ! $page_template || ! str_contains( $page_template, 'no-title' ) ) :

		get_template_part( 'partials/page/header' );

	endif;

	// Page content
	get_template_part( 'partials/page/content' );

	// Post Edit link
	get_template_part( 'partials/global/edit' );

	// Page comments
	if ( get_theme_mod( 'comments_on_pages', true ) ) :
		comments_template();
	endif;

?></article><!-- .pwd-page-article -->