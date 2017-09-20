<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

<section class="cta">
	<div class="row">
		<div class="large-12 columns text-center">
			<?php if (!is_front_page()) : ?>
				<h3>Call Us: <?php echo drum_smart_phone(get_field('toll_free_number','option')); ?> Because Belton Makes Business Easy</h3>
			<?php endif; ?>
			
			<div class="hide-for-small">
				<?php
				$query = new WP_Query(
				    array( 'orderby' => 'date', 'posts_per_page' => '1')
				);
				while($query->have_posts()) : $query->the_post(); ?>
				    <a class="footer-blog-block" href="<?php echo get_permalink(); ?>">
				        <?php the_post_thumbnail( array( 'width' => 216, 'height' => 138, 'crop' => true ) ) ?>
					    <h3><?php the_title(); ?></h3>
				        <?php the_excerpt(); ?>
				    </a>
				<?php endwhile;
				wp_reset_query();
				?>
				
				<div class="button white shadow arrow"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">More Recent News <?php get_template_part('assets/images/right', 'arrow.svg'); ?><br /> </a></div>
			</div> <!-- hide-for-small -->
			<div class="show-for-small">
				<div class="button white shadow arrow"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">News and Events <?php get_template_part('assets/images/right', 'arrow.svg'); ?><br /> </a></div>
			</div>
		</div>
	</div>
</section>
	
		</section>
				
		<div id="footer-container">
			<div class="assoc-logos">
				<div class="row">
					<div class="large-12 columns text-center">
						<?php if(get_field('association_logos','option')): ?>
							<?php while(has_sub_field('association_logos','option')): ?>
								<div class="assoc-logo">
									<div style="display:table;width:100%;height:100%;">
									  <div style="display:table-cell;vertical-align:middle;">
									    <div style="text-align:center;"><?php echo wp_get_attachment_image( get_sub_field('logo'), 'width=129&height=37&crop=0' ); ?></div>
									  </div>
									</div>
								</div>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<footer id="footer" class="row">
				<div class="large-12 medium-12 columns address-phone">
					<?php // get_template_part('assets/images/footer', 'logo.svg'); ?>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer-logo.png" alt="Belton Industries logo">
					<div class="address">
						<p>
						<?php // function drum_smart_phone($phone, $phone_text, $phone_prefix)
						echo '<span class="toll-free">' . get_field('toll_free_number','option'); ?></span><br />
						<?php echo '<span class="phone">' . get_field('local_number','option'); ?></span><br />
						<?php // function drum_smart_address($address_array) array generated by ACF address field
						echo drum_smart_address(get_field('address_street','option'),'',get_field('address_city','option'),get_field('address_state','option'),get_field('address_zip','option')); ?>
						<?php get_template_part('template-parts/social'); ?>
						</p>
					</div> <!-- address -->
					<div class="footer-menu hide-for-small">
						<?php foundationpress_main_menu(); ?>
					</div>
				</div>
			</footer>
			<div class="sub-footer">
				<div class="row">
					<div class="large-6 medium-6 columns copyright small-text-center">
						<p>&copy;<?php echo date('Y'); ?> <?php bloginfo('name'); ?>.  <span class="no-break"><?php _e( 'All rights reserved.', 'textdomain' ); ?></span> &nbsp; | &nbsp; <a href="<?php echo get_field('terms_page', 'option'); ?>">Terms</a></p>
					</div>
					<div class="large-6 medium-6 columns drum hide-on-print text-right small-text-center">
						<p><a href="http://www.drumcreative.com" target="_blank"><?php _e( 'Website Design by: Drum Creative', 'textdomain' ); ?></a></p>
					</div>					
				</div>
			</div>
		</div> <!-- footer-container -->

	<?php if(!preg_match('/(?i)msie [5-9]/',$_SERVER['HTTP_USER_AGENT'])) : ?>
		</div> <!-- animsition -->
	<?php endif; ?>	

		<a class="cd-top"><?php _e( 'Top', 'textdomain' ); ?></a>

		<?php do_action( 'foundationpress_layout_end' ); ?>

<?php wp_footer(); ?>

<?php do_action( 'foundationpress_before_closing_body' ); ?>
</body>
</html>