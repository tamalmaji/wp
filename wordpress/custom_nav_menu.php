<?php
/*Custom nav bar*/

function register_my_menus()
{
	register_nav_menus(
		array(
			'Custom-primary-menu' => __('Custom Primary Menu'),
			'Custom-footer-menu' => __('Custom Footer Menu'),
			'Custom-footer-two-menu' => __('Custom Footer Two Menu'),
			'Custom-footer-three-menu' => __('Custom Footer Three Menu'),
		)
	);
}
add_action('init', 'register_my_menus');

/* End Custom nav bar */