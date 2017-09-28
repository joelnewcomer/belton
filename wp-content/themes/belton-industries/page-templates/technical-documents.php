<?php
/*
Template Name: Technical Documents
*/
get_header(); ?>

<section class="short-header text-center with-breadcrumb">
	<div class="row">
		<div class="large-12 columns">
			<h1 class="entry-header">Technical Documents</h1>
		</div> <!-- columns -->
	</div> <!-- row -->
</section> <!-- short-header -->

<section class="header-margin product-search">
	<div class="row">
		<div class="shadow-container">
			<div class="shadow-container-inner">
				<div class="large-12 columns smart-search">
					<form class="ss-form easy-autocomplete" role="search" id="searchform" onsubmit="return false;">
						<input type="hidden" id="selectedValue">
						<label class="sr-only" for="product-s">Search</label>
						<input type="text" value="" name="s" id="product-s" placeholder="<?php esc_attr_e( 'Search...', 'foundationpress' ); ?>">
					</form>
					<div class="doc-filters text-center">
						<?php get_template_part('assets/images/filter', 'icon.svg'); ?> Filters 
						<?php
						$terms = get_terms('guide_cats', array ( 'parent' => 0, 'hide_empty' => false  ));	
						echo "<select name='cat-select' id='cat-select'>";
						echo "<option value=''>Market</option>";
						foreach ($terms as $term) { 
						    echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; 
						}
						echo "</select>";
						foreach ($terms as $term) {
							$subcats = get_terms('guide_cats', array ( 'parent' => $term->term_id, 'hide_empty' => false  ));
							echo "<select class='select-app' name='cat-$term->term_id' id='cat-$term->term_id'>";
							echo "<option value=''>Application</option>";
							foreach ($subcats as $subcat) {
								echo '<option value="' . $subcat->term_id . '">' . $subcat->name . '</option>'; 
							}
							echo "</select>";
						}
						?>
					</div> <!-- doc-filters
				</div> <!-- smart-search -->

		<div class="tech-docs">
			<?php
			$args = array(
				'posts_per_page' => -1,
				'post_type' => 'docs',
			);
			$the_query = new WP_Query( $args ); ?>
			
			<div class="doc-results text-center">
				<span class="count"><?php echo $the_query->post_count; ?></span> Result<span class="plural"><?php if ($the_query->post_count != 1) { echo 's'; } ?></span>
			</div>
			
			
			<?php if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
					<?php
					$classes = '';
					$tags = wp_get_post_terms( $post->ID, 'attributes');
					$cats = wp_get_post_terms( $post->ID, 'guide_cats');
					foreach ($cats as $cat) {
						$classes .= ' cat-' . $cat->term_id;
					}
					?>
					<a href="<?php echo get_field('file'); ?>" class="tech-doc <?php echo $classes; ?>">
						<?php get_template_part('assets/images/doc', 'icon.svg'); ?><h3><?php the_title(); ?></h3>
						<div class="doc-date"><?php echo get_the_date(); ?></div>
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
					</a> <!-- cat-product -->
				<?php }
				wp_reset_postdata();
			}
			?>
		</div> <!-- tech-docs -->

			</div> <!-- shadow-container-inner -->
		</div> <!-- shadow-container -->

		<?php get_template_part('template-parts/not','finding'); ?>
		
	</div> <!-- row -->
</section> <!-- product-search -->

<script>
function resetResults() {
	var resultsCount = jQuery(".tech-doc:visible").length;
	jQuery(".doc-results span.count").html(jQuery(".tech-doc:visible").length);
	if (resultsCount == 1) {
		jQuery(".doc-results span.plural").html('');
	} else {
		jQuery(".doc-results span.plural").html('s');
	}
}	

// Markets
jQuery('#cat-select').on('change', function() {
	var catID = this.value;
	// Reset Applications
	jQuery('.select-app').prop('selectedIndex',0);
	// Reset Documents
	jQuery('.tech-doc').fadeIn();
	jQuery('.select-app').fadeOut();
	jQuery(".select-app").promise().done(function() {
    	jQuery('select#cat-' + catID).css('display', 'inline-block').hide().fadeIn( "fast", function() {
			resetResults();
  		});
	});
});

// Applications
jQuery('.select-app').on('change', function(e) {
	var catID = this.value;
	if (catID == '') {
		jQuery('.tech-doc').fadeIn();
		resetResults();
	} else {
		jQuery('.tech-doc').fadeOut();
		jQuery('.tech-doc').promise().done(function() {
    		jQuery('.cat-' + catID).css('display', 'inline-block').hide().fadeIn( "fast", function() {
				resetResults();
  			});
		});
	}
})	
</script>

<?php get_footer();