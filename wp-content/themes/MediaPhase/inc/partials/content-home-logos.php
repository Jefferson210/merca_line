<?php
/**
 * The template part for displaying logos section on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mediaphase
 */

$display_logos = get_theme_mod( 'mediaphase_logos_show', 'yes' );
if ( $display_logos === 'yes' ) :
?>
<div id="logos">
	<div class="wrap">
		<img src="<?php echo get_theme_mod( 'mediaphase_logos_image' ); ?>" />
	</div><!-- End #wrap -->
</div>
<?php endif;