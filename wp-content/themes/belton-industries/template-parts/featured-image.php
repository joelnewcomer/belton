<!-- This outputs the featured image. This also works for the blog page.
Uses Aqua Resize and Picturefill to dynamically size and load the featured image for multiple devices.
library/drum-functions.php
-->
<?php
/** If this is the blog page then get the featured image for it **/
if (is_home() && get_option('page_for_posts') ) {
	$image_id = get_post_thumbnail_id(get_option('page_for_posts'));
} else {
	$image_id = get_post_thumbnail_id();
}
$blurred_image = wp_get_attachment_image_src( $image_id, 'width=1048&height=472&crop=1' );
// Default featured image
if ($image_id == null) {
	$blurred_image[0] = get_template_directory_uri() . '/assets/images/default-featured.jpg';
}
?>

<div class="featured-image">
	<div class="blurred-bg blurred-bg-<?php echo $image_id; ?>"></div>
	<div class="row">
		<?php if ($image_id != null) : ?>
		<?php
		$small = array("width" => 640,"height" => 288);
		$medium = array("width" => 1025,"height" => 462);
		$large = array("width" => 1048,"height" => 472);
		echo drum_image($image_id,$small,$medium,$large);
		?>
		<?php else : ?>
			<img src="<?php echo get_template_directory_uri() . '/assets/images/default-featured.jpg'; ?>">
		<?php endif; ?>
		<div class="gradient-overlay"></div>
		<div class="featured-overlay text-center">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
	</div>
</div>

<script>
	jQuery( document ).ready(function() {
	    jQuery('.blurred-bg-<?php echo $image_id; ?>').backgroundBlur({
	        imageURL : '<?php echo $blurred_image[0]; ?>',
	        blurAmount : 7,
	        imageClass : 'bg-blur'
	    });
	});
</script>