<?php if(get_field('social_networks', 'option')): ?>
	<span class="social">
	<?php while(has_sub_field('social_networks', 'option')): ?>
		<?php
		$social_url = get_sub_field('url');
		$social = get_sub_field('social_network');
		echo '<a href="' . $social_url . '" class="' . $social . '" target="_blank">';
		get_template_part('assets/images/social/' . $social , 'official.svg');
		echo '</a>';
		?>
	<?php endwhile; ?>
	</span>
<?php endif; ?>