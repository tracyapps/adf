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

?>


	<?php do_action( 'buddyx_sub_header' ); ?>
	
	<?php do_action( 'buddyx_before_content' ); ?>

	<main id="primary" class="site-main subgroup_detail_page full-width">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				if ( wp_get_post_parent_id( get_the_ID() ) ) :
					/**
					 * if this is a child page, we do this...
					 */
					get_template_part( 'template-parts/content/include_subgroup_page', 'child' );
				else :
					/**
					 *  otherwise, if this is the parent page, we do this...
					 */
					get_template_part( 'template-parts/content/include_subgroup_page', 'parent' );

				endif; // end if this is the parent page condition
				endwhile;
		endif; ?>
	</main><!-- #primary -->






	<?php do_action( 'buddyx_after_content' ); ?>
<?php
get_footer();