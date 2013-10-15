<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
	if( have_posts() ): ?>
		<?php 
		while( have_posts() ): 
			the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> >
			
			<?php the_post_thumbnail( 'home-banner' ); ?>

			<h2 class="home-quote">
				<?php the_title(); ?> 
			</h2>		

			<div class="entry-content">
				<?php the_content(); ?>
			</div>
					
		</article><!-- end post -->
		<?php endwhile; ?>
	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<section id="featured-content" class="clearfix">
	<?php dynamic_sidebar('home-area-1'); ?>	
</section>

<?php get_sidebar('frontpage'); //include sidebar-frontpage.php ?>
<?php get_footer(); //include footer.php ?>