<?php
/**
 * Instagram Footer area
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.stplorer.com
 * @since     1.2.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_active_sidebar( 'instagram_footer' ) ) : ?>
	<div id="pwd-instagram-footer" class="pwd-clr"><?php dynamic_sidebar( 'instagram_footer' ); ?></div>
<?php endif; ?>