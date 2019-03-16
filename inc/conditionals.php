<?php
/**
 * Useful conditionals for this theme
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

/**
 * Check if responsiveness is enabled
 *
 * @since 1.0.0
 */
function pwd_is_responsive() {
	return pwd_get_theme_mod( 'responsive', true );
}

/**
 * Check if featured post is enabled
 *
 * @since 1.0.0
 */
function pwd_archive_has_featured_post() {
	return apply_filters( 'pwd_archive_has_featured_post', pwd_get_theme_mod( 'archive_featured_post', true ) );
}

/**
 * Show post thumbnail?
 *
 * @since 1.0.0
 */
function pwd_show_post_thumbnail() {
	if ( 'post' == get_post_type() ) {
		$return = pwd_get_theme_mod( 'post_thumbnail', true );
	} else {
		$return = true;
	}
	return apply_filters( 'pwd_show_post_thumbnail', $return );
}

/**
 * Check if comments are enabled
 *
 * @since 1.0.0
 */
function pwd_has_comments( $bool = true ) {
	if ( 'page' == get_post_type() && ! get_theme_mod( 'page_comments', true ) ) {
		$bool = false;
	}
	return apply_filters( 'pwd_has_comments', $bool );
}

/**
 * Check if post has a video
 *
 * @since 1.0.0
 */
function pwd_has_post_video( $post_id = '' ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$bool = false;
	$mprefix = pwd_meta_prefix();
	if ( get_post_meta( $post_id, $mprefix . 'post_video', true ) ) {
		$bool = true;
	}
	return apply_filters( 'pwd_has_post_video', $bool );
}

/**
 * Check if post has a audio
 *
 * @since 1.0.0
 */
function pwd_has_post_audio( $post_id = '' ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$bool = false;
	$mprefix = pwd_meta_prefix();
	if ( get_post_meta( $post_id, $mprefix .'post_audio', true ) ) {
		$bool = true;
	}
	return apply_filters( 'pwd_has_post_audio', $bool );
}

/**
 * Check if social share is enabled
 *
 * @since 1.0.0
 */
function pwd_has_social_share() {
	$bool = ( is_singular( 'post' ) && pwd_get_theme_mod( 'social_share', true ) ) ? true : false;
	return apply_filters( 'pwd_has_social_share', $bool );
}

/**
 * Check if social share is enabled
 *
 * @since 1.0.0
 */
function pwd_has_author_bio( $bool = true ) {
	$bool = get_theme_mod( 'post_author_info', true );
	$bool = apply_filters( 'pwd_has_author_bio', $bool );
	return $bool;
}

/**
 * Check if footer widgets are enabled
 *
 * @since 1.0.0
 */
function pwd_has_footer_widgets( $bool = true ) {
	$columns = get_theme_mod( 'footer_widget_columns', 4 );
	if ( ! $columns || '0' == $columns || 'disable' == $columns ) {
		$bool = false;
	}
	if ( $bool ) {
		if ( is_active_sidebar( 'footer-one' )
			|| is_active_sidebar( 'footer-two' )
			|| is_active_sidebar( 'footer-three' )
			|| is_active_sidebar( 'footer-four' )
		) {
			$bool = true;
		} else {
			$bool = false;
		}
	}
	$bool = apply_filters( 'pwd_has_footer_widgets', $bool );
	return $bool;
}

/**
 * Check if custom excerpt is enabled
 *
 * @since 1.0.0
 */
function pwd_has_custom_excerpt() {
	$display = pwd_get_theme_mod( 'entry_content_display', 'excerpt' );
	$length  = pwd_get_theme_mod( 'entry_excerpt_length', 14 );
	if ( 'excerpt' == $display && $length > 0 ) {
		$bool = true;
	} else {
		$bool = false;
	}
	$bool = apply_filters( 'pwd_has_custom_excerpt', $bool );
	return $bool;
}

/**
 * Checks if a user has social options defined
 *
 * @since 1.0.0
 */

function pwd_author_has_social( $user_id = NULL ) {
	if ( get_the_author_meta( 'wpex_twitter', $user_id ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_facebook', $user_id ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_googleplus', $user_id ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_linkedin', $user_id ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_instagram', $user_id ) ) {
		return true;
	} elseif ( get_the_author_meta( 'wpex_pinterest', $user_id ) ) {
		return true;
	} else {
		return false;
	}
}