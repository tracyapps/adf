
<?php
/**
ADF Loop for pages - edited from plugins\shortcodes-ultimate\includes\partials\shortcodes\posts\templates\default-loop.php
 */
?>

<div >

	<?php if ( $posts->have_posts() ) : ?>

		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
			<div id="su-post-<?php the_ID(); ?>" class="adf-withborder2" >
				
				<?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
					<a class="su-post-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				<?php endif; ?>

				<h2 class="min-bottom-border"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p style="font-size:small; margin-bottom: 0px;">
					<i>Posted by <?php the_author(); ?> on <?php echo get_the_date(); ?></i> | <?php the_category( '; ' ); ?> <?php the_tags(); ?><br />
					<?php the_excerpt(); ?>
				</p>


			</div>

		<?php endwhile; ?>

	<?php else : ?>
		<h4><?php _e( 'Posts not found', 'shortcodes-ultimate' ); ?></h4>
	<?php endif; ?>

</div>
