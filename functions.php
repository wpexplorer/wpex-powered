<?php
/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package   Powered WordPress Theme
 * @author    WPExplorer.com
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

class Powered_Theme {

	/**
	 * Start things up
	 *
     * @since  1.0.0
     * @access public
	 */
	public function __construct() {

		// Add Filters
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
		add_filter( 'embed_oembed_html', array( $this, 'embed_oembed_html' ), 99, 4 );
		add_filter( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
		add_filter( 'manage_post_posts_columns', array( $this, 'posts_columns' ), 10 );
		add_filter( 'manage_page_posts_columns', array( $this, 'posts_columns' ), 10 );
		add_filter( 'use_default_gallery_style', array( $this, 'remove_gallery_styles' ) );
		add_filter( 'user_contactmethods', array( $this, 'user_fields' ) );
		add_filter( 'body_class', array( $this, 'body_classes' ) );
		add_filter( 'wp_nav_menu_items', array( $this, 'menu_add_items' ), 11, 2 );
		add_filter( 'comment_form_fields', array( $this, 'move_comment_form_fields' ) );
		add_filter( 'image_size_names_choose', array( $this, 'image_size_names_choose' ) );

		// Actions
		add_action( 'after_setup_theme', array( $this, 'load_files' ), 1 );
		add_action( 'after_setup_theme', array( $this, 'setup' ), 10 );
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_css' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_js' ) );
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'posts_custom_columns' ), 10, 2 );
		add_action( 'manage_pages_custom_column', array( $this, 'posts_custom_columns' ), 10, 2 );

		// Custom Widgets
		$this->load_custom_widgets();
	}

	/**
	 * Include functions and classes
	 *
     * @since  1.0.0
     * @access public
	 */
	public function load_files() {
		require_once get_parent_theme_file_path( '/inc/core-functions.php' );
		require_once get_parent_theme_file_path( '/inc/conditionals.php' );
		require_once get_parent_theme_file_path( '/inc/customizer-config.php' );
		require_once get_parent_theme_file_path( '/inc/meta-posts.php' );
		require_once get_parent_theme_file_path( '/inc/meta-pages.php' );
		require_once get_parent_theme_file_path( '/inc/schema.php' );
		require_once get_parent_theme_file_path( '/inc/classes/customizer/customizer.php' );
		require_once get_parent_theme_file_path( 'inc/translators-config.php' );
	}

	/**
	 * Include custom widgets
	 *
     * @since  1.0.0
     * @access public
	 */
	public function load_custom_widgets() {
		$widgets = apply_filters( 'pwd_theme_widgets', array(
			'recent-posts-thumbnails',
		) );
		foreach ( $widgets as $widget ) {
			require_once get_parent_theme_file_path( '/inc/classes/widgets/' . $widget . '.php'  );
		}
	}

	/**
	 * Functions called during each page load, after the theme is initialized
	 * Perform basic setup, registration, and init actions for the theme
	 *
     * @since  1.0.0
     * @access public
	 *
	 * @link   http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
	 */
	public function setup() {

		// Define content_width variable
		if ( ! isset( $content_width ) ) {
			$content_width = 745;
		}

		// Register navigation menus
		register_nav_menus ( array(
			'main' => esc_html__( 'Main', 'wpex-powered' ),
		) );

		// Localization support
		load_theme_textdomain( 'wpex-powered', get_template_directory() .'/languages' );

		// Add theme support
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'align-wide' );
		//add_theme_support( 'custom-header' );

		// Add image sizesg
		$get_image_sizes = pwd_get_image_sizes();
		if ( ! empty( $get_image_sizes ) ) {
			foreach ( $get_image_sizes as $size => $label ) {
				add_image_size(
					'pwd_'. $size,
					pwd_get_theme_mod( $size .'_thumb_width', '9999' ),
					pwd_get_theme_mod( $size .'_thumb_height', '9999' ),
					pwd_parse_image_crop( pwd_get_theme_mod( $size .'_thumb_crop', 'false' ) )
				);
			}
		}

		// Add support for page excerpts
		add_post_type_support( 'page', 'excerpt' );

	}

	/**
	 * Load custom CSS scripts in the front end
	 *
     * @since  1.0.0
     * @access public
     *
     * @link   https://codex.wordpress.org/Function_Reference/wp_enqueue_style
	 */
	public function theme_css() {

		// Define css directory
		$css_dir_uri = get_template_directory_uri() .'/css/';

		// Define inline style handle
		$style_handle = apply_filters( 'pwd_style_handle', 'style' );

		// Main CSS
		wp_enqueue_style( 'style', get_stylesheet_uri() );

		// Advanced styles
		$advanced_styles = $this->advanced_styles();
		if ( $advanced_styles ) {
			$advanced_styles = pwd_minify_css( $advanced_styles );
			wp_add_inline_style( $style_handle, $advanced_styles );
		}

	}

	/**
	 * Load custom JS scripts in the front end
	 *
     * @since  1.0.0
     * @access public
     *
	 * @link   https://codex.wordpress.org/Function_Reference/wp_enqueue_script
	 */
	public function theme_js() {

		// Define js directory
		$js_dir_uri = get_template_directory_uri() .'/js/';

		// Comment reply
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Localize scripts
		$localize = apply_filters( 'pwd_localize', array(
			'mobileSiteMenuLabel' => '<span class="pwd-svg" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg></span><span class="screen-reader-text">' . esc_html__( 'toggle mobile menu', 'wpex-powered' ) . '</span>',
		) );

		// Load 3rd party scripts
		wp_enqueue_script( 'slicknav', $js_dir_uri .'plugins/jquery.slicknav.js', array( 'jquery' ), false, true );

		// Theme functions
		wp_enqueue_script( 'pwd-js', $js_dir_uri .'functions.js', array( 'jquery' ), false, true );
		wp_localize_script( 'pwd-js', 'pwdLocalize', $localize );
	}

	/**
	 * Registers the theme sidebars
	 *
     * @since  1.0.0
     * @access public
	 *
	 * @link   http://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	public function register_sidebars() {

		// Sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar - Main', 'wpex-powered' ),
			'id'            => 'sidebar',
			'before_widget' => '<div class="pwd-sidebar-widget widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		// Sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar - Pages', 'wpex-powered' ),
			'id'            => 'sidebar_pages',
			'before_widget' => '<div class="pwd-sidebar-widget widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		// Get footer columns
		$cols = pwd_get_theme_mod( 'footer_widget_columns', 4 );

		// Footer 1
		if ( $cols >= 1 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 1', 'wpex-powered' ),
				'id'            => 'footer-one',
				'before_widget' => '<div class="footer-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			) );

		}

		// Footer 2
		if ( $cols > 1 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 2', 'wpex-powered' ),
				'id'            => 'footer-two',
				'before_widget' => '<div class="footer-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			) );

		}

		// Footer 3
		if ( $cols > 2 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 3', 'wpex-powered' ),
				'id'            => 'footer-three',
				'before_widget' => '<div class="footer-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			) );

		}

		// Footer 4
		if ( $cols > 3 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 4', 'wpex-powered' ),
				'id'            => 'footer-four',
				'before_widget' => '<div class="footer-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			) );

		}

	}

	/**
	 * Adds classes to the body_class function
	 *
     * @since  1.0.0
     * @access public
	 *
	 * @link   http://codex.wordpress.org/Function_Reference/body_class
	 */
	public function body_classes( $classes ) {
		$classes[] = pwd_get_post_layout();
		return $classes;
	}

	/**
	 * Return custom excerpt more string
	 *
     * @since  1.0.0
     * @access public
	 *
	 * @link   http://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_more
	 */
	public function excerpt_more( $more ) {
		return $more;
	}

	/**
	 * Alters the default oembed output
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @link   https://developer.wordpress.org/reference/hooks/embed_oembed_html/
	 */
	public function embed_oembed_html( $html, $url, $attr, $post_id ) {
		return '<div class="pwd-responsive-embed">' . $html . '</div>';
	}

	/**
	 * Alter the main query
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @link   http://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
	 */
	public function pre_get_posts( $query ) {
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		// Alter search results
		if ( pwd_get_theme_mod( 'search_posts_only', true )
			&& $query->is_search()
		) {
			$post_type_query_var = false;
			if ( ! empty( $_GET[ 'post_type' ] ) ) {
				$post_type_query_var = true;
			}
			if ( ! $post_type_query_var ) {
				$query->set( 'post_type', array( 'post' ) );
			}
		}

		// Alter posts per page
		if ( ! empty( $_GET['posts_per_page'] ) ) {
			return $query->set( 'posts_per_page', absint( $_GET['posts_per_page'] ) );
		}
	}

	/**
	 * Adds new "Featured Image" column to the WP dashboard
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @link   http://codex.wordpress.org/Plugin_API/Filter_Reference/manage_posts_columns
	 */
	public function posts_columns( $defaults ) {
		$defaults['pwd_post_thumbs'] = esc_html__( 'Featured Image', 'wpex-powered' );
		return $defaults;
	}

	/**
	 * Display post thumbnails in WP admin
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @link   http://codex.wordpress.org/Plugin_API/Filter_Reference/manage_posts_columns
	 */
	public function posts_custom_columns( $column_name, $id ) {
		$id = get_the_ID();
		if ( $column_name != 'pwd_post_thumbs' ) {
			return;
		}
		if ( has_post_thumbnail( $id ) ) {
			$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'thumbnail', false );
			if( ! empty( $img_src[0] ) ) { ?>
					<img src="<?php echo esc_url( $img_src[0] ); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" style="max-width:100%;max-height:90px;" />
				<?php
			}
		} else {
			echo '&mdash;';
		}
	}

	/**
	 * Remove gallery styles
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @link   https://developer.wordpress.org/reference/hooks/use_default_gallery_style/
	 */
	public function remove_gallery_styles() {
		return false;
	}

	/**
	 * Add new user fields
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @link   http://codex.wordpress.org/Plugin_API/Filter_Reference/user_contactmethods
	 */
	public function user_fields( $contactmethods ) {

		// Add Twitter
		if ( ! isset( $contactmethods['pwd_twitter'] ) ) {
			$contactmethods['wpex_twitter'] = 'Powered - Twitter';
		}

		// Add Facebook
		if ( ! isset( $contactmethods['pwd_facebook'] ) ) {
			$contactmethods['wpex_facebook'] = 'Powered - Facebook';
		}

		// Add LinkedIn
		if ( ! isset( $contactmethods['pwd_linkedin'] ) ) {
			$contactmethods['wpex_linkedin'] = 'Powered - LinkedIn';
		}

		// Add Pinterest
		if ( ! isset( $contactmethods['pwd_pinterest'] ) ) {
			$contactmethods['wpex_pinterest'] = 'Powered - Pinterest';
		}

		// Add Pinterest
		if ( ! isset( $contactmethods['pwd_instagram'] ) ) {
			$contactmethods['wpex_instagram'] = 'Powered - Instagram';
		}

		// Return contactmethods
		return $contactmethods;
	}

	/**
	 * Adds extra CSS to the head based on customizer settings
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function advanced_styles() {
		$style_handle = apply_filters( 'pwd_style_handle', 'style' );
		$css = '';

		// Container width
		$width = pwd_get_theme_mod( 'layout_container_width' );
		if ( $width && strpos( $width, '%' ) == false ) {
			$width = intval( $width );
			$width = $width ? $width .'px' : null;
		}
		if ( $width ) {
			$css .= '.pwd-container { width: '. $width .'; }.pwd-content-area, .pwd-sidebar { max-width: none; }';
		}

		// Content width
		$width = $this->px_pct( pwd_get_theme_mod( 'layout_content_width' ) );
		if ( $width ) {
			$css .= '.pwd-content-area { width: '. $width .'; max-width: none; }';
		}

		// Sidebar width
		$width = $this->px_pct( pwd_get_theme_mod( 'layout_sidebar_width' ) );
		if ( $width ) {
			$css .= '.pwd-sidebar { width: '. $width .'; max-width: none; }';
		}

		// Container Max Width
		$width = intval( pwd_get_theme_mod( 'layout_container_max_width' ) );
		if ( $width && '85' !== $width ) {
			$css .= '.pwd-responsive .pwd-container { max-width: '. $width .'%; }';
		}

		// Customizer CSS
		if ( class_exists( 'Powered_Customizer' ) ) {

			// Customizer loop
			$c_loop = Powered_Customizer::loop_through_settings();

			// Customizer styling CSS
			if ( ! empty( $c_loop['css'] ) ) {
				$c_loop_css = pwd_minify_css( $c_loop['css'] );
				wp_add_inline_style( $style_handle, $c_loop_css );
			}

		}

		// Header height
		$header_height = intval( pwd_get_theme_mod( 'header_height' ) );
		if ( $header_height ) {
			$css .= ':root{--pwd-header-height:' . esc_attr( $header_height ) . 'px}';
		}

		// Minify CSS
		$css = pwd_minify_css( $css );

		// Return css
		return $css;
	}


	/**
     * Returns a Pixel or Percent
     *
	 * @since  1.0.0
	 * @access private
	 *
     */
    private function px_pct( $data ) {
        if ( 'none' == $data || '0px' == $data ) {
            return '0';
        } elseif ( strpos( $data, '%' ) ) {
            return $data;
        } elseif ( strpos( $data , '&#37;' ) ) {
        	return $data;
        } elseif ( $data = floatval( $data ) ) {
            return $data .'px';
        }
    }

	/**
	 * Adds extra items to the end of the main menu
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @link   http://codex.wordpress.org/Function_Reference/wp_get_nav_menu_items
	 */
	public function menu_add_items( $items, $args ) {
		if ( 'main' != $args->theme_location ) {
			return $items;
		}
		$search_li = '<li class="menu-item pwd-search-toggle">';
			$search_li .= '<a href="#" aria-role="button" aria-label="' . esc_attr__( 'toggle site search', 'wpex-powered' ) . '">';
				$search_li .= '<span class="link-inner">';
					$search_li .= '<span class="pwd-svg" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg></span>';
				$search_li .= '</span>';
			$search_li .= '</a>';
		$search_li .= '</li>';
		return $items . $search_li;
	}

	/**
	 * Move Comment form field back to bottom which was altered in WP 4.4
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function move_comment_form_fields( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
	}

	/**
	 * Ouput custom header css
	 *
	 * @since 1.0.0
	 */
	public function image_size_names_choose( $sizes ) {
		$get_image_sizes = pwd_get_image_sizes();
		if ( $get_image_sizes && is_array( $get_image_sizes ) ) {
			foreach ( $get_image_sizes as $key => $label ) {
				$sizes['pwd_'. $key] = $label;
			}
		}
		return $sizes;
	}

}
new Powered_Theme;