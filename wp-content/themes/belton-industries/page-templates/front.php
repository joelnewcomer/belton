<?php
/*
Template Name: Front
*/
get_header(); ?>

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php
$hero_bg = wp_get_attachment_image_src( get_field('banner_image'), 'width=1600&height=800');
?>
<section class="hero full-width" style="background-image: url(<?php echo $hero_bg[0]; ?>)">
	<div class="blue-overlay">
		<?php get_template_part('assets/images/hero', 'overlay.svg'); ?>
	</div>
	<div class="row">
		<div class="large-6 medium-6 columns">
			<h1><?php echo get_field('header'); ?></h1>
			<div class="hero-rule"></div>
			<h2><?php echo get_field('subheader'); ?></h2>	
		</div>
	</div>
	<div class="scroll-down bounce animated"><?php get_template_part('assets/images/right', 'arrow.svg'); ?></div>
	<script>
		jQuery('.scroll-down').click(function() {
			jQuery('html, body').animate({ scrollTop: jQuery('section.history').offset().top}, 1000);
		});
	</script>
</section>

<div class="row">

	<section class="history">
		<div class="large-7 medium-7 columns history-left">
			<h2><?php echo get_field('history_header'); ?></h2>
			<h3><?php echo get_field('history_subheader'); ?></h3>
			<div class="button white arrow shadow"><a href="<?php echo get_field('history_link'); ?>">Our History<?php get_template_part('assets/images/right', 'arrow.svg'); ?></a></div>
		</div>
		<div class="large-5 medium-5 columns history-right text-center transition" style="background-image: url(<?php echo get_field('history_bg_image'); ?>);">
			<?php echo wp_get_attachment_image(get_field('history_logo'), 'full'); ?>
		</div>
		<script>
			jQuery('.history').one('inview', function (event, visible) {
				jQuery('.history-right').addClass('slide-right');
			});		
		</script>
	</section>
	
	<section class="management">
		<div class="large-5 medium-5 columns manage-left transition" style="background-image: url(<?php echo get_field('management_photo'); ?>);">
		</div>
		<div class="large-7 medium-7 columns manage-right right">
			<h2><?php echo get_field('management_header'); ?></h2>
			<p><?php echo get_field('management_content'); ?>
			<a class="inline-arrow" href="<?php echo get_field('management_link'); ?>">Customer Service<?php get_template_part('assets/images/right', 'arrow.svg'); ?></a></p>
		</div>
		<script>
			jQuery('.management').one('inview', function (event, visible) {
				jQuery('.manage-left').addClass('slide-left');
			});		
		</script>		
	</section>
	
	<section class="features">
		<div class="large-12 columns text-center features-header">
			<h2>Our Passion is to Help Your Business Grow</h2><div class="button white arrow shadow"><a href="<?php echo get_field('case_studies_link'); ?>">Case Studies<?php get_template_part('assets/images/right', 'arrow.svg'); ?></a></div>
		</div>
		<?php if(get_field('feature_bullet_groups')): ?>
			<?php while(has_sub_field('feature_bullet_groups')): ?>
				<div class="large-4 medium-4 columns bullet-block">
					<div class="bullet-block-inner">
						<div class="block-header text-center">
							<?php echo file_get_contents(get_sub_field('icon')); ?>
							<h3><?php the_sub_field('title'); ?></h3>
						</div> <!-- block-header -->
						<div class="block-content entry-content">
							<?php if(get_sub_field('bullets')): ?>
								<ul>
								<?php while(has_sub_field('bullets')): ?>
									<li><?php the_sub_field('feature'); ?>
									<?php
									$link = get_sub_field('link');
									if ($link != null) {
										echo '&nbsp;<a class="inline-arrow" href="' . $link . '">Learn More';
										get_template_part('assets/images/right', 'arrow.svg');
										echo '</a>'; 
									}
									?>
									</li>
								<?php endwhile; ?>
								</ul>
							<?php endif; ?>
						</div>
					</div> <!-- bullet-block-inner -->
				</div> <!-- bullet-block -->
			<?php endwhile; ?>
		<?php endif; ?>
		<?php if(get_field('feature_blocks')): ?>
			<?php while(has_sub_field('feature_blocks')): ?>
				<div class="large-6 medium-6 columns bullet-block">
					<div class="feature-block-inner">
						<div class="block-header text-center">
							<?php echo file_get_contents(get_sub_field('icon')); ?>
							<h3><?php the_sub_field('title'); ?></h3>
						</div> <!-- block-header -->
						<div class="block-content entry-content">
							<p>
								<?php
								the_sub_field('blurb');
								$link = get_sub_field('link_to');
								if ($link != null) {
									echo '&nbsp;<a class="inline-arrow" href="' . $link . '">Learn More';
									get_template_part('assets/images/right', 'arrow.svg');
									echo '</a>'; 
								}
								?>
							</p>							
						</div>
					</div> <!-- bullet-block-inner -->
				</div> <!-- bullet-block -->
			<?php endwhile; ?>
		<?php endif; ?>
		<script>
		jQuery( window ).load(function() {
			jQuery('.bullet-block-inner').matchHeight({ byRow: false });
			jQuery('.feature-block-inner').matchHeight({ byRow: false });
		});	
		</script>
	</section> <!-- features -->
	
	<section class="solutions">
		<div class="large-4 medium-4 columns solutions-guide no-padding cat-match">
			<div class="solutions-header">
				<div class="header-rule"></div>
				<h2><span>Let Us Help You Find A</span><br />Pre-Designed Solution</h2>
			</div>
			<div class="steps">
				<div class="step step-1 active">
					<h3><span class="number">1</span><span class="checkmark"><?php get_template_part('assets/images/checkmark.svg'); ?></span>Select Your Market</h3><div class="edit-step" data-edit="step-1">Edit</div>
					<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
				</div>
				<div class="step step-2">
					<h3><span class="number">2</span><span class="checkmark"><?php get_template_part('assets/images/checkmark.svg'); ?></span>Select Your Applications</h3><div class="edit-step" data-edit="step-2">Edit</div>
					<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
				</div>
				<div class="step step-3">
					<h3><span class="number">3</span>View Our Solutions</h3>
					<h4>Not finding the perfect solution?</h4>
					<p>We also provide flexible custom solutions for both small and large applications.</p>
					<div class="button green arrow"><a href="">Let us design it for you <?php get_template_part('assets/images/right', 'arrow.svg'); ?></a></div>
				</div>				
			</div> <!-- steps --> 	
		</div>
		<div class="large-8 medium-8 columns cat-icons cat-match">
			<?php
			$results = get_terms('guide_cats', array ( 'parent' => 0, 'hide_empty' => false  ));
			if ($results) {
			    foreach ($results as $term) {

				    // STEP 1 - Category Icons
			        $custom_id =  'guide_cats_' . $term->term_id;
			        $icon_url = get_field('icon', $custom_id);
			        echo '<a href="#" data-cat-id="' . $term->term_id . '" class="cat-icon transition">';
			        echo file_get_contents( $icon_url );
			        echo '<div class="cat-name">' . $term->name . '</div>';
			        echo '</a>'; ?>

			        <!-- STEP 2 - Subcategory Checkboxes -->
			        <div id="<?php echo $term->term_id; ?>" class="sub-cat transition">
				        <form class="subcat-checkboxes">
					        <?php $subcats = get_terms('guide_cats', array ( 'parent' => $term->term_id, 'hide_empty' => false  )); ?>
					        <?php foreach ($subcats as $subcat) : ?>
					        	<div class="checkbox">
					        		<input type="checkbox" name="subcat" id="<?php echo $subcat->term_id; ?>" value="<?php echo $subcat->term_id; ?>"> <label for="<?php echo $subcat->term_id; ?>"><?php echo $subcat->name; ?></label>
					        	</div>
					        <?php endforeach; ?>
				        </form>
						<div class="button green arrow small"><a class="subcat-cont" href="#" data-cat-id="products-<?php echo $term->term_id; ?>">Continue<?php get_template_part('assets/images/right', 'arrow.svg'); ?></a></div>
					</div> <!-- sub-cat -->

					<!-- STEP 3 - Products/Filters -->
					<div class="cat-products" id="products-<?php echo $term->term_id; ?>">
						<!-- FILTERS -->
						<div class="tag-filters">
							<?php get_template_part('assets/images/filter', 'icon.svg'); ?> Filter by Performance Attributes or Characteristics <a id="remove-all-tags" class="filter transition" href="#">&times; Remove All</a>
							<div class="filters-inner">
								<?php
								$args = array(
									'post_type' => 'products',
									'tax_query' => array(
										array(
											'taxonomy' => 'guide_cats',
											'field'    => 'term_id',
											'terms'    => $term->term_id,
										),
									),
								);
								$all_cat_posts = array();
								$the_query = new WP_Query( $args );
								if ( $the_query->have_posts() ) {
									while ( $the_query->have_posts() ) { $the_query->the_post();
										global $post;
										$all_cat_posts[] = $post->ID;
									}
									wp_reset_postdata();
								}
								$filters = wp_get_object_terms($all_cat_posts, 'attributes');
								foreach ($filters as $filter) {
									echo '<span class="filter transition" data-filter="' . $filter->term_id . '">' . $filter->name . '</span>';
								}
								?>
							</div> <!-- filters-inner -->
						</div> <!-- tag-filters -->
						<!-- PRODUCTS -->
						<?php		
						$args = array(
							'post_type' => 'products',
							'tax_query' => array(
								array(
									'taxonomy' => 'guide_cats',
									'field'    => 'term_id',
									'terms'    => $term->term_id,
								),
							),
						);
						$the_query = new WP_Query( $args );
						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
								<a href="<?php the_permalink(); ?>" class="cat-product">
									<?php
									global $post;
									$featured_id = get_post_thumbnail_id();
									if ($featured_id != null) {
										$img = wp_get_attachment_image( $featured_id, 'width=157&height=85&crop=1' );
									} else {
										$img = '<img src="' . get_template_directory_uri() . '/assets/images/no-image.png" alt="No Photo">';
									}
									?>
									<?php echo $img; ?>
									<h3><?php the_title(); ?></h3>
									<?php echo get_field('description'); ?>
									<div class="tags">
										<?php
										$tags = wp_get_post_terms( $post->ID, 'attributes');
										$counter = 1;
										foreach ($tags as $tag) {
											if ($counter != 1) {
												echo ', ';
											}
											echo '<span id="' . $tag->term_id . '" class="tag">' . $tag->name . '</span>';
											$counter++;
										}
										?>
									</div>
									<div class="faux-button arrow white shadow small">View Product <?php get_template_part('assets/images/right', 'arrow.svg'); ?></div>
								</a> <!-- cat-product -->
							<?php }
							wp_reset_postdata();
						}
						?>
					</div>
			        <?php
			    }
			}
			?>			
		</div> <!-- cat-icons -->
		<script>
		jQuery( window ).load(function() {
			jQuery('.cat-match').matchHeight({ byRow: false });
		});	
		</script>		
		<script>
			jQuery("a.cat-icon").on( "click", function(e) {
				e.preventDefault();
				var catID = jQuery(this).data( "cat-id" );
				jQuery('a.cat-icon').fadeOut("slow", function() {
					jQuery('#' + catID).addClass('active').fadeIn();
  				});
				jQuery('.step-1').removeClass('active');
				jQuery('.step-1').addClass('completed');
				jQuery('.step-2').addClass('active');
			});
			jQuery(".edit-step").on( "click", function(e) {
				var toEdit = jQuery(this).data("edit");
				jQuery('.step').removeClass('active');
				jQuery(this).parent().removeClass('completed').addClass('active');
				jQuery(this).parent().nextAll().removeClass('completed');
				if (toEdit == 'step-1') {
					jQuery('.sub-cat').removeClass('active').fadeOut("fast", function() {
						jQuery('a.cat-icon').fadeIn();
  					});					
				}
				if (toEdit == 'step-2') {
					jQuery('.cat-products').removeClass('active').fadeOut("fast", function() {
						jQuery('.sub-cat.active').fadeIn();
  					});					
				}
			});
			jQuery(".subcat-cont").on( "click", function(e) {
				e.preventDefault();
				var catID = jQuery(this).data( "cat-id" );
				jQuery('.sub-cat').fadeOut("fast", function() {
					jQuery('#' + catID).addClass('active').fadeIn("fast", function() {
						jQuery.fn.matchHeight._update();
					});
  				});
  				jQuery('.step-2').removeClass('active').addClass('completed');
				jQuery('.step-3').addClass('active');
			});
		</script>
	</div> <!-- solutions -->

</div> <!-- row -->

<?php endwhile;?>
<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>