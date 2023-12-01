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
			All content &copy <a href="https://rw.omg.lol/">Ross Wintle</a>
			<span class="sep"> | </span>
			This site uses no cookies and does not track you
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
	function isSlowConnection() {
		if ( ! navigator?.connection?.type && ! navigator?.connection?.effectiveType ) {
			return true;
		}

		if ( navigator?.connection?.type &&
			navigator.connection.type !== 'wifi' &&
			navigator.connection.type !== 'ethernet'
		) {
			return true;
		}

		if ( navigator?.connection?.effectiveType && (
			navigator.connection.effectiveType === 'slow-2g' ||
			navigator.connection.effectiveType === '2g' ||
			navigator.connection.effectiveType === '3g'
			)
		) {
			return true;
		}

		return false;
	}

	function isLocalLink(url) {
		const currentURL = new URL(window.location.href);
		const linkURL = new URL(url);

		return currentURL.host === linkURL.host;
	}

	function preloadOnHover() {
		const linkElements = document.getElementsByTagName('a');

		Array.from(linkElements).forEach( linkElement => {
			linkElement.addEventListener('mouseenter', () => {
				if (! isLocalLink(linkElement.href)) {
					return;
				}

				const preLoadLink = document.createElement('link');
				preLoadLink.rel = 'prefetch';
				preLoadLink.href = linkElement.href;
				document.head.appendChild(preLoadLink);
			})
		})
	};

	if (! isSlowConnection()) {
		preloadOnHover();
	}
</script>

</body>
</html>
