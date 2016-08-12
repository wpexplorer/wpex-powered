<?php
/**
 * Displays the post thumbnail
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.stplorer.com
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<?php if ( has_post_thumbnail() ) : ?>

	<div class="pwd-post-media pwd-post-thumbnail pwd-clr">

		<?php the_post_thumbnail( 'pwd_post' ); ?>

	</div><!-- .pwd-post-media -->

<?php endif; ?>