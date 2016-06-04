<?php
/**
 * Functions to display upsell links and data in wp-admin
 */

// Add stylesheet and JS for upsell page.
function mediaphase_upsell_style()
{
	wp_enqueue_style( 'mediaphase-upsell-style', get_template_directory_uri() . '/inc/css/upsell.css' );
	wp_enqueue_style( 'mediaphase-font-awesome', get_template_directory_uri() . '/inc/css/font-awesome-4.3.0.min.css' );
}

// Add upsell page to the menu.
function mediaphase_add_upsell()
{
	$page = add_theme_page(
		__( 'Get More Themes', 'mediaphase' ),
		__( 'Get More Themes', 'mediaphase' ),
		'administrator',
		'mediaphase-themes',
		'mediaphase_display_upsell'
	);

	add_action( 'admin_print_styles-' . $page, 'mediaphase_upsell_style' );
}

add_action( 'admin_menu', 'mediaphase_add_upsell', 11 );

// Define markup for the upsell page.
function mediaphase_display_upsell()
{ ?>

	<div id="mediaphase-upsell-container">
		<div id="mediaphase-upsell-header" class="col-md-12">
			<h2>
				<a href="//themefurnace.com" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/img/themefurnace-logo.png" class="upsell-logo">
				</a>
                <a href="//themefurnace.com" target="_blank" class="button button-secondary customize right upsell-button">Visit ThemeFurnace &raquo;</a><span class="upsell-text">Get 16 More Themes, More Customization Options &amp; Support All for $49 </span>
			</h2>

			<ul id="mediaphase-upsell-themes">
            <li><a href="//themefurnace.com/stacker-theme/" target="_blank"><img src="//themefurnace.com/wp-content/themes/TF2-Theme/img/stacker.png" /></a></li>
            <li><a href="//themefurnace.com/artifact-theme/" target="_blank"><img src="//themefurnace.com/wp-content/themes/TF2-Theme/img/artifact.png" /></a></li>
            <li><a href="//themefurnace.com/onecart-theme/" target="_blank"><img src="//themefurnace.com/wp-content/themes/TF2-Theme/img/onecart.png" /></a></li>
            <li><a href="//themefurnace.com/exposition-theme/" target="_blank"><img src="//themefurnace.com/wp-content/themes/TF2-Theme/img/exposition.png" /></a></li>
            <li><a href="//themefurnace.com/single-page-theme/" target="_blank"><img src="//themefurnace.com/wp-content/themes/TF2-Theme/img/singlepage.png" /></a></li>
            <li><a href="//themefurnace.com/cleanport-theme/" target="_blank"><img src="//themefurnace.com/wp-content/themes/TF2-Theme/img/cleanport.png" /></a></li>
            <li><a href="//themefurnace.com/classique-theme/" target="_blank"><img src="//themefurnace.com/wp-content/themes/TF2-Theme/img/classique.png" /></a></li>
            <li><a href="//themefurnace.com/flatpack-theme/" target="_blank"><img src="//themefurnace.com/wp-content/themes/TF2-Theme/img/flatpack.png" /></a></li>
            <li><a href="//themefurnace.com/cleanbold-theme/" target="_blank"><img src="//themefurnace.com/wp-content/themes/TF2-Theme/img/cleanbold.png" /></a></li>
            <li><a href="//themefurnace.com/elesoft-theme/" target="_blank"><img src="//themefurnace.com/wp-content/themes/TF2-Theme/img/elesoft.png" /></a></li>
            <li><a href="//themefurnace.com/themesoft-theme/" target="_blank"><img src="//themefurnace.com/wp-content/themes/TF2-Theme/img/themesoft.png" /></a></li>
            <li><a href="//themefurnace.com/whiteside-theme/" target="_blank"><img src="//themefurnace.com/wp-content/themes/TF2-Theme/img/whiteside.png" /></a></li>
            <li><a href="//themefurnace.com/busine-theme-2/" target="_blank"><img src="//themefurnace.com/wp-content/themes/TF2-Theme/img/busine.png" /></a></li>
            <li><a href="//themefurnace.com/capiton-theme/" target="_blank"><img src="//themefurnace.com/wp-content/themes/TF2-Theme/img/capiton.png" /></a></li>
            </a>
            </ul>
            <h3>Try out more of our themes, all completely free. <a href="//themefurnace.com/">Upgrade</a> to a paid plan for more customization options and support.</h3>
		</div>


		<div id="upsell-main">
			<?php
			// Set the argument array with author name.
			$args = array(
				'author' => 'themefurnace',
			);

			// Set the $request array.
			$request = array(
				'body' => array(
					'action'  => 'query_themes',
					'request' => serialize( (object)$args )
				)
			);
			$themes = mediaphase_get_themes( $request );
			$active_theme = wp_get_theme()->get( 'Name' );

			// For currently active theme.
			foreach ( $themes->themes as $theme ) {
				if ( $active_theme == $theme->name ) { ?>

					<div id="<?php echo $theme->slug; ?>" class="theme-container col-md-6 col-lg-4">
						<div class="image-container">
							<a href="<?php echo $theme->homepage;?>" target="_blank"><img class="theme-screenshot" src="<?php echo $theme->screenshot_url ?>"></a>

							<div class="theme-description">
								<p><?php echo $theme->description; ?></p>
							</div>
						</div>
						<div class="theme-details active">
							<span
								class="theme-name"><?php echo $theme->name . ':' . __( 'Current theme', 'mediaphase' ); ?></span>
							<a class="button button-secondary customize right" target="_blank"
							   href="<?php echo get_site_url() . '/wp-admin/customize.php' ?>">Customize</a>
						</div>
					</div>

					<?php
					break;
				} else {
					// Set the argument array with author name.
					$args = array(
						'slug' => $theme->slug,
					);

					// Set the $request array.
					$request = array(
						'body' => array(
							'action'  => 'theme_information',
							'request' => serialize( (object)$args )
						)
					);

					$theme_details = mediaphase_get_themes( $request );
					?>

					<div id="<?php echo $theme->slug; ?>" class="theme-container">
						<div class="image-container">
							<a href="<?php echo $theme->homepage;?>"><img class="theme-screenshot" src="<?php echo $theme->screenshot_url ?>"></a>

							<div class="theme-description">
								<p><?php echo $theme->description; ?></p>
							</div>
						</div>
						<div class="theme-details">
							<a href="<?php echo $theme->homepage;?>"><span class="theme-name"><?php echo $theme->name; ?></span></a>
							<!-- Check if the theme is installed -->
							<?php if ( wp_get_theme( $theme->slug )->exists() ) { ?>
								<!-- Show the tick image notifying the theme is already installed. -->
								<span class="icon fa fa-check-circle"></span>
								<!-- Activate Button -->
								<a class="button button-primary activate right"
								   href="<?php echo wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=' . urlencode( $theme->slug ) ), 'switch-theme_' . $theme->slug ); ?>"><?php _e( 'Activate', 'mediaphase' ); ?></a>
							<?php
							} else {
								echo '<span class="icon fa fa-cloud-download"></span> ' . number_format( $theme_details->downloaded ) . ' Downloads';

								// Set the install url for the theme.
								$install_url = add_query_arg( array(
									'action' => 'install-theme',
									'theme'  => $theme->slug,
								), self_admin_url( 'update.php' ) );
								?>
								<!-- Install Button -->
								<a class="button button-primary install right"
								   href="<?php echo esc_url( wp_nonce_url( $install_url, 'install-theme_' . $theme->slug ) ); ?>"><?php _e( 'Install Now', 'mediaphase' ); ?></a>
							<?php } ?>

							<!-- Preview button -->
							<a class="button button-secondary preview right" target="_blank"
							   href="<?php echo '//themefurnacedemos.com/' . str_ireplace( '-lite', '', $theme->slug ); ?>"><?php _e( 'Live Preview', 'mediaphase' ); ?></a>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
<?php
}

// Get all themeisle themes by using API.
function mediaphase_get_themes( $request )
{
	// Generate a cache key that would hold the response for this request:
	$key = 'mediaphase_' . md5( serialize( $request ) );

	// Check transient. If it's there - use that, if not re fetch the theme
	if ( false === ( $themes = get_transient( $key ) ) ) {
		// Transient expired/does not exist. Send request to the API.
		$response = wp_remote_post( 'http://api.wordpress.org/themes/info/1.0/', $request );

		// Check for the error.
		if ( !is_wp_error( $response ) ) {
			$themes = unserialize( wp_remote_retrieve_body( $response ) );
			if ( !is_object( $themes ) && !is_array( $themes ) ) {
				// Response body does not contain an object/array
				return new WP_Error( 'theme_api_error', 'An unexpected error has occurred' );
			}
			// Set transient for next time... keep it for 24 hours should be good
			set_transient( $key, $themes, 60 * 60 * 24 );
		} else {
			// Error object returned
			return $response;
		}
	}

	return $themes;
}