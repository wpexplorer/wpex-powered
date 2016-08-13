<?php
/**
 * Defines all settings for the customizer class
 *
 * @package Powered WordPress Theme
 * @author Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link http://www.stplorer.com
 * @since 1.0.0
 */

if ( ! function_exists( 'pwd_customizer_config' ) ) {

	function pwd_customizer_config( $panels ) {

		/*-----------------------------------------------------------------------------------*/
		/* - Useful vars
		/*-----------------------------------------------------------------------------------*/

		// Columns
		$columns = array(
			'' => esc_html__( 'Default', 'powered' ),
			1 => 1,
			2 => 2,
			3 => 3,
			4 => 4,
		);

		// Layouts
		$layouts = array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'powered' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'powered' ),
			'full-width'    => esc_html__( 'No Sidebar', 'powered' ),
		);
		
		// Font Weights
		$font_weights = array(
			'' => esc_html__( 'Default', 'powered' ),
			'100' => '100',
			'200' => '200',
			'300' => '300',
			'400' => '400',
			'500' => '500',
			'600' => '600',
			'700' => '700',
			'800' => '800',
			'900' => '900',
		);

		// Categories
		$categories = array();
		$get_categories = get_categories( array(
			'orderby' => 'name'
		) );
		if ( ! empty( $get_categories ) ) {
			foreach ( $get_categories as $cat ) {
				$categories[$cat->term_id] = $cat->name;
			}
		}

		/*-----------------------------------------------------------------------------------*/
		/* - General Panel
		/*-----------------------------------------------------------------------------------*/
		$panels['general'] = array(
			'title' => esc_html__( 'General Theme Settings', 'powered' ),
			'sections' => array()
		);

		// Site Widths
		$panels['general']['sections']['site-widths'] = array(
			'id' => 'pwd_site_widths',
			'title' => esc_html__( 'Site Widths', 'powered' ),
			'settings' => array(
				array(
					'id' => 'layout_container_width',
					'control' => array(
						'label' => esc_html__( 'Container Width', 'powered' ),
						'type' => 'text',
						'desc' => esc_html__( 'Default:', 'powered' ) .' 1000px',
					),
				),
				array(
					'id' => 'layout_container_max_width',
					'control' => array(
						'label' => esc_html__( 'Container Max Width Percent', 'powered' ),
						'type' => 'text',
						'active_callback' => 'pwd_is_responsive',
						'desc' => esc_html__( 'Default:', 'powered' ) .' 85%',
					),
				),
				array(
					'id' => 'layout_content_width',
					'control' => array(
						'label' => esc_html__( 'Content Area Width', 'powered' ),
						'type' => 'text',
						'desc' => esc_html__( 'Default:', 'powered' ) .' 70%',
					),
				),
				array(
					'id' => 'layout_sidebar_width',
					'control' => array(
						'label' => esc_html__( 'Sidebar Width', 'powered' ),
						'type' => 'text',
						'desc' => esc_html__( 'Default:', 'powered' ) .' 26%',
					),
				),
			),
		);

		// Layouts
		$panels['general']['sections']['layouts'] = array(
			'id' => 'pwd_layouts',
			'title' => esc_html__( 'Layouts', 'powered' ),
			'settings' => array(
				array(
					'id' => 'home_layout',
					'default' => 'full-width',
					'control' => array(
						'label' => esc_html__( 'Homepage Layout', 'powered' ),
						'type' => 'select',
						'choices' => $layouts,
					),
				),
				array(
					'id' => 'archives_layout',
					'default' => 'full-width',
					'control' => array(
						'label' => esc_html__( 'Archives Layout', 'powered' ),
						'type' => 'select',
						'choices' => $layouts,
						'desc' => esc_html__( 'Categories, tags, author...etc', 'powered' ),
					),
				),
				array(
					'id' => 'search_layout',
					'default' => 'full-width',
					'transport' => 'postMessage',
					'control' => array(
						'label' => esc_html__( 'Search Layout', 'powered' ),
						'type' => 'select',
						'choices' => $layouts,
					),
				),
				array(
					'id' => 'post_layout',
					'default' => 'right-sidebar',
					'control' => array(
						'label' => esc_html__( 'Post Layout', 'powered' ),
						'type' => 'select',
						'choices' => $layouts,
					),
				),
				array(
					'id' => 'page_layout',
					'default' => 'right-sidebar',
					'control' => array(
						'label' => esc_html__( 'Page Layout', 'powered' ),
						'type' => 'select',
						'choices' => $layouts,
					),
				),
			),
		);

		// Responsive
		$panels['general']['sections']['responsive'] = array(
			'id' => 'pwd_responsive',
			'title' => esc_html__( 'Responsiveness', 'powered' ),
			'settings' => array(
				array(
					'id' => 'responsive',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Enable', 'powered' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'sitenav_mm_txt',
					'control' => array(
						'label' => esc_html__( 'Main Menu Mobile Toggle Text', 'powered' ),
						'type' => 'text',
						'active_callback' => 'pwd_is_responsive',
					),
				),
			),
		);

		// Header Section
		$panels['general']['sections']['general'] = array(
			'id' => 'pwd_general',
			'title' => esc_html__( 'Header', 'powered' ),
			'settings' => array(
				array(
					'id' => 'site_description',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Display description?', 'powered' ),
						'type' => 'checkbox'
					),
				),
				array(
					'id' => 'header_overlay_opacity',
					'sanitize_callback' => 'absint',
					'control' => array(
						'label' => esc_html__( 'Header Overlay Opacity', 'powered' ),
						'type' => 'text',
					),
					'inline_css' => array(
						'target' => '.pwd-site-header-overlay',
						'alter' => 'opacity',
					),
				),
				array(
					'id' => 'header_overlay_olor',
					'control' => array(
						'label' => esc_html__( 'Header Overlay Color', 'powered' ),
						'type' => 'color',
					),
					'inline_css' => array(
						'target' => '.pwd-site-header-overlay',
						'alter' => 'background-color',
					),
				),
				array(
					'id' => 'logo_bottom_margin',
					'control' => array(
						'label' => esc_html__( 'Logo Bottom Margin', 'powered' ),
						'type' => 'text',
					),
					'inline_css' => array(
						'target' => '.pwd-site-logo',
						'alter' => 'margin-bottom',
						'sanitize' => 'px',
					),
				),
				array(
					'id' => 'logo',
					'control' => array(
						'label' => esc_html__( 'Custom Logo', 'powered' ),
						'type' => 'upload',
					),
				),
				array(
					'id' => 'logo_retina',
					'control' => array(
						'label' => esc_html__( 'Custom Retina Logo', 'powered' ),
						'type' => 'upload',
					),
				),
				array(
					'id' => 'logo_retina_height',
					'control' => array(
						'label' => esc_html__( 'Standard Logo Height', 'powered' ),
						'desc' => esc_html__( 'Enter the standard height for your logo. Used to set your retina logo to the correct dimensions', 'powered' ),
					),
				),
			),
		);

		// Entries
		$panels['general']['sections']['entries'] = array(
			'id' => 'pwd_entries',
			'title' => esc_html__( 'Entries', 'powered' ),
			'settings' => array(
				array(
					'id' => 'entry_columns',
					'default' => '3',
					'control' => array(
						'label' => esc_html__( 'Grid Columns', 'powered' ),
						'type' => 'select',
						'choices' => array(
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',
						),
					),
				),
				array(
					'id' => 'grid_layout_mode',
					'default' => 'fitRows',
					'control' => array(
						'label' => esc_html__( 'Grid Layout Mode', 'powered' ),
						'type' => 'select',
						'choices' => array(
							'fitRows' => esc_html__( 'Fit Rows', 'powered' ),
							'masonry' => esc_html__( 'Masonry', 'powered' ),
						),
					),
				),
				array(
					'id' => 'entry_content_display',
					'default' => 'excerpt',
					'control' => array(
						'label' => esc_html__( 'Entry Displays?', 'powered' ),
						'type' => 'select',
						'choices' => array(
							'excerpt' => esc_html__( 'Custom Excerpt', 'powered' ),
							'content' => esc_html__( 'Full Content', 'powered' ),
						),
					),
				),
				array(
					'id' => 'entry_excerpt_length',
					'default' => 14,
					'control' => array(
						'label' => esc_html__( 'Entry Excerpt Length', 'powered' ),
						'type' => 'text',
						'desc' => esc_html__( 'How many words to display per excerpt', 'powered' ),
						'active_callback' => 'pwd_has_custom_excerpt'
					),
				),
				array(
					'id' => 'entry_thumbnail',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Entry Thumbnail', 'powered' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'entry_embeds',
					'control' => array(
						'label' => esc_html__( 'Entry Embeds', 'powered' ),
						'type' => 'checkbox',
						'desc' => esc_html__( 'Display\'s your video/audio embed on the homepage and archives instead of the featured image.', 'powered' ),
					),
				),
				array(
					'id' => 'entry_meta',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Entry Meta', 'powered' ),
						'type' => 'checkbox',
					),
				),
			),
		);

		// Posts
		$panels['general']['sections']['posts'] = array(
			'id' => 'pwd_posts',
			'title' => esc_html__( 'Posts', 'powered' ),
			'settings' => array(
				array(
					'id' => 'post_thumbnail',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Post Thumbnail', 'powered' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'post_meta',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Post Meta', 'powered' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'post_tags',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Post Tags', 'powered' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'social_share',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Post Social Share', 'powered' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'post_author_info',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Post Author Box', 'powered' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'post_next_prev',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Post Next/Previous', 'powered' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'post_related',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Post Related', 'powered' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'related_entry_columns',
					'default' => '2',
					'control' => array(
						'label' => esc_html__( 'Post Related Columns', 'powered' ),
						'type' => 'select',
						'choices' => array(
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',
						),
					),
				),
				array(
					'id' => 'post_related_grid_layout_mode',
					'default' => 'fitRows',
					'control' => array(
						'label' => esc_html__( 'Grid Layout Mode', 'powered' ),
						'type' => 'select',
						'choices' => array(
							'fitRows' => esc_html__( 'Fit Rows', 'powered' ),
							'masonry' => esc_html__( 'Masonry', 'powered' ),
						),
						'active_callback' => 'pwd_customizer_has_related_posts',
					),
				),
				array(
					'id' => 'post_related_displays',
					'default' => 'related_tags',
					'control' => array(
						'label' => esc_html__( 'Relate Posts by', 'powered' ),
						'type' => 'select',
						'choices' => array(
							'related_tags' => esc_html__( 'Tags', 'powered' ),
							'related_category' => esc_html__( 'Category', 'powered' ),
							'random' => esc_html__( 'Random', 'powered' ),
						),
						'active_callback' => 'pwd_customizer_has_related_posts',
					),
				),
				array(
					'id' => 'post_related_count',
					'default' => '6',
					'control' => array(
						'label' => esc_html__( 'Post Related: Count', 'powered' ),
						'type' => 'number',
						'active_callback' => 'pwd_customizer_has_related_posts',
					),
				),
			),
		);

		// Footer
		$panels['general']['sections']['footer'] = array(
			'id' => 'pwd_footer',
			'title' => esc_html__( 'Footer', 'powered' ),
			'settings' => array(
				array(
					'id' => 'footer_widget_columns',
					'default' => 4,
					'control' => array(
						'label' => esc_html__( 'Footer Widgets Columns', 'powered' ),
						'type' => 'select',
						'choices' => array(
							'disable' => esc_html__( 'None - Disable', 'powered' ),
							1 => 1,
							2 => 2,
							3 => 3,
							4 => 4,
						)
					),
				),
				array(
					'id' => 'footer_copyright',
					'default' => '<a href="http://www.wordpress.org" title="WordPress" target="_blank">WordPress</a> Theme Designed &amp; Developed by <a href="http://www.stplorer.com/" target="_blank" title="WPExplorer">WPExplorer</a>',
					'control' => array(
						'label' => esc_html__( 'Footer Copyright', 'powered' ),
						'type' => 'textarea',
					),
				),
			),
		);

		// Discussion
		$panels['general']['sections']['discussion'] = array(
			'id' => 'pwd_site_discussion',
			'title' => esc_html__( 'Discussion', 'powered' ),
			'settings' => array(
				array(
					'id' => 'comments_on_pages',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Comments For Pages', 'powered' ),
						'type' => 'checkbox',
					),
				),
				array(
					'id' => 'comments_on_posts',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Comments For Posts', 'powered' ),
						'type' => 'checkbox',
					),
				),
			)
		);

		// Search
		$panels['general']['sections']['search'] = array(
			'id' => 'pwd_search',
			'title' => esc_html__( 'Search Results', 'powered' ),
			'settings' => array(
				array(
					'id' => 'search_posts_only',
					'default' => true,
					'control' => array(
						'label' => esc_html__( 'Search posts only.', 'powered' ),
						'type' => 'checkbox',
					),
				),
			)
		);

		// Ads
		$panels['general']['sections']['ads'] = array(
			'id' => 'pwd_ads',
			'title' => esc_html__( 'Advertisements', 'powered' ),
			'settings' => array(
				array(
					'id' => 'ad_above_post',
					'default' => '<a href="http://themeforest.net/user/wpexplorer"><img src="'. esc_url( get_template_directory_uri() ) .'/images/ad-banner.jpg" /></a>',
					'control' => array(
						'label' => esc_html__( 'Above Post', 'powered' ),
						'type' => 'textarea',
					),
				),
			)
		);

		/*-----------------------------------------------------------------------------------*/
		/* - Typography
		/*-----------------------------------------------------------------------------------*/
		$panels['typography'] = array(
			'title' => esc_html__( 'Typography', 'powered' ),
			'description' => esc_html__( 'It is highly recommended that you do NOT use more then a couple custom Google fonts on the site because it could greatly slow things down.', 'powered' ),
			'sections' => array(

				// Body Typography
				array(
					'id' => 'body',
					'title' => esc_html__( 'Body', 'powered' ),
					'settings' => array(
						array(
							'id' => 'body_font_family',
							'default' => 'Open Sans',
							'control' => array(
								'label' => esc_html__( 'Font Family', 'powered' ),
								'type' => 'google_font',
							),
							'inline_css' => array(
								'target' => 'body',
								'alter' => 'font-family',
							),
						),
						array(
							'id' => 'body_font_weight',
							'control' => array(
								'label' => esc_html__( 'Font Weight', 'powered' ),
								'type' => 'select',
								'choices' => $font_weights,
							),
							'inline_css' => array(
								'target' => 'body',
								'alter' => 'font-weight',
							),
						),
						array(
							'id' => 'body_font_size',
							'control' => array(
								'label' => esc_html__( 'Font Size', 'powered' ),
							),
							'inline_css' => array(
								'target' => 'body',
								'alter' => 'font-size',
								'sanitize' => 'px',
							),
						),
						array(
							'id' => 'body_letter_spacing',
							'control' => array(
								'label' => esc_html__( 'Letter Spacing', 'powered' ),
							),
							'inline_css' => array(
								'target' => 'body',
								'alter' => 'letter-spacing',
								'sanitize' => 'px',
							),
						),
						array(
							'id' => 'body_color',
							'control' => array(
								'label' => esc_html__( 'Color', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => 'body, strong',
								'alter' => 'color',
							),
						),
					),
				),

				// Logo Typography
				array(
					'id' => 'pwd_logo_typography',
					'title' => esc_html__( 'Logo', 'powered' ),
					'settings' => array(
						array(
							'id' => 'logo_font_family',
							//'default' => 'Crete Round',
							'control' => array(
								'label' => esc_html__( 'Font Family', 'powered' ),
								'type' => 'google_font',
							),
							'inline_css' => array(
								'target' => '.pwd-site-logo',
								'alter' => 'font-family',
							),
						),
						array(
							'id' => 'logo_font_weight',
							'control' => array(
								'label' => esc_html__( 'Font Weight', 'powered' ),
								'type' => 'select',
								'choices' => $font_weights,
							),
							'inline_css' => array(
								'target' => '.pwd-site-logo .site-text-logo',
								'alter' => 'font-weight',
							),
						),
						array(
							'id' => 'logo_size',
							'control' => array(
								'label' => esc_html__( 'Font Size', 'powered' ),
							),
							'inline_css' => array(
								'target' => '.pwd-site-logo .site-text-logo',
								'alter' => 'font-size',
								'sanitize' => 'px',
							),
						),
						array(
							'id' => 'logo_letter_spacing',
							'control' => array(
								'label' => esc_html__( 'Letter Spacing', 'powered' ),
							),
							'inline_css' => array(
								'target' => '.pwd-site-logo .site-text-logo',
								'alter' => 'letter-spacing',
								'sanitize' => 'px',
							),
						),
					),
				),

				// Headings Typography
				array(
					'id' => 'gds_headings_typography',
					'title' => esc_html__( 'Headings', 'gridster' ),
					'desc' => 'h1,h2,h3,h4,h5,h6,thead',
					'settings' => array(
						array(
							'id' => 'headings_font_family',
							'default' => 'Lato',
							'control' => array(
								'label' => esc_html__( 'Font Family', 'gridster' ),
								'type' => 'google_font',
							),
							'inline_css' => array(
								'target' => 'h1,h2,h3,h4,h5,h6,.gds-heading-font-family,.gds-heading,.gds-loop-entry-social-share-list a,.gds-social-profiles-widget,thead, tfoot th,.cart-collaterals .cart_totals th',
								'alter' => 'font-family',
							),
						),
						array(
							'id' => 'headings_font_weight',
							'control' => array(
								'label' => esc_html__( 'Font Weight', 'gridster' ),
								'type' => 'select',
								'choices' => $font_weights,
							),
							'inline_css' => array(
								'target' => 'h1,h2,h3,h4,h5,h6,.gds-heading-font-family,.gds-heading,.gds-loop-entry-social-share-list a,.gds-social-profiles-widget',
								'alter' => 'font-weight',
							),
						),
						array(
							'id' => 'headings_letter_spacing',
							'control' => array(
								'label' => esc_html__( 'Letter Spacing', 'gridster' ),
							),
							'inline_css' => array(
								'target' => 'h1,h2,h3,h4,h5,h6,.gds-heading-font-family,.gds-heading,.gds-loop-entry-social-share-list a,.gds-social-profiles-widget',
								'alter' => 'letter-spacing',
								'sanitize' => 'px',
							),
						),
					),
				),

			),
		);

		/*-----------------------------------------------------------------------------------*/
		/* - Styling Panel
		/*-----------------------------------------------------------------------------------*/
		$panels['styling'] = array(
			'title' => esc_html__( 'Styling', 'powered' ),
			'sections' => array(

				// Styling > Main
				array(
					'id' => 'pwd_styling_main',
					'title' => esc_html__( 'Main', 'powered' ),
					'settings' => array(
						array(
							'id' => 'primary_accent_color',
							'default' => '#3f91eb',
							'control' => array(
								'label' => esc_html__( 'Accent Color', 'powered' ),
								'type' => 'color',
							),
						),
						array(
							'id' => 'secondary_accent_color',
							'default' => '#fff',
							'control' => array(
								'label' => esc_html__( 'Accent Color', 'powered' ),
								'type' => 'color',
							),
						),
						array(
							'id' => 'link_color',
							'control' => array(
								'label' => esc_html__( 'Links', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => 'a,.pwd-site-content h2 a:hover,.pwd-site-content h3 a:hover',
								'sanitize' => 'hex',
								'alter' => 'color',
							),
						),
					),
				),

				// Styling > Header
				array(
					'id' => 'pwd_styling_header',
					'title' => esc_html__( 'Header', 'powered' ),
					'settings' => array(
						array(
							'id' => 'header_bg',
							'control' => array(
								'label' => esc_html__( 'Background Color', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-header-wrap',
								'alter' => 'background-color',
								'important' => true,
								'sanitize' => 'hex',
							),
						),
						array(
							'id' => 'header_top_padding',
							'control' => array(
								'label' => esc_html__( 'Top Padding', 'powered' ),
								'type' => 'text',
							),
							'inline_css' => array(
								'target' => '.pwd-site-header',
								'alter' => 'padding-top',
							),
						),
						array(
							'id' => 'header_bottom_padding',
							'control' => array(
								'label' => esc_html__( 'Bottom Padding', 'powered' ),
								'type' => 'text',
							),
							'inline_css' => array(
								'target' => '.pwd-site-header',
								'alter' => 'padding-top',
							),
						),
						array(
							'id' => 'logo_color',
							'control' => array(
								'label' => esc_html__( 'Logo Color', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-logo a',
								'alter' => array(
									'color',
									'border-color',
								),
								'important' => true,
							),
						),
						array(
							'id' => 'site_description_color',
							'control' => array(
								'label' => esc_html__( 'Site Description Color', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-description',
								'important' => true,
								'alter' => 'color',
								'sanitize' => 'hex',
							),
						),
					),
				),

				// Styling > Menu
				array(
					'id' => 'pwd_styling_nav',
					'title' => esc_html__( 'Menu', 'powered' ),
					'settings' => array(
						array(
							'id' => 'nav_bg',
							'control' => array(
								'label' => esc_html__( 'Menu Background', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-nav-wrap',
								'alter' => 'background-color',
								'sanitize' => 'hex',
							),
						),
						array(
							'id' => 'nav_color',
							'control' => array(
								'label' => esc_html__( 'Menu Link Color', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-nav .pwd-dropdown-menu a,.pwd-menu-search-toggle',
								'alter' => 'color',
								'sanitize' => 'hex',
							),
						),
						array(
							'id' => 'nav_color_hover',
							'control' => array(
								'label' => esc_html__( 'Menu Link Hover Color', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-nav .pwd-dropdown-menu li a:hover,.pwd-site-nav .pwd-dropdown-menu > li.menu-item-has-children:hover > a',
								'alter' => 'color',
								'sanitize' => 'hex',
							),
						),
						array(
							'id' => 'nav_color_hover_bg',
							'control' => array(
								'label' => esc_html__( 'Menu Link Hover Background', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-nav .pwd-dropdown-menu li a:hover,.pwd-site-nav .pwd-dropdown-menu > li.menu-item-has-children:hover > a,.pwd-menu-search-toggle:hover',
								'alter' => 'background-color',
								'sanitize' => 'hex',
							),
						),
						array(
							'id' => 'nav_color_active',
							'control' => array(
								'label' => esc_html__( 'Menu Link Active Color', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-nav .pwd-dropdown-menu > li.current-menu-item > a,.pwd-site-nav .pwd-dropdown-menu > li.parent-menu-item > a,.pwd-site-nav .pwd-dropdown-menu > li.current-menu-ancestor > a',
								'alter' => 'color',
								'sanitize' => 'hex',
							),
						),
						array(
							'id' => 'nav_color_active_bg',
							'control' => array(
								'label' => esc_html__( 'Menu Link Active Background', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-nav .pwd-dropdown-menu > li.current-menu-item > a,.pwd-site-nav .pwd-dropdown-menu > li.parent-menu-item > a,.pwd-site-nav .pwd-dropdown-menu > li.current-menu-ancestor > a',
								'alter' => 'background-color',
								'sanitize' => 'hex',
							),
						),
						array(
							'id' => 'nav_drop_bg',
							'control' => array(
								'label' => esc_html__( 'Menu Dropdown Background', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-nav .pwd-dropdown-menu .sub-menu',
								'alter' => 'background-color',
								'sanitize' => 'hex',
							),
						),
						array(
							'id' => 'nav_drop_color',
							'control' => array(
								'label' => esc_html__( 'Menu Dropdown Link Color', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-nav .pwd-dropdown-menu .sub-menu a',
								'alter' => 'color',
								'sanitize' => 'hex',
							),
						),
						array(
							'id' => 'nav_drop_color_hover',
							'control' => array(
								'label' => esc_html__( 'Menu Dropdown Link Hover Color', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-nav .pwd-dropdown-menu .sub-menu a:hover',
								'alter' => 'color',
								'sanitize' => 'hex',
								'important' => true,
							),
						),
						array(
							'id' => 'nav_drop_color_hover_bg',
							'control' => array(
								'label' => esc_html__( 'Menu Dropdown Link Hover Background', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-nav .pwd-dropdown-menu .sub-menu a:hover',
								'alter' => 'background-color',
								'sanitize' => 'hex',
								'important' => true,
							),
						),
					),
				),

				// Sidebar
				array(
					'id' => 'pwd_styling_sidebar',
					'title' => esc_html__( 'Sidebar', 'powered' ),
					'settings' => array(
						array(
							'id' => 'sidebar_text_color',
							'control' => array(
								'label' => esc_html__( 'Text', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-sidebar',
								'alter' => 'color',
								'sanitize' => 'hex',
							),
						),
						array(
							'id' => 'sidebar_links_color',
							'control' => array(
								'label' => esc_html__( 'Links', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-sidebar-widget a',
								'alter' => 'color',
								'sanitize' => 'hex',
							),
						),
						array(
							'id' => 'sidebar_links_hover_color',
							'control' => array(
								'label' => esc_html__( 'Links: Hover', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-sidebar-widget a:hover',
								'alter' => 'color',
								'sanitize' => 'hex',
							),
						),
					),
				),

				// Footer
				array(
					'id' => 'pwd_styling_footer',
					'title' => esc_html__( 'Footer', 'powered' ),
					'settings' => array(
						array(
							'id' => 'footer_bg',
							'control' => array(
								'label' => esc_html__( 'Background ', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-footer',
								'sanitize' => 'hex',
								'alter' => 'background-color',
							),
						),
						array(
							'id' => 'footer_borders',
							'control' => array(
								'label' => esc_html__( 'borders ', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-footer ul li,.pwd-footer-widgets .widget_archive li,.pwd-footer-widgets .widget_recent_entries li,.pwd-footer-widgets .widget_categories li,.pwd-footer-widgets .widget_meta li,.pwd-footer-widgets .widget_recent_comments li,.pwd-footer-widgets .widget_nav_menu li,.pwd-footer-widgets .widget-recent-list li,.pwd-site-footer #wp-calendar td,.pwd-footer-widgets .widget_pages li',
								'sanitize' => 'hex',
								'alter' => 'border-color',
							),
						),
						array(
							'id' => 'footer_color',
							'control' => array(
								'label' => esc_html__( 'Color ', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-footer',
								'sanitize' => 'hex',
								'alter' => 'color',
							),
						),
						array(
							'id' => 'footer_widget_title_color',
							'control' => array(
								'label' => esc_html__( 'Widget Titles', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-footer-widgets .widget-title',
								'sanitize' => 'hex',
								'alter' => 'color',
							),
						),
						array(
							'id' => 'footer_link',
							'control' => array(
								'label' => esc_html__( 'Links', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-footer-widgets a,.pwd-footer-widgets .widget-recent-list .pwd-title a,.pwd-footer-widgets a,.pwd-footer-widgets .widget-recent-list .pwd-title a,.pwd-footer-widgets .pwd-widget-popular-posts li a',
								'sanitize' => 'hex',
								'alter' => 'color',
							),
						),
						array(
							'id' => 'footer_link_hover',
							'control' => array(
								'label' => esc_html__( 'Links: Hover ', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-site-footer a:hover,.pwd-footer-widgets .widget-recent-list .pwd-title a:hover,.pwd-footer-widgets a:hover,.pwd-footer-widgets .widget-recent-list .pwd-title a:hover,.pwd-footer-widgets .pwd-widget-popular-posts li a:hover',
								'sanitize' => 'hex',
								'alter' => 'color',
							),
						),
					),
				),

				// Footer Bottom
				array(
					'id' => 'pwd_styling_footer_bottom_bottom',
					'title' => esc_html__( 'Footer Bottom', 'powered' ),
					'settings' => array(
						array(
							'id' => 'footer_bottom_bg',
							'control' => array(
								'label' => esc_html__( 'Background ', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-footer-bottom',
								'sanitize' => 'hex',
								'alter' => 'background-color',
							),
						),
						array(
							'id' => 'footer_bottom_border',
							'control' => array(
								'label' => esc_html__( 'Border ', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-footer-bottom',
								'sanitize' => 'hex',
								'alter' => 'border-top-color',
							),
						),
						array(
							'id' => 'footer_bottom_color',
							'control' => array(
								'label' => esc_html__( 'Color ', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-footer-bottom',
								'sanitize' => 'hex',
								'alter' => 'color',
							),
						),
						array(
							'id' => 'footer_bottom_link',
							'control' => array(
								'label' => esc_html__( 'Links', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-footer-bottom a',
								'sanitize' => 'hex',
								'alter' => 'color',
							),
						),
						array(
							'id' => 'footer_bottom_link_hover',
							'control' => array(
								'label' => esc_html__( 'Links: Hover ', 'powered' ),
								'type' => 'color',
							),
							'inline_css' => array(
								'target' => '.pwd-footer-bottom a:hover',
								'sanitize' => 'hex',
								'alter' => 'color',
							),
						),
					),
				),

			),
		);

		/*-----------------------------------------------------------------------------------*/
		/* - Image Sizes
		/*-----------------------------------------------------------------------------------*/
		$image_sizes             = array();
		$get_image_sizes         = pwd_get_image_sizes();
		$crop_locations          = pwd_image_crop_locations();
		$crop_locations['false'] = esc_html__( 'False', 'powered' );
		$desc = esc_html__( 'If you alter any image sizes you will have to regenerate your thumbnails.', 'powered' );
		foreach ( $get_image_sizes as $id => $label ) {
			$image_sizes[] = array(
				'id' => 'pwd_'. $id .'_thumbnail_sizes',
				'title' => $label,
				'desc' => $desc,
				'settings' => array(
					array(
						'id' => $id .'_thumb_width',
						'default' => '9999',
						'transport' => 'postMessage',
						'control' => array(
							'label' => esc_html__( 'Image Width', 'powered' ),
							'type' => 'text',
						),
					),
					array(
						'id' => $id .'_thumb_height',
						'default' => '9999',
						'transport' => 'postMessage',
						'control' => array(
							'label' => esc_html__( 'Image Height', 'powered' ),
							'type' => 'text',
						),
					),
					array(
						'id' => $id .'_thumb_crop',
						'default' => 'false',
						'transport' => 'postMessage',
						'control' => array(
							'label' => esc_html__( 'Crop', 'powered' ),
							'type' => 'select',
							'choices' => $crop_locations,
						),
					),
				),
			);
		}

		$panels['image_sizes'] = array(
			'title' => esc_html__( 'Image Sizes', 'powered' ),
			'desc' => esc_html__( 'By default this theme does not crop any images so you can customize your settings first and prevent unnecessary image cropping. Below you will find all the settings needed to crop the images on your site. Be sure to install a regenerate plugin so you can regenerate your thumbnails whenvever you alter these values.', 'powered' ),
			'sections' => $image_sizes,
		);

		// Return panels array
		return $panels;

	}
}
add_filter( 'pwd_customizer_panels', 'pwd_customizer_config' );

// Callback functions
function pwd_customizer_has_related_posts() {
	if ( get_theme_mod( 'post_related', true ) && get_theme_mod( 'post_related_count', 6 ) ) {
		return true;
	} else {
		return false;
	}
}