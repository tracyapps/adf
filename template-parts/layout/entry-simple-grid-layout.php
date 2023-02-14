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

<div class="post-layout simple-grid">

	<?php while ( have_posts() ) {  the_post(); ?>
		<article id="post-<?php the_ID(); ?>" class="single-region">
			<?php

				echo '<div class="adf-article-grid-simple">';

					//get_template_part( 'template-parts/content/media', get_post_type() );
					get_template_part( 'template-parts/content/entry_thumbnail', get_post_type() );

				echo '</div>';

				echo '<div class="buddyx-article-grid-content">';

					get_template_part( 'template-parts/content/entry_categories', get_post_type() );

					get_template_part( 'template-parts/content/entry_title', get_post_type() );


				echo '</div>';

			?>
		</article><!-- #post-<?php the_ID(); ?> -->
	<?php
	}
?>

</div>