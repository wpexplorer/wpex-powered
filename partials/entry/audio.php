<?php
/**
 * Displays the entry audio
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

// Display audio if defined
if ( pwd_has_post_audio() ) : ?>

	<div class="pwd-loop-entry-audio pwd-loop-entry-media pwd-responsive-embed pwd-clr"><?php pwd_post_audio(); ?></div>

<?php endif; ?>