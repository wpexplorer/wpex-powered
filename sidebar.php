<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Powered WordPress Theme
 * @author  WPExplorer.com
 * @link    https://www.wpexplorer.com/
 * @since   1.0.0
 */

// Return if it is full-width
if ( 'full-width' == pwd_get_post_layout() ) {
	return;
}

$sidebar = ( is_singular( 'page' ) && is_active_sidebar( 'sidebar_pages' ) ) ? 'sidebar_pages' : 'sidebar';

if ( is_active_sidebar( $sidebar ) ) : ?>

	<aside class="pwd-sidebar"<?php pwd_schema_markup( 'sidebar' ); ?>>

		<div class="pwd-widget-area">

			<?php dynamic_sidebar( $sidebar ); ?>

		</div><!-- .pwd-widget-area -->

	</aside><!-- .pwd-sidebar -->

<?php endif; ?>