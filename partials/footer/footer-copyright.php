<?php
/**
 * Footer copyright
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
}

// Get copyright data
$copy = pwd_get_theme_mod( 'footer_copyright', '<a href="http://www.wpexplorer.com/powered-free-wordpress-theme/" title="WordPress" target="_blank">Powered</a> by <a href="http://www.wpexplorer.com/" target="_blank" title="WPExplorer">WPExplorer</a> powered by <a href="https://wordpress.org/" title="WordPress">WordPress</a>' );

// Display copyright
if ( $copy ) : ?>

	<div class="footer-copyright pwd-clr"<?php pwd_schema_markup( 'footer_bottom' ); ?>><?php
		echo wp_kses_post( do_shortcode( $copy ) );
	?></div><!-- .footer-copyright -->

<?php endif; ?>