<?php 
/**
 * The template for displaying archive page content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package buddyxpro
 */

namespace BuddyxPro\BuddyxPro;

$post_layout = $args['post_layout'];

$classes = [
    'entry',
    'entry-layout',
    'buddyx-article'
];

$post_style = get_theme_mod( 'blog_layout_style', buddyx_defaults( 'blog-layout-style' ) );
?>

<div class="post-layout <?php echo esc_attr( $post_layout ); ?>">
	<div class="buddyx-article--default">
		<?php while ( have_posts() ) {  the_post(); ?>
			<div class="buddyx-article-col">
				<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
							
							<?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
								<a class="su-post-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
							<?php endif; ?>

							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p style="font-size:small; margin-bottom: 0px;">
								<i>Posted by <?php the_author(); ?> on <?php echo get_the_date(); ?></i> | <?php the_category( '; ' ); ?> <?php the_tags(); ?><br />
								<?php the_excerpt(); ?>
							</p>


					
				</article><!-- #post-<?php the_ID(); ?> -->
			</div>
			<?php
		} 
		?>
    </div>
</div>