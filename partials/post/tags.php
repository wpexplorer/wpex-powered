<?php
/**
 * Displays the post tags
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

// Return if post tags shouldn't display
if ( post_password_required() ) {
	return;
}

the_tags( '<div class="pwd-post-tags">', '', '</div>' ); ?>