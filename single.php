<?php
/**
 * The Template for displaying all single posts.
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.stplorer.com
 * @since     1.0.0
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="pwd-content-area pwd-clr">

			<main class="pwd-site-main pwd-clr">
				
				<?php get_template_part( 'partials/layout-post' ); ?>

			</main><!-- .pwd-main -->

		</div><!-- .pwd-content-area -->

	<?php endwhile; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>