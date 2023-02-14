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

	
	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) {?>
			
			<?php 
				while ( have_posts() ) {
					the_post();
				$author_id = get_the_author_meta( 'ID');
				$author_url = get_the_author_meta( 'url' );

				echo adf_display_regional_information();
				?>
				
				
				<? /* Start page content */
				get_template_part( 'template-parts/content/entry', 'page-region' );
				} ?>
				
				<?php /* Insert citation information and links */ ?>
				
					
					<hr>
			<?php 	

			if ( ! is_singular() ) {
				get_template_part( 'template-parts/content/pagination' );
			}
		} else {
			get_template_part( 'template-parts/content/error' );
		}
		?>


	</main><!-- #primary -->
	<aside id="secondary" class="primary-sidebar widget-area">
		<div class="sticky-sidebar">
			<?php the_post_thumbnail(); ?>
			<?php echo adf_display_regional_leadership(); ?>
		</div>
	</aside>
	<?php do_action( 'buddyx_after_content' ); ?>
<?php
get_footer();