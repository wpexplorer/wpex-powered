<?php
/**
 * The Header for our theme.
 *
 * @package Powered WordPress Theme
 * @author  WPExplorer.com
 * @link    https://www.wpexplorer.com/
 * @since   1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?><?php pwd_schema_markup( 'body' ); ?>>

	<?php wp_body_open(); ?>

	<div id="pwd-site-top" tabindex="-1"></div>

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wpex-powered' ); ?></a>

	<?php do_action( 'pwd_after_body_tag' ); ?>

	<div class="pwd-site-wrap">

		<?php get_template_part( 'partials/layout-header' ); ?>

		<div id="content" class="pwd-site-content pwd-container">