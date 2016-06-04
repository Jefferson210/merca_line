<?php
/**
 * mediaphase Theme Customizer
 *
 * @package mediaphase
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mediaphase_customize_register( $wp_customize )
{
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	// custom handler - textarea
	class Themefurnace_Textarea_Control extends WP_Customize_Control
	{
		public $type = 'textarea';

		public function render_content()
		{
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5"
						  style="width:100%;" <?php $this->link(); ?>><?php echo mediaphase_sanitize_textarea( $this->value() ); ?></textarea>
			</label>
		<?php
		}
	}

	function mediaphase_sanitize_textarea( $text )
	{
		return strip_tags( $text, '<p><a><i><br><strong><b><em><ul><li><ol><span><h1><h2><h3><h4>' );
	}

	function mediaphase_sanitize_integer( $text )
	{
		return ( int )$text;
	}
}

add_action( 'customize_register', 'mediaphase_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mediaphase_customize_preview_js()
{
	wp_enqueue_script( 'mediaphase_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130513', true );
}

add_action( 'customize_preview_init', 'mediaphase_customize_preview_js' );

function mediaphase_sanitize_color_hex( $value )
{
	if ( !preg_match( '/\#[a-fA-F0-9]{6}/', $value ) ) {
		$value = '#ffffff';
	}

	return $value;
}

function mediaphase_customizer( $wp_customize )
{

	$wp_customize->add_panel( 'mediaphase_homepage', array(
		'title' => __( 'Homepage Setup', 'mediaphase' ),
		'priority' => 10,
	) );

	// header logo
	$wp_customize->add_section( 'mediaphase_header_logo', array(
		'title'    => 'Header logo',
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'mediaphase_header_logo_show', array(
		'default'           => 'logo',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_header_logo_show', array(
		'label'    => __( 'Show header logo or text', 'mediaphase' ),
		'section'  => 'mediaphase_header_logo',
		'settings' => 'mediaphase_header_logo_show',
		'type'     => 'select',
		'choices'  => array( 'logo' => __( 'Logo', 'mediaphase' ), 'text' => __( 'Text', 'mediaphase' ) ),
	) );

	$wp_customize->add_setting( 'mediaphase_header_logo_image', array(
		'default'           => get_template_directory_uri() . '/img/logo.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mediaphase_header_logo_image', array(
		'label'    => __( 'Logo image', 'mediaphase' ),
		'section'  => 'mediaphase_header_logo',
		'settings' => 'mediaphase_header_logo_image',
	) ) );

	$wp_customize->add_setting( 'mediaphase_header_logo_text', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'mediaphase_header_logo_text', array(
		'label'   => __( 'Text', 'mediaphase' ),
		'section' => 'mediaphase_header_logo',
	) );
	// end header logo

	// contacts
	$wp_customize->add_section( 'mediaphase_header_contacts', array(
		'title'    => 'Header contacts',
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'mediaphase_header_contacts_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_header_contacts_show', array(
		'label'    => __( 'Show header contacts', 'mediaphase' ),
		'section'  => 'mediaphase_header_contacts',
		'settings' => 'mediaphase_header_contacts_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'mediaphase' ), 'no' => __( 'No', 'mediaphase' ) ),
	) );

	$wp_customize->add_setting( 'mediaphase_header_contacts_phone', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'mediaphase_header_contacts_phone', array(
		'label'   => __( 'Phone', 'mediaphase' ),
		'section' => 'mediaphase_header_contacts',
	) );

	$wp_customize->add_setting( 'mediaphase_header_contacts_email', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'mediaphase_header_contacts_email', array(
		'label'   => __( 'Email', 'mediaphase' ),
		'section' => 'mediaphase_header_contacts',
	) );
	// end contacts

	// hero banner
	$wp_customize->add_section( 'mediaphase_hero', array(
		'title'       => 'Hero Banner',
		'priority'    => 50,
		'description' => 'Big banner section on the front page - background image, title and text',
		'panel' => 'mediaphase_homepage',
	) );

	$wp_customize->add_setting( 'mediaphase_hero_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_hero_show', array(
		'label'    => __( 'Show hero banner in the front page', 'mediaphase' ),
		'section'  => 'mediaphase_hero',
		'settings' => 'mediaphase_hero_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'mediaphase' ), 'no' => __( 'No', 'mediaphase' ) ),
	) );

	$wp_customize->add_setting( 'mediaphase_hero_bg_image', array(
		'default'           => get_template_directory_uri() . '/img/hero.jpg',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mediaphase_hero_bg_image', array(
		'label'    => __( 'Background image', 'mediaphase' ),
		'section'  => 'mediaphase_hero',
		'settings' => 'mediaphase_hero_bg_image',
	) ) );

	$wp_customize->add_setting( 'mediaphase_hero_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'mediaphase_hero_title', array(
		'label'   => __( 'Title', 'mediaphase' ),
		'section' => 'mediaphase_hero',
	) );

	$wp_customize->add_setting( 'mediaphase_hero_text', array(
		'sanitize_callback' => 'mediaphase_sanitize_textarea',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new Themefurnace_Textarea_Control( $wp_customize, 'mediaphase_hero_text', array(
		'label'    => __( 'Main text', 'mediaphase' ),
		'section'  => 'mediaphase_hero',
		'settings' => 'mediaphase_hero_text',
	) ) );
	// end hero banner

	// top ribbon
	$wp_customize->add_panel( 'mediaphase_ribbons', array(
		'title'    => __( 'Ribbons', 'mediaphase' ),
		'priority' => 10,
	) );
	$wp_customize->add_section( 'mediaphase_top_ribbon', array(
		'title'       => 'Top Ribbon',
		'priority'    => 50,
		'description' => 'Top ribbon section on the front page - background image and text',
		'panel'       => 'mediaphase_ribbons',
	) );

	$wp_customize->add_setting( 'mediaphase_top_ribbon_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_top_ribbon_show', array(
		'label'    => __( 'Show top ribbon on the front page', 'mediaphase' ),
		'section'  => 'mediaphase_top_ribbon',
		'settings' => 'mediaphase_top_ribbon_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'mediaphase' ), 'no' => __( 'No', 'mediaphase' ) ),
	) );

	$wp_customize->add_setting( 'mediaphase_top_ribbon_bg_image', array(
		'default'           => get_template_directory_uri() . '/img/ribbon1.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mediaphase_top_ribbon_bg_image', array(
		'label'    => __( 'Background image', 'mediaphase' ),
		'section'  => 'mediaphase_top_ribbon',
		'settings' => 'mediaphase_top_ribbon_bg_image',
	) ) );

	$wp_customize->add_setting( 'mediaphase_top_ribbon_text', array(
		'sanitize_callback' => 'mediaphase_sanitize_textarea',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'mediaphase_top_ribbon_text', array(
		'label'   => __( 'Text', 'mediaphase' ),
		'section' => 'mediaphase_top_ribbon',
	) );
	// end top ribbon

	// main features
	$wp_customize->add_section( 'mediaphase_main_features', array(
		'title'       => 'Main Features',
		'priority'    => 50,
		'description' => 'Main features section (front page, widgetized area)',
		'panel' => 'mediaphase_homepage',
	) );

	$wp_customize->add_setting( 'mediaphase_main_features_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_main_features_show', array(
		'label'    => __( 'Show main features on the front page', 'mediaphase' ),
		'section'  => 'mediaphase_main_features',
		'settings' => 'mediaphase_main_features_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'mediaphase' ), 'no' => __( 'No', 'mediaphase' ) ),
	) );

	$wp_customize->add_setting( 'mediaphase_main_features_bg_image', array(
		'default'           => get_template_directory_uri() . '/img/iphones.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mediaphase_main_features_bg_image', array(
		'label'    => __( 'Background image', 'mediaphase' ),
		'section'  => 'mediaphase_main_features',
		'settings' => 'mediaphase_main_features_bg_image',
	) ) );

	$wp_customize->add_setting( 'mediaphase_main_features_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'mediaphase_main_features_title', array(
		'label'   => __( 'Text', 'mediaphase' ),
		'section' => 'mediaphase_main_features',
	) );
	// end main features

	// sub features
	$wp_customize->add_section( 'mediaphase_sub_features', array(
		'title'       => 'Sub Features',
		'priority'    => 50,
		'description' => 'Sub features section (front page, widgetized area)',
		'panel' => 'mediaphase_homepage',
	) );

	$wp_customize->add_setting( 'mediaphase_sub_features_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_sub_features_show', array(
		'label'    => __( 'Show sub features on the front page', 'mediaphase' ),
		'section'  => 'mediaphase_sub_features',
		'settings' => 'mediaphase_sub_features_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'mediaphase' ), 'no' => __( 'No', 'mediaphase' ) ),
	) );
	// end sub features

	// about us
	$wp_customize->add_section( 'mediaphase_about_us', array(
		'title'       => 'About us',
		'priority'    => 50,
		'description' => 'About us section (front page)',
		'panel' => 'mediaphase_homepage',
	) );

	$wp_customize->add_setting( 'mediaphase_about_us_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_about_us_show', array(
		'label'    => __( 'Show about us section on the front page', 'mediaphase' ),
		'section'  => 'mediaphase_about_us',
		'settings' => 'mediaphase_about_us_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'mediaphase' ), 'no' => __( 'No', 'mediaphase' ) ),
	) );

	$wp_customize->add_setting( 'mediaphase_about_us_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'mediaphase_about_us_title', array(
		'label'   => __( 'Title', 'mediaphase' ),
		'section' => 'mediaphase_about_us',
	) );

	$wp_customize->add_setting( 'mediaphase_about_us_text', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'mediaphase_about_us_text', array(
		'label'   => __( 'Text', 'mediaphase' ),
		'section' => 'mediaphase_about_us',
	) );
	// end about us

	// middle ribbon
	$wp_customize->add_section( 'mediaphase_middle_ribbon', array(
		'title'       => 'Middle Ribbon',
		'priority'    => 50,
		'description' => 'Middle ribbon section on the front page - background image and text',
		'panel'       => 'mediaphase_ribbons',
	) );

	$wp_customize->add_setting( 'mediaphase_middle_ribbon_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_middle_ribbon_show', array(
		'label'    => __( 'Show middle ribbon on the front page', 'mediaphase' ),
		'section'  => 'mediaphase_middle_ribbon',
		'settings' => 'mediaphase_middle_ribbon_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'mediaphase' ), 'no' => __( 'No', 'mediaphase' ) ),
	) );

	$wp_customize->add_setting( 'mediaphase_middle_ribbon_bg_image', array(
		'default'           => get_template_directory_uri() . '/img/ribbon2.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mediaphase_middle_ribbon_bg_image', array(
		'label'    => __( 'Background image', 'mediaphase' ),
		'section'  => 'mediaphase_middle_ribbon',
		'settings' => 'mediaphase_middle_ribbon_bg_image',
	) ) );

	$wp_customize->add_setting( 'mediaphase_middle_ribbon_text', array(
		'sanitize_callback' => 'mediaphase_sanitize_textarea',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'mediaphase_middle_ribbon_text', array(
		'label'   => __( 'Text', 'mediaphase' ),
		'section' => 'mediaphase_middle_ribbon',
	) );
	// end middle ribbon

	// meet the team
	$wp_customize->add_section( 'mediaphase_meet_the_team', array(
		'title'       => 'Meet the team',
		'priority'    => 50,
		'description' => 'Meet the team section (front page)',
		'panel' => 'mediaphase_homepage',
	) );

	$wp_customize->add_setting( 'mediaphase_meet_the_team_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_meet_the_team_show', array(
		'label'    => __( 'Show meet the team section on the front page', 'mediaphase' ),
		'section'  => 'mediaphase_meet_the_team',
		'settings' => 'mediaphase_meet_the_team_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'mediaphase' ), 'no' => __( 'No', 'mediaphase' ) ),
	) );

	$wp_customize->add_setting( 'mediaphase_meet_the_team_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'mediaphase_meet_the_team_title', array(
		'label'   => __( 'Title', 'mediaphase' ),
		'section' => 'mediaphase_meet_the_team',
	) );

	$wp_customize->add_setting( 'mediaphase_meet_the_team_text', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'mediaphase_meet_the_team_text', array(
		'label'   => __( 'Text', 'mediaphase' ),
		'section' => 'mediaphase_meet_the_team',
	) );
	// end meet the team

	// latest news
	$wp_customize->add_section( 'mediaphase_latest_news', array(
		'title'       => 'Latest news',
		'priority'    => 50,
		'description' => 'Latest news section (front page)',
		'panel' => 'mediaphase_homepage',
	) );

	$wp_customize->add_setting( 'mediaphase_latest_news_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_latest_news_show', array(
		'label'    => __( 'Show latest news section on the front page', 'mediaphase' ),
		'section'  => 'mediaphase_latest_news',
		'settings' => 'mediaphase_latest_news_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'mediaphase' ), 'no' => __( 'No', 'mediaphase' ) ),
	) );

	$wp_customize->add_setting( 'mediaphase_latest_news_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'mediaphase_latest_news_title', array(
		'label'   => __( 'Title', 'mediaphase' ),
		'section' => 'mediaphase_latest_news',
	) );

	$wp_customize->add_setting( 'mediaphase_latest_news_text', array(
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'mediaphase_latest_news_text', array(
		'label'   => __( 'Text', 'mediaphase' ),
		'section' => 'mediaphase_latest_news',
	) );

	$wp_customize->add_setting( 'mediaphase_latest_news_item_limit', array(
		'sanitize_callback' => 'mediaphase_sanitize_integer',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'default'           => 3,
	) );
	$wp_customize->add_control( 'mediaphase_latest_news_item_limit', array(
		'label'   => __( 'Number of news items to show', 'mediaphase' ),
		'section' => 'mediaphase_latest_news',
	) );
	// end latest news

	// bottom ribbon
	$wp_customize->add_section( 'mediaphase_bottom_ribbon', array(
		'title'       => 'Bottom Ribbon',
		'priority'    => 50,
		'description' => 'Bottom ribbon section on the front page - background image and text',
		'panel'       => 'mediaphase_ribbons',
	) );

	$wp_customize->add_setting( 'mediaphase_bottom_ribbon_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_bottom_ribbon_show', array(
		'label'    => __( 'Show bottom ribbon on the front page', 'mediaphase' ),
		'section'  => 'mediaphase_bottom_ribbon',
		'settings' => 'mediaphase_bottom_ribbon_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'mediaphase' ), 'no' => __( 'No', 'mediaphase' ) ),
	) );

	$wp_customize->add_setting( 'mediaphase_bottom_ribbon_bg_image', array(
		'default'           => get_template_directory_uri() . '/img/ribbon3.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mediaphase_bottom_ribbon_bg_image', array(
		'label'    => __( 'Background image', 'mediaphase' ),
		'section'  => 'mediaphase_bottom_ribbon',
		'settings' => 'mediaphase_bottom_ribbon_bg_image',
	) ) );

	$wp_customize->add_setting( 'mediaphase_bottom_ribbon_text', array(
		'sanitize_callback' => 'mediaphase_sanitize_textarea',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'mediaphase_bottom_ribbon_text', array(
		'label'   => __( 'Text', 'mediaphase' ),
		'section' => 'mediaphase_bottom_ribbon',
	) );
	// end bottom ribbon

	// logos
	$wp_customize->add_section( 'mediaphase_logos', array(
		'title'       => __( 'Customer Logos', 'mediaphase' ),
		'priority'    => 50,
		'description' => 'Logos section on the front page',
		'panel' => 'mediaphase_homepage',
	) );

	$wp_customize->add_setting( 'mediaphase_logos_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_logos_show', array(
		'label'    => __( 'Show logos on the front page', 'mediaphase' ),
		'section'  => 'mediaphase_logos',
		'settings' => 'mediaphase_logos_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'mediaphase' ), 'no' => __( 'No', 'mediaphase' ) ),
	) );

	$wp_customize->add_setting( 'mediaphase_logos_image', array(
		'default'           => get_template_directory_uri() . '/img/logos.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mediaphase_logos_image', array(
		'label'    => __( 'Logos image', 'mediaphase' ),
		'section'  => 'mediaphase_logos',
		'settings' => 'mediaphase_logos_image',
	) ) );
	// end logos

	// footer logo
	$wp_customize->add_section( 'mediaphase_footer_logo', array(
		'title'    => 'Footer logo',
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'mediaphase_footer_logo_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_footer_logo_show', array(
		'label'    => __( 'Show footer logo', 'mediaphase' ),
		'section'  => 'mediaphase_footer_logo',
		'settings' => 'mediaphase_footer_logo_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'mediaphase' ), 'no' => __( 'No', 'mediaphase' ) ),
	) );

	$wp_customize->add_setting( 'mediaphase_footer_logo_image', array(
		'default'           => get_template_directory_uri() . '/img/logo.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mediaphase_footer_logo_image', array(
		'label'    => __( 'Logo image', 'mediaphase' ),
		'section'  => 'mediaphase_footer_logo',
		'settings' => 'mediaphase_footer_logo_image',
	) ) );
	// end footer logo

	// fullwidth page
	$wp_customize->add_section( 'mediaphase_page_fullwidth', array(
		'title'    => 'Full width page',
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'mediaphase_page_fullwidth', array(
		'default'           => 'no',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_page_fullwidth', array(
		'label'    => __( 'Make the pages full width', 'mediaphase' ),
		'section'  => 'mediaphase_page_fullwidth',
		'settings' => 'mediaphase_page_fullwidth',
		'type'     => 'select',
		'choices'  => array( 'no' => __( 'No', 'mediaphase' ), 'yes' => __( 'Yes', 'mediaphase' ) ),
	) );
	// end full width page

	// google fonts
	require_once( dirname( __FILE__ ) . '/google-fonts/fonts.php' );


	$wp_customize->add_section( 'mediaphase_google_fonts', array(
		'title'    => __( 'Fonts', 'mediaphase' ),
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'mediaphase_google_fonts_heading_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_google_fonts_heading_font', array(
		'label'    => __( 'Header Font', 'mediaphase' ),
		'section'  => 'mediaphase_google_fonts',
		'settings' => 'mediaphase_google_fonts_heading_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );

	$wp_customize->add_setting( 'mediaphase_google_fonts_body_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'mediaphase_google_fonts_body_font', array(
		'label'    => __( 'Body Font', 'mediaphase' ),
		'section'  => 'mediaphase_google_fonts',
		'settings' => 'mediaphase_google_fonts_body_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );
	// end google fonts

	// colors
	$wp_customize->add_panel( 'mediaphase_colors', array(
		'title'    => __( 'Colors', 'mediaphase' ),
		'priority' => 10,
	) );

	$wp_customize->add_section( 'colors', array(
			'title'    => __( 'Customize theme colors', 'mediaphase' ),
			'priority' => 35,
			'panel'    => 'mediaphase_colors',
		)
	);

	$wp_customize->add_setting( 'mediaphase_accent_color', array(
			'default'           => '#ed1c24',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mediaphase_sanitize_color_hex',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent', array(
		'label'    => __( 'Accent color', 'mediaphase' ),
		'section'  => 'colors',
		'settings' => 'mediaphase_accent_color',
	) ) );

	$wp_customize->add_setting( 'mediaphase_link_color', array(
			'default'           => '#ed1c24',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mediaphase_sanitize_color_hex',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link', array(
		'label'    => __( 'Link color', 'mediaphase' ),
		'section'  => 'colors',
		'settings' => 'mediaphase_link_color',
	) ) );

	$wp_customize->add_setting( 'mediaphase_heading_color', array(
			'default'           => '#292e32',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mediaphase_sanitize_color_hex',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heading', array(
		'label'    => __( 'Heading color', 'mediaphase' ),
		'section'  => 'colors',
		'settings' => 'mediaphase_heading_color',
	) ) );

	$wp_customize->add_setting( 'mediaphase_text_color', array(
			'default'           => '#494949',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mediaphase_sanitize_color_hex',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text', array(
		'label'    => __( 'Text color', 'mediaphase' ),
		'section'  => 'colors',
		'settings' => 'mediaphase_text_color',
	) ) );

	$wp_customize->add_setting( 'mediaphase_main_content_background_color', array(
			'default'           => '#ffffff',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mediaphase_sanitize_color_hex',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_content_background', array(
		'label'    => __( 'Main content background color', 'mediaphase' ),
		'section'  => 'colors',
		'settings' => 'mediaphase_main_content_background_color',
	) ) );

	$wp_customize->add_setting( 'mediaphase_post_content_background_color', array(
			'default'           => '#f6f6f6',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mediaphase_sanitize_color_hex',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_content_background', array(
		'label'    => __( 'Secondary Content Background Color', 'mediaphase' ),
		'section'  => 'colors',
		'settings' => 'mediaphase_post_content_background_color',
	) ) );

	$wp_customize->add_setting( 'mediaphase_header_background_color', array(
			'default'           => '#31313a',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mediaphase_sanitize_color_hex',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background', array(
		'label'    => __( 'Header background color', 'mediaphase' ),
		'section'  => 'colors',
		'settings' => 'mediaphase_header_background_color',
	) ) );

	$wp_customize->add_setting( 'mediaphase_header_text_color', array(
			'default'           => '#c1c1c1',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mediaphase_sanitize_color_hex',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_text', array(
		'label'    => __( 'Header text color', 'mediaphase' ),
		'section'  => 'colors',
		'settings' => 'mediaphase_header_text_color',
	) ) );

	$wp_customize->add_setting( 'mediaphase_sub_header_background_color', array(
			'default'           => '#292932',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mediaphase_sanitize_color_hex',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sub_header_background', array(
		'label'    => __( 'Sub header background color', 'mediaphase' ),
		'section'  => 'colors',
		'settings' => 'mediaphase_sub_header_background_color',
	) ) );

	$wp_customize->add_setting( 'mediaphase_footer_color', array(
			'default'           => '#31313a',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mediaphase_sanitize_color_hex',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer', array(
		'label'    => __( 'Footer color', 'mediaphase' ),
		'section'  => 'colors',
		'settings' => 'mediaphase_footer_color',
	) ) );

	$wp_customize->add_setting( 'mediaphase_bottom_bar_color', array(
			'default'           => '#292932',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mediaphase_sanitize_color_hex',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bottom_bar', array(
		'label'    => __( 'Bottom bar color', 'mediaphase' ),
		'section'  => 'colors',
		'settings' => 'mediaphase_bottom_bar_color',
	) ) );

	$wp_customize->add_setting( 'mediaphase_ribbon_background_color', array(
			'default'           => '#222222',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mediaphase_sanitize_color_hex',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ribbon_background', array(
		'label'    => __( 'Ribbon background color', 'mediaphase' ),
		'section'  => 'colors',
		'settings' => 'mediaphase_ribbon_background_color',
	) ) );

	$wp_customize->add_setting( 'mediaphase_border_color', array(
			'default'           => '#e2e2e2',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'mediaphase_sanitize_color_hex',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'border_color', array(
		'label'    => __( 'Border color', 'mediaphase' ),
		'section'  => 'colors',
		'settings' => 'mediaphase_border_color',
	) ) );
	// end colors

}

add_action( 'customize_register', 'mediaphase_customizer', 11 );