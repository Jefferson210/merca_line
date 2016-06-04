<?php

function mediaphase_load_theme_fonts()
{
	$heading = get_theme_mod( 'mediaphase_google_fonts_heading_font' );
	$body = get_theme_mod( 'mediaphase_google_fonts_body_font' );
	if ( ( !empty( $heading ) && $heading != 'none' ) || ( !empty( $body ) && $body != 'none' ) ) {
		echo '<style type="text/css">';
		$imports = array();
		$styles = array();
		if ( !empty( $heading ) && $heading != 'none' ) {
			$imports[] = '@import url(//fonts.googleapis.com/css?family=' . urlencode( $heading ) . ');';
			$styles[] = 'h1, h2, h3, h4, h5, h6 { font-family: "' . $heading . '" !important }';
		}
		if ( !empty( $body ) && $body != 'none' ) {
			$imports[] = '@import url(//fonts.googleapis.com/css?family=' . urlencode( $body ) . ');';
			$styles[] = 'body { font-family: "' . $body . '" !important }';
		}

		echo implode( "\r\n", $imports );
		echo implode( "\r\n", $styles );
		echo '</style>';

	}
}

add_action( 'wp_head', 'mediaphase_load_theme_fonts' );

function mediaphase_load_theme_styles()
{
	$accent_color = get_theme_mod( 'mediaphase_accent_color', '#ed1c24' );
	$link_color = get_theme_mod( 'mediaphase_link_color', '#ed1c24' );
	$heading_color = get_theme_mod( 'mediaphase_heading_color', '#292e32' );
	$text_color = get_theme_mod( 'mediaphase_text_color', '#494949' );
	$main_content_background_color = get_theme_mod( 'mediaphase_main_content_background_color', '#ffffff' );
	$post_content_background_color = get_theme_mod( 'mediaphase_post_content_background_color', '#fbfbfb' );
	$header_background_color = get_theme_mod( 'mediaphase_header_background_color', '#31313a' );
	$header_text_color = get_theme_mod( 'mediaphase_header_text_color', '#c1c1c1' );
	$subheader_background_color = get_theme_mod( 'mediaphase_sub_header_background_color', '#292932' );
	$footer_background_color = get_theme_mod( 'mediaphase_footer_color', '#31313a' );
	$bottom_bar_background_color = get_theme_mod( 'mediaphase_bottom_bar_color', '#292932' );
	$border_color = get_theme_mod( 'mediaphase_border_color', '#e2e2e2' );

	$top_ribbon_bg = get_theme_mod( 'mediaphase_top_ribbon_bg_image' );
	$hero_image_bg = get_theme_mod( 'mediaphase_hero_bg_image' );
	$middle_ribbon_bg = get_theme_mod( 'mediaphase_middle_ribbon_bg_image' );
	$bottom_ribbon_bg = get_theme_mod( 'mediaphase_bottom_ribbon_bg_image' );


	echo '<style>';
	// accent color
	echo '.topsearch .search-submit,  .teamsocial, .newscategory a, #backtotop a, .sidebarwidget .search-submit, #footer .tagcloud a, #footer .tagcloud a:visited, .tagcloud a, .tagcloud a:visited, .newscategory a, .newscategory a:visited, .footerwidget .search-submit { background-color: ' . $accent_color . '; border-color: ' . $accent_color . ';}';
	echo '.herobutton, body, .topsearch .search-submit, .red, #herotitle a, #herotext a:not(.herobutton), .featuretitle, #backtotop, .sidebarwidget .search-submit, #backtotop  { border-color: ' . $accent_color . ';}';
	echo 'input[type="text"]:focus, input[type="url"]:focus, input[type="email"]:focus, input[type="password"]:focus, input[type="search"]:focus, textarea:focus  { border-bottom-color: ' . $accent_color . ';}';
	echo '.featurewidgeticon a, .featurewidgeticon a:visited, .footerwidget li a::before, .footerwidget li::before, .footerwidget #recentcomments li::before, .sidebartitle .fa, .sidebarwidget li a::before, .sidebarwidget .cat-item a::before, #authorbox .fa, .newsmeta .fa { color: ' . $accent_color . ';}';
	// end accent color
	// link color
	echo 'a, a:visited { color: ' . $link_color . ';}';
	echo '.content h1, .content h2, .content h3, .content h4, .content h5, .content h6 { color: ' . $heading_color . ';}';
	echo 'body, .content { color: ' . $text_color . ';}';
	echo '#main, #news, #aboutus, #team, #logos, #backtotop, #aboutus .featuretitle h2, #team .featuretitle h2, #news .featuretitle h2{ background-color: ' . $main_content_background_color . ';}';
	echo '.singlepost, .sidebarwidget, #authorbox, #comments, #responder, .newspost, #teammembers, #subfeatures{ background-color: ' . $post_content_background_color . ';}';
	echo '#header { background-color: ' . $header_background_color . ';}';
	// header text
	echo '#header, .site-description, #cssmenu > ul > li > a, .contactdetails { color: ' . $header_text_color . ';}';
	echo '#cssmenu > ul > li.menu-item-has-children > a::before, #cssmenu > ul > li.menu-item-has-children > a::after { background-color: ' . $header_text_color .';}';
	// end header text
	echo '#subheader, .topsearch .search-field { background-color: ' . $subheader_background_color .';}';
	echo '#footer { background-color: ' . $footer_background_color .';}';
	echo '#bottom { background-color: ' . $bottom_bar_background_color .';}';

	echo '.topribbon { background-image: ' . ( $top_ribbon_bg ? 'url(' . $top_ribbon_bg . ')' : 'none' ) . '}';
	echo '.midribbon { background-image: ' . ( $middle_ribbon_bg ? 'url(' . $middle_ribbon_bg . ')' : 'none' ) . '}';
	echo '.botribbon { background-image: ' . ( $bottom_ribbon_bg ? 'url(' . $bottom_ribbon_bg . ')' : 'none' ) . '}';
	echo '#hero { background-image: ' . ( $hero_image_bg ? 'url(' . $hero_image_bg . ')' : 'none' ) . '}';

	// border color
	echo '.member, .newspost,  .featurewidgeticon, .wp-caption, pre,  .sidebarwidget li a, .sidebarwidget, .sidebarwidget .search-field, .singlepost, #authorbox, .comments-title, #comments, #reply-title, #responder, textarea, .content blockquote { border-color: ' . $border_color .'; }';
	echo '</style>';
}

add_action( 'wp_head', 'mediaphase_load_theme_styles' );