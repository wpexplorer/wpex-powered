<?php
/**
 * Footer copyright
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

$current_year = date( 'Y' );
$copy = apply_filters( 'pwd_footer_copyright', '&copy; ' . $current_year . ' Powered <a href="https://www.wpexplorer.com/free-wordpress-themes">theme</a> powered by <a href="https://wordpress.org/">WordPress</a>' );

// Display copyright
if ( $copy ) : ?>

	<div class="footer-copyright pwd-clr"<?php pwd_schema_markup( 'footer_bottom' ); ?>><?php
		echo wp_kses_post( do_shortcode( $copy ) );
	?></div><!-- .footer-copyright -->

<?php endif; ?>