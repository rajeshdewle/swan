<?php
/**
 * -----------------------------------------------------------------------------
 * Template for displaying search forms
 * -----------------------------------------------------------------------------
 *
 * @link https://codex.wordpress.org/Creating_a_Search_Page
 *
 * @package Camel_Framework
 */

?>
<form role="search" method="get" class="form-inline" action="<?php echo home_url( '/' ); ?>">
    <label class="sr-only"><?php echo _x( 'Search for:', 'label', 'camel-framework' ) ?></label>
    <input type="search" class="form-control mr-sm-2 mb-2" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'camel-framework' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'camel-framework' ) ?>" />
    <button type="submit" class="btn btn-outline-primary my-2 my-sm-0">
        <?php echo esc_attr_x( 'Search', 'submit button', 'camel-framework' ) ?>
    </button>
</form>
