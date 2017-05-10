<?php
/*
Template Name: Front
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<main class="ba-main-content">
	<div class="row column">

		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h1 class="entry-title"><?php the_title(); ?></h1>

				<div class="entry-content">
					<?php the_content(); ?>
					<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
				</div>

			</article>
		<?php endwhile;?>

	</div>
	<!-- .row .column -->
</main>

<?php get_footer(); ?>
