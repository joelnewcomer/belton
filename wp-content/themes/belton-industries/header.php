<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>
<!doctype html>

<script>
	var logoURL = '<?php echo get_template_directory_uri();  ?>/assets/images/belton-logo.svg'; 
</script>

<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- Icons for Apple Devices -->
		<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/touch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/touch-icon-ipad-retina.png">


		<script src="https://use.typekit.net/kst4dbu.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>

		<?php wp_head(); ?>

		<!-- Polyfills to make various versions of IE play nicer -->
		<script>
			jQuery( document ).ready(function() {
				conditionizr.polyfill('<?php echo get_template_directory_uri(); ?>/assets/javascript/polyfills/respond.min.js', ['ie7', 'ie8']);
				conditionizr.polyfill('<?php echo get_template_directory_uri(); ?>/assets/javascript/polyfills/nwmatcher-1.3.4.min.js', ['ie7', 'ie8']);
				conditionizr.polyfill('<?php echo get_template_directory_uri(); ?>/assets/javascript/polyfills/selectivizr-min.js', ['ie7', 'ie8']);
				conditionizr.polyfill('<?php echo get_template_directory_uri(); ?>/assets/javascript/polyfills/html5shiv.min.js', ['ie7', 'ie8', 'ie9']);
				conditionizr.polyfill('<?php echo get_template_directory_uri(); ?>/assets/javascript/polyfills/css3-multi-column.min.js', ['ie7', 'ie8', 'ie9']);
				conditionizr.polyfill('<?php echo get_template_directory_uri(); ?>/assets/javascript/polyfills/flexibility.js', ['ie8', 'ie9']);
				conditionizr.config({
					tests: {
						'ie7': ['class'],
						'ie8': ['class'],
						'ie9': ['class'],
					}
				});
			})
		</script>

	</head>
	<body <?php body_class(); ?>>
	<?php do_action( 'foundationpress_after_body' ); ?>
	<?php do_action( 'foundationpress_layout_start' ); ?>

	<?php if(!preg_match('/(?i)msie [5-9]/',$_SERVER['HTTP_USER_AGENT'])) : ?>
		<div class="animsition">
	<?php endif; ?>	

		<div class="pre-header">
			<div class="row">
				<div class="large-12 columns">
					<div class="ph-left hide-for-small">
						<?php echo get_field('toll_free_number','option'); ?> &nbsp; | &nbsp; <a href="<?php echo get_field('contact_us_page', 'option'); ?>">Email Us</a>
					</div>
					<div class="ph-right text-right hide-for-small">
						<a href="<?php echo get_site_url(); ?>/technical-documents">Technical Documents</a>
					</div>
				</div>
			</div> 
		</div> <!-- pre-header -->

	<div class="header-wrapper match-header">		
	<header id="masthead" class="site-header match-header" role="banner">
		<nav id="site-navigation" class="main-navigation top-bar row" role="navigation">
			<div class="top-bar-left">
				<?php get_template_part('template-parts/header-icon'); ?>
			</div> <!-- top-bar-left -->
			<div class="top-bar-right text-right">
				<a id="products-icon" class="transition hide-for-small" href="<?php echo get_site_url(); ?>/product-search"><?php get_template_part('assets/images/products', 'icon.svg'); ?>Products</a>
				<div id="menu-icon" class="transition"><?php get_template_part('assets/images/menu', 'icon.svg'); ?><div class="close-menu transition">&times;</div>Menu</div>
				<?php foundationpress_main_menu(); ?>
				<script>
					jQuery("#menu-icon").on( "click", function() {
						jQuery('#menu-main-menu').toggleClass('active');
						jQuery(this).toggleClass('active');
					});	
				</script>
			</div> <!-- top-bar-right -->
		</nav> <!-- #site-navigation -->
	</header> <!-- #masthead -->
	</div> <!-- header-wrapper -->

	<?php do_action( 'foundationpress_after_header' ); ?>

	<section class="container">