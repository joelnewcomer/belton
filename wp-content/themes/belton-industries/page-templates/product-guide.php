<?php
/*
Template Name: Product Guide
*/
get_header(); ?>

<section class="short-header text-center with-breadcrumb">
	<h1 class="entry-header">Product Guide</h1>
</section>

<div class="row">
	<?php get_template_part('template-parts/product','guide'); ?>
	<?php get_template_part('template-parts/not','finding'); ?>
</div>

<?php get_footer();