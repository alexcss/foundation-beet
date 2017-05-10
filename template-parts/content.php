<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blogpost-entry'); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
	<?php endif; ?>

	<h2>
		<a href="<?php the_permalink(); ?>">
			<?php the_title(); ?>
		</a>
	</h2>
	<?php foundationpress_entry_meta(); ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading...', 'foundationpress' ) ); ?>
	</div>

	<?php the_tags('<p>'.__('Tags').': ', ', ', '</p>'); ?>

</article>
