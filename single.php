<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>
<main class="ba-main-content">
	<div class="row">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="column medium-8">
			<article <?php post_class('') ?> id="post-<?php the_ID(); ?>">
				<?php
					if ( has_post_thumbnail() ) :
						the_post_thumbnail();
					endif;
				?>

				<h1 class="entry-title"><?php the_title(); ?></h1>

				<?php foundationpress_entry_meta(); ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

				<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>

				<?php the_tags('<p>'.__('Tags').': ', ', ', '</p>'); ?>

				<?php the_post_navigation(); ?>

				<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>

			</article>

			<?php comments_template(); ?>

			</div>
			<!-- /.column medium-8 -->

		<?php endwhile;?>

		<?php get_sidebar(); ?>
		<!-- /.column medium-4 -->

	</div>
	<!-- .row -->
</main>

<?php get_footer();
