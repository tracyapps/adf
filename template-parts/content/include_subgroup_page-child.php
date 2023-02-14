<?php
/**
 *
 * the template for
 * SUBGROUP ** CHILD ** pages
 */

$subgroup_id = adf_subgroup_id();  // the ID of this group
$current_user = wp_get_current_user(); // the current user

$groupmembers = get_field( 'subgroup_members', $subgroup_id ); // fetch all members of this group
$groupmembers_status = adf_group_membership_status( $groupmembers ); // see if this user is in that list



$featured_image = get_field( 'featured_image', $subgroup_id );


$group_forum_object = get_field( 'group_forum', $subgroup_id );
$group_link_id = $group_forum_object[0]->ID;

if ( $groupmembers_status === 'log_in_first' ) {
	echo '<a href="/login/" class="btn button primary_button wp-block-button__link">Please log in first</a>';
} elseif ( $groupmembers_status === 'not_a_member' ) {
	echo '<p>you must be a member of this group to view this page. <br /><br /><a href="../" class="btn button primary_button wp-block-button__link">&laquo; Back to group info page</a></p>';
} elseif ( $groupmembers_status === 'is_member' ) {

?>
	<section class="subgroup_member_only_content">
		<?php the_content(); ?>
 	</section>
	<?php if ( $featured_image ) : ?>
		<aside class="subgroup_featured_image_container">
			<img src="<?php echo esc_url( $featured_image['url'] ); ?>" alt="<?php echo esc_attr( $featured_image['alt'] ); ?>" class="subgroup_featured_image"/>
		</aside>
	<?php endif; ?>
	<aside class="subgroup_membership_info">
		<a href="<?php echo esc_url( get_permalink( $group_link_id ) ) ?>" class="btn button primary_button wp-block-button__link">Go to group forum&nbsp;&raquo;</a>
		<?php echo adf_display_subgroup_child_pages_to_members_only(); ?>
		<a href="../">&laquo; Back to group info page</a>
	</aside>
<?php
}

