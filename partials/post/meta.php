<?php
/**
 * Used to output post meta info - date, category, comments, author...etc
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
}

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get items to display
$meta_items = array( 'date', 'author', 'category', 'comments' );
$meta_items	= array_combine( $meta_items, $meta_items );

// You can tweak the meta output via a function, yay!
$meta_items = apply_filters( 'pwd_meta_items', $meta_items ); ?>

<div class="pwd-meta pwd-post-meta pwd-clr">
	<ul class="pwd-clr">
		<?php
		// Loop through meta options
		foreach ( $meta_items as $meta_item ) :
			// Display date
			if ( 'date' == $meta_item ) : ?>
				<li class="pwd-date"><time class="updated" datetime="<?php esc_attr( the_date( 'Y-m-d' ) ); ?>"<?php pwd_schema_markup( 'publish_date' ); ?>><?php echo get_the_date(); ?></time></li>
				<li class="pwd-sep"></li>
			<?php
			// Display author
			elseif ( 'author' == $meta_item ) : ?>
				<li class="pwd-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>
				<li class="pwd-sep"></li>
			<?php
			// Display category
			elseif ( 'category' == $meta_item && 'post' == get_post_type() ) : ?>
				<li class="pwd-categories"><?php echo the_category( ', ' ); ?></li>
				<li class="pwd-sep"></li>
			<?php
			// Display comments
			elseif ( 'comments' == $meta_item && comments_open() && pwd_has_comments() && ! post_password_required() ) : ?>
				<li class="pwd-comments"><?php comments_popup_link( esc_html__( '0 Comments', 'wpex-powered' ), esc_html__( '1 Comment',  'wpex-powered' ), esc_html__( '% Comments', 'wpex-powered' ), 'comments-link' ); ?></li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</div><!-- .pwd-meta -->