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
<ul>
		<?php while ( have_posts() ) {  the_post();  // start the loop ?>
		<li id="su-post-<?php the_ID(); ?>" style="margin-bottom: 5px;"><b><a href="<?php the_permalink(); ?>" style="font-size:large"><?php the_title(); ?>
		</a></b>
		<?php echo '<span style="font-size:small;color: #373333;"> - ' . do_shortcode('[adf_pageinfo]')  . '</span>'; ?>		
			<?php
		} 
		?>
</ul>
</div>