<?php get_header(); ?>
<!-- Message -->
<div style="background:#f1c40f;text-align:center; color: #d35400; padding:3px; margin-bottom:15px;">
	<small>To change edit front-page.php</small>
</div>

<?php get_sidebar('left'); ?>
	<!-- section -->
	<section class="col-md-<?php grid('main'); ?> " role="main">

		<h1><?php the_title(); ?></h1>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php the_content(); ?>

			<?php comments_template( '', true ); // Remove if you don't want comments ?>

			<br class="clear">

			<?php edit_post_link(); ?>

		</article>
		<!-- /article -->

	<?php endwhile; ?>
	<?php else: ?>

		<!-- article -->
		<article>

			<h2><?php _e( 'Sorry, nothing to display.', 'foundation' ); ?></h2>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->

<?php get_sidebar('right'); ?>

<?php get_footer(); ?>