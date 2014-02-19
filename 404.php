<?php get_header(); ?>

	<!-- section -->
	<section role="main">

		<!-- article -->
		<article id="post-404">

			<h1><?php _e( 'Page not found', 'foundation' ); ?></h1>
			<p class="center">
				<object type="image/svg+xml" data="<?php bloginfo('template_url'); ?>/img/error-404.svg" width="250" height="160">
				    <img src="<?php bloginfo('template_url'); ?>/img/error-404.png" alt="Erreur 404">
				</object>
			</p>			
			<h2>
				<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'foundation' ); ?></a>
			</h2>

		</article>
		<!-- /article -->

	</section>
	<!-- /section -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>