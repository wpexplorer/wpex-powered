<?php
/**
 * Outputs the post content
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
} ?>

<div class="pwd-post-content pwd-entry pwd-clr"<?php pwd_schema_markup( 'entry_content' ); ?>>
	<?php the_content(); ?>
</div><!-- .pwd-post-content -->