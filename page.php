<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.stplorer.com
 * @since     1.0.0
 */

get_header(); ?>

	<div class="pwd-content-area pwd-clr">

		<main class="pwd-site-main pwd-clr">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/layout-page' ); ?>

			<?php endwhile; ?>

		</main><!-- .pwd-site-main -->

	</div><!-- .pwd-content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>