<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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

			<?php
			// Display page header
			get_template_part( 'partials/archives/header' ); ?>

			<?php
			// Featured post
			if ( pwd_archive_has_featured_post() && ( is_front_page() || is_archive() ) ) :

				get_template_part( 'partials/archives/featured-post' );

			endif; ?>

			<?php
			// Check if posts exist
			if ( have_posts() ) : ?>

				<div id="pwd-grid" class="pwd-entries pwd-row pwd-clr" data-settings="<?php echo pwd_masonry_settings(); ?>">   

					<?php
					// Set counter
					$pwd_count = 0;

					// Get query
					global $wp_query;

					// Loop through posts
					while ( have_posts() ) : the_post();

						// Exclude featured post
						if ( get_the_ID() == pwd_get_first_post_with_thumb() ) {
							continue;
						}

						// Display post entry
						get_template_part( 'partials/layout-entry' );

					// End loop
					endwhile; ?>

				</div><!-- .pwd-entries -->

				<?php
				// Include pagination template part
				pwd_include_template( 'partials/global/pagination.php' ); ?>

			<?php
			// Display no posts found message
			else : ?>

				<?php get_template_part( 'partials/entry/none' ); ?>

			<?php endif; ?>

		</main><!-- .pwd-main -->

	</div><!-- .pwd-content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>