<?php
/**
 * Displays the entry video
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
}

// Display video if defined
if ( pwd_has_post_video() ) : ?>

	<div class="pwd-loop-entry-video pwd-loop-entry-media pwd-responsive-embed pwd-clr"><?php pwd_post_video(); ?></div>

<?php endif; ?>