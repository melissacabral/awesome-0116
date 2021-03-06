<aside id="sidebar">
	<?php //if viewing a taxonomy archive, give users a way back to the shop 
	if( is_tax() ){
		?>
		<section class="widget products-view-all">
			<a href="<?php echo get_post_type_archive_link( 'product' ); ?>" 
			class="button">&larr; View All Products</a>
		</section>
		<?php
	} ?>

	<section class="widget">
		<h3 class="widget-title">Filter by Brand</h3>
		<ul>
			<?php wp_list_categories( array(
				'taxonomy' => 'brand',
				'title_li' => '',
				'show_count' => true,
			) ); ?>
		</ul>
	</section>

	<section class="widget">
		<h3 class="widget-title">Filter by Feature</h3>
		<ul>
			<?php wp_list_categories( array(
				'taxonomy' => 'feature',
				'title_li' => '',
				'show_count' => true,
			) ); ?>
		</ul>
	</section>
	
</aside>