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
	<h2>Latest posts</h2>
	<ul class="posts-container">
		<?php
			global $post;

			$posts = get_posts([
				'category__not_in' => [ 709 ],
				'posts_per_page'   => 8,
			]);

			foreach ($posts as $post) {
				setup_postdata( $post );
				get_template_part( 'template-parts/archive-content' );
			}

			wp_reset_postdata();
		?>
	</ul>
</section>

<?php get_footer(); ?>
