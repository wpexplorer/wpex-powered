<?php
/**
 * Displays the post audio
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

// Display audio if defined
if ( pwd_has_post_audio() ) : ?>

	<div class="pwd-post-media pwd-post-audio pwd-clr"><?php pwd_post_audio(); ?></div>
	
<?php endif; ?>