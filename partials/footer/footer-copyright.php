<?php
/**
 * Footer copyright
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

$copy = get_theme_mod( 'pwd_footer_copy' ) ?: '&copy; ' . get_the_date( 'Y' ) . ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
$copy = apply_filters( 'pwd_footer_copyright', $copy );

// Display copyright
if ( $copy ) : ?>

	<div class="footer-copyright pwd-clr"<?php pwd_schema_markup( 'footer_bottom' ); ?>><?php
		echo do_shortcode( wp_kses_post( $copy ) );
	?></div><!-- .footer-copyright -->

<?php endif; ?>