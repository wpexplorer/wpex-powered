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
	<button type="submit"><span class="pwd-svg" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg></span><span class="screen-reader-text"><?php esc_html_e( 'submit search', 'wpex-powered' ); ?></span></button>
</form>