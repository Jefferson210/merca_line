<?php
/**
 * The template part for displaying team section on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mediaphase
 */

$display_meet_the_team = get_theme_mod( 'mediaphase_meet_the_team_show', 'yes' );
if ( $display_meet_the_team === 'yes' ) :
	?>

	<div id="team">
		<div class="wrap">
			<div class="featuretitle"><h2><?php echo get_theme_mod( 'mediaphase_meet_the_team_title' ); ?></h2></div>
			<p class="teamintro"><?php echo get_theme_mod( 'mediaphase_meet_the_team_text' ); ?></p>

			<div id="teammembers">
				<?php
				if ( is_active_sidebar( 'mediaphase-team' ) ) {
					dynamic_sidebar( 'mediaphase-team' );
				}
				?>
			</div>
			<!-- End #teammembers -->

		</div>
		<!-- End #wrap -->
	</div><!-- End #team -->
<?php endif;