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

adf_display_members_area_nav_bar();

?>


	<?php do_action( 'buddyx_sub_header' ); ?>
	
	<?php do_action( 'buddyx_before_content' ); ?>

	<main id="primary" class="site-main full-width">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				the_content();




			endwhile;
		endif; ?>
	</main><!-- #primary -->

<!-- this script is to auto select the group dropdown,
	from the variable "group" passed in the URL ( .. /?group=GROUPSLUG)
	from the corresponding group
	this is only used on the "join group" page,
	for members to join an open group -->

	<script>
		jQuery(document).ready(function($) {
			"use strict";

			function getParameterByName(name, url) {
				if (!url) url = window.location.href;

				name = name.replace(/[\[\]]/g, "\\$&");

				var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
					results = regex.exec(url);

				if (!results) return null;

				if (!results[2]) return '';

				return decodeURIComponent(results[2].replace(/\+/g, " "));
			}

			$( function() {
				/* setup the variables we need to process */
				var this_url = window.location.href;

				/* only process pages that pass the correct query string
				* change "my_option" to the name of the parameter you're passing
				* to this function in the query string */
				if ( this_url.indexOf("group") ) {

					/* get the query string value */
					var option_name = getParameterByName( "group", this_url );

					/* find the corresponding value for this option */
					/* select field (Dropdown) */
					$("select[name='item_meta[222]'").children().each( function() {

					if ( $(this).attr('value') == option_name ) {
						$(this).parent().val( $(this).val() );
					}
				});


		}
		});
		});
	</script>




	<?php do_action( 'buddyx_after_content' ); ?>
<?php
get_footer();