<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">

		<?php wp_head(); ?>

		<!--[if lt IE 9]>
			<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
			<script src="//html5base.googlecode.com/svn-history/r38/trunk/js/selectivizr-1.0.3b.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
			<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/grid_ie.css">
		<![endif]-->

		<script>
			// conditionizr.com
			// conditionizr.config({
			// 	assets: '<?php echo get_template_directory_uri(); ?>',
			// 	tests: {}
			// });
		</script>

	</head>
	<body <?php body_class('antialiased'); ?>>
		<div class="container">
			<div class="row">
				<header id="bdimage" >
					<?php if ( !get_header_image() ) : ?>
						<?php if (is_single() || is_page()): ?>
							<p class="h1"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></p>
							<p><?php bloginfo('description'); ?></p>
						<?php else : ?>
							<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
							<p><?php bloginfo('description'); ?></p>
						<?php endif; ?>
					<?php else: ?>
						<img width="100%" src="<?php header_image(); ?>" />
					<?php endif; ?>
				</header>
				<nav class="top-bar" data-topbar>
					<?php header_nav(); ?>
				</nav>
			</div>
			<div class="row">