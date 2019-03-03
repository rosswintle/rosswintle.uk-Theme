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
	<form name=""></form>
	<p>
		# <span class="username">you</span> @ <span class="hostname"><a href="<?= esc_url(home_url()) ?>">rosswintle.uk</a></span> <span id="terminal-time" class="timestamp">[<?= (new DateTime())->format('H:i:s') ?>]</span>
	</p>
	<p>
		<input type="text" name="terminal-input">
	</p>
</section>

<section id="posts">
	<h2>Latest posts</h2>
	<ul class="posts-container">
		<?php $posts = get_posts([
			'category__not_in' => [ 709 ],
			'posts_per_page'   => 8,
		]); ?>
		<?php foreach ($posts as $post) : ?>
			<li>
				<article>
					<h3>
						<a href="<?= get_permalink($post) ?>"><?= get_the_title() ?></a>
					</h3>
					<p class="post-meta">
						<?= get_the_date('Y-m-d'); ?>
					</p>
					<p class="post-excerpt">
						<?= get_the_excerpt($post) ?>
					</p>
				</article>
			</li>
		<?php endforeach; ?>
	</ul>
</section>

<?php get_footer(); ?>
