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
				<div class="large-12 columns smart-search">
					<form class="ss-form easy-autocomplete" role="search" id="searchform" onsubmit="return false;">
						<input type="hidden" id="selectedValue">
						<label class="sr-only" for="doc-s">Search</label>
						<input type="text" value="" name="s" id="doc-s" placeholder="<?php esc_attr_e( 'Search...', 'foundationpress' ); ?>">
					</form>


        <article>
        <?php if ( have_posts() ) : ?>

            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
            <?php endwhile; ?>

            <?php else : ?>
                <?php get_template_part( 'template-parts/content', 'none' ); ?>

            <?php endif; // End have_posts() check. ?>

            <?php /* Display navigation to next/previous pages when applicable */ ?>
            <?php if ( function_exists( 'foundationpress_pagination' ) ) { foundationpress_pagination(); } else if ( is_paged() ) { ?>
                <nav id="post-nav">
                    <div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
                    <div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
                </nav>
            <?php } ?>

        </article>
    </div>
</div>

<?php get_footer(); ?>
