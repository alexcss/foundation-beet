<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<main class="ba-main-content">
	<div class="row">
		<div class="medium-8 columns">

			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h1 class="entry-title"><?php _e( 'File Not Found', 'foundationpress' ); ?></h1>
				<div class="entry-content">
					<div class="error">
						<p class="bottom"><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'foundationpress' ); ?></p>
					</div>
					<p><?php _e( 'Please try the following:', 'foundationpress' ); ?></p>
					<ul>
						<li><?php _e( 'Check your spelling', 'foundationpress' ); ?></li>
						<li><?php printf( __( 'Return to the <a href="%s">home page</a>', 'foundationpress' ), home_url() ); ?></li>
						<li><?php _e( 'Click the <a href="javascript:history.back()">Back</a> button', 'foundationpress' ); ?></li>
					</ul>
				</div>
			</article>

		</div>
		<?php get_sidebar(); ?>
	</div>
</main>

<?php get_footer();
