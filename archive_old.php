<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package buddyxpro-child
 
	namespace BuddyxPro\BuddyxPro;
 */


get_header();

buddyxpro()->print_styles( 'buddyxpro-content' );
buddyxpro()->print_styles( 'buddyxpro-sidebar', 'buddyxpro-widgets' );

$default_sidebar = get_theme_mod( 'sidebar_option', buddyx_defaults( 'sidebar-option' ) );

$post_layout = get_theme_mod( 'blog_layout_option', buddyx_defaults( 'blog-layout-option' ) );

?>

	<?php do_action( 'buddyx_sub_header' ); ?>
	
	<?php do_action( 'buddyx_before_content' ); ?>

	<?php if ( $default_sidebar == 'left' || $default_sidebar == 'both' ) : ?>
		<aside id="secondary" class="left-sidebar widget-area">
			<div class="sticky-sidebar">
				<?php buddyxpro()->display_left_sidebar(); ?>
			</div>
		</aside>
	<?php endif; ?>
	
	<main id="primary" class="site-main">
		fjadlfjaldfjadlfjahdflakjdhf
		<?php
		if ( have_posts() ) {

			$classes = get_body_class();
			if(in_array('blog',$classes) || in_array('archive',$classes) || in_array('search',$classes)){ 
			
				$args = [ 'post_layout'		=> $post_layout,
						  'body_class'		=> $classes
						];
				get_template_part( 'template-parts/layout/entry', $post_layout, $args );
				
			} else {
				while ( have_posts() ) {
					the_post();
	
					get_template_part( 'template-parts/content/entry', get_post_type() );
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
	
	<?php if ( $default_sidebar == 'right' || $default_sidebar == 'both' ) : ?>
		<aside id="secondary" class="primary-sidebar widget-area">
			<div class="sticky-sidebar">
				<?php buddyxpro()->display_right_sidebar(); ?>
			</div>
		</aside>
	<?php endif; ?>

	<?php do_action( 'buddyx_after_content' ); ?>

<?php
get_footer();