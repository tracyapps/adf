<?php
/**
 * The main template file
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

$bbpress_sidebar = get_theme_mod( 'bbpress_sidebar_option', buddyx_defaults( 'bbpress-sidebar-option' ) );

?>
	<?php do_action( 'buddyx_sub_header' ); ?>

	<?php
		$group_link = get_field( 'subgroup_page_of_forum' );
		if( $group_link ) {
			$group_page_id = $group_link[0]->ID;
			$group_url = get_permalink( $group_page_id );

			printf(
				'<div class="back_to_subgroup_page">
					<a href="%s">&laquo; Back to %s Group Details </a>
 				</div>',
				esc_html( $group_url ),
				esc_html( $group_link[0]-> post_title )
			);
		}
	?>
	<?php do_action( 'buddyx_before_content' ); ?>


	<?php if ( $bbpress_sidebar == 'left' || $bbpress_sidebar == 'both' ) : ?>
		<aside id="secondary" class="left-sidebar widget-area">
			<div class="sticky-sidebar">
				<?php buddyxpro()->display_bbpress_left_sidebar(); ?>
			</div>
		</aside>
	<?php endif; ?>
	
	<main id="primary" class="site-main">
	
		<?php
		if ( have_posts() ) {

			//get_template_part( 'template-parts/content/page_header' );

			while ( have_posts() ) {
				the_post();

				get_template_part( 'template-parts/content-bbpress' );
			}

			if ( ! is_singular() ) {
				get_template_part( 'template-parts/content/pagination' );
			}
		} else {
			get_template_part( 'template-parts/content/error' );
		}
		?>
		
	</main><!-- #primary -->
	
	<?php if ( $bbpress_sidebar == 'right' || $bbpress_sidebar == 'both' ) : ?>
		<aside id="secondary" class="primary-sidebar widget-area">
			<div class="sticky-sidebar">
				<?php buddyxpro()->display_bbpress_right_sidebar(); ?>
			</div>
		</aside>
	<?php endif; ?>

	<?php do_action( 'buddyx_after_content' ); ?>
<?php
get_footer();
