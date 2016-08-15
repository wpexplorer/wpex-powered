<?php
/**
 * The post entry title
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

$allows_embeds = pwd_get_theme_mod( 'entry_embeds', false ); ?>

<header class="pwd-loop-entry-header pwd-clr">
	<h2 class="pwd-loop-entry-title">
		<a href="<?php the_permalink(); ?>" title="<?php pwd_esc_title(); ?>"><?php

			// Format icons
			if ( pwd_has_post_video() ) {

				echo '<span class="fa fa-play pwd-loop-entry-format-icon"></span>';

			} elseif ( pwd_has_post_audio() && ! pwd_get_theme_mod( 'entry_embeds', false ) ) {

				echo '<span class="fa fa-music pwd-loop-entry-format-icon"></span>';

			}

			// Display title
			the_title();

		?></a>
	</h2><!-- .pwd-loop-entry-title -->
</header><!-- .pwd-loop-entry-header -->