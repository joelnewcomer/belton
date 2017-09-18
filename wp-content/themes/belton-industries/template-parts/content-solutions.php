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
					<div id="subcats-selected"></div>
				</div>
				<div class="step step-3">
					<h3><span class="number">3</span>View Our Solutions</h3>
					<h4>Not finding the perfect solution?</h4>
					<p>We also provide flexible custom solutions for both small and large applications.</p>
					<div class="button green arrow small"><a href="">Let us design it for you <?php get_template_part('assets/images/right', 'arrow.svg'); ?></a></div>
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
						<div class="button green arrow small"><a class="subcat-cont disabled" href="#" data-cat-id="products-<?php echo $term->term_id; ?>">Continue<?php get_template_part('assets/images/right', 'arrow.svg'); ?></a></div>
					</div> <!-- sub-cat -->

					<!-- STEP 3 - Products/Filters -->
					<div class="cat-products" id="products-<?php echo $term->term_id; ?>">
						<!-- FILTERS -->
						<div class="tag-filters">
							<?php get_template_part('assets/images/filter', 'icon.svg'); ?> Filter by Performance Attributes or Characteristics <a class="remove-all-tags filter transition" href="#">&times; Remove All</a>
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
								<?php
								$classes = '';
								$cats = wp_get_post_terms( $post->ID, 'guide_cats');
								$tags = wp_get_post_terms( $post->ID, 'attributes');
								foreach ($cats as $cat) {
									$classes .= ' cat-' . $cat->term_id;
								}
								foreach ($tags as $tag) {
									$classes .= ' tag-' . $tag->term_id;
								}
								?>
								<a href="<?php the_permalink(); ?>" class="cat-product <?php echo $classes; ?>">
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
										$counter = 1;
										foreach ($tags as $tag) {
											if ($counter != 1) {
												echo ', ';
											}
											echo '<span class="' . $tag->term_id . ' tag">' . $tag->name . '</span>';
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
			// Reset Continue Button
			function resetContBtn() {
				var anyBoxesChecked = false;
				jQuery('.sub-cat.active input[name="subcat"]:checked').each(function() {
					anyBoxesChecked = true;
    			});
    			if (anyBoxesChecked) {
	    			jQuery('.subcat-cont').removeClass('disabled');
    			} else {
	    			jQuery('.subcat-cont').addClass('disabled');
    			}				
			}
			// Primary category Click Function
			jQuery("a.cat-icon").on( "click", function(e) {
				e.preventDefault();
				var catID = jQuery(this).data( "cat-id" );
				jQuery('a.cat-icon').fadeOut("slow", function() {
					jQuery('#' + catID).addClass('active').fadeIn("fast", function() {
						jQuery.fn.matchHeight._update();
						resetContBtn();
					});
  				});
				jQuery('.step-1').removeClass('active');
				jQuery('.step-1').addClass('completed');
				jQuery('.step-2').addClass('active');
			});
			// Edit link click function
			jQuery(".edit-step").on( "click", function(e) {
				jQuery('.remove-all-tags').removeClass('active');
				jQuery('.cat-products').removeClass('filtered');
				jQuery('.filter').removeClass('active');
				jQuery('.tag').removeClass('active');
				jQuery('.cat-product').removeClass('tag-active');
				var toEdit = jQuery(this).data("edit");
				jQuery('.step').removeClass('active');
				jQuery(this).parent().removeClass('completed').addClass('active');
				jQuery(this).parent().nextAll().removeClass('completed');
				if (toEdit == 'step-1') {
					jQuery('.cat-products').removeClass('active');
					jQuery('.sub-cat').removeClass('active').fadeOut("fast", function() {
						jQuery('a.cat-icon').fadeIn();
  					});					
				}
				if (toEdit == 'step-2') {
					jQuery('.cat-products').removeClass('active').fadeOut("fast", function() {
						jQuery('.sub-cat.active').fadeIn();
  					});					
				}
				resetContBtn();
				jQuery.fn.matchHeight._update();
			});
			// Subcategory checkbox change function
			jQuery('input[name="subcat"]').on('change', function() {
				resetContBtn();
				// Reset all products
				jQuery('.cat-product').removeClass('active');
				// Loop through all checked checkboxes and set products active
				jQuery('.sub-cat.active input[name="subcat"]:checked').each(function(index, element) {	
					catID = jQuery(this).attr('id');
					// Loop through products that have this category
					jQuery('.cat-' + catID).each(function(index, element) {
						if (!jQuery(this).hasClass('active')) {
							jQuery(this).addClass('active');
						}
					});
				});
			});
			// Continue to products function
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
				// Reset selected subcategories
				jQuery('#subcats-selected').html('');
				jQuery('.sub-cat.active input[name="subcat"]:checked').each(function(index, element) {	
					subcatSel = jQuery(this).next('label').text();
					jQuery('#subcats-selected').append(subcatSel + '<br />');
				});
				setTimeout(function(){
					jQuery.fn.matchHeight._update();
				}, 1000);
			});
			// Filter click function
			jQuery(".filter").on( "click", function(e) {
				catID = jQuery(this).data('filter');
				jQuery(this).toggleClass('active');
				jQuery('.tag.' + catID).toggleClass('active');
				// Loop through active products
				jQuery('.cat-products.active .cat-product.active').each(function(index, element) {
					var tagActive = false;
					thisProduct = jQuery(this);
					// Loop through selected tags
					jQuery('.cat-products.active .filter.active').each(function(index, element) {	
						filterID = jQuery(this).data('filter');
						if (jQuery(thisProduct).hasClass('tag-' + filterID)) {
							tagActive = true;
							return false; 
						}
					});
					if (tagActive) {
						thisProduct.addClass('tag-active');
					} else {
						thisProduct.removeClass('tag-active');
					}
				});
				// If no filters are active then reset filters
				if (jQuery(".cat-products.active .filter.active:not(.remove-all-tags)").length > 0) {
					jQuery('.cat-products.active').addClass('filtered');
					jQuery('.remove-all-tags').addClass('active');
				} else {
					jQuery('.cat-products.active').removeClass('filtered');
					jQuery('.remove-all-tags').removeClass('active');
				}
				setTimeout(function(){
					jQuery.fn.matchHeight._update();
				}, 500);
			});
			// Remove all tags click function
			jQuery(".remove-all-tags").on( "click", function(e) {
				e.preventDefault();
				jQuery(this).removeClass('active');
				jQuery('.tag').removeClass('active');
				jQuery('.cat-products.active .filter').removeClass('active');
				jQuery('.cat-products.active').removeClass('filtered');
				jQuery('.cat-products.active .cat-product').removeClass('tag-active');
				setTimeout(function(){
					jQuery.fn.matchHeight._update();
				}, 500);
			});
		</script>
	</section> <!-- solutions -->