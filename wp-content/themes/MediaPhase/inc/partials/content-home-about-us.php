<?php
/**
 * The template part for displaying about us section on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mediaphase
 */

$display_about_us = get_theme_mod( 'mediaphase_about_us_show', 'yes' );
if ( $display_about_us === 'yes' ) :
?>

<div id="aboutus">
	<div class="wrap">
		<div class="featuretitle"><h2><?php echo get_theme_mod( 'mediaphase_about_us_title' ); ?></h2></div>
		<p><?php echo get_theme_mod( 'mediaphase_about_us_text' ); ?></p>
	</div><!-- End #wrap -->
</div><!-- End #aboutus -->
<?php endif;