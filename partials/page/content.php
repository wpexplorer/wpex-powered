<?php
/**
 * Returns the page layout components
 *
 * @package   Powered WordPress Theme
 * @author    Alexander Clarke
 * @copyright Copyright (c) 2015, WPExplorer.com
 * @link      https://www.wpexplorer.com/
 * @since     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<div class="pwd-page-content pwd-entry pwd-clr">
    <?php the_content(); ?>
    <?php get_template_part( 'partials/global/link-pages' ); ?>
</div><!-- .pwd-entry -->