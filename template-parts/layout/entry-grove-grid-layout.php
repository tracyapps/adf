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

<div class="post-layout square-grid all-groves">
	<?php while ( have_posts() ) { the_post(); ?>
		<article id="post-<?php the_ID(); ?>" class="single-grove">
			<h4 class="grove_title">
				<?php the_title() ?>
				<?php if( get_field( 'grove_id' ) ) : ?> <span class="grove_id">ID: <?php the_field( 'grove_id' ); ?></span> <?php endif; ?>
			</h4>

			<div class="flex_row">

				<section class="grove_location_information">
					<address class="grove_address">
						<h5>Address</h5>
						<?php if( get_field( 'grove_address__1' ) ) {
							esc_html_e( get_field( 'grove_address__1' ) );
							echo '<br />';
						} ?>
						<?php if( get_field( 'grove_address__2' ) ) {
							esc_html_e( get_field( 'grove_address__2' ) );
							echo '<br />';
						} ?>
						<?php if( get_field( 'grove_city' ) ) {
							esc_html_e( get_field( 'grove_city' ) );
							echo ', ';
						} ?>
						<?php if( get_field( 'grove_stateregion' ) ) {
							esc_html_e( get_field( 'grove_stateregion' ) );
							echo ' ';
						} ?>
						<?php if( get_field( 'grove_zip' ) ) {
							esc_html_e( get_field( 'grove_zip' ) );
							echo '<br />';
						} ?>
					</address>

				</section> <!--/ grove_location_information -->

				<section class="grove_important_dates">
					<?php if( get_field( 'date_founded_day' ) || get_field( 'date_founded_month' ) || get_field( 'date_founded_year' ) ) : ?>
						<div class="founded_date">
							<strong>Founded:</strong>
							<?php if( get_field( 'date_founded_month' ) ) {
								esc_html_e( get_field( 'date_founded_month' ) . '/' );
							}
							if( get_field( 'date_founded_day' ) ) {
								esc_html_e( get_field( 'date_founded_day' ) . '/' );
							}
							if( get_field( 'date_founded_year' ) ) {
								esc_html_e( get_field( 'date_founded_year' ) );
							} ?>
						</div>
					<?php endif; ?>
					<?php if( get_field( 'date_provisional_charter_day' ) || get_field( 'date_provisional_charter_month' ) || get_field( 'date_provisional_charter_year' ) ) : ?>
						<div class="provisional_charter_date">
							<strong>Provisional Charter Date:</strong>
							<?php if( get_field( 'date_provisional_charter_month' ) ) {
								esc_html_e( get_field( 'date_provisional_charter_month' ) . '/' );
							}
							if( get_field( 'date_provisional_charter_day' ) ) {
								esc_html_e( get_field( 'date_provisional_charter_day' ) . '/' );
							}
							if( get_field( 'date_provisional_charter_year' ) ) {
								esc_html_e( get_field( 'date_provisional_charter_year' ) );
							} ?>
						</div>
					<?php endif; ?>
					<?php if( get_field( 'date_full_charter_day' ) || get_field( 'date_full_charter_month' ) || get_field( 'date_full_charter_year' ) ) : ?>
						<div class="full_charter_date">
							<strong>Full Charter Date:</strong>
							<?php if( get_field( 'date_full_charter_month' ) ) {
								esc_html_e( get_field( 'date_full_charter_month' ) . '/' );
							}
							if( get_field( 'date_full_charter_day' ) ) {
								esc_html_e( get_field( 'date_full_charter_day' ) . '/' );
							}
							if( get_field( 'date_full_charter_year' ) ) {
								esc_html_e( get_field( 'date_full_charter_year' ) );
							} ?>
						</div>
					<?php endif; ?>
					<?php if( get_field( 'date_inactive_day' ) || get_field( 'date_inactive_month' ) || get_field( 'date_inactive_year' ) ) : ?>
						<div class="inactive_date">
							<strong>Inactive Since:</strong>
							<?php if( get_field( 'date_inactive_month' ) ) {
								esc_html_e( get_field( 'date_inactive_month' ) . '/' );
							}
							if( get_field( 'date_inactive_day' ) ) {
								esc_html_e( get_field( 'date_inactive_day' ) . '/' );
							}
							if( get_field( 'date_inactive_year' ) ) {
								esc_html_e( get_field( 'date_inactive_year' ) );
							} ?>
						</div>
					<?php endif; ?>
				</section><!--/ grove_important_dates -->
			</div>


			<section class="grove_description">
				<?php if( get_field( 'grove_description' ) ) {
					echo '<div class="main_grove_description">' . wp_kses_post( get_field( 'grove_description' ) ) .'</div>';
				} ?>

				<?php if( get_field( 'grove_cultural_focuses' ) || get_field( 'grove_local_to' ) ) {
					echo '<ul>';

					if ( get_field( 'grove_cultural_focuses' ) ) {
						echo '<li><b>Cultural Focus(es):</b> ' . esc_html( get_field( 'grove_cultural_focuses' ) ) . '</li>';
					}

					if ( get_field( 'grove_local_to' ) ) {
						echo '<li><b>Local to:</b> ' . esc_html( get_field( 'grove_local_to' ) ) . '</li>';
					}

					echo '</ul>';
				} ?>
			</section> <!-- / grove_description -->

			<section class="grove_contact_information">
				<h5><?php the_title() ?> Contact</h5>
				<?php if( get_field( 'grove_contact' ) ) {
					echo '<b>';
					esc_html_e( get_field( 'grove_contact' ) );
					echo '</b><br />';
				} ?>
				<?php if( get_field( 'grove_phone' ) ) {
					echo '<b>Phone:</b> ';
					esc_html_e( get_field( 'grove_phone' ) );
					echo '<br />';
				} ?>
				<?php if( get_field( 'grove_email' ) ) {
					echo '<b>Email:</b> ';
					esc_html_e( get_field( 'grove_email' ) );
					echo '<br />';
				} ?>
			</section><!-- / grove_contact_information -->

			<section class="grove_links">
				<h5>Links</h5>
				<?php if( get_field( 'grove_website' ) ) {
					echo '<svg class="icon-earth-dims">
							<use xlink:href="#earth"></use>
						</svg> 
						<b>Website:</b> <a href="'
						. esc_url( get_field( 'grove_website' ) ) .
						'">'
						. esc_url( get_field( 'grove_website' ) ) .
						'</a><br />';
				} ?>
				<?php if( get_field( 'grove_facebook' ) ) {
					echo '<svg class="icon-facebook-dims">
							<use xlink:href="#facebook"></use>
						</svg>
						<b>Facebook:</b> <a href="'
						. esc_url( get_field( 'grove_facebook' ) ) .
						'">'
						. esc_url( get_field( 'grove_facebook' ) ) .
						'</a><br />';
				} ?>
				<?php if( get_field( 'grove_mailing_list' ) ) {
					echo '<svg class="icon-email-dims">
							<use xlink:href="#email"></use>
						</svg>
						<b>Mailing List:</b> <a href="'
						. esc_url( get_field( 'grove_mailing_list' ) ) .
						'">'
						. esc_url( get_field( 'grove_mailing_list' ) ) .
						'</a><br />';
				} ?>
				<?php if( get_field( 'grove_other_website' ) ) {
					echo '<svg class="icon-link-dims">
							<use xlink:href="#link"></use>
						</svg>
						<b>Other:</b> <a href="'
						. esc_url( get_field( 'grove_other_website' ) ) .
						'">'
						. esc_url( get_field( 'grove_other_website' ) ) .
						'</a><br />';
				} ?>

			</section><!--/ grove_links -->

		</article><!-- #post-<?php the_ID(); ?> -->
	<?php	} ?>


</div>