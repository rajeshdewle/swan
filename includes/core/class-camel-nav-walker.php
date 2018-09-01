<?php
/**
 * -----------------------------------------------------------------------------
 * Camel Framework Theme Nav Walker
 * -----------------------------------------------------------------------------
 *
 * @package Camel_Framework
 */

if (! class_exists('Camel_Navwalker')) {
    class Camel_Navwalker extends Walker_Nav_Menu
    {
        /**
         * Display array of elements hierarchically.
         *
         * Does not assume any existing order of elements.
         *
         * $max_depth = -1 means flatly display every element.
         * $max_depth = 0 means display all levels.
         * $max_depth > 0 specifies the number of display levels.
         *
         * @since 2.1.0
         *
         * @param array $elements  An array of elements.
         * @param int   $max_depth The maximum hierarchical depth.
         * @return string The hierarchical item output.
         */
        public function walk($elements, $max_depth)
        {
            $args = array_slice(func_get_args(), 2);
            $output = '';

            $argsArray = (array) $args[0];

            if ($argsArray['has_home_icon']) {
                $link_classes = [];
                $link_classes[] = ! empty($argsArray['link_class']) ? $argsArray['link_class']  : '';
                $link_classes[] = ($this->has_children) ? 'dropdown-toggle' : '';
                $linkClasses = implode(' ', $link_classes);

                $list_Classes[] = 'menu-item';
                if (is_home()) {
                    $list_Classes[] = 'active';
                }
                $listClasses = implode(' ', $list_Classes);
                $home_icon = isset($argsArray['home_icon']) ? $argsArray['home_icon'] : '';

                $output .= '<li class="' . $listClasses . '"><a class="' . $linkClasses . '" href="/">
                    ' . $home_icon . '
                </a></li>';
            }

            //invalid parameter or nothing to walk
            if ($max_depth < -1 || empty($elements)) {
                return $output;
            }

            $parent_field = $this->db_fields['parent'];

            // flat display
            if (-1 == $max_depth) {
                $empty_array = [];
                foreach ($elements as $e) {
                    $this->display_element($e, $empty_array, 1, 0, $args, $output);
                }
                return $output;
            }

            /*
            * Need to display in hierarchical order.
            * Separate elements into two buckets: top level and children elements.
            * Children_elements is two dimensional array, eg.
            * Children_elements[10][] contains all sub-elements whose parent is 10.
            */
            $top_level_elements = [];
            $children_elements  = [];
            foreach ($elements as $e) {
                if (empty($e->$parent_field)) {
                    $top_level_elements[] = $e;
                } else {
                    $children_elements[ $e->$parent_field ][] = $e;
                }
            }

            /*
            * When none of the elements is top level.
            * Assume the first one must be root of the sub elements.
            */
            if (empty($top_level_elements)) {
                $first = array_slice($elements, 0, 1);
                $root = $first[0];

                $top_level_elements = [];
                $children_elements  = [];
                foreach ($elements as $e) {
                    if ($root->$parent_field == $e->$parent_field) {
                        $top_level_elements[] = $e;
                    } else {
                        $children_elements[ $e->$parent_field ][] = $e;
                    }
                }
            }

            foreach ($top_level_elements as $e) {
                $this->display_element($e, $children_elements, $max_depth, 0, $args, $output);
            }

            /*
            * If we are displaying all levels, and remaining children_elements is not empty,
            * then we got orphans, which should be displayed regardless.
            */
            if (($max_depth == 0) && count($children_elements) > 0) {
                $empty_array = [];
                foreach ($children_elements as $orphans) {
                    foreach ($orphans as $op) {
                        $this->display_element($op, $empty_array, 1, 0, $args, $output);
                    }
                }
            }

            return $output;
        }

        /**
         * Starts the list before the elements are added.
         *
         * @since 3.0.0
         *
         * @see Walker::start_lvl()
         *
         * @param string   $output Used to append additional content (passed by reference).
         * @param int      $depth  Depth of menu item. Used for padding.
         * @param stdClass $args   An object of wp_nav_menu() arguments.
         */
        public function start_lvl(&$output, $depth = 0, $args = [])
        {
            if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
                $t = '';
                $n = '';
            } else {
                $t = "\t";
                $n = "\n";
            }
            $indent = str_repeat($t, $depth);

            // Default class.
            $argsArray = (array) $args;

            $subMenuClass = ! empty($argsArray['submenu_class']) ? $argsArray['submenu_class'] : '';
            $classes = [ 'sub-menu' ];
            $classes[] = $subMenuClass;

            /**
             * Filters the CSS class(es) applied to a menu list element.
             *
             * @since 4.8.0
             *
             * @param array    $classes The CSS classes that are applied to the menu `<ul>` element.
             * @param stdClass $args    An object of `wp_nav_menu()` arguments.
             * @param int      $depth   Depth of menu item. Used for padding.
             */
            $class_names = join(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            $output .= "{$n}{$indent}<ul$class_names aria-labelledby=\"sub-menu\">{$n}";
        }

        /**
         * Starts the element output.
         *
         * @since 3.0.0
         * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
         *
         * @see Walker::start_el()
         *
         * @param string   $output Used to append additional content (passed by reference).
         * @param WP_Post  $item   Menu item data object.
         * @param int      $depth  Depth of menu item. Used for padding.
         * @param stdClass $args   An object of wp_nav_menu() arguments.
         * @param int      $id     Current item ID.
         */
        public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
        {
            if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
                $t = '';
                $n = '';
            } else {
                $t = "\t";
                $n = "\n";
            }
            $indent = ($depth) ? str_repeat($t, $depth) : '';

            // Apply list classes to 'li' element
            $argsArray = (array) $args;
            $item->classes[] = ! empty($argsArray['list_class']) ? $argsArray['list_class'] : '';

            $classes = empty($item->classes) ? [] : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;


            /**
             * Filters the arguments for a single nav menu item.
             *
             * @since 4.4.0
             *
             * @param stdClass $args  An object of wp_nav_menu() arguments.
             * @param WP_Post  $item  Menu item data object.
             * @param int      $depth Depth of menu item. Used for padding.
             */
            $args = apply_filters('nav_menu_item_args', $args, $item, $depth);


            // Add .dropdown or .active classes where they are needed.
            if ($this->has_children) {
                $classes[] = 'dropdown';
            }

            if (in_array('current-menu-item', $classes, true) || in_array('current-menu-parent', $classes, true)) {
                $classes[] = 'active';
            }

            /**
             * Filters the CSS class(es) applied to a menu item's list item element.
             *
             * @since 3.0.0
             * @since 4.1.0 The `$depth` parameter was added.
             *
             * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
             * @param WP_Post  $item    The current menu item.
             * @param stdClass $args    An object of wp_nav_menu() arguments.
             * @param int      $depth   Depth of menu item. Used for padding.
             */
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            /**
             * Filters the ID applied to a menu item's list item element.
             *
             * @since 3.0.1
             * @since 4.1.0 The `$depth` parameter was added.
             *
             * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
             * @param WP_Post  $item    The current menu item.
             * @param stdClass $args    An object of wp_nav_menu() arguments.
             * @param int      $depth   Depth of menu item. Used for padding.
             */
            $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $class_names .'>';

            $link_classes = [];
            $link_classes[] = ! empty($argsArray['link_class']) ? $argsArray['link_class']  : '';
            $link_classes[] = ($this->has_children) ? 'dropdown-toggle' : '';

            $atts = [];
            $atts['title']  = ! empty($item->attr_title)  ? $item->attr_title : '';
            $atts['target'] = ! empty($item->target)      ? $item->target     : '';
            $atts['rel']    = ! empty($item->xfn)         ? $item->xfn        : '';
            $atts['href']   = ! empty($item->url)         ? $item->url        : '';
            $atts['class']  = ! empty($link_classes)       ?  implode(' ', $link_classes)     : '';


            if ($this->has_children) {
                $atts['id'] = 'menu-item-dropdown-' . $item->ID;
                $atts['data-toggle'] = 'dropdown';
                $atts['aria-haspopup'] = 'true';
                $atts['aria-expanded'] = 'false';
            }

            /**
             * Filters the HTML attributes applied to a menu item's anchor element.
             *
             * @since 3.6.0
             * @since 4.1.0 The `$depth` parameter was added.
             *
             * @param array $atts {
             *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
             *
             *     @type string $title  Title attribute.
             *     @type string $target Target attribute.
             *     @type string $rel    The rel attribute.
             *     @type string $href   The href attribute.
             * }
             * @param WP_Post  $item  The current menu item.
             * @param stdClass $args  An object of wp_nav_menu() arguments.
             * @param int      $depth Depth of menu item. Used for padding.
             */
            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (! empty($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            /** This filter is documented in wp-includes/post-template.php */
            $title = apply_filters('the_title', $item->title, $item->ID);

            /**
             * Filters a menu item's title.
             *
             * @since 4.4.0
             *
             * @param string   $title The menu item's title.
             * @param WP_Post  $item  The current menu item.
             * @param stdClass $args  An object of wp_nav_menu() arguments.
             * @param int      $depth Depth of menu item. Used for padding.
             */
            $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            /**
             * Filters a menu item's starting output.
             *
             * The menu item's starting output only includes `$args->before`, the opening `<a>`,
             * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
             * no filter for modifying the opening and closing `<li>` for a menu item.
             *
             * @since 3.0.0
             *
             * @param string   $item_output The menu item's starting HTML output.
             * @param WP_Post  $item        Menu item data object.
             * @param int      $depth       Depth of menu item. Used for padding.
             * @param stdClass $args        An object of wp_nav_menu() arguments.
             */
            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }
    }
}
