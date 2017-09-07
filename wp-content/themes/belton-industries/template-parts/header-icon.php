<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
	<?php if ( get_theme_mod( 'drum_logo' ) ) : ?>
	    <?php $img_src = get_theme_mod( 'drum_logo' ); ?>
	    <?php if (strpos($img_src, '.svg') !== false) : ?>
			<?php 
			$logo = str_replace( site_url() . '/', '', $img_src);
			echo file_get_contents(site_url . '/' . $logo);
			?>
		<?php else : ?> 
	   		<img src="<?php echo $img_src; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> Logo">
	   	<?php endif; ?>	    
	<?php else : ?>
	   	<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo@2x.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> Logo"/>
	<?php endif; ?>
</a>