<?php
/**
 * The post entry title
 *
 * @package   Powered WordPress Theme
 * @author    WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="pwd-loop-entry-excerpt pwd-entry pwd-clr"><?php
	if ( post_password_required() ) : ?>
		<?php esc_html_e( 'This post is password protected you will need a password to access the article.', 'wpex-powered' ); ?>
	<?php elseif ( pwd_has_custom_excerpt( 'entry' ) ) : ?>
		<?php pwd_excerpt(); ?>
	<?php else : ?>
		<?php the_content(); ?>
	<?php endif;
?></div><!--.pwd-loop-entry-excerpt -->