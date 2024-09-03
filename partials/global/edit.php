<?php
/**
 * Edit post link
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

// Not needed for these pages
if ( ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'is_checkout' ) && is_checkout() ) ) {
	return;
}

// Define text
if ( is_page() ) {
	$text = esc_html__( 'Edit This Page', 'wpex-powered' );
} else {
	$text = esc_html__( 'Edit This Article', 'wpex-powered' );
}
$text = apply_filters( 'pwd_post_edit_text', $text );

// Display edit post link
edit_post_link(
	$text,
	'<div class="pwd-post-edit pwd-clr">', '</div>'
); ?>