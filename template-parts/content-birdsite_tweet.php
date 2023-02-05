<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package oiko_s
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-meta">
			<span class="tweet-date"><?php the_date( 'Y-m-d H:i:s' ); ?></span>
			<?php if ( $link = get_post_meta( get_the_ID(), '_tweet_url', true ) ) : ?>
				<a class="tweet-link" href="<?php echo $link; ?>">
					View on Twitter if you must ->
				</a>
			<?php endif; ?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			$content = get_the_content();
			$content = preg_replace( '/(@[A-Za-z_]+)/', '<span class="user-mention">$1</span>', $content );
			$content = preg_replace( '/(#[A-Za-z_\-]+)/', '<span class="hashtag">$1</span>', $content );
			echo $content;
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php oiko_s_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
