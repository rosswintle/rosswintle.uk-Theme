<?php
/**
 * Template part for displaying page content in archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package oiko_s
 */
?>

<li>
	<article>
		<p class="post-meta">
			<a href="<?php the_permalink() ?>">
				<?= get_the_date('Y-m-d H:i:s'); ?>
			</a>
		</p>
		<p class="post-excerpt">
			<?= get_the_content($post) ?>
		</p>
	</article>
</li>
