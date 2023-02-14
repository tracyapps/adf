<?php
/**
 * Template part for displaying a post's content
 *
 * @package buddyxpro
 */

namespace BuddyxPro\BuddyxPro;

?>

<div class="entry-content">

	<?php
	if ( has_post_thumbnail() && ! post_password_required() && is_singular() && ! is_singular('lp_course') ) {

		?>
	
		<figure class="featured-media">
	
			<div class="featured-media-inner section-inner">
	
				<?php the_post_thumbnail(); ?>
	
			</div><!-- .featured-media-inner -->
	
		</figure><!-- .featured-media -->
	
		<?php
	}

	the_content();


	$oak_leaves_archives = new \WP_Query(
		array(
			'post_type'      => 'oak-leaves',
			'posts_per_page' => 200,
			'offset'         => 6
		)
	);
	wp_reset_postdata();


	echo '<h2>Latest</h2>';
	echo '<a href="/oak-leaves/" class="primary_button">&laquo; View latest</a>';
	echo '<hr />';
	echo '<h2>Archives</h2>';

	if ( $oak_leaves_archives->have_posts() ) :
		echo '<ul class="oak_leaves_archives_list">';
		while ( $oak_leaves_archives->have_posts() ) :
			$oak_leaves_archives->the_post();

				$attachmenturl = get_attached_media( 'application/pdf', $post->ID);

				$download_output = array();

				foreach($attachmenturl as $attachment) {
					$link = wp_get_attachment_url( $attachment->ID );
					$title = get_the_title( $attachment->ID );

					$download_output[] .= sprintf(
							'
							<a href="%s" class="button download_button">Download <span class="screen_reader_text">%s</span> &raquo;</a>
							',
						esc_url( $link ),
						esc_html( $title )
					);
				}

				printf(
						'<li>
							<a href="%s" class="edition_view_link">
							<object>
								<h3>%s</h3>
								<span class="meta_info">Posted %s</span>
								<button class="primary_button">View &raquo;</button> 
							</object>
							</a>
							<div class="edition_download_link">
								%s
							</div>
 						</li>',
					get_the_permalink(),
					get_the_title(),
					get_the_date(),
					$download_output[0],
					get_the_title()
				);

		endwhile;
		echo '</ul>';
	endif;


	?>
</div><!-- .entry-content -->
