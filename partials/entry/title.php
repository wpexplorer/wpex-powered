<?php
/**
 * The post entry title
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

$allows_embeds = pwd_get_theme_mod( 'entry_embeds', false ); ?>

<header class="pwd-loop-entry-header">
	<h2 class="pwd-loop-entry-title">
		<a href="<?php the_permalink(); ?>"><?php

			// Format icons
			if ( pwd_has_post_video() ) {
				echo '<span class="pwd-svg pwd-loop-entry-format-icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg></span>';

			} elseif ( pwd_has_post_audio() && ! pwd_get_theme_mod( 'entry_embeds', false ) ) {
				echo '<span class="pwd-svg pwd-loop-entry-format-icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg></span>';
			}

			// Display title
			the_title();

		?></a>
	</h2><!-- .pwd-loop-entry-title -->
</header><!-- .pwd-loop-entry-header -->