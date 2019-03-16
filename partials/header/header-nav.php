<?php
/**
 * Top header navigation
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
}

// Check to make sure menu isn't empty
if ( has_nav_menu( 'main' ) ) : ?>

	<nav class="pwd-site-nav pwd-clr"<?php pwd_schema_markup( 'site_navigation' ); ?>><?php

		// Display menu
		wp_nav_menu( array(
			'theme_location'  => 'main',
			'fallback_cb'     => false,
			'container_class' => 'pwd-site-nav-container',
			'menu_class'      => 'pwd-dropdown-menu',
			'walker'          => new Powered_Dropdown_Walker_Nav_Menu,
		) );

	?></nav><!-- .pwd-container -->

<?php endif; ?>