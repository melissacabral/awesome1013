<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
	if( have_posts() ): ?>
		<?php 
		while( have_posts() ): 
			the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> >
			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>

			<?php the_post_thumbnail( 'large', array( 'class' => 'product-image alignright' ) ); ?>

			<div class="entry-content">
				<?php //show Price custom field
				$price = get_post_meta( $post->ID, 'price', true );
				if($price):
					echo 'Price: $' . $price . '<br />';
				endif;
				 ?>

				 <?php //show Size custom field
				$size = get_post_meta( $post->ID, 'size', true );
				if($size):
					echo 'Size: ' . $size . '<br />';
				endif;
				 ?>

		<?php the_terms( $post->ID, 'brand', '<p>Brand: ', ', ', '</p>' ); ?>
		<?php the_terms( $post->ID, 'feature', '<p>Features: ', ', ', '</p>' ); ?>


				<?php 
				//if viewing a singular post or page, show the full content, otherwise, just an excerpt
				if( is_single() || is_page() ):
					the_content();
				else:
					the_excerpt();
				endif; ?>
			</div>
			
		
	
		</article><!-- end post -->
		<?php endwhile; ?>

		<div class="pagination">
			<?php previous_post_link('%link', '&larr; %title'); // older post ?>
			<?php next_post_link('%link', '%title &rarr;'); // newer post ?>
		</div>
	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar('shop'); //include sidebar.php ?>
<?php get_footer(); //include footer.php ?>