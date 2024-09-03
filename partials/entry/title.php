<?php
/**
 * The post entry title
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

?>

<header class="pwd-loop-entry-header">
	<h2 class="pwd-loop-entry-title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2><!-- .pwd-loop-entry-title -->
</header><!-- .pwd-loop-entry-header -->