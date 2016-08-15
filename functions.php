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
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.stplorer.com
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

		// Updates
		if ( is_admin() ) {
			require_once( get_template_directory() .'/inc/updates.php' );
		}

		// Add Filters
		add_filter( 'excerpt_more', array( 'Powered_Theme', 'excerpt_more' ) );
		add_filter( 'embed_oembed_html', array( 'Powered_Theme', 'embed_oembed_html' ), 99, 4 );
		add_filter( 'pre_get_posts', array( 'Powered_Theme', 'pre_get_posts' ) );
		add_filter( 'manage_post_posts_columns', array( 'Powered_Theme', 'posts_columns' ), 10 );
		add_filter( 'manage_page_posts_columns', array( 'Powered_Theme', 'posts_columns' ), 10 );
		add_filter( 'use_default_gallery_style', array( 'Powered_Theme', 'remove_gallery_styles' ) );
		add_filter( 'user_contactmethods', array( 'Powered_Theme', 'user_fields' ) );
		add_filter( 'body_class', array( 'Powered_Theme', 'body_classes' ) );
		add_action( 'wp_head', array( 'Powered_Theme', 'theme_meta_generator' ), 9999 );
		add_filter( 'wp_nav_menu_items', array( 'Powered_Theme', 'menu_add_items' ), 11, 2 );
		add_filter( 'comment_form_fields', array( 'Powered_Theme', 'move_comment_form_fields' ) );
		add_filter( 'the_author_posts_link', array( 'Powered_Theme', 'the_author_posts_link' ) );
		add_filter( 'wpseo_breadcrumb_output', array( 'Powered_Theme', 'yoast_breadcrumbs_fixes' ) );
		add_filter( 'http_request_args', array( 'Powered_Theme', 'disable_wporg_request' ), 5, 2 );
		add_filter( 'image_size_names_choose', array( 'Powered_Theme', 'image_size_names_choose' ) );

		// Actions
		add_action( 'after_setup_theme', array( 'Powered_Theme', 'load_files' ), 1 );
		add_action( 'after_setup_theme', array( 'Powered_Theme', 'setup' ), 10 );
		add_action( 'wp_enqueue_scripts', array( 'Powered_Theme', 'theme_css' ) );
		add_action( 'wp_enqueue_scripts', array( 'Powered_Theme', 'theme_js' ) );
		add_action( 'widgets_init', array( 'Powered_Theme', 'register_sidebars' ) );
		add_action( 'manage_posts_custom_column', array( 'Powered_Theme', 'posts_custom_columns' ), 10, 2 );
		add_action( 'manage_pages_custom_column', array( 'Powered_Theme', 'posts_custom_columns' ), 10, 2 );
		add_action( 'wp_footer', array( 'Powered_Theme', 'mobile_alternative' ) );

		// Custom Widgets
		self::load_custom_widgets();

	}

	/**
	 * Include functions and classes
	 *
     * @since  1.0.0
     * @access public
	 */
	public static function load_files() {

		$dir = get_template_directory();

		// Include Theme Functions
		require_once( $dir .'/inc/core-functions.php' );
		require_once( $dir .'/inc/conditionals.php' );
		require_once( $dir .'/inc/customizer-config.php' );
		require_once( $dir .'/inc/meta-posts.php' );
		require_once( $dir .'/inc/meta-pages.php' );
		require_once( $dir .'/inc/schema.php' );

		// Include Classes
		require_once( $dir .'/inc/classes/customizer/customizer.php' );

		// WPML/Polilang config
		require_once( $dir .'/inc/translators-config.php' );

	}

	/**
	 * Include custom widgets
	 *
     * @since  1.0.0
     * @access public
	 */
	public static function load_custom_widgets() {

		// Define dir
		$dir = get_template_directory();

		// Apply filters so you can remove custom widgets via a child theme or plugin
		$widgets = apply_filters( 'pwd_theme_widgets', array(
			'social',
			'recent-posts-thumbnails',
		) );

		// Loop through and load widget files
		foreach ( $widgets as $widget ) {
			$widget_file = $dir .'/inc/classes/widgets/'. $widget .'.php';
			if ( file_exists( $widget_file ) ) {
				require_once( $widget_file );
		   }
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
	public static function setup() {

		// Define content_width variable
		if ( ! isset( $content_width ) ) {
			$content_width = 745;
		}

		// Register navigation menus
		register_nav_menus ( array(
			'main'   => esc_html__( 'Main', 'powered' ),
			'mobile' => esc_html__( 'Mobile Alternative', 'powered' ),
		) );

		// Add editor styles
		add_editor_style( 'css/editor-style.css' );
		
		// Localization support
		load_theme_textdomain( 'powered', get_template_directory() .'/languages' );
			
		// Add theme support
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'post-thumbnails' );
		//add_theme_support( 'custom-header' );

		// Add image sizes
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
	public static function theme_css() {

		// Define css directory
		$css_dir_uri = get_template_directory_uri() .'/css/';

		// Define inline style handle
		$style_handle = apply_filters( 'pwd_style_handle', 'style' );

		// IE8 CSS
		wp_enqueue_style( 'pwd-ie8', $css_dir_uri .'ie8.css' );
		wp_style_add_data( 'pwd-ie8', 'conditional', 'lt IE 9' );

		// Font Awesome
		wp_enqueue_style( 'font-awesome', $css_dir_uri .'font-awesome.min.css' );

		// Main CSS
		wp_enqueue_style( 'style', get_stylesheet_uri() );

		// Remove Contact Form 7 Styles
		if ( function_exists( 'wpcf7_enqueue_styles') ) {
			wp_dequeue_style( 'contact-form-7' );
		}

		// Advanced styles
		$advanced_styles = self::advanced_styles();
		if ( $advanced_styles ) {
			$advanced_styles = pwd_minify_css( $advanced_styles );
			wp_add_inline_style( $style_handle, $advanced_styles );
		}

		// Customizer CSS
		if ( class_exists( 'Powered_Customizer' ) ) {

			// Customizer loop
			$c_loop = Powered_Customizer::loop_through_settings();

			// Google fonts
			if ( ! empty( $c_loop['fonts'] ) ) {
				$fonts = $c_loop['fonts'];
				foreach ( $fonts as $font ) {
					$url    = pwd_get_gfont_url( $font );
					$handle = trim( $font );
					$handle = strtolower( $font );
					$handle = str_replace( ' ', '-', $font );
					wp_enqueue_style( 'pwd-google-font-'. $handle, $url, false, false, 'all' );
				}
			}

			// Customizer styling CSS
			if ( ! empty( $c_loop['css'] ) ) {
				$c_loop_css = pwd_minify_css( $c_loop['css'] );
				wp_add_inline_style( $style_handle, $c_loop_css );
			}

		}

		// Accent CSS
		if ( class_exists( 'Powered_Accent_Class' ) ) {

			$accent_css = Powered_Accent_Class::generate_css();
			if ( $accent_css ) {
				$accent_css = pwd_minify_css( $accent_css );
				wp_add_inline_style( $style_handle, $accent_css );
			}

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
	public static function theme_js() {

		// Define js directory
		$js_dir_uri = get_template_directory_uri() .'/js/';

		// Comment reply
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// HTML5
		wp_enqueue_script( 'html5shiv', $js_dir_uri .'js/html5.js', array(), false, false );
		wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );	

		// Localize scripts
		$localize = apply_filters( 'pwd_localize', array(
			'mobileSiteMenuLabel' => '<span class="fa fa-bars"></span>',
		) );

		// Load 3rd party scripts
		wp_enqueue_script( 'imagesLoaded', $js_dir_uri .'plugins/imagesloaded.pkgd.js', array( 'jquery' ), '4.1.0', true );
		wp_enqueue_script( 'isotope', $js_dir_uri .'plugins/isotope.pkgd.js', array( 'jquery', 'imagesLoaded' ), '3.0.1', true );
		wp_enqueue_script( 'dropdownTouchSupport', $js_dir_uri .'plugins/dropdownTouchSupport.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'slicknav', $js_dir_uri .'plugins/jquery.slicknav.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fitvids', $js_dir_uri .'plugins/jquery.fitvids.js', array( 'jquery' ), '1.1', true );

		// Theme functions
		wp_enqueue_script( 'pwd-js', $js_dir_uri .'functions.js', array( 'jquery' ), false, true );
		wp_localize_script( 'pwd-js', 'pwdLocalize', $localize );

		// Retina logo
		$retina_logo = self::retina_logo();
		if ( $retina_logo ) {
			wp_add_inline_script( 'pwd-js', $retina_logo, 'before' );
		}

	}

	/**
	 * Registers the theme sidebars
	 *
     * @since  1.0.0
     * @access public
	 *
	 * @link   http://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	public static function register_sidebars() {

		// Sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar - Main', 'powered' ),
			'id'            => 'sidebar',
			'before_widget' => '<div class="pwd-sidebar-widget %2$s pwd-clr">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		// Sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar - Pages', 'powered' ),
			'id'            => 'sidebar_pages',
			'before_widget' => '<div class="pwd-sidebar-widget %2$s pwd-clr">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		// Get footer columns
		$cols = pwd_get_theme_mod( 'footer_widget_columns', 4 );

		// Footer 1
		if ( $cols >= 1 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 1', 'powered' ),
				'id'            => 'footer-one',
				'before_widget' => '<div class="footer-widget %2$s pwd-clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			) );

		}

		// Footer 2
		if ( $cols > 1 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 2', 'powered' ),
				'id'            => 'footer-two',
				'before_widget' => '<div class="footer-widget %2$s pwd-clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			) );

		}

		// Footer 3
		if ( $cols > 2 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 3', 'powered' ),
				'id'            => 'footer-three',
				'before_widget' => '<div class="footer-widget %2$s pwd-clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			) );

		}

		// Footer 4
		if ( $cols > 3 ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Footer 4', 'powered' ),
				'id'            => 'footer-four',
				'before_widget' => '<div class="footer-widget %2$s pwd-clr">',
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
	public static function body_classes( $classes ) {

		// Add post layout
		$classes[] = pwd_get_post_layout();

		// Responsive
		if ( pwd_is_responsive() ) {
			$classes[] = 'pwd-responsive';
		}

		// RTL
		if ( is_RTL() || isset( $_GET['rtl'] ) ) {
			$classes[] = 'rtl';
		}
		
		// Return classes
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
	public static function excerpt_more( $more ) {
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
	public static function embed_oembed_html( $html, $url, $attr, $post_id ) {
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
	public static function pre_get_posts( $query ) {

		// Do nothing in admin
		if ( is_admin() ) {
			return;
		}

		// Alter search results
		if ( pwd_get_theme_mod( 'search_posts_only', true )
			&& $query->is_main_query()
			&& is_search()
		) {
			$post_type_query_var = false;
			if ( ! empty( $_GET[ 'post_type' ] ) ) {
				$post_type_query_var = true;
			}
			if ( ! $post_type_query_var ) {
				$query->set( 'post_type', array( 'post' ) );
			}
		}

		// Exclude posts on the homepage
		if ( $query->is_home() && $query->is_main_query() && function_exists( 'pwd_exclude_home_ids' ) ) {
			$ids = pwd_exclude_home_ids();
			if ( is_array( $ids ) && ! empty( $ids ) ) {
				$query->set( 'post__not_in', $ids );
			}
		}

		// Alter posts per page
		if ( $query->is_main_query() && ! empty( $_GET['posts_per_page'] ) ) {
			return $query->set( 'posts_per_page', $_GET['posts_per_page'] );
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
	public static function posts_columns( $defaults ) {
		$defaults['pwd_post_thumbs'] = esc_html__( 'Featured Image', 'powered' );
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
	public static function posts_custom_columns( $column_name, $id ) {
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
	 * Adds js for the retina logo
	 *
	 * @since 1.0.0
	 */
	public static function retina_logo() {
		$logo_url    = esc_url( pwd_get_theme_mod( 'logo_retina' ) );
		$logo_height = intval( pwd_get_theme_mod( 'logo_retina_height' ) );
		if ( $logo_url && $logo_height ) {
			return 'jQuery(function($){if (window.devicePixelRatio >= 2) {$(".pwd-site-logo img").attr("src", "'. esc_url( $logo_url ) .'");$("#pwd-site-logo img").css("height", "'. intval( $logo_height ) .'");}});';
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
	public static function remove_gallery_styles() {
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
	public static function user_fields( $contactmethods ) {

		// Add Twitter
		if ( ! isset( $contactmethods['pwd_twitter'] ) ) {
			$contactmethods['wpex_twitter'] = 'Powered - Twitter';
		}

		// Add Facebook
		if ( ! isset( $contactmethods['pwd_facebook'] ) ) {
			$contactmethods['wpex_facebook'] = 'Powered - Facebook';
		}

		// Add GoglePlus
		if ( ! isset( $contactmethods['pwd_googleplus'] ) ) {
			$contactmethods['wpex_googleplus'] = 'Powered - Google+';
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
	public static function advanced_styles() {

		// Add css
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
		$width = self::px_pct( pwd_get_theme_mod( 'layout_content_width' ) );
		if ( $width ) {
			$css .= '.pwd-content-area { width: '. $width .'; max-width: none; }';
		}

		// Sidebar width
		$width = self::px_pct( pwd_get_theme_mod( 'layout_sidebar_width' ) );
		if ( $width ) {
			$css .= '.pwd-sidebar { width: '. $width .'; max-width: none; }';
		}

		// Container Max Width
		if ( pwd_is_responsive() ) {

			$width = intval( pwd_get_theme_mod( 'layout_container_max_width' ) );

			if ( $width && '85' !== $width ) {
				$css .= '.pwd-responsive .pwd-container { max-width: '. $width .'%; }';
			}

		}

		// Accent color
		$accent = esc_attr( pwd_get_theme_mod( 'accent_color', '#177fff' ) );
		if ( $accent && '#177fff' != $accent ) {

			// Bgs
			$css .= '.pwd-featured-post-cat, .pwd-post-tags a:hover { background-color: '. $accent .'; }';

			// Colors
			$css .= 'a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, .widget-recent-list .pwd-title a:hover, .pwd-page-numbers span.current, .pwd-footer-pp .pwd-col a:hover { color: '. $accent .'; }';

			// Borders
			$css .= '.pwd-site-header-wrap { border-bottom-color: '. $accent .'; }';

		}

		// Header height
		$header_height = intval( pwd_get_theme_mod( 'header_height' ) );
		if ( $header_height ) {
			$header_height_plus = $header_height + 3;
			$css .= '.pwd-site-header-wrap { height: '. $header_height_plus .'px; line-height: '. $header_height_plus .'px; }';
			$css .= '.pwd-site-branding, .pwd-site-nav .pwd-dropdown-menu > li { height: '. $header_height .'px; line-height: '. $header_height .'px; }';
			$css .= '.pwd-site-logo img, .pwd-site-header-wrap .slicknav_menu { height: '. $header_height .'px; }';
		}

		// Mobile menu breakpoint
		$mm_bb = intval( pwd_get_theme_mod( 'mobile_menu_breakpoint' ) );
		if ( $mm_bb ) {
			$css .= '.pwd-responsive .pwd-site-nav, .pwd-responsive .pwd-search-toggle { display: block }.pwd-responsive .pwd-site-header-wrap .slicknav_menu { display: none; }';
			$css .= '@media only screen and (max-width: '. $mm_bb .'px) {';
				$css .= '.pwd-responsive .pwd-site-nav, .pwd-responsive .pwd-search-toggle { display: none }.pwd-responsive .pwd-site-header-wrap .slicknav_menu { display: block; }';
			$css .= '}';
		}

		// Minitfy CSS
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
    private static function px_pct( $data ) {
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
	 * Adds meta generator for 
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public static function theme_meta_generator() {
		$theme = wp_get_theme();
		echo '<meta name="generator" content="Built With The Powered WordPress Theme '. $theme->get( 'Version' ) .' by WPExplorer" />';
		echo "\r\n";
	}

	/**
	 * Adds alternative mobile menu
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public static function mobile_alternative() {
		if ( has_nav_menu( 'mobile' ) ) {
			echo wp_nav_menu( array(
				'theme_location'  => 'mobile',
				'fallback_cb'     => false,
				'container_class' => 'pwd-mobile-menu-alt',
				'menu_class'      => 'pwd-dropdown-menu',
				'walker'          => new Powered_Dropdown_Walker_Nav_Menu,
			) );
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
	public static function menu_add_items( $items, $args ) {

		// Only used on main menu
		if ( 'main' != $args->theme_location ) {
			return $items;
		}

		// Add search item to menu
		$items .= '<li class="pwd-search-toggle">';
			$items .= '<a href="#">';
				$items .= '<span class="link-inner">';
					$items .= '<span class="fa fa-search"></span>';
				$items .= '</span>';
			$items .= '</a>';
		$items .= '</li>';

		// Return items
		return $items;

	}

	/**
	 * Move Comment form field back to bottom which was altered in WP 4.4
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public static function move_comment_form_fields( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
	}

	/**
	 * Add schema markup to the authors post link
	 *
	 * @since 1.0.0
	 */
	public static function the_author_posts_link( $link ) {

		// Add schema markup
		$schema = pwd_get_schema_markup( 'author_link' );
		if ( $schema ) {
			$link = str_replace( 'rel="author"', 'rel="author"'. $schema, $link );
		}

		// Return link
		return $link;

	}

	/**
	 * Fix some validation errors with Yoast breadcrumbs
	 *
	 * @since 1.0.0
	 */
	public static function yoast_breadcrumbs_fixes( $output ) {

		$output = preg_replace( array( '#<span xmlns:v="http://rdf.data-vocabulary.org/\#">#', '#<span typeof="v:Breadcrumb"><a href="(.*?)" .*?'.'>(.*?)</a></span>#', '#<span typeof="v:Breadcrumb">(.*?)</span>#','# property=".*?"#','#</span>$#'), array('','<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="$1" itemprop="url"><span itemprop="title">$2</span></a></span>', '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">$1</span></span>', '', '' ), $output );

		return $output;

	}

	/**
	 * Disable requests to wp.org repository for this theme.
	 *
	 * @since 1.0.0
	 */
	public static function disable_wporg_request( $r, $url ) {

		// If it's not a theme update request, bail.
		if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) {
			return $r;
		}

		// Decode the JSON response
		$themes = json_decode( $r['body']['themes'] );

		// Remove the active parent and child themes from the check
		$parent = get_option( 'template' );
		$child  = get_option( 'stylesheet' );
		unset( $themes->themes->$parent );
		unset( $themes->themes->$child );

		// Encode the updated JSON response
		$r['body']['themes'] = json_encode( $themes );

		return $r;

	}

	/**
	 * Ouput custom header css
	 *
	 * @since 1.0.0
	 */
	public static function image_size_names_choose( $sizes ) {
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