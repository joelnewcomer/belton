<?php
/*
Template Name: Product Guide
*/
get_header(); ?>

<section class="short-header text-center with-breadcrumb">
	<div class="row">
		<div class="large-12 columns">
			<p class="breadcrumb back"><?php get_template_part('assets/images/right', 'arrow.svg'); ?> Back to Product Search</p>
			<h1 class="entry-header">Product Guide</h1>
		</div> <!-- columns -->
	</div> <!-- row -->
</section> <!-- short-header -->

<div class="row">
	<?php get_template_part('template-parts/product','guide'); ?>
	<?php get_template_part('template-parts/not','finding'); ?>
</div>

<?php get_footer();