<?php
/**
 * Footer Layout
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

?>

<?php get_template_part( 'partials/footer/footer-popular' ); ?>

<footer class="pwd-site-footer"<?php pwd_schema_markup( 'footer' ); ?>>

	<?php if ( pwd_has_footer_widgets() ) : ?>

		<?php get_template_part( 'partials/footer/footer-widgets' ); ?>

	<?php endif; ?>

	<?php if ( get_theme_mod( 'footer_bottom', true  ) ) : ?>

		<div class="pwd-footer-bottom">

			<div class="pwd-container"><?php

				get_template_part( 'partials/footer/footer-copyright' );

			?></div><!-- .pwd-container -->

		</div><!-- .pwd-footer-bottom -->

	<?php endif; ?>

</footer><!-- .pwd-site-footer -->