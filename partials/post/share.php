<?php
/**
 * Outputs social sharing links for single posts
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

// Define vars
$title = urlencode( esc_attr( the_title_attribute( 'echo=0' ) ) );
$url   = rawurlencode( esc_url( get_permalink( get_the_ID() ) ) ); ?>

<div class="pwd-post-share">
	<ul>
		<li class="pwd-twitter">
			<a href="http://twitter.com/share?text=<?php echo $title; ?>&amp;url=<?php echo $url; ?>" title="<?php esc_attr_e( 'Share on Twitter', 'wpex-powered' ); ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<span class="fa fa-twitter" aria-hidden="true"></span><?php esc_html_e( 'Tweet', 'wpex-powered' ); ?>
			</a>
		</li>
		<li class="pwd-facebook">
			<a href="http://www.facebook.com/share.php?u=<?php echo $url; ?>" title="<?php esc_attr_e( 'Share on Facebook', 'wpex-powered' ); ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<span class="fa fa-facebook" aria-hidden="true"></span><?php esc_html_e( 'Share', 'wpex-powered' ); ?>
			</a>
		</li>
		<li class="pwd-pinterest">
			<a href="http://pinterest.com/pin/create/button/?url=<?php echo $url; ?>&amp;media=<?php echo urlencode( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ); ?>&amp;description=<?php echo urlencode( pwd_sanitize( get_the_excerpt(), 'html' ) ); ?>" title="<?php esc_attr_e( 'Share on Pinterest', 'wpex-powered' ); ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<span class="fa fa-pinterest" aria-hidden="true"></span><?php esc_html_e( 'Pin it', 'wpex-powered' ); ?>
			</a>
		</li>
	</ul>
</div><!-- .pwd-post-share -->