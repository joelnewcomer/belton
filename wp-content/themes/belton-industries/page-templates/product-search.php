<?php
/*
Template Name: Product Search
*/
get_header(); ?>

<section class="short-header text-center">
	<div class="row">
		<div class="large-12 columns">
			<h1 class="entry-header">Product Search</h1>
		</div>
	</div>
</section>

<?php $results = get_terms('search_cats', array ( 'parent' => 0  )); ?>

<section class="header-margin product-search">
	<div class="row">
		<div class="shadow-container">
			<div class="shadow-container-inner">
				<div class="large-12 columns smart-search">
					<form class="ss-form" role="search" id="searchform" onsubmit="return false;">
						<input type="hidden" id="selectedValue">
						<label class="sr-only" for="product-s">Search</label>
						<input type="text" value="" name="s" id="product-s" placeholder="<?php esc_attr_e( 'Search...', 'foundationpress' ); ?>">
					</form>
				</div> <!-- smart-search -->
				
				<div class="large-12 columns">
					<div class="cat-icons text-center">
						<?php
						if ($results) {
						    foreach ($results as $term) {
						        $custom_id =  'search_cats_' . $term->term_id;
						        $icon_url = get_field('icon', $custom_id);
						        echo '<a href="#" data-cat-id="' . $term->term_id . '" class="cat-icon transition">';
						        echo file_get_contents( $icon_url );
						        echo '<div class="cat-name">' . $term->name . '</div>';
						        echo '</a>';
						    }
						} ?>
					</div> <!-- cat-icons -->
				</div> <!-- columns -->
			</div> <!-- shadow-container-inner -->
		</div> <!-- shadow-container -->
	</div> <!-- row -->
	<div class="row">
		<div class="sub-cats transition">
			<div class="sub-cats-inner">
				<?php foreach ($results as $term) { ?>
					<div class="<?php echo $term->term_id; ?> sub-cat transition text-center">
						<?php $subcats = get_terms('search_cats', array ( 'parent' => $term->term_id, 'hide_empty' => false  )); ?>
						<?php foreach ($subcats as $subcat) : ?>
							<div class="subcat" id="<?php echo $subcat->term_id; ?>">
								<div class="subcat-inner transition">
									<?php echo $subcat->name; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div> <!-- sub-cat -->
				<?php } ?>
			</div> <!-- sub-cats-inner -->
		</div> <!-- sub-cats -->
		
		<div class="guide-link text-center">
			<h3>Not Sure What You Need?</h3><div class="button white shadow small arrow"><a href="<?php echo get_site_url(); ?>/product-guide">Guide Me<?php get_template_part('assets/images/right', 'arrow.svg'); ?></a></div>
		</div>

		<?php foreach ($results as $term) { ?>
			<!-- STEP 3 - Products -->
			<div class="cat-products" id="products-<?php echo $term->term_id; ?>">
				<!-- PRODUCTS -->
				<?php
				$args = array(
					'post_type' => 'products',
					'tax_query' => array(
						array(
							'taxonomy' => 'search_cats',
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
						$tags = wp_get_post_terms( $post->ID, 'attributes');
						$cats = wp_get_post_terms( $post->ID, 'search_cats');
						foreach ($cats as $cat) {
							$classes .= ' cat-' . $cat->term_id;
						}
						?>
						<a href="<?php the_permalink(); ?>?ref=search" class="cat-product <?php echo $classes; ?>">
							<?php
							global $post;
							$featured_id = get_post_thumbnail_id();
							if ($featured_id != null) {
								$img = wp_get_attachment_image( $featured_id, 'width=640&height=346&crop=1' );
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
							</div> <!-- tags -->
							<div class="faux-btn-container small-text-center">
								<div class="faux-button arrow white shadow small">View Product <?php get_template_part('assets/images/right', 'arrow.svg'); ?></div>
							</div>
						</a> <!-- cat-product -->
					<?php }
					wp_reset_postdata();
				}
				?>
			</div> <!-- cat-products -->
		<?php } ?>
		
		<?php get_template_part('template-parts/not','finding'); ?>
		
	</div> <!-- row -->
</section> <!-- product-search -->


<script>
jQuery(document).ready(function(){
var searchClicked = false;
var options = {
    data: [
	    <?php
	    $args = array(
			'post_type' => 'products',
			'posts_per_page' => -1
		);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) { $the_query->the_post();
				echo '{"text": "' . get_the_title() . '", "link": "' . get_the_permalink() . '"},';
			}
			wp_reset_postdata();
		}
		?>
    ],
	list: {
		// Only show matches
		match: {
			enabled: true
		},
		// When an item is selected, store it in the hidden #selectedValue field
		onSelectItemEvent: function() {
			var url = jQuery(".smart-search #product-s").getSelectedItemData().link;
			jQuery(".smart-search #selectedValue").val(url).trigger("change");
		},	
		// When there are no matches, clear out the hidden #selectedValue field
		onHideListEvent: function() {
			jQuery(".smart-search #selectedValue").val('').trigger("change");
			if (!searchClicked) {
				jQuery('#searchsubmit').prop('disabled', false);
			}			
		},
		// When they press enter, check to see if there is a URL in the #selectedValue field and if there is, go to it
		onKeyEnterEvent: function() {
			url = jQuery('.smart-search #selectedValue').val();
			if (url != null) {
				window.location.href = url;
			}			
		}
	},    
    getValue: "text",
    template: {
        type: "links",
        fields: {
            link: "link"
        }
    }
};

jQuery('.ss-form #product-s').easyAutocomplete(options);
});

	// Primary category Click Function
	jQuery("a.cat-icon").on( "click", function(e) {
		e.preventDefault();
		var catID = jQuery(this).data( "cat-id" );
		jQuery('.sub-cat').removeClass('active');
		jQuery('.cat-products').removeClass('active');
		jQuery('.cat-product').removeClass('active');
		jQuery('.sub-cats').addClass('active');
		jQuery('.' + catID).addClass('active');
		jQuery('#products-' + catID).addClass('active');
		jQuery('html, body').animate({ scrollTop: jQuery('.sub-cats').offset().top - 70}, 500);
	});

	// Subcategory Click Function
	jQuery(".subcat").on( "click", function() {
		var subcatID = jQuery(this).attr( "id" );
		jQuery('.cat-product').removeClass('active');
		jQuery('.cat-' + subcatID).addClass('active');
		jQuery('html, body').animate({ scrollTop: jQuery('.sub-cats').offset().top - 70}, 500);
	});
	
</script>

<?php get_footer();