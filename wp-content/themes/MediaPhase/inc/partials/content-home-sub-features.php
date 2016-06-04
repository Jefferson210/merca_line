<?php
/**
 * The template part for displaying sub features section on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mediaphase
 */

$display_sub_features = get_theme_mod( 'mediaphase_sub_features_show', 'yes' );
if ( $display_sub_features === 'yes' ) :
?>
<div id="subfeatures">

	<div class="wrap">
		<?php
		if ( is_active_sidebar( 'mediaphase-sub-features' ) ) {
			dynamic_sidebar( 'mediaphase-sub-features' );
		}
		?>
	</div><!-- End #wrap -->
</div><!-- End #subfeatures -->
<?php endif;