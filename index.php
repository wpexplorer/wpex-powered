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
 * @author    WPExplorer.com
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

get_header(); ?>

	<div class="pwd-content-area">

		<main class="pwd-site-main">

			<?php
			// Display page header
			get_template_part( 'partials/archives/header' ); ?>

			<?php
			// Check if posts exist
			if ( have_posts() ) :

				$has_featured = pwd_archive_has_featured_post() && ( is_front_page() || is_archive() );
				$columns = pwd_get_loop_columns( 'archive' ) ?: '3';
				$pwd_count = 0;

					// Loop through posts
					while ( have_posts() ) : the_post();
						$pwd_count++;

						if ( 1 === $pwd_count ) {
							if ( $has_featured ) {
								get_template_part( 'partials/archives/featured-post', null, [ 'post_id' => get_the_ID() ] );
							}
							echo '<div id="pwd-grid" class="pwd-entries pwd-row pwd-row-cols-' . absint( $columns ) . '">';
						}

						if ( $pwd_count > 1 || ! $has_featured ) {
							get_template_part( 'partials/layout-entry' );
						}

					// End loop
					endwhile; ?>

				</div><!-- .pwd-entries -->

				<?php
				// Include pagination template part
				get_template_part( 'partials/global/pagination' ); ?>

			<?php
			// Display no posts found message
			else : ?>

				<?php get_template_part( 'partials/entry/none' ); ?>

			<?php endif; ?>

		</main><!-- .pwd-main -->

	</div><!-- .pwd-content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>