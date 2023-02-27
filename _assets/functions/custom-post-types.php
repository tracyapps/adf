<?php
/* buddyxprochild Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

*/

/**
 *  function to easily add capabilities for CPT
 */

function compile_post_type_capabilities($singular = null, $plural = null ) {
	return [
		'edit_post'		 => "edit_$singular",
		'read_post'		 => "read_$singular",
		'delete_post'		 => "delete_$singular",
		'edit_posts'		 => "edit_$plural",
		'edit_others_posts'	 => "edit_others_$plural",
		'publish_posts'		 => "publish_$plural",
		'read_private_posts'	 => "read_private_$plural",
		'read'                   => "read",
		'delete_posts'           => "delete_$plural",
		'delete_private_posts'   => "delete_private_$plural",
		'delete_published_posts' => "delete_published_$plural",
		'delete_others_posts'    => "delete_others_$plural",
		'edit_private_posts'     => "edit_private_$plural",
		'edit_published_posts'   => "edit_published_$plural",
		'create_posts'           => "edit_$plural",
	];
}

// let's create the function for the custom type
function adf_buddyxprochild_custom_post_types() {
	

	/**
	 * CPT: ritual
	 */
	register_post_type( 'ritual', 
		array(
			'labels' => array(
				'name' => __( 'Rituals', 'buddyxprochild' ),
				'singular_name' => __( 'Ritual', 'buddyxprochild' ),
				'all_items' => __( 'All Rituals', 'buddyxprochild' ),
				'add_new' => __( 'Add New', 'buddyxprochild' ),
				'add_new_item' => __( 'Add New', 'buddyxprochild' ),
				'edit' => __( 'Edit', 'buddyxprochild' ),
				'edit_item' => __( 'Edit', 'buddyxprochild' ),
				'new_item' => __( 'New Ritual', 'buddyxprochild' ),
				'view_item' => __( 'View Ritual', 'buddyxprochild' ),
				'search_items' => __( 'Search Rituals', 'buddyxprochild' ),
				'not_found' => __( 'Nothing found.', 'buddyxprochild' ),
				'not_found_in_trash' => __( 'Nothing found in Trash', 'buddyxprochild' ),
				'parent_item_colon' => ''
			),
			/* end of labels */
			'description' => __( 'Ritual posts', 'buddyxprochild' ),
			'public' => true,
			'hierarchical' => false,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'show_in_rest' => true,
			'menu_position' => 6,
			'menu_icon' => 'dashicons-buddicons-friends',
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'ritual',
				'with_front' => false
			),
			'has_archive' => true,
			'capability_type' => 'post',
			'taxonomies'  => array( 'category', 'post_tag' ),
			'supports' => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'custom-fields',
				'revisions'
			)
		) /* end of options */
	); /* end of register CPT: ritual */
	
	/**
	 * CPT: article
	 */
	register_post_type( 'article', 
		array(
			'labels' => array(
				'name' => __( 'Articles', 'buddyxprochild' ),
				'singular_name' => __( 'Article', 'buddyxprochild' ),
				'all_items' => __( 'All Articles', 'buddyxprochild' ),
				'add_new' => __( 'Add New', 'buddyxprochild' ),
				'add_new_item' => __( 'Add New', 'buddyxprochild' ),
				'edit' => __( 'Edit', 'buddyxprochild' ),
				'edit_item' => __( 'Edit', 'buddyxprochild' ),
				'new_item' => __( 'New Article', 'buddyxprochild' ),
				'view_item' => __( 'View Article', 'buddyxprochild' ),
				'search_items' => __( 'Search Articles', 'buddyxprochild' ),
				'not_found' => __( 'Nothing found.', 'buddyxprochild' ),
				'not_found_in_trash' => __( 'Nothing found in Trash', 'buddyxprochild' ),
				'parent_item_colon' => ''
			),
			/* end of labels */
			'description' => __( 'Articles', 'buddyxprochild' ),
			'public' => true,
			'hierarchical' => false,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'show_in_rest' => true,
			'menu_position' => 5,
			'menu_icon' => 'dashicons-text-page',
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'article',
				'with_front' => false
			),
			'has_archive' => true,
			'capability_type' => 'post',
			'taxonomies'  => array( 'category', 'post_tag' ),
			'supports' => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'custom-fields',
				'revisions'
			)
		) /* end of options */
	); /* end of register CPT: article */
	
	/**
	 * CPT: region
	 */
	register_post_type( 'region', 
		array(
			'labels' => array(
				'name' => __( 'Regions', 'buddyxprochild' ),
				'singular_name' => __( 'Region', 'buddyxprochild' ),
				'all_items' => __( 'All Regions', 'buddyxprochild' ),
				'add_new' => __( 'Add New', 'buddyxprochild' ),
				'add_new_item' => __( 'Add New', 'buddyxprochild' ),
				'edit' => __( 'Edit', 'buddyxprochild' ),
				'edit_item' => __( 'Edit', 'buddyxprochild' ),
				'new_item' => __( 'New Region', 'buddyxprochild' ),
				'view_item' => __( 'View Region', 'buddyxprochild' ),
				'search_items' => __( 'Search Regions', 'buddyxprochild' ),
				'not_found' => __( 'Nothing found.', 'buddyxprochild' ),
				'not_found_in_trash' => __( 'Nothing found in Trash', 'buddyxprochild' ),
				'parent_item_colon' => ''
			),
			/* end of labels */
			'description' => __( 'Regions', 'buddyxprochild' ),
			'public' => true,
			'hierarchical' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'show_in_rest' => true,
			'menu_position' => 22,
			'menu_icon' => 'dashicons-location-alt',
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'region',
				'with_front' => false
			),
			'has_archive' => true,
			'capability_type' => 'page',
			//'taxonomies'  => array( 'category', 'post_tag' ),
			'supports' => array(
				'title',
				'editor',
				'author',
				'custom-fields',
				'revisions',
				'thumbnail'
			)
		) /* end of options */
	); /* end of register CPT: region */


	/**
	 * CPT: essay
*/
	register_post_type( 'essay',
		array(
			'labels' => array(
				'name' => __( 'Essays', 'buddyxprochild' ),
				'singular_name' => __( 'Essay', 'buddyxprochild' ),
				'all_items' => __( 'All Essays', 'buddyxprochild' ),
				'add_new' => __( 'Add New Essay', 'buddyxprochild' ),
				'add_new_item' => __( 'Add New', 'buddyxprochild' ),
				'edit' => __( 'Edit Essay', 'buddyxprochild' ),
				'edit_item' => __( 'Edit Essay', 'buddyxprochild' ),
				'new_item' => __( 'New Essay', 'buddyxprochild' ),
				'view_item' => __( 'View Essay', 'buddyxprochild' ),
				'search_items' => __( 'Search Essays', 'buddyxprochild' ),
				'not_found' => __( 'Nothing found.', 'buddyxprochild' ),
				'not_found_in_trash' => __( 'Nothing found in Trash', 'buddyxprochild' ),
				'parent_item_colon' => ''
			),
			'description' => __( 'Essay', 'buddyxprochild' ),
			'public' => true,
			'hierarchical' => false,
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'show_in_rest' => false,
			'menu_position' => 26,
			'menu_icon' => 'dashicons-edit-page',
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'essay-submission',
				'with_front' => true
			),
			'has_archive' => 'essays',
			'capability_type' => 'page',
			'supports' => array(
				'title',
				'editor',
				'author',
				'custom-fields',
				'revisions',
				'comments',
			)
		)
	); /* end of register CPT: essay */



	/**
	 * CPT: members area

	register_post_type( 'members-area',
		array(
			'labels' => array(
				'name' => __( 'Members Area', 'buddyxprochild' ),
				'singular_name' => __( 'Members Area Page', 'buddyxprochild' ),
				'all_items' => __( 'All Members Area Pages', 'buddyxprochild' ),
				'add_new' => __( 'Add New', 'buddyxprochild' ),
				'add_new_item' => __( 'Add New', 'buddyxprochild' ),
				'edit' => __( 'Edit', 'buddyxprochild' ),
				'edit_item' => __( 'Edit', 'buddyxprochild' ),
				'new_item' => __( 'New Page', 'buddyxprochild' ),
				'view_item' => __( 'View Page', 'buddyxprochild' ),
				'search_items' => __( 'Search Members Area Pages', 'buddyxprochild' ),
				'not_found' => __( 'Nothing found.', 'buddyxprochild' ),
				'not_found_in_trash' => __( 'Nothing found in Trash', 'buddyxprochild' ),
				'parent_item_colon' => ''
			),
			// end of labels
			'description' => __( 'Pages visible only to members', 'buddyxprochild' ),
			'public' => true,
			'hierarchical' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'show_in_rest' => true,
			'menu_position' => 56,
			'menu_icon' => 'dashicons-privacy',
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'members-area',
				'with_front' => true
			),
			'has_archive' => 'member-page',
			'capability_type' => 'page',
			//'taxonomies'  => array( 'category', 'post_tag' ),
			'supports' => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'custom-fields',
				'revisions',
				'page-attributes'
			)
		)  // end of options
	); /* end of register CPT: members area */


	/**
	 * CPT: subgroup
	 */
	//$subgroup_capabilities = compile_post_type_capabilities( 'subgroup', 'subgroups' );
	register_post_type( 'subgroup',
		array(
			'labels' => array(
				'name' => __( 'Subgroups', 'buddyxprochild' ),
				'singular_name' => __( 'Subgroup', 'buddyxprochild' ),
				'all_items' => __( 'All Subgroups', 'buddyxprochild' ),
				'add_new' => __( 'Add New', 'buddyxprochild' ),
				'add_new_item' => __( 'Add New', 'buddyxprochild' ),
				'edit' => __( 'Edit', 'buddyxprochild' ),
				'edit_item' => __( 'Edit', 'buddyxprochild' ),
				'new_item' => __( 'New Subgroup', 'buddyxprochild' ),
				'view_item' => __( 'View Subgroup', 'buddyxprochild' ),
				'search_items' => __( 'Search Subgroups', 'buddyxprochild' ),
				'not_found' => __( 'Nothing found.', 'buddyxprochild' ),
				'not_found_in_trash' => __( 'Nothing found in Trash', 'buddyxprochild' ),
				'parent_item_colon' => ''
			),
			/* end of labels */
			'description' => __( 'ADF subgroup pages', 'buddyxprochild' ),
			'public' => true,
			'hierarchical' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'show_in_rest' => true,
			'menu_position' => 57,
			'menu_icon' => 'dashicons-groups',
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'subgroup',
				'with_front' => true
			),
			'has_archive' => 'subgroups',
			'capability_type' => 'page',
			//'taxonomies'  => array( 'category', 'post_tag' ),
			'supports' => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'custom-fields',
				'revisions',
				'page-attributes'
			),
		//	'capabilities' => $subgroup_capabilities
		) /* end of options */
	); /* end of register CPT: subgroup */

	//compile_post_type_capabilities( 'subgroup', 'subgroups' );

	/**
	 * CPT: oak leaves
	 */
	register_post_type( 'oak-leaves',
		array(
			'labels' => array(
				'name' => __( 'Oak Leaves', 'buddyxprochild' ),
				'singular_name' => __( 'Oak Leaves Edition', 'buddyxprochild' ),
				'all_items' => __( 'All Oak Leaves Editions', 'buddyxprochild' ),
				'add_new' => __( 'Add New Edition', 'buddyxprochild' ),
				'add_new_item' => __( 'Add New Edition', 'buddyxprochild' ),
				'edit' => __( 'Edit Edition', 'buddyxprochild' ),
				'edit_item' => __( 'Edit Edition', 'buddyxprochild' ),
				'new_item' => __( 'New Edition', 'buddyxprochild' ),
				'view_item' => __( 'View Edition', 'buddyxprochild' ),
				'search_items' => __( 'Search Editions', 'buddyxprochild' ),
				'not_found' => __( 'Nothing found.', 'buddyxprochild' ),
				'not_found_in_trash' => __( 'Nothing found in Trash', 'buddyxprochild' ),
				'parent_item_colon' => ''
			),
			/* end of labels */
			'description' => __( 'Pages for Oak Leaves Editions', 'buddyxprochild' ),
			'public' => true,
			'hierarchical' => false,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'show_in_rest' => true,
			'menu_position' => 57,
			'menu_icon' => 'dashicons-welcome-widgets-menus',
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'oak-leaves',
				'with_front' => false
			),
			'has_archive' => false,
			'capability_type' => 'page',
			//'taxonomies'  => array( 'category', 'post_tag' ),
			'supports' => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'custom-fields',
				'revisions',
				'page-attributes'
			)
		) /* end of options */
	); /* end of register CPT: oak leaves */
}

// adding the function to the Wordpress init
add_action( 'init', 'adf_buddyxprochild_custom_post_types' );


/**
 * Custom Taxonomies
 *
 * @see register_post_type() for registering custom post types.
 */
function adf_buddyxprochild_custom_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Hearth Cultures', 'taxonomy general name', 'buddyxprochild' ),
		'singular_name'     => _x( 'Hearth Culture', 'taxonomy singular name', 'buddyxprochild' ),
		'search_items'      => __( 'Search', 'buddyxprochild' ),
		'all_items'         => __( 'All Hearth Cultures', 'buddyxprochild' ),
		'parent_item'       => __( 'Parent Hearth Culture', 'buddyxprochild' ),
		'parent_item_colon' => __( 'Parent Hearth Culture:', 'buddyxprochild' ),
		'edit_item'         => __( 'Edit Hearth Culture', 'buddyxprochild' ),
		'update_item'       => __( 'Update Hearth Culture', 'buddyxprochild' ),
		'add_new_item'      => __( 'Add New Hearth Culture', 'buddyxprochild' ),
		'new_item_name'     => __( 'New Hearth Culture Name', 'buddyxprochild' ),
		'menu_name'         => __( 'Hearth Cultures', 'buddyxprochild' ),
	);
 
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'description'		=> 'For categorizing articles and rituals by Hearth Culture',
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest' 		=> true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'hearth' ),
	);
 
	register_taxonomy( 'hearth', array( 'page', 'article', 'ritual', 'oak-leaves', 'subgroup', 'members-area', 'essay' ), $args );
 
	unset( $args );
	unset( $labels );
 
/* 	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Writers', 'taxonomy general name', 'buddyxprochild' ),
		'singular_name'              => _x( 'Writer', 'taxonomy singular name', 'buddyxprochild' ),
		'search_items'               => __( 'Search Writers', 'buddyxprochild' ),
		'popular_items'              => __( 'Popular Writers', 'buddyxprochild' ),
		'all_items'                  => __( 'All Writers', 'buddyxprochild' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Writer', 'buddyxprochild' ),
		'update_item'                => __( 'Update Writer', 'buddyxprochild' ),
		'add_new_item'               => __( 'Add New Writer', 'buddyxprochild' ),
		'new_item_name'              => __( 'New Writer Name', 'buddyxprochild' ),
		'separate_items_with_commas' => __( 'Separate writers with commas', 'buddyxprochild' ),
		'add_or_remove_items'        => __( 'Add or remove writers', 'buddyxprochild' ),
		'choose_from_most_used'      => __( 'Choose from the most used writers', 'buddyxprochild' ),
		'not_found'                  => __( 'No writers found.', 'buddyxprochild' ),
		'menu_name'                  => __( 'Writers', 'buddyxprochild' ),
	);
 
	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'writer' ),
	);
 
	register_taxonomy( 'writer', 'book', $args );
	
	 */
	 
	 // Add new taxonomy, make it hierarchical (like categories)
	 $labels = array(
		 'name'              => _x( 'Ritual Types', 'taxonomy general name', 'buddyxprochild' ),
		 'singular_name'     => _x( 'Ritual Type', 'taxonomy singular name', 'buddyxprochild' ),
		 'search_items'      => __( 'Search', 'buddyxprochild' ),
		 'all_items'         => __( 'All Ritual Types', 'buddyxprochild' ),
		 'parent_item'       => __( 'Parent Ritual Type', 'buddyxprochild' ),
		 'parent_item_colon' => __( 'Parent Ritual Type:', 'buddyxprochild' ),
		 'edit_item'         => __( 'Edit Ritual Type', 'buddyxprochild' ),
		 'update_item'       => __( 'Update Ritual Type', 'buddyxprochild' ),
		 'add_new_item'      => __( 'Add New Ritual Type', 'buddyxprochild' ),
		 'new_item_name'     => __( 'New Ritual Type Name', 'buddyxprochild' ),
		 'menu_name'         => __( 'Ritual Types', 'buddyxprochild' ),
	 );
	 
	 $args = array(
		 'hierarchical'      => true,
		 'labels'            => $labels,
		 'description'		=> 'ADF Rituals, chants, prayers and Meditations',
		 'show_ui'           => true,
		 'show_admin_column' => true,
		 'show_in_rest' 	 => true,
		 'query_var'         => true,
		 'rewrite'           => array( 'slug' => 'ritual-type' ),
	 );
	 
	 register_taxonomy( 'ritual-type', array( 'page', 'article', 'ritual' ), $args );
}
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'adf_buddyxprochild_custom_taxonomies', 0 );


// don't show the "admin" subgroup, since that's just for... admin-y things
function adf_filter_out_admin_subgroup( $query ) {
	// Only modify the main query, for post type subgroup

	if ( is_archive( 'subgroup' ) ) {
		$exclude_page = get_page_by_path( 'admin', OBJECT, 'subgroup');
		$query->set( 'post__not_in',  array( $exclude_page->ID,  ) );
	}

}
add_action( 'pre_get_posts', 'adf_filter_out_admin_subgroup' );

