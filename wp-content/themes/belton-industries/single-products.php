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
		<?php 
		$images = get_field('gallery');
		if( $images ): ?>
			<section class="slider">
			    <ul class="bxslider">
				    <li><?php the_post_thumbnail( array( 'width' => 378, 'height' => 237, 'crop' => true ) ) ?></li>
			        <?php foreach( $images as $image ): ?>
			            <li>
			            	<?php echo wp_get_attachment_image( $image['ID'], 'width=378&height=237&crop=1' ); ?>
			            </li>
			        <?php endforeach; ?>
			    </ul>
			</section> <!-- slider-container -->
		<?php endif; ?>
		<section class="description text-center">
			<?php echo get_field('description'); ?>
		</section> <!-- description -->
	</div> <!-- row -->	
</div> <!-- #single-post -->

<?php get_footer(); ?>

<script>
jQuery(window).ready(function(){
    jQuery('.bxslider').bxSlider({
		minSlides: 1,
		maxSlides: 2,
		slideWidth: 378,
		slideMargin: 0,	    
        auto: true,
        pager: false,
        controls: true,
        mode: 'horizontal',
        speed: 1000,
        pause: 7000
    });
});
</script>