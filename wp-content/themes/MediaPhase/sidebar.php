<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package mediaphase
 */
?>

<div id="sidebar">

<?php
	if ( is_active_sidebar( 'mediaphase-sidebar' ) ) {
		dynamic_sidebar( 'mediaphase-sidebar' );
	}
?>
</div>
