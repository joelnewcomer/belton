<?php
/*
Template Name: Product Guide
*/
get_header(); ?>


<section class="short-header text-center">
	<div class="row">
		<div class="large-12 columns">
			<h1 class="entry-header">Product Guide</h1>
		</div>
	</div>
</section>

<?php $results = get_terms('guide_cats', array ( 'parent' => 0  )); ?>

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
			</div> <!-- shadow-container-inner -->
		</div> <!-- shadow-container -->
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
	
</script>


<!-- <section class="short-header text-center with-breadcrumb">
	<div class="row">
		<div class="large-12 columns">
			<p class="breadcrumb back"><a href="<?php echo get_site_url(); ?>/product-search"><?php get_template_part('assets/images/right', 'arrow.svg'); ?> Back to Product Search</a></p>
			<h1 class="entry-header">Product Guide</h1>
		</div> <!-- columns -->
	<!-- </div> <!-- row -->
<!-- </section> <!-- short-header -->

<div class="row">
	<?php get_template_part('template-parts/product','guide'); ?>
	<?php get_template_part('template-parts/not','finding'); ?>
</div>

<?php get_footer();