<?php
/**
 * Entry meta information for posts
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

if ( ! function_exists( 'foundationpress_entry_meta' ) ) :
	function drum_entry_meta() {
		global $post;
		echo '<ul class="post-meta group">';
			echo '<li>';
			echo '<time class="updated" datetime="'. get_the_time( 'c' ) .'">'. sprintf( __( '%s', 'foundationpress' ), get_the_date() ) .'</time></li>'; ?>
		</ul> <!-- post-meta -->
	<?php }
endif; ?>
