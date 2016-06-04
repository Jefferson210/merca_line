<?php
/**
 * The template part for displaying main features section on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mediaphase
 */

$display_main_features = get_theme_mod( 'mediaphase_main_features_show', 'yes' );
if ( $display_main_features === 'yes' ) :
?>

<div id="mainfeatures">
	<div class="wrap">
		<div class="featuretitle"><h2><?php echo get_theme_mod( 'mediaphase_main_features_title' ); ?></h2></div>

		<img src="<?php echo esc_attr( get_theme_mod( 'mediaphase_main_features_bg_image' ) ); ?>" alt="" class="mainfeaturesimage"/>
		<div class="mainfeaturesleft">
			<?php
			if ( is_active_sidebar( 'mediaphase-main-features-left' ) ) {
				dynamic_sidebar( 'mediaphase-main-features-left' );
			}
			?>
		</div>
		<div class="mainfeaturesright">
			<?php
			if ( is_active_sidebar( 'mediaphase-main-features-right' ) ) {
				dynamic_sidebar( 'mediaphase-main-features-right' );
			}
			?>
		</div>
	</div>

</div><!-- End #mainfeatures -->
<?php endif;