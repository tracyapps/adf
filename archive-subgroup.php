<?php
/**
 * The template for displaying archive pages
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

$post_layout = get_theme_mod( 'blog_layout_option', buddyx_defaults( 'blog-layout-option' ) );

?>

	<?php do_action( 'buddyx_sub_header' ); ?>
	
	<?php do_action( 'buddyx_before_content' ); ?>


	
	<main id="primary" class="site-main full-width">
		<h1 class="page-title">Subgroups</h1>

		<?php

		if ( have_posts() ) {

			get_template_part( 'template-parts/layout/entry-subgroup-grid-layout', get_post_type() );

		} else {
			get_template_part( 'template-parts/content/error' );
		}
		?>

	</main><!-- #primary -->


	<?php do_action( 'buddyx_after_content' ); ?>

<?php
get_footer();