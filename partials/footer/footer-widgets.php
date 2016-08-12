<?php
/**
 * Footer widgets
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

// Get footer columns option
$columns = pwd_get_theme_mod( 'footer_widget_columns', 4 );

// Bail if columns is set to NULL
if ( ! $columns || '0' == $columns ) {
    return;
}

// Widget classes
$classes = 'pwd-footer-box pwd-col pwd-clr';
$classes .= ' pwd-col-' . intval( $columns ); ?>

<div class="pwd-footer-widgets-wrap pwd-container pwd-clr">

    <div class="pwd-footer-widgets pwd-row pwd-clr">

        <?php if ( $columns >= 1 ) : ?>

            <div class="<?php echo esc_attr( $classes ) ?>">
                <?php dynamic_sidebar( 'footer-one' ); ?>
            </div><!-- .footer-box -->

        <?php endif; ?>

        <?php if ( $columns > 1 ) : ?>

            <div class="<?php echo esc_attr( $classes ) ?>">
                <?php dynamic_sidebar( 'footer-two' ); ?>
            </div><!-- .footer-box -->

        <?php endif; ?>

        <?php if ( $columns > 2 ) : ?>

            <div class="<?php echo esc_attr( $classes ) ?>">
                <?php dynamic_sidebar( 'footer-three' ); ?>
            </div><!-- .footer-box -->

        <?php endif; ?>

        <?php if ( $columns > 3 ) : ?>

            <div class="<?php echo esc_attr( $classes ) ?>">
                <?php dynamic_sidebar( 'footer-four' ); ?>
            </div><!-- .footer-box -->
            
        <?php endif; ?>

    </div><!-- .pwd-footer-widgets -->

</div><!-- .pwd-footer-widgets-wrap -->