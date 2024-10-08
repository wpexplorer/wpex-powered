<?php
/**
 * Single post layout
 *
 * @package   Powered WordPress Theme
 * @author    WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article class="pwd-post-article"<?php pwd_schema_markup( 'blog_post' ); ?>>

	<?php
	// Entry media should display only if not protected
	if ( ! post_password_required() && has_post_thumbnail() && pwd_show_post_thumbnail() ) :

		get_template_part( 'partials/post/thumbnail' );

	endif;

	// Display post share
	if ( pwd_has_social_share() ) :

		get_template_part( 'partials/post/share' );

	endif;

	// Display post header
	get_template_part( 'partials/post/header' );

	// Display post content
	get_template_part( 'partials/post/content' );

	// Display post links
	get_template_part( 'partials/global/link-pages' );

	// Display post tags
	if ( pwd_get_theme_mod( 'post_tags', true ) ) :

		get_template_part( 'partials/post/tags' );

	endif;

	// Display post edit link
	get_template_part( 'partials/global/edit' );

	// Display post author
	if ( pwd_has_author_bio() ) :

		get_template_part( 'partials/post/author' );

	endif;

	// Display post nav (next/prev)
	if ( pwd_get_theme_mod ( 'post_next_prev', true ) ) {

		get_template_part( 'partials/post/navigation' );

	}

	// Display related posts
	if ( pwd_get_theme_mod( 'post_related', true ) ) :

		get_template_part( 'partials/post/related' );

	endif;

	// Display comments
	if ( pwd_get_theme_mod( 'comments_on_posts', true ) ) :

		comments_template();

	endif; ?>

</article><!-- .pwd-port-article -->