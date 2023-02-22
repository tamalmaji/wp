<?php
function Paleo_scripts()
{
	/*css*/

	wp_enqueue_style('bootstrap-min-css', get_template_directory_uri() . '/asset/css/bootstrap.min.css', array(), '1.0', 'all');

	wp_enqueue_style('gfont1', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap', array(), '1.1', 'all');
	wp_enqueue_style('gfont2', 'https://fonts.googleapis.com/css2?family=Teko:wght@300;400;500;600;700&display=swap', array(), '1.1', 'all');
	wp_enqueue_style('all', 'https://use.fontawesome.com/releases/v5.1.1/css/all.css', array(), '1.1', 'all');
	wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), '1.1', 'all');


	// wp_enqueue_style('icons-css', get_template_directory_uri() . '/asset/fonts/icomoon/icons.css', array(), '1.1', 'all');
	wp_enqueue_style('slick-css', get_template_directory_uri() . '/asset/css/slick.css', array(), '1.1', 'all');
	if (is_front_page()) {
		wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/asset/css/slick-theme.css', array(), '1.1', 'all');
	}
	if (is_page(194)) {
		wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/asset/css/slick-theme.css', array(), '1.1', 'all');
	}

	//custom links  
	wp_enqueue_style('custom-css', get_template_directory_uri() . '/asset/css/custom.css', array(), '1.1', 'all');
	wp_enqueue_style('responsive-css', get_template_directory_uri() . '/asset/css/responsive.css', array(), '1.1', 'all');
	wp_enqueue_style('developer-css', get_template_directory_uri() . '/asset/css/developer.css', array(), '1.1', 'all');



	/*js*/
	// wp_enqueue_script('popper', get_template_directory_uri() . '/asset/js/popper.min.js', array('jquery'), 1.1, true);
	wp_enqueue_script('bootstrap-bundle-min', get_template_directory_uri() . '/asset/js/bootstrap.bundle.min.js', array('jquery'), 1.1, true);
	wp_enqueue_script('slick-js', get_template_directory_uri() . '/asset/js/slick.min.js', array('jquery'), 1.1, true);
	// wp_enqueue_script('main-js', get_template_directory_uri() . '/asset/js/main.js', array('jquery'), 1.1, true);

	wp_enqueue_script('custom-js', get_template_directory_uri() . '/asset/js/custom.js', array('jquery'), 1.1, true);
	// wp_enqueue_script('developer', get_template_directory_uri() . '/asset/js/developer.js', array('jquery'), 1.1, true);
}

add_action('wp_enqueue_scripts', 'Paleo_scripts');
