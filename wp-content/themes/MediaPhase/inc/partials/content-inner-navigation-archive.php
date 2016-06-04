<?php
/**
 * The template part for displaying breadcrumbs in archive template.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mediaphase
 */
?>

<div id="innernav">
	<div class="wrap">
		<?php
			the_archive_title( '<h2 class="innerheading">', '</h2>' );
			the_archive_description( '<span class="taxonomy-description">', '</span>' );
		?>
	</div>
</div>