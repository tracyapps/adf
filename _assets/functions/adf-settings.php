<?php
/**
 *
 * functions to change default WP behavior.
 *
*/



// function and action to order classes alphabetically for post type 'region'

function adf_alpha_order_regions( $query ) {
	if ( $query->is_post_type_archive('region') && $query->is_main_query() ) {
		$query->set( 'orderby', 'title' );
		$query->set( 'order', 'ASC' );
		$query->set( 'posts_per_page', '25' );
	}
}

add_action( 'pre_get_posts', 'adf_alpha_order_regions' );

// -- Disable Custom Colors
add_theme_support( 'disable-custom-colors' );

// add ADF specific colors
add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => __( 'Brown', 'adf_brown' ),
		'slug'  => 'adf_brown',
		'color'	=> '#612411',
	),
	array(
		'name'  => __( 'Light Brown', 'adf_light_brown' ),
		'slug'  => 'adf_light_brown',
		'color' => '#815c4c',
	),
	array(
		'name'  => __( 'Grey Green', 'adf_grey_green' ),
		'slug'  => 'adf_grey_green',
		'color' => '#66664d',
	),
	array(
		'name'	=> __( 'Green', 'adf_green' ),
		'slug'	=> 'adf_green',
		'color'	=> '#11592b',
	),
	array(
		'name'  => __( 'Dark Grey', 'adf_dark_grey' ),
		'slug'  => 'adf_dark_grey',
		'color' => '#373333',
	),
	array(
		'name'	=> __( 'Blue', 'adf_blue' ),
		'slug'	=> 'adf_blue',
		'color'	=> '#6a8aa7',
	),
	array(
		'name'  => __( 'White', 'adf_white' ),
		'slug'  => 'adf_white',
		'color' => '#fff',
	),

) );

/**
 * changing base url of user bios from /author/ to /profile/
 */

function adf_custom_author_base() {
	global $wp_rewrite;
	$myauthor_base = 'profile';
	$wp_rewrite->author_base = $myauthor_base;
}
add_action('init', 'adf_custom_author_base');



add_shortcode( 'adf_members_profile_url', function() {

	return esc_url( get_author_posts_url( get_current_user_id() ) );

});

add_filter( 'nav_menu_link_attributes', 'adf_shortcode_menu_item_attributes', 10, 4 );
function adf_shortcode_menu_item_attributes( $atts, $item, $args, $depth ) {

	// If [adf_members_profile_url] is found then change it.
	if ( str_contains( $atts[ 'href' ], '[adf_members_profile_url]' ) ) {

		// Remove the 'http://' from the start and expand the shortcode
		if( is_ssl( $atts[ 'href' ] ) ) :
			$atts[ 'href' ] = substr( $atts[ 'href' ], strlen( 'https://' ) );
		else:
			$atts[ 'href' ] = substr( $atts[ 'href' ], strlen( 'http://' ) );
		endif;
		$atts[ 'href' ] = do_shortcode( $atts[ 'href' ] );
	}

	return $atts;
}

/**
 * Filters all menu item URLs for a #placeholder#.
 *
 * @param WP_Post[] $menu_items All of the nave menu items, sorted for display.
 *
 * @return WP_Post[] The menu items with any placeholders properly filled in.
 */
function adf_dynamic_menu_items( $menu_items ) {

	// A list of placeholders to replace.
	// You can add more placeholders to the list as needed.
	$placeholders = array(
		'#profile_link#' => array(
			'shortcode' => 'adf_members_profile_url',
	//		'atts' => array(), // Shortcode attributes.
	//		'content' => '', // Content for the shortcode.
		),
	);

	foreach ( $menu_items as $menu_item ) {

		if ( isset( $placeholders[ $menu_item->url ] ) ) {

			global $shortcode_tags;

			$placeholder = $placeholders[ $menu_item->url ];

			if ( isset( $shortcode_tags[ $placeholder['shortcode'] ] ) ) {

				$menu_item->url = call_user_func(
					$shortcode_tags[ $placeholder['shortcode'] ]
		//			, $placeholder['atts']
			//		, $placeholder['content']
					, $placeholder['shortcode']
				);
			}
		}
	}

	return $menu_items;
}
add_filter( 'wp_nav_menu_objects', 'adf_dynamic_menu_items' );



/**
 * adding more image sizes to use in archive pages
 */

add_image_size( 'larger-thumbnail', 450, 450, true );

/**
 * adding "Rev." to clergy user type
*/

// add_filter('insert_user_meta', 'add_rev_before_clergy_new', 10 , 4);

function add_rev_before_clergy_new($meta, $user, $update, $userdata) {

	if( $meta['display_name_public'] ) {
		// load the current "public display name" in a variable so we can make sure it doesn't already have "Rev. " at the beginning :)
		$currentdisplayname = $meta['display_name_public'];

		// if the user has "clergy" in their user roles (users can have multiple)
		if ( ! empty( $user->roles )
			&& is_array( $user->roles )
			&& in_array( 'Clergy', $user->roles )
			&& ! str_starts_with( $currentdisplayname, 'Rev. ' || 'Rev ' ) ) {
			$meta['display_name_public'] = 'Rev. ' . $meta['display_name_public'];
		}
		return $meta;
	}
}


/**
 * add "members area" menu area
 */

function adf_register_members_area_menu() {
	register_nav_menus(
		array(
			'membersarea' 	=> 'Members Area Nav Bar'
		)
	);
}

add_action( 'init', 'adf_register_members_area_menu' );



/**
 * toolset, why are you showing an error message after you are deleted?
 *
 */
add_action( 'admin_head', 'hide_toolset_connection_issue_notice' ); // admin_head is a hook my_custom_fonts is a function we are adding it to the hook

function hide_toolset_connection_issue_notice() {
	echo '<style>
	.notice.otgs-installer-notice.otgs-installer-notice-toolset.otgs-installer-notice-connection-issues  { display: none; } </style>';
}

/**
 * adding classes to the nav menu items, based on the post type
 */
function adf_add_custom_class_to_cpt_menu_items( $classes = array(), $menu_item = false ) {
	if( in_array( 'current-menu-item', $menu_item->classes ) ){
		$classes[] = 'current-menu-item';
	}

	// current item if the archive page is displayed

	if ( $menu_item->post_name == 'article' && is_post_type_archive('article') ) {
		$classes[] = 'current-menu-item';
	}

	if ( $menu_item->post_name == 'ritual' && is_post_type_archive('ritual') ) {
		$classes[] = 'current-menu-item';
	}

	if ( $menu_item->post_name == 'region' && is_post_type_archive('region') ) {
		$classes[] = 'current-menu-item';
	}

	// current menu "ancestor" for single pages of that post type

	if ( $menu_item->post_name == 'article' && is_singular('article') ) {
		$classes[] = 'current-menu-ancestor';
	}

	if ( $menu_item->post_name == 'ritual' && is_singular('ritual') ) {
		$classes[] = 'current-menu-ancestor';
	}

	if ( $menu_item->post_name == 'region' && is_singular('region') ) {
		$classes[] = 'current-menu-ancestor';
	}

	if ( $menu_item->post_name == 'oak-leaves' && is_singular('oak-leaves') ) {
		$classes[] = 'current-menu-ancestor';
	}

	return $classes;
}
add_filter('nav_menu_css_class', 'adf_add_custom_class_to_cpt_menu_items', 100, 2);


add_filter('acf/fields/relationship/query', 'adf_acf_fields_relationship_query', 10, 3);
function adf_acf_fields_relationship_query( $args, $field, $post_id ) {

	// Show 40 posts per AJAX call.
	$args['posts_per_page'] = 40;

	return $args;
}

/**
 * extending wordpress template hierarchy to also include child pages
 */

add_filter(
	'page_template',
	function ($template) {
		global $post;

		if ( $post->post_parent ) {

			// get top level parent page
			/*$parent = get_post(
				reset( array_reverse( get_post_ancestors( $post->ID ) ) )
			);*/

			// or ...
			// when you need closest parent post instead
			$parent = get_post( $post->post_parent );

			$child_template = locate_template(
				[
					$parent->post_name . '/subgroup-' . $post->post_name . '.php',
					$parent->post_name . '/subgroup-' . $post->ID . '.php',
					$parent->post_name . '/subgroup.php',
				]
			);

			if ($child_template) return $child_template;
		}
		return $template;
	}
);