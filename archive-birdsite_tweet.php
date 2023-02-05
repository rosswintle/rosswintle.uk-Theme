<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package oiko_s
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					Tweet Archive
					<?php
						if (get_query_var('paged')) {
							echo ' (page ' . get_query_var('paged') . ')';
						}
					?>
				</h1>
				<div class="archive-description">I'm not posting to Twitter (much) any more. But here's what I said in the past...</div>
			</header><!-- .page-header -->

			<ul class="posts-container posts-container-microblog">

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 	*/
					get_template_part( 'template-parts/archive-content-microblog' );

				endwhile;
				?>
			</ul>
			<?php
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
