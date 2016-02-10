<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
			<h2 class="entry-title"> 				
					<?php the_title(); ?> 				
			</h2>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php 
				//for paginated posts 
				wp_link_pages( array(
					'next_or_number' => 'next',
					'before' 		=> '<div class="post-pagination">Keep reading', 
					'after'			=> '</div>'

				) );  
				?>
			</div>
				
		</article><!-- end post -->

		<?php endwhile; ?>
	<?php else: ?>

	<h2>Sorry, Page not found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar( 'page' ); //include sidebar-page.php ?>
<?php get_footer(); //include footer.php ?>