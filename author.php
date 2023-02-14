<?php
/**
 * The page template file
 
 CHILD SITE
 
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package buddyxpro
 */

namespace BuddyxPro\BuddyxPro;

get_header();

// setup for author page
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

adf_display_members_area_nav_bar();

buddyxpro()->print_styles( 'buddyxpro-content' );
buddyxpro()->print_styles( 'buddyxpro-sidebar', 'buddyxpro-widgets' );

$default_sidebar = get_theme_mod( 'sidebar_option', buddyx_defaults( 'sidebar-option' ) );
$lp_sidebar = get_theme_mod( 'lp_sidebar_option', buddyx_defaults( 'lp-sidebar-option' ) );



global $wp_roles;

$all_roles = $wp_roles->roles;
//$editable_roles = apply_filters('editable_roles', $all_roles);

//$values['value'] = $all_roles;

$values['options'] = array();

foreach( $all_roles as $role ) :
	//echo $role['name'];
	//var_dump( $role );
	$values['options'][] = array(
		'label' => $role['name'],
		'value' => $role['name']
	);
endforeach;



//var_dump( $values );


?>

	<?php do_action( 'buddyx_sub_header' ); ?>
	
	<?php do_action( 'buddyx_before_content' ); ?>


	<main id="primary" class="site-main full-width">
		<header class="bio_header">
			<div class="user_avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 'larger-thumbnail');  ?>
			</div>
			<div class="user_name">
				<?php
				$author_id = get_the_author_meta( 'ID' );
				$author_nicename = get_the_author_meta( 'nicename' );
				$display_name = get_field( 'display_name_public', 'user_' . $author_id );
				$pronouns = get_field( 'pronouns', 'user_' . $author_id );
				$grove_name = get_field( 'users_grove', 'user_' . $author_id );
				$region_id = get_field( 'users_region', 'user_' . $author_id );
				$region_name = $region_id[0]->post_title;
				$region_slug = $region_id[0]->post_name;

				echo $grove_id;

				echo '<h1>';

				if ( isset( $display_name ) ) :
					esc_html_e( $display_name );
				else :
					esc_html_e ( $author_nicename );
				endif;
				if ( isset( $pronouns ) ) :
					echo '<span class="pronouns">(' . esc_html( $pronouns ) . ')</span>';
				endif;

				echo '</h1>';

				echo adf_display_user_role_tags( $author_id );

				if ( $grove_name ) :
					echo '<b>Grove:</b> ' . esc_html( $grove_name ) . '<br />';
				endif;

				if ( $region_id ) :
					echo '<b>Region:</b> <a href="/region/' . esc_html( $region_slug ) . '">' . esc_html( $region_name ) . '</a><br />';
				endif;

				?>
			</div>
			<div class="user_links">
				<?php
				$user_website = get_the_author_meta( 'user_url' );
				$user_facebook = get_the_author_meta( 'facebook' );
				$user_twitter = get_the_author_meta( 'twitter' );
				$user_instagram = get_the_author_meta( 'Instagram' );
				$user_youtube = get_the_author_meta( 'youtube' );
				$user_discord = get_the_author_meta( 'discord' );
				$user_tiktok = get_the_author_meta( 'tiktok' );
				$user_pinterest = get_the_author_meta( 'pinterest' );
				$user_flickr = get_the_author_meta( 'flickr' );

				$website_icon = '<svg class="icon-earth-dims">
							<use xlink:href="#earth"></use>
						</svg>';
				$facebook_icon = '<svg class="icon-facebook-dims">
							<use xlink:href="#facebook"></use>
						</svg>';
				$twitter_icon = '<svg class="icon-social-twitter-dims">
							<use xlink:href="#social-twitter"></use>
						</svg>';
				$instagram_icon = '<svg class="icon-instagram-dims">
							<use xlink:href="#instagram"></use>
						</svg>';
				$youtube_icon = '<svg class="icon-social-youtube-dims">
							<use xlink:href="#social-youtube"></use>
						</svg>';
				$discord_icon = '<svg class="icon-discord-dims">
							<use xlink:href="#discord"></use>
						</svg>';
				$tiktok_icon = '<svg class="icon-Icon_Tiktok-dims">
							<use xlink:href="#Icon_Tiktok"></use>
						</svg>';
				$pinterest_icon = '<svg class="icon-pinterest-dims">
							<use xlink:href="#pinterest"></use>
						</svg>';
				$flickr_icon = '<svg class="icon-flickr-dims">
							<use xlink:href="#flickr"></use>
						</svg>';

				if ( str_starts_with( $user_website, 'http' ) ) {
					echo '<a href="' . esc_url( $user_website ) . '" target="_blank" title="link opens in a new window or tab">' . $website_icon . ' Website' . '</a>';
				} // website

				if ( str_starts_with( $user_facebook, 'http' ) ) {
					echo '<a href="' . esc_url( $user_facebook ) . '" target="_blank" title="link opens in a new window or tab">' . $facebook_icon . ' Facebook ' . '</a>';
				} // facebook

				if ( str_starts_with( $user_twitter, 'http' ) ) {
					echo '<a href="' . esc_url( $user_twitter ) . '" target="_blank" title="link opens in a new window or tab">' . $twitter_icon . ' Twitter' . '</a>';
				} // twitter

				if ( str_starts_with( $user_instagram, 'http' ) ) {
					echo '<a href="' . esc_url( $user_instagram ) . '" target="_blank" title="link opens in a new window or tab">' . $instagram_icon . ' Instagram' . '</a>';
				} // instagram

				if ( str_starts_with( $user_youtube, 'http' ) ) {
					echo '<a href="' . esc_url( $user_youtube ) . '" target="_blank" title="link opens in a new window or tab">' . $youtube_icon . ' YouTube' . '</a>';
				} // youtube

				if ( str_starts_with( $user_discord, 'http' ) ) {
					echo '<a href="' . esc_url( $user_discord ) . '" target="_blank" title="link opens in a new window or tab">' . $discord_icon . ' Discord' . '</a>';
				} // discord
				if ( str_starts_with( $user_tiktok, 'http' ) ) {
					echo '<a href="' . esc_url( $user_tiktok ) . '" target="_blank" title="link opens in a new window or tab">' . $tiktok_icon . ' TikTok' . '</a>';
				} // tiktok
				if ( str_starts_with( $user_pinterest, 'http' ) ) {
					echo '<a href="' . esc_url( $user_pinterest ) . '" target="_blank" title="link opens in a new window or tab">' . $pinterest_icon . ' Pinterest' . '</a>';
				} // pinterest
				if ( str_starts_with( $user_flickr, 'http' ) ) {
					echo '<a href="' . esc_url( $user_flickr ) . '" target="_blank" title="link opens in a new window or tab">' . $flickr_icon . ' Flickr' . '</a>';
				} // flickr



				?>

			</div>

		</header>
		<main class="bio_main">
			<section class="short_bio">
				<?php echo get_the_author_meta( 'description' ); ?>
			</section>

		</main>

		<?php

		if ( have_posts() ) {?>

			<?php
				while ( have_posts() ) {
					the_post();
				?>
					<?php
				get_template_part( 'template-parts/content/entry', 'page-author' );
				} ?>

				<?php /* Insert citation information and links */ ?>



			<?php

			if ( ! is_singular() ) {
				get_template_part( 'template-parts/content/pagination' );
			}
		} else {
			// crickets
		}
		?>
	</main><!-- #primary -->




	<?php do_action( 'buddyx_after_content' ); ?>


<?php
get_footer();