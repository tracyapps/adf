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

	the_content();
		
	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buddyxpro' ),
			'after'  => '</div>',
		)
	);
	// Show comments only when the post type supports it and when comments are open or at least one comment exists.
	if ( post_type_supports( get_post_type(), 'comments' ) && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}
	?>
</div><!-- .entry-content -->
