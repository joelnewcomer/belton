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
		if( $images || has_post_thumbnail()): ?>
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
		<section class="product-features box-match entry-content">
			<h2>Features & Benefits</h2>
			<?php echo get_field('features'); ?>
		</section>
		<section class="product-apps box-match entry-content">
			<h2>Applications</h2>
			<?php echo get_field('applications'); ?>
			<div class="tag-filters">
			<?php
			$attrs = wp_get_object_terms($post->ID, 'attributes');
			foreach ($attrs as $attr) {
				echo '<span class="filter transition" data-filter="' . $attr->term_id . '">' . $attr->name . '</span>';
			}
			?>
			</div> <!-- tag-filters -->
		</section>		
		<?php
		$data_sheet = get_field('product_data_sheet');
		$installation = get_field('installation_guideline');
		?>
		<section class="downloads text-center">
			<?php if ($data_sheet != ""): ?>
				<div class="button icon arrow blue"><a href="<?php echo $data_sheet; ?>" target="_blank"><?php get_template_part('assets/images/doc', 'icon.svg'); ?>Download Product Data Sheet<?php get_template_part('assets/images/right', 'arrow.svg'); ?></a></div>
			<?php endif; ?>
			<?php if ($installation != ""): ?>
				<div class="button icon arrow blue"><a href="<?php echo $installation; ?>" target="_blank"><?php get_template_part('assets/images/doc', 'icon.svg'); ?>Download Installation Guideline<?php get_template_part('assets/images/right', 'arrow.svg'); ?></a></div>
			<?php endif; ?>
		</section>
		<?php get_template_part('template-parts/not','finding'); ?>
	</div> <!-- row -->	
</div> <!-- #single-post -->

<script>
jQuery(document).ready(function(){
	jQuery('.box-match').matchHeight({byRow:false});
});
</script>

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