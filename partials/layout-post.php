<?php
/**
 * Single post layout
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
} ?>

<article class="pwd-post-article pwd-clr"<?php pwd_schema_markup( 'blog_post' ); ?>>

	<?php
	// Entry media should display only if not protected
	if ( ! post_password_required() ) :

		// Display post video
		if ( pwd_has_post_video() ) :

			get_template_part( 'partials/post/video' );

		// Display post audio
		elseif ( pwd_has_post_audio() ) :

			get_template_part( 'partials/post/audio' );

		// Display post thumbnail
		elseif ( has_post_thumbnail() && pwd_show_post_thumbnail() ) :

			get_template_part( 'partials/post/thumbnail' );

		endif;

	endif;
	
	// Display post header
	get_template_part( 'partials/post/header' );

	// Display post share above post
	if ( pwd_has_social_share() ) :

		get_template_part( 'partials/global/share' );
	
	endif;
	
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

	// Display comments
	if ( pwd_get_theme_mod( 'comments_on_posts', true ) ) :

		comments_template();

	endif; ?>

</article><!-- .pwd-port-article -->