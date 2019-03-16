<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */ ?>

<div class="pwd-entry-none pwd-boxed-content pwd-clr">

	<?php if ( is_home() ) { ?>

		<p><?php esc_html_e( 'There aren\'t any posts currently published on this site.', 'wpex-powered' ); ?></p>

	<?php } elseif ( is_author() ) { ?>

		<p><?php esc_html_e( 'This author hasn\'t written any posts yet.', 'wpex-powered' ); ?></p>

	<?php } elseif ( is_search() ) { ?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms.', 'wpex-powered' ); ?></p>

	<?php } elseif ( is_category() ) { ?>

		<p><?php esc_html_e( 'There aren\'t any posts currently published in this category.', 'wpex-powered' ); ?></p>

	<?php } elseif ( is_tax() ) { ?>

		<p><?php esc_html_e( 'There aren\'t any posts currently published under this taxonomy.', 'wpex-powered' ); ?></p>

	<?php } elseif ( is_tag() ) { ?>

		<p><?php esc_html_e( 'There aren\'t any posts currently published under this tag.', 'wpex-powered' ); ?></p>

	<?php } elseif ( is_404() ) { ?>

		<h1>404</h1>
		<p><?php esc_html_e( 'Unfortunately, the page you are looking for does not exist', 'wpex-powered' ); ?></p>

	<?php } else { ?>

		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'wpex-powered' ); ?></p>

	<?php } ?>

</div><!-- .pwd-entry-none -->