<?php
/**
 * Outputs the post header
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
} ?>

<header class="pwd-post-header pwd-clr">
	<h1 class="pwd-post-title"><span><?php the_title(); ?></span></h1>
	<?php if ( pwd_get_theme_mod( 'post_meta', true ) ) : ?>
		<?php get_template_part( 'partials/post/meta' ); ?>
	<?php endif; ?>
</header><!-- .pwd-post-header -->