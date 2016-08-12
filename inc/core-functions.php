<?php
/**
 * Core functions used for the theme
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.stplorer.com
 * @since     1.0.0
 */

/**
 * Returns theme mod
 *
 * @since 1.0.0
 */
function pwd_get_theme_mod( $key, $default = '' ) {
	return get_theme_mod( 'pwd_'. $key, $default );
}

/**
 * Echos theme mod
 *
 * @since 1.0.0
 */
function pwd_theme_mod( $key, $default = '' ) {
	echo pwd_get_theme_mod( $key, $default );
}


/**
 * Returns meta prefix - so if you switch to another WPExplorer theme
 * you can keep your meta settings via simple filter
 *
 * @since 1.0.0
 */
function pwd_meta_prefix() {
	$prefix = pwd_get_theme_mod( 'meta_prefix' );
	$prefix = $prefix ? $prefix : 'wpex_';
	return apply_filters( 'pwd_meta_prefix', $prefix );
}

/**
 * Returns theme image sizes
 *
 * @since 3.1.1
 */
function pwd_get_image_sizes() {
	return apply_filters( 'pwd_get_image_sizes', array(
		'entry'         => esc_html__( 'Entry', 'powered' ),
		'post'          => esc_html__( 'Single Post (if enabled)', 'powered' ),
		'entry_related' => esc_html__( 'Related Entries', 'powered' ),
	) );
}

/**
 * Returns correct ID for any object
 * Used to fix issues with translation plugins such as WPML
 *
 * @since 3.1.1
 */
function pwd_parse_obj_id( $id = '', $type = 'page' ) {
	if ( $id && function_exists( 'icl_object_id' ) ) {
		$id = icl_object_id( $id, $type );
	}
	return $id;
}

/**
 * Array of image crop locations
 *
 * @link 2.0.0
 */
function pwd_image_crop_locations() {
	return array(
		' '             => esc_html__( 'Default', 'powered' ),
		'left-top'      => esc_html__( 'Top Left', 'powered' ),
		'right-top'     => esc_html__( 'Top Right', 'powered' ),
		'center-top'    => esc_html__( 'Top Center', 'powered' ),
		'left-center'   => esc_html__( 'Center Left', 'powered' ),
		'right-center'  => esc_html__( 'Center Right', 'powered' ),
		'center-center' => esc_html__( 'Center Center', 'powered' ),
		'left-bottom'   => esc_html__( 'Bottom Left', 'powered' ),
		'right-bottom'  => esc_html__( 'Bottom Right', 'powered' ),
		'center-bottom' => esc_html__( 'Bottom Center', 'powered' ),
	);
}

/**
 * Parse image crop option and returns correct value for add_image_size
 *
 * @link 2.0.0
 */
function pwd_parse_image_crop( $crop = 'true' ) {
	$return = true;
	if ( 'false' == $crop ) {
		return false;
	}
	if ( $crop && is_string( $crop ) && array_key_exists( $crop, pwd_image_crop_locations() ) ) {
		$return = explode( '-', $crop );
	}
	$return = $return ? $return : false; // default is false
	return $return;
}

/**
 * Get first post with featured image in current query
 *
 * @since 1.0.0
 */
function pwd_get_first_post_with_thumb( $query = '' ) {
	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}
	$posts = $query->posts;
	$posts_count = count( $posts );
	if ( $posts_count == 0 ) {
		return;
	}
	$post_with_thumb = 0;
	foreach ( $posts as $post ) {
		if ( has_post_thumbnail( $post->ID ) ) {
			$post_with_thumb = $post->ID;
			break;
		}
	}
	return $post_with_thumb;
}

/**
 * Returns correct header logo src
 *
 * @since 1.0.0
 */
function pwd_get_header_logo_src() {
	return apply_filters( 'pwd_header_logo_src', pwd_get_theme_mod( 'logo' ) );
}

/**
 * Returns escaped post title
 *
 * @since 1.0.0
 */
function pwd_get_esc_title() {
	return esc_attr( the_title_attribute( 'echo=0' ) );
}

/**
 * Outputs escaped post title
 *
 * @since 1.0.0
 */
function pwd_esc_title() {
	echo pwd_get_esc_title();
}

/**
 * Returns current page or post ID
 *
 * @since 1.0.0
 */
function pwd_get_the_id() {

	// If singular get_the_ID
	if ( is_singular() ) {
		return get_the_ID();
	}

	// Get ID of WooCommerce product archive
	elseif ( is_post_type_archive( 'product' ) && class_exists( 'Woocommerce' ) && function_exists( 'wc_get_page_id' ) ) {
		$shop_id = wc_get_page_id( 'shop' );
		if ( isset( $shop_id ) ) {
			return wc_get_page_id( 'shop' );
		}
	}

	// Posts page
	elseif ( is_home() && $page_for_posts = get_option( 'page_for_posts' ) ) {
		return $page_for_posts;
	}

	// Return nothing
	else {
		return NULL;
	}

}

/**
 * Returns current page or post layout
 *
 * @since 1.0.0
 */
function pwd_get_loop_columns( $current_query = 'archive' ) {

	// Check URL
	if ( ! empty( $_GET['columns'] ) ) {
		return intval( $_GET['columns'] );
	}

	// Get post ID
	$post_id = pwd_get_the_id();

	// Get theme mod setting
	if ( 'related' == $current_query ) {
		$columns = pwd_get_theme_mod( 'related_entry_columns', '3' );
	} else {
		$columns = pwd_get_theme_mod( 'entry_columns', '3' );
	}

	// Apply filters
	$columns = apply_filters( 'pwd_loop_columns', $columns );

	// Sanitize
	$columns = $columns ? $columns : 3;

	// Return layout
	return intval( $columns );

}

/**
 * Returns current page or post layout
 *
 * @since 1.0.0
 */
function pwd_get_post_layout() {

	// Check URL
	if ( ! empty( $_GET['layout'] ) ) {
		return esc_html( $_GET['layout'] );
	}

	// Get post ID
	$post_id = pwd_get_the_id();

	// Set default layout
	$layout = 'right-sidebar';

	// Homepage
	if ( is_home() || is_front_page() ) {
		$layout = pwd_get_theme_mod( 'home_layout', 'full-width' );
	}

	// Posts
	elseif ( is_page() ) {
		$layout = pwd_get_theme_mod( 'page_layout' );
	}

	// Posts
	elseif ( is_singular() ) {
		$layout = pwd_get_theme_mod( 'post_layout' );
	}

	// Full-width pages
	if ( is_404() ) {
		$layout = 'full-width';
	}

	// Search
	elseif ( is_search() ) {
		$layout = pwd_get_theme_mod( 'search_layout', 'full-width' );
	}

	// Archive
	elseif ( is_archive() ) {
		$layout = pwd_get_theme_mod( 'archives_layout', 'full-width' );
	}

	// Apply filters
	$layout = apply_filters( 'pwd_post_layout', $layout );

	// Check meta
	$mprefix = pwd_meta_prefix();
	if ( $meta = get_post_meta( pwd_get_the_id(), $mprefix .'post_layout', true ) ) {
		$layout = $meta;
	}

	// Sanitize
	$layout = $layout ? $layout : 'right-sidebar';

	// Return layout
	return $layout;

}

/**
 * Returns entry image size
 *
 * @since 1.0.0
 */
function pwd_get_entry_image_size( $current_query = 'archive' ) {
	if ( 'related' == $current_query ) {
		$size = 'pwd_entry_related';
	} else {
		$size = 'pwd_entry';
	}
	return esc_html( apply_filters( 'pwd_get_entry_image_size', $size ) );
}

/**
 * Returns featured entry image size
 *
 * @since 1.0.0
 */
function pwd_get_featured_entry_image_size() {
	return esc_html( apply_filters( 'pwd_get_featured_entry_image_size', 'pwd_post' ) );
}

/**
 * Returns target blank
 *
 * @since 1.0.0
 */
function pwd_get_target_blank( $display = false ) {
	if ( $display ) {
		return ' target="_blank"';
	}
}

/**
 * Echos target blank
 *
 * @since 1.0.0
 */
function pwd_target_blank( $display = false ) {
	echo pwd_get_target_blank( $display );
}

/**
 * Sanitizes data
 *
 * @since 1.0.0
 */
function pwd_sanitize( $data = '', $type = null ) {

	// Advertisement
	if ( 'advertisement' == $type ) {
		return $data;
	}

	// URL
	elseif ( 'url' == $type ) {
		$data = esc_url( $data );
	}

	// CSS
	elseif ( 'css' == $type ) {
		$data = $data; // nothing yet
	}

	// Image
	elseif ( 'img' == $type || 'image' == $type ) {
		$data = wp_kses( $data, array(
			'img'       => array(
				'src'   => array(),
				'alt'   => array(),
				'title' => array(),
				'data'  => array(),
				'id'    => array(),
				'class' => array(),
			),
		) );
	}

	// Link
	elseif ( 'link' == $type ) {
		$data = wp_kses( $data, array(
			'a'         => array(
				'href'  => array(),
				'title' => array(),
				'rel'   => array(),
				'class' => array(),
				'data'  => array(),
				'id'    => array(),
			),
		) );
	}

	// HTML
	elseif ( 'html' == $type ) {
		$data = htmlspecialchars_decode( wp_kses_post( $data ) );
	}

	// Videos
	elseif ( 'video' == $type || 'audio' == $type || 'embed' ) {
		$data = wp_kses( $data, array(
			'iframe' => array(
				'src'               => array(),
				'type'              => array(),
				'allowfullscreen'   => array(),
				'allowscriptaccess' => array(),
				'height'            => array(),
				'width'             => array()
			),
			'embed' => array(
				'src'               => array(),
				'type'              => array(),
				'allowfullscreen'   => array(),
				'allowscriptaccess' => array(),
				'height'            => array(),
				'width'             => array()
			),
		) );
	}

	// Apply filters and return
	return apply_filters( 'pwd_sanitize', $data );

}

/**
 * Checks a custom field value and returns the type (embed, oembed, etc )
 *
 * @since 1.0.0
 */
function pwd_check_meta_type( $value ) {
	if ( strpos( $value, 'embed' ) ) {
		return 'embed';
	} elseif ( strpos( $value, 'iframe' ) ) {
		return 'iframe';
	} else {
		return 'url';
	}
}

/**
 * Custom menu walker
 * 
 * @link  http://codex.wordpress.org/Class_Reference/Walker_Nav_Menu
 * @since 1.0.0
 */
if ( ! class_exists( 'Powered_Dropdown_Walker_Nav_Menu' ) ) {
	class Powered_Dropdown_Walker_Nav_Menu extends Walker_Nav_Menu {
		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( ! empty( $children_elements[$element->$id_field] ) && ( $depth == 0 ) ) {
				$element->title .= ' <span class="fa fa-caret-down pwd-dropdown-arrow-down"></span>';
			}
			if ( ! empty( $children_elements[$element->$id_field] ) && ( $depth > 0 ) ) {
				$element->title .= ' <span class="fa fa-caret-right pwd-dropdown-arrow-side"></span>';
			}
			Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
	}
}

/**
 * Custom comments callback
 * 
 * @link  http://codex.wordpress.org/Function_Reference/wp_lipwd_comments
 * @since 1.0.0
 */
if ( ! function_exists( 'pwd_comment' ) ) {
	function pwd_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				// Display trackbacks differently than normal comments. ?>
				<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<p><strong><?php esc_html_e( 'Pingback:', 'powered' ); ?></strong> <?php comment_author_link(); ?></p>
			<?php
			break;
			default :
				// Proceed with normal comments. ?>
				<li id="li-comment-<?php comment_ID(); ?>">
					<div id="comment-<?php comment_ID(); ?>" <?php comment_class( 'pwd-clr' ); ?>>
						<div class="comment-author vcard">
							<?php
							// Display avatar
							$avatar_size = apply_filters( 'pwd_comments_avatar_size', 45 );
							echo get_avatar( $comment, $avatar_size ); ?>
						</div><!-- .comment-author -->
						<div class="comment-details pwd-clr">
							<header class="comment-meta">
								<cite class="fn"><?php comment_author_link(); ?></cite>
								<span class="comment-date"><?php
									printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
										esc_url( get_comment_link( $comment->comment_ID ) ),
										get_comment_time( 'c' ),
										sprintf( _x( '%1$s', '1: date', 'powered' ), get_comment_date() )
								); ?></span><!-- .comment-date -->
								<?php
								// Comment reply link
								if ( '0' != $comment->comment_approved ) {
									comment_reply_link( array_merge( $args, array(
										'reply_text'    => esc_html__( 'Reply', 'powered' ) . '',
										'depth'         => $depth,
										'max_depth'     => $args['max_depth']
									) ) );
								} ?>
							</header><!-- .comment-meta -->
							<?php if ( '0' == $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation">
									<?php esc_html_e( 'Your comment is awaiting moderation.', 'powered' ); ?>
								</p><!-- .comment-awaiting-moderation -->
							<?php endif; ?>
							<div class="comment-content pwd-entry pwd-clr">
								<?php comment_text(); ?>
							</div><!-- .comment-content -->
							<footer class="comment-footer pwd-clr">
								<?php
								// Edit comment link
								edit_comment_link( esc_html__( 'Edit', 'powered' ), '<div class="edit-comment">', '</div>' ); ?>
							</footer>
						</div><!-- .comment-details -->
					</div><!-- #comment-## -->
			<?php
			break;
		endswitch;
	}
}

/**
 * Returns correct entry excerpt length
 * 
 * @since 1.0.0
 */
function pwd_get_entry_excerpt_length() {
	if ( isset( $_GET['excerpt_length'] ) ) {
		return esc_html( $_GET['excerpt_length'] );
	}
	return pwd_get_theme_mod( 'entry_excerpt_length', 14 );
}

/**
 * Custom excerpts based on wp_trim_words
 * Created for child-theming purposes
 * 
 * @link  http://codex.wordpress.org/Function_Reference/wp_trim_words
 * @since 1.0.0
 */
function pwd_get_excerpt( $length = '', $readmore = false ) {

	// Get excerpt length
	$length = $length ? $length : pwd_get_entry_excerpt_length();

	// Get global post data
	global $post;

	// Check for custom excerpt
	if ( has_excerpt( $post->ID ) ) {
		$output = $post->post_excerpt;
	}

	// No custom excerpt...so lets generate one
	else {

		// Redmore text
		$readmore_text = get_theme_mod( 'entry_readmore_text', esc_html__( 'read more', 'powered' ) );

		// Readmore link
		$readmore_link = '<a href="'. get_permalink( $post->ID ) .'" title="'. $readmore_text .'">'. $readmore_text .'<span class="pwd-readmore-rarr">&rarr;</span></a>';

		// Check for more tag and return content if it exists
		if ( ! pwd_get_theme_mod( 'disable_more_tag', false ) && strpos( $post->post_content, '<!--more-->' ) ) {
			$output = apply_filters( 'the_content', get_the_content() );
		}

		// No more tag defined so generate excerpt using wp_trim_words
		else {

			// Generate excerpt
			$output = wp_trim_words( strip_shortcodes( get_the_content( $post->ID ) ), $length );

			// Add readmore to excerpt if enabled
			if ( $readmore == true ) {
				$output .= apply_filters( 'pwd_readmore_link', $readmore_link );
			}

		}

	}

	// Apply filters and echo
	return apply_filters( 'pwd_get_excerpt', $output );

}

/**
 * Echos custom excerpt
 *
 * @since 1.0.0
 */
function pwd_excerpt( $length = '', $readmore = false ) {
	echo pwd_get_excerpt( $length, $readmore );
}

/**
 * Includes correct template part
 *
 * @since 1.0.0
 */
function pwd_include_template( $template ) {

	// Return if no template is defined
	if ( ! $template ) {
		return;
	}

	// Locate template
	$template = locate_template( $template, false );

	// Load template if it exists
	if ( $template ) {
		include( $template );
	}

}

/**
 * List categories for specific taxonomy
 * 
 * @link    http://codex.wordpress.org/Function_Reference/wp_get_post_terms
 * @since   1.0.0
 */
if ( ! function_exists( 'pwd_get_post_terms' ) ) {

	function pwd_get_post_terms( $taxonomy = 'category', $first_only = false, $classes = '' ) {

		// Define return var
		$return = array();

		// Get terms
		$terms = wp_get_post_terms( get_the_ID(), $taxonomy );

		// Loop through terms and create array of links
		foreach ( $terms as $term ) {

			// Add classes
			$add_classes = 'pwd-term-'. $term->term_id;
			if ( $classes ) {
				$add_classes .= ' '. $classes;
			}
			if ( $add_classes ) {
				$add_classes = ' class="'. $add_classes .'"';
			}

			// Get permalink
			$permalink = get_term_link( $term->term_id, $taxonomy );

			// Add term to array
			$return[] = '<a href="'. esc_url( $permalink ) .'" title="'. $term->name .'"'. $add_classes .'>'. $term->name .'</a>';

		}

		// Return if no terms are found
		if ( ! $return ) {
			return;
		}

		// Return first category only
		if ( $first_only ) {
			
			$return = $return[0];

		}

		// Turn terms array into comma seperated list
		else {

			$return = implode( '', $return );

		}

		// Return or echo
		return $return;

	}

}

/**
 * Echos the pwd_lipwd_post_terms function
 * 
 * @since 1.0.0
 */
function pwd_post_terms( $taxonomy = 'category', $first_only = false, $classes = '' ) {
	echo pwd_get_post_terms( $taxonomy, $first_only, $classes );
}

/**
 * List categories for specific taxonomy without links
 * 
 * @link    http://codex.wordpress.org/Function_Reference/wp_get_post_terms
 * @since   1.0.0
 */
if ( ! function_exists( 'pwd_get_post_terms_list' ) ) {

	function pwd_get_post_terms_list( $taxonomy = 'category', $first_only = false, $classes = '' ) {

		// Define return var
		$return = array();

		// Get terms
		$terms = wp_get_post_terms( get_the_ID(), $taxonomy );

		// Loop through terms and create array of links
		foreach ( $terms as $term ) {

			// Add classes
			$add_classes = 'pwd-term-'. $term->term_id;
			if ( $classes ) {
				$add_classes .= ' '. $classes;
			}
			if ( $add_classes ) {
				$add_classes = ' class="'. $add_classes .'"';
			}

			// Get permalink
			$permalink = get_term_link( $term->term_id, $taxonomy );

			// Add term to array
			$return[] = '<span'. $add_classes .'>'. $term->name .'</span>';

		}

		// Return if no terms are found
		if ( ! $return ) {
			return;
		}

		// Return first category only
		if ( $first_only ) {
			
			$return = $return[0];

		}

		// Turn terms array into comma seperated list
		else {

			$return = implode( '', $return );

		}

		// Return or echo
		return $return;

	}

}

/**
 * Echos the pwd_get_post_terms_list function
 * 
 * @since 1.0.0
 */
function pwd_post_terms_list( $taxonomy = 'category', $first_only = false, $classes = '' ) {
	echo pwd_get_post_terms( $taxonomy, $first_only, $classes );
}

/**
 * Returns thumbnail sizes
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes
 */
function pwd_get_thumbnail_sizes( $size = '' ) {

	global $_wp_additional_image_sizes;

	$sizes = array(
		'full'  => array(
		'width'  => '9999',
		'height' => '9999',
		'crop'   => 0,
		),
	);
	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	// Create the full array with sizes and crop info
	foreach( $get_intermediate_image_sizes as $_size ) {

		if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

			$sizes[ $_size ]['width']   = get_option( $_size . '_size_w' );
			$sizes[ $_size ]['height']  = get_option( $_size . '_size_h' );
			$sizes[ $_size ]['crop']    = (bool) get_option( $_size . '_crop' );

		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

			$sizes[ $_size ] = array( 
				'width'     => $_wp_additional_image_sizes[ $_size ]['width'],
				'height'    => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop'      => $_wp_additional_image_sizes[ $_size ]['crop']
			);

		}

	}

	// Get only 1 size if found
	if ( $size ) {
		if ( isset( $sizes[ $size ] ) ) {
			return $sizes[ $size ];
		} else {
			return false;
		}
	}

	// Return sizes
	return $sizes;
}

/**
 * Returns post video
 *
 * @since 1.0.0
 */
function pwd_get_post_video( $post_id = '' ) {

	// Get post id
	$post_id = $post_id ? $post_id : get_the_ID();

	// Meta prefix
	$mprefix = pwd_meta_prefix();

	// Get video
	$video = get_post_meta( $post_id, $mprefix .'post_video', true );
	$video = apply_filters( 'pwd_post_video', $video );

	// Display video if defined
	if ( $video ) :

		// Check what type of video it is
		$type = pwd_check_meta_type( $video );

		// Standard Embeds
		if ( 'iframe' == $type || 'embed' == $type ) {
			return pwd_sanitize( $video, 'video' );
		}
		// Oembeds
		elseif ( $embed = wp_oembed_get( $video ) ) {
			return $embed;
		}
		// Self hosted
		else {
			return do_shortcode( '[video src="'. $video .'"]' );
		}

	endif;
}

/**
 * Echo's post video
 *
 * @since 1.0.0
 */
function pwd_post_video( $post_id = '' ) {
	echo pwd_get_post_video( $post_id );
}

/**
 * Outputs post video
 *
 * @since 1.0.0
 */
function pwd_post_audio( $post_id = '' ) {

	// Get post id
	$post_id = $post_id ? $post_id : get_the_ID();

	// Meta prefix
	$mprefix = pwd_meta_prefix();

	// Get audio
	$audio = get_post_meta( $post_id, $mprefix .'post_audio', true );
	$audio = apply_filters( 'pwd_post_audio', $audio );

	// Display audio if defined
	if ( $audio ) :

		// Check what type of audio it is
		$type = pwd_check_meta_type( $audio );

		// Standard Embeds
		if ( 'iframe' == $type || 'embed' == $type ) {
			echo pwd_sanitize( $audio, 'audio' );
		}
		// Oembeds
		elseif ( $embed = wp_oembed_get( $audio ) ) {
			echo $embed;
		}
		// Self hosted
		else {
			echo do_shortcode( '[audio src="'. $audio .'"]' );
		}

	endif;
}

/**
 * Return correct Google font url
 *
 * @since 1.0.0
 */
function pwd_get_gfont_url( $font ) {

	// Sanitize handle
	$handle = trim( $font );
	$handle = strtolower( $handle );
	$handle = str_replace( ' ', '-', $handle );

	// Sanitize font name
	$font = trim( $font );
	$font = str_replace( ' ', '+', $font );

	// Subset
	$subset = apply_filters( 'pwd_google_font_subsets', 'latin' );
	$subset = $subset ? $subset : 'latin';
	$subset = '&amp;subset='. $subset;

	// Weights
	$weights = array( '100', '200', '300', '400', '500', '600', '700', '800', '900' );
	$weights = apply_filters( 'wpex_google_font_enqueue_weights', $weights, $font );
	$italics = apply_filters( 'wpex_google_font_enqueue_italics', true );

	// Google URl
	$gurl = esc_url( apply_filters( 'pwd_get_google_fonts_url', '//fonts.googleapis.com' ) );

	// Main URL
	$url = $gurl .'/css?family='. str_replace(' ', '%20', $font ) .':';

	// Add weights to URL
	if ( ! empty( $weights ) ) {
		$url .= implode( ',' , $weights );
		$italic_weights = array();
		if ( $italics ) {
			foreach ( $weights as $weight ) {
				$italic_weights[] = $weight .'italic';
			}
			$url .= implode( ',' , $italic_weights );
		}
	}

	// Add subset to URL
	$url .= $subset;

	// Return url
	return $url;

}

/**
 * Infinite scroll render function
 *
 * @since 1.0.0
 */
function pwd_infinite_scroll_render() {
	while( have_posts() ) {
		the_post();
		get_template_part( 'partials/layout-entry' );
	}
}

/**
 * Infinite scroll render function
 *
 * @since 1.0.0
 */
function pwd_masonry_settings( $location = 'archive' ) {

	// Get theme settings
	$layout_mode = pwd_get_theme_mod( 'grid_layout_mode' );
	if ( isset( $_GET['layout_mode'] ) ) {
		$layout_mode = esc_html( $_GET['layout_mode'] );
	}
	if ( $layout_mode && in_array( $layout_mode, array( 'masonry', 'fitRows' ) ) ) {
		$layout_mode = $layout_mode;
	} else {
		$layout_mode = 'fitRows';
	}

	// Custom location settings
	if ( 'related' == $location ) {
		$layout_mode = pwd_get_theme_mod( 'post_related_grid_layout_mode' );
		if ( $layout_mode && in_array( $layout_mode, array( 'masonry', 'fitRows' ) ) ) {
			$layout_mode = $layout_mode;
		} else {
			$layout_mode = 'masonry';
		}
	}

	// Apply filters
	$settings = apply_filters( 'pwd_masonry_settings', array(
		'itemSelector' => '.pwd-masonry-item',
		'originLeft'   => is_rtl() ? false : true,
		'layoutMode'   => $layout_mode,
	), $location );

	// Return settings
	return htmlentities( json_encode( $settings ) );

}

/**
 * Minify CSS
 *
 * @since 1.0.0
 */
function pwd_minify_css( $css ) {

	// Normalize whitespace
	$css = preg_replace( '/\s+/', ' ', $css );

	// Remove ; before }
	$css = preg_replace( '/;(?=\s*})/', '', $css );

	// Remove space after , : ; { } */ >
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

	// Remove space before , ; { }
	$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );

	// Strips leading 0 on decimal values (converts 0.5px into .5px)
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

	// Strips units if value is 0 (converts 0px to 0)
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

	// Return minified CSS
	return trim( $css );

}