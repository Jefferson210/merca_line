<?php
/**
 * The template part for displaying a bottom ribbon on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mediaphase
 */

$display_bottom_ribbon = get_theme_mod( 'mediaphase_bottom_ribbon_show', 'yes' );
if ( $display_bottom_ribbon === 'yes' ) :
	?>

	<div id="ribbon" class="botribbon">
		<div class="wrap">
			<?php echo get_theme_mod( 'mediaphase_bottom_ribbon_text' ); ?>
		</div><!-- End #wrap -->
	</div>

<?php endif;