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
    <label>
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
        <input type="search" class="search-field form-control mr-sm-2" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    </label>
    <input type="submit" class="btn btn-outline-primary my-2 my-sm-0" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
</form>