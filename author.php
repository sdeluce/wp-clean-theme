<?php get_header(); ?>

	<!-- section -->
	<section role="main">
	
	<?php if (have_posts()): the_post(); ?>
	
		<h1><?php _e( 'Author Archives for ', 'foundation' ); echo get_the_author(); ?></h1>

	<?php if ( get_the_author_meta('description')) : ?>
	
	<?php echo get_avatar(get_the_author_meta('user_email')); ?>
	
		<h2><?php _e( 'About ', 'foundation' ); echo get_the_author() ; ?></h2>
	
		<?php echo wpautop( get_the_author_meta('description') ); ?>
	
	<?php endif; ?>
	
	<?php rewind_posts(); while (have_posts()) : the_post(); ?>
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
				</a>
			<?php endif; ?>
			<!-- /post thumbnail -->
			
			<!-- post title -->
			<h2>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>
			<!-- /Post title -->
			
			<!-- post details -->
			<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
			<span class="author"><?php _e( 'Published by', 'foundation' ); ?> <?php the_author_posts_link(); ?></span>
			<span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'foundation' ), __( '1 Comment', 'foundation' ), __( '% Comments', 'foundation' )); ?></span>
			<!-- /post details -->
			
			<?php 
		//	Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the post format-specific template for the content. If you want to
				 * use this in a child theme, then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;
		?>
			
			<br class="clear">
			
			<i class="gen-enclosed foundicon-edit"><?php edit_post_link(); ?></i>
			
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
		
		<?php get_template_part('pagination'); ?>
	
	</section>
	<!-- /section -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>
