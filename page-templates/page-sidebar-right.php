<?php
/*
Template Name: Right Sidebar
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<main class="ba-main-content">
	<div class="row ">
		<div class="column medium-8">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
					</div>

					<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>

				</article>
			<?php endwhile;?>
		</div>
		<!-- /.column medium-8 -->
		<?php get_sidebar() ?>
	</div>
	<!-- .row -->
</main>


<?php get_footer();
