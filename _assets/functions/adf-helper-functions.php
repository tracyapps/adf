<?php
/**
 * helper functions for ADF.
 *
 */

function adf_display_oak_leaves_table_of_contents() {
	global $post;

	// blank variables to start out.
	$output = '';
	$intro_paragraph = '';
	$toc_list = '';

	// if there is an intro paragraph, store that into its variable
	if ( get_field( 'intro', $post->ID ) != '' ) :
		$intro_paragraph = sprintf(
			'<div class="toc_intro">
						%s
					</div>',
			get_field( 'intro', $post->ID )
		);
	endif;

	// if there are rows in the table of contents, store that into its variable
	if ( have_rows( 'table_of_contents', $post->ID ) ) :
		$toc_list = '<ul class="oak_leaves_toc">';
		while ( have_rows( 'table_of_contents' ) ) : the_row();
			$toc_list .= '<li>' . get_sub_field( 'title' ) . '</li>';
		endwhile;
		$toc_list .= '</ul>';
	endif;

	// check to see if there is any content in either variable, and if so, we're outputting the HTML around it
	if ( $intro_paragraph != ''  || $toc_list != '' ) :
		$output = sprintf(
			'<div class="oak_leaves_toc_container">
					<h6>Table of Contents:</h6>
					%s
					%s
			</div>',
			wp_kses_post( $intro_paragraph ),
			wp_kses_post( $toc_list )
		);
	else :
		$output = ''; // crickets
	endif;

	return $output;
}

/**
 *  display the members area nav bar if:
 * 		- user is logged in
 * 		- AND the menu exists :)
 *
 *  this function is added into the theme template files, directly under 'get_header();'
 */

function adf_display_members_area_nav_bar() {
	if( is_user_logged_in()
		&&  has_nav_menu( 'membersarea' ) ) :
		echo '<nav id="members_area_nav_bar">';
			echo '<div class="members_area_nav_content_container">';
				echo '<h3>Members Site: </h3>';
				wp_nav_menu(
					array(
						'theme_location'	=> 'membersarea',
						'container'			=> false,
					)
				);
			echo '</div>';
		echo '</nav>';
	else :
	endif;
}

/**
 * display user's roles
 *
 * @return string
 */

function adf_display_user_role_tags( $user_id = null ) {

	$special_user_roles = '';

	$displayed_user_meta = get_userdata( $user_id );
	$user_roles_list = $displayed_user_meta->roles;

	if ( ! empty( $user_roles_list )
		&& is_array( $user_roles_list )
		&& in_array( 'clergy', $user_roles_list ) ) {

		$clergy_title = 'ADF Clergy';
	}


	if ( ! empty( $user_roles_list )
		&& is_array( $user_roles_list )
		&& in_array( 'region_leader', $user_roles_list ) ) {

		$regionaldruid_title = 'Regional Druid';
	}

	if ( ! empty( $user_roles_list )
		&& is_array( $user_roles_list )
		&& in_array( 'deputy_regional_druid', $user_roles_list ) ) {

		$deputyregionaldruid_title = 'Deputy Regional Druid';
	}

	if ( ! empty( $user_roles_list )
		&& is_array( $user_roles_list )
		&& in_array( 'senior_druid', $user_roles_list ) ) {

		$seniordruid_title = 'Senior Druid';
	}

	if ( ! empty( $user_roles_list )
		&& is_array( $user_roles_list )
		&& in_array( 'mothergrove', $user_roles_list ) ) {

		$mothergrove_title = 'The Mother Grove';
	}

	if ( ! empty( $user_roles_list )
		&& is_array( $user_roles_list )
		&& in_array( 'initiate', $user_roles_list ) ) {

		$initiate_title = 'Initiate';
	}

	if (
		isset( $clergy_title ) ||
		isset( $regionaldruid_title ) ||
		isset( $deputyregionaldruid_title ) ||
		isset( $seniordruid_title ) ||
		isset( $mothergrove_title ) ||
		isset( $initiate_title )
	) :
		$special_user_roles = '<ul class="user_custom_roles_list">';
		if ( isset( $clergy_title ) ) {
			$special_user_roles .= adf_user_role_loop($clergy_title);
		}
		if ( isset( $initiate_title ) ) {
			$special_user_roles .= adf_user_role_loop($initiate_title);
		}
		if ( isset( $regionaldruid_title ) ) {
			$special_user_roles .= adf_user_role_loop($regionaldruid_title);
		}
		if ( isset( $deputyregionaldruid_title ) ) {
			$special_user_roles .= adf_user_role_loop($deputyregionaldruid_title);
		}
		if ( isset( $seniordruid_title ) ) {
			$special_user_roles .= adf_user_role_loop($seniordruid_title);
		}
		if ( isset( $mothergrove_title ) ) {
			$special_user_roles .= adf_user_role_loop($mothergrove_title);
		}
		$special_user_roles .= '</ul>';

		return $special_user_roles;
	endif;
}


function adf_user_role_loop( $type = '' ) {
	$the_code = sprintf(
		'<li class="role"><span>%s</span></li>',
		esc_html( $type )
	);

	return $the_code;
}

/**
 * helper function.
 * used to display the leadership names and email on the sidebar of region detail pages.
 *
 * @param false $post_id
 * @return string
 */

function adf_display_regional_leadership( $post_id = false ) {
	$regional_druid = get_field( "regional_druid" );
	$deputy_regional_druid = get_field( "deputy_regional_druid" );
	$regional_email = get_field( "region_email" );

	$output = '';

	if( $regional_email ) :
		$output .= '<hr /><a href="mailto:' . esc_html( $regional_email ) . '@adf.org" class="button email_button">Email '. esc_html( get_the_title( $post_id ) ) .'</a><hr />';
	endif;

	if( $regional_druid ) :
		$output .= '<h2 class="region_leader_title">Regional Druid</h2>';
		$output .= '<a class="region_leader_name" href="/author/' . $regional_druid[ 'user_nicename' ] . '">' . $regional_druid[ 'user_avatar' ] . esc_html( $regional_druid[ 'display_name' ] ) . '</a>';

	endif;

	if( $deputy_regional_druid ) :
		$output .= '<h2 class="region_leader_title">Deputy Regional Druid</h2>';
		$output .= '<a class="region_leader_name" href="/author/' . $deputy_regional_druid[ 'user_nicename' ] . '">' . $deputy_regional_druid[ 'user_avatar' ] . esc_html( $deputy_regional_druid[ 'display_name' ] ) . '</a>';

	endif;

	return $output;

}

/**
 * helpter function.
 * used to display the region information and style the output on the region detail pages
 *
 * @param false $post_id
 * @return string
 */

function adf_display_regional_information( $post_id = false ) {
	$regional_info = get_field( "region_information" );
	$output = '';

	if( $regional_info ) :
		$output .= '<div class="region_info"><h3 class="region_info_title">Region Info</h3><p>' . __( $regional_info, 'buddyxprochild') . '</p></div>';
	endif;

	return $output;
}


function get_the_top_ancestor_id() {
	global $post;
	if ( $post->post_parent ) {
		$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
		return $ancestors[0];
	} else {
		return $post->ID;
	}
}

function adf_display_subgroup_child_pages_to_members_only() {
	global $id;
	$child_pages = wp_list_pages( array(
		'title_li' => '',
		'child_of' => get_the_top_ancestor_id(),
		'post_type' => 'subgroup',
		'sort_column'  => 'menu_order, post_title',
		'sort_order' => 'asc',
		'echo' => 0
	) );
	if ( $child_pages){
		$output = '<h3 class="subgroup_child_pages_heading">Group-only pages:</h3><ul class="subgroup_child_pages_list">' . $child_pages . '</ul>';
	}
	else
		$output = '';
	return $output;
}

/**
 * function to associate any subgroup child pages, with it's parent subgroup ID
 *
 * @return false|int
 */

function adf_subgroup_id() {
	global $post;
	if ( wp_get_post_parent_id( get_the_ID() ) ) :
		$subgroup_id = wp_get_post_parent_id( get_the_ID() ); //set the subgroup id as the parent if we are on a child page
	else :
		$subgroup_id = get_the_ID();
	endif;
	return $subgroup_id;
}

/**
 *
 * function to set the user membership status variable
 * (used in subgroup page template)
 * @return string
 *
 */
function adf_group_membership_status( $group_member_array ) {

	$group_membership = 'log_in_first';
	if( is_user_logged_in() ) :
		$current_user = wp_get_current_user();

		if( in_array( $current_user->ID , (array) $group_member_array ) ) {
			$group_membership = 'is_member';
		} else {
			$group_membership = 'not_a_member';
		}
		endif;
	return $group_membership;
}