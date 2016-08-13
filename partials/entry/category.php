<?php
/**
 * Entry category
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      http://www.stplorer.com
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Standard posts only
if ( 'post' != get_post_type() ) {
	return;
} ?>

<div class="pwd-loop-entry-cats pwd-clr"><?php

	$cats = get_the_category();
	$cat  = $cats[0];

	echo '<a href="'. esc_url( get_term_link( $cats[0], 'category' ) ) .'" title="'. $cat->name .'">'. $cat->name .'</a>';

?></div><!-- .pwd-loop-entry-cats -->