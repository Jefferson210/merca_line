<?php
/**
 * Template name: Homepage
 *
 * The main template file.
 *
 * @package mediaphase
 */

get_header();

get_template_part( 'inc/partials/content', 'home-hero' );
get_template_part( 'inc/partials/content', 'home-top-ribbon' );
get_template_part( 'inc/partials/content', 'home-main-features' );
get_template_part( 'inc/partials/content', 'home-sub-features' );
get_template_part( 'inc/partials/content', 'home-about-us' );
get_template_part( 'inc/partials/content', 'home-middle-ribbon' );
get_template_part( 'inc/partials/content', 'home-team' );
get_template_part( 'inc/partials/content', 'home-news' );
get_template_part( 'inc/partials/content', 'home-bottom-ribbon' );
get_template_part( 'inc/partials/content', 'home-logos' );

get_footer();
