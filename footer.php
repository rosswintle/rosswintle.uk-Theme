<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package oiko_s
 */

?>

			</div><!-- #content -->
		</div><!-- .left-column -->
		<div class="right-column" id="menu">
			<?php get_sidebar(); ?>
		</div>
	</div><!-- .columns -->


	<footer id="colophon" class="site-footer">
		<div class="site-info">
			All content &copy Ross Wintle
			<span class="sep"> | </span>
			<a href="https://twitter.com/magicroundabout">@magicroundabout</a>
			<span class="sep"> | </span>
			This site uses no cookies and does not track you
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
