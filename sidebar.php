<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package oiko_s
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<div class="widget">
		<button id="settings-button" class="button-unstyled">
			&gt; Settings/Theme
		</button>
		<div id="settings-area" class="settings-area">
			<h2 class="widget-title">
				Settings/Theme
			</h2>
			<input type="radio" name="user-theme" id="theme-dark" value="dark"
				<?php checked( rw_user_theme(), 'dark') ?>>
				<label for="theme-dark">Dark</label>
			<input type="radio" name="user-theme" id="theme-light" value="light"
				<?php checked( rw_user_theme(), 'light') ?>>
				<label for="theme-light">Light</label>

		</div>
	</div>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
