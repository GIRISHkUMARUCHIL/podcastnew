<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package pro
 * @since pro 1.0
 */

if ( ! is_active_sidebar( 'progression-studios-sidebar-shop' ) ) {
	return;
}
?>
<div class="sidebar">
	<?php dynamic_sidebar( 'progression-studios-sidebar-shop' ); ?>
</div><!-- close .sidebar -->