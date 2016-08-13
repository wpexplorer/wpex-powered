<?php
/**
 * Used to output post meta info - date, category, comments, author...etc
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
				<li class="pwd-date"><span class="fa fa-clock-o"></span><time class="updated" datetime="<?php esc_attr( the_date( 'Y-m-d' ) ); ?>"<?php pwd_schema_markup( 'publish_date' ); ?>><?php echo get_the_date(); ?></time></li>
				<li class="pwd-sep"></li>
			<?php
			// Display author
			elseif ( 'author' == $meta_item ) : ?>
				<li class="pwd-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><span class="fa fa-user"></span><?php the_author(); ?></a></li>
				<li class="pwd-sep"></li>
			<?php
			// Display category
			elseif ( 'category' == $meta_item && 'post' == get_post_type() ) : ?>
				<li class="pwd-categories"><span class="fa fa-folder"></span><?php echo the_category( ', ' ); ?></li>
				<li class="pwd-sep"></li>
			<?php
			// Display comments
			elseif ( 'comments' == $meta_item && comments_open() && pwd_has_comments() && ! post_password_required() ) :
				$icon = '<span class="fa fa-comments" aria-hidden="true"></span>'; ?>
				<li class="pwd-comments"><?php comments_popup_link( $icon . esc_html__( '0 Comments', 'powered' ), $icon . esc_html__( '1 Comment',  'powered' ), $icon . esc_html__( '% Comments', 'powered' ), 'comments-link' ); ?></li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</div><!-- .pwd-meta -->