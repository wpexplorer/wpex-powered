<?php
/**
 * Configures Translators (WPMl, Polylang, etc)
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.stplorer.com
 * @since     1.0.0
 */

/**
 * Strings to translate
 *
 * @since 2.1.0
 */
function pwd_register_theme_mod_strings() {
	return apply_filters( 'pwd_register_theme_mod_strings', array(
		'pwd_logo'                 => false,
		'pwd_logo_retina'          => false,
		'pwd_logo_retina_height'   => false,
		'pwd_post_related_heading' => null,
		'pwd_footer_copyright'     => '<a href="http://www.wordpress.org" title="WordPress" target="_blank">WordPress</a> Theme Designed &amp; Developed by <a href="http://www.stplorer.com/" target="_blank" title="WPExplorer">WPExplorer</a>',
		'pwd_sitenav_mm_txt'       => null,
		'pwd_home_tagline'         => null,
	) );
}

/**
 * Registers strings
 *
 * @since 1.0.0
 */
function pwd_wpml_register_strings( $key, $default = null ) {

	// Get strings
	$strings = pwd_register_theme_mod_strings();

	// Register strings for WPMl
	if ( function_exists( 'icl_register_string' ) ) {
		foreach( $strings as $string => $default ) {
			icl_register_string( 'Theme Mod', $string, get_theme_mod( $string, $default ) );
		}
	}

	// Register strings for Polylang
	if ( function_exists( 'pll_register_string' ) ) {
		foreach( $strings as $string => $default ) {
			pll_register_string( $string, get_theme_mod( $string, $default ), 'Theme Mod', true );
		}
	}

}
add_action( 'admin_init', 'pwd_wpml_register_strings' );