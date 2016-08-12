<?php
/**
 * Displays the page thumbnail
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
	<div class="pwd-page-thumbnail pwd-clr">
		<?php the_post_thumbnail( 'full' ); ?>
	</div><!-- .pwd-page-thumbnail -->
<?php endif; ?>