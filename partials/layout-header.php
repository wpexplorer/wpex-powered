<?php
/**
 * The main header layout
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
} ?>

<div class="pwd-site-header-wrap"<?php pwd_schema_markup( 'header' ); ?>>

	<header class="pwd-site-header pwd-container">

		<div class="pwd-site-branding"><?php

			get_template_part( 'partials/header/header-logo' );

		?></div><!-- .pwd-site-branding -->

		<?php
		// Display header menu
		get_template_part( 'partials/header/header-nav' ); ?>

		<?php
		// Header search
		get_template_part( 'partials/header/header-search' ); ?>

	</header><!-- .pwd-site-header -->

</div><!-- .pwd-site-header-wrap -->