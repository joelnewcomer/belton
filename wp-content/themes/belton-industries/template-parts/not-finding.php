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
					<p class="side-rule">
						<span><?php echo get_field('contact_name','option'); ?></span><br />
						<?php echo get_field('contact_phone','option'); ?><br />
						<a href="mailto:<?php echo get_field('contact_email','option'); ?>"><?php echo get_field('contact_email','option'); ?></a>
					</p>
				</div>
			</div>
		</div> <!-- not-finding -->