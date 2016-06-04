<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package mediaphase
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>
<?php $fullwidth = get_theme_mod( 'mediaphase_page_fullwidth', null ); ?>
<body <?php body_class( $fullwidth === 'yes' ? 'fullwidth' : '' ); ?>>
<div class="container">

	<div id="header" class="clearfix">
<div class="wrap">
		<div id="site-branding">
			<div class="site-title">
				<a href="<?php echo esc_attr( home_url() ); ?>" rel="home">
					<?php
					$display_header_logo = get_theme_mod( 'mediaphase_header_logo_show', 'logo' );
					if ( $display_header_logo === 'logo' ) {
						echo '<img src="' . get_theme_mod( 'mediaphase_header_logo_image' ) . '" />';
						echo '<h1 style="display: none">' . get_theme_mod( 'mediaphase_header_logo_text' ) . '</h1>';
					} else {
						echo '<img style="display:none" src="' . get_theme_mod( 'mediaphase_header_logo_image' ) . '" />';
						echo '<h1>' . get_theme_mod( 'mediaphase_header_logo_text' ) . '</h1>';
					}
					?>
				</a>
			</div>
			<div class="site-description"><span><?php bloginfo( 'description' ); ?></span></div>

			<div id="cssmenu">
				<?php
				wp_nav_menu( array(
						'theme_location' => 'primary',
						'container'      => false,
						'items_wrap'     => '<ul>%3$s</ul>',
						'depth'          => 0,
						'fallback_cb'    => 'mediaphase_fallback_menu',
					)
				);
				?>
			</div>
			<!-- End #CSSMenu -->
		</div>
</div>
	</div><!-- End #header -->

	<div id="subheader" class="clearfix">
    <div class="wrap">
		<?php
		$show_contacts = get_theme_mod( 'mediaphase_header_contacts_show', 'yes' );
		if ( $show_contacts === 'yes' ) : ?>
		<div class="contactdetails">
		<?php
		$contact_phone = get_theme_mod( 'mediaphase_header_contacts_phone' );
		if ( !empty( $contact_phone ) ) {
			echo '<span class="contact-phone"><i class="fa fa-phone-square"></i> ' . $contact_phone . ' </span>';
		}
		$contact_email = get_theme_mod( 'mediaphase_header_contacts_email' );
		if ( !empty( $contact_phone ) ) {
			echo '<span class="contact-email"><i class="fa fa-envelope"></i> ' . $contact_email . ' </span>';
		}
		?>
		</div>
		<?php endif; ?>
		<div class="topsearch"><form><span class="fa fa-search"></span><input type="text" class="search-field" value="" name="s"/> <input type="submit" class="search-submit" value="Go"/></form></div>

		<!-- #menu-social -->
		<?php get_template_part( 'inc/partials/menu', 'social' ); ?>
		<!-- End #menu-social -->

	</div></div>
