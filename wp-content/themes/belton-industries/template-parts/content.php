<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>" <?php post_class('blogpost-entry entry-content sr'); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="featured-image">
			<?php the_post_thumbnail( array( 'width' => 268, 'height' => 164, 'crop' => true )); ?>
		</div>
	<?php endif; ?>
	<div class="content-container">
		<header>
			<h2><?php the_title(); ?></h2>
			<?php drum_entry_meta(); ?><br />
		</header>
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div>
	</div>
</a>
