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

		<div class="interactive-region-map">
			<?php echo do_shortcode('[drawattention]'); ?>
		</div>

		<h1>All Regions:</h1>
		
		<?php
		
		if ( have_posts() ) {

			$classes = get_body_class();
			if(in_array('blog',$classes) || in_array('archive',$classes) || in_array('search',$classes)){ 
			
				$args = [ 'post_layout'		=> $post_layout,
						  'body_class'		=> $classes
						  
						];
						
				// Display the list here
				get_template_part( 'template-parts/layout/entry-region-grid-layout', $post_layout, $args );
				
			} else {
				while ( have_posts() ) {
					the_post();
					
					get_template_part( 'template-parts/layout/entry-simple-list-layout', get_post_type() );
				}
			}

			if ( ! is_singular() ) {
				
				get_template_part( 'template-parts/content/pagination' );
			}
		} else {
			get_template_part( 'template-parts/content/error' );
		}
		?>

	</main><!-- #primary -->


	<?php do_action( 'buddyx_after_content' ); ?>

<?php
get_footer();