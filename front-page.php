<?php
/**
 * The front page template
 *
 * This is the template that displays the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package oiko_s
 */
?>

<?php get_header(); ?>

<section id="terminal" class="terminal">
	<p class="terminal-header">
		# <span class="username">you</span> @ <span class="hostname"><a href="<?= esc_url(home_url()) ?>">rosswintle.uk</a></span> <span class="timestamp">[<?= (new DateTime())->format('H:i:s') ?>]</span>
	</p>
	<form id="terminal-form">
		<input type="text" name="terminal-input" autocomplete="off">
	</form>
</section>

<section id="posts">
	<h2>
		<?php echo ( get_query_var('page') > 1 ? ('Page ' . get_query_var('page')) : 'Latest posts' ) ?>
	</h2>

	<ul class="posts-container">
		<?php
			global $post;

			$homepage_query = new WP_Query([
				'category__not_in' => [ 709 ],
				'posts_per_page'   => 8,
				'paged' 		   => get_query_var('page'),
			]);

			$posts = $homepage_query->posts;

			foreach ($posts as $post) {
				setup_postdata( $post );
				get_template_part( 'template-parts/archive-content' );
			}
		?>
	</ul>

	<div class="posts-pagination">
		<?php
			echo paginate_links([
				'base'      => home_url( '/%_%' ),
				'format'    => 'page/%#%',
				'current'   => max( 1, get_query_var('page') ),
				'total'     => $homepage_query->max_num_pages,
				'prev_text' => __('«'),
				'next_text' => __('»'),
			]);
		?>
	</div>

	<?php wp_reset_postdata(); ?>

</section>

<?php get_footer(); ?>
