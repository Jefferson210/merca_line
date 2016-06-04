<?php
/**
 * Template name: Blog Default
 *
 * @package mediaphase
 */

get_header();

get_template_part( 'inc/partials/content', 'inner-navigation' );
?>

	<div id="main">
    <div class="wrap">
		<!-- sidebar for blog -->
		<?php get_sidebar(); ?>
		<!-- end sidebar for blog -->

		<!-- content -->
		<?php
		$paged = get_query_var( 'paged', 1 );
		$current_page = $paged > 0 ? '&paged=' . $paged : '';
		query_posts( '&post_type=post&post_status=publish' . $current_page );
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'inc/partials/content', 'blog-default' );
			endwhile;

			mediaphase_pagination();

		else:
			get_template_part( 'inc/partials/content', 'none' );
		endif;

		?>
		<!-- end content -->
	</div></div>

<?php

get_template_part( 'inc/partials/content', 'home-bottom-ribbon' );
get_template_part( 'inc/partials/content', 'home-logos' );

get_footer();