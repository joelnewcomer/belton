<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div id="single-post" role="main">
	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class(array('main-content')) ?> id="post-<?php the_ID(); ?>">
			<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
			<div class="entry-content row">
				<section class="breadcrumbs">
						<div class="large-12 columns">
							<?php
							if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('<p id="breadcrumbs">','</p>');
							}
							?>
						</div>
				</section>				
				<?php if ( post_password_required() ) : ?>
					<div class="row password-protected-row">
						<div class="large-12 columns">
							<?php echo get_the_password_form(); ?>
						</div>
					</div>
				<?php else : ?>
					<section class="default-background">
						<div class="large-12 columns">
			     	   		<?php the_content(); ?>
						</div>
					</section>
				<?php endif; ?>
			</div> <!-- entry-content -->
		</article>
	<?php endwhile;?>
	<?php do_action( 'foundationpress_after_content' ); ?>
</div> <!-- #single-post -->
<?php get_footer(); ?>