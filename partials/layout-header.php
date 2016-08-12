<?php
/**
 * The main header layout
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
} ?>

<div class="pwd-site-header-wrap pwd-clr"<?php pwd_schema_markup( 'header' ); ?>>

	<header class="pwd-site-header pwd-container pwd-clr">

		<div class="pwd-site-branding pwd-clr"><?php

			get_template_part( 'partials/header/header-logo' );

		?></div><!-- .pwd-site-branding -->

		<?php
		// Display header menu
		get_template_part( 'partials/header/header-nav' ); ?>

	</header><!-- .pwd-site-header -->

</div><!-- .pwd-site-header-wrap -->