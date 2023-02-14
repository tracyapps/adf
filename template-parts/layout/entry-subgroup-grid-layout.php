<?php 
/**
 * The template for displaying archive page content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package buddyxpro
 */

namespace BuddyxPro\BuddyxPro;
$subgroup_list = new \WP_Query( array( 'post_parent' => 0, 'post_type' => 'subgroup', 'post_per_page' => 999 ) );
if ( $subgroup_list->have_posts() ) {
?>

<div class="post-layout square-grid">

	<?php while ( $subgroup_list->have_posts() ) {  $subgroup_list->the_post(); ?>
		<a href="<?php the_permalink(); ?>" class="object_container">
			<object>
				<article id="post-<?php the_ID(); ?>" class="single-subgroup">
					<?php
					$subgroup_type = get_the_term_list( $post->ID, 'subgroup_type', '<span>', ' &bull; ', '</span>');
					?>
					<div class="subgroup_type_badge">
						<div class="subgroup_type">
							<?php echo $subgroup_type ?>
						</div>
					</div>
					<?php

					echo '<div class="adf-subgroup-grid-simple">';

					the_post_thumbnail(
						'larger-thumbnail',
						[
							'alt' => the_title_attribute(
								[
									'echo' => false,
								]
							),
						]
					);

					echo '</div>';

					echo '<div class="buddyx-subgroup-grid-content">';

					get_template_part( 'template-parts/content/entry_title', get_post_type() );

					echo '</div>';

					?>
				</article><!-- #post-<?php the_ID(); ?> -->
			</object>
		</a>

	<?php
	}
?>

</div>
<?php }