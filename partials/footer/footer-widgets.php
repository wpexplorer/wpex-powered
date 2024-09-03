<?php
/**
 * Footer widgets
 *
 * @package   Powered WordPress Theme
 * @author    WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get footer columns option
$columns = absint( pwd_get_theme_mod( 'footer_widget_columns', 4 ) );

// Bail if columns is set to NULL
if ( ! $columns || '0' === $columns ) {
    return;
}

?>

<div class="pwd-footer-widgets-wrap pwd-container">

    <div class="pwd-footer-widgets pwd-row pwd-row-cols-<?php echo absint( $columns ); ?>">

        <?php if ( $columns >= 1 ) : ?>

            <div class="pwd-footer-box pwd-col">
                <?php dynamic_sidebar( 'footer-one' ); ?>
            </div><!-- .footer-box -->

        <?php endif; ?>

        <?php if ( $columns > 1 ) : ?>

            <div class="pwd-footer-box pwd-col">
                <?php dynamic_sidebar( 'footer-two' ); ?>
            </div><!-- .footer-box -->

        <?php endif; ?>

        <?php if ( $columns > 2 ) : ?>

            <div class="pwd-footer-box pwd-col">
                <?php dynamic_sidebar( 'footer-three' ); ?>
            </div><!-- .footer-box -->

        <?php endif; ?>

        <?php if ( $columns > 3 ) : ?>

            <div class="pwd-footer-box pwd-col">
                <?php dynamic_sidebar( 'footer-four' ); ?>
            </div><!-- .footer-box -->

        <?php endif; ?>

    </div><!-- .pwd-footer-widgets -->

</div><!-- .pwd-footer-widgets-wrap -->