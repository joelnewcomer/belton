<?php
/**
 * The template for displaying search results pages.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<section class="short-header text-center with-breadcrumb">
	<div class="row">
		<div class="large-12 columns">
			<h1 class="entry-header"><?php _e( 'Search Results for', 'foundationpress' ); ?> "<?php echo get_search_query(); ?>"</h1>
		</div> <!-- columns -->
	</div> <!-- row -->
</section> <!-- short-header -->

<section class="header-margin product-search">
	<div class="row">
		<div class="shadow-container">
			<div class="shadow-container-inner">

				<div class="small-12 large-12 columns" role="main">
				
					<?php do_action( 'foundationpress_before_content' ); ?>
				
				<?php if ( have_posts() ) : ?>
				
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
					<?php endwhile; ?>
				
					<?php else : ?>
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
				
				<?php endif;?>
				
				<?php do_action( 'foundationpress_before_pagination' ); ?>
				
				<?php if ( function_exists( 'foundationpress_pagination' ) ) { foundationpress_pagination(); } else if ( is_paged() ) { ?>
				
					<nav id="post-nav">
						<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
						<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
					</nav>
				<?php } ?>
				
				<?php do_action( 'foundationpress_after_content' ); ?>
				</div>

			</div>
		</div>
	</div>
</section> 

<?php get_footer(); ?>