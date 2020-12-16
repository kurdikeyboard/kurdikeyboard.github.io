<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Glow
 */

if ( ! is_active_sidebar( 'dt-right-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<div class="dt-right-sidebar">
		<?php dynamic_sidebar( 'dt-right-sidebar' ); ?>
	</div>
</aside><!-- #secondary -->
