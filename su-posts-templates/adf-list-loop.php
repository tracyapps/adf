<?php defined( 'ABSPATH' ) || exit; ?>

<?php
/**
adf-list-loop.php based on list-loop.php

format:
[su_posts template="su-posts-templates/adf-list-loop.php" id="" posts_per_page="150" post_type="page" taxonomy="category" tax_term="ritual-parts" tax_operator="IN" author="" meta_key="" offset="0" order="ASC" orderby="name" post_parent="" post_status="publish" ignore_sticky_posts="no"]
 */
?>

<ul class="su-posts su-posts-list-loop">
<?php
// Posts are found
if ( $posts->have_posts() ) {
	while ( $posts->have_posts() ) {
		$posts->the_post();
		global $post;
		$author_id = get_the_author_meta( 'ID');
?>

<li id="su-post-<?php the_ID(); ?>" style="margin-bottom: 5px;"><b><a href="<?php the_permalink(); ?>" style="font-size:large"><?php the_title(); ?>
</a></b> 

<?php echo ('<span style="font-size:small;color: #373333;"> - ' . get_pageinfoout ($post) . '</span>'); 


	}
}
// Posts not found
else {
?>
<li><?php _e( 'Posts not found', 'shortcodes-ultimate' ) ?></li>
<?php
}
?>
</ul>
