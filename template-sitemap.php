<?php 
/*
Template Name: Automagic Sitemap
*/ 
?>
<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
	if( have_posts() ): ?>
		<?php 
		while( have_posts() ): 
			the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> >
			<h2 class="entry-title"> 
				<?php the_title(); ?> 
			</h2>

			<section class="onethird">
				<h3>Pages:</h3>
				<ul>
					<?php wp_list_pages( array(
						'title_li' => '',
					) ); ?>
				</ul>
			</section>

			<section class="onethird">
				<h3>Blog Posts:</h3>
				<ul>
					<?php wp_get_archives( array(
						'type' => 'alpha', //alphabetical list of all posts
					) ) ?>
				</ul>
			</section>

			<section class="onethird">
				<h3>Categories:</h3>
				<ul>
				<?php wp_list_categories( array(
					'title_li' => '',
				) ) ?>
				</ul>
			</section>			
					
		</article><!-- end post -->

		<?php comments_template(); //displays the list of comments for this page 
									//and the form if comments are open ?>

		<?php endwhile; ?>
	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_footer(); //include footer.php ?>