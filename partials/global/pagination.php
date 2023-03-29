<?php
/**
 * Outputs pagination
 *
 * @package    Powered WordPress Theme
 * @author     WPExplorer.com
 * @copyright  Copyright (c) 2015, WPExplorer.com
 * @link       https://www.wpexplorer.com/
 * @since      1.0.0
 * @deprecated 1.1
 */

$is_rtl = is_rtl();
$forward = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>';
$backward = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>';

$left_arrow = $is_rtl ? $forward : $backward;
$right_arrow = $is_rtl ? $backward : $forward;
the_posts_pagination( apply_filters( 'pwd_pagination_args', array(
	'mid_size'  => 3,
	'prev_text' => '<i class="pwd-svg" aria-hidden="true">' . $left_arrow . '</i><span class="screen-reader-text">' . esc_html__( 'previous items', 'wpex-powered' ) . '</span>',
	'next_text' => '<i class="pwd-svg" aria-hidden="true">' . $right_arrow . '</i><span class="screen-reader-text">' . esc_html__( 'next items', 'wpex-powered' ) . '</span>',
) ) );