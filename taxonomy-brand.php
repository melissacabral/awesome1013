<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
	if( have_posts() ): ?>

	<h2 class="archive-title">All Products by <?php single_cat_title(); ?></h2>

		<?php 
		while( have_posts() ): 
			the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> >
			
			<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'thumb' ) ); ?>


			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>			

			<div class="entry-content">
				<?php the_terms( $post->ID, 'brand', '<p>', ', ', '</p>' ); ?>

				<?php 
				//if viewing a singular post or page, show the full content, otherwise, just an excerpt
				if( is_single() || is_page() ):
					the_content();
				else:
					the_excerpt();
				endif; ?>

				<?php 
				//grab the price custom field, then check to confirm it exists before displaying it in a cute price tag thing
				$price = get_post_meta( $post->ID, 'price', true );
				if( $price ): ?>
					<span class="product-price">
					$<?php echo $price; ?>
					</span>
				<?php 
				endif; ?>			

			</div><!-- end entry-content -->
		</article><!-- end post -->

		<?php endwhile; ?>
		
		<div class="pagination">

			<?php 
			//check to see if the pagenavi plugin exists and is active
			if( function_exists('wp_pagenavi') ):
				wp_pagenavi();
			else: ?>

				<?php next_posts_link('&larr; Older Posts'); ?>
				<?php previous_posts_link('Newer Posts &rarr;'); ?>

			<?php 
			endif; //pagenavi
			?>
		</div>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar('shop'); //include sidebar-shop.php ?>
<?php get_footer(); //include footer.php ?>