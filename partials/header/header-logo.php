<?php
/**
 * Outputs the header logo
 *
 * @package Powered WordPress Theme
 * @author  WPExplorer.com
 * @link    https://www.wpexplorer.com/
 * @since   1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$logo      = pwd_get_header_logo_src();
$blog_name = get_bloginfo( 'name' );

?>

<div class="pwd-site-logo"><?php
	// Display image logo
	if ( $logo ) :

		$logo_html = '<img alt="' . $blog_name . '" src="' . esc_url( $logo ) . '" fetchpriority="high"';

		$retina_logo = pwd_get_theme_mod( 'logo_retina' );

		$srcset = '';

		if ( $retina_logo ) {
			$logo_html .= ' srcset="' . esc_url( $logo ) . ' 1x,' . esc_url( $retina_logo ) . ' 2x"';
		}

		$logo_dims = [
			'height' => '',
			'width'  => '',
		];

		$attachment = attachment_url_to_postid( $logo );
		if ( $attachment ) {
			$attachment_data = wp_get_attachment_metadata( $attachment );
			if ( $attachment_data ) {
				$logo_dims['height'] = $attachment_data['height'] ?? '';
				$logo_dims['width'] = $attachment_data['width'] ?? '';
			}
		}

		$logo_html .= ' height="' . esc_attr( $logo_dims['height'] ) . '" width="' . esc_attr( $logo_dims['width'] ) . '"';

		$logo_html .= '>';

		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $blog_name ); ?>" rel="home"><?php echo $logo_html; ?></a>
	<?php
	// Text site logo
	else : ?>
		<div class="site-text-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $blog_name ); ?>" rel="home"><?php echo pwd_sanitize( $blog_name, 'html' ); ?></a>
		</div><!-- .site-text-logo -->
	<?php endif;
?></div><!-- .pwd-site-logo -->