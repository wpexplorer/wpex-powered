<?php
/**
 * Configures Translators (WPMl, Polylang, etc)
 *
 * @package   Powered WordPress Theme
 * @author    WPExplorer.com
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

/**
 * Strings to translate
 *
 * @since 2.1.0
 */
function pwd_register_theme_mod_strings() {
	return apply_filters( 'pwd_register_theme_mod_strings', array(
		'pwd_logo'               => false,
		'pwd_logo_retina'        => false,
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