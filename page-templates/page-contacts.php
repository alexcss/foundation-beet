<?php
/*
Template Name: Conatcs
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
				</div>

				<?php
				$location = get_field('map');

				if( !empty($location) ): ?>
					<div class="acf-map">
						<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
					</div>
				<?php endif; ?>
			</article>
		<?php endwhile;?>
	</div>
	<!-- .row .column -->
</main>

<?php get_footer();
