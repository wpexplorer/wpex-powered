<?php
/**
 * Outputs a read more link for entries / Not used by default but available if you want to add it.
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

// Define text
$text = get_theme_mod( 'entry_readmore_text' );
$text = $text ? $text : esc_html__( 'Continue reading', 'wpex-powered' );
$text = apply_filters( 'pwd_entry_readmore_text', $text ); ?>


<?php if ( $text ) : ?>

	<div class="pwd-loop-entry-readmore pwd-clr">
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( $text ); ?>" class="pwd-readmore"><?php echo pwd_sanitize( $text, 'html' ); ?> <span class="pwd-readmore-arrow">&raquo;</span></a>
	</div><!-- .pwd-loop-entry-readmore -->

<?php endif; ?>