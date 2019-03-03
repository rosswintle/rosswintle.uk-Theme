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
