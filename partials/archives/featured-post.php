<?php
/**
 * Featured Post
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
}

// Get featured post
$featured_post = pwd_get_first_post_with_thumb();

if ( $featured_post ) : ?>

	<div class="pwd-featured-post pwd-clr">

		<a href="<?php the_permalink(); ?>" title="<?php pwd_esc_title(); ?>">

			<?php
			// Display featured image
			the_post_thumbnail( 'pwd_entry_featured' ); ?>

			<div class="pwd-featured-post-content pwd-clr">
				<h2><?php the_title(); ?></h2>
				<p><?php echo get_the_date(); ?></p>
				<?php
				// Get first cat
				if ( 'post' == get_post_type() ) :
					$cats = get_the_category();
					$cat  = $cats[0]; ?>
					<div class="pwd-featured-post-cat pwd-clr term-<?php echo esc_attr( $cat->term_id ); ?>"><?php echo esc_html( $cat->name );  ?></div>
				<?php endif; ?>
			</div><!-- .pwd-featured-post-content -->
			
		</a>

	</div><!-- .pwd-featured-post -->

<?php endif; ?>