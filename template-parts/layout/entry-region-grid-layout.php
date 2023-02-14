<?php 
/**
 * The template for displaying archive page content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package buddyxpro
 */

namespace BuddyxPro\BuddyxPro;

?>

<div class="post-layout region-grid">

	<?php while ( have_posts() ) {  the_post(); ?>
		<article id="post-<?php the_ID(); ?>" class="single-region">
			<?php

				echo '<div class="adf-region-grid-thumbnail">';

			?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php
				global $wp_query;
				if ( 0 === $wp_query->current_post ) {
					the_post_thumbnail(
						'full',
						[
							'class' => 'skip-lazy',
							'alt'   => the_title_attribute(
								[
									'echo' => false,
								]
							),
						]
					);
				} else {
					the_post_thumbnail(
						'full',
						[
							'alt' => the_title_attribute(
								[
									'echo' => false,
								]
							),
						]
					);
				}
				?>
			</a><!-- .post-thumbnail -->
			<?php

				echo '</div>';

				echo '<div class="adf-region-grid-content">';

					get_template_part( 'template-parts/content/entry_categories', get_post_type() );

					get_template_part( 'template-parts/content/entry_title', get_post_type() );


				echo '</div>';

			?>
		</article><!-- #post-<?php the_ID(); ?> -->
	<?php
	}
?>

</div>