		<div class="not-finding sr" style="background-image: url(<?php echo get_field('contact_bg','option'); ?>);">
			<div class="large-6 medium-6 columns not-finding-left text-center">
				<div class="nf-inner">
					<h2>Not finding the perfect solution?</h2>
					<p>We also provide flexible custom solutions for both small and large applications.</p>
					<div class="button green arrow small"><a href="<?php echo get_field('contact_us_page', 'option'); ?>">Let Us Design it for You<?php get_template_part('assets/images/right', 'arrow.svg'); ?></a></div>
				</div>
			</div>
			<div class="large-6 medium-6 columns not-finding-right text-center no-padding" style="background-image: url(<?php echo get_field('contact_bg','option'); ?>);">
				<div class="nf-inner">
					<h2>Contact Us to Get Started Today!</h2>
					
					<?php					
					// Get contact information - check to see if product has contact info, then category, then parent category, then site-wide default.
					// PRODUCT CONTACT
					$name = get_field('contact_full_name');
					$phone = get_field('contact_phone');
					$email = get_field('contact_email');					
					
					if ($name == '') {
						// CATEGORY CONTACT
						$cats = wp_get_post_terms( $post->ID, 'guide_cats');
						$cat = $cats[0]->term_id;
						$field_id = 'guide_cats_' . $cat;
						$name = get_field('contact_full_name', $field_id);
						$phone = get_field('contact_phone', $field_id);
						$email = get_field('contact_email', $field_id);
						
						if ($name == '') {
							// PARENT CATEGORY CONTACT
							$parent_cat = $cats[0]->parent;
							$field_id = 'guide_cats_' . $parent_cat;
							$name = get_field('contact_full_name', $field_id);
							$phone = get_field('contact_phone', $field_id);
							$email = get_field('contact_email', $field_id);
							
							// SITEWIDE DEFAULT CONTACT
							if ($name == '') {
								$name = get_field('contact_name','option');
								$phone = get_field('contact_phone','option');
								$email = get_field('contact_email','option');
							}
						}
					}
					?>
					
					<p class="side-rule">
						<span><?php echo $name; ?></span><br />
						<?php echo $phone; ?><br />
						<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
					</p>
				</div>
			</div>
		</div> <!-- not-finding -->