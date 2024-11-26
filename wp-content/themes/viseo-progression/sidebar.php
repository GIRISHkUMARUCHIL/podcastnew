<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package pro
 * @since pro 1.0
 */

if ( ! is_active_sidebar( 'progression-studios-sidebar' ) ) {
	return;
}
?>

<div class="sidebar <?php if ( get_theme_mod( 'progression_studios_sticky_sidebar') == 'on') : ?> sticky-sidebar-progression<?php endif; ?>">
		<?php dynamic_sidebar( 'progression-studios-sidebar' ); ?>
</div><!-- close .sidebar -->