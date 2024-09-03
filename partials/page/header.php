<?php
/**
 * Outputs the page title
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

// Display the page header if it's not the front-page
if ( ! is_front_page() ) : ?>
	<header class="page-header pwd-clr"><h1 class="pwd-page-header-title"><?php the_title(); ?></h1></header>
<?php endif; ?>