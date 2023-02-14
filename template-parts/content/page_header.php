<?php
/**
 * Template part for displaying the page header of the currently displayed page
 *
 * @package buddyxpro
 */

namespace BuddyxPro\BuddyxPro;
global $post;

if ( is_404() ) {
	?>
	<header class="page-header">
		<h1 class="page-title">
			<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'buddyxpro' ); ?>
		</h1>
	</header><!-- .page-header -->
	<?php
} elseif ( is_home() && ! have_posts() ) {
	?>
	<header class="page-header">
		<h1 class="page-title">
			<?php esc_html_e( 'Nothing Found', 'buddyxpro' ); ?>
		</h1>
	</header><!-- .page-header -->
	<?php
} elseif ( is_home() && ! is_front_page() ) {
	?>
	<header class="page-header">
		<h1 class="page-title">
			<?php single_post_title(); ?>
		</h1>
	</header><!-- .page-header -->
	<?php
} elseif ( is_search() ) {
	?>
	<header class="page-header">
		<h1 class="page-title">
			<?php
			printf(
				/* translators: %s: search query */
				esc_html__( 'Search Results for: %s', 'buddyxpro' ),
				'<span>' . get_search_query() . '</span>'
			);
			?>
		</h1>
	</header><!-- .page-header -->
	<?php
} elseif ( is_archive() ) {
	?>
	<header class="page-header">
		<?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
		?>
	</header><!-- .page-header -->
	<?php
} elseif ( is_singular( 'subgroup' )  && $post->post_parent > 0  ) {
	$subgroup_id = adf_subgroup_id();
	$group_title = get_the_title( $subgroup_id );
	?>
	<header class="page-header">
		<h1><?php esc_html_e( $group_title ) ?>  <span class="subgroup_subpage_title">&bkarow; <?php the_title() ?></span></h1>
	</header><!-- .page-header -->
<?php } else {
	the_title( '<h1 class="entry-title">', '</h1>' );
}
