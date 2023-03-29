<?php
/**
 * Scroll to top button
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
} ?>

<a href="#" class="pwd-site-scroll-top"><span class="fa fa-chevron-up" aria-hidden="true"></span><span class="screen-reader-text"><?php esc_html_e( 'scroll to the top of the site', 'wpex-powered' ); ?></span></a>