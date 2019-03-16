<?php
/**
 * Featured Post
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     2.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get featured post
$featured_post_id = pwd_get_first_post_with_thumb();

if ( $featured_post_id ) : ?>

	<div class="pwd-featured-post pwd-clr">

		<a href="<?php echo esc_url( get_permalink( $featured_post_id ) ); ?>" title="<?php echo esc_attr( get_the_title( $featured_post_id ) ); ?>">

			<?php
			// Display featured image
			echo get_the_post_thumbnail( $featured_post_id, 'pwd_entry_featured' ); ?>

			<div class="pwd-featured-post-content pwd-clr">
				<h2><?php echo esc_html( get_the_title( $featured_post_id ) ); ?></h2>
				<p><?php echo esc_html( get_the_date( '', $featured_post_id ) ); ?></p>
				<?php
				// Get first cat
				if ( 'post' == get_post_type( $featured_post_id ) ) :
					$cats = get_the_category( $featured_post_id );
					$cat  = $cats[0]; ?>
					<div class="pwd-featured-post-cat pwd-clr term-<?php echo esc_attr( $cat->term_id ); ?>"><?php echo esc_html( $cat->name );  ?></div>
				<?php endif; ?>
			</div><!-- .pwd-featured-post-content -->

		</a>

	</div><!-- .pwd-featured-post -->

<?php endif; ?>