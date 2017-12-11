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
						<label class="sr-only" for="doc-s">Search</label>
						<input type="text" value="" name="s" id="doc-s" placeholder="<?php esc_attr_e( 'Search...', 'foundationpress' ); ?>">
					</form>
					<div class="doc-filters text-center">
						<?php get_template_part('assets/images/filter', 'icon.svg'); ?> Filters 
						<?php
						$terms = get_terms('guide_cats', array ( 'parent' => 0, 'hide_empty' => false  ));	
						echo "<select name='cat-select' id='cat-select'>";
						echo "<option value=''>Market</option>";
						foreach ($terms as $term) {
							$value = $term->term_id;
							$children = '';
							$child_terms = get_terms('guide_cats', array ( 'parent' => $term->term_id, 'hide_empty' => false  ));
							foreach ($child_terms as $child_term) {
								$children .= ' ' . $child_term->term_id;
							}
							$children = trim($children);
						    echo '<option value="' . $term->term_id . '" data-children="' . $children . '">' . $term->name . '</option>'; 
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

		
			<?php
			$args = array(
				'posts_per_page' => -1,
				'post_type' => 'products',
				'no_found_rows' => true
			);
			$the_query = new WP_Query( $args ); ?>
			
			<div class="doc-results text-center">
				<span class="count"></span> Result<span class="plural"></span>
			</div>

			<div class="tech-docs">
			
			<?php if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
					<?php
					$classes = '';
					$tags = wp_get_post_terms( $post->ID, 'attributes');
					$cats = wp_get_post_terms( $post->ID, 'guide_cats');
					foreach ($cats as $cat) {
						$classes .= ' cat-' . $cat->term_id;
					}
					$file = get_field('product_data_sheet');
					$date_modified = date(get_option( 'date_format' ),strtotime($file['modified']));
					?>
					<?php if ($file != '') : ?>
					<a href="<?php echo $file['url']; ?>" class="tech-doc <?php echo $classes; ?>">
						<!-- <pre>
						<?php print_r($file); ?>
						</pre> -->
						<?php get_template_part('assets/images/doc', 'icon.svg'); ?><h3><?php echo $file['title']; ?></h3>
						<div class="doc-date"><?php echo $date_modified; ?></div>
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
					<?php endif; ?>
				<?php }
				wp_reset_postdata();
			}
			?>
			<script>
				jQuery( document ).ready(function() {
					resetResults();
				});
			</script>
		</div> <!-- tech-docs -->

			</div> <!-- shadow-container-inner -->
		</div> <!-- shadow-container -->

		<?php get_template_part('template-parts/not','finding'); ?>
		
	</div> <!-- row -->
</section> <!-- product-search -->

<script>
// Update Results Count
function resetResults() {
	var resultsCount = jQuery(".tech-doc:visible").length;
	jQuery(".doc-results span.count").html(jQuery(".tech-doc:visible").length);
	if (resultsCount == 1) {
		jQuery(".doc-results span.plural").html('');
	} else {
		jQuery(".doc-results span.plural").html('s');
	}
}

// Reset Filters
function resetFilters() {
	jQuery('.select-app').prop('selectedIndex',0);
	jQuery('#cat-select').prop('selectedIndex',0);
	jQuery('.tech-doc').show();	
	jQuery('.select-app').fadeOut();
}

// Markets
jQuery('#cat-select').on('change', function() {
	// Reset Documents
	jQuery('.tech-doc').fadeOut();	
	jQuery('.select-app').fadeOut();
	// Reset Applications
	jQuery('.select-app').prop('selectedIndex',0);
	jQuery('#doc-s').val('');
	var catID = this.value;
	if (catID != "") {
		// Display products that are in children of this category
		var children = jQuery(this).children('option:selected').data('children');
		jQuery(this).addClass('active');
    	var childrenArray = children.split(" ");
    	for (var i = 0; i < childrenArray.length; i++) {
    		jQuery('.cat-' + childrenArray[i]).css('display', 'inline-block').hide().fadeIn( "fast" );
		}
	} else {
		jQuery('.tech-doc').fadeIn();	
		jQuery(this).removeClass('active');
	}
	jQuery(".select-app").promise().done(function() {
    	jQuery('select#cat-' + catID).css('display', 'inline-block').hide().fadeIn( "fast", function() {
			resetResults();
  		});
	});
	jQuery('.tech-doc').promise().done(function() {
		resetResults();
	});
});

// Applications
jQuery('.select-app').on('change', function(e) {
	jQuery('#doc-s').val('');
	var catID = this.value;
	if (catID == '') {
		jQuery(this).removeClass('active');
		jQuery('.tech-doc').fadeOut();
		// If no application is selected then get selected market and show all products in its subcategories
		jQuery('.tech-doc').promise().done(function() {
			var children = jQuery('#cat-select').children('option:selected').data('children');
    		var childrenArray = children.split(" ");
			for (var i = 0; i < childrenArray.length; i++) {
    			jQuery('.cat-' + childrenArray[i]).css('display', 'inline-block').hide().fadeIn( "fast", function() {
					resetResults();
  				});
			}		
		});
		resetResults();
	} else {
		jQuery(this).addClass('active');
		jQuery('.tech-doc').fadeOut();
		jQuery('.tech-doc').promise().done(function() {
    		jQuery('.cat-' + catID).css('display', 'inline-block').hide().fadeIn( "fast", function() {
				resetResults();
  			});
  			resetResults();
		});
	}
});

function preg_quote( str ) {
    // http://kevin.vanzonneveld.net
    // +   original by: booeyOH
    // +   improved by: Ates Goral (http://magnetiq.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Onno Marsman
    // *     example 1: preg_quote("$40");
    // *     returns 1: '\$40'
    // *     example 2: preg_quote("*RRRING* Hello?");
    // *     returns 2: '\*RRRING\* Hello\?'
    // *     example 3: preg_quote("\\.+*?[^]$(){}=!<>|:");
    // *     returns 3: '\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:'

    return (str+'').replace(/([\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:])/g, "\\$1");
}	

jQuery(document).ready(function(){
    jQuery('#doc-s').keyup(function(){
	    resetFilters();
        page = jQuery('.tech-docs').text().toLowerCase();
        searchedText = jQuery('#doc-s').val();
        if (page.indexOf(searchedText.toLowerCase()) >= 0) {
            jQuery( ".tech-doc" ).each(function( index ) {
	            var $this = jQuery(this);
				var $items = $this.find("h3, span.tag");
				var found = false;
                jQuery( $items ).each(function( index ) {
                	thisText = jQuery(this).html();
                	var find = '<span class="hl">';
                	thisText = thisText.replace(new RegExp(find, 'g'), '');
                	var find = '</span><!--hl-->';
                	thisText = thisText.replace(new RegExp(find, 'g'), '');                
                	thisText = thisText.replace( new RegExp( "(" + preg_quote( searchedText ) + ")" , 'gi' ), '<span class="hl">$1</span><!--hl-->' );
                	jQuery(this).html(thisText);
                	if (searchedText.length > 2 && thisText.toLowerCase().indexOf(searchedText.toLowerCase()) >= 0) {
	                	found = true;
	                }
                });
                if (found) {
                	jQuery(this).addClass('active');
                } else {
	            	jQuery(this).removeClass('active'); 
                }           
            });
        }
 		// Hide docs that don't match
 		jQuery('.tech-doc:not(.active)').fadeOut( "fast", function() {
			resetResults();
  		});       
        
        // If there are no matches, show all documents
        if (jQuery(".tech-doc.active").length < 1) {
			jQuery('.tech-doc').fadeIn( "fast", function() {
				resetResults();
  			});			            
        }        
    });
});
</script>

<?php get_footer();