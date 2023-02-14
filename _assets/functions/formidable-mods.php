<?php
/**
 * customization for formidable forms
 */


/**
 * add dropdown of all users
 * 		- in roles administrator, editor, subscriber and/or contributor
 * 		- NOT in 'inactive'
 */

add_filter('frm_setup_new_fields_vars', 'frm_populate_subgroup_dropdown', 20, 2);
add_filter('frm_setup_edit_fields_vars', 'frm_populate_subgroup_dropdown', 20, 2);
function frm_populate_subgroup_dropdown( $values, $field ){
/*	if ( $field->id == 208 ) {
		$role = array( 'administrator', 'contributor', 'editor', 'subscriber' );
		$notinrole = array( 'inactive' );
		$users = get_users( array(  'role__not_in' => $notinrole ) );
		$values['options'] = array( );
		foreach ( $users as $user ) {
			$display_name = $user->display_name; // default user's display name...
			if( get_field( 'display_name_public', 'user_' . $user->ID ) ) : // ...but override if "display name" filled out
				$display_name = get_field( 'display_name_public', 'user_' . $user->ID );
			endif;

			$values['options'][] = array(
				'label' => $display_name . ' [' . $user->nickname . '] @' . $user->user_nicename,
				'value' => $user->ID
			);
		}
	}*/

	if ( $field->id == 222 ) {
		$subgroups = get_posts( [
			'post_type' 	=> 'subgroup',
			'numberposts'	=> 99
		] );
		$values['options'] = array( );
		foreach ( $subgroups as $subgroup ) {
			$group_id = $subgroup->ID;
			$group_name = $subgroup->post_title;
			$group_privacy = get_field( 'subgroup_membership', $subgroup->ID );

			if( $group_privacy === 'open' && $subgroup->post_parent === 0 ) :
				$values['options'][] = array(
					'label' => $group_name,
					'value' => $group_id,
				);
			endif;
		}
	}
	return $values;

}


/*
add_filter('frm_setup_new_fields_vars', 'frm_populate_grove_dropdown', 20, 2);
add_filter('frm_setup_edit_fields_vars', 'frm_populate_grove_dropdown', 20, 2);
function frm_populate_grove_dropdown( $values, $field ){


	if ( $field->id == 237 ) {
		$groves = get_posts( [
			'post_type' 	=> 'grove',
			'numberposts'	=> 99
		] );
		$values['options'] = array( );
		foreach ( $groves as $grove ) {
			$grove_id = $grove->ID;
			$grove_name = $grove->post_title;

			$values['options'][] = array(
				'label' => $grove_name,
				'value' => $grove_id,
			);
		}
	}
	return $values;
}*/



add_filter('frm_setup_new_fields_vars', 'frm_populate_region_dropdown', 20, 2);
add_filter('frm_setup_edit_fields_vars', 'frm_populate_region_dropdown', 20, 2);
function frm_populate_region_dropdown( $values, $field ){


	if ( $field->id == 238 ) {
		$regions = get_posts( [
			'post_type' 	=> 'region',
			'numberposts'	=> 45
		] );
		$values['options'] = array( );
		foreach ( $regions as $region ) {
			$region_id = $region->ID;
			$region_name = $region->post_title;

			$values['options'][] = array(
				'label' => $region_name,
				'value' => $region_id,
			);
		}
	}
	return $values;
}
/*
add_filter('frm_setup_new_fields_vars', 'frm_set_checked', 20, 2);
function frm_set_checked($values, $field){
	if($field->id == 209){//Replace with the ID of your field
		global $wp_roles;

		$all_roles = $wp_roles->roles;

		$values['options'] = array();

		foreach( $all_roles as $role ) :
			$values['options'][] = array(
				'label' => $role['name'],
				//'value' => $role['name']
			);
		endforeach;

		$values['use_key'] = true; //this will set the field to save
	}
	return $values;
}*/



function get_page_slug( $atts ){
	if ( ! empty( $atts['post_id'] ) ) {
		return get_post_field( 'post_name', ( int ) $atts['post_id'] );
	}

	return get_post_field( 'post_name');
}
add_shortcode( 'page_slug', 'get_page_slug' );

function get_subpage_id( $atts ){
	if ( ! empty( $atts['post_id'] ) ) {
		return get_post_field( 'post_name', ( int ) $atts['post_id'] );
	}

	return get_post_field( 'post_name');
}
add_shortcode( 'subpage_id', 'get_subpage_id' );



function get_grove_id( $atts ){
	if ( ! empty( $atts['post_id'] ) ) {
		return get_post_field( 'post_name', ( int ) $atts['post_id'] );
	}

	return get_post_field( 'post_name');
}
add_shortcode( 'grove_id', 'get_grove_id' );

function get_region_id( $atts ){
	if ( ! empty( $atts['post_id'] ) ) {
		return get_post_field( 'post_name', ( int ) $atts['post_id'] );
	}

	return get_post_field( 'post_name');
}
add_shortcode( 'region_id', 'get_region_id' );


add_shortcode('if_get_param', 'check_get_param_value');
function check_get_param_value( $atts, $content="" ) {
	if ( ! isset( $atts['name'] ) || ! isset( $atts['value'] ) || ! isset( $atts['type'] ) ) {
		return $content;
	}

	$type = $atts['type'];
	if ( $type == 'greater_than' ) {
		$type = '>';
	} else if ( $type == 'less_than' ) {
		$type = '<';
	} else if ( $type == 'equals' ) {
		$type = '==';
	} else if ( $type == 'not_equal' ) {
		$type = '!=';
	}

	$get_value = isset( $_GET[ $atts['name'] ] ) ? $_GET[ $atts['name'] ] : '';

	if ( ! FrmFieldsHelper::value_meets_condition( $get_value, $type, $atts['value'] ) ) {
		$content = '';
	}

	return do_shortcode( $content );
}



/**
 *  creating user meta shortcode to use in formidable forms,
 *  [user_meta_value key="whatever"]
 */
add_shortcode('user_meta_value', 'user_meta_shortcode_handler');
function user_meta_shortcode_handler($atts, $content = null) {

	if (!isset($atts['user_id'])) {
		$user = wp_get_current_user();
		$atts['user_id'] = $user->ID;
	}
	if (!isset($atts['size'])) {
		$atts['size'] = '50';
	}
	if ( !isset( $atts['pre'] ) ) {
		$atts['pre'] = '';
	}
	if ( !isset( $atts['post'] ) ) {
		$atts[ 'post' ] = '';
	}
	if (!isset($atts['wpautop'])) {
		$atts['wpautop'] = '';
	}

	$user = new WP_User($atts['user_id']);

	if (!$user->exists()) return;

	if ($atts['key'] == 'avatar') {
		return $atts['pre'].get_avatar($user->ID, $atts['size']).$atts['post'];
	}
	if ($user->has_prop($atts['key'])) {
		if ($atts['wpautop'] == 'on') {
			$value = wpautop($user->get($atts['key']));
		} else {
			$value = $user->get($atts['key']);
		}
	}

	if (!empty($value)) {
		return $atts['pre'].$value.$atts['post'];
	}

	return;
}