<?php
/**
 * Displays the next/previous post links
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

// Get post navigation
$args     = apply_filters( 'pwd_post_navigation_args', array(
	'prev_text'	=> '<div class="pwd-label">'. esc_html__( 'Next Article', 'wpex-powered' ) . '<span class="fa fa-caret-right"  aria-hidden="true"></span></div><div class="pwd-link">%title</div>',
	'next_text'	=> '<div class="pwd-label"><span class="fa fa-caret-left" aria-hidden="true"></span>'. esc_html__( 'Previous Article', 'wpex-powered' ) .'</div><div class="pwd-link">%title</div>',
) );
$post_nav = get_the_post_navigation( $args );
$post_nav = str_replace( 'role="navigation"', '', $post_nav );
$post_nav = str_replace( 'nav-links', 'pwd-nav-links', $post_nav );

// Display post navigation
if ( ! is_attachment() && $post_nav ) : ?>

	<div class="pwd-post-navigation pwd-clr"><?php echo pwd_sanitize( $post_nav, 'html' ); ?></div>

<?php endif; ?>