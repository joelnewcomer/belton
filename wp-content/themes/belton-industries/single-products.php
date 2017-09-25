<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<section class="short-header text-center with-breadcrumb">
	<div class="row">
		<div class="large-12 columns">
			<p class="breadcrumb">
				<span xmlns:v="http://rdf.data-vocabulary.org/#">
					<span typeof="v:Breadcrumb">
						<a href="<?php echo get_site_url(); ?>" rel="v:url" property="v:title">Home</a>  <span class="bc-divider"></span>
						<span rel="v:child" typeof="v:Breadcrumb">
							<?php if ($_GET["ref"] == 'guide') : ?>
								<a href="<?php echo get_site_url(); ?>/product-guide" rel="v:url" property="v:title">Product Guide</a>  <span class="bc-divider"></span> 	
							<?php else : ?>
								<a href="<?php echo get_site_url(); ?>/product-search" rel="v:url" property="v:title">Product Search</a>  <span class="bc-divider"></span> 
							<?php endif; ?>
							<span class="breadcrumb_last"><?php the_title(); ?></span>	
						</span>
					</span>
				</span>
			</p>
			<h1 class="entry-header"><?php the_title(); ?></h1>
		</div> <!-- columns -->
	</div> <!-- row -->
</section> <!-- short-header -->

<div id="single-product" role="main">
	<div class="row">	

<div class="slider-container">
    <ul class="bxslider">
		<?php if( have_rows('slides') ):
			while ( have_rows('slides') ) : the_row(); ?>
                <li>
                    <a href="<?php echo get_sub_field('link_to'); ?>">
						<?php
						// This code uses WP Thumb and Picturefill to dynamically size and load a photo uploaded and cropped by Advanced Custom Fields for multiple devices.
						$image_id = get_sub_field('slide');
						$small = array("width" => 640,"height" => 175);
						$medium = array("width" => 1025,"height" => 280);
						$large = array("width" => 1100,"height" => 300);
						echo drum_image($image_id,$small,$medium,$large,false);
						?>
                    </a>
                </li>
			<?php endwhile;
		endif; ?>
    </ul>
</div> <!-- slider-container -->
	
	</div> <!-- row -->
</div> <!-- #single-post -->
<?php get_footer(); ?>

<script>
jQuery(window).ready(function(){
    jQuery('.bxslider').bxSlider({
        auto: true,
        pager: false,
        controls: true,
        mode: 'fade',
        speed: 1000,
        pause: 7000
    });
});
</script>