<?php
/**
 * Main Customizer functions
 *
 * @package     WordPress Customizer Class
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        https://www.wpexplorer.com/
 * @version     1.0.0
 */

// Start Class
if ( ! class_exists( 'Powered_Customizer' ) ) {
	class Powered_Customizer {

		/**
		 * Start things up
		 *
		 * @version 1.0.0
		 */
		public function __construct() {

			// Adds CSS for customizer custom controls
			add_action( 'customize_controls_print_styles', array( 'Powered_Customizer', 'controls_print_styles' ) );

			// Register and unregister Customizer settings
			add_action( 'customize_register', array( 'Powered_Customizer', 'customize_register' ) );

		}

		/**
		 * Returns correct prefix for settings
		 *
		 * @version 1.0.0
		 */
		public static function get_prefix() {
			return apply_filters( 'pwd_customizer_prefix', 'pwd' );
		}

		/**
		 * Register panels on init
		 *
		 * @version 1.0.0
		 */
		public static function get_panels() {
			return apply_filters( 'pwd_customizer_panels', null );
		}

		/**
		 * Adds CSS for customizer custom controls
		 *
		 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/customize_controls_print_styles
		 * @version 1.0.0
		 */
		public static function controls_print_styles() {
			wp_enqueue_style(
				'pwd-customizer-style',
				get_template_directory_uri() . '/inc/classes/customizer/assets/customizer-style.css',
				'1.0'
			);
		}

		/**
		 * Registers new controls
		 * Adds new customizer panels, sections, settings & controls
		 *
		 * @link    http://codex.wordpress.org/Theme_Customization_API
		 * @since   1.0.0
		 */
		public static function customize_register( $wp_customize ) {

			// Register only during customize preview
			if ( ! is_customize_preview() ) {
				return;
			}

			// Get panels
			$panels = self::get_panels();

			// Return if $panels var is empty
			if ( empty( $panels ) ) {
				return;
			}

			// Include custom controls
			require_once( get_template_directory() . '/inc/classes/customizer/controls.php' );

			// Register panels
			$panel_priority = 140; // add panels at the bottom

			// Get prefix
			$prefix = self::get_prefix();

			// Loop through and add panels
			foreach( $panels as $panel_id => $panel ) {

				// Add prefix to panel id
				$panel_id = $prefix .'_'. $panel_id;

				// Register panel
				$panel_priority++;
				$description = isset( $panel['desc'] ) ? $panel['desc'] : null;
				$wp_customize->add_panel( $panel_id, array(
					'priority'    => $panel_priority,
					'capability'  => 'edit_theme_options',
					'title'       => $panel['title'],
					'description' => $description,
				) );

				// Loop through panel sections and add sections
				$section_priority = 0;
				foreach( $panel['sections'] as $section ) {
					$section_priority++;
					$description = isset( $section['desc'] ) ? $section['desc'] : null;
					$wp_customize->add_section( $section['id'], array(
						'title'         => $section['title'],
						'panel'         => $panel_id,
						'priority'      => $section_priority,
						'description'   => $description,
					) );

					// Loop through section settings and add settings
					$control_priority   = 0;
					foreach ( $section['settings'] as $setting ) {

						$control_priority++;

						$id                 = isset( $setting['id'] ) ? $prefix .'_'. $setting['id'] : '';
						$transport          = isset( $setting['transport'] ) ? $setting['transport'] : 'refresh';
						$default            = isset( $setting['default'] ) ? $setting['default'] : '';
						$sanitize_callback  = isset( $setting['sanitize_callback'] ) ? $setting['sanitize_callback'] : false;
						$label              = isset( $setting['control']['label'] ) ? $setting['control']['label'] : '';
						$control_desc       = isset( $setting['control']['desc'] ) ? $setting['control']['desc'] : '';
						$type               = isset( $setting['control']['type'] ) ? $setting['control']['type'] : 'text';
						$choices            = isset( $setting['control']['choices'] ) ? $setting['control']['choices'] : array();
						$active_callback    = isset( $setting['control']['active_callback'] ) ? $setting['control']['active_callback'] : null;

						// If no ID continue
						if ( ! $id ) {
							continue;
						}

						// Control object
						if ( isset( $setting['control']['object'] ) ) {
							$control_object = $setting['control']['object'];
						} elseif ( 'color' == $type ) {
							$control_object = 'WP_Customize_Color_Control';
						} elseif ( 'upload' == $type ) {
							$control_object = 'WP_Customize_Image_Control';
						} elseif ( 'sorter' == $type ) {
							$control_object = 'Powered_Customize_Control_Sorter';
						} elseif ( 'google_font' == $type ) {
							$control_object = 'Powered_Fonts_Dropdown_Control';
						} elseif ( 'ui-slider' == $type ) {
							$control_object = 'Powered_Customize_Sliderui_Control';
						} else {
							$control_object = false;
						}

						// Add setting and control
						$wp_customize->add_setting( $id, array(
							'type'              => 'theme_mod',
							'transport'         => $transport,
							'default'           => $default,
							'sanitize_callback' => $sanitize_callback,
						) );

						if ( $control_object ) {
							$wp_customize->add_control( new $control_object ( $wp_customize, $id, array(
								'label'           => $label,
								'section'         => $section['id'],
								'settings'        => $id,
								'priority'        => $control_priority,
								'description'     => $control_desc,
								'type'            => $type,
								'choices'         => $choices,
								'active_callback' => $active_callback,
							) ) );
						} else {
							$wp_customize->add_control( $id, array(
								'label'           => $label,
								'section'         => $section['id'],
								'settings'        => $id,
								'priority'        => $control_priority,
								'description'     => $control_desc,
								'type'            => $type,
								'choices'         => $choices,
								'active_callback' => $active_callback,
							) );
						}

					 } // End foreach $section['settings']

				} // End foreach $panel['sections']

			} // END foreach $panels

		}

		/**
		 * Sanitize data
		 *
		 * @since 1.0.0
		 */
		public static function sanitize_data( $return, $data ) {

			// Hex Color
			if ( 'hex' == $return ) {
				if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $data ) ) {
					$data = $data;
				}
			}

			// Pixel
			elseif ( 'px' == $return ) {
				 $data = intval( $data );
				 $data = $data .'px';
			}

			// Font Family
			elseif ( 'font-family' == $return ) {
				 $data = "'". $data ."'";
			}

			// Return sanitized data
			return $data;

		}
		

		/**
		 * Generates inline CSS for styling options
		 *
		 * @since 1.0.0
		 */
		public static function loop_through_settings() {

			// Define vars
			$add_css      = '';
			$google_fonts = array();

			// Get customizer panels
			$panels = self::get_panels();

			// Return if there aren't any panels
			if ( empty( $panels ) ) {
				return;
			}

			// Pluck out all settings to loop through them
			$sections = wp_list_pluck( $panels, 'sections' );

			// Return if there aren't any settings
			if ( empty( $sections ) ) {
				return;
			}

			// Loop through settings
			foreach ( $sections as $section ) {

				// Pluck out settings
				$settings = wp_list_pluck( $section, 'settings' );

				// Loop through settings and find inline_css
				foreach ( $settings as $settings_array ) {

					// Loop through individual settings
					foreach ( $settings_array as $setting ) {

						// If setting shouldn't output css continue on to the next
						if ( ! isset( $setting['inline_css'] ) ) {
							continue;
						}

						// Get setting ID and if empty continue onto the next setting
						$id = isset( $setting['id'] ) ? $setting['id'] : '';

						if ( ! $id ) {
							continue;
						}

						// Get prefix
						$prefix = self::get_prefix();

						// Add prefix to ID
						$id = $prefix .'_'. $id;

						// Check if there is a default value
						$default = isset ( $setting['default'] ) ? $setting['default'] : false;

						// Get theme mod value and if empty continue onto the next setting
						$theme_mod = get_theme_mod( $id, $default );

						if ( ! $theme_mod ) {
							continue;
						}

						// Extract vars
						$inline_css = $setting['inline_css'];

						// Make sure vars are defined
						$sanitize  = isset( $inline_css['sanitize'] ) ? $inline_css['sanitize'] : '';
						$target    = isset( $inline_css['target'] ) ? $inline_css['target'] : '';
						$alter     = isset( $inline_css['alter'] ) ? $inline_css['alter'] : '';
						$condition = isset( $inline_css['condition'] ) ? $inline_css['condition'] : '';
						$important = isset( $inline_css['important'] ) ? '!important' : false;

						// Target and alter vars are required, if they are empty continue onto the next setting
						if ( ! $target && ! $alter ) {
							continue;
						}

						// Check condition
						if ( $condition && ! call_user_func( $condition ) ) {
							continue;
						}

						// Sanitize data
						if ( 'font-family' == $alter ) {
							$sanitize = 'font-family';
						}

						if ( $sanitize ) {
							$value = self::sanitize_data( $sanitize, $theme_mod );
						} else {
							$value = $theme_mod;
						}

						// Save inline_css
						if ( $theme_mod ) {
							if ( is_array( $alter ) ) {
								foreach ( $alter as $key => $val ) {
									$add_css .= $target .'{'. $val .':'. $value . $important .';}';
								}
							} else {
								$add_css .= $target .'{'. $alter .':'. $value . $important .';}';
							}
						}

						// If we are altering a font-family and it's not a standard font add the font to the list of Google fonts to load
						$standard_fonts = self::std_fonts_array();
						if ( 'font-family' == $alter && ! in_array( $theme_mod, $standard_fonts ) ) {
							$google_fonts[] = $theme_mod;
						}

					}

				}

			}

			// Return data
			return array(
				'css'   => $add_css,
				'fonts' => $google_fonts
			);

		}

		/**
		 * List of standard fonts used in the Fonts control
		 *
		 * @since 1.0.0
		 */
		public static function std_fonts_array() {
			return array(
				"Arial, Helvetica, sans-serif",
				"Arial Black, Gadget, sans-serif",
				"Bookman Old Style, serif",
				"Comic Sans MS, cursive",
				"Courier, monospace",
				"Garamond, serif",
				"Georgia, serif",
				"Impact, Charcoal, sans-serif",
				"Lucida Console, Monaco, monospace",
				"Lucida Sans Unicode, Lucida Grande, sans-serif",
				"MS Sans Serif, Geneva, sans-serif",
				"MS Serif, New York, sans-serif",
				"Palatino Linotype, 'Book Antiqua, Palatino, serif",
				"Tahoma, Geneva, sans-serif",
				"Times New Roman, Times, serif",
				"Trebuchet MS, Helvetica, sans-serif",
				"Verdana, Geneva, sans-serif",
				"Garamond, serif",
				"Bookman Old Style",
				"Verdana",
				"Comic Sans",
				"Courier, monospace",
				"Comic Sans MS",
				"Courier",
				"Georgia",
				"Paratina Linotype",
				"Trebuchet MS",
			);
		}

	}
}
new Powered_Customizer;