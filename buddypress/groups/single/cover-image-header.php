<?php
/**
 * BuddyPress - Groups Cover Image Header.
 *
 * @since 3.0.0
 * @version 3.2.0
 */
$cover_layout = get_theme_mod( 'buddypress_single_group_view');
if ( $cover_layout == 'full' ) {
    $class = 'container-fluid';
}elseif ($cover_layout == 'center') {
    $class = 'container center-view';
}elseif ($cover_layout == 'compact') {
    $class = 'container compact-view';
}elseif ($cover_layout == 'both') {
    $class = 'container center-view compact-view';
}else {
    $class = 'container';
}

$group_link               = bp_get_group_permalink();
$admin_link               = trailingslashit( $group_link . 'admin' );
$group_avatar             = trailingslashit( $admin_link . 'group-avatar' );
$group_cover_link         = trailingslashit( $admin_link . 'group-cover-image' );
$group_cover_image        = bp_attachments_get_attachment( 'url', array( 'object_dir' => 'groups', 'item_id'    => bp_get_group_id() ) );
$has_cover_image          = '';
$has_cover_image_position = '';

?>

<?php if ($cover_layout == 'compact' || $cover_layout == 'both' ) { ?>
    <div class="container">
<?php } ?>
    <div id="cover-image-container">

        <?php
        if ( function_exists('buddypress') && isset(buddypress()->buddyboss )) {
            if ( ! empty( $group_cover_image ) ) {
                $group_cover_position = groups_get_groupmeta( bp_get_current_group_id(), 'bp_cover_position', true );
                $has_cover_image = ' has-cover-image';
                if ( '' !== $group_cover_position ) {
                    $has_cover_image_position = 'has-position';
                }
            }
        }
        ?>

        <div id="header-cover-image" class="<?php echo $has_cover_image_position; echo $has_cover_image; ?>">
            
            <?php if ( bp_group_use_cover_image_header() ) {
                if ( function_exists('buddypress') && isset(buddypress()->buddyboss )) {
                    if ( ! empty( $group_cover_image ) ) {
                        echo '<img class="header-cover-img" src="' . esc_url( $group_cover_image ) . '"' . ( '' !== $group_cover_position ? ' data-top="' . $group_cover_position . '"' : '' ) . ( '' !== $group_cover_position ? ' style="top: ' . $group_cover_position . 'px"' : '' ) . ' alt="" />';
                    }
                }
                ?>
            
                <?php if ( bp_is_item_admin() ) { ?>
                    <a href="<?php echo $group_cover_link; ?>" class="link-change-cover-image bp-tooltip" data-bp-tooltip-pos="right" data-bp-tooltip="<?php esc_attr_e( 'Change Cover Photo', 'buddyxpro' ); ?>">
                        <?php 
                            if ( function_exists('buddypress') && isset(buddypress()->buddyboss )) { ?>
                                <i class="bb-icon-edit-thin"></i>
                            <?php } else { ?>
                                <i class="fa fa-edit"></i>
                            <?php }
                        ?>
                    </a>
                <?php } ?>

                <?php 
                if ( function_exists('buddypress') && isset(buddypress()->buddyboss )) {
                    if ( ! empty( $group_cover_image ) && bp_is_item_admin() ) { ?>
                        <a href="#" class="position-change-cover-image bp-tooltip" data-bp-tooltip-pos="right" data-bp-tooltip="<?php esc_attr_e('Reposition Cover Photo', 'buddyxpro'); ?>">
                            <i class="bb-icon-move"></i>
                        </a>
                        <div class="header-cover-reposition-wrap">
                            <a href="#" class="button small cover-image-cancel"><?php _e('Cancel', 'buddyxpro'); ?></a>
                            <a href="#" class="button small cover-image-save"><?php _e('Save Changes', 'buddyxpro'); ?></a>
                            <span class="drag-element-helper"><i class="bb-icon-menu"></i><?php _e('Drag to move cover photo', 'buddyxpro'); ?></span>
                            <img src="<?php echo esc_url( $group_cover_image );  ?>" alt="<?php _e('Cover photo', 'buddyxpro'); ?>" />
                        </div>
                    <?php }
                }
            }
            ?>

        </div>
    </div><!-- #cover-image-container --> 
<?php if ($cover_layout == 'compact' || $cover_layout == 'both' ) { ?>
    </div>
<?php } ?>

<div class="<?php echo $class ?>">
    <div class="item-header-cover-image-wrapper">
        <div id="item-header-cover-image">
            <?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
                <div id="item-header-avatar">
                        <?php if ( bp_is_item_admin() ) { ?>
                                <a href="<?php echo $group_avatar; ?>" class="link-change-profile-image bp-tooltip" data-bp-tooltip-pos="up" data-bp-tooltip="<?php esc_attr_e( 'Change Group Photo', 'buddyxpro' ); ?>">
                                        <?php 
                                            if ( function_exists('buddypress') && isset(buddypress()->buddyboss )) { ?>
                                                <i class="bb-icon-edit-thin"></i>
                                            <?php } else { ?>
                                                <i class="fa fa-edit"></i>
                                            <?php }
                                        ?>
                                </a>
                        <?php } ?>
                        <?php bp_group_avatar(); ?>
                </div><!-- #item-header-avatar -->
            <?php endif; ?>

        <?php if ( ! bp_nouveau_groups_front_page_description() ) : ?>
            <div id="item-header-content">

                <h2 class="bp-group-title"><?php echo esc_html( bp_get_group_name() ); ?></h2>    
                
                <?php if ( function_exists( 'bp_nouveau_the_group_meta' ) ) { ?>   
                    <p class="highlight group-status"><strong><?php echo esc_html( bp_nouveau_the_group_meta( array( 'keys' => 'status' ) ) ); ?></strong></p>
                <?php } else { ?>
                    <p class="highlight group-status"><strong><?php echo wp_kses( bp_nouveau_group_meta()->status, array( 'span' => array( 'class' => array() ) ) ); ?></strong></p>
                <?php } ?>
                
                <p class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_group_last_active( 0, array( 'relative' => false ) ) ); ?>">
                    <?php
                    /* translators: %s = last activity timestamp (e.g. "active 1 hour ago") */
                    printf( __( 'active %s', 'buddyxpro' ), bp_get_group_last_active() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?>
                </p>

                <?php //echo bp_nouveau_group_meta()->group_type_list; ?>
                <?php if ( function_exists( 'bp_nouveau_the_group_meta' ) ) { ?>
                <?php echo isset( bp_nouveau_the_group_meta()->group_type_list ) ? bp_nouveau_the_group_meta()->group_type_list : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <?php }else { ?>
                    <?php echo isset( bp_nouveau_group_meta()->group_type_list ) ? bp_nouveau_group_meta()->group_type_list : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                <?php } ?>

                <?php
                if ( function_exists( 'bp_group_type_list' ) ) {
                    bp_group_type_list(
                        bp_get_group_id(),
                        array(
                            'label'        => array(
                                'plural'   => __( 'Group Types', 'buddyxpro' ),
                                'singular' => __( 'Group Type', 'buddyxpro' ),
                            ),
                            'list_element' => 'span',
                        )
                    );
                }
                ?>
                
                <?php bp_nouveau_group_hook( 'before', 'header_meta' ); ?>

                <?php if ( bp_nouveau_group_has_meta_extra() ) : ?>
                    <div class="item-meta">

                        <?php if ( function_exists( 'bp_nouveau_the_group_meta' ) ) { ?>   
                            <?php echo bp_nouveau_the_group_meta( array( 'keys' => 'extra' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <?php } else { ?>
                            <?php echo bp_nouveau_group_meta()->extra; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <?php } ?>

                    </div><!-- .item-meta -->
                <?php endif; ?>

                <?php bp_nouveau_group_header_buttons(); ?>

            </div><!-- #item-header-content -->
        <?php endif; ?>

            <?php // bp_get_template_part( 'groups/single/parts/header-item-actions' ); ?>
			<div id="item-actions" class="group-item-actions">

				<?php if ( bp_current_user_can( 'groups_access_group' ) ) : ?>

					<h2 class="bp-screen-reader-text"><?php esc_html_e( 'Group Leaders List', 'buddypress' ); ?></h2>

					<dl class="moderators-lists">
						<dt class="moderators-title"><?php esc_html_e( 'Group Leadership', 'buddypress' ); ?></dt>
						<dd class="user-list admins"><?php bp_group_list_admins(); ?>
							<?php bp_nouveau_group_hook( 'after', 'menu_admins' ); ?>
						</dd>
					</dl>

					<?php
					if ( bp_group_has_moderators() ) :
						bp_nouveau_group_hook( 'before', 'menu_mods' );
						?>

						<dl class="moderators-lists">
							<dt class="moderators-title"><?php esc_html_e( 'Group Officers', 'buddypress' ); ?></dt>
							<dd class="user-list moderators">
								<?php
								bp_group_list_mods();
								bp_nouveau_group_hook( 'after', 'menu_mods' );
								?>
							</dd>
						</dl>

					<?php endif; ?>

				<?php endif; ?>

			</div><!-- .item-actions -->

        </div><!-- #item-header-cover-image -->
    </div><!-- .item-header-cover-image-wrapper -->

<?php if ( ! bp_nouveau_groups_front_page_description() && bp_nouveau_group_has_meta( 'description' ) ) : ?>
	<div class="desc-wrap">
		<div class="group-description">
			<?php bp_group_description(); ?>
		</div><!-- //.group_description -->
	</div>
<?php endif; ?>
</div><!-- .container -->
