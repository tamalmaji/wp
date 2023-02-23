<?php
/*
* Creating a function to create our CPT
*/
  
function custom_post_type() {
  
	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Special Moments', 'Post Type General Name', 'custom theme' ),
			'singular_name'       => _x( 'Special Moment', 'Post Type Singular Name', 'custom theme' ),
			'menu_name'           => __( 'Special Moments', 'custom theme' ),
			'parent_item_colon'   => __( 'Parent Special Moments', 'custom theme' ),
			'all_items'           => __( 'All Special Moments', 'custom theme' ),
			'view_item'           => __( 'View Special Moments', 'custom theme' ),
			'add_new_item'        => __( 'Add New Special Moments', 'custom theme' ),
			'add_new'             => __( 'Add New', 'custom theme' ),
			'edit_item'           => __( 'Edit Special Moments', 'custom theme' ),
			'update_item'         => __( 'Update Special Moments', 'custom theme' ),
			'search_items'        => __( 'Search Special Moments', 'custom theme' ),
			'not_found'           => __( 'Not Found', 'custom theme' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'custom theme' ),
		);
		  
	// Set other options for Custom Post Type
		  
		$args = array(
			'label'               => __( 'Special Moment', 'custom theme' ),
			'description'         => __( 'Special Moment news and reviews', 'custom theme' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'genres', 'special_moment_taxanomy' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'rewrite' => array('slug' => 'specialmoment'),
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest' => true,
	  
		);
		  
		// Registering your Custom Post Type
		register_post_type( 'Specialmoment', $args );
	  
	}
	  
	/* Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/
	  
	add_action( 'init', 'custom_post_type', 0 );


	add_action('init', 'create_project_taxonomies', 0);

function create_project_taxonomies()
{
	register_taxonomy(
		'special_moment_taxanomy', // Taxonomy slug
		'specialmoment', // Cpt slug
		array(
			'labels' => array(
				'name' => 'Category',
				'add_new_item' => 'Add New Category',
				'new_item_name' => "New Category"
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'show_admin_column' => true
		)
	);
}

