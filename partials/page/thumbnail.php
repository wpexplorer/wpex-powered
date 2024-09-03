<?php
/**
 * Displays the page thumbnail
 *
 * @package   Powered WordPress Theme
 * @author    WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<?php if ( has_post_thumbnail() ) : ?>

	<div class="pwd-page-thumbnail pwd-clr"><?php the_post_thumbnail( 'pwd_page' ); ?></div>

<?php endif; ?>