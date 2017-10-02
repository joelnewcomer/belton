<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */
get_header(); ?>

<section class="short-header text-center with-breadcrumb">
	<div class="row">
		<div class="large-12 columns">
			<h1 class="entry-header">News and Events</h1>
		</div> <!-- columns -->
	</div> <!-- row -->
</section> <!-- short-header -->


<section class="header-margin product-search">
	<div class="row">
		<div class="shadow-container">
			<div class="shadow-container-inner">
				<div class="large-12 columns">
					<form class="easy-autocomplete blog-search" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
					    <!-- limit search to products post type -->
					    <input type="hidden" name="post_type" value="products" />
					    <input type="text" placeholder="Search and hit Enter" name="s" id="s" />
					    <!-- <input type="submit" id="searchsubmit" class="button fa" value="&#61442;" /> -->
					</form>
				</div> <!-- columns -->
			</div> <!-- shadow-container-inner -->
			<div class="shadow-fade"></div>
			
			<div class="large-12 columns">
				<article>
				
				    <?php echo do_shortcode('[ajax_load_more post_type="post" scroll="false" repeater="default" posts_per_page="10" transition="fade" button_label="Load More"]'); ?>
				
				</article>
			</div> <!-- columns -->
		</div> <!-- shadow-container -->
	</div> <!-- row -->
</section>

<?php get_footer(); ?>
