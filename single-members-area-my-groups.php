<?php
/**
 * The page template file
 
 CHILD SITE
 
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package buddyxpro
 */

namespace BuddyxPro\BuddyxPro;

get_header();

adf_display_members_area_nav_bar();

buddyxpro()->print_styles( 'buddyxpro-content' );
buddyxpro()->print_styles( 'buddyxpro-sidebar', 'buddyxpro-widgets' );

$default_sidebar = get_theme_mod( 'sidebar_option', buddyx_defaults( 'sidebar-option' ) );
$lp_sidebar = get_theme_mod( 'lp_sidebar_option', buddyx_defaults( 'lp-sidebar-option' ) );

if ( is_object( $wp_query ) &&  isset($wp_query->query['post_type']) && $wp_query->query['post_type'] != '' ) {
	$post_type = $wp_query->query['post_type'];
} else {
	$post_type = get_post_type();
}
if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'learn_press_profile' ) ) {
	$post_type = 'lp_course';
}
?>


	<?php do_action( 'buddyx_sub_header' ); ?>
	
	<?php do_action( 'buddyx_before_content' ); ?>


	
	<main id="primary" class="site-main full-width">

		<?php


		if ( is_user_logged_in() ) {
			$user_link = function_exists( 'bp_core_get_user_domain' ) ? bp_core_get_user_domain( get_current_user_id() ) : get_author_posts_url( get_current_user_id() );
			$current_user = wp_get_current_user();
			$current_user_display_name = get_field( 'display_name_public', 'user_' . get_current_user_id() );
			$user_member_of = get_field( 'user_member_of', 'user_' . get_current_user_id() );


			echo 'hi ' . $current_user_display_name . '<br />';

			if ( $user_member_of ) {
				echo '<div class="post-layout square-grid">';




				foreach ( $user_member_of as $single_group ) {
					$post = get_post( $single_group );
					$group_link = get_permalink( $post->ID );
					$group_thumbnail = get_the_post_thumbnail( $post->ID, 'larger-thumbnail' );

					printf( '<a href="%s" class="object_container">
							<object> 
								<article class="single-subgroup"> 
									<div class="adf-subgroup-grid-simple"> 
									%s 
										<div class="buddyx-subgroup-grid-content">
											<div class="entry-header-title"> 
											<h2 class="entry-title"> 
											<a href="%s" rel="bookmark">%s</a>
											</h2>
											</div>
										</div>
									</div>
								</article>
							</object>
						</a>',
						esc_url( $group_link ),
						$group_thumbnail,
						esc_url( $group_link ),
						$post->post_title
					);

				};
				echo '</div>'; //end .post-layout .square-grid
			} else {
				echo 'You have not joined any groups. <a href="/subgroups/">Go to all groups &raquo;</a>';
			}

		}
		?>
	</main><!-- #primary -->
	


	<?php do_action( 'buddyx_after_content' ); ?>


<?php
get_footer();