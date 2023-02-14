<?php
/**
 *
 * the template for
 * SUBGROUP pages that are
 *  **NOT** a child page
 */


$subgroup_id = adf_subgroup_id();  // the ID of this group
$current_user = wp_get_current_user(); // the current user

$groupmembers = get_field( 'subgroup_members', $subgroup_id ); // fetch all members of this group
$groupmembers_status = adf_group_membership_status( $groupmembers ); // see if this user is in that list


$membership_requirement = '';

$featured_image_code = '<aside class="subgroup_featured_image_container"></aside>';
$featured_image = get_field( 'featured_image', $subgroup_id );
if ( $featured_image ) :
	$featured_image_code = '<aside class="subgroup_featured_image_container"><img src="' . esc_url( $featured_image['url'] ) . '" alt="' . esc_attr( $featured_image['alt'] ) . '" class="subgroup_featured_image"/></aside>';
endif;

$join_url = '';
$subgroup_membership_permissions = get_field( 'subgroup_membership', $subgroup_id );
$group_forum_object = get_field( 'group_forum', $subgroup_id );
if( $group_forum_object ) {
	$group_link_id = $group_forum_object[ 0 ]->ID;
} else {
	$group_link_id = 0;
}

if( $groupmembers_status === 'not_a_member' ) {

	if ( $subgroup_membership_permissions === 'open' ) :
		$join_url = FrmFormsController::get_form_shortcode( array( 'id' => 13, 'title' => false, 'description' => false ) );;
		$membership_requirement = '<h4>Open to all ADF Members</h4>' . get_field( 'membership_requirement', $subgroup_id );
	elseif ( $subgroup_membership_permissions === 'restricted'  ) :
		$request_link = get_field( 'request_to_join_link' );
		$join_url = '<a href="' . esc_url( $request_link ) . '" class="button button-primary wp-block-button__link">Request to join&nbsp;&raquo;</a>';
		$membership_requirement = '<h4>Membership Restricted</h4>' . get_field( 'membership_requirement', $subgroup_id );
	endif;
	// end if not a member

} elseif ( $groupmembers_status === 'is_member') {

	$join_url = '<a href="' .  get_permalink( $group_link_id ). '" class="button button-primary wp-block-button__link">Go to group forum&nbsp;&raquo;</a>' . adf_display_subgroup_child_pages_to_members_only();
	$membership_requirement = '<h4>You are a member</h4>';

} elseif ( $groupmembers_status === 'log_in_first') {

	$join_url = '<a href="/login/" class="btn button primary_button wp-block-button__link">Log in &nbsp;&raquo;</a>';
	$membership_requirement = '<h4>Group Membership</h4><p>Please log in to request membership</p>';
}

printf(
	'<section class="mobile_only_subgroup_summary">%s</section>
					<section class="subgroup_info"> 
							<div class="subgroup_summary">%s</div>
 							<div class="subgroup_detail">%s</div>
 					</section>
 					%s
 					<aside class="subgroup_membership_info"><span class="membership_access">%s</span> %s</aside>
					',
	get_field( 'short_subgroup_summary', $subgroup_id ),
	get_field( 'short_subgroup_summary', $subgroup_id ),
	get_field( 'full_description', $subgroup_id ),
	$featured_image_code,
	$membership_requirement,
	$join_url
);
?>
<section class="subgroup_important_links"><?php if ( have_rows( 'important_links_&_resources' ) ): ?>
		<h3 class="page_section_title">Important Links &amp; Resources</h3>
		<ul class="important_links_list">
			<?php while ( have_rows( 'important_links_&_resources' ) ) : the_row(); ?>
				<?php if ( get_row_layout() == 'external_link_url' ) : ?>
					<li class="external_link">
						<a href="<?php the_sub_field( 'link_url' ); ?>"><?php the_sub_field( 'link_text' ); ?><span class="external_icon" title="links to an external website">⌱</span></span></a>
					</li>
				<?php elseif ( get_row_layout() == 'link_to_a_page_on_this_site' ) : ?>
					<li class="internal_link">

						<?php $page_to_link_to = get_sub_field( 'page_to_link_to' ); ?>
						<?php if ( $page_to_link_to ) : ?>
							<a href="<?php echo esc_url( $page_to_link_to); ?>"><?php the_sub_field( 'link_text' ); ?></a>
						<?php endif; ?>
					</li>
				<?php elseif ( get_row_layout() == 'file_download' ) : ?>
					<li class="file_download">

						<?php $file = get_sub_field( 'file' ); ?>
						<?php if ( $file ) : ?>
							<a href="<?php echo esc_url( $file['url'] ); ?>"><?php the_sub_field( 'file_title' ); ?></a>
						<?php endif; ?>
					</li>
				<?php endif; ?>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?></section>
<section class="subgroup_officers">
	<h3 class="page_section_title">Group Officers</h3><?php if ( have_rows( 'subgroup_officers' ) ) : ?>
		<?php while ( have_rows( 'subgroup_officers' ) ) : the_row(); ?>
			<?php $chief = get_sub_field( 'chief' ); ?>
			<?php if ( $chief ) : ?>
				<h4 class="officer_title">Chief</h4>
				<a href="/profile/<?php echo esc_html( $chief['user_nicename'] ); ?>"><?php echo esc_html( $chief['display_name'] ); ?></a>
			<?php endif; ?>
			<?php $vice_chief = get_sub_field( 'vice_chief' ); ?>
			<?php if ( $vice_chief ) : ?>
				<h4 class="officer_title">Vice Chief</h4>
				<a href="/profile/<?php echo esc_html( $vice_chief['user_nicename'] ); ?>"><?php echo esc_html( $vice_chief['display_name'] ); ?></a>
			<?php endif; ?>
			<?php $preceptor = get_sub_field( 'preceptor' ); ?>
			<?php if ( $preceptor ) : ?>
				<h4 class="officer_title">Preceptor</h4>
				<a href="/profile/<?php echo esc_html( $preceptor['user_nicename'] ); ?>"><?php echo esc_html( $preceptor['display_name'] ); ?></a>
			<?php endif; ?>
			<?php $scribe = get_sub_field( 'scribe' ); ?>
			<?php if ( $scribe ) : ?>
				<h4 class="officer_title">Secretary</h4>
				<a href="/profile/<?php echo esc_html( $scribe['user_nicename'] ); ?>"><?php echo esc_html( $scribe['display_name'] ); ?></a>
			<?php endif; ?>
			<?php $treasurer = get_sub_field( 'treasurer' ); ?>
			<?php if ( $treasurer ) : ?>
				<h4 class="officer_title">Treasurer</h4>
				<a href="/profile/<?php echo esc_html( $treasurer['user_nicename'] ); ?>"><?php echo esc_html( $treasurer['display_name'] ); ?></a>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?></section>