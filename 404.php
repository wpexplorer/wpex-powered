<?php
/**
 * The template for the 404 not found page.
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

get_header(); ?>

	<div class="pwd-content-area pwd-clr">

		<main class="pwd-site-main pwd-clr">

			<?php get_template_part( 'partials/entry/none' ); ?>

		</main><!-- .pwd-site-main -->

	</div><!-- .pwd-content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>