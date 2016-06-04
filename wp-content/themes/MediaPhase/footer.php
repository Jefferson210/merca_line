<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package mediaphase
 */
?>

<div id="backtotop">
	<div class="wrap">
		<a href="#"><i class="fa fa-chevron-up"></i></a>
	</div><!-- End #wrap -->
</div>

<div id="footer">
	<div class="wrap">
		<?php
		if ( is_active_sidebar( 'mediaphase-footer' ) ) {
			dynamic_sidebar( 'mediaphase-footer' );
		}
		?>
	</div><!-- End #wrap -->
</div>


<div id="bottom">
	<div class="wrap">
		<a href="<?php echo home_url();?>" rel="home">
			<?php
			$display_footer_logo = get_theme_mod( 'mediaphase_footer_logo_show' , 'yes' );
			if ( $display_footer_logo === 'yes' ) {
				echo '<img src="' . get_theme_mod( 'mediaphase_footer_logo_image' ) . '" class="bottomlogo"/>';
			}
			?>
			<p class="bottomtext">
				<a rel="generator" href="<?php echo esc_url( __( 'http://wordpress.org/', 'mediaphase' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'mediaphase' ), 'WordPress' ); ?></a> <?php printf( __( 'Theme: %1$s by %2$s.', 'mediaphase' ), 'Mediaphase', '<a href="http://wplift.com" rel="designer">WPLift</a>' ); ?>
			</p>
	</div><!-- End #wrap -->
</div>

</div><!-- End .container -->

<?php wp_footer(); ?>

</body>
</html>
