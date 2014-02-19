<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<!-- post thumbnail -->
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
			</a>
		<?php endif; ?>
		<!-- /post thumbnail -->
		
		<!-- post title -->
		<h2>
			<a class="entry-format audio" href="<?php echo esc_url( get_post_format_link( 'audio' ) ); ?>">
				<span><?php echo get_post_format_string( 'audio' ); ?></span>
			</a> 
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h2>
		<!-- /post title -->
		
		<!-- post details -->
		<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
		<span class="author"><?php _e( 'Published by', 'foundation' ); ?> <?php the_author_posts_link(); ?></span>
		<span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'foundation' ), __( '1 Comment', 'foundation' ), __( '% Comments', 'foundation' )); ?></span>
		<!-- /post details -->
		
		<?php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'foundation' ) );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'foundation' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>

		<?php edit_post_link(); ?>
		
	</article>
<!-- /article -->