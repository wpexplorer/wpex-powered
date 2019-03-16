<?php
/**
 * Archives header
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

// Only used for archives and search results
if ( ! is_archive() && ! is_search() ) {
	return;
}

// Define vars
$is_author = is_author();
if ( $is_author ) {
	global $author;
	$curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) );
} ?>

<header class="pwd-archive-header pwd-clr">

	<h1 class="pwd-archive-title"><?php

		if ( $custom_archive_title = apply_filters( 'pwd_archive_title', null ) ) :

			echo pwd_sanitize( $custom_archive_title, 'html' );

		elseif ( is_search() ) :

			esc_html_e( 'Search Results ', 'wpex-powered' );

		elseif ( $is_author ) :

			esc_html_e( 'Posts written by', 'wpex-powered' ); ?> <?php echo ucfirst( esc_html( $curauth->nickname ) );

		elseif ( is_tax() || is_category() || is_tag() ) :

			single_term_title();

		else :

			the_archive_title();

		endif;

	?></h1>

	<?php
	// Show search query
	if ( is_search() ) : ?>

		<div class="pwd-header-tagline pwd-clr"><?php
			printf( esc_html__( 'You searched for: %s', 'wpex-powered' ), '<span>'. get_search_query() .'</span>' );
		?></div><!-- .pwd-header-tagline -->

		<div class="pwd-search-results-form pwd-clr"><?php get_search_form(); ?></div>

	<?php
	// Author description
	elseif ( $is_author ) : ?>

		<div class="pwd-header-tagline pwd-clr"><?php
			$count = count_user_posts( get_query_var( 'author' ) );
			printf( esc_html__( 'This author has written %d articles', 'wpex-powered' ), $count );
		?></div><!-- .pwd-header-tagline -->

	<?php
	// Display archive description
	elseif ( is_category() || is_tag() ) : ?>

		<?php if ( term_description() ) : ?>

			<div class="pwd-header-tagline pwd-clr"><?php
				echo term_description();
			?></div><!-- .pwd-header-tagline -->

		<?php else :

			global $wp_query; ?>

			<div class="pwd-header-tagline pwd-clr"><?php
				
				if ( is_category() ) {
					if ( 1 == $wp_query->found_posts ) {
						echo esc_html__( 'There is 1 article in this category', 'wpex-powered' );
					} elseif ( $wp_query->found_posts ) {
						printf( esc_html__( 'There are %s articles in this category', 'wpex-powered' ), $wp_query->found_posts );
					}
				} elseif ( is_tag() ) {
					if ( 1 == $wp_query->found_posts ) {
						echo esc_html__( 'There is 1 article under this tag', 'wpex-powered' );
					} elseif ( $wp_query->found_posts ) {
						printf( esc_html__( 'There are %s articles under this tag', 'wpex-powered' ), $wp_query->found_posts );
					}
				}
			?></div><!-- .pwd-header-tagline -->

		<?php endif; ?>

	<?php
	// Data archives
	elseif ( is_archive() ) : ?>

		<div class="pwd-header-tagline pwd-clr"><?php

			if ( 1 == $wp_query->found_posts ) {
				echo esc_html__( 'There is 1 article in this archive', 'wpex-powered' );
			} elseif ( $wp_query->found_posts ) {
				printf( esc_html__( 'There are %s articles in this archive', 'wpex-powered' ), $wp_query->found_posts );
			}

		?></div><!-- .pwd-header-tagline -->

	<?php endif; ?>

</header><!-- .pwd-archive-header -->