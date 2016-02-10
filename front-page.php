<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

		<?php awesome_slider(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
			<h2 class="entry-title"> 				
					<?php the_title(); ?> 				
			</h2>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
				
		</article><!-- end post -->

		<?php endwhile; ?>
	<?php else: ?>

	<h2>Sorry, Page not found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>


	<!-- Custom Query & loop demo See functions.php -->
	<?php awesome_products( 6, 'Newest Products' ); ?>

</main><!-- end #content -->

<?php get_sidebar(); //include sidebar.php ?>
<?php get_footer(); //include footer.php ?>