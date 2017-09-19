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
	
	<section class="custom">
		
	</section>
	
	<?php get_template_part('template-parts/product','guide'); ?>

</div> <!-- row -->

<?php endwhile;?>
<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer(); ?>