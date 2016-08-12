<?php
/**
 * Used to output entry meta info - date, category, comments, author...etc
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

// Get items to display
$meta_items = array( 'date', 'category' );
$meta_items	= array_combine( $meta_items, $meta_items );
$meta_items = apply_filters( 'pwd_meta_items', $meta_items ); ?>

<div class="pwd-loop-entry-meta">
	<ul class="pwd-clr">
		<?php
		// Loop through meta options
		foreach ( $meta_items as $meta_item ) :
			// Display date
			if ( 'date' == $meta_item ) : ?>
				<li class="pwd-date"><span class="fa fa-clock-o" aria-hidden="true"></span><?php echo get_the_date(); ?></li>
			<?php
			// Display author
			elseif ( 'author' == $meta_item ) : ?>
				<li class="pwd-author"><span class="fa fa-user" aria-hidden="true"></span><?php the_author_posts_link(); ?></li>
			<?php
			// Display category
			elseif ( 'category' == $meta_item && 'post' == get_post_type() ) : ?>
				<li class="pwd-categories"><span class="fa fa-folder-open" aria-hidden="true"></span><?php echo pwd_get_post_terms( 'category', true ); ?></li>
			<?php
			// Display comments
			elseif ( 'comments' == $meta_item && comments_open() && pwd_has_comments() && ! post_password_required() ) :
				$icon = '<span class="fa fa-comments" aria-hidden="true"></span>'; ?>
				<li class="pwd-comments"><?php comments_popup_link( $icon . esc_html__( '0 Comments', 'powered' ), $icon . esc_html__( '1 Comment',  'powered' ), $icon . esc_html__( '% Comments', 'powered' ), 'comments-link' ); ?></li>
			<?php
			// Rating
			elseif ( 'rating' == $meta_item && $rating = get_post_meta( get_the_ID(), 'pwd_post_rating', true ) ) : ?>
				<li class="pwd-rating"><span><span class="fa fa-star" aria-hidden="true"></span><?php echo esc_html( $rating ); ?></span></li>
			<?php endif;
		endforeach; ?>
	</ul>
</div><!-- .pwd-loop-entry-meta -->