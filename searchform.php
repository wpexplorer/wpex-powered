<?php
/**
 * The template for displaying search forms.
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.stplorer.com
 * @since     1.0.0
 */ ?>

<form method="get" class="pwd-site-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="field" name="s" value="<?php esc_html_e( 'Search', 'powered' ); ?>&hellip;" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
	<button type="submit"><span class="fa fa-search"></span></button>
</form>