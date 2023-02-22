<?php
//Add Active class in WP Nav Menu
add_filter('nav_menu_css_class', 'add_active_class', 10, 2);
function add_active_class($classes, $item)
{
	if ($item->menu_item_parent == 0 && in_array('current-menu-item', $classes)) {
		$classes[] = "active";
	}
	return $classes;
}