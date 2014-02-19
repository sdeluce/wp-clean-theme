<?php get_header(); ?>

<?php get_sidebar('left'); ?>
	<!-- section -->
	<section class="col-md-<?php grid('main'); ?> " role="main">

		<h1><?php _e( 'Latest Posts', 'foundation' ); ?></h1>

		<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the post format-specific template for the content. If you want to
				 * use this in a child theme, then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;
		?>


		<?php get_template_part('pagination'); ?>

	</section>
	<!-- /section -->

<?php get_sidebar('right'); ?>

<?php get_footer(); ?>