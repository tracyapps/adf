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

	<?php if ( $post_type == 'lp_course'  ) {?>
		<?php if ( ( $lp_sidebar == 'left' || $lp_sidebar == 'both' )) :?>
			<aside id="secondary" class="left-sidebar widget-area">
				<div class="sticky-sidebar">
					<?php buddyxpro()->display_lp_left_sidebar(); ?>
				</div>
			</aside>
		<?php endif;?>
	<?php }elseif ( class_exists( 'WooCommerce' ) ) { ?>
		<?php if ( ! is_woocommerce() && $default_sidebar == 'left' && ! is_cart() && $default_sidebar == 'left' && ! is_checkout() && $default_sidebar == 'left' && ! is_account_page() && $default_sidebar == 'left' || ! is_woocommerce() && $default_sidebar == 'both' && ! is_cart() && $default_sidebar == 'both' && ! is_checkout() && $default_sidebar == 'both' && ! is_account_page() && $default_sidebar == 'both' ) : ?>
			<aside id="secondary" class="left-sidebar widget-area">
				<div class="sticky-sidebar">
					<?php buddyxpro()->display_left_sidebar(); ?>
				</div>
			</aside>
		<?php endif; ?>
	<?php }else {
		if ( $default_sidebar == 'left' || $default_sidebar == 'both' ) : ?>
		<aside id="secondary" class="left-sidebar widget-area">
			<div class="sticky-sidebar">
				<?php buddyxpro()->display_left_sidebar(); ?>
			</div>
		</aside>
	<?php endif; ?>
	<?php } ?>
	
	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) {?>
			
			<?php 
				while ( have_posts() ) {
					the_post();
				$author_id = get_the_author_meta( 'ID');
				$author_url = get_the_author_meta( 'url' );
				
				?> <p style="text-align: right; font-size: small;">
				<?php echo do_shortcode('[adf_author]'); ?> <br>
				<?php echo do_shortcode('[adf_related]'); ?></p> 
				
				
				<? /* Start page content */
				get_template_part( 'template-parts/content/entry', 'page' );
				} ?>
				
				<?php /* Insert citation information and links */ ?>
				
					
					<hr>
					<div class="colorBlock">
					<p style="font-size:small; margin-bottom: 0px;">
					<?php echo do_shortcode('[adf_pageinfo]'); ?><br>
					<i>Citation: </i>
					<?php if(($author_id <> ("2")) &&  ($author_id <> ("7")))
						{ the_author_meta( 'display_name', $author_id  ); 
						echo(", "); }?>
					"<?php the_title(); ?>", <i>Ár nDraíocht Féin</i>, <?php echo get_the_date(); ?>, <?php the_permalink(); ?></i> 
					</p>
					</div>
					
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

		<?php echo adf_display_oak_leaves_table_of_contents() ?>

		<div class="sticky-sidebar">
			<?php buddyxpro()->display_right_sidebar(); ?>
		</div>
	</aside>


	<?php do_action( 'buddyx_after_content' ); ?>
<?php
get_footer();