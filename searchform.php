<?php
/**
 * The template for displaying search forms.
 *
 * @package   Powered WordPress Theme
 * @author    WPExplorer.com
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */ ?>

<form method="get" class="pwd-site-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="pwd-site-search-input" class="screen-reader-text"><?php esc_html_e( 'search', 'wpex-powered' ); ?></label>
    <input id="pwd-site-search-input" type="search" class="field" name="s" placeholder="<?php esc_attr_e( 'Search', 'wpex-powered' ); ?>&hellip;" />
	<button type="submit"><span class="fa fa-search" aria-hidden="true"></span><span class="screen-reader-text"><?php esc_html_e( 'submit search', 'wpex-powered' ); ?></span></button>
</form>