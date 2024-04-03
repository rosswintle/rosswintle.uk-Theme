<?php
include 'lib/parsedown.php';

function rw_get_now_page_data() {
    $jsonData = get_transient('now_page_json');
    if ($jsonData) {
        return $jsonData;
    }

    $response = wp_remote_get('https://api.omg.lol/address/rw/now');

    if (is_wp_error($response)) {
        return false;
    }

    if (wp_remote_retrieve_response_code($response) !== 200) {
        return false;
    }

    $jsonText = wp_remote_retrieve_body($response);

    // For when PHP 8.3 us used
    // if (json_validate($jsonText) === false) {
    //     return false;
    // }

    $jsonData = json_decode($jsonText, true);
    set_transient('now_page_json', $jsonData, 60 * 15);
    return $jsonData;
}

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">
					<h1 class="entry-title">Now</h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php
                        $jsonData = rw_get_now_page_data();
						$content = $jsonData['response']['now']['content'];
                        // Get rid of everything up to --- Now ---
                        $content = preg_replace('/.*--- Now ---/s', '', $content);
                        // Inject last updated from the response data
                        $content = "Last updated: " . date('Y-m-d', $jsonData['response']['now']['updated']) . "\n\n" . $content;
                        // Remove other tags in curly brackets which are used for formatting on omg.lol
                        $content = preg_replace('/\{.*?\}/s', '', $content);
                        // Parse markdown
                        $Parsedown = new Parsedown();
                        $renderedContent = $Parsedown->text($content);
                        echo $renderedContent
					?>
				</div><!-- .entry-content -->

				<?php if ( get_edit_post_link() ) : ?>
					<footer class="entry-footer">
						<?php
							edit_post_link(
								sprintf(
									wp_kses(
										/* translators: %s: Name of current post. Only visible to screen readers */
										__( 'Edit <span class="screen-reader-text">%s</span>', 'oiko_s' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									get_the_title()
								),
								'<span class="edit-link">',
								'</span>'
							);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
			</article><!-- #post-<?php the_ID(); ?> -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
