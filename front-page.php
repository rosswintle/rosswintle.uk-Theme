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
	<p>
		# <span class="username">you</span> @ <span class="hostname">oikos.digital</span> <span id="terminal-time" class="timestamp">[<?= (new DateTime())->format('H:i:s') ?>]</span>
	</p>
	<p>
		<input type="text" name="terminal-input">
	</p>
</section>

<?php get_footer(); ?>
