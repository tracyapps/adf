<?php
function connect_group_memberships( $group_id, $user_id ) {
	global $wpdb;
	//$user_id = get_current_user_id();

	/** wp_user_group_memberships **/

	/*$current_memberships = $wpdb->get_row( $wpdb->prepare(
		"SELECT id, user_member_of 
		FROM {$wpdb->prefix}user_group_memberships
    	WHERE user_id=%d", $user_id
	));

	$user_memberships = maybe_unserialize(
		$current_memberships->user_member_of ?? null
	);
	if(
		empty( $user_memberships )
		or !is_array( $user_memberships )
	)  $user_memberships = [];

	// add to the memberships
	$user_memberships[] = $group_id;

	// update group memberships
	if(
		!empty( $current_memberships->id )
	) {
		$wpdb->query( $wpdb->prepare(
			"UPDATE {$wpdb->prefix}user_group_memberships 
        	SET user_member_of = %s 
			WHERE id=%d",
		serialize( $user_memberships ),
			$current_memberships->id )
		);

	}
	else {
		$wpdb->query( $wpdb->prepare(
			"INSERT INTO {$wpdb->prefix}user_group_memberships 
    		SET user_member_of = %s, user_id=%d ",
		serialize( $user_memberships ),
			$user_id )
		);
	}

	// wp_subgroup_pages

	$subgroup = $wpdb->query( $wpdb->prepare(
		"SELECT id, subgroup_members 
		FROM {$wpdb->prefix}subgroup_pages 
		WHERE post_id=%d", $group_id )
	);

	$subgroup_members = maybe_unserialize(
		$subgroup->subgroup_members ?? null
	);
	if(
		empty( $subgroup_members )
		or !is_array( $subgroup_members )
	)  $subgroup_members = [];

	// now add the member and save
	$subgroup_members[] = $user_id;

	if(
		!empty( $subgroup->id )
	) {
		$wpdb->query( $wpdb->prepare(
			"UPDATE {$wpdb->prefix}subgroup_pages 
			SET subgroup_members=%s 
			WHERE id=%d",
		serialize( $subgroup_members ),
			$subgroup->id ) );
	}
	// the group must always exist so there is no "else"
*/

	// get current settings
	$current_members_of_group = get_field( 'subgroup_members', $group_id, false );
	$groups_user_is_a_member_of = get_field( 'user_member_of', 'user_' . $user_id, false );



	/*if( $current_members_of_group ) {
		// if this meta exists
		if( in_array( $user_id, $current_members_of_group ) ) :
			//already a member
		else :
			//not already a member. add them
			$current_members_of_group[] = $user_id;
			update_field( 'subgroup_members', $current_members_of_group, $group_id );
		endif;
	} else {
		// create the meta

		$field_key = "field_6329ab2ec705e"; // field key of 'subgroup_members'
		$value = $user_id;
		update_field( $field_key, $value, $group_id );
	}*/

	if( $groups_user_is_a_member_of ) {
		// if this user is in any groups already
		if( in_array( $group_id, $groups_user_is_a_member_of ) ) :
			//already a member
		else :
			//not already a member. add them
			$groups_user_is_a_member_of[] = $group_id;
			update_field( 'user_member_of', $groups_user_is_a_member_of, 'user_' . $user_id );
		endif;
	} else {
		// create the meta

		$field_key = 'field_6329ac8f6f0d5'; // field key of 'user_member_of'
		$value[] = $group_id;
		update_field( $field_key, $value, 'user_' . $user_id );
	}
}

/*
function connect_grove_memberships( $grove_id, $user_id ) {
	global $wpdb;
	$user_id = get_current_user_id();

	$current_members_of_grove = get_field( 'grove_members', $grove_id );
	$grove_user_is_in = get_field( 'users_grove', 'user_' . $user_id );

	if( $current_members_of_grove ) {
		// if this meta exists
		if( in_array( $user_id, $current_members_of_grove ) ) :
			//already a member. do nothing.
		else :
			//not already a member. add them
			$current_members_of_grove[] = $user_id;
			update_field( 'grove_members', $current_members_of_grove );
		endif;
	} else {
		// create the meta

		$field_key = "field_6389273ad06b1"; // field key of 'grove_members'
		$value = $user_id;
		update_field( $field_key, $value, $grove_id );
	}

	if( $grove_user_is_in ) {
		// if this user is in any groups already
		if( in_array( $grove_id, $grove_user_is_in ) ) :
			//already a member
		else :
			//not already a member. add them
			$grove_user_is_in = $grove_id;
			update_field( 'users_grove', $grove_user_is_in );
		endif;
	} else {
		// create the meta

		$field_key = "field_6389a31bf3dc3"; // field key of 'users_grove'
		$value = $grove_id;
		update_field( $field_key, $value, $user_id );
	}

}*/


function connect_region_memberships( $region_id, $user_id ) {
	global $wpdb;
	$user_id = get_current_user_id();

	$current_members_of_region = get_field( 'region_members', $region_id );
	$region_user_is_in = get_field( 'users_region', 'user_' . $user_id );

	if( $current_members_of_region ) {
		// if this meta exists
		if( in_array( $user_id, $current_members_of_region ) ) :
			//already a member. do nothing.
		else :
			//not already a member. add them
			$current_members_of_region[] = $user_id;
			update_field( 'region_members', $current_members_of_region );
		endif;
	} else {
		// create the meta

		$field_key = "field_638ae9e7bb858"; // field key of 'region_members'
		$value = $user_id;
		update_field( $field_key, $value, $region_id );
	}

	if( $region_user_is_in ) {
		// if this user is in any regions already
		if( in_array( $region_id, $region_user_is_in ) ) :
			//already a member
		else :
			//not already a member. add them
			$region_user_is_in = $region_id;
			update_field( 'users_region', $region_user_is_in );
		endif;
	} else {
		// create the meta

		$field_key = "field_638aeb23d891e"; // field key of 'users_region'
		$value = $region_id;
		update_field( $field_key, $value, $user_id );
	}

}