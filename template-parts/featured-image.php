<?php
// If a feature image is set, get the id, so it can be injected as a css background property
if ( has_post_thumbnail( $post->ID ) ) :
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
	$image = $image[0];
	?>

<div class="ba-featured-hero" style="background-image: url('<?php echo $image ?>')">
</div>
<?php endif;
