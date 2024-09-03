<?php
/**
 * Post pagination
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

// Post pagination
wp_link_pages( array(
	'before'      => '<div class="pwd-page-links pwd-clr">',
	'after'       => '</div>',
	'link_before' => '<span>',
	'link_after'  => '</span>',
) ); ?>