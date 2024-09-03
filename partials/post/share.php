<?php
/**
 * Outputs social sharing links for single posts
 *
 * @package   Powered WordPress Theme
 * @author    WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define vars
$title       = urlencode( esc_attr( the_title_attribute( 'echo=0' ) ) );
$url         = rawurlencode( esc_url( get_permalink( get_the_ID() ) ) );
$thumbnail   = urlencode( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) );
$description = urlencode( pwd_sanitize( get_the_excerpt(), 'html' ) );

?>

<div class="pwd-post-share">
	<ul>
		<li class="pwd-twitter">
			<a href="<?php echo esc_url( "https://x.com/share?text={$title}&amp;url={$url}" ); ?>" aria-label="<?php esc_attr_e( 'Post on X', 'wpex-powered' ); ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class=pwd-svg aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg></span><?php esc_html_e( 'Post', 'wpex-powered' ); ?></a>
		</li>
		<li class="pwd-facebook">
			<a href="<?php echo esc_url( "https://www.facebook.com/share.php?u={$url}" ); ?>" aria-label="<?php esc_attr_e( 'Share on Facebook', 'wpex-powered' ); ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="pwd-svg" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z"/></svg></span><?php esc_html_e( 'Share', 'wpex-powered' ); ?></a>
		</li>
		<li class="pwd-pinterest">
			<a href="<?php echo esc_url( "https://pinterest.com/pin/create/button/?url={$url}&amp;media={$thumbnail}&amp;description={$description}" ); ?>" aria-label="<?php esc_attr_e( 'Share on Pinterest', 'wpex-powered' ); ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="pwd-svg" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3 .8-3.4 5-20.3 6.9-28.1 .6-2.5 .3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z"/></svg></span><?php esc_html_e( 'Pin it', 'wpex-powered' ); ?></a>
		</li>
	</ul>
</div><!-- .pwd-post-share -->