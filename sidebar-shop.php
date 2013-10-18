<aside id="sidebar">
	
	<?php 
	//show the "all products" button if we are NOT on the product archive
	if( !is_post_type_archive( 'product' ) ): ?>
	<section class="widget products-view-all">
		<a href="<?php echo get_post_type_archive_link( 'product' ); ?>" 
			class="button">View All Products</a> 
	</section>
	<?php endif; ?>

	<section class="widget">
		<h3 class="widget-title">Filter by Brand:</h3>
		<ul>
			<?php 
			//show ALL terms for the brand taxonomy
			wp_list_categories( array(
				'taxonomy' => 'brand',
				'title_li' => '',
				'show_count' => true,
			) ); ?>
		</ul>
	</section>
	<section class="widget">
		<h3 class="widget-title">Filter by Feature:</h3>
		<ul>
			<?php 
			//show ALL terms for the brand taxonomy
			wp_list_categories( array(
				'taxonomy' => 'feature',
				'title_li' => '',
				'show_count' => true,
			) ); ?>
		</ul>
	</section>

</aside>
