<?php
/*
* Creating a function to create our CPT
*/
  
function custom_post_type() {
  
	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Special Moments', 'Post Type General Name', 'cyc' ),
			'singular_name'       => _x( 'Special Moment', 'Post Type Singular Name', 'cyc' ),
			'menu_name'           => __( 'Special Moments', 'cyc' ),
			'parent_item_colon'   => __( 'Parent Special Moments', 'cyc' ),
			'all_items'           => __( 'All Special Moments', 'cyc' ),
			'view_item'           => __( 'View Special Moments', 'cyc' ),
			'add_new_item'        => __( 'Add New Special Moments', 'cyc' ),
			'add_new'             => __( 'Add New', 'cyc' ),
			'edit_item'           => __( 'Edit Special Moments', 'cyc' ),
			'update_item'         => __( 'Update Special Moments', 'cyc' ),
			'search_items'        => __( 'Search Special Moments', 'cyc' ),
			'not_found'           => __( 'Not Found', 'cyc' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'cyc' ),
		);
		  
	// Set other options for Custom Post Type
		  
		$args = array(
			'label'               => __( 'Special Moment', 'cyc' ),
			'description'         => __( 'Special Moment news and reviews', 'cyc' ),
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

